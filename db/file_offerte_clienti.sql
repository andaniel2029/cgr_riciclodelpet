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

 Date: 20/02/2021 06:16:35
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for file_offerte_clienti
-- ----------------------------
DROP TABLE IF EXISTS `file_offerte_clienti`;
CREATE TABLE `file_offerte_clienti`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `offerta_id` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `url` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `nome` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

SET FOREIGN_KEY_CHECKS = 1;
