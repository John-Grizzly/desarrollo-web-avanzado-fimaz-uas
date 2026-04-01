CREATE DATABASE IF NOT EXISTS proyecto CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE proyecto;

CREATE TABLE IF NOT EXISTS torneos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombreTorneo VARCHAR(150) NOT NULL,
    organizador VARCHAR(150) NOT NULL,
    patrocinadores TEXT NULL,
    sede VARCHAR(150) NOT NULL,
    categoria VARCHAR(100) NOT NULL,
    premio1 VARCHAR(150) NULL,
    premio2 VARCHAR(150) NULL,
    premio3 VARCHAR(150) NULL,
    otroPremio VARCHAR(150) NULL,
    usuario VARCHAR(100) NOT NULL,
    contrasena VARCHAR(255) NOT NULL
);
