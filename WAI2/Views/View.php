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



    public function LoadModel($name){
        $path = MODELS.$name.'Model.php';
        $name .= 'Model';
        try{
            if(is_file($path)){
                require_once $path;
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

    protected function RenderPage($name, $output){
        $userBlock = HTML.'userBlock.html.php';
        $loginBlock = HTML.'loginBlock.html.php';
        $output['col2']['title'] =
            (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true)
            ? 'Witaj'.$_SESSION['userName']
            : 'Zaloguj się';
        $output['col2']['content'] = (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true)
            ? $userBlock
            : $loginBlock;
        $output['content']['content'] = HTML."$name.html.php";
        $output['col1']['title'] = 'Czas';
        //try{
        //    if(!is_file($path))
        //        throw new Exception("Unable to open $name<br/>Path: $path");
        //}
        //catch(Exception $e) {
        //    echo $e->getMessage().'<br />
        //        File: '.$e->getFile().'<br />
        //        Code line: '.$e->getLine().'<br />
        //        Trace: '.$e->getTraceAsString();
        //    exit;
        //}
        include TEMPLATES.'defaultTemplate.html.php';

        unset($_SESSION['messages']);
        unset($_SESSION['form']);

    }


}