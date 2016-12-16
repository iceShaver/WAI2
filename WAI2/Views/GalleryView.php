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
        //Gets data
        $model->GetPicturesInfo();
        $model->GetPictures();
        $this->RenderPage('galleryIndex', $model->getAll());
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
        $output->author = $_POST['author'];
        $output->title = $_POST['title'];
        $output->watermark = $_POST['watermark'];
        $output->description = $_POST['description'];


        $this->RenderPage('addEditForm', $output);

    }
    public function Error($errors){
        $this->RenderPage('error.html.php', $errors);
    }
}
