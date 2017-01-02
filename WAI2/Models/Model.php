<?php

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
            echo 'Unable to connect to database: '.$exception->getMessage();
        }
        $this->db = $this->dbConnection->Gallery;

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