CREATE DATABASE IF NOT EXISTS gestion_equipos;
USE gestion_equipos;

CREATE TABLE equipos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    ciudad VARCHAR(100),
    deporte VARCHAR(50),
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE jugadores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    numero INT,
    capitan BOOLEAN DEFAULT FALSE,
    equipo_id INT NOT NULL,
);

ALTER TABLE jugadores ADD CONSTRAINT jugadores_FK FOREIGN KEY (equipo_id) REFERENCES gestion_equipos.equipos(id);