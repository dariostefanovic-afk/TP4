CREATE DATABASE infousuarios;
USE infousuarios;

CREATE TABLE usuario (
    nroDni INT NOT NULL,
    nombre VARCHAR(50) NOT NULL,
    apellido VARCHAR(50) NOT NULL,
    telefono VARCHAR(50) NOT NULL,
    PRIMARY KEY (nroDni)
);
INSERT INTO usuario (nroDni, nombre, apellido, telefono) VALUES
(30111222, 'Juan', 'Perez', '2994123456'),
(28999888, 'Lucia', 'Gomez', '2995234567'),
(31555777, 'Martin', 'Lopez', '2996345678');
