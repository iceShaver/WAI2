<?php
require_once 'Views/View.php';






/**
 * Gallery short summary.
 *
 * Gallery description.
 *
 * @version 1.0
 * @author Kamil
 */
class GalleryView extends View{

    public function Index(){
        $model = $this->LoadModel('Gallery');
        $output['page']['title'] = 'Wszystkie zdjęcia';
        $output['content']['title'] = 'Wszystkie zdjęcia';
        $output['pictures'] = $model->GetPictures();
        $output['picturesAction'] = 'savePictures';
        $output['picturesActionButton'] = 'Zapisz wybrane zdjęcia';
        $this->RenderPage('Gallery/galleryIndex.html.php', $output);

    }

    public function IndexMyPictures(){
        $model = $this->LoadModel('Gallery');
        $output['page']['title'] = 'Moje zdjęcia';
        $output['content']['title'] = 'Moje zdjęcia';
        $output['pictures'] = $model->GetMyPictures();
        $output['picturesAction'] = 'savePictures';
        $output['picturesActionButton'] = 'Zapisz wybrane zdjęcia';
        $this->RenderPage('Gallery/galleryIndex.html.php', $output);
    }

    public function IndexSavedPictures(){
        $model = $this->LoadModel('Gallery');
        $output['page']['title'] = 'Zapisane zdjęcia';
        $output['content']['title'] = 'Zapisane zdjęcia';
        $output['pictures'] = $model->GetSavedPictures();
        $output['picturesAction'] = 'deleteSavedPictures';
        $output['picturesActionButton'] = 'Usuń zdjęcia z zapisanych';

        $this->RenderPage('Gallery/galleryIndex.html.php', $output);
    }

    public function Add(){
        $output['page']['title'] = "Dodaj nowy obraz - " . TITLE;
        $output['content']['title'] = "Dodaj nowe zdjęcie";
        $output['formLegend'] = 'Dodaj nowe zdjęcie';
        $output['_id'] = "";
        if(isset($_SESSION['form'])){
            $output['author'] = $_SESSION['form']['author'];
            $output['title'] = $_SESSION['form']['title'];
            $output['watermark'] = $_SESSION['form']['watermark'];
            $output['private'] = (isset($_SESSION['form']['private'])) ? $_SESSION['form']['private'] : false;
        }else{
            $output['author'] = "";
            $output['title'] = "";
            $output['watermark'] = "";
            $output['private'] = "";
        }
        $output['author'] = (determineAuthorisationAtLeast(UserType::USER)) ? $_SESSION['auth']->GetUserName() : '';

        $this->RenderPage('Gallery/addEditForm.html.php', $output);

    }

    public function ShowFullPicture(){
        $model = $this->LoadModel('Gallery');
        $picture = $model->GetPicture();
        header('Content-Type: image/jpeg');
        readfile(PHOTOS_DIR.$picture['wmId'].'.'.$picture['extension']);
    }

    public function ShowPicture(){
        $model = $this->LoadModel('Gallery');
        $picture = $model->GetPicture();
        $output['page']['title'] = $picture['title'];
        $output['content']['title'] = $picture['title'];
        $output['picture'] = $picture;
        $this->RenderPage('Gallery/picture.html.php', $output);
    }
}
