<?php 

namespace Core;

class Router 
{
    public function route()
    {
        $url = $_SERVER['REQUEST_URI'];
        
        $url = strtok($url, '?');
        // exemple :
        // Pour l'url : /PHP_orphee_18/PHPoo/CRUD_bibliotheque/controller/methode/arg1/arg2?indice1=123&indice2=abc
        // On obtient : /PHP_orphee_18/PHPoo/CRUD_bibliotheque/controller/methode/arg1/arg2
        // echo '<pre>'; print_r($url); echo '</pre>';

        // Du fait d'être en local, on enlève le chemin qui nous amène à notre projet
        // A supprimer si le site est en prod
        if(strpos($url, '/orphee/POO/TP-CRUD') === 0) {
            $url = substr($url, strlen('/orphee/POO/TP-CRUD'));
            // echo '<pre>'; print_r($url); echo '</pre>';
            // /controller/methode/arg1/arg2
        }

        // On enlève le slash initial
        $url = ltrim($url, '/');
        // echo '<pre>'; print_r($url); echo '</pre>';

        $segments = explode('/', $url);
        // echo '<pre>'; print_r($segments); echo '</pre>';
        /*
            Array
            (
                [0] => controller
                [1] => methode
                [2] => arg1
                [3] => arg2
            )
        */

        // On vérifie si le nom du controller est présent dans l'url sinon un cas par défaut
        $controllerName = (isset($segments[0]) && $segments[0] != '') ? ucfirst($segments[0]) . 'Controller' : 'IndexController'; // 'IndexController
        // pareil pour la methode
        $methodName = (isset($segments[1]) && $segments[1] != '') ? $segments[1] : 'index';

        // On rajoute le namespace pour accéder au controller
        $controllerClass = "\\App\\Controller\\" . $controllerName;

        // Le chemin pour pouvoir le require (afin de pouvoir vérifier s'il existe)
        $controllerPath = "App/Controller/" . $controllerName . ".php"; 

        if( ! file_exists($controllerPath)) {
            // throw new \Exception('Class introuvable');
            $controllerClass = '\\App\\Controller\\IndexController';

        }

        $controller = new $controllerClass;

        // On vérifie si la methode existe
        if( ! method_exists($controller, $methodName)) {
            // throw new \Exception('methode introuvable');
            $methodName = 'index'; // cette methode sera appelée par défaut si non précisée dans l'url ou si la methode dans l'url n'existe pas
            // Il sera donc important que tous nos controller possèdent une methode index
        }
        
        // array_slice() supprime les éléments du tableau et nous renvoie tout depuis l'indice 2
        $params = array_slice($segments, 2);
        // echo '<pre>'; print_r($params); echo '</pre>';
        /*
            Array
            (
                [0] => arg1
                [1] => arg2
            )
        */

        // On déclenche
        call_user_func_array([$controller, $methodName], $params);
    }
}