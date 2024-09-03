<?php

namespace App\Core;

/**
 * Classe de base pour les contrôleurs
 */
class Controller {
    /**
     * Afficher une vue
     *
     * @param string $view Nom de la vue
     * @param array $data Données à passer à la vue
     */
    protected function render($view, $data = []) {
        extract($data);
        $base_url = '/'; // Assurez-vous que cela pointe vers le bon URL
        ob_start();
        require __DIR__ . '/../Views/' . $view . '.php';
        $content = ob_get_clean();
        require __DIR__ . '/../Views/layout.php';
    }

    /**
     * Vérifier si l'utilisateur est connecté
     */
    protected function checkAuthenticated() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
            exit();
        }
    }

    /**
     * Vérifier si l'utilisateur est un administrateur
     */
    protected function checkAdmin() {
        $this->checkAuthenticated();

        if ($_SESSION['role'] !== 'admin') {
            header("Location: /");
            exit();
        }
    }

    /**
     * Vérifier si l'utilisateur est le propriétaire d'un site
     */
    protected function checkOwner() {
        $this->checkAuthenticated();
        
        if ($_SESSION['role'] !== 'owner' && $_SESSION['role'] !== 'admin') {
            header("Location: /");
            exit();
        }
    }
    /**
     * Générer un jeton CSRF
     */
    protected function generateCSRFToken() {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }

    /**
     * Valider le jeton CSRF
     *
     * @param string $token Jeton CSRF à valider
     * @return bool Renvoie true si le jeton est valide, sinon false
     */
    protected function validateCSRFToken($token) {
        return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
    }

    /**
     * Converti les caractères spéciaux en entité HTML
     *
     * @param string $data Donnée du site
     * @return string Donnée du site
     */
    protected function sanitizeInput($data) {
        return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
    }
}
