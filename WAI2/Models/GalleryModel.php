<?php
require MODELS.'Model.php';
/**
 * Gallery short summary.
 *
 * Gallery description.
 *
 * @version 1.0
 * @author Kamil
 */
class GalleryModel extends Model
{
    private $db;
    private $collection;
    public function GetAll(){
        $this->db = $this->dbConnection->Gallery;
        if(DEBUG) echo 'Successfully selected database Gallery<br/>';

    }

    public function Create($data){
        $this->db = $this->dbConnection->Gallery;
        if(DEBUG) echo 'Database Gallery selected<br/>';
        $this->collection = $this->db->createCollection("Photos");
        if(DEBUG) echo 'Collection Photos created/selected<br/>';
        $this->collection->insert($data);
        if(DEBUG) echo 'Inserted data to db<br/>';

    }


    public function SavePicture(){
        //unset picture id to allow MongoDB create its own
        unset($_POST['_id']);
        $errors = array();
        $this->Create($_POST);
        $file = $_FILES['photo']['tmp_name'];
        $fileExtension = strtolower(end(explode('.', $_FILES['photo']['name'])));
        $fileSize = $_FILES['photo']['size'];
        $fileName = $_POST['_id'].'.'.$fileExtension;
        if(!in_array($fileExtension, PHOTOS_ALLOWED_FILE_EXTENSIONS))
        {
            $errors[] = new Message('error',
                'Nieprawidłowe rozszerzenie pliku. Plik musi mieć jedno z następujących rozszerzeń: '.
                join(', ', PHOTOS_ALLOWED_FILE_EXTENSIONS));
        }
        if($fileSize > PHOTOS_MAX_FILE_SIZE)
            $errors[] = new Message('error', 'Za duży rozmiar pliku. Podaj mniejszy plik i wyślij ponownie');
        if(empty($errors)){
            move_uploaded_file($file, PHOTOS_DIR.$fileName);
            $messages[] = new Message('success', 'Zdjęcie zostało zapisane');
            return array('errors'=>0, 'messages' => $messages);
        }
        return array('errors'=>1, 'messages' => $errors);
    }


    /**
     * Gets pictures info from db
     * @return void
     */
    public function GetPicturesInfo(){

    }

    public function GetPictures(){

    }
    public function Read(){

    }

    public function Update(){

    }

    public function Delete($id){

    }

    /**
     * Loads sample data do db for testing purposes
     * @return void
     */
    public function LoadSampleData(){
        $data = new stdClass();
        $data->title = "Cokkjbbjkvhchxxh";
        $data->desc = "fds";
        $data->likes = 213;
        $this->Create($data);
    }
}