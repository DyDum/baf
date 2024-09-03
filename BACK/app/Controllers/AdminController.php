<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;
use App\Models\Site;

/**
 * Contrôleur pour les actions d'administration
 */
class AdminController extends Controller {
    /**
     * Afficher la liste des utilisateurs
     */
    public function users() {
        // Vérifier si l'utilisateur est un administrateur avant d'autoriser l'accès à cette page
        $this->checkAdmin();

        $userModel = new User();
        $users = $userModel->getAllUsers();
        $this->render('admin_users', ['users' => $users]);
    }

    /**
     * Mettre à jour le rôle d'un utilisateur
     */
    public function updateRole() {
        // Vérifier si l'utilisateur est un administrateur avant d'autoriser la mise à jour des rôles
        $this->checkAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!$this->validateCSRFToken($_POST['csrf_token'])) {
                echo json_encode(['status' => 'error', 'message' => 'Invalid CSRF token']);
                return;
            }

            $user_id = $_POST['user_id'];
            $role = $_POST['role'];

            $userModel = new User();
            $userModel->updateUserRole($user_id, $role);

            header("Location: /admin/users");
            exit();
        }
    }

    /**
     * Afficher la liste des sites
     */
    public function manageSites() {    
        $siteModel = new Site();
        $sites = $siteModel->getAllSites();
    
        $this->render('admin_sites', ['sites' => $sites]);
    }
    
    public function editSite() {
        $this->checkAdmin();
    
        $siteId = intval($_GET['site_id']);
        $siteModel = new Site();
        $site = $siteModel->getSiteById($siteId);
    
        if (!$site) {
            echo "Site non trouvé.";
            return;
        }
    
        ob_start();
        include __DIR__ . '/../Views/admin_edit_site.php';
        $content = ob_get_clean();
    
        echo $content;
    }

    public function addOwner() {
        $this->checkAdmin();
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $siteId = intval($_GET['site_id']);
            $username = $this->sanitizeInput($_POST['owner_username']);
    
            $userModel = new User();
            $user = $userModel->getUserByUsername($username);
    
            if (!$user) {
                echo "Utilisateur non trouvé.";
                return;
            }
    
            $siteModel = new Site();
            $siteModel->addSiteOwner($siteId, $user['id']);
    
            header("Location: /admin/site/edit?site_id=$siteId");
            exit();
        }
    }
    
    public function removeOwner() {
        $this->checkAdmin();
    
        $siteId = intval($_GET['site_id']);
        $userId = intval($_GET['user_id']);
    
        $siteModel = new Site();
        $siteModel->removeSiteOwner($siteId, $userId);
    
        header("Location: /admin/site/edit?site_id=$siteId");
        exit();
    }

    public function manageOwners() {
        $this->checkAdmin();
    
        $siteId = intval($_GET['site_id']);
        $siteModel = new Site();
        $owners = $siteModel->getSiteOwners($siteId);
    
        ob_start();
        include __DIR__ . '/../Views/admin_manage_owners.php';
        $content = ob_get_clean();
    
        echo $content;
    }

    public function searchUsers() {
        $this->checkAdmin();
    
        $query = isset($_GET['q']) ? trim($_GET['q']) : '';
    
        $userModel = new User();
        $users = $userModel->searchUsers($query);
    
        ob_start();
        include __DIR__ . '/../Views/partials/user_list.php';
        $content = ob_get_clean();
    
        echo json_encode(['status' => 'success', 'html' => $content]);
    }

    public function autocompleteUsers() {
        $this->checkAdmin();
    
        $query = isset($_GET['q']) ? trim($_GET['q']) : '';
    
        $userModel = new User();
        $users = $userModel->searchUsers($query);
    
        // Renvoie uniquement les noms d'utilisateur
        $usernames = array_map(function($user) {
            return $user['username'];
        }, $users);
    
        echo json_encode($usernames);
    }
}
