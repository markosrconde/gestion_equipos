<?php
class Database {
    private $conexion;

    public function __construct($config) {
        try {
            $dsn = "mysql:host={$config['host']};dbname={$config['dbname']};charset=utf8";
            $this->conexion = new PDO($dsn, $config['username'], $config['password']);
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }

    public function getconexion() {
        return $this->conexion;
    }
}