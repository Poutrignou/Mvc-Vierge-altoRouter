<?php

class Controller_administrative extends Controller {

    public function action_default()
    {
        echo("la methode n'existe pas");
    }

    public function action_404() {
        $this->render('404');
    }

        public function action_home() {
            if(!isset($_SESSION['Id_user'])) {

                echo($this->router->generate('logginConnexion'));
                header("Location: " . $this->router->generate('logginConnexion'));
            } else {
                header("Location: " . $this->router->generate('appliDisplay'));
        }   
    }
    
    // public function action_profile() {
    //     if(!isset($_SESSION['Id_user'])) {
    //         header("Location: " . $this->router->genrerate('logginConnexion'));
    //     } else {
    //         $this->render("profil");
    //     }
    // }
}