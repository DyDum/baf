<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;

/**
 * Contrôleur pour les actions d'authentification
 */
class AuthController extends Controller {
    /**
     * Afficher le formulaire de connexion et gérer la connexion
     */
    public function login() {
        if (isset($_SESSION['user_id'])) {
            header("Location: /");
            exit();
        }
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!$this->validateCSRFToken($_POST['csrf_token'])) {
                echo json_encode(['status' => 'error', 'message' => 'Invalid CSRF token']);
                return;
            }
            
            $username = $_POST['username'];
            $password = $_POST['password'];
    
            $userModel = new User();
            $user = $userModel->getUserByUsername($username);
    
            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];
                header("Location: /");
                exit();
            } else {
                $this->render('login', ['error' => 'Nom d\'utilisateur ou mot de passe incorrect']);
            }
        } else {
            $this->render('login');
        }
    }

    /**
     * Afficher le formulaire d'inscription et gérer l'inscription
     */
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!$this->validateCSRFToken($_POST['csrf_token'])) {
                echo json_encode(['status' => 'error', 'message' => 'Invalid CSRF token']);
                return;
            }

            $username = $_POST['username'];
            $password = $_POST['password'];
            $password_confirm = $_POST['password_confirm'];

            if ($password !== $password_confirm) {
                $this->render('register', ['error' => 'Les mots de passe ne correspondent pas']);
                return;
            }

            $userModel = new User();
            if ($userModel->getUserByUsername($username)) {
                $this->render('register', ['error' => 'Nom d\'utilisateur déjà pris']);
                return;
            }

            $hashedPassword = password_hash($password, PASSWORD_ARGON2ID);
            $userModel->createUser($username, $hashedPassword);

            header("Location: /login");
            exit();
        } else {
            $this->render('register');
        }
    }

    /**
     * Déconnexion de l'utilisateur
     */
    public function logout() {
        session_destroy();
        header("Location: /login");
        exit();
    }
}
