<?php
defined('RUNNING') or die("Access violation");
require_once CONTROLLERS.'Controller.php';
/**
 * RouterController short summary.
 *
 * RouterController description.
 *
 * @version 1.0
 * @author Kamil
 */
class RouterController extends Controller
{
    private $module;
    private $action;
    private $param;
    public function __construct(){
        $uri = $_SERVER['REQUEST_URI'];
        $uriFrags = explode('/', $uri);
        $this->module = (isset($uriFrags[1])) ? $uriFrags[1] : null;
        $this->action = (isset($uriFrags[2])) ? $uriFrags[2] : null;
        $this->param = (isset($uriFrags[3])) ? $uriFrags[3] : null;
    }

    public function GetModule(){
        return $this->module;
    }

    public function GetAction(){
        return $this->action;
    }

    public function GetParam(){
        return $this->param;
    }
}