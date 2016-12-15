<?php

/**
 * View short summary.
 *
 * View description.
 *
 * @version 1.0
 * @author Kamil
 */
abstract class View
{
    protected $output = stdClass;

    public function LoadModel($name){
        $path = MODELS.$name.'Model.php';
        $name .= 'Model';
        try{
            if(is_file($path)){
                require $path;
                $model = new $name;
            }else
                throw new Exception("Unable to open $name<br/>Path: $path");
        }
        catch(Exception $e) {
            echo $e->getMessage().'<br />
                File: '.$e->getFile().'<br />
                Code line: '.$e->getLine().'<br />
                Trace: '.$e->getTraceAsString();
            exit;
        }
        return $model;
    }

    public function RenderPage($name){
        $path = TEMPLATES."$name.html.php";
        $name .= 'Template';
        try{
            if(is_file($path))
                require $path;
            else
                throw new Exception("Unable to open $name<br/>Path: $path");
        }
        catch(Exception $e) {
            echo $e->getMessage().'<br />
                File: '.$e->getFile().'<br />
                Code line: '.$e->getLine().'<br />
                Trace: '.$e->getTraceAsString();
            exit;
        }
    }

    public function SetOutput(){
        
    }

    public function Get($name){
        return$this->$name;
    }

}