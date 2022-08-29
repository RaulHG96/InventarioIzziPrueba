/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50724
Source Host           : 127.0.0.1:3306
Source Database       : inventariodb

Target Server Type    : MYSQL
Target Server Version : 50724
File Encoding         : 65001

Date: 2022-08-29 17:09:44
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for catcategoria
-- ----------------------------
DROP TABLE IF EXISTS `catcategoria`;
CREATE TABLE `catcategoria` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `nombreCategoria` varchar(20) NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of catcategoria
-- ----------------------------
INSERT INTO `catcategoria` VALUES ('1', 'Electrónica', '2022-08-28 15:25:06', null);
INSERT INTO `catcategoria` VALUES ('2', 'Línea Blanca', '2022-08-28 15:25:06', null);
INSERT INTO `catcategoria` VALUES ('3', 'Deportes', '2022-08-28 15:25:06', null);
INSERT INTO `catcategoria` VALUES ('4', 'Alimentos', '2022-08-28 15:25:06', null);
INSERT INTO `catcategoria` VALUES ('5', 'Jardín', '2022-08-28 15:25:06', null);

-- ----------------------------
-- Table structure for catperfil
-- ----------------------------
DROP TABLE IF EXISTS `catperfil`;
CREATE TABLE `catperfil` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `nombrePerfil` varchar(20) NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of catperfil
-- ----------------------------
INSERT INTO `catperfil` VALUES ('1', 'Administrador', '2022-08-28 15:25:06', null);
INSERT INTO `catperfil` VALUES ('2', 'Capturista', '2022-08-28 15:25:06', null);

-- ----------------------------
-- Table structure for catsucursal
-- ----------------------------
DROP TABLE IF EXISTS `catsucursal`;
CREATE TABLE `catsucursal` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `nombreSucursal` varchar(20) NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of catsucursal
-- ----------------------------
INSERT INTO `catsucursal` VALUES ('1', 'Cuernavaca', '2022-08-28 15:25:06', null);
INSERT INTO `catsucursal` VALUES ('2', 'Yautepec', '2022-08-28 15:25:06', null);
INSERT INTO `catsucursal` VALUES ('3', 'Cuautla', '2022-08-28 15:25:06', null);
INSERT INTO `catsucursal` VALUES ('4', 'Acapulco', '2022-08-28 15:25:06', null);

-- ----------------------------
-- Table structure for comentario
-- ----------------------------
DROP TABLE IF EXISTS `comentario`;
CREATE TABLE `comentario` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `comentario` varchar(100) NOT NULL DEFAULT '',
  `idProducto` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comentario_idproducto_foreign` (`idProducto`),
  CONSTRAINT `comentario_idproducto_foreign` FOREIGN KEY (`idProducto`) REFERENCES `producto` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of comentario
-- ----------------------------
INSERT INTO `comentario` VALUES ('2', 'adsfasdf', '6', '2022-08-29 18:11:26', '2022-08-29 18:11:26');
INSERT INTO `comentario` VALUES ('3', 'Comentario', '16', '2022-08-29 21:59:39', '2022-08-29 21:59:39');

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('1', '2014_10_12_100000_create_password_resets_table', '1');
INSERT INTO `migrations` VALUES ('2', '2019_08_19_000000_create_failed_jobs_table', '1');
INSERT INTO `migrations` VALUES ('3', '2019_12_14_000001_create_personal_access_tokens_table', '1');
INSERT INTO `migrations` VALUES ('4', '2022_08_27_225707_create_cat_categoria_table', '1');
INSERT INTO `migrations` VALUES ('5', '2022_08_27_225850_create_cat_sucursal_table', '1');
INSERT INTO `migrations` VALUES ('6', '2022_08_27_225918_create_cat_perfil_table', '1');
INSERT INTO `migrations` VALUES ('7', '2022_08_27_225935_create_usuario_table', '1');
INSERT INTO `migrations` VALUES ('8', '2022_08_27_230000_create_producto_table', '1');
INSERT INTO `migrations` VALUES ('9', '2022_08_27_230016_create_comentario_table', '1');

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of personal_access_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for producto
-- ----------------------------
DROP TABLE IF EXISTS `producto`;
CREATE TABLE `producto` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombreProducto` varchar(30) NOT NULL DEFAULT '',
  `descripcion` varchar(100) NOT NULL DEFAULT '',
  `precio` varchar(5) NOT NULL DEFAULT '',
  `fechaCompra` date NOT NULL,
  `estado` enum('','Abierto','Cerrado') NOT NULL DEFAULT '',
  `idCategoria` smallint(5) unsigned NOT NULL,
  `idSucursal` smallint(5) unsigned NOT NULL,
  `idUsuario` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `producto_idcategoria_foreign` (`idCategoria`),
  KEY `producto_idsucursal_foreign` (`idSucursal`),
  KEY `producto_idusuario_foreign` (`idUsuario`),
  CONSTRAINT `producto_idcategoria_foreign` FOREIGN KEY (`idCategoria`) REFERENCES `catcategoria` (`id`),
  CONSTRAINT `producto_idsucursal_foreign` FOREIGN KEY (`idSucursal`) REFERENCES `catsucursal` (`id`),
  CONSTRAINT `producto_idusuario_foreign` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of producto
