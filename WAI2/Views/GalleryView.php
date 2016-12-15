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
        $model->GetPicturesInfo();
        $model->GetPictures();
        $this->SetOutput($model->getAll());
        $this->RenderPage('galleryIndex');
    }

    public function Add(){
        $this->RenderPage('addEditForm');

    }
}
