public function action_default() {
    echo("la metthode n'existe pas.");
}

public function action_404() {
    $this->render('404');
}

// on crée la function acttion_home() si l utilisateur est enregisté, on redirige vers login sinon vers l app

public function action_home() {
    if(!isset($_SESSION['Id_user'])) {
        header("Location" . $this->router->generate('logginConnexion'));
    }else {
        header("Location" . $this->router->generate('appDisplay'));
    }
}

// si l utilisateur n est pas co alors on le redirige vers la page de connexion, sinon il peut choisir de rentrer dans la view profile

public function action_profile() {
        if(!isset($SESSION['Id_user']))  {
            header("Location:" . $this->router->generate('logginConnexion'));
        } else {
            $this->render('profil');
        }
    }

Pour generer un params avec un integer on utilise cette syntaxe.


    header("Location: " . $this->router->generate('logginInscription', ['notification' => 4]));