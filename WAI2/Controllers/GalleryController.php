<?php
require_once CONTROLLERS.'Controller.php';
/**
 * Gallerry Controller
 *
 * Gallery description.
 *
 * @version 1.0
 * @author Kamil
 */
class GalleryController extends Controller
{
    public function DefaultAction(){
        $this->Index();
    }
    public function Index(){
        $view = $this->LoadView('Gallery');
        $view->Index();
    }
    public function IndexMyPictures(){
        authoriseAtLeast(UserType::USER);
        $view = $this->LoadView("Gallery");
        $view->IndexMyPictures();
    }
    public function IndexSavedPictures(){
        $view = $this->LoadView("Gallery");
        $view->IndexSavedPictures();
    }
    public function DeleteSavedPictures(){
        $model = $this->LoadModel("Gallery");
        $model->DeleteSavedPictures();
        $this->Redirect($_SERVER['HTTP_REFERER']);
        exit();
        
    }
    public function ShowPicture(){
        $view = $this->LoadView('Gallery');
        $view->ShowFullPicture();
    }
    public function SavePictures(){
        $model = $this->LoadModel("Gallery");
        $model->SessionSavePictures();
        $this->Redirect($_SERVER['HTTP_REFERER']);
        exit();
    }
    public function Add(){
        $view = $this->LoadView('Gallery');
        $view->Add();
    }
    public function Insert(){
        
        $model = $this->LoadModel('Gallery');
        if($model->SavePicture())
        {
            $this->Redirect('?module=gallery&action=add');
        }

        $this->Redirect('?module=gallery&action=index');
    }
    public function DeleteAll(){
        $model = $this->LoadModel("Gallery");
        $model->DeleteAll();
        $this->Redirect($_SERVER['HTTP_REFERER']);
        exit();
    }

}