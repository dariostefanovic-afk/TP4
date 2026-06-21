-- phpMyAdmin SQL Dump
--
-- http://localhost/phpmyadmin/index.php
-- 
-- Servidor: localhost
-- 
-- Base de datos: `infoautos`
-- 
CREATE DATABASE infoautos;
USE infoautos;

-- --------------------------------------------------------
-- Estructura y datos de la tabla `persona`
-- (Se crea primero porque la tabla 'auto' depende de esta)
-- --------------------------------------------------------

CREATE TABLE persona (
    nroDni VARCHAR(10) NOT NULL,
    apellido VARCHAR(50) NOT NULL,
    nombre VARCHAR(50) NOT NULL,
    fechaNac DATE NOT NULL,
    telefono VARCHAR(20) NOT NULL,
    domicilio VARCHAR(200) NOT NULL,
    PRIMARY KEY (NroDni)
);

INSERT INTO persona (nroDni, apellido, nombre, fechaNac, telefono, domicilio) VALUES 
('28326986', 'Moya', 'Manuel', '1981-12-03', '299-9632587', 'Linares 44 piso 2 dpto 5'),
('25963874', 'Farias', 'Marta', '1975-06-21', '299-1559354', 'Roca 568'),
('30875962', 'Lopez', 'Eduardo', '1983-10-03', '299-6587741', 'Santa Fe 98'),
('22985265', 'Ramirez', 'Claudia', '1971-05-16', '299-9854155', 'Sarmiento 55');

-- --------------------------------------------------------
-- Estructura y datos de la tabla `auto`
-- --------------------------------------------------------

CREATE TABLE auto (
    patente VARCHAR(10) NOT NULL,
    marca VARCHAR(50) NOT NULL,
    modelo INT NOT NULL,
    dniDuenio VARCHAR(10) NOT NULL,
    PRIMARY KEY (Patente),
    FOREIGN KEY (DniDuenio) REFERENCES persona(NroDni)
);

INSERT INTO auto (patente, marca, modelo, dniDuenio) VALUES 
('ADC 152', 'Fiat', 1998, '28326986'),
('POL 968', 'Renault', 1977, '28326986'),
('KJU 952', 'Ford', 2006, '25963874'),
('UYH 985', 'Chevrolet', 1995, '30875962'),
('LKI 865', 'Toyota', 1990, '28326986'),
('SDC 965', 'Peugeot', 1988, '30875962');