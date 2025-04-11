<?php
class Jugador {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getByEquipo($equipo_id) {
        $stmt = $this->db->prepare("SELECT * FROM jugadores WHERE equipo_id = :equipo_id");
        $stmt->execute(['equipo_id' => $equipo_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function add($data) {
        $stmt = $this->db->prepare("INSERT INTO jugadores (nombre, numero, capitan, equipo_id) VALUES (:nombre, :numero, :capitan, :equipo_id)");
        return $stmt->execute($data);
    }

    public function find($id) {
        $stmt = $this->db->prepare("SELECT * FROM jugadores WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $data) {
        $stmt = $this->db->prepare("UPDATE jugadores SET nombre = :nombre, numero = :numero, capitan = :capitan, equipo_id = :equipo_id WHERE id = :id");
        $data['id'] = $id;
        return $stmt->execute($data);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM jugadores WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}