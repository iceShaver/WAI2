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
        $output['pictures'] = $model->getPhotos();

        $this->RenderPage('galleryIndex', $output);
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
            $output['description'] = $_SESSION['form']['description'];
            if(isset($_SESSION['private']))
                $output['private'] = $_SESSION['form']['private'];
            else
                $output['private'] = null;
        }else{
            $output['author'] = "";
            $output['title'] = "";
            $output['watermark'] = "";
            $output['description'] = "";
            $output['private'] = "";
        }
        $this->RenderPage('addEditForm', $output);

    }
}
