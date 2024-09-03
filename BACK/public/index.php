<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Router;
use App\Controllers\MapController;
use App\Controllers\AuthController;
use App\Controllers\AdminController;
use App\Controllers\SiteController;

session_start();

$router = new Router();

// Routes pour la carte
$router->add('/', [new MapController(), 'index']);
$router->add('/add-site', [new SiteController(), 'addSite']);

// Routes pour l'authentification
$router->add('/login', [new AuthController(), 'login']);
$router->add('/register', [new AuthController(), 'register']);
$router->add('/logout', [new AuthController(), 'logout']);

// Routes pour les sites
$router->add('/sites', [new AdminController(), 'manageSites']);
$router->add('/sites/search', [new SiteController(), 'searchSites']);
$router->add('/site/details', [new SiteController(), 'getSiteDetails']);
$router->add('/site/update', [new SiteController(), 'update']);

// Routes pour les administrateurs
$router->add('/admin/users', [new AdminController(), 'users']);
$router->add('/admin/update-role', [new AdminController(), 'updateRole']);

/// Route pour gerer les infos de sites
$router->add('/admin/site/edit', [new AdminController(), 'editSite']);
$router->add('/admin/site/manage-owners', [new AdminController(), 'manageOwners']);
$router->add('/admin/site/add-owner', [new AdminController(), 'addOwner']);
$router->add('/admin/site/remove-owner', [new AdminController(), 'removeOwner']);
$router->add('/admin/users/search', [new AdminController(), 'searchUsers']);
$router->add('/admin/users/autocomplete', [new AdminController(), 'autocompleteUsers']);

$router->run();
