<?php
require_once VIEWS.'View.php';
/**
 * AuthView short summary.
 *
 * AuthView description.
 *
 * @version 1.0
 * @author Kamil
 */
class AuthView extends View
{
    public function NewUser(){
        $output = new stdClass();
        $output->pagetitle = "Rejestracja nowego u¿ytkownika";
        $output->userName = $_SESSION['form']['userName'];
        $output->email = $_SESSION['form']['email'];
        $this->RenderPage('newuser', $output);
    }

    public function displayUserBlock(){
        
    }
}