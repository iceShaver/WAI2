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
    /**
     * Indexes all picture and display them
     * @return void
     */

    public function DefaultAction(){
        $this->Index();
    }

    public function Index(){
        $view = $this->LoadView('Gallery');
        $view->Index();
    }

    public function ShowPicture(){
        $view = $this->LoadView('Gallery');
        $view->ShowPicture();
    }

    /**
     * Displays add form for adding a new photo
     * @return void
     */
    public function Add(){
        $_SESSION['auth']->Authorisation(UserState::ADMIN);
        $view = $this->LoadView('Gallery');
        $view->Add();
    }


    /**
     * Insert given photos to filesystem and create entry in db
     * @return void
     */
    public function Insert(){
        $model = $this->LoadModel('Gallery');
        if($model->SavePicture())
        {
            $this->Redirect('?module=gallery&action=add');
            exit;
        }

        $this->Redirect('?module=gallery&action=index');
    }


    /**
     * Deletes entry and photo with given id
     * @return void
     */
    public function Delete(){
        $model = $this->LoadModel('Gallery');
        $model->Remove($_GET['id']);
    }


    public function LoadSampleData(){
        $model = $this->LoadModel('Gallery');
        $model->LoadSampleData();
        // $this->Redirect('?');
    }

}