<?php
require_once MODELS.'Model.php';
require_once MODELS.'User.php';
/**
 * AuthModel short summary.
 *
 * AuthModel description.
 *
 * @version 1.0
 * @author Kamil
 */
class AuthModel extends Model{


    public function Register(){
        $error = false;
        $userNameOk = true;
        $emailOk = true;
        if($_POST['userName'] == ''){
            $error = true;
            $userNameOk = false;
            $_SESSION['messages'][] = new Message(MessageType::ERROR, 'Musisz podać nazwę użytkownika');
        }
        if($_POST['password'] == ''){
            $error = true;
            $_SESSION['messages'][] = new Message(MessageType::ERROR, 'Musisz podać hasło, które składa sie przynajmniej z 8 znaków');
        }
        //TODO: email correctness verification
        if($_POST['email'] == ''){
            $error = true;
            $emailOk = false;
            $_SESSION['messages'][] = new Message(MessageType::ERROR, 'Musisz podać prawidłowy adres e-mail');
        }
        if($_POST['password'] != $_POST['password2']){
            $error = true;
            $_SESSION['messages'][] = new Message(MessageType::ERROR, 'Wpisane hasła nie są takie same');
        }
        if($userNameOk == true && $this->CheckIfUserNameUsed($_POST['userName'])){
            $error = true;
            $_SESSION['messages'][] = new Message(MessageType::ERROR, 'Użytkownik o podanej nazwie już istnieje. Wpisz inną nazwę');
        }
        if($emailOk == true && $this->CheckIfEmailUsed($_POST['email'])){
            $error = true;
            $_SESSION['messages'][] = new Message(MessageType::ERROR, 'Podany adres e-mail jest już używany. Podaj inny adres e-mail');
        }
        if($error==false){
            $password = md5($_POST['password'].PASSWORD_SALT);
            $user = new User(new MongoId(), $_POST['userName'], $_POST['email'], $password);
            $this->collection = $this->db->createCollection("Users");
            $this->collection->insert($user);
            $_SESSION['messages'][] = new Message(MessageType::SUCCESS, 'Konto użytkownika zostało utworzone pomyślnie');
            return 0;
        }

        $_SESSION['form'] = $_POST;
        return 1;
    }

    /**
     * Verifies if userName is used in DB and returns true or false
     * @return bool
     */
    public function CheckIfUserNameUsed($userName){
        $this->collection = $this->db->createCollection("Users");
        if($this->collection->count(array('userName'=>$userName)) == 0)
            return false;
        return true;

    }

    public function CheckIfEmailUsed($email){
        $this->collection = $this->db->createCollection("Users");
        if($this->collection->count(array('email'=>$email)) == 0)
            return false;
        return true;
    }

    public function CheckIfUserIsLoggedIn(){
        if($_SESSION['loggedIn'] == true)
            return true;
        return false;

    }


}