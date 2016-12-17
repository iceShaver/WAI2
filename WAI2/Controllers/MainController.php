<?php
require_once INCLUDES.'helpers.inc.php';
require_once MODELS.'Message.php';
require_once CONTROLLERS.'Controller.php';
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
        $this->action();
    }

    private function action(){
        if(empty($_GET['module'])){
            if(!empty($_GET)) {
                $this->Redirect('.');
                exit;
            }
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
            if(empty($_GET['action']))
                $controller->DefaultAction();
            else{
                $action = ucfirst(strtolower($_GET['action']));
                $controller->$action();
            }

        }
    }


}