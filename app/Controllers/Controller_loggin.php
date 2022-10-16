<?php

class Controller_loggin extends Controller {

    public function action_default()
    {
        echo("la methode n`\'hesiste pas");
    }

    	/**
	 * Connection form display
	 */

    public function action_connexion($params = NULL) {
        if(!isset($_SESSION['Id_user'])) {
            $message = "";
            if(isset($params['notifications'])){
                
                $notifications = $this->validateData($params['notifications']);
                switch($notifications) {
                    case 1;
                    $message = '<p class="form_error"> Le formulaire n\'est pas complété correctement. ';
                    break;
                    case 2;
                    $message = '<p class="form_error"> L\'adresse mail ou le mot de passe n\'est pas correcte.';
                    break;
                    case 3;
                    $message = '<p class="form_error"> Un nouveau mot de passe vous a été envoyé. ';
                    break;
                }
            }
            $data['message'] = $message;
            $this->render('connexion', $data);
        } else {
            header("Location" . $this->router->generate('appliDisplay'));
        }
    }


    /**
      * Disconnexion
      */

    public function action_deconnexion() {
        if (isset($_SESSION['Id_user'])) {
            session_destroy();
        } else {
            header("Location" .$this->route->generate('logginConnection'));
        }
    }

}