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
class UserState
{
	const ADMIN = 2;
    const USER = 1;
    const GUEST = 0;
}


class AuthController extends Controller
{
    private $userName;
    private $userId;
    private $userState;
    //check if user is logged in, privileges etc
    public function __construct(){
        $this->userId = null;
        $this->userName = null;
        $this->userState = UserState::GUEST;

    }

    public function login(){
        $model = $this->LoadModel("Auth");
        if($this->userState != UserState::GUEST){
            new Message(MessageType::ERROR, 'Jesteś juz zalogowany');
            $this->Redirect($_SERVER['HTTP_REFERER']);
        }
        $user = $model->GetUser();
        if($user == null)
            $this->Redirect($_SERVER['HTTP_REFERER']);
        $this->userName = $user['userName'];
        $this->userId = $user['_id'];
        $this->userState = $user['privileges'];
        $this->Redirect($_SERVER['HTTP_REFERER']);
    }

    public function GetUserState(){
        return $this->userState;
    }

    public function GetUserName(){
        return $this->userName;
    }

    public function logout(){
        $this->userName = null;
        $this->userId = null;
        $this->userState = UserState::GUEST;
        $this->Redirect($_SERVER['HTTP_REFERER']);
    }

    public function newuser(){
        $view = $this->LoadView('Auth');
        $view->NewUser();
    }

    public function register(){
        $model = $this->LoadModel("Auth");
        if($model->Register()){
            $this->Redirect('?auth&action=newuser');
            exit;
        }
        $this->Redirect('.');
    }

    public function Authorisation($userState){
        //If user is at least given $userState
        if(!$_SESSION['auth']->GetUserState() >= $userState){
            new Message(MessageType::ERROR, 'Nie masz uprawnień do przeglądania tej strony');
            $view = $this->LoadView('Default');
            $view->DisplayBlank();
            exit;
        }
    }

}