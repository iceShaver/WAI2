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

    }

    public function LoadModel($name){
        $path = MODELS.$name.'Model.php';
        $name .= 'Model';
        try{
            if(is_file($path)){
                require $path;
                $model = new $name;
            }else
                throw new Exception("Unable to open $name <br/>Path: $path");
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

    public function Create($data){

    }

    public function Read(){

    }

    public function Update(){

    }

    public function Delete($id){

    }
}