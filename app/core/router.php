<?php
$routes = [
    '/' => [
        'controller' => 'authController',
        'action' => 'login'
    ],
    '/notes/saisie' => [
        'controller' => 'eleveController',
        'action' => 'afficherNotes'
    ],
    '/login' => [
        'controller' => 'authController',
        'action' => 'login'
    ],
    '/logout' => [
        'controller' => 'authController',
        'action' => 'logout'
    ]
];

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$basePath = '/gestion_note/Code/public';
$uri = str_replace($basePath, '', $uri);
if (empty($uri)) $uri = '/';

if (isset($routes[$uri])) {
    $controller = $routes[$uri]['controller'];
    $action = $routes[$uri]['action'];
    
    $controllerFile = dirname(__DIR__) . "/controller/$controller.php";
    if (file_exists($controllerFile)) {
        require_once $controllerFile;
        if (function_exists($action)) {
            $action();
        } else {
            http_response_code(500);
            echo "Erreur: Action '$action' non trouvée";
        }
    } else {
        http_response_code(404);
        echo "Erreur: Contrôleur '$controller' non trouvé";
    }
} else {
    http_response_code(404);
    echo "Page introuvable";
}
?>