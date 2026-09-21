-- ============================================================
-- CitaSalud - Base de Datos MySQL
-- Proyecto: Sistema de Gestión de Citas de Especialidades Médicas
-- Arquitectura: PHP MVC + Bootstrap + MySQL
-- Versión: 1.0
-- ============================================================

DROP DATABASE IF EXISTS citasalud;
CREATE DATABASE citasalud
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE citasalud;

-- ============================================================
-- 1. USUARIOS
-- ============================================================
CREATE TABLE usuarios (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre_usuario VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    rol ENUM('PACIENTE', 'MEDICO', 'ADMIN') NOT NULL DEFAULT 'PACIENTE',
    estado TINYINT(1) NOT NULL DEFAULT 1,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    INDEX idx_usuarios_email (email),
    INDEX idx_usuarios_rol (rol),
    INDEX idx_usuarios_estado (estado)
) ENGINE=InnoDB;

-- ============================================================
-- 2. PACIENTES
-- ============================================================
CREATE TABLE pacientes (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    usuario_id BIGINT UNSIGNED NOT NULL UNIQUE,
    documento VARCHAR(30) NOT NULL UNIQUE,
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(100) NOT NULL,
    fecha_nacimiento DATE NULL,
    telefono VARCHAR(30) NULL,
    direccion VARCHAR(200) NULL,
    email VARCHAR(150) NOT NULL,
    eps VARCHAR(150) NULL,
    sexo ENUM('F', 'M', 'OTRO', 'NO_INFORMA') DEFAULT 'NO_INFORMA',
    discapacidad VARCHAR(150) NULL,
    estado TINYINT(1) NOT NULL DEFAULT 1,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT fk_pacientes_usuario
        FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT,

    INDEX idx_pacientes_nombre (apellido, nombre),
    INDEX idx_pacientes_documento (documento),
    INDEX idx_pacientes_estado (estado)
) ENGINE=InnoDB;

-- ============================================================
-- 3. ESPECIALIDADES
-- ============================================================
CREATE TABLE especialidades (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL UNIQUE,
    descripcion TEXT NULL,
    estado TINYINT(1) NOT NULL DEFAULT 1,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    INDEX idx_especialidades_estado (estado)
) ENGINE=InnoDB;

