<?php

require 'Gamyx/config/config.php';
require 'scripts/TableCreate.php';

namespace Gamyx\Models;

use PDO;

class UserModel {  
    private $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function getAll() {
        $stmt = $this->db->prepare("SELECT * FROM usuarios");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $stmt = $this->db->prepare("INSERT INTO usuarios (uniqueName, email, nomeUsuario, senha, about, urlPortfolio ) VALUES (:campo1, :campo2, :campo3, :campo4, :campo5, :campo6)");
        $stmt->bindParam(':campo1', $data['uniqueName']);
        $stmt->bindParam(':campo2', $data['email']);
        $stmt->bindParam(':campo2', $data['nomeUsuario']);
        $stmt->bindParam(':campo2', $data['senha']);
        $stmt->bindParam(':campo2', $data['about']);
        $stmt->bindParam(':campo2', $data['emaurlPortfolioil']);
        return $stmt->execute();
    }

    public function update($id, $data) {
        $stmt = $this->db->prepare("UPDATE usuarios SET uniqueName = :campo1, email = :campo2, nomeUsuario = :campo3, senha = :campo4, about = :campo5, emaurlPortfolioil = :campo6 WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':campo1', $data['uniqueName']);
        $stmt->bindParam(':campo2', $data['email']);
        $stmt->bindParam(':campo2', $data['nomeUsuario']);
        $stmt->bindParam(':campo2', $data['senha']);
        $stmt->bindParam(':campo2', $data['about']);
        $stmt->bindParam(':campo2', $data['emaurlPortfolioil']);
        return $stmt->execute();
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM usuarios WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
