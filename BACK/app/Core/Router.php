<?php

namespace App\Core;

/**
 * Classe pour le routage
 */
class Router {
    private $routes = [];

    /**
     * Ajouter une route
     *
     * @param string $route
     * @param callable $callback
     */
    public function add($route, $callback) {
        $this->routes[$route] = $callback;
    }

    /**
     * Exécuter le routage
     */
    public function run() {
        $url = $_SERVER['REQUEST_URI'];
        $url = strtok($url, '?'); // Pour enlever les paramètres GET

        // Exclure les fichiers statiques (css, js) du routage
        if (preg_match('/\.(?:css|js|png|jpg|jpeg|gif)$/', $url)) {
            return false; // Laisser le serveur web gérer les fichiers statiques
        }

        foreach ($this->routes as $route => $callback) {
            if ($url === $route) {
                call_user_func($callback);
                return;
            }
        }

        // 404 - Not Found
        http_response_code(404);
        echo "404 - Page not found";
    }
}
