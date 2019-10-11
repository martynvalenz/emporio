# ************************************************************
# Sequel Pro SQL dump
# Versión 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.20)
# Base de datos: emporio
# Tiempo de Generación: 2018-02-09 05:04:50 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Volcado de tabla estados_cuenta
# ------------------------------------------------------------

DROP TABLE IF EXISTS `estados_cuenta`;

CREATE TABLE `estados_cuenta` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tipo` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `concepto` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha_compromiso` date DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `con_iva` tinyint(1) NOT NULL,
  `folio` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cheque` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `movimiento` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtotal` decimal(18,2) NOT NULL,
  `porcentaje_iva` decimal(18,2) NOT NULL,
  `iva` decimal(18,2) NOT NULL,
  `total` decimal(18,2) NOT NULL,
  `estatus` enum('Pagado','Pendiente','Cancelado') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `cancelado_at` datetime DEFAULT NULL,
  `pagado` int(11) DEFAULT NULL,
  `id_categoria` int(10) unsigned DEFAULT NULL,
  `id_forma_pago` int(10) unsigned DEFAULT NULL,
  `id_cuenta` int(10) unsigned DEFAULT NULL,
  `id_admin` int(10) unsigned NOT NULL,
  `id_cliente` int(10) unsigned DEFAULT NULL,
  `id_servicio` int(10) unsigned DEFAULT NULL,
  `id_razon_social` int(10) unsigned DEFAULT NULL,
  `id_proveedor` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `estados_cuenta_id_categoria_foreign` (`id_categoria`),
  KEY `estados_cuenta_id_forma_pago_foreign` (`id_forma_pago`),
  KEY `estados_cuenta_id_cuenta_foreign` (`id_cuenta`),
  KEY `estados_cuenta_id_admin_foreign` (`id_admin`),
  KEY `estados_cuenta_id_cliente_foreign` (`id_cliente`),
  KEY `estados_cuenta_id_razon_social_foreign` (`id_razon_social`),
  KEY `estados_cuenta_id_proveedor_foreign` (`id_proveedor`),
  KEY `estados_cuenta_id_servicio_foreign` (`id_servicio`),
  CONSTRAINT `estados_cuenta_id_admin_foreign` FOREIGN KEY (`id_admin`) REFERENCES `admins` (`id`),
  CONSTRAINT `estados_cuenta_id_categoria_foreign` FOREIGN KEY (`id_categoria`) REFERENCES `categoria_egresos` (`id`),
  CONSTRAINT `estados_cuenta_id_cliente_foreign` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`),
  CONSTRAINT `estados_cuenta_id_cuenta_foreign` FOREIGN KEY (`id_cuenta`) REFERENCES `cuentas` (`id`),
  CONSTRAINT `estados_cuenta_id_forma_pago_foreign` FOREIGN KEY (`id_forma_pago`) REFERENCES `formas_pago` (`id`),
  CONSTRAINT `estados_cuenta_id_proveedor_foreign` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedores` (`id`),
  CONSTRAINT `estados_cuenta_id_razon_social_foreign` FOREIGN KEY (`id_razon_social`) REFERENCES `razones_sociales` (`id`),
  CONSTRAINT `estados_cuenta_id_servicio_foreign` FOREIGN KEY (`id_servicio`) REFERENCES `servicios` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `estados_cuenta` WRITE;
/*!40000 ALTER TABLE `estados_cuenta` DISABLE KEYS */;

INSERT INTO `estados_cuenta` (`id`, `tipo`, `concepto`, `fecha_compromiso`, `fecha`, `con_iva`, `folio`, `cheque`, `movimiento`, `subtotal`, `porcentaje_iva`, `iva`, `total`, `estatus`, `created_at`, `updated_at`, `cancelado_at`, `pagado`, `id_categoria`, `id_forma_pago`, `id_cuenta`, `id_admin`, `id_cliente`, `id_servicio`, `id_razon_social`, `id_proveedor`)
VALUES
	(1,'Egreso',NULL,NULL,'2018-02-04',1,NULL,NULL,NULL,767.24,16.00,122.76,890.00,'Pendiente','2018-02-05 21:51:47','2018-02-08 12:18:18',NULL,0,1,1,1,2,NULL,NULL,NULL,1),
	(2,'Egreso','Se pagó la segunda parcialidad',NULL,'2018-02-06',1,NULL,NULL,NULL,10000.00,16.00,0.00,10000.00,'Pendiente','2018-02-05 21:55:55','2018-02-08 16:31:01','2018-02-08 00:00:00',0,5,3,2,2,NULL,NULL,NULL,2),
	(3,'Egreso','servicios',NULL,'2018-02-07',1,NULL,NULL,'8908',9898.00,16.00,0.00,9898.00,'Pendiente','2018-02-07 20:04:29','2018-02-08 16:30:47','2018-02-08 00:00:00',0,5,3,2,2,NULL,NULL,NULL,2),
	(4,'Egreso',NULL,NULL,'2018-02-07',1,NULL,NULL,NULL,4000.00,16.00,0.00,4000.00,'Pendiente','2018-02-07 23:00:53','2018-02-08 16:30:57','2018-02-08 00:00:00',0,1,1,1,2,NULL,NULL,NULL,1),
	(5,'Egreso',NULL,NULL,'2018-02-08',0,NULL,NULL,NULL,890.00,16.00,0.00,890.00,'Pagado','2018-02-08 07:28:37','2018-02-08 07:28:37',NULL,1,1,1,1,2,NULL,NULL,NULL,1),
	(6,'Egreso',NULL,NULL,'2018-02-08',1,NULL,NULL,NULL,897.00,16.00,0.00,897.00,'Pagado','2018-02-08 07:29:08','2018-02-08 07:29:08',NULL,1,6,1,1,2,NULL,NULL,NULL,1),
	(7,'Egreso',NULL,NULL,'2018-02-08',1,NULL,NULL,NULL,234.00,16.00,0.00,234.00,'Pagado','2018-02-08 08:59:51','2018-02-08 08:59:51',NULL,1,8,1,1,2,NULL,NULL,NULL,1),
	(8,'Egreso',NULL,NULL,'2018-02-08',0,NULL,NULL,NULL,1200.00,16.00,0.00,1200.00,'Pendiente','2018-02-08 09:25:24','2018-02-08 17:21:17','2018-02-08 17:21:17',0,8,1,1,2,NULL,NULL,NULL,1),
	(9,'Egreso',NULL,NULL,'2018-02-08',1,NULL,NULL,NULL,491.38,16.00,78.62,570.00,'Pagado','2018-02-08 09:26:47','2018-02-08 17:07:00','2018-02-08 00:00:00',NULL,3,1,1,2,NULL,NULL,NULL,1),
	(10,'Egreso',NULL,NULL,'2018-02-08',1,NULL,NULL,NULL,7758.62,16.00,1241.38,9000.00,'Pagado','2018-02-08 09:32:19','2018-02-08 17:08:04','2018-02-08 17:08:04',NULL,5,1,1,2,NULL,NULL,NULL,1),
	(11,'Egreso',NULL,NULL,'2018-02-08',1,NULL,NULL,NULL,8448.28,16.00,1351.72,9800.00,'Pendiente','2018-02-08 09:34:14','2018-02-08 17:20:31','2018-02-08 17:20:31',0,5,1,1,2,NULL,NULL,NULL,1),
	(12,'Egreso',NULL,NULL,'2018-02-08',1,NULL,NULL,NULL,200.00,16.00,0.00,200.00,'Pendiente','2018-02-08 10:01:11','2018-02-08 17:20:38','2018-02-08 17:20:38',0,4,1,1,2,NULL,NULL,NULL,1),
	(13,'Egreso',NULL,NULL,'2018-02-08',0,NULL,NULL,NULL,200.00,16.00,0.00,200.00,'Pendiente','2018-02-08 10:01:40','2018-02-08 17:20:47','2018-02-08 17:20:47',0,4,1,1,2,NULL,NULL,NULL,1),
	(14,'Egreso',NULL,NULL,'2018-02-08',1,NULL,NULL,NULL,700.00,16.00,0.00,700.00,'Pendiente','2018-02-08 10:23:53','2018-02-08 17:20:55','2018-02-08 17:20:55',0,1,1,1,2,NULL,NULL,NULL,1),
	(15,'Egreso',NULL,NULL,'2018-02-08',1,NULL,NULL,NULL,689.66,16.00,110.34,800.00,'Pagado','2018-02-08 10:25:27','2018-02-08 17:21:29','2018-02-08 17:21:29',1,1,1,1,2,NULL,NULL,NULL,1),
	(16,'Egreso',NULL,NULL,'2018-02-08',0,NULL,NULL,NULL,800.00,16.00,0.00,800.00,'Cancelado','2018-02-08 10:25:56','2018-02-08 17:26:17','2018-02-08 17:26:17',1,1,1,1,2,NULL,NULL,NULL,1),
	(17,'Egreso',NULL,NULL,'2018-02-08',0,NULL,NULL,NULL,600.00,0.00,0.00,600.00,'Pagado','2018-02-08 10:30:09','2018-02-08 10:30:09',NULL,1,1,1,1,2,NULL,NULL,NULL,1);

/*!40000 ALTER TABLE `estados_cuenta` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
