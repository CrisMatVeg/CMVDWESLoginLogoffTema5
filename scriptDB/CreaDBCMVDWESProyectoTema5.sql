/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Other/SQLTemplate.sql to edit this template
 */
/**
 * Author:  cristian.matveg
 * Created: 30 oct. 2025
 */
CREATE DATABASE IF NOT EXISTS DBCMVDWESLoginLogoffTema5;
USE DBCMVDWESLoginLogoffTema5;

CREATE TABLE IF NOT EXISTS T02_Departamento (
    T02_CodDepartamento VARCHAR(3) PRIMARY KEY,
    T02_DescDepartamento VARCHAR(255) NOT NULL,
    T02_FechaCreacionDepartamento DATETIME NOT NULL,
    T02_VolumenDeNegocio FLOAT NOT NULL,
    T02_FechaBajaDepartamento DATETIME
);

CREATE TABLE IF NOT EXISTS T01_Usuarios (
    T01_CodUsuario VARCHAR(10) NOT NULL,
        CHECK (LENGTH(T01_CodUsuario) >= 4),
        PRIMARY KEY (T01_CodUsuario),
    T01_Password VARCHAR(255) NOT NULL,
        CHECK (LENGTH(T01_Password) >= 4),
    T01_DescUsuario VARCHAR(255) NOT NULL,
    T01_NumConexiones INT NOT NULL default 0,
    T01_FechaHoraUltimaConexion DATETIME NOT NULL default now(),
    T01_Perfil VARCHAR(20) NOT NULL default 'usuario',
    T01_ImagenUsuario VARCHAR(255) default null
);

CREATE USER IF NOT EXISTS 'userCMVDWESLoginLogoffTema5'@'%' IDENTIFIED BY 'paso';
GRANT ALL PRIVILEGES ON T02_Departamento TO 'userCMVDWESLoginLogoffTema5'@'%';
GRANT ALL PRIVILEGES ON T01_Usuarios TO 'userCMVDWESLoginLogoffTema5'@'%';
FLUSH PRIVILEGES;