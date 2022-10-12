<?php

session_start();

// autoload composer
require __DIR__ . '/../vendor/autoload.php';

// Call AltoRouter
$router = new AltoRouter();

// Define the sub-folder
$router->setBasePath('/Projet-Bg-Cyleon/public');

// Map routes
//      administrative 1ere etape
$router->map('GET', '/', 'administrative#home', 'administrativeHome');
$router->map('GET', '/profil', 'administrative#profil', 'administrativeProfil');
//      loggin

$router->map('GET', '/connexion/[i:notification]?', 'loggin#connexion', 'logginConnexion');
$router->map('POST', '/connexion/traitement-connexion', 'loggin#connectionTreatment', 'logginConnectionTreatment');
$router->map('GET', '/connexion/mot-de-passe-oublie/[i:notification]?', 'loggin#forgivenPassword', 'logginForgivenPassword');
$router->map('POST', '/connexion/traitement-mot-de-passe-oublie', 'loggin#forgivenPasswordTreatment', 'logginForgivenPasswordTreatment');
$router->map('GET', '/inscription/[i:notification]?', 'loggin#inscription', 'logginInscription');
$router->map('POST', '/inscription/traitement-inscription', 'loggin#inscriptionTreatment', 'logginInscriptionTreatment');
$router->map('GET', '/modifier-mot-de-passe/[i:notification]?', 'loggin#modifyPassword', 'logginModifyPassword');
$router->map('POST', '/traitement-modification-mot-de-passe', 'loggin#modifyPasswordTreatment', 'logginModifyPasswordTreatment');
$router->map('GET', '/deconnexion', 'loggin#loginDeco', 'loginDeco');
//      appli

// Match routes Ici il voit dans quel url tu te trouve.
$match = $router->match();
var_dump($match);

// Verify if the route exists Voir si ton url exist. en verifiant si match est un tableau.
if(is_array($match)) 
{
	$controllerAction = explode('#', $match['target']);
    $controllerName = $controllerAction[0];
    $actionName = $controllerAction[1];
    $params = NULL;
    if(!empty($match['params'])) {
        $params = $match['params'];
        var_dump($match['params']);
    }
} else {
    // Run the 404 page on lui force le controllerName, actionName.
	$controllerName = 'administrative';
    $actionName = '404';
    $params = NULL;
}

// Call the abstracts class of controller and model
require_once('../app/Models/Model.php');
require_once('../app/Controllers/Controller.php');

$modelClassName = "Model_" . $controllerName;
$modelFileName = "../app/Models/" . $modelClassName . ".php";

// ../ car on part de l'index.

$controllerClassName = "Controller_" . $controllerName;
$controllerFileName = "../app/Controllers/" . $controllerClassName . ".php";

//Appel des affichages.

if(file_exists($modelFileName)) {
    require_once($modelFileName);
}
if(file_exists($controllerFileName)) {
    require_once($controllerFileName);
    $controller = new $controllerClassName($router, $controllerName, $actionName, $params);

} else {
    exit("Error 404 : not found");
}