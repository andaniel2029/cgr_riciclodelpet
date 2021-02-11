/*
 Navicat Premium Data Transfer

 Source Server         : localhost_xampp_5.x
 Source Server Type    : MySQL
 Source Server Version : 100132
 Source Host           : localhost:3306
 Source Schema         : cgr

 Target Server Type    : MySQL
 Target Server Version : 100132
 File Encoding         : 65001

 Date: 11/02/2021 22:39:15
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for anagrafica
-- ----------------------------
DROP TABLE IF EXISTS `anagrafica`;
CREATE TABLE `anagrafica`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `attivo` int(11) NULL DEFAULT 0,
  `HASH` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `tipo` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `categoria` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `rag_soc` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `indirizzo` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `citta` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `nazione` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `provincia` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `piva` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `telefono` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `web` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `nome` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `cognome` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `PASSWORD` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `privacy` tinyint(4) NULL DEFAULT 0,
  `TIMESTAMP` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `inserimento` int(10) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of anagrafica
-- ----------------------------
INSERT INTO `anagrafica` VALUES (1, 1, NULL, 'cliente', 'produttore', 'Codementor', 'New York, USA', 'New York', '', 'US', '', '123456789', 'http://localhost', 'Super', 'Rich', 'admin@admin.com', 'e10adc3949ba59abbe56e057f20f883e', 1, '2021-02-11 18:07:17', 1613040669);
INSERT INTO `anagrafica` VALUES (3, 1, NULL, 'cliente', 'raccoglitore', 'company', 'street', 'city', 'coutnry', 'province', 'vat', '123456789', 'http://localhost', 'name', 'surname', 'andaniel2029@gmail.com', '90a2cf9cf4cb23c0f6d7fb317bdb2624', 1, '2021-02-11 18:07:20', 1613041367);

-- ----------------------------
-- Table structure for attivazioni
-- ----------------------------
DROP TABLE IF EXISTS `attivazioni`;
CREATE TABLE `attivazioni`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `stringa` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `anagrafica_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `DATA` int(10) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of attivazioni
-- ----------------------------
INSERT INTO `attivazioni` VALUES (1, 'ac7dfa7896b21f8583686ceec59598e3', 1, 1613040669);
INSERT INTO `attivazioni` VALUES (2, '42c56dacec8eabdefa9ad62763537ca2', 2, 1613041137);
INSERT INTO `attivazioni` VALUES (3, 'c5fb815739d5c06074f576c846734100', 3, 1613041367);

-- ----------------------------
-- Table structure for file_offerta
-- ----------------------------
DROP TABLE IF EXISTS `file_offerta`;
CREATE TABLE `file_offerta`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `url` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `thumb` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `inserzione_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `anagrafica_id` int(10) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for file_offerte_clienti
-- ----------------------------
DROP TABLE IF EXISTS `file_offerte_clienti`;
CREATE TABLE `file_offerte_clienti`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `offerta_id` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `url` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for file_upload_temp
-- ----------------------------
DROP TABLE IF EXISTS `file_upload_temp`;
CREATE TABLE `file_upload_temp`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `url` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `sessione_email` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for files
-- ----------------------------
DROP TABLE IF EXISTS `files`;
CREATE TABLE `files`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `url` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `thumb` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `inserzione_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `anagrafica_id` int(10) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for foto
-- ----------------------------
DROP TABLE IF EXISTS `foto`;
CREATE TABLE `foto`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `url` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `thumb` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `inserzione_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `anagrafica_id` int(10) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for foto_offerte_clienti
-- ----------------------------
DROP TABLE IF EXISTS `foto_offerte_clienti`;
CREATE TABLE `foto_offerte_clienti`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `offerta_id` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `foto` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `thumb` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of foto_offerte_clienti
-- ----------------------------
INSERT INTO `foto_offerte_clienti` VALUES (1, '38', '1', 'IMG_24361_thumb.jpg');
INSERT INTO `foto_offerte_clienti` VALUES (2, '39', '1', 'IMG_2436_thumb.jpg');

-- ----------------------------
-- Table structure for foto_upload_temp
-- ----------------------------
DROP TABLE IF EXISTS `foto_upload_temp`;
CREATE TABLE `foto_upload_temp`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `url` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `thumb` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `sessione_email` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for gallery
-- ----------------------------
DROP TABLE IF EXISTS `gallery`;
CREATE TABLE `gallery`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `url` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `thumb` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `TIMESTAMP` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of gallery
-- ----------------------------
INSERT INTO `gallery` VALUES (1, '5ce151893f1754571e64af049d9137ed.jpg', '5ce151893f1754571e64af049d9137ed_thumb.jpg', '2021-02-11 21:42:46');

-- ----------------------------
-- Table structure for inserzione
-- ----------------------------
DROP TABLE IF EXISTS `inserzione`;
CREATE TABLE `inserzione`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `polimero` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `quantita` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `prezzo` float(8, 2) NULL DEFAULT 0.00,
  `descrizione` mediumblob NULL,
  `inserimento` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `scadenza` int(11) NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for news
-- ----------------------------
DROP TABLE IF EXISTS `news`;
CREATE TABLE `news`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `titolo` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `descrizione` mediumblob NULL,
  `attivo` smallint(6) NULL DEFAULT 1,
  `inserimento` int(10) UNSIGNED NULL DEFAULT NULL,
  `TIMESTAMP` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of news
-- ----------------------------
INSERT INTO `news` VALUES (1, 'my news', 0x3C703E68656C6C6F2C206974206973206D79206E6577732E20697420776F726B732077656C6C2E207468616E6B20796F752E3C2F703E0D0A, 1, 1613054599, '2021-02-11 21:43:19');

-- ----------------------------
-- Table structure for off_cli
-- ----------------------------
DROP TABLE IF EXISTS `off_cli`;
CREATE TABLE `off_cli`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cliente_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `offerte_per_cliente_id` int(10) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for offerte
-- ----------------------------
DROP TABLE IF EXISTS `offerte`;
CREATE TABLE `offerte`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `polimero` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `quantita` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `prezzo` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `descrizione` mediumblob NULL,
  `utente_email` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `utente_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `TIMESTAMP` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `inserimento` int(10) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for offerte_per_cliente
-- ----------------------------
DROP TABLE IF EXISTS `offerte_per_cliente`;
CREATE TABLE `offerte_per_cliente`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `polimero` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `quantita` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `prezzo` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `resa` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `imballo` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `peso` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `mezzo` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `cer` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `rifiuto` varchar(3) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `descrizione` mediumblob NULL,
  `codice` int(10) UNSIGNED ZEROFILL NULL DEFAULT NULL,
  `scadenza` int(10) UNSIGNED NULL DEFAULT NULL,
  `id_offerta_originale` int(10) UNSIGNED NULL DEFAULT NULL,
  `attivo` int(10) UNSIGNED NULL DEFAULT NULL,
  `TIMESTAMP` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `inserimento` int(10) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 40 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of offerte_per_cliente
-- ----------------------------
INSERT INTO `offerte_per_cliente` VALUES (38, 'nome', 'polimero', 'quantita', 'prezzo', 'resa', 'imballo', 'peso', 'mezzo', 'cer', 'rif', 0x596D787659673D3D, 0000000012, 1, 1, 1, '2021-02-11 17:31:37', 1);
INSERT INTO `offerte_per_cliente` VALUES (39, 'nome', 'polimero', 'quantita', 'prezzo', 'resa', 'imballo', 'peso', 'mezzo', 'cer', 'rif', 0x596D787659673D3D, 0000000012, 1, 1, 1, '2021-02-11 17:31:37', 1);

-- ----------------------------
-- Table structure for statiche
-- ----------------------------
DROP TABLE IF EXISTS `statiche`;
CREATE TABLE `statiche`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `home` mediumblob NULL,
  `clienti` mediumblob NULL,
  `fornitori` mediumblob NULL,
  `produzione` mediumblob NULL,
  `contatti` mediumblob NULL,
  `home_en` mediumblob NULL,
  `clienti_en` mediumblob NULL,
  `fornitori_en` mediumblob NULL,
  `produzione_en` mediumblob NULL,
  `contatti_en` mediumblob NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of statiche
-- ----------------------------
INSERT INTO `statiche` VALUES (1, 0x31, 0x33, 0x35, 0x37, 0x39, 0x32, 0x34, 0x36, 0x38, 0x3130);

SET FOREIGN_KEY_CHECKS = 1;