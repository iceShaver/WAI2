<?php
defined('RUNNING') or die("Access violation");

/**
 * View short summary.
 *
 * View description.
 *
 * @version 1.0
 * @author Kamil
 */
abstract class View
{



    protected function LoadModel($modelName){
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

    protected function RenderPage($htmlFile, $output){
        $userBlock = HTML.'Auth/userBlock.html.php';
        $loginBlock = HTML.'Auth/loginBlock.html.php';

        $output['col2']['title'] =
            (determineAuthorisationAtLeast(UserType::USER))
            ? 'Witaj, '.$_SESSION['auth']->GetUserName()
            : 'Zaloguj się';

        $output['col2']['content'] = (determineAuthorisationAtLeast(UserType::USER))
            ? $userBlock
            : $loginBlock;

        $output['content']['content'] = HTML.$htmlFile;
        $output['col1']['title'] = 'Czas';
        if(isset($_POST['loginForm']))
            $output['loginForm']['userName'] = $_POST['loginForm']['userName'];
        else
            $output['loginForm']['userName'] = '';
        include TEMPLATE_DIR.TEMPLATE.'.html.php';
        unset($_SESSION['messages']);
        unset($_SESSION['form']);

    }


}