<?php
defined('RUNNING') or die("Access violation");
require_once 'Views/View.php';

/**
 * defaultView short summary.
 *
 * defaultView description.
 *
 * @version 1.0
 * @author Kamil
 */
class defaultView extends View
{
    public function DisplayMain(){
        $output['page']['title'] = "Strona główna";
        $output['content']['title'] = 'Strona główna';
        $this->RenderPage('Templates/'.TEMPLATE.'/main.html.php', $output);
    }

    public function DisplayError(){
        $output['page']['title'] = "Blank";
        $output['content']['title'] = 'Blank';
        $this->RenderPage('Templates/'.TEMPLATE.'/error.html.php', $output);
    }
}