-- ============================================================
-- 4. MEDICOS
-- ============================================================
CREATE TABLE medicos (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    usuario_id BIGINT UNSIGNED NULL UNIQUE,
    especialidad_id BIGINT UNSIGNED NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(100) NOT NULL,
    registro_medico VARCHAR(50) NOT NULL UNIQUE,
    telefono VARCHAR(30) NULL,
    email VARCHAR(150) NULL,
    perfil TEXT NULL,
    estado TINYINT(1) NOT NULL DEFAULT 1,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT fk_medicos_usuario
        FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
        ON UPDATE CASCADE
        ON DELETE SET NULL,

    CONSTRAINT fk_medicos_especialidad
        FOREIGN KEY (especialidad_id) REFERENCES especialidades(id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT,

    INDEX idx_medicos_especialidad (especialidad_id),
    INDEX idx_medicos_nombre (apellido, nombre),
    INDEX idx_medicos_estado (estado)
) ENGINE=InnoDB;

-- ============================================================
-- 5. DISPONIBILIDAD DE MEDICOS
-- ============================================================
CREATE TABLE disponibilidad (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    medico_id BIGINT UNSIGNED NOT NULL,
    fecha DATE NOT NULL,
    hora_inicio TIME NOT NULL,
    hora_fin TIME NOT NULL,
    estado ENUM('DISPONIBLE', 'RESERVADO', 'BLOQUEADO') NOT NULL DEFAULT 'DISPONIBLE',
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT fk_disponibilidad_medico
        FOREIGN KEY (medico_id) REFERENCES medicos(id)
        ON UPDATE CASCADE
        ON DELETE CASCADE,

    CONSTRAINT uq_disponibilidad
        UNIQUE (medico_id, fecha, hora_inicio),

    INDEX idx_disponibilidad_busqueda (medico_id, fecha, estado)
) ENGINE=InnoDB;

-- ============================================================
-- 6. CITAS
-- ============================================================
CREATE TABLE citas (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    paciente_id BIGINT UNSIGNED NOT NULL,
    medico_id BIGINT UNSIGNED NOT NULL,
    disponibilidad_id BIGINT UNSIGNED NULL,
    fecha DATE NOT NULL,
    hora TIME NOT NULL,
    motivo VARCHAR(255) NULL,
    observaciones TEXT NULL,
    estado ENUM('PROGRAMADA', 'CONFIRMADA', 'ATENDIDA', 'CANCELADA', 'NO_ASISTIO')
        NOT NULL DEFAULT 'PROGRAMADA',
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT fk_citas_paciente
        FOREIGN KEY (paciente_id) REFERENCES pacientes(id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT,

    CONSTRAINT fk_citas_medico
        FOREIGN KEY (medico_id) REFERENCES medicos(id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT,

    CONSTRAINT fk_citas_disponibilidad
        FOREIGN KEY (disponibilidad_id) REFERENCES disponibilidad(id)
        ON UPDATE CASCADE
        ON DELETE SET NULL,

    INDEX idx_citas_paciente (paciente_id),
    INDEX idx_citas_medico_fecha (medico_id, fecha),
    INDEX idx_citas_estado (estado),
    INDEX idx_citas_fecha_hora (fecha, hora)
) ENGINE=InnoDB;

-- ============================================================
-- DATOS INICIALES: ESPECIALIDADES
-- ============================================================
INSERT INTO especialidades (nombre, descripcion) VALUES
('Medicina General', 'Atención médica general y valoración inicial.'),
('Cardiología', 'Prevención, diagnóstico y tratamiento de enfermedades cardiovasculares.'),
('Dermatología', 'Diagnóstico y tratamiento de enfermedades de la piel.'),
('Ginecología', 'Atención integral de la salud ginecológica.'),
('Pediatría', 'Atención médica especializada para niños y adolescentes.'),
('Oftalmología', 'Prevención, diagnóstico y tratamiento de enfermedades de los ojos.'),
('Traumatología', 'Diagnóstico y tratamiento de lesiones y enfermedades del sistema musculoesquelético.');

-- ============================================================
-- DATOS INICIALES: MÉDICOS
-- ============================================================
INSERT INTO medicos
    (especialidad_id, nombre, apellido, registro_medico, telefono, email, perfil)
VALUES
(
    (SELECT id FROM especialidades WHERE nombre = 'Cardiología'),
    'Laura',
    'Gómez',
    'RM-CAR-001',
    '3000000001',
    'laura.gomez@citasalud.local',
    'Especialista en prevención y atención de enfermedades cardiovasculares.'
),
(
    (SELECT id FROM especialidades WHERE nombre = 'Dermatología'),
    'Carlos',
    'Martínez',
    'RM-DER-001',
    '3000000002',
    'carlos.martinez@citasalud.local',
    'Especialista en diagnóstico y tratamiento dermatológico.'
),
(
    (SELECT id FROM especialidades WHERE nombre = 'Pediatría'),
    'Andrea',
    'Rodríguez',
    'RM-PED-001',
    '3000000003',
    'andrea.rodriguez@citasalud.local',
    'Especialista en atención integral de niños y adolescentes.'
),
(
    (SELECT id FROM especialidades WHERE nombre = 'Medicina General'),
    'Juan',
    'Pérez',
    'RM-MGE-001',
    '3000000004',
    'juan.perez@citasalud.local',
    'Médico de atención primaria y valoración general.'
);

-- ============================================================
-- DATOS INICIALES: DISPONIBILIDAD
-- Se generan algunos horarios de ejemplo para el prototipo.
-- ============================================================
INSERT INTO disponibilidad
    (medico_id, fecha, hora_inicio, hora_fin, estado)
SELECT
    m.id,
    '2026-10-01',
    '08:00:00',
    '08:30:00',
    'DISPONIBLE'
FROM medicos m
WHERE m.registro_medico = 'RM-CAR-001';

INSERT INTO disponibilidad
    (medico_id, fecha, hora_inicio, hora_fin, estado)
SELECT
    m.id,
    '2026-10-01',
    '09:00:00',
    '09:30:00',
    'DISPONIBLE'
FROM medicos m
WHERE m.registro_medico = 'RM-CAR-001';

INSERT INTO disponibilidad
    (medico_id, fecha, hora_inicio, hora_fin, estado)
SELECT
    m.id,
    '2026-10-01',
    '10:00:00',
    '10:30:00',
    'DISPONIBLE'
FROM medicos m
WHERE m.registro_medico = 'RM-DER-001';

INSERT INTO disponibilidad
    (medico_id, fecha, hora_inicio, hora_fin, estado)
SELECT
    m.id,
    '2026-10-01',
    '11:00:00',
    '11:30:00',
    'DISPONIBLE'
FROM medicos m
WHERE m.registro_medico = 'RM-PED-001';

-- ============================================================
-- VISTA: médicos con especialidad
-- ============================================================
CREATE OR REPLACE VIEW vw_medicos_especialidades AS
SELECT
    m.id AS medico_id,
    m.nombre,
    m.apellido,
    CONCAT(m.nombre, ' ', m.apellido) AS nombre_completo,
    m.registro_medico,
    m.telefono,
    m.email,
    m.perfil,
    e.id AS especialidad_id,
    e.nombre AS especialidad,
    m.estado
FROM medicos m
INNER JOIN especialidades e
    ON e.id = m.especialidad_id;

-- ============================================================
-- VISTA: citas completas
-- ============================================================
CREATE OR REPLACE VIEW vw_citas_detalle AS
SELECT
    c.id AS cita_id,
    c.fecha,
    c.hora,
    c.motivo,
    c.observaciones,
    c.estado,
    p.id AS paciente_id,
    CONCAT(p.nombre, ' ', p.apellido) AS paciente,
    p.documento,
    m.id AS medico_id,
    CONCAT(m.nombre, ' ', m.apellido) AS medico,
    e.id AS especialidad_id,
    e.nombre AS especialidad
FROM citas c
INNER JOIN pacientes p
    ON p.id = c.paciente_id
INNER JOIN medicos m
    ON m.id = c.medico_id
INNER JOIN especialidades e
    ON e.id = m.especialidad_id;

-- ============================================================
-- VERIFICACIÓN
-- ============================================================
SELECT 'Base de datos CitaSalud creada correctamente' AS mensaje;

SHOW TABLES;
