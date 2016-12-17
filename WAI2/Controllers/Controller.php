<?php

/**
 * Controller short summary.
 *
 * Controller description.
 *
 * @version 1.0
 * @author Kamil
 */
abstract class Controller
{
    public function DefaultAction(){
        
    }

    public function Redirect($url){
        header("Location: $url");
    }

    public function LoadView($name){
        $path = VIEWS.$name.'View.php';
        $name .= 'View';
        try{
            if(is_file($path)){
                require_once $path;
                $view = new $name;
            }else
                throw new Exception("Unable to open $name <br/>Path: $path");
        }
        catch(Exception $e){
            echo $e->getMessage().'<br />
                File: '.$e->getFile().'<br />
                Code line: '.$e->getLine().'<br />
                Trace: '.$e->getTraceAsString();
            exit;
        }
        return $view;
    }

    public function LoadModel($name){
        $path = MODELS.$name.'Model.php';
        $name .= 'Model';
        try{
            if(is_file($path)){
                require_once $path;
                $model = new $name;
            }
            else
                throw new Exception("Unable to open $name <br/>Path: $path");
        }
        catch(Exception $e){
            echo $e->getMessage().'<br />
                File: '.$e->getFile().'<br />
                Code line: '.$e->getLine().'<br />
                Trace: '.$e->getTraceAsString();
            exit;
        }
        return $model;
    }

}