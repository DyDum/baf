<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Site;

/**
 * Contrôleur pour les actions de la carte
 */
class MapController extends Controller {

    /* Afficher la carte avec les sites
     */
    public function index() {
        $siteModel = new Site();
        $sites = $siteModel->getAllSites();
        $this->render('map', ['sites' => $sites]);
    }
}
