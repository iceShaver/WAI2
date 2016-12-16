<?php
define('APP_PATH', '/');
define('APP_ROOT', $_SERVER['DOCUMENT_ROOT'].APP_PATH);
define('MODELS', APP_ROOT.'Models/');
define('VIEWS', APP_ROOT.'Views/');
define('CONTROLLERS', APP_ROOT.'Controllers/');
define('TEMPLATES', APP_ROOT.'Templates/');
define('HTML', APP_ROOT.'Html/');
define('PARTIALS', HTML.'Partials/');
define('CONFIG', APP_ROOT.'Config/');
define('INCLUDES', APP_ROOT.'Includes/');
define('CSS', APP_ROOT.'CSS/');
define('JS', APP_ROOT.'JS/');
define('FONTS', APP_ROOT.'Fonts/');
define('DEBUG', false);
define('TITLE', 'Galeria filmów');
define('PHOTOS_DIR', APP_ROOT.'Images/Photos/');
define('PHOTOS_DIR_RELATIVE', '/Images/Photos/');
define('PHOTOS_MAX_FILE_SIZE', 10485760);
const PHOTOS_ALLOWED_FILE_EXTENSIONS = array('png', 'jpg', 'jpeg');
?>