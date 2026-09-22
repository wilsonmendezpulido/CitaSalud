-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         11.5.2-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.6.0.6765
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para citasalud
CREATE DATABASE IF NOT EXISTS `citasalud` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;
USE `citasalud`;

-- Volcando estructura para tabla citasalud.api_tokens
CREATE TABLE IF NOT EXISTS `api_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `usuario_id` bigint(20) unsigned NOT NULL,
  `token_hash` varchar(64) NOT NULL,
  `nombre` varchar(100) NOT NULL DEFAULT 'CitaSalud API',
  `expires_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_used_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_api_tokens_hash` (`token_hash`),
  KEY `idx_api_tokens_usuario` (`usuario_id`),
  KEY `idx_api_tokens_expires` (`expires_at`),
  CONSTRAINT `fk_api_tokens_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla citasalud.api_tokens: ~0 rows (aproximadamente)
INSERT INTO `api_tokens` (`id`, `usuario_id`, `token_hash`, `nombre`, `expires_at`, `created_at`, `last_used_at`) VALUES
	(24, 1, '212b0b8dc51034285c578cd759f4522b7f590b2394e9a0088deb8cfc69130897', 'CitaSalud API', '2026-09-29 16:24:35', '2026-09-22 21:24:35', '2026-09-22 16:30:30');

-- Volcando estructura para tabla citasalud.citas
CREATE TABLE IF NOT EXISTS `citas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `paciente_id` bigint(20) unsigned NOT NULL,
  `medico_id` bigint(20) unsigned NOT NULL,
  `disponibilidad_id` bigint(20) unsigned DEFAULT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `motivo` varchar(255) DEFAULT NULL,
  `observaciones` text DEFAULT NULL,
  `estado` enum('PROGRAMADA','CONFIRMADA','ATENDIDA','CANCELADA','NO_ASISTIO') NOT NULL DEFAULT 'PROGRAMADA',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `fk_citas_disponibilidad` (`disponibilidad_id`),
  KEY `idx_citas_paciente` (`paciente_id`),
  KEY `idx_citas_medico_fecha` (`medico_id`,`fecha`),
  KEY `idx_citas_estado` (`estado`),
  KEY `idx_citas_fecha_hora` (`fecha`,`hora`),
  CONSTRAINT `fk_citas_disponibilidad` FOREIGN KEY (`disponibilidad_id`) REFERENCES `disponibilidad` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_citas_medico` FOREIGN KEY (`medico_id`) REFERENCES `medicos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_citas_paciente` FOREIGN KEY (`paciente_id`) REFERENCES `pacientes` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla citasalud.citas: ~0 rows (aproximadamente)
INSERT INTO `citas` (`id`, `paciente_id`, `medico_id`, `disponibilidad_id`, `fecha`, `hora`, `motivo`, `observaciones`, `estado`, `created_at`, `updated_at`) VALUES
	(2, 1, 1, 2, '2026-10-01', '09:00:00', 'Dolor leve en el pecho.', NULL, 'CANCELADA', '2026-09-22 20:41:46', '2026-09-22 20:42:20'),
	(3, 1, 1, 1, '2026-10-01', '08:00:00', 'Dolor en el pecho.', NULL, 'CANCELADA', '2026-09-22 20:42:38', '2026-09-22 21:30:30');

-- Volcando estructura para tabla citasalud.disponibilidad
CREATE TABLE IF NOT EXISTS `disponibilidad` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `medico_id` bigint(20) unsigned NOT NULL,
  `fecha` date NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL,
  `estado` enum('DISPONIBLE','RESERVADO','BLOQUEADO') NOT NULL DEFAULT 'DISPONIBLE',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_disponibilidad` (`medico_id`,`fecha`,`hora_inicio`),
  KEY `idx_disponibilidad_busqueda` (`medico_id`,`fecha`,`estado`),
  CONSTRAINT `fk_disponibilidad_medico` FOREIGN KEY (`medico_id`) REFERENCES `medicos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla citasalud.disponibilidad: ~4 rows (aproximadamente)
INSERT INTO `disponibilidad` (`id`, `medico_id`, `fecha`, `hora_inicio`, `hora_fin`, `estado`, `created_at`, `updated_at`) VALUES
	(1, 1, '2026-10-01', '08:00:00', '08:30:00', 'DISPONIBLE', '2026-09-21 17:15:37', '2026-09-22 21:30:30'),
	(2, 1, '2026-10-01', '09:00:00', '09:30:00', 'DISPONIBLE', '2026-09-21 17:15:37', '2026-09-22 20:42:20'),
	(3, 2, '2026-10-01', '10:00:00', '10:30:00', 'DISPONIBLE', '2026-09-21 17:15:37', '2026-09-22 20:07:14'),
	(4, 3, '2026-10-01', '11:00:00', '11:30:00', 'DISPONIBLE', '2026-09-21 17:15:37', '2026-09-21 17:15:37');

-- Volcando estructura para tabla citasalud.especialidades
CREATE TABLE IF NOT EXISTS `especialidades` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre` (`nombre`),
  KEY `idx_especialidades_estado` (`estado`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla citasalud.especialidades: ~7 rows (aproximadamente)
INSERT INTO `especialidades` (`id`, `nombre`, `descripcion`, `estado`, `created_at`, `updated_at`) VALUES
	(1, 'Medicina General', 'Atención médica general y valoración inicial.', 1, '2026-09-21 17:15:37', '2026-09-21 17:15:37'),
	(2, 'Cardiología', 'Prevención, diagnóstico y tratamiento de enfermedades cardiovasculares.', 1, '2026-09-21 17:15:37', '2026-09-21 17:15:37'),
	(3, 'Dermatología', 'Diagnóstico y tratamiento de enfermedades de la piel.', 1, '2026-09-21 17:15:37', '2026-09-21 17:15:37'),
	(4, 'Ginecología', 'Atención integral de la salud ginecológica.', 1, '2026-09-21 17:15:37', '2026-09-21 17:15:37'),
	(5, 'Pediatría', 'Atención médica especializada para niños y adolescentes.', 1, '2026-09-21 17:15:37', '2026-09-21 17:15:37'),
	(6, 'Oftalmología', 'Prevención, diagnóstico y tratamiento de enfermedades de los ojos.', 1, '2026-09-21 17:15:37', '2026-09-21 17:15:37'),
	(7, 'Traumatología', 'Diagnóstico y tratamiento de lesiones y enfermedades del sistema musculoesquelético.', 1, '2026-09-21 17:15:37', '2026-09-21 17:15:37');

-- Volcando estructura para tabla citasalud.medicos
CREATE TABLE IF NOT EXISTS `medicos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `usuario_id` bigint(20) unsigned DEFAULT NULL,
  `especialidad_id` bigint(20) unsigned NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `registro_medico` varchar(50) NOT NULL,
  `telefono` varchar(30) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `perfil` text DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `registro_medico` (`registro_medico`),
  UNIQUE KEY `usuario_id` (`usuario_id`),
  KEY `idx_medicos_especialidad` (`especialidad_id`),
  KEY `idx_medicos_nombre` (`apellido`,`nombre`),
  KEY `idx_medicos_estado` (`estado`),
  CONSTRAINT `fk_medicos_especialidad` FOREIGN KEY (`especialidad_id`) REFERENCES `especialidades` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_medicos_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla citasalud.medicos: ~4 rows (aproximadamente)
INSERT INTO `medicos` (`id`, `usuario_id`, `especialidad_id`, `nombre`, `apellido`, `registro_medico`, `telefono`, `email`, `perfil`, `estado`, `created_at`, `updated_at`) VALUES
	(1, NULL, 2, 'Laura', 'Gómez', 'RM-CAR-001', '3000000001', 'laura.gomez@citasalud.local', 'Especialista en prevención y atención de enfermedades cardiovasculares.', 1, '2026-09-21 17:15:37', '2026-09-21 17:15:37'),
	(2, NULL, 3, 'Carlos', 'Martínez', 'RM-DER-001', '3000000002', 'carlos.martinez@citasalud.local', 'Especialista en diagnóstico y tratamiento dermatológico.', 1, '2026-09-21 17:15:37', '2026-09-21 17:15:37'),
	(3, NULL, 5, 'Andrea', 'Rodríguez', 'RM-PED-001', '3000000003', 'andrea.rodriguez@citasalud.local', 'Especialista en atención integral de niños y adolescentes.', 1, '2026-09-21 17:15:37', '2026-09-21 17:15:37'),
	(4, NULL, 1, 'Juan', 'Pérez', 'RM-MGE-001', '3000000004', 'juan.perez@citasalud.local', 'Médico de atención primaria y valoración general.', 1, '2026-09-21 17:15:37', '2026-09-21 17:15:37');

-- Volcando estructura para tabla citasalud.pacientes
CREATE TABLE IF NOT EXISTS `pacientes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `usuario_id` bigint(20) unsigned NOT NULL,
  `documento` varchar(30) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `telefono` varchar(30) DEFAULT NULL,
  `direccion` varchar(200) DEFAULT NULL,
  `email` varchar(150) NOT NULL,
  `eps` varchar(150) DEFAULT NULL,
  `sexo` enum('F','M','OTRO','NO_INFORMA') DEFAULT 'NO_INFORMA',
  `discapacidad` varchar(150) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuario_id` (`usuario_id`),
  UNIQUE KEY `documento` (`documento`),
  KEY `idx_pacientes_nombre` (`apellido`,`nombre`),
  KEY `idx_pacientes_documento` (`documento`),
  KEY `idx_pacientes_estado` (`estado`),
  CONSTRAINT `fk_pacientes_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla citasalud.pacientes: ~1 rows (aproximadamente)
INSERT INTO `pacientes` (`id`, `usuario_id`, `documento`, `nombre`, `apellido`, `fecha_nacimiento`, `telefono`, `direccion`, `email`, `eps`, `sexo`, `discapacidad`, `estado`, `created_at`, `updated_at`) VALUES
	(1, 1, '1114620637', 'Wilson Rolando', 'Mendez Pulido', '1985-10-23', '3117458956', 'C 62 1 a 21 Torre C 209', 'wilson.mendez.pulido@gmail.com', 'Comfenalco', 'M', '0', 1, '2026-09-21 17:42:54', '2026-09-22 20:40:53');

-- Volcando estructura para tabla citasalud.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_usuario` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` enum('PACIENTE','MEDICO','ADMIN') NOT NULL DEFAULT 'PACIENTE',
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `idx_usuarios_email` (`email`),
  KEY `idx_usuarios_rol` (`rol`),
  KEY `idx_usuarios_estado` (`estado`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla citasalud.usuarios: ~1 rows (aproximadamente)
INSERT INTO `usuarios` (`id`, `nombre_usuario`, `email`, `password`, `rol`, `estado`, `created_at`, `updated_at`) VALUES
	(1, 'Wilson Méndez', 'wilson@citasalud.local', '$2y$10$HQRx7/jTuht6FZROkNoy0e1X6u/Mpl2z1cv9mr0C.Hgh7c457d4Wq', 'PACIENTE', 1, '2026-09-21 17:35:58', '2026-09-21 17:35:58');

-- Volcando estructura para vista citasalud.vw_citas_detalle
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `vw_citas_detalle` (
	`cita_id` BIGINT(20) UNSIGNED NOT NULL,
	`fecha` DATE NOT NULL,
	`hora` TIME NOT NULL,
	`motivo` VARCHAR(255) NULL COLLATE 'utf8mb4_unicode_ci',
	`observaciones` TEXT NULL COLLATE 'utf8mb4_unicode_ci',
	`estado` ENUM('PROGRAMADA','CONFIRMADA','ATENDIDA','CANCELADA','NO_ASISTIO') NOT NULL COLLATE 'utf8mb4_unicode_ci',
	`paciente_id` BIGINT(20) UNSIGNED NOT NULL,
	`paciente` VARCHAR(201) NULL COLLATE 'utf8mb4_unicode_ci',
	`documento` VARCHAR(30) NOT NULL COLLATE 'utf8mb4_unicode_ci',
	`medico_id` BIGINT(20) UNSIGNED NOT NULL,
	`medico` VARCHAR(201) NULL COLLATE 'utf8mb4_unicode_ci',
	`especialidad_id` BIGINT(20) UNSIGNED NOT NULL,
	`especialidad` VARCHAR(100) NOT NULL COLLATE 'utf8mb4_unicode_ci'
) ENGINE=MyISAM;

-- Volcando estructura para vista citasalud.vw_medicos_especialidades
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `vw_medicos_especialidades` (
	`medico_id` BIGINT(20) UNSIGNED NOT NULL,
	`nombre` VARCHAR(100) NOT NULL COLLATE 'utf8mb4_unicode_ci',
	`apellido` VARCHAR(100) NOT NULL COLLATE 'utf8mb4_unicode_ci',
	`nombre_completo` VARCHAR(201) NULL COLLATE 'utf8mb4_unicode_ci',
	`registro_medico` VARCHAR(50) NOT NULL COLLATE 'utf8mb4_unicode_ci',
	`telefono` VARCHAR(30) NULL COLLATE 'utf8mb4_unicode_ci',
	`email` VARCHAR(150) NULL COLLATE 'utf8mb4_unicode_ci',
	`perfil` TEXT NULL COLLATE 'utf8mb4_unicode_ci',
	`especialidad_id` BIGINT(20) UNSIGNED NOT NULL,
	`especialidad` VARCHAR(100) NOT NULL COLLATE 'utf8mb4_unicode_ci',
	`estado` TINYINT(1) NOT NULL
) ENGINE=MyISAM;

-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `vw_citas_detalle`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `vw_citas_detalle` AS SELECT
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
    ON e.id = m.especialidad_id ;

-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `vw_medicos_especialidades`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `vw_medicos_especialidades` AS SELECT
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
    ON e.id = m.especialidad_id ;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
