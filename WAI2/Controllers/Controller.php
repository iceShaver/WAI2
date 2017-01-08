<?php
defined('RUNNING') or die("Access violation");
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

    public function Redirect($url){
        header("Location: $url");
        exit;
    }

    public function LoadView($viewName){
        $viewPath = VIEWS.$viewName.'View.php';
        $viewName .= 'View';
        try{
            if(!is_file($viewPath))
                throw new Exception("B³¹d podczas ³adowania widoku");
            require_once $viewPath;
            $view = new $viewName;
        }
        catch(Exception $exception){
            new Message(MessageType::ERROR, $exception->getMessage());
            $view = $this->LoadView("Default");
            $view->DisplayError();
            exit();
        }
        return $view;
    }

    public function LoadModel($modelName){
        $modelPath = MODELS.$modelName.'Model.php';
        $modelName .= 'Model';
        try{
            if(!is_file($modelPath))
                throw new Exception("B³¹d podczas ³adowania modelu");
            require_once $modelPath;
            $model = new $modelName;
        }
        catch(Exception $exception){
            new Message(MessageType::ERROR, $exception->getMessage());
            $view = $this->LoadView("Default");
            $view->DisplayError();
            exit();
        }
        return $model;
    }

}