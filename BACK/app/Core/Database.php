<?php

namespace App\Core;

use PDO;

/**
 * Classe pour la gestion de la base de données
 */
class Database {
    private static $instance = null;
    private $pdo;

    private function __construct() {
        $config = include(__DIR__ . '/../../config/config.php');
        $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['dbname'];
        $this->pdo = new PDO($dsn, $config['db']['user'], $config['db']['password']);
    }

    /**
     * Récupérer l'instance de la classe
     *
     * @return Database
     */
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    /**
     * Récupérer la connexion PDO
     *
     * @return PDO
     */
    public function getConnection() {
        return $this->pdo;
    }
}
