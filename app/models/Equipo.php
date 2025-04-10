<?php
class Equipo {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAll() {
        $stmt = $this->db->query("SELECT id, nombre, deporte, ciudad, DATE_FORMAT(fecha_creacion, '%d-%m-%Y') AS fecha_creacion FROM equipos");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function add($data) {
        $stmt = $this->db->prepare("INSERT INTO equipos (nombre, ciudad, deporte) VALUES (:nombre, :ciudad, :deporte)");
        return $stmt->execute($data);
    }

    public function find($id) {
        $stmt = $this->db->prepare("SELECT * FROM equipos WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
	
	public function getCaptain($equipo_id) {
    $stmt = $this->db->prepare("SELECT * FROM jugadores WHERE equipo_id = :equipo_id AND capitan = 1 LIMIT 1");
    $stmt->execute(['equipo_id' => $equipo_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
}