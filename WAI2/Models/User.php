<?php

/**
 * User short summary.
 *
 * User description.
 *
 * @version 1.0
 * @author Kamil
 */
class User
{
    public $_id;
    public $userName;
    public $email;
    public $password;
    public function __construct($_id, $userName, $email, $password){
        $this->_id = $_id;
        $this->userName = $userName;
        $this->email = $email;
        $this->password = $password;
    }
}