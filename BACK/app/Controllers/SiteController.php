<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Site;

/**
 * Contrôleur pour les actions de site
 */
class SiteController extends Controller {

    /**
     * Valider les données du site
     */
    private function validateSiteData($data) {
        $errors = [];
    
        if (empty($data['name']) || strlen($data['name']) > 255) {
            $errors[] = 'Le nom du site est invalide.';
        }
        if (empty($data['address']) || strlen($data['address']) > 255) {
            $errors[] = 'L\'adresse est invalide.';
        }
        if (!is_numeric($data['latitude']) || !is_numeric($data['longitude'])) {
            $errors[] = 'Les coordonnées sont invalides.';
        }
        if (!empty($data['url']) && !filter_var($data['url'], FILTER_VALIDATE_URL)) {
            $errors[] = 'L\'URL est invalide.';
        }
    
        return $errors;
    }

    /**
     * Ajouter un site
     */
    public function addSite() {
        $this->checkAuthenticated();
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!$this->validateCSRFToken($_POST['csrf_token'])) {
                echo json_encode(['status' => 'error', 'message' => 'Invalid CSRF token']);
                return;
            }

            $data = [
                'latitude' => $this->sanitizeInput($_POST['latitude']),
                'longitude' => $this->sanitizeInput($_POST['longitude']),
                'address' => $this->sanitizeInput($_POST['address']),
                'name' => $this->sanitizeInput($_POST['name']),
                'url' => $this->sanitizeInput($_POST['url']),
                'description' => $this->sanitizeInput($_POST['description'])
            ];
    
            $errors = $this->validateSiteData($data);
    
            if (!empty($errors)) {
                echo json_encode(['status' => 'error', 'errors' => $errors]);
                return;
            }
    
            $siteModel = new Site();
            $siteId = $siteModel->createSite($data);
    
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Méthode de requête non supportée']);
        }
    }

    /**
     * Afficher les détails d'un site
     */
    public function getSiteDetails() {
        if (!isset($_GET['site_id'])) {
            echo "Site non trouvé.";
            return;
        }
        
        $id = intval($_GET['site_id']);

        $siteModel = new Site();
        $site = $siteModel->getSiteById($id);
    
        if (!$site) {
            echo "Site non trouvé.";
            return;
        }
    
        $canEdit = false;
        if (isset($_SESSION['user_id'])) {
            if ($_SESSION['role'] === 'admin' || $siteModel->isOwner($id, $_SESSION['user_id'])) {
                $canEdit = true;
            }
        }
    
        ob_start();
        include __DIR__ . '/../Views/partials/site_details.php';
        $content = ob_get_clean();
    
        echo $content;
    }

    /**
     * Mettre à jour un site
     */
    public function update() {
        $id = intval($_GET['id']);
        $this->checkAuthenticated();
    
        $siteModel = new Site();
        if ($_SESSION['role'] !== 'admin' && !$siteModel->isOwner($id, $_SESSION['user_id'])) {
            echo json_encode(['status' => 'error', 'message' => 'Vous n\'êtes pas autorisé à modifier ce site']);
            return;
        }
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!$this->validateCSRFToken($_POST['csrf_token'])) {
                echo json_encode(['status' => 'error', 'message' => 'Invalid CSRF token']);
                return;
            }

            $data = [
                'latitude' => $this->sanitizeInput($_POST['latitude']),
                'longitude' => $this->sanitizeInput($_POST['longitude']),
                'address' => $this->sanitizeInput($_POST['address']),
                'name' => $this->sanitizeInput($_POST['name']),
                'url' => $this->sanitizeInput($_POST['url']),
                'description' => $this->sanitizeInput($_POST['description'])
            ];
    
            $errors = $this->validateSiteData($data);
    
            if (!empty($errors)) {
                echo json_encode(['status' => 'error', 'errors' => $errors]);
                return;
            }
    
            $siteModel->updateSite($id, $data);
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Méthode de requête non supportée']);
        }
    }

    public function searchSites() {
        $query = isset($_GET['q']) ? trim($_GET['q']) : '';
    
        $siteModel = new Site();
        $sites = $siteModel->searchSites($query);
    
        ob_start();
        include __DIR__ . '/../Views/partials/site_list.php';
        $content = ob_get_clean();
    
        echo json_encode(['status' => 'success', 'html' => $content]);
    }
}
