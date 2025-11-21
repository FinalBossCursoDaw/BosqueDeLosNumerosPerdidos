-- Crear la base de datos
CREATE DATABASE BosqueDeLosNumerosPerdidos;
GO

USE BosqueDeLosNumerosPerdidos;
GO

-- ==============================
-- 1. TABLA USUARIOS
-- ==============================
CREATE TABLE Usuarios (
    id_usuario INT IDENTITY(1,1) PRIMARY KEY,
    nombre NVARCHAR(100) NOT NULL,
    email NVARCHAR(150) NOT NULL UNIQUE,
    password NVARCHAR(200) NOT NULL,
    rol NVARCHAR(50) NOT NULL,
    fecha_registro DATETIME DEFAULT GETDATE()
);
GO

-- ==============================
-- 2. TABLA JUEGOS
-- ==============================
CREATE TABLE Juegos (
    id_juego INT IDENTITY(1,1) PRIMARY KEY,
    nombre NVARCHAR(100) NOT NULL,
    descripcion NVARCHAR(MAX)
);
GO

-- ==============================
-- 3. TABLA SESIONES (1:1 con Partidas)
-- ==============================
CREATE TABLE Sesiones (
    id_sesion INT IDENTITY(1,1) PRIMARY KEY,
    level_reached INT NOT NULL,
    n_attemps INT NOT NULL,
    errors INT NOT NULL,
    date_time DATETIME DEFAULT GETDATE(),
    helps_clicks INT NOT NULL
);
GO

-- ==============================
-- 4. TABLA FECHAS
-- ==============================
CREATE TABLE Fechas (
    fecha DATE PRIMARY KEY
);
GO

-- ==============================
-- 5. TABLA PARTIDAS
-- ==============================
CREATE TABLE Partidas (
    id_partida INT IDENTITY(1,1) PRIMARY KEY,
    id_usuario INT NOT NULL,
    id_juego INT NOT NULL,
    fecha DATE NOT NULL,
    id_sesion INT UNIQUE NOT NULL,     
    puntuacion INT NOT NULL,
    tiempo_seg INT NOT NULL,

    FOREIGN KEY (id_usuario) REFERENCES Usuarios(id_usuario),
    FOREIGN KEY (id_juego) REFERENCES Juegos(id_juego),
    FOREIGN KEY (fecha) REFERENCES Fechas(fecha),
    FOREIGN KEY (id_sesion) REFERENCES Sesiones(id_sesion)
);
GO