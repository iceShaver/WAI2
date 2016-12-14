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
        $this->SetOutput($model->getAll());
    }
}
