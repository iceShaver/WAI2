<?php
defined('RUNNING') or die("Access violation");

/**
 * Message short summary.
 *
 * Message description.
 *
 * @version 1.0
 * @author Kamil
 */

class MessageType{
    const ERROR = 'error';
    const WARNING = 'warning';
    const INFO = 'info';
    const SUCCESS = 'success';
}

class Message
{
    public $type;
    public $message;
    public function __construct($type, $message){
        $this->type = $type;
        $this->message = $message;
        $_SESSION['messages'][] = $this;
    }
}