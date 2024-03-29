<?php
defined('RUNNING') or die("Access violation");
require_once CONTROLLERS.'Controller.php';
/**
 * AuthController short summary.
 *
 * AuthController description.
 *
 * @version 1.0
 * @author Kamil
 */
class UserType
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
        $this->userState = UserType::GUEST;
    }

    public function login(){
        $model = $this->LoadModel("Auth");
        if($this->userState != UserType::GUEST){
            new Message(MessageType::ERROR, 'Jesteś juz zalogowany');
            $this->Redirect($_SERVER['HTTP_REFERER']);

        }
        $user = $model->GetUser();
        if($user == null)
        {
            $this->Redirect($_SERVER['HTTP_REFERER']);
            exit();

        }
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

    public function GetUserId(){
        return $this->userId;
    }

    public function logout(){
        session_destroy();
        session_start();
        new Message(MessageType::SUCCESS, "Użytkownik wylogowany pomyślnie");
        //$this->userName = null;
        //$this->userId = null;
        //$this->userState = UserType::GUEST;
        $this->Redirect($_SERVER['HTTP_REFERER']);
    }

    public function newuser(){
        $view = $this->LoadView('Auth');
        $view->NewUser();
    }

    public function register(){
        $model = $this->LoadModel("Auth");
        if($model->Register()){
            $this->Redirect('/auth/newuser');
            exit();
        }
        $this->Redirect('.');
        exit();
    }

    /**
     * Pass user if has the same of greater privileges. Abort and show message if it is not.
     * @param UserType $userType
     * @return void
     */
    public function AuthoriseAtLeast($userType){
        if(!$_SESSION['auth']->GetUserState() >= $userType){
            $this->displayNotAuthorised();
            exit();
        }
    }
    /**
     * Pass user if has exactly the same privileges. Abort and show message if user is not given type.
     * @param UserType $userType
     * @return void
     */
    public function AuthoriseExactly($userType){
        if(!$_SESSION['auth']->GetUserState() == $userType){
            $this->displayNotAuthorised();
            exit();
        }
    }
    /**
     * Determine if user belong to given user type
     * @param UserType $userType
     * @return boolean
     */
    public function DetermineAuthorisationExactly($userType){
        if($_SESSION['auth']->GetUserState() == $userType)
            return true;
        return false;

    }
    /**
     * Determine if user belong to given or greater user type
     * @param UserType $userType
     * @return boolean
     */
    public function DetermineAuthorisationAtLeast($userType){
        if($_SESSION['auth']->GetUserState() >= $userType)
            return true;
        return false;

    }

    private function displayNotAuthorised(){
        new Message(MessageType::ERROR, 'Nie masz uprawnień do przeglądania tej strony');
        $view = $this->LoadView('Default');
        $view->DisplayError();
        exit;
    }

}

function authoriseAtLeast($userType){
    $_SESSION['auth']->AuthoriseAtLeast($userType);
}

function authoriseExactly($userType){
    $_SESSION['auth']->AuthoriseExactly($userType);
}

function determineAuthorisationExactly($userType){
    return $_SESSION['auth']->DetermineAuthorisationExactly($userType);
}

function determineAuthorisationAtLeast($userType){
    return $_SESSION['auth']->DetermineAuthorisationAtLeast($userType);
}