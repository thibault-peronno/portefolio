<?php
session_start();
// We ask to required a fil in vendro folder to use our routing


use App\Controllers\CoreController;

require __DIR__ . '/../vendor/autoload.php';
require './php.ini';

$router = new AltoRouter();
// You can use setBatchPath method, to set the path. If your project needed. Here,we can not use it. I leave it for example.
$router->setBasePath('');

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
      '/projets',
      [
        'controller' => 'ProjectController',
        'method' => 'getProjects',
      ],
      'projets',
    ],
    [
      'GET',
      '/projet/[:id]',
      [
        'controller' => 'ProjectController',
        'method' => 'getProject',
      ],
      'projet',
    ],
    [
      'GET',
      '/enregistrement',
      [
        'controller' => 'ConnectController',
        'method' => 'loginPage',
      ],
      'enregistrement',
    ],
    [
      'POST',
      '/enregistrement',
      [
        'controller' => 'ConnectController',
        'method' => 'signIn',
      ],
      'createAccount',
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
        'method' => 'logToBackOffice',
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
  ]
);

// require __DIR__ . '/../bootstrap.php';

/* This routes are protected by session from PHP */
if (isset($_COOKIE['PHPSESSID']) && $_SESSION['user_id']) {
  $router->addRoutes(
    [
      [
        'GET',
        '/admin-accueil',
        [
          'controller' => 'MainController',
          'method' => 'boHome',
        ],
        'admin-accueil',
      ],
      [
        'GET',
        '/admin-projets',
        [
          'controller' => 'ProjectController',
          'method' => 'adminGetProjects',
        ],
        'admin-projets',
      ],
      [
        'GET',
        '/admin-projet/[i:id]',
        [
          'controller' => 'ProjectController',
          'method' => 'adminGetProject',
        ],
        'admin-projet',
      ],
      [
        'GET',
        '/admin-ajouter-projet',
        [
          'controller' => 'ProjectController',
          'method' => 'addProjectPage',
        ],
        'admin-ajouter-projet',
      ],
      [
        'POST',
        '/admin-ajouter-projet',
        [
          'controller' => 'ProjectController',
          'method' => 'addProject',
        ],
      ],
      [
        'GET',
        '/admin-editer-projet/[i:id]',
        [
          'controller' => 'ProjectController',
          'method' => 'editProject',
        ],
        'admin-editer-projet'
      ],
      [
        'POST',
        '/admin-editer-projet/[i:id]',
        [
          'controller' => 'ProjectController',
          'method' => 'updateProject',
        ],
        'admin-update-projet'
      ],
      [
        'GET',
        '/admin-ajouter-technologie',
        [
          'controller' => 'LanguageController',
          'method' => 'addTechnoPage',
        ],
        'admin-ajouter-technologie',
      ],
      [
        'POST',
        '/admin-ajouter-technologie',
        [
          'controller' => 'LanguageController',
          'method' => 'addTechno',
        ],
      ],
      [
        'GET',
        '/admin-editer-technologie/[i:id]',
        [
          'controller' => 'LanguageController',
          'method' => 'editTechno',
        ],
        'admin-editer-technologie'
      ],
      [
        'POST',
        '/admin-editer-technologie/[i:id]',
        [
          'controller' => 'LanguageController',
          'method' => 'updateTechno',
        ],
        'admin-update-technologie'
      ],
      [
        'GET',
        '/admin-technos',
        [
          'controller' => 'LanguageController',
          'method' => 'boTechnos',
        ],
        'admin-technos',
      ],
      [
        'DELETE',
        '/admin-delete--technos/[i:id]',
        [
          'controller' => 'LanguageController',
          'method' => 'boDeleteTechnos',
        ],
        'admin-delete-technos',
      ],
      [
        'GET',
        '/admin-organisations',
        [
          'controller' => 'OrgaController',
          'method' => 'organizations',
        ],
        'admin-organisations',
      ],
      [
        'GET',
        '/admin-organisation/[i:id]',
        [
          'controller' => 'OrgaController',
          'method' => 'organization',
        ],
        'admin-organisation',
      ],
      [
        'GET',
        '/admin-ajouter-organisation',
        [
          'controller' => 'OrgaController',
          'method' => 'addOrgaPage',
        ],
        'admin-ajouter-organisation',
      ],
      [
        'GET',
        '/admin-editer-organisation/[i:id]',
        [
          'controller' => 'OrgaController',
          'method' => 'editOrga',
        ],
        'admin-editer-organisation'
      ],
      [
        'POST',
        '/admin-editer-organisation/[i:id]',
        [
          'controller' => 'OrgaController',
          'method' => 'updateOrganization',
        ],
        'admin-update-organisation'
      ],
      [
        'POST',
        '/admin-ajouter-organisation',
        [
          'controller' => 'OrgaController',
          'method' => 'addOrga',
        ],
      ],
    ]
  );
}

// var_dump('router', $router);
$match = $router->match();
// var_dump('match', $match);

if ($match !== false) {

  $controllerMatch = 'App\Controllers\\' . $match['target']['controller'];
  $method = $match['target']['method'];
  $params = $match['params'];
  $controller = new $controllerMatch($router);

  $controller->$method($match['params']);
} else {
  echo "Erreur 404, la page n'existe pas, contacte moi";
}
