<?php

/**
 * PictureData short summary.
 *
 * PictureData description.
 *
 * @version 1.0
 * @author Kamil
 */
class Picture
{

    public $_id;
    public $minId;
    public $wmId;
    public $extension;
    public $size;
    public $title;
    public $description;
    public $author;
    public $watermark;
    public $creationTime;
    public $lastEditTime;
    public $private;


    public function __construct($_id, $minId, $wmId, $extension,$size, $title, $description, $author, $watermark, $creationTime, $lastEditTime, $private){
        $this->_id = $_id;
        $this->minId = $minId;
        $this->wmId = $wmId;
        $this->extension = $extension;
        $this->size = $size;
        $this->title = $title;
        $this->description = $description;
        $this->author = $author;
        $this->watermark = $watermark;
        $this->creationTime = $creationTime;
        $this->lastEditTime = $lastEditTime;
        $this->private = $private;
    }

}