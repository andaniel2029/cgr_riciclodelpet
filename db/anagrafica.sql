/*
 Navicat Premium Data Transfer

 Source Server         : localhost_xampp_5.x
 Source Server Type    : MySQL
 Source Server Version : 100132
 Source Host           : localhost:3306
 Source Schema         : sql1521697_1

 Target Server Type    : MySQL
 Target Server Version : 100132
 File Encoding         : 65001

 Date: 20/02/2021 06:19:24
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
  `password` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `privacy` tinyint(4) NULL DEFAULT 0,
  `timestamp` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `inserimento` int(10) UNSIGNED NULL DEFAULT NULL,
  `chiave` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of anagrafica
-- ----------------------------
INSERT INTO `anagrafica` VALUES (1, 1, NULL, 'cliente', 'produttore', 'Codementor', 'New York, USA', 'New York', '', 'US', '', '123456789', 'http://localhost', 'Super', 'Rich', 'admin@admin.com', 'e10adc3949ba59abbe56e057f20f883e', 1, '2021-02-11 17:07:17', 1613040669, NULL);
INSERT INTO `anagrafica` VALUES (3, 1, NULL, 'cliente', 'raccoglitore', 'company', 'street', 'city', 'coutnry', 'province', 'vat', '123456789', 'http://localhost', 'name', 'surname', 'andaniel2029@gmail.com', '90a2cf9cf4cb23c0f6d7fb317bdb2624', 1, '2021-02-11 17:07:20', 1613041367, NULL);
INSERT INTO `anagrafica` VALUES (4, 1, NULL, 'cliente', 'produttore', 'C.G.R. srl', '', '', '', '', '', '', '', 'Alberto', 'Rimini', 'a.rimini@cgr-riciclodelpet.it', '14e526398975f8679c0dde8dddf5a687', 1, '2021-02-14 11:30:48', 1613147900, NULL);
INSERT INTO `anagrafica` VALUES (5, 1, NULL, 'cliente', 'produttore', 'Juliana de Almeida', '', 'Milano', '', '', '', '', '', 'Juliana', 'de Almeida', 'juliana_almeida@hotmail.com', '40d61f7fdc6f5d3e06ec13189c823847', 1, '2021-02-19 19:27:28', 1613762820, NULL);

SET FOREIGN_KEY_CHECKS = 1;
