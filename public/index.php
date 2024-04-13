<?php

// We ask to required a fil in vendro folder to use our routing

use App\Controllers\CoreController;

require __DIR__.'/../vendor/autoload.php';

$router = new AltoRouter();
// You can use setBatchPath method, to set the path. If your project needed. Here,we can not use it. I leave it for example.
$router->setBasePath('');

// echo 'test';

$router->map(
    'GET', // HTTP method
    '/', // url of the route, for routing
    // An array with our controller and method to use
    [
        'controller'=>'MainController',
        'method' => 'home',
    ],
    // 'MainController#home',
    'home', // named route
);
$router->map(
  'GET',
  '/cv',
  [
      'controller'=>'MainController',
      'method' => 'cv',
  ],
  'cv',
);
$router->map(
  'GET',
  '/projets',
  [
      'controller'=>'ProjectController',
      'method' => 'projects',
  ],
  'projets',
);
$router->map(
  'GET',
  '/projet',
  [
      'controller'=>'ProjectController',
      'method' => 'project',
  ],
  'projet',
);

$router->map(
  'GET',
  '/connexion',
  [
      'controller'=>'ConnectController',
      'method' => 'page',
  ],
  'connexion',
);

$router->map(
  'GET',
  '/technologies',
  [
      'controller'=>'TechnoController',
      'method' => 'technologies',
  ],
  'technologies',
);

$router->map(
  'GET',
  '/bo-accueil',
  [
      'controller'=>'MainController',
      'method' => 'boHome',
  ],
  'bo-accueil',
);

$router->map(
  'GET',
  '/bo-projets',
  [
      'controller'=>'ProjectController',
      'method' => 'boProjects',
  ],
  'bo-projets',
);

// dump($router);
/* the dump on method GET on / url
 ^ AltoRouter {#3 ▼
     #routes: array:1 [▼
       0 => array:4 [▼
         0 => "GET"
         1 => "/"
         2 => array:2 [▶]
         3 => "home"
       ]
     ]
     #namedRoutes: array:1 [▼
       "home" => "/"
     ]
     #basePath: ""
     #matchTypes: array:6 [▼
       "i" => "[0-9]++"
       "a" => "[0-9A-Za-z]++"
       "h" => "[0-9A-Fa-f]++"
       "*" => ".+?"
       "**" => ".++"
       "" => "[^/\.]++"
     ]
   } */


$match = $router->match();
dump($match);
/* the dump on method GET on / url
 array:3 [▼
 "target" => array:2 [▼
   "controller" => "MainController"
   "method" => "home"
 ]
 "params" => []
 "name" => "home"
 ] */



if($match !== false)
{
    // We retreive the controller that matched, from the $match array
    $controllerMatch = 'App\Controllers\\' . $match['target']['controller'];
    // We retrieve the methode that matched, from the $match array
    $method = $match['target']['method'];
    // We retreive the params that matched, from the $match array
    $params = $match['params'];

    // We create our object controller
    // $controller = new $controllerMatch;
    // dump($controller);
    // And we call the method 
    // $controller->$method($params);
    // Instance of CoreController
    
    $controller = new $controllerMatch($router);
    dump($controller);
    $controller->$method($match['params']);

} else {
    echo "Erreur 404, la page n'existe pas, contacte moi";
}

