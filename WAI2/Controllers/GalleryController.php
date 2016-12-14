<?php
require CONTROLLERS.'Controller.php';
/**
 * Gallery short summary.
 *
 * Gallery description.
 *
 * @version 1.0
 * @author Kamil
 */
class GalleryController extends Controller
{

    public function index(){
        $view = $this->LoadView('Gallery');
        $view->index();
    }

    public function add(){
        $view = $this->LoadView('Gallery');
        $view->add();
    }

    public function insert(){
        $model = $this->LoadModel('Gallery');
        $model->Create($_POST);
        $this->Redirect('?task=gallery&action=index');
    }

    public function delete(){
        $model = $this->LoadModel('Gallery');
        $model->Remove($_GET['id']);
    }

    public function loadsampledata(){
        $model = $this->LoadModel('Gallery');
        $data = array(
            "title" => "MongoDB",
      "description" => "database",
      "likes" => 100,
      "url" => "http://www.tutorialspoint.com/mongodb/",
      "by", "tutorials point");
        $model->Create($data);
        //$this->Redirect('?');
    }
}