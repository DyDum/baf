<?php

namespace App\Models;

use PDO;
use App\Core\Database;

class Site {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAllSites() {
        $stmt = $this->db->prepare("SELECT * FROM sites");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createSite($data) {
        $stmt = $this->db->prepare("INSERT INTO sites (latitude, longitude, address, name, url, description) VALUES (:latitude, :longitude, :address, :name, :url, :description)");
        $stmt->execute($data);
        return $this->db->lastInsertId();
    }

    public function getSiteById($id) {
        $stmt = $this->db->prepare("SELECT * FROM sites WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateSite($id, $data) {
        $stmt = $this->db->prepare("UPDATE sites SET latitude = :latitude, longitude = :longitude, address = :address, name = :name, url = :url, description = :description WHERE id = :id");
        
        // Liaison des paramètres
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':latitude', $data['latitude']);
        $stmt->bindParam(':longitude', $data['longitude']);
        $stmt->bindParam(':address', $data['address']);
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':url', $data['url']);
        $stmt->bindParam(':description', $data['description']);
        
        // Exécution de la requête
        $stmt->execute();
    }

    public function isOwner($siteId, $userId) {
        $stmt = $this->db->prepare("SELECT * FROM site_owners WHERE site_id = :site_id AND user_id = :user_id");
        $stmt->bindParam(':site_id', $siteId);
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC) !== false;
    }

    public function getSiteOwners($siteId) {
        $stmt = $this->db->prepare("SELECT users.id, users.username FROM users
                                    INNER JOIN site_owners ON users.id = site_owners.user_id
                                    WHERE site_owners.site_id = :site_id");
        $stmt->bindParam(':site_id', $siteId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function addSiteOwner($siteId, $userId) {
        $stmt = $this->db->prepare("INSERT INTO site_owners (site_id, user_id) VALUES (:site_id, :user_id)");
        $stmt->bindParam(':site_id', $siteId);
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
    }
    
    public function removeSiteOwner($siteId, $userId) {
        $stmt = $this->db->prepare("DELETE FROM site_owners WHERE site_id = :site_id AND user_id = :user_id");
        $stmt->bindParam(':site_id', $siteId);
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
    }

    public function searchSites($query, $offset = 0, $limit = 50) {
        $sql = "SELECT * FROM sites WHERE name LIKE :query OR address LIKE :query LIMIT :limit OFFSET :offset";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':query', '%' . $query . '%', PDO::PARAM_STR);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
