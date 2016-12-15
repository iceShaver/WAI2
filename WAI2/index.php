<?php
require './Config/config.php';
require INCLUDES.'helpers.inc.php';

if (isset($_GET['info']))
{
	phpinfo();
    exit;
}

//Loads gallery module
if($_GET['module'] == 'gallery' && isset($_GET['action'])){
    require CONTROLLERS."GalleryController.php";
    $controller = new GalleryController();
    $controller->$_GET['action']();
    exit;
}


//If nothing selected display main page
require TEMPLATES.'defaultTemplate.html.php';

