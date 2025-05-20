<?php
session_start();
// We ask to required a fil in vendro folder to use our routing

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
        'method' => 'display_home_page',
      ],
      'display_home_page',
    ],
    [
      'GET',
      '/cv',
      [
        'controller' => 'MainController',
        'method' => 'display_cv_page',
      ],
      'display_cv_page',
    ],
    [
      'GET',
      '/projets',
      [
        'controller' => 'ProjectController',
        'method' => 'display_projects_page',
      ],
      'projets',
    ],
    [
      'GET',
      '/projet/[:id]',
      [
        'controller' => 'ProjectController',
        'method' => 'display_project_page',
      ],
      'projet',
    ],
    [
      'GET',
      '/enregistrement',
      [
        'controller' => 'AuthController',
        'method' => 'display_login_page',
      ],
      'enregistrement',
    ],
    [
      'POST',
      '/enregistrement',
      [
        'controller' => 'AuthController',
        'method' => 'create_new_account',
      ],
      'createAccount',
    ],
    [
      'GET',
      '/connexion',
      [
        'controller' => 'AuthController',
        'method' => 'connect_page',
      ],
      'connexion',
    ],
    [
      'POST',
      '/admin-accueil',
      [
        'controller' => 'AuthController',
        'method' => 'sign_in_back_office',
      ],
      'admin-connexion',
    ],
    [
      'GET',
      '/languages',
      [
        'controller' => 'LanguageController',
        'method' => 'display_languages_page',
      ],
      'languages',
    ],
  ]
);

// require __DIR__ . '/../bootstrap.php';

/* This routes are protected by session from PHP */
// dump('3', $_SESSION);
if (isset($_COOKIE['PHPSESSID'])) {
  $router->addRoutes(
    [
      [
        'GET',
        '/admin-accueil',
        [
          'controller' => 'MainController',
          'method' => 'display_admin_home_page',
        ],
        'admin-accueil',
      ],
      [
        'GET',
        '/admin-projets',
        [
          'controller' => 'ProjectController',
          'method' => 'display_admin_projects',
        ],
        'admin-projets',
      ],
      [
        'GET',
        '/admin-projet/[i:id]',
        [
          'controller' => 'ProjectController',
          'method' => 'display_admin_project',
        ],
        'admin-projet',
      ],
      [
        'GET',
        '/admin-ajouter-projet',
        [
          'controller' => 'ProjectController',
          'method' => 'display_admin_add_project_page',
        ],
        'admin-ajouter-projet',
      ],
      [
        'POST',
        '/admin-ajouter-projet',
        [
          'controller' => 'ProjectController',
          'method' => 'add_a_project',
        ],
      ],
      [
        'GET',
        '/admin-editer-projet/[i:id]',
        [
          'controller' => 'ProjectController',
          'method' => 'display_admin_edit_project_page',
        ],
        'admin-editer-projet'
      ],
      [
        'POST',
        '/admin-editer-projet/[i:id]',
        [
          'controller' => 'ProjectController',
          'method' => 'update_a_project',
        ],
        'admin-update-projet'
      ],
      [
        'GET',
        '/admin-ajouter-technologie',
        [
          'controller' => 'LanguageController',
          'method' => 'display_add_languages_page',
        ],
        'admin-ajouter-technologie',
      ],
      [
        'POST',
        '/admin-ajouter-technologie',
        [
          'controller' => 'LanguageController',
          'method' => 'add_a_languages',
        ],
      ],
      [
        'GET',
        '/admin-editer-technologie/[i:id]',
        [
          'controller' => 'LanguageController',
          'method' => 'display_edit_languages_page',
        ],
        'admin-editer-technologie'
      ],
      [
        'POST',
        '/admin-editer-technologie/[i:id]',
        [
          'controller' => 'LanguageController',
          'method' => 'update_a_language',
        ],
        'admin-update-technologie'
      ],
      [
        'GET',
        '/admin-technos',
        [
          'controller' => 'LanguageController',
          'method' => 'display_admin_languages_page',
        ],
        'admin-technos',
      ],
      [
        'DELETE',
        '/admin-delete--technos/[i:id]',
        [
          'controller' => 'LanguageController',
          'method' => 'admin_delete_languages',
        ],
        'admin-delete-technos',
      ],
      [
        'GET',
        '/admin-organisations',
        [
          'controller' => 'OrgaController',
          'method' => 'display_organizations_page',
        ],
        'admin-organisations',
      ],
      [
        'GET',
        '/admin-organisation/[i:id]',
        [
          'controller' => 'OrgaController',
          'method' => 'display_organization_page',
        ],
        'admin-organisation',
      ],
      [
        'GET',
        '/admin-ajouter-organisation',
        [
          'controller' => 'OrgaController',
          'method' => 'display_add_organization_page',
        ],
        'admin-ajouter-organisation',
      ],
      [
        'GET',
        '/admin-editer-organisation/[i:id]',
        [
          'controller' => 'OrgaController',
          'method' => 'display_edit_an_organization_page',
        ],
        'admin-editer-organisation'
      ],
      [
        'POST',
        '/admin-editer-organisation/[i:id]',
        [
          'controller' => 'OrgaController',
          'method' => 'update_an_organization',
        ],
        'admin-update-organisation'
      ],
      [
        'POST',
        '/admin-ajouter-organisation',
        [
          'controller' => 'OrgaController',
          'method' => 'add_an_organization',
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
