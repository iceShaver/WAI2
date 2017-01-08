<?php
defined('RUNNING') or die("Access violation");
require_once MODELS.'Model.php';
require_once MODELS.'Picture.php';
/**
 * Gallery short summary.
 *
 * Gallery description.
 *
 * @version 1.0
 * @author Kamil
 */

//TODO: trycatch all db and require operations
class GalleryModel extends Model
{

    public function GetPictures(){
        $this->collection = $this->db->createCollection("Photos");
        if(DEBUG) echo 'Collection Photos created/selected<br/>';
        $author = $_SESSION['auth']->GetUserId();
        $fields = array('_id'=>true,'minId'=>true, 'wmId'=>true, 'extension'=>true, 'title'=>true, 'author'=>true, 'private'=>true);
        $where = array('$or' =>array(array('private'=>false), array('author'=> new MongoId($author))));
        $cursor = $this->collection->find($where,$fields);
        $pictures = array();
        foreach ($cursor as $row)
        {
            if(MongoId::isValid($row['author']))
                $row['author'] = $this->getAuthorName($row['author']);
        	$pictures[] = $row;

        }
        if(!$pictures)
            new Message(MessageType::INFO, "Brak zdjęć do wyświetlenia");
        return $pictures;
    }

    private function getAuthorName($id){
        $this->collection = $this->db->createCollection("Users");
        $author = $this->collection->findOne(array('_id'=>$id), array('userName'=>true));
        return $author['userName'];
    }

    public function GetMyPictures(){
        $this->collection = $this->db->createCollection("Photos");
        if(DEBUG) echo 'Collection Photos created/selected<br/>';
        $fields = array('_id'=>true,'minId'=>true, 'wmId'=>true, 'extension'=>true, 'title'=>true, 'author'=>true, 'private'=> true);
        $where = array('author'=>new MongoId($_SESSION['auth']->GetUserId()));
        $cursor = $this->collection->find($where,$fields);
        $pictures = array();
        foreach ($cursor as $row)
        {
            if(MongoId::isValid($row['author']))
                $row['author'] = $this->getAuthorName($row['author']);
        	$pictures[] = $row;
        }
        if(!$pictures)
            new Message(MessageType::INFO, "Brak zdjęć do wyświetlenia");
        return $pictures;
    }


    public function GetSavedPictures(){
        $pictures = array();
        if(!isset($_SESSION['savedPictures']))
            new Message(MessageType::INFO, "Brak zdjęć do wyświetlenia");
        else
        foreach ((array)$_SESSION['savedPictures'] as $id)
        {
        	$pictures[] = $this->GetPicture($id);
        }
        return $pictures;
    }


    public function GetPicture($id){
        $this->collection = $this->db->createCollection("Photos");
        if(DEBUG) echo 'Collection Photos created/selected<br/>';
        $where = array('_id' => new MongoId($id));
        $picture = $this->collection->findOne($where);
        if(MongoId::isValid($picture['author']))
            $picture['author'] = $this->getAuthorName($picture['author']);
        return $picture;

    }

    /**
     * Handle with incoming photo. Returns 0 if succeed 1 if failed
     * @return int
     */
    public function SavePicture(){
        $error = false;
        $fileExtension = strtolower(end(explode('.', $_FILES['photo']['name'])));
        if(determineAuthorisationAtLeast(UserType::USER))
            $author = new MongoId($_SESSION['auth']->GetUserId());
        else
            $author = $_POST['author'];


        $picture = new Picture(new MongoId(), new MongoId(), new MongoId(), $fileExtension, $_FILES['photo']['size'],
            $_POST['title'], $author, $_POST['watermark'],
            time(), ($_POST['private'] == 'true') ? true : false);
        $file = $_FILES['photo']['tmp_name'];
        if($file == null){
            $error = true;
            new Message(MessageType::ERROR, "Nie wybrano pliku do wysłania");
        }else{
            if(!in_array($picture->extension, PHOTOS_ALLOWED_FILE_EXTENSIONS))
            {
                $error = true;
                new Message(MessageType::ERROR,
                    'Nieprawidłowe rozszerzenie pliku. Plik musi mieć jedno z następujących rozszerzeń: '.
                    join(', ', PHOTOS_ALLOWED_FILE_EXTENSIONS));
            }
            if($picture->size > PHOTOS_MAX_FILE_SIZE)
            {
                $error = true;
                new Message(MessageType::ERROR, 'Za duży rozmiar pliku. Podaj mniejszy plik i wyślij ponownie');
            }
        }
        if ($picture->watermark == '')
        {
        	$error = true;
            new Message(MessageType::ERROR, 'Musisz wypełnić pole "znak wodny"');
        }


        if($error == false){

            $this->create($picture);
            move_uploaded_file($file, PHOTOS_DIR.$picture->_id.'.'.$picture->extension);
            $this->genMin($picture);
            $this->genWatermark($picture);
            new Message(MessageType::SUCCESS, 'Zdjęcie "'.$picture->title.'" zostało zapisane');
            return 0;

        }

        $_SESSION['form'] = $_POST;
        return 1;
    }

