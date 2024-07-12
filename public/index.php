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
      '/projet/[:id]',
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
      '/bo-projet/[i:id]',
      [
        'controller' => 'ProjectController',
        'method' => 'boProject',
      ],
      'bo-projet',
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
      'POST',
      '/bo-ajouter-projet',
      [
        'controller' => 'ProjectController',
        'method' => 'addProject',
      ],
    ],
    [
      'GET',
      '/bo-editer-projet/[i:id]',
      [
        'controller' => 'ProjectController',
        'method' => 'editProject',
      ],
      'bo-editer-projet'
    ],
    [
      'POST',
      '/bo-editer-projet/[i:id]',
      [
        'controller' => 'ProjectController',
        'method' => 'updateProject',
      ],
      'bo-update-projet'
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
      'POST',
      '/connexion',
      [
        'controller' => 'ConnectController',
        'method' => 'page',
      ],
      'connexion-post',
    ],
    [
      'GET',
      '/technologies',
      [
        'controller' => 'LanguageController',
        'method' => 'technologies',
      ],
      'technologies',
    ],
    [
      'GET',
      '/bo-ajouter-technologie',
      [
        'controller' => 'LanguageController',
        'method' => 'addTechnoPage',
      ],
      'bo-ajouter-technologie',
    ],
    [
      'POST',
      '/bo-ajouter-technologie',
      [
        'controller' => 'LanguageController',
        'method' => 'addTechno',
      ],
    ],
    [
      'GET',
      '/bo-editer-technologie/[i:id]',
      [
        'controller' => 'LanguageController',
        'method' => 'editTechno',
      ],
      'bo-editer-technologie'
    ],
    [
      'POST',
      '/bo-editer-technologie/[i:id]',
      [
        'controller' => 'LanguageController',
        'method' => 'updateTechno',
      ],
      'bo-update-technologie'
    ],
    [
      'GET',
      '/bo-technos',
      [
        'controller' => 'LanguageController',
        'method' => 'boTechnos',
      ],
      'bo-technos',
    ],
    [
      'DELETE',
      '/bo-delete--technos/[i:id]',
      [
        'controller' => 'LanguageController',
        'method' => 'boDeleteTechnos',
      ],
      'bo-delete-technos',
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
    [
      'GET',
      '/bo-editer-organisation/[i:id]',
      [
        'controller' => 'OrgaController',
        'method' => 'editOrga',
      ],
      'bo-editer-organisation'
    ],
    [
      'POST',
      '/bo-editer-organisation/[i:id]',
      [
        'controller' => 'OrgaController',
        'method' => 'updateOrganization',
      ],
      'bo-update-organisation'
    ],
    [
      'POST',
      '/bo-ajouter-organisation',
      [
        'controller' => 'OrgaController',
        'method' => 'addOrga',
      ],
    ],
  ]
);
// var_dump('router', $router);
$match = $router->match();
// var_dump('match', $match);

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
