<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Router;
use App\Controllers\MapController;
use App\Controllers\AuthController;
use App\Controllers\AdminController;
use App\Controllers\SiteController;

session_start();

$router = new Router();
$route = (include(__DIR__ . '/../config/config.php'))['base_url'];
var_dump($route);
// Routes pour la carte
$router->add($route.'', [new MapController(), 'index']);
$router->add($route.'add-site', [new SiteController(), 'addSite']);
$router->add($route.'getsite', [new SiteController(), 'addSite']);

// Routes pour l'authentification
$router->add($route.'login', [new AuthController(), 'login']);
$router->add($route.'register', [new AuthController(), 'register']);
$router->add($route.'logout', [new AuthController(), 'logout']);

// Routes pour les sites
$router->add($route.'sites', [new AdminController(), 'manageSites']);
$router->add($route.'sites/search', [new SiteController(), 'searchSites']);
$router->add($route.'site/details', [new SiteController(), 'getSiteDetails']);
$router->add($route.'site/update', [new SiteController(), 'update']);

// Routes pour les administrateurs
$router->add($route.'admin/users', [new AdminController(), 'users']);
$router->add($route.'admin/update-role', [new AdminController(), 'updateRole']);

/// Route pour gerer les infos de sites
$router->add($route.'admin/site/edit', [new AdminController(), 'editSite']);
$router->add($route.'admin/site/manage-owners', [new AdminController(), 'manageOwners']);
$router->add($route.'admin/site/add-owner', [new AdminController(), 'addOwner']);
$router->add($route.'admin/site/remove-owner', [new AdminController(), 'removeOwner']);
$router->add($route.'admin/users/search', [new AdminController(), 'searchUsers']);
$router->add($route.'admin/users/autocomplete', [new AdminController(), 'autocompleteUsers']);

$router->run();
