<?php
defined('RUNNING') or die("Access violation");
require_once CONTROLLERS.'Controller.php';

/**
 * SearchEngineController short summary.
 *
 * SearchEngineController description.
 *
 * @version 1.0
 * @author Kamil
 */
class SearchEngineController extends Controller
{
    public function DefaultAction(){
        $this->DisplaySearchDialog();
    }

    public function DisplaySearchDialog(){
        $view = $this->LoadView("SearchEngine");
        $view->DisplaySearchDialog();
    }

}