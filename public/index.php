<?php

// We ask to required a fil in vendro folder to use our routing

use App\Controllers\CoreController;

require __DIR__ . '/../vendor/autoload.php';

$router = new AltoRouter();
// You can use setBatchPath method, to set the path. If your project needed. Here,we can not use it. I leave it for example.
$router->setBasePath('');

// echo 'test';

$router->addRoutes(
  [
    [
      'GET',
      '/',
      [
        'controller' => 'MainController',
        'method' => 'home',
      ],
      'home',
    ],
    [
      'GET',
      '/cv',
      [
        'controller' => 'MainController',
        'method' => 'cv',
      ],
      'cv',
    ],
    [
      'GET',
      '/bo-accueil',
      [
        'controller' => 'MainController',
        'method' => 'boHome',
      ],
      'bo-accueil',
    ],
    [
      'GET',
      '/projets',
      [
        'controller' => 'ProjectController',
        'method' => 'projects',
      ],
      'projets',
    ],
    [
      'GET',
      '/projet',
      [
        'controller' => 'ProjectController',
        'method' => 'project',
      ],
      'projet',
    ],
    [
      'GET',
      '/bo-projets',
      [
        'controller' => 'ProjectController',
        'method' => 'boProjects',
      ],
      'bo-projets',
    ],
    [
      'GET',
      '/bo-ajouter-projet',
      [
        'controller' => 'ProjectController',
        'method' => 'addProjectPage',
      ],
      'bo-ajouter-projet',
    ],
    [
      'GET',
      '/connexion',
      [
        'controller' => 'ConnectController',
        'method' => 'page',
      ],
      'connexion',
    ],
    [
      'GET',
      '/technologies',
      [
        'controller' => 'TechnoController',
        'method' => 'technologies',
      ],
      'technologies',
    ],
    [
      'GET',
      '/bo-ajouter-technologie',
      [
        'controller' => 'TechnoController',
        'method' => 'addTechnoPage',
      ],
      'bo-ajouter-technologie',
    ],
    [
      'GET',
      '/bo-technos',
      [
        'controller' => 'TechnoController',
        'method' => 'botechnos',
      ],
      'bo-technos',
    ],
    [
      'GET',
      '/bo-organisation',
      [
        'controller' => 'OrgaController',
        'method' => 'organization',
      ],
      'bo-organisation',
    ],
    [
      'GET',
      '/bo-ajouter-organisation',
      [
        'controller' => 'OrgaController',
        'method' => 'addOrgaPage',
      ],
      'bo-ajouter-organisation',
    ],
  ]
);

$match = $router->match();
// dump($match);

if ($match !== false) {

  $controllerMatch = 'App\Controllers\\' . $match['target']['controller'];
  $method = $match['target']['method'];
  $params = $match['params'];
  $controller = new $controllerMatch($router);
  // dump($controller);
  $controller->$method($match['params']);
} else {
  echo "Erreur 404, la page n'existe pas, contacte moi";
}
