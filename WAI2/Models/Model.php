<?php
defined('RUNNING') or die("Access violation");

/**
 * Model short summary.
 *
 * Model description.
 *
 * @version 1.0
 * @author Kamil
 */
abstract class Model
{
    protected $dbConnection = NULL;
    protected $db;
    protected $collection;

    /**
     * Creates connection to MongoDB
     */
    public function __construct(){
        try
        {
        	$this->dbConnection = new MongoClient();
            if(DEBUG) echo "Successfully connected to MongoDB";
        }
        catch (MongoException $exception)
        {
            new Message(MessageType::ERROR, "Nie udało się połączyć z bazą danych: ". $exception->getMessage());
            $view = $this->LoadView("Default");
            $view->DisplayError();
            exit();
        }
        $this->db = $this->dbConnection->Gallery;

    }

    public function LoadModel($modelName){
        $modelPath = MODELS.$modelName.'Model.php';
        $modelName .= 'Model';
        try{
            if(!is_file($modelPath))
                throw new Exception("Błąd podczas ładowania modelu");
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
    public function LoadView($viewName){
        $viewPath = VIEWS.$viewName.'View.php';
        $viewName .= 'View';
        try{
            if(!is_file($viewPath))
                throw new Exception("Błąd podczas ładowania widoku");
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
}