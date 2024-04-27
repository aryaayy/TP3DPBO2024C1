/*
 Navicat Premium Data Transfer

 Source Server         : conn
 Source Server Type    : MySQL
 Source Server Version : 100432 (10.4.32-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : db_valorant

 Target Server Type    : MySQL
 Target Server Version : 100432 (10.4.32-MariaDB)
 File Encoding         : 65001

 Date: 27/04/2024 19:02:29
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for country
-- ----------------------------
DROP TABLE IF EXISTS `country`;
CREATE TABLE `country`  (
  `country_id` int NOT NULL AUTO_INCREMENT,
  `country_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`country_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of country
-- ----------------------------
INSERT INTO `country` VALUES (1, 'Indonesia');
INSERT INTO `country` VALUES (2, 'South Korea');
INSERT INTO `country` VALUES (3, 'Singapore');
INSERT INTO `country` VALUES (4, 'USA');
INSERT INTO `country` VALUES (5, 'Canada');

-- ----------------------------
-- Table structure for player
-- ----------------------------
DROP TABLE IF EXISTS `player`;
CREATE TABLE `player`  (
  `player_id` int NOT NULL AUTO_INCREMENT,
  `player_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `player_realname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `player_age` int NOT NULL,
  `player_photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `country_id` int NOT NULL,
  `team_id` int NOT NULL,
  PRIMARY KEY (`player_id`) USING BTREE,
  INDEX `country_id`(`country_id` ASC) USING BTREE,
  INDEX `team_id`(`team_id` ASC) USING BTREE,
  CONSTRAINT `player_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `country` (`country_id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `player_ibfk_2` FOREIGN KEY (`team_id`) REFERENCES `team` (`team_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of player
-- ----------------------------
INSERT INTO `player` VALUES (1, 'f0rsakeN', 'Jason Susanto', 20, 'f0rsaken.jpg', 1, 1);
INSERT INTO `player` VALUES (6, 't3xture', 'Kim Na-ra', 24, 't3xture.jpg', 2, 6);
INSERT INTO `player` VALUES (7, 'TenZ', 'Tyson Ngo', 22, 'tenz.jpg', 5, 2);
INSERT INTO `player` VALUES (8, 'Xeppaa', 'Erick Bach', 23, 'xeppaa.jpg', 4, 8);

-- ----------------------------
-- Table structure for team
-- ----------------------------
DROP TABLE IF EXISTS `team`;
CREATE TABLE `team`  (
  `team_id` int NOT NULL AUTO_INCREMENT,
  `team_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `team_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`team_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of team
-- ----------------------------
INSERT INTO `team` VALUES (1, 'PRX', 'Paper Rex');
INSERT INTO `team` VALUES (2, 'SEN', 'Sentinels');
INSERT INTO `team` VALUES (3, 'RRQ', 'Rex Regum Qeon');
INSERT INTO `team` VALUES (4, 'FNC', 'FNATIC');
INSERT INTO `team` VALUES (6, 'GEN', 'Gen.G');
INSERT INTO `team` VALUES (8, 'C9', 'Cloud9');
INSERT INTO `team` VALUES (10, 'GE', 'Global E-Sports');

SET FOREIGN_KEY_CHECKS = 1;
