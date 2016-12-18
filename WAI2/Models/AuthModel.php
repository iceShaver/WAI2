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
            new Message(MessageType::ERROR, 'Musisz podać nazwę użytkownika');
        }
        if($_POST['password'] == ''){
            $error = true;
            new Message(MessageType::ERROR, 'Musisz podać hasło, które składa sie przynajmniej z 8 znaków');
        }
        //TODO: email correctness verification
        if($_POST['email'] == ''){
            $error = true;
            $emailOk = false;
            new Message(MessageType::ERROR, 'Musisz podać prawidłowy adres e-mail');
        }
        if($_POST['password'] != $_POST['password2']){
            $error = true;
            new Message(MessageType::ERROR, 'Wpisane hasła nie są takie same');
        }
        if($userNameOk == true && $this->CheckIfUserNameUsed($_POST['userName'])){
            $error = true;
            new Message(MessageType::ERROR, 'Użytkownik o podanej nazwie już istnieje. Wpisz inną nazwę');
        }
        if($emailOk == true && $this->CheckIfEmailUsed($_POST['email'])){
            $error = true;
            new Message(MessageType::ERROR, 'Podany adres e-mail jest już używany. Podaj inny adres e-mail');
        }
        if($error==false){
            $password = $this->hashPassword($_POST['password']);
            $user = new User(new MongoId(), $_POST['userName'], $_POST['email'], $password, UserType::USER);
            $this->collection = $this->db->createCollection("Users");
            $this->collection->insert($user);
            new Message(MessageType::SUCCESS, 'Konto użytkownika zostało utworzone pomyślnie');
            return 0;
        }

        $_SESSION['registerForm'] = $_POST;
        return 1;
    }

    private function hashPassword($password){
        return md5($password.PASSWORD_SALT);
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

    public function GetUser(){

        $this->collection = $this->db->createCollection("Users");
        $where = array('userName' => $_POST['userName']);
        $user = $this->collection->findOne($where);
        if($user == null){
            new Message(MessageType::ERROR, 'Nie znaleziono użytkownika w bazie danych.');
            $_SESSION['loginForm'] = $_POST;
            return null;
        }
        if($this->hashPassword($_POST['password']) != $user['password']){
            new Message(MessageType::ERROR, 'Podane hasło jest niepoprawne');
            $_SESSION['loginForm'] = $_POST;
            return null;
        }
            new Message(MessageType::SUCCESS, 'Użytkownik pomyślnie zalogowany');
            return $user;



    }

}