<?php
require_once 'Views/View.php';
/**
 * SearchEngineView short summary.
 *
 * SearchEngineView description.
 *
 * @version 1.0
 * @author Kamil
 */
class SearchEngineView extends View
{
    public function DisplaySearchDialog(){
        $output['page']['title'] = "Szukaj";
        $output['content']['title'] = "Szukaj zdjêæ";
        $this->RenderPage('SearchEngine/searchDialog.html.php', $output);
    }
}