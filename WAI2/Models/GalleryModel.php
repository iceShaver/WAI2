<?php
require MODELS.'Model.php';
/**
 * Gallery short summary.
 *
 * Gallery description.
 *
 * @version 1.0
 * @author Kamil
 */
class GalleryModel extends Model
{
    private $db;
    private $collection;
    public function GetAll(){
        $this->db = $this->dbConnection->Gallery;
        if(DEBUG) echo 'Successfully selected database Gallery<br/>';

    }

    public function Create($data){
        $this->db = $this->dbConnection->Gallery;
        if(DEBUG) echo 'Database Gallery selected<br/>';
        $this->collection = $this->db->createCollection("Photos");
        if(DEBUG) echo 'Collection Photos created/selected<br/>';
        $this->collection->insert($data);
        if(DEBUG) echo 'Inserted data to db<br/>';

    }

    public function Read(){

    }

    public function Update(){

    }

    public function Delete($id){

    }

}