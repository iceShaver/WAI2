<?php
require './Config/config.php';
require INCLUDES.'helpers.inc.php';

$object = new stdClass();


if($_GET['task'] == 'gallery' && isset($_GET['action'])){
    require CONTROLLERS."GalleryController.php";
    $controller = new GalleryController();
    $controller->$_GET['action']();
}

