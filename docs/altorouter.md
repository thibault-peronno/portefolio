# Altorouter

## Instalation

Go on packagiste to install on your project with composer
[packegiste](https://packagist.org/packages/altorouter/altorouter)

You need to read the documentation of Altorouter
[Altorouter](https://dannyvankooten.github.io/AltoRouter/)

## Fichier de routage

```php
 $router->map(
   'GET', // HTTP method
   '/', // url of the route, for routing
   // An array with our controller and method to use
   [
     'controller' => 'MainController',
     'method' => 'home',
   ],
   // 'MainController#home',
   'home', // named route
 );
 $router->map(
   'GET',
   '/cv',
   [
     'controller' => 'MainController',
     'method' => 'cv',
   ],
   'cv',
 );
 $router->map(
   'GET',
   '/projets',
   [
     'controller' => 'ProjectController',
     'method' => 'projects',
   ],
   'projets',
 );


/**
 * This way, does not work in our router file. But you can find this way on documentation
 * $router->map(
 *   'GET', '/bo-ajouter-technologie', 'LanguageController#addTechnoPage', 'bo-ajouter-technologie',
 * );
 */

dump($router);
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

/**
 * If $match method from altorouter does not find the route, you have false. So we add a condition.
 * if the match is ok, we store in variable, the controller, the method and the params.
 */
if ($match !== false) {
  // We retreive the controller that matched, from the $match array
  $controllerMatch = 'App\Controllers\\' . $match['target']['controller'];
  // We retrieve the methode that matched, from the $match array
  $method = $match['target']['method'];
  // We retreive the params that matched, from the $match array
  $params = $match['params'];
/**
 * Here is when you use global to call $router variable
 *
 * We create our object controller
 * $controller = new $controllerMatch;
 * dump($controller);
 * And we call the method
 * $controller->$method($params);
 * Instance of CoreControlleralso, because it is extends.

 */

  $controller = new $controllerMatch($router);
  dump($controller);
  $controller->$method($match['params']);
} else {
  echo "Erreur 404, la page n'existe pas, contacte moi";
}
```

### Group your routes

```php
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
  ]
);
```