-- ----------------------------
INSERT INTO `producto` VALUES ('6', 'Preoducto1', 'Descripción', '12.55', '2022-05-12', 'Abierto', '4', '4', '1', '2022-08-29 15:45:43', '2022-08-29 18:11:26');
INSERT INTO `producto` VALUES ('7', 'producnto', 'asdf', '102.5', '2022-08-28', 'Abierto', '3', '3', '1', '2022-08-29 01:07:07', '2022-08-29 15:27:12');
INSERT INTO `producto` VALUES ('8', 'sdfgsd', 'asdfasdf', '234', '2022-08-28', '', '1', '3', '1', '2022-08-29 02:08:26', '2022-08-29 02:08:26');
INSERT INTO `producto` VALUES ('10', 'producnto', 'asdf', '102.5', '2022-08-28', 'Abierto', '3', '3', '1', '2022-08-29 01:07:07', '2022-08-29 15:27:12');
INSERT INTO `producto` VALUES ('11', 'sdfgsd', 'asdfasdf', '234', '2022-08-28', '', '1', '3', '1', '2022-08-29 02:08:26', '2022-08-29 02:08:26');
INSERT INTO `producto` VALUES ('12', 'Preoducto1', 'Descripción', '12.55', '2022-05-12', '', '4', '4', '1', '2022-08-29 15:45:43', '2022-08-29 15:45:43');
INSERT INTO `producto` VALUES ('13', 'producnto', 'asdf', '102.5', '2022-08-28', 'Abierto', '3', '3', '1', '2022-08-29 01:07:07', '2022-08-29 15:27:12');
INSERT INTO `producto` VALUES ('14', 'sdfgsd', 'asdfasdf', '234', '2022-08-28', '', '1', '3', '1', '2022-08-29 02:08:26', '2022-08-29 02:08:26');
INSERT INTO `producto` VALUES ('15', 'Preoducto1', 'Descripción', '12.55', '2022-05-12', '', '4', '4', '1', '2022-08-29 15:45:43', '2022-08-29 15:45:43');
INSERT INTO `producto` VALUES ('16', 'Producto 2', 'Descripción del producto', '123', '2022-02-20', 'Abierto', '4', '4', '3', '2022-08-29 21:58:59', '2022-08-29 21:59:38');

-- ----------------------------
-- Table structure for usuario
-- ----------------------------
DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(80) NOT NULL DEFAULT '',
  `apPaterno` varchar(50) NOT NULL DEFAULT '',
  `apMaterno` varchar(50) NOT NULL DEFAULT '',
  `usuario` varchar(30) NOT NULL DEFAULT '',
  `contrasenia` varchar(80) NOT NULL DEFAULT '',
  `acceso` tinyint(4) NOT NULL DEFAULT '1',
  `idPerfil` smallint(5) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuario_usuario_unique` (`usuario`),
  KEY `usuario_idperfil_foreign` (`idPerfil`),
  CONSTRAINT `usuario_idperfil_foreign` FOREIGN KEY (`idPerfil`) REFERENCES `catperfil` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of usuario
-- ----------------------------
INSERT INTO `usuario` VALUES ('1', 'Raul', 'Hidalgo', 'Gaspar', 'raul.hidalgo', '$2y$10$aKQqq.uKS8Gu9ZXyhhYsO.2hIjy8BWrhnb3lB/h3llskebTicX8Ei', '1', '1', '2022-08-28 15:25:06', null);
INSERT INTO `usuario` VALUES ('3', 'raul', 'hidalgo', 'gaspar', 'raul.hidalgo2', '$2y$10$ZveseH5S78TJmZlvmz6fbeMOAELTI4tijg/seeV11Wm1LfQ.eVqP6', '1', '2', '2022-08-29 20:16:52', '2022-08-29 20:16:52');
