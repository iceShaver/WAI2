<?php
defined('RUNNING') or die("Access violation");

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
    public $privileges;
    public function __construct($_id, $userName, $email, $password, $privileges){
        $this->_id = $_id;
        $this->userName = $userName;
        $this->email = $email;
        $this->password = $password;
        $this->privileges = $privileges;
    }
}