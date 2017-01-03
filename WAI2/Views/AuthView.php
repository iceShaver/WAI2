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
        $output['page']['title'] = "Rejestracja nowego użytkownika";
        $output['content']['title'] = "Rejestracja nowego użytkownika";
        if(isset($_SESSION['registerForm'])){
            $output['registerForm']['userName'] = $_SESSION['registerForm']['userName'];
            $output['registerForm']['email']= $_SESSION['registerForm']['email'];
        }else
        {
            $output['registerForm']['userName'] = '';
            $output['registerForm']['email'] = '';
        }
        $this->RenderPage('Auth/newuser.html.php', $output);
        unset($_SESSION['registerForm']);
    }

    public function displayUserBlock(){

    }
}