-- --------------------------------------------------------
-- Host:                         localhost
-- Versión del servidor:         5.7.24 - MySQL Community Server (GPL)
-- SO del servidor:              Win64
-- HeidiSQL Versión:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para evote
DROP DATABASE IF EXISTS `evote`;
CREATE DATABASE IF NOT EXISTS `evote` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci */;
USE `evote`;

-- Volcando estructura para evento evote.actualizar_en_curso
DROP EVENT IF EXISTS `actualizar_en_curso`;
DELIMITER //
CREATE DEFINER=`root`@`localhost` EVENT `actualizar_en_curso` ON SCHEDULE EVERY 1 MINUTE STARTS '2020-10-08 13:48:00' ON COMPLETION PRESERVE ENABLE DO UPDATE votacions SET realizada =2
WHERE CURRENT_TIMESTAMP() >= 
ADDTIME(CONVERT(votacions.fechainicio, DATETIME), votacions.horainicio) 
AND CURRENT_TIMESTAMP() <=
ADDTIME(CONVERT(votacions.fechainicio, DATETIME), ADDTIME(votacions.horainicio, CONCAT(votacions.duracion, ':00:00')))//
DELIMITER ;

-- Volcando estructura para evento evote.actualizar_votaciones
DROP EVENT IF EXISTS `actualizar_votaciones`;
DELIMITER //
CREATE DEFINER=`root`@`localhost` EVENT `actualizar_votaciones` ON SCHEDULE EVERY 1 MINUTE STARTS '2020-10-08 13:17:00' ON COMPLETION PRESERVE ENABLE DO UPDATE votacions SET realizada = 1
WHERE ADDTIME(CONVERT(votacions.fechainicio, DATETIME), ADDTIME(votacions.horainicio, CONCAT(votacions.duracion, ':00:00'))) <= CURRENT_TIMESTAMP()//
DELIMITER ;

-- Volcando estructura para tabla evote.candidatos
DROP TABLE IF EXISTS `candidatos`;
CREATE TABLE IF NOT EXISTS `candidatos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nombrecandidato` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `apellidocandidato` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idvotacion` int(10) unsigned NOT NULL,
  `numvotos` bigint(20) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FKvotacion` (`idvotacion`),
  CONSTRAINT `FKvotacion` FOREIGN KEY (`idvotacion`) REFERENCES `votacions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla evote.candidatos: ~13 rows (aproximadamente)
/*!40000 ALTER TABLE `candidatos` DISABLE KEYS */;
REPLACE INTO `candidatos` (`id`, `created_at`, `updated_at`, `nombrecandidato`, `apellidocandidato`, `foto`, `idvotacion`, `numvotos`) VALUES
	(26, '2020-10-05 20:18:58', '2020-10-05 20:59:47', 'Andres', 'Chila', 'uploads/osibnC4hnIvaaOLP68J5FWOr57G2Vd6ZV7OMkQ6S.png', 44, 2),
	(27, '2020-10-05 21:18:05', '2020-10-06 16:38:39', 'Isaac', 'Gomez', 'uploads/Q36TGks5QHqKQWafTLAn84QEyj5gZMsMcW9HYuRF.png', 42, 7),
	(28, '2020-10-05 21:21:24', '2020-10-06 12:39:37', 'Fernando', 'Carlos', 'uploads/knb0mJCzu7FH7TPLDDxoL6Fqi9whoAxidhW4wWeD.png', 43, 31),
	(29, '2020-10-06 14:44:08', '2020-10-06 15:04:51', 'Isaacs', 'Gomez', 'uploads/Rew9iLegGlQ7qKbC8pRoKwLhIQCPUdvU8GD4w0ir.png', 45, 1),
	(30, '2020-10-08 13:25:38', '2020-10-08 13:49:26', 'Isaacs', 'Gomez', 'uploads/uItBO1XWtAstXeKnscw7cAar1Y3tMNuiUzza7LgD.png', 52, 1),
	(31, '2020-10-08 13:25:58', '2020-10-08 15:17:11', 'Andres', 'Chila', 'uploads/tzvawOhDyDU63w21Q4KqwXtBEXxCJ973igp6gII0.png', 52, 1),
	(32, '2020-10-08 15:19:59', '2020-10-08 16:35:17', 'alguien', 'sise', 'uploads/hxGDnWthpb6GwwYde1y52MQnnuE4hXA9nAkEnywT.png', 53, 1),
	(33, '2020-10-08 18:29:36', '2020-10-08 18:30:36', 'Isaacs', 'Gomez', 'uploads/uOOGCe1ncS7tWikvyKXN1bXWxNjmD4u3T9YSsROG.png', 55, 1),
	(34, '2020-10-08 18:29:50', '2020-10-08 18:29:50', 'Andres', 'Chila', 'uploads/qu3p3ONrbYBqlQGPuXCGn9GLwJFjXOjUrqvAgJTX.png', 55, 0),
	(35, '2020-10-09 11:42:13', '2020-10-09 11:57:22', 'Andres', 'Chila', 'uploads/wv5V1dCAyA3MKxvgAAYxXIMfqQj9MmvyL5oPPFc3.png', 56, 2),
	(36, '2020-10-09 11:42:25', '2020-10-09 12:04:15', 'Isaac', 'Gomez', 'uploads/Ww1OnrbGCU3VuM6Xnuj2w8rOWNxK3ZXjxYx4GD19.png', 56, 4),
	(37, '2020-10-09 14:26:39', '2020-10-09 14:28:16', 'Cesar', 'Barahona', 'uploads/22fycJyuqmuF0kgFsgcTez3KN5JH3ngUG00WXpLE.png', 57, 1),
	(38, '2020-10-09 14:26:59', '2020-10-09 14:29:26', 'Gina', 'Valenzuela', 'uploads/r3vyO4ax9KNYp9JO0ErYLAsiYqX8GQ4I04mVxRHJ.png', 57, 1);
/*!40000 ALTER TABLE `candidatos` ENABLE KEYS */;

-- Volcando estructura para tabla evote.migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla evote.migrations: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
REPLACE INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2020_04_13_140516_create_candidatos_table', 1),
	(4, '2020_04_13_140711_create_votacions_table', 1),
	(5, '2020_04_13_140845_create_tipo_votacions_table', 1),
	(7, '2020_10_01_203950_create_voto_table', 2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Volcando estructura para tabla evote.password_resets
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla evote.password_resets: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Volcando estructura para tabla evote.tipo_votacions
DROP TABLE IF EXISTS `tipo_votacions`;
CREATE TABLE IF NOT EXISTS `tipo_votacions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nombretipo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ocupacionpermitida` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla evote.tipo_votacions: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `tipo_votacions` DISABLE KEYS */;
REPLACE INTO `tipo_votacions` (`id`, `created_at`, `updated_at`, `nombretipo`, `ocupacionpermitida`) VALUES
	(1, '2020-04-13 17:27:48', '2020-09-30 22:16:45', 'Consejo Superior', 'Estudiante, '),
	(2, '2020-04-13 17:28:18', '2020-09-30 22:22:36', 'Consejo Académico', 'Docente, '),
	(3, '2020-04-13 17:28:35', '2020-09-30 22:16:40', 'Consejo de Facultad', 'Estudiante, '),
	(4, '2020-04-13 17:28:47', '2020-09-30 22:22:50', 'Comité Interno de Asignación y Reconocimiento de Puntaje', 'Docente, '),
	(12, '2020-09-30 20:43:44', '2020-10-08 20:15:26', 'nuevo', 'Estudiante, Docente, ');
/*!40000 ALTER TABLE `tipo_votacions` ENABLE KEYS */;

-- Volcando estructura para tabla evote.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla evote.users: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Volcando estructura para tabla evote.votacions
DROP TABLE IF EXISTS `votacions`;
CREATE TABLE IF NOT EXISTS `votacions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nombrevotacion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipovotacion` bigint(20) DEFAULT NULL,
  `fechainicio` date DEFAULT NULL,
  `duracion` bigint(2) DEFAULT NULL,
  `realizada` tinyint(4) DEFAULT '0',
  `horainicio` time DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla evote.votacions: ~15 rows (aproximadamente)
/*!40000 ALTER TABLE `votacions` DISABLE KEYS */;
REPLACE INTO `votacions` (`id`, `created_at`, `updated_at`, `nombrevotacion`, `tipovotacion`, `fechainicio`, `duracion`, `realizada`, `horainicio`) VALUES
	(42, '2020-10-05 23:15:51', '2020-10-05 23:16:43', 'Votación 1', 1, '2020-10-05', 10, 1, '08:16:00'),
	(43, '2020-10-05 23:30:55', '2020-10-05 23:30:55', 'Votacion 2', 1, '2020-10-06', 4, 1, '17:45:00'),
	(44, '2020-10-05 23:31:23', '2020-10-05 23:31:23', 'Votación 3', 2, '2020-10-06', 4, 1, '18:31:00'),
	(45, '2020-10-05 21:25:48', '2020-10-05 21:25:48', 'votacion 4', 3, '2020-10-06', 2, 1, '21:30:00'),
	(46, '2020-10-06 15:16:53', '2020-10-06 15:16:53', 'votacion hora pasada', 1, '2020-10-06', 1, 1, '14:10:00'),
	(47, '2020-10-06 15:17:18', '2020-10-06 19:23:42', 'votacion hora vigente', 1, '2020-10-07', 1, 1, '19:30:00'),
	(48, '2020-10-06 19:18:45', '2020-10-06 19:19:43', 'nueva proxima', 1, '2020-10-07', 4, 1, '20:00:00'),
	(49, '2020-10-06 19:22:29', '2020-10-06 19:22:29', 'nueva proxima', 1, '2020-10-07', 2, 1, '20:00:00'),
	(50, '2020-10-06 19:53:32', '2020-10-06 19:54:31', 'aaaaaaa', 1, '2020-10-07', 3, 1, '20:30:00'),
	(52, '2020-10-08 13:24:12', '2020-10-08 13:24:12', 'votacion realizada hoy', 1, '2020-10-08', 3, 1, '13:28:00'),
	(53, '2020-10-08 15:19:29', '2020-10-08 15:19:29', 'votacion que inicia a las 4', 1, '2020-10-08', 1, 1, '16:00:00'),
	(54, '2020-10-08 16:23:31', '2020-10-08 16:23:31', 'votacion de las 4:25', 1, '2020-10-08', 1, 1, '16:25:00'),
	(55, '2020-10-08 18:29:21', '2020-10-08 18:29:21', 'ora si', 1, '2020-10-08', 2, 1, '18:30:00'),
	(56, '2020-10-09 11:41:56', '2020-10-09 11:41:56', 'votacion 9 oct 11:40', 12, '2020-10-09', 2, 1, '09:00:00'),
	(57, '2020-10-09 14:26:09', '2020-10-09 14:26:09', 'Votacion prueba reunion', 12, '2020-10-09', 1, 1, '10:00:00');
/*!40000 ALTER TABLE `votacions` ENABLE KEYS */;

-- Volcando estructura para tabla evote.voto
DROP TABLE IF EXISTS `voto`;
CREATE TABLE IF NOT EXISTS `voto` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `votacion` int(10) unsigned NOT NULL,
  `cedulavotante` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_votacion_voto` (`votacion`),
  CONSTRAINT `FK_votacion_voto` FOREIGN KEY (`votacion`) REFERENCES `votacions` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla evote.voto: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `voto` DISABLE KEYS */;
REPLACE INTO `voto` (`id`, `votacion`, `cedulavotante`, `created_at`, `updated_at`) VALUES
	(60, 57, 561101010, '2020-10-09 14:28:16', '2020-10-09 14:28:16'),
	(61, 57, 561213548, '2020-10-09 14:29:26', '2020-10-09 14:29:26');
/*!40000 ALTER TABLE `voto` ENABLE KEYS */;

-- Volcando estructura para tabla evote.votoxcarrera
DROP TABLE IF EXISTS `votoxcarrera`;
CREATE TABLE IF NOT EXISTS `votoxcarrera` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `numvotos` int(10) unsigned NOT NULL DEFAULT '1',
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `idcandidato` int(10) unsigned NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idcandidato` (`idcandidato`),
  CONSTRAINT `idcandidato` FOREIGN KEY (`idcandidato`) REFERENCES `candidatos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla evote.votoxcarrera: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `votoxcarrera` DISABLE KEYS */;
REPLACE INTO `votoxcarrera` (`id`, `numvotos`, `nombre`, `idcandidato`, `updated_at`, `created_at`) VALUES
	(7, 1, 'Ingenieria de Sistemas', 37, '2020-10-09 14:28:16', '2020-10-09 14:28:16'),
	(8, 1, 'Psicologia', 38, '2020-10-09 14:29:26', '2020-10-09 14:29:26');
/*!40000 ALTER TABLE `votoxcarrera` ENABLE KEYS */;

-- Volcando estructura para tabla evote.votoxlugar
DROP TABLE IF EXISTS `votoxlugar`;
CREATE TABLE IF NOT EXISTS `votoxlugar` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `numvotos` int(10) unsigned NOT NULL DEFAULT '1',
  `idcandidato` int(10) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `candidato` (`idcandidato`),
  CONSTRAINT `candidato` FOREIGN KEY (`idcandidato`) REFERENCES `candidatos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla evote.votoxlugar: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `votoxlugar` DISABLE KEYS */;
REPLACE INTO `votoxlugar` (`id`, `nombre`, `numvotos`, `idcandidato`, `created_at`, `updated_at`) VALUES
	(9, 'Facatativa', 1, 37, '2020-10-09 14:28:16', '2020-10-09 14:28:16'),
	(10, 'Fusagasuga', 1, 38, '2020-10-09 14:29:26', '2020-10-09 14:29:26');
/*!40000 ALTER TABLE `votoxlugar` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
