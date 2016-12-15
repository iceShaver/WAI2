<?php
require './Config/config.php';
require INCLUDES.'helpers.inc.php';

$object = new stdClass();


//Loads gallery module
if($_GET['module'] == 'gallery' && isset($_GET['action'])){
    require CONTROLLERS."GalleryController.php";
    $controller = new GalleryController();
    $controller->$_GET['action']();
}



//If nothing selected display main page