    public function SessionSavePictures(){
        if($_SESSION['savedPictures'] = $_POST['savedPictures'])
            new Message(MessageType::SUCCESS, "Wybrane zdjęcia zostały zapisane");
        else
            new Message(MessageType::ERROR, "Musisz wybrać conajmniej jedno zdjęcie do zapisania");
    }

    public function DeleteSavedPictures(){
        if(!$_POST['savedPictures'])
            new Message(MessageType::ERROR, "Musisz wybrać conajmniej jedno zdjęcie do usunięcia");
        else
        foreach ($_POST['savedPictures'] as $pictureToDelete)
        {
        	$key = array_search($pictureToDelete, $_SESSION['savedPictures']);
            unset($_SESSION['savedPictures'][$key]);
        }


    }

    public function DeleteAll(){
        $this->collection = $this->db->createCollection("Photos");
        $this->collection->remove();
        $files = glob(PHOTOS_DIR.'*'); // get all file names
        foreach($files as $file){ // iterate files
            if(is_file($file) && $file != PHOTOS_DIR.'index.php')
                unlink($file); // delete file
        }
    }

    private function genWatermark($picture){

        //TODO: care transparent pngs

        //Get photo
        if($picture->extension == 'png')
            $photo = imagecreatefrompng(PHOTOS_DIR.$picture->_id.'.'.$picture->extension);
        else
            $photo = imagecreatefromjpeg(PHOTOS_DIR.$picture->_id.'.'.$picture->extension);


        //Write watermark
        $textcolor = imagecolorallocate($photo, 255, 255, 255);
        imagettftext($photo, 14, 0, 30, imagesy($photo)-30,$textcolor, FONTS.'Lato-Regular.ttf', $picture->watermark);


        //Save photo
        if($picture->extension == 'png')
            imagepng($photo, PHOTOS_DIR.$picture->wmId.'.'.$picture->extension);
        else
            imagejpeg($photo, PHOTOS_DIR.$picture->wmId.'.'.$picture->extension);

        imagedestroy($photo);
    }

    private function genMin($picture){

        //Get photo
        if($picture->extension == 'png')
            $src = imagecreatefrompng(PHOTOS_DIR.$picture->_id.'.'.$picture->extension);
        else
            $src = imagecreatefromjpeg(PHOTOS_DIR.$picture->_id.'.'.$picture->extension);

        //Calculate size, position etc
        $minWidth = 200;
        $minHeight = 125;
        $min = imagecreate($minWidth, $minHeight);
        $srcWidth = imagesx($src);
        $srcHeight = imagesy($src);

        $srcAspectRatio = $srcWidth/$srcHeight;
        $minAspectRatio = $minWidth/$minHeight;

        if($srcAspectRatio < $minAspectRatio)
        {
            $srcW = $srcWidth;
            $srcH = floor($srcW / $minAspectRatio);
            $srcX = 0;
            $srcY = floor($srcHeight/2 - $srcH/2);
        }else{
            $srcH = $srcHeight;
            $srcW = floor($srcH * $minAspectRatio);
            $srcY = 0;
            $srcX = floor($srcWidth/2 - $srcW/2);

        }

        //Create miniature
        imagecopyresampled($min, $src, 0, 0, $srcX, $srcY, $minWidth, $minHeight, $srcW, $srcH);


        //Save miniature
        if($picture->extension == 'png')
            imagepng($min, PHOTOS_DIR.$picture->minId.'.'.$picture->extension);
        else
            imagejpeg($min, PHOTOS_DIR.$picture->minId.'.'.$picture->extension);
        imagedestroy($src);
        imagedestroy($min);

    }



    private function create($data){
        $this->collection = $this->db->createCollection("Photos");
        if(DEBUG) echo 'Collection Photos created/selected<br/>';
        $this->collection->insert($data);
        if(DEBUG) echo 'Inserted data to db<br/>';

    }




}