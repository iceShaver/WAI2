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

    public function Index(){
        $model = $this->LoadModel('Gallery');
        $this->RenderPage('galleryIndex', $model->getPhotos());
    }

    public function Add($messages){
        $output = new stdClass;
        $output->col1Title = null;
        $output->col1Content = null;
        $output->contentTitle = null;
        $output->content = null;
        $output->col2Title = null;
        $output->col2Content = null;
        $output->pageTitle = "Dodaj nowy obraz - " . TITLE;
        $output->messages = $messages;

        $output->formLegend = 'Dodaj nowe zdjęcie';
        $output->_id = null;
        $output->author = $_SESSION['form']['author'];
        $output->title = $_SESSION['form']['title'];
        $output->watermark = $_SESSION['form']['watermark'];
        $output->description = $_SESSION['form']['description'];
        $output->private = $_SESSION['form']['private'];
        $this->RenderPage('addEditForm', $output);
        unset($_SESSION['form']);

    }
}
