<?php
//defined('RUNNING') or die("Access violation");
error_reporting(0);
define('APP_PATH', '/');
define('APP_ROOT', $_SERVER['DOCUMENT_ROOT'].APP_PATH);
define('MODELS', APP_ROOT.'Models/');
define('VIEWS', APP_ROOT.'Views/');
define('CONTROLLERS', APP_ROOT.'Controllers/');

define('TEMPLATE', 'Default');
define('TEMPLATE_DIR', APP_ROOT.'HTML/Templates/'.TEMPLATE.'/');

define('HTML', APP_ROOT.'HTML/');
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
define('PHOTOS_MAX_FILE_SIZE', 1048576);
define('PASSWORD_SALT', 'vb354H%$Hn%^JHNb%$^hj456ygh%$#');
const PHOTOS_ALLOWED_FILE_EXTENSIONS = array('png', 'jpg', 'jpeg');

//----------------------MongoDB-------------------------------------

define('MONGO_SERVER', 'mongodb://localhost:27017/');
define('MONGO_USERNAME', 'wai_web');
define('MONGO_PASSWORD', 'w@i_w3b');



?>