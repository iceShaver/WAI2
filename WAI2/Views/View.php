<?php

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

    protected function RenderPage($name, $output){
        $userBlock = HTML.'userBlock.html.php';
        $loginBlock = HTML.'loginBlock.html.php';

        $output['col2']['title'] =
            ($_SESSION['auth']->GetUserState() == UserType::USER || $_SESSION['auth']->GetUserState() == UserType::ADMIN)
            ? 'Witaj, '.$_SESSION['auth']->GetUserName()
            : 'Zaloguj się';

        $output['col2']['content'] = ($_SESSION['auth']->GetUserState() == UserType::USER || $_SESSION['auth']->GetUserState() == UserType::ADMIN)
            ? $userBlock
            : $loginBlock;

        $output['content']['content'] = HTML."$name.html.php";
        $output['col1']['title'] = 'Czas';
        if(isset($_POST['loginForm']))
            $output['loginForm']['userName'] = $_POST['loginForm']['userName'];
        else
            $output['loginForm']['userName'] = '';
        include TEMPLATES.'defaultTemplate.html.php';
        unset($_SESSION['messages']);
        unset($_SESSION['form']);

    }


}