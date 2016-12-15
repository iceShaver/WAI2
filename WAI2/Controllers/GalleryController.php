<?php
require CONTROLLERS.'Controller.php';
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
    public function index(){
        $view = $this->LoadView('Gallery');
        $view->index();
    }



    /**
     * Displays add form for adding a new photo
     * @return void
     */
    public function add(){
        $view = $this->LoadView('Gallery');
        $view->Add();
    }


    /**
     * Insert given photos to filesystem and create entry in db
     * @return void
     */
    public function insert(){
        $model = $this->LoadModel('Gallery');
        $model->Create($_POST);
        $this->Redirect('?task=gallery&action=index');
    }


    /**
     * Deletes entry and photo with given id
     * @return void
     */
    public function delete(){
        $model = $this->LoadModel('Gallery');
        $model->Remove($_GET['id']);
    }


    public function loadsampledata(){
        $model = $this->LoadModel('Gallery');
        $model->LoadSampleData();
       // $this->Redirect('?');
    }

}