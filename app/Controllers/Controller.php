<?php

abstract class Controller {

    private $subFolderView = ""; // sous dossier dans view
    protected $basePath = "http://localhost/Projet-Bg-Cyleon/public/";
    protected $router;

    abstract public function action_default();

    public function __construct($routerAlto, $controllerName, $actionName, $params) {
        //check into class or object if method exists.
        if(method_exists($this, "action_" . $actionName)){
        //On recupére le nom du controller (ex app) auquel on ajoute le '/' pour s'en servir comme nom de dossier.
        //par exemple le controller_loggin va permettre de créer le loggin/ dont on va se servir pour créer des routes (exemple dans le render)
            $this->subFolderView = $controllerName . "/";
            $this->router = $routerAlto;
            $action = "action_" . $actionName;
            // $params est envoyé par $match(params, target , name)
            if(!empty($params)) {
                $this->$action($params);
            } else {
                $this->$action();
            }
        } else {
            $this->action_default();
        }
    }

    protected function render($vue, $data=[]) {
        $router = $this->router;
        extract($data);
        $fileName = "../app/Views/" . $this->subFolderView . "view_" . $vue . ".php";
        if(file_exists($fileName)) {
            require($fileName);
            require("../app/Utils/layout.php");
        } else {
            $this->action_error("Pas de vue");
        }
    }
    

    protected function action_error($message) {
        $this->subFolderView = "";
        $data = ['error'=>$message];
        $this->render('error', $data);
        die();
    }

    Protected function validateData($data, $type="") {

        $data = trim($data); // remove space and some characters if defined  in arguments
        $data = stripslashes($data); // remove slashes 
        $data = htmlspecialchars($data); // let html tags be write narmally
        if($type === 'email') {
            $data = filter_var($data, FILTER_SANITIZE_EMAIL); //filter a var with a specific filter.
        } 
        return $data;
    }
}