<?php
require_once INCLUDES.'helpers.inc.php';
require_once MODELS.'Message.php';
require_once CONTROLLERS.'Controller.php';
require_once CONTROLLERS.'AuthController.php';
require_once MODELS.'AuthModel.php';
/**
 * mainController short summary.
 *
 * mainController description.
 *
 * @version 1.0
 * @author Kamil
 */
class MainController extends Controller
{
    public function __construct(){
        session_start();
        if(!isset($_SESSION['messages']))
            $_SESSION['messages'] = array();
        if(!isset($_SESSION['auth']))
            $_SESSION['auth'] = new AuthController();
        if(isset($_REQUEST['auth']) || (isset($_GET['module']) && $_GET['module'] == 'auth')){
            $action = $_REQUEST['action'];
            $_SESSION['auth']->$action();
            $this->Redirect($_SERVER['HTTP_REFERER']);
        }

        $this->action();
    }

    private function action(){
        if(empty($_GET['module'])){
            require_once VIEWS.'DefaultView.php';
            $view = new DefaultView();
            $view->DisplayMain();
        }else{
            $this->loadModule();
        }
    }
    private function loadModule(){
        $controllerName = ucfirst(strtolower($_GET['module'])).'Controller';
        $controllerPath = CONTROLLERS.$controllerName.'.php';
        if(!is_file($controllerPath)){
            new Message(MessageType::ERROR, 'Nie odnaleziono podanej strony');
            require_once VIEWS.'DefaultView.php';
            $view = new DefaultView();
            $view->DisplayBlank();

        }else{
            require_once $controllerPath;
            $controller = new $controllerName();
            if(empty($_REQUEST['action']))
                $controller->DefaultAction();
            else{
                $action = ucfirst(strtolower($_REQUEST['action']));
                $controller->$action();
            }

        }
    }


}