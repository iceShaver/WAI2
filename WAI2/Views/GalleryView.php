<?php
require 'Views/View.php';






/**
 * Gallery short summary.
 *
 * Gallery description.
 *
 * @version 1.0
 * @author Kamil
 */
class GalleryView extends View{

    public function index(){
        $model = $this->LoadModel('Gallery');
        //Gets data
        $model->GetPicturesInfo();
        $model->GetPictures();
        $this->RenderPage('galleryIndex', $model->getAll());
    }

    public function Add(){
        $output = new stdClass;
        $output->pageTitle = "Dodaj nowy obraz - " . TITLE;
        $output->formLegend = 'Dodaj nowe zdjęcie';
        $this->RenderPage('addEditForm', $output);

    }
}
