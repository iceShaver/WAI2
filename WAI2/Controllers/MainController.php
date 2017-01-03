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

    /**
     * Start session, auth, messages, do action
     */
    public function __construct(){
        session_start();
        if(!isset($_SESSION['messages']))
            $_SESSION['messages'] = array();
        if(!isset($_SESSION['auth']))
            $_SESSION['auth'] = new AuthController();
        $this->authHandle();
        $this->loadModuleController();
    }

    /**
     * Do auth actions like registering, logging in and return to the last page
     */
    private function authHandle(){
        if(isset($_REQUEST['auth']) || (isset($_GET['module']) && $_GET['module'] == 'auth')){
            try
            {
                if (!isset($_REQUEST['action']))
                    throw new Exception("Nie podano akcji");
            	$action = $_REQUEST['action'];
                if (!method_exists($_SESSION['auth'], $action))
                    throw new Exception("Podano nieprawidłową akcję");
                $_SESSION['auth']->$action();
                $this->Redirect($_SERVER['HTTP_REFERER']);
            }
            catch (Exception $exception)
            {
                new Message(MessageType::ERROR, $exception->getMessage());
                $view = $this->LoadView("Default");
                $view->DisplayError();
            }
            exit();
        }
    }

    /**
     * Load module controller based on input data (REQUEST) and do action
     */
    private function loadModuleController(){
        if(empty($_REQUEST)){
            $view = $this->LoadView("Default");
            $view->DisplayMain();
            exit();
        }

        try
        {
        	if(!isset($_REQUEST['module']) || $_REQUEST['module']=='')
                throw new Exception("Podana strona nie została odnaleziona");
            $controllerName = ucfirst(strtolower($_REQUEST['module'])).'Controller';
            $controllerPath = CONTROLLERS.$controllerName.'.php';
            if(!is_file($controllerPath))
                throw new Exception("Nie odnaleziono podanego modułu");
            require_once $controllerPath;
            $controller = new $controllerName();
        }
        catch (Exception $exception)
        {
            new Message(MessageType::ERROR, $exception->getMessage());
            $view = $this->LoadView("Default");
            $view->DisplayError();
            exit();

        }

        if(empty($_REQUEST['action']))
            $controller->DefaultAction();
        else{
            $action = ucfirst(strtolower($_REQUEST['action']));
            $controller->$action();
        }


    }


}