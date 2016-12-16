<?php

/**
 * Message short summary.
 *
 * Message description.
 *
 * @version 1.0
 * @author Kamil
 */
class Message
{
    public $type;
    public $message;
    public function __construct($type, $message){
        $this->type = $type;
        $this->message = $message;
    }
}