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
	const ADMIN = 1;
    const USER = 2;
    const GUEST = 3;
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
            new Message(MessageType::ERROR, 'Jesteœ juz zalogowany');
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