<?php
require_once CONTROLLERS.'Controller.php';
/**
 * AuthController short summary.
 *
 * AuthController description.
 *
 * @version 1.0
 * @author Kamil
 */
class Priviledge
{
	const ADMIN = 1;
    const USER = 2;
    const GUEST = 3;
}


class AuthController extends Controller
{
    private $isLoggedIn;
    private $privileges;
    private $model;
    //check if user is logged in, privileges etc
    public function __construct(){
        $this->model = $this->LoadModel("Auth");
        $this->model->checkIfUserLoggedIn();
    }

    public function login(){
        if(!$this->model->checkIfUserExists()){
            $_SESSION['messages'][] = new Message(MessageType::ERROR, 'Nie znaleziono u¿ytkownika w bazie danych.');
            $this->Redirect($_SERVER['HTTP_REFERER']);
        }else if(!$this->model->checkPassword()){
            $_SESSION['messages'][] = new Message(MessageType::ERROR, 'Podane has³o jest niepoprawne');
            $this->Redirect($_SERVER['HTTP_REFERER']);
        }else{
            $this->isLoggedIn = true;
            $this->privileges = $this->model->getPrivileges();
            $_SESSION['messages'][] = new Message(MessageType::SUCCESS, 'U¿ytkownik pomyœlnie zalogowany');
        }
    }

    public function logout(){

    }

    public function newuser(){
        $view = $this->LoadView('Auth');
        $view->NewUser();
    }

    public function register(){
        if($this->model->Register()){
            $this->Redirect('?module=auth&action=newuser');
            exit;
        }
        $this->Redirect('?module=gallery&action=index');
    }

    public function edit(){

    }

}