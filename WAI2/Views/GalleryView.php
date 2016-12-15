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
        $this->RenderPage('addEditForm');

    }
}
