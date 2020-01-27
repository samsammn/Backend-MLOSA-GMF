/*
 Navicat Premium Data Transfer

 Source Server         : Mysql_Local
 Source Server Type    : MySQL
 Source Server Version : 100410
 Source Host           : localhost:3306
 Source Schema         : mlosa_gmf

 Target Server Type    : MySQL
 Target Server Version : 100410
 File Encoding         : 65001

 Date: 27/01/2020 09:14:58
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for activities
-- ----------------------------
DROP TABLE IF EXISTS `activities`;
CREATE TABLE `activities`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 17 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of activities
-- ----------------------------
INSERT INTO `activities` VALUES (1, 'Safety');
INSERT INTO `activities` VALUES (2, 'Turnover or Completion');
INSERT INTO `activities` VALUES (4, 'Procedures');
INSERT INTO `activities` VALUES (5, 'Tools and Equipment');
INSERT INTO `activities` VALUES (6, 'Hazard (Threat) Management');
INSERT INTO `activities` VALUES (7, 'Parts, Materials & Prep');
INSERT INTO `activities` VALUES (8, 'Communication & Coordination');
INSERT INTO `activities` VALUES (9, 'Personnel');
INSERT INTO `activities` VALUES (10, 'Hazard (Threat ) Management');
INSERT INTO `activities` VALUES (11, 'Parts & Materials');
INSERT INTO `activities` VALUES (12, 'Research & Preparation');
INSERT INTO `activities` VALUES (13, 'Technical Data');
INSERT INTO `activities` VALUES (16, 'Test Activity Aja 2');

-- ----------------------------
-- Table structure for maintenance_process_details
-- ----------------------------
DROP TABLE IF EXISTS `maintenance_process_details`;
CREATE TABLE `maintenance_process_details`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `mp_id` bigint(20) NOT NULL,
  `activity_id` bigint(20) NOT NULL,
  `sub_activity_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 96 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of maintenance_process_details
-- ----------------------------
INSERT INTO `maintenance_process_details` VALUES (1, 8, 7, 31);
INSERT INTO `maintenance_process_details` VALUES (2, 8, 4, 32);
INSERT INTO `maintenance_process_details` VALUES (3, 8, 6, 33);
INSERT INTO `maintenance_process_details` VALUES (4, 8, 8, 3);
INSERT INTO `maintenance_process_details` VALUES (5, 4, 8, 3);
INSERT INTO `maintenance_process_details` VALUES (6, 4, 4, 4);
INSERT INTO `maintenance_process_details` VALUES (8, 4, 4, 23);
INSERT INTO `maintenance_process_details` VALUES (9, 4, 8, 3);
INSERT INTO `maintenance_process_details` VALUES (10, 4, 2, 2);
INSERT INTO `maintenance_process_details` VALUES (11, 4, 1, 1);
INSERT INTO `maintenance_process_details` VALUES (12, 4, 2, 12);
INSERT INTO `maintenance_process_details` VALUES (13, 4, 9, 14);
INSERT INTO `maintenance_process_details` VALUES (14, 4, 8, 19);
INSERT INTO `maintenance_process_details` VALUES (15, 7, 8, 22);
INSERT INTO `maintenance_process_details` VALUES (16, 7, 8, 21);
INSERT INTO `maintenance_process_details` VALUES (17, 3, 4, 6);
INSERT INTO `maintenance_process_details` VALUES (18, 3, 8, 3);
INSERT INTO `maintenance_process_details` VALUES (19, 3, 5, 5);
INSERT INTO `maintenance_process_details` VALUES (20, 3, 4, 7);
INSERT INTO `maintenance_process_details` VALUES (21, 3, 11, 37);
INSERT INTO `maintenance_process_details` VALUES (22, 3, 11, 38);
INSERT INTO `maintenance_process_details` VALUES (23, 3, 6, 8);
INSERT INTO `maintenance_process_details` VALUES (24, 1, 4, 18);
INSERT INTO `maintenance_process_details` VALUES (25, 1, 1, 26);
INSERT INTO `maintenance_process_details` VALUES (26, 1, 1, 17);
INSERT INTO `maintenance_process_details` VALUES (27, 1, 1, 10);
INSERT INTO `maintenance_process_details` VALUES (28, 1, 1, 1);
INSERT INTO `maintenance_process_details` VALUES (29, 1, 8, 19);
INSERT INTO `maintenance_process_details` VALUES (30, 5, 11, 27);
INSERT INTO `maintenance_process_details` VALUES (31, 5, 11, 28);
INSERT INTO `maintenance_process_details` VALUES (32, 5, 4, 29);
INSERT INTO `maintenance_process_details` VALUES (33, 5, 5, 15);
INSERT INTO `maintenance_process_details` VALUES (34, 5, 2, 12);
INSERT INTO `maintenance_process_details` VALUES (35, 5, 2, 16);
INSERT INTO `maintenance_process_details` VALUES (36, 5, 2, 2);
INSERT INTO `maintenance_process_details` VALUES (37, 2, 8, 25);
INSERT INTO `maintenance_process_details` VALUES (38, 2, 7, 11);
INSERT INTO `maintenance_process_details` VALUES (39, 2, 7, 24);
INSERT INTO `maintenance_process_details` VALUES (40, 2, 9, 14);
INSERT INTO `maintenance_process_details` VALUES (41, 2, 4, 30);
INSERT INTO `maintenance_process_details` VALUES (42, 2, 4, 34);
INSERT INTO `maintenance_process_details` VALUES (43, 2, 1, 1);
INSERT INTO `maintenance_process_details` VALUES (44, 2, 5, 5);
INSERT INTO `maintenance_process_details` VALUES (45, 2, 2, 2);
INSERT INTO `maintenance_process_details` VALUES (46, 6, 6, 20);
INSERT INTO `maintenance_process_details` VALUES (47, 6, 1, 1);
INSERT INTO `maintenance_process_details` VALUES (48, 9, 12, 35);
INSERT INTO `maintenance_process_details` VALUES (49, 9, 13, 36);
INSERT INTO `maintenance_process_details` VALUES (68, 15, 5, 1);
INSERT INTO `maintenance_process_details` VALUES (69, 15, 5, 3);
INSERT INTO `maintenance_process_details` VALUES (70, 15, 5, 5);
INSERT INTO `maintenance_process_details` VALUES (71, 15, 7, 2);
INSERT INTO `maintenance_process_details` VALUES (72, 15, 7, 4);
INSERT INTO `maintenance_process_details` VALUES (73, 15, 8, 6);
INSERT INTO `maintenance_process_details` VALUES (92, 16, 5, 1);
INSERT INTO `maintenance_process_details` VALUES (93, 16, 5, 2);
INSERT INTO `maintenance_process_details` VALUES (94, 16, 5, 3);
INSERT INTO `maintenance_process_details` VALUES (95, 16, 7, 8);

-- ----------------------------
-- Table structure for maintenance_processes
-- ----------------------------
DROP TABLE IF EXISTS `maintenance_processes`;
CREATE TABLE `maintenance_processes`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 17 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of maintenance_processes
-- ----------------------------
INSERT INTO `maintenance_processes` VALUES (1, 'Removal');
INSERT INTO `maintenance_processes` VALUES (2, 'Servicing');
INSERT INTO `maintenance_processes` VALUES (3, 'Prepare to install');
INSERT INTO `maintenance_processes` VALUES (4, 'Installation');
INSERT INTO `maintenance_processes` VALUES (5, 'Removal Preparation');
INSERT INTO `maintenance_processes` VALUES (6, 'Test');
INSERT INTO `maintenance_processes` VALUES (7, 'Maintenance Plan');
INSERT INTO `maintenance_processes` VALUES (8, 'Close up / Restore');
INSERT INTO `maintenance_processes` VALUES (9, 'Troubleshooting');
INSERT INTO `maintenance_processes` VALUES (15, 'Test MP Aja');
INSERT INTO `maintenance_processes` VALUES (16, 'Test OKE');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 25 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2019_12_17_002849_create_observations_table', 1);
INSERT INTO `migrations` VALUES (2, '2019_12_17_003942_create_observation_logs_table', 1);
INSERT INTO `migrations` VALUES (3, '2019_12_17_004025_create_users_table', 1);
INSERT INTO `migrations` VALUES (4, '2019_12_17_004153_create_uics_table', 1);
INSERT INTO `migrations` VALUES (5, '2019_12_17_004243_create_maintenance_processes_table', 1);
INSERT INTO `migrations` VALUES (6, '2019_12_17_004300_create_mlosa_plans_table', 1);
INSERT INTO `migrations` VALUES (7, '2019_12_17_004326_create_observation_details_table', 1);
INSERT INTO `migrations` VALUES (8, '2019_12_17_004355_create_maintenance_process_details_table', 1);
INSERT INTO `migrations` VALUES (9, '2019_12_17_005307_create_activities_table', 1);
INSERT INTO `migrations` VALUES (10, '2019_12_17_005334_create_sub_activities_table', 1);
INSERT INTO `migrations` VALUES (11, '2019_12_17_005352_create_safety_risks_table', 1);
INSERT INTO `migrations` VALUES (12, '2019_12_17_005416_create_threat_codes_table', 1);
INSERT INTO `migrations` VALUES (13, '2019_12_17_005445_create_risk_indices_table', 1);
INSERT INTO `migrations` VALUES (14, '2019_12_17_010052_create_risk_probabilities_table', 1);
INSERT INTO `migrations` VALUES (15, '2019_12_17_010106_create_risk_severities_table', 1);
INSERT INTO `migrations` VALUES (16, '2019_12_17_010120_create_risk_values_table', 1);
INSERT INTO `migrations` VALUES (17, '2019_12_17_010133_create_risk_controls_table', 1);
INSERT INTO `migrations` VALUES (18, '2020_01_01_025730_create_sub_threat_codes_table', 2);
INSERT INTO `migrations` VALUES (19, '2020_01_02_002849_create_observations_table', 2);
INSERT INTO `migrations` VALUES (20, '2020_01_02_004326_create_observation_details_table', 2);
INSERT INTO `migrations` VALUES (21, '2020_01_02_005334_create_sub_activities_table', 2);
INSERT INTO `migrations` VALUES (22, '2020_01_01_025731_create_sub_threat_codes_table', 3);
INSERT INTO `migrations` VALUES (24, '2020_01_15_005020_create_observation_teams_table', 4);

-- ----------------------------
-- Table structure for observation_details
-- ----------------------------
DROP TABLE IF EXISTS `observation_details`;
CREATE TABLE `observation_details`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `observation_id` bigint(20) NOT NULL,
  `mp_detail_id` bigint(20) NULL DEFAULT NULL,
  `activity_id` int(11) NULL DEFAULT NULL,
  `sub_activity_id` int(11) NULL DEFAULT NULL,
  `safety_risk` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `sub_threat_codes_id` int(11) NULL DEFAULT NULL,
  `risk_index` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `control_efectivenes` int(11) NULL DEFAULT NULL,
  `effectively_managed` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `error_outcome` int(2) NULL DEFAULT NULL,
  `remark` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of observation_details
-- ----------------------------
INSERT INTO `observation_details` VALUES (1, 18, NULL, 1, 18, 'S', 2, '5D', NULL, 'Y', 1, NULL);
INSERT INTO `observation_details` VALUES (2, 18, NULL, 1, 26, 'AR', 3, '3E', NULL, 'N', 1, NULL);
INSERT INTO `observation_details` VALUES (3, 18, NULL, 1, 17, 'S', 6, '2C', NULL, 'N', 3, NULL);
INSERT INTO `observation_details` VALUES (4, 18, NULL, 1, 10, 'S', 8, '5A', NULL, 'N', 3, NULL);
INSERT INTO `observation_details` VALUES (5, 19, NULL, 1, 18, 'S', 2, '5D', NULL, 'Y', 1, NULL);
INSERT INTO `observation_details` VALUES (6, 19, NULL, 1, 26, 'AR', 3, '3E', NULL, 'N', 1, NULL);
INSERT INTO `observation_details` VALUES (7, 19, NULL, 1, 17, 'S', 6, '2C', NULL, 'N', 3, NULL);
INSERT INTO `observation_details` VALUES (8, 19, NULL, 1, 10, 'S', 8, '5A', NULL, 'N', 3, NULL);

-- ----------------------------
-- Table structure for observation_logs
-- ----------------------------
DROP TABLE IF EXISTS `observation_logs`;
CREATE TABLE `observation_logs`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `observation_id` bigint(20) NOT NULL,
  `activity` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_log` datetime(0) NOT NULL,
  `status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for observation_teams
-- ----------------------------
DROP TABLE IF EXISTS `observation_teams`;
CREATE TABLE `observation_teams`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `observation_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of observation_teams
-- ----------------------------
INSERT INTO `observation_teams` VALUES (1, 18, 1);
INSERT INTO `observation_teams` VALUES (2, 18, 2);
INSERT INTO `observation_teams` VALUES (3, 18, 4);
INSERT INTO `observation_teams` VALUES (4, 18, 6);
INSERT INTO `observation_teams` VALUES (5, 19, 1);
INSERT INTO `observation_teams` VALUES (6, 19, 2);
INSERT INTO `observation_teams` VALUES (7, 19, 4);
INSERT INTO `observation_teams` VALUES (8, 19, 6);

-- ----------------------------
-- Table structure for observations
-- ----------------------------
DROP TABLE IF EXISTS `observations`;
CREATE TABLE `observations`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `observation_no` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `observation_date` date NULL DEFAULT NULL,
  `start_time` time(0) NULL DEFAULT NULL,
  `end_time` time(0) NULL DEFAULT NULL,
  `subtitle` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `due_date` date NULL DEFAULT NULL,
  `mp_id` int(11) NULL DEFAULT NULL,
  `uic_id` int(11) NULL DEFAULT NULL,
  `component_type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `task_observed` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `location` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `action` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 20 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of observations
-- ----------------------------
INSERT INTO `observations` VALUES (1, '001-08-2019-TZ', '2019-08-09', '09:00:00', '10:00:00', NULL, '2019-09-08', 9, 1, 'Baggage Towing Car', 'Changing the Battery', 'GSE Workshop', 'Open', NULL, '2020-01-08 15:55:19', '2020-01-08 15:55:19');
INSERT INTO `observations` VALUES (2, '003-05-2019-TB', '2019-05-24', '09:25:00', '10:20:00', NULL, '2020-05-08', 6, 2, 'B 777 PK-GIA', 'PRSOV and HPSOV Inspection and Test (LH Engine)', 'Hangar 1', 'Open', NULL, '2020-01-08 15:59:12', '2020-01-08 15:59:12');
INSERT INTO `observations` VALUES (3, '001-02-2020-TC', '2020-01-05', '06:00:00', '15:00:00', 'test mlosa plan', '2020-02-15', 1, 1, 'A 330', 'Removal Sliding Window', 'Hangar 2', 'On Progress', NULL, '2020-01-15 00:39:24', '2020-01-15 02:01:47');
INSERT INTO `observations` VALUES (18, '002-01-2020-TA', '2020-01-23', '06:00:00', '10:00:00', NULL, NULL, 1, 1, NULL, NULL, NULL, 'Open', NULL, '2020-01-23 01:21:06', '2020-01-23 01:21:06');
INSERT INTO `observations` VALUES (19, '003-01-2020-TA', '2020-01-23', '06:00:00', '10:00:00', NULL, NULL, 1, 1, NULL, NULL, NULL, 'Open', NULL, '2020-01-23 14:28:52', '2020-01-23 14:28:52');

-- ----------------------------
-- Table structure for risk_colors
-- ----------------------------
DROP TABLE IF EXISTS `risk_colors`;
CREATE TABLE `risk_colors`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `severity_code` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `probability_value` int(5) NULL DEFAULT NULL,
  `color` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 26 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of risk_colors
-- ----------------------------
INSERT INTO `risk_colors` VALUES (1, 'A', 5, '#ff0000');
INSERT INTO `risk_colors` VALUES (2, 'B', 5, '#ff0000');
INSERT INTO `risk_colors` VALUES (3, 'C', 5, '#ed7d31');
INSERT INTO `risk_colors` VALUES (4, 'D', 5, '#ffff00');
INSERT INTO `risk_colors` VALUES (5, 'E', 5, '#ffff00');
INSERT INTO `risk_colors` VALUES (6, 'A', 4, '#ff0000');
INSERT INTO `risk_colors` VALUES (7, 'B', 4, '#ed7d31');
INSERT INTO `risk_colors` VALUES (8, 'C', 4, '#ffff00');
INSERT INTO `risk_colors` VALUES (9, 'D', 4, '#ffff00');
INSERT INTO `risk_colors` VALUES (10, 'E', 4, '#ffff00');
INSERT INTO `risk_colors` VALUES (11, 'A', 3, '#ed7d31');
INSERT INTO `risk_colors` VALUES (12, 'B', 3, '#ffff00');
INSERT INTO `risk_colors` VALUES (13, 'C', 3, '#ffff00');
INSERT INTO `risk_colors` VALUES (14, 'D', 3, '#ffff00');
INSERT INTO `risk_colors` VALUES (15, 'E', 3, '#92d050');
INSERT INTO `risk_colors` VALUES (16, 'A', 2, '#ffff00');
INSERT INTO `risk_colors` VALUES (17, 'B', 2, '#ffff00');
INSERT INTO `risk_colors` VALUES (18, 'C', 2, '#ffff00');
INSERT INTO `risk_colors` VALUES (19, 'D', 2, '#92d050');
INSERT INTO `risk_colors` VALUES (20, 'E', 2, '#548235');
INSERT INTO `risk_colors` VALUES (21, 'A', 1, '#ffff00');
INSERT INTO `risk_colors` VALUES (22, 'B', 1, '#92d050');
INSERT INTO `risk_colors` VALUES (23, 'C', 1, '#92d050');
INSERT INTO `risk_colors` VALUES (24, 'D', 1, '#548235');
INSERT INTO `risk_colors` VALUES (25, 'E', 1, '#548235');

-- ----------------------------
-- Table structure for risk_controls
-- ----------------------------
DROP TABLE IF EXISTS `risk_controls`;
CREATE TABLE `risk_controls`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` varchar(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for risk_indices
-- ----------------------------
DROP TABLE IF EXISTS `risk_indices`;
CREATE TABLE `risk_indices`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `value` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `probability_id` int(11) NOT NULL,
  `severity_id` int(11) NOT NULL,
  `risk_value_id` int(11) NOT NULL,
  `risk_control_id` int(11) NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for risk_probabilities
-- ----------------------------
DROP TABLE IF EXISTS `risk_probabilities`;
CREATE TABLE `risk_probabilities`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `definition` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `meaning` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` int(2) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of risk_probabilities
-- ----------------------------
INSERT INTO `risk_probabilities` VALUES (1, 'Almost Certain', 'a:3:{i:0;s:50:\"Will undoubtedly happen/occur, possibly frequently\";i:1;s:52:\"Likely to occur many times (has occurred frequently)\";i:2;s:14:\"Chance ≥ 90%\";}', 5);
INSERT INTO `risk_probabilities` VALUES (2, 'Likely', 'a:3:{i:0;s:62:\"Will probably happen/occur , but it is not a persisting issue.\";i:1;s:53:\"Likely to occur sometimes (has occurred infrequently)\";i:2;s:25:\"Chance ≥ 65% , or < 90%\";}', 4);
INSERT INTO `risk_probabilities` VALUES (3, 'Posible', 'a:3:{i:0;s:31:\"Might happen/occur ocassionally\";i:1;s:53:\"Unlikely to occur, but possible (has occurred rarely)\";i:2;s:25:\"Chance ≥ 30% , or < 65%\";}', 3);
INSERT INTO `risk_probabilities` VALUES (4, 'Unlikely', 'a:3:{i:0;s:61:\"Expected to not happen /occur but it is possible it may do so\";i:1;s:51:\"Very unlikely to occur (not known to have occurred)\";i:2;s:24:\"Chance ≥ 5% , or < 30%\";}', 2);
INSERT INTO `risk_probabilities` VALUES (5, 'Rare', 'a:3:{i:0;s:31:\"This will probably never happen\";i:1;s:46:\"Almost inconceivable that the event will occur\";i:2;s:11:\"Chance < 5%\";}', 1);

-- ----------------------------
-- Table structure for risk_severities
-- ----------------------------
DROP TABLE IF EXISTS `risk_severities`;
CREATE TABLE `risk_severities`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` varchar(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `aviation` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `people` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `environment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `security` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `asset` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `operational` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `it_system` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `reputational` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of risk_severities
-- ----------------------------
INSERT INTO `risk_severities` VALUES (1, 'A', 'Catastrophic', 'a:1:{i:0;s:19:\"Multiple Fatalities\";}', 'a:2:{i:0;s:55:\"Severe calamity, large pollution of water , soil or air\";i:1;s:28:\"Severe danger to environment\";}', 'a:1:{i:0;s:72:\"Loss of A/C due to successful attack, terrorist activity or civil unrest\";}', 'a:2:{i:0;s:60:\"Multiple A/C damage resulting in serious network disruptions\";i:1;s:51:\"BER (Beyond Economical Repair) > 65% of asset value\";}', 'a:1:{i:0;s:16:\"Loss of aircraft\";}', 'a:1:{i:0;s:126:\"The entire system fail, or major subsystem stop working, or other devices on the network to be disrupted. No workaround exist.\";}', 'a:3:{i:0;s:49:\"Sustained negative global (social) media coverage\";i:1;s:55:\"Sustained long-term negative financial / revenue impact\";i:2;s:59:\"Long term inability to attract customers & generate revenue\";}');
INSERT INTO `risk_severities` VALUES (2, 'B', 'Hazardous', 'a:2:{i:0;s:12:\"One Fatality\";i:1;s:43:\"Serious Injury resulting in hospitalization\";}', 'a:1:{i:0;s:39:\"Medium pollution to water , soil or air\";}', 'a:1:{i:0;s:104:\"Security threat assessment is genuine. Situation is only resolve by handling control to outside agencies\";}', 'a:2:{i:0;s:27:\"Aircraft out of use > 24Hrs\";i:1;s:43:\"Cost of repair >50%  or <65% of asset value\";}', 'a:3:{i:0;s:46:\"Practically no operational safety margins left\";i:1;s:74:\"Phsycal distress / high workload impairing accuracy and completion of task\";i:2;s:53:\"Damage out of limits and not recognized before flight\";}', 'a:1:{i:0;s:127:\"Important functions are unusable and workaround do not exist. other functions and the rest of the network is operating normally\";}', 'a:3:{i:0;s:56:\"Sustained negative international (social) media coverage\";i:1;s:38:\"Significant financial / revenue impact\";i:2;s:60:\"Short term inability to attract customers & generate revenue\";}');
INSERT INTO `risk_severities` VALUES (3, 'C', 'Major', 'a:1:{i:0;s:70:\"Injury / ill health resulting in absence not requiring hospitalization\";}', 'a:1:{i:0;s:36:\"Small pollution to water soil or air\";}', 'a:1:{i:0;s:119:\"Security threat assessment is genuine. Situation is only mitigate and / or resolved with assistance of outside agencies\";}', 'a:2:{i:0;s:29:\"Aircraft out of use 2 - 24Hrs\";i:1;s:44:\"Cost of repair > 10%  or <50% of asset value\";}', 'a:3:{i:0;s:45:\"Large reduction in operational safety margins\";i:1;s:82:\"Reduction in ability to cope with adverse operating conditions / increase work loa\";i:2;s:52:\"Damage within limits and not recognized before fligh\";}', 'a:1:{i:0;s:133:\"Failures occur in unusual circumstances, or minor features do not work at all, or other failure occur but low impact workaround exist\";}', 'a:3:{i:0;s:51:\"Sustained negative national (social) media coverage\";i:1;s:32:\"Major financial / revenue impact\";i:2;s:68:\"Inability to attract customers in specific region & generate revenue\";}');
INSERT INTO `risk_severities` VALUES (4, 'D', 'Minor', 'a:1:{i:0;s:37:\"Minor Injury not resulting in absence\";}', 'a:1:{i:0;s:28:\"Small spill and no pollution\";}', 'a:1:{i:0;s:90:\"Security threat assessment is genuine. Situation is only mitigate and / or resolved by GMF\";}', 'a:2:{i:0;s:26:\"Aircraft out of use < 2Hrs\";i:1;s:33:\"Cost of repair 10% of asset value\";}', 'a:2:{i:0;s:21:\"Operating limitations\";i:1;s:24:\"Damage timely recognized\";}', 'a:1:{i:0;s:184:\"Failures occur under very unusual circumstances , but operation essentially. recovers without intervention. User did not need install any workaround and performance impact is tolerable\";}', 'a:3:{i:0;s:27:\"Local (social) media impact\";i:1;s:21:\"Short - lived effects\";i:2;s:22:\"Minor financial impact\";}');
INSERT INTO `risk_severities` VALUES (5, 'E', 'Negligible', 'a:1:{i:0;s:9:\"No Injury\";}', 'a:1:{i:0;s:23:\"No pollution , no spill\";}', 'a:1:{i:0;s:27:\"Security threatment is hoax\";}', 'a:2:{i:0;s:22:\"No delay due to damage\";i:1;s:18:\"No Facility damage\";}', 'a:1:{i:0;s:39:\"No adverse effect to operational safety\";}', 'a:1:{i:0;s:67:\"Defects do not cause any detrimental effect on system functionality\";}', 'a:1:{i:0;s:9:\"No effect\";}');

-- ----------------------------
-- Table structure for risk_values
-- ----------------------------
DROP TABLE IF EXISTS `risk_values`;
CREATE TABLE `risk_values`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` varchar(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for safety_risks
-- ----------------------------
DROP TABLE IF EXISTS `safety_risks`;
CREATE TABLE `safety_risks`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of safety_risks
-- ----------------------------
INSERT INTO `safety_risks` VALUES (1, 'S', 'Safety');
INSERT INTO `safety_risks` VALUES (2, 'AR', 'At Risk');
INSERT INTO `safety_risks` VALUES (3, 'N/A', 'Not Applicable');
INSERT INTO `safety_risks` VALUES (4, 'DNO', 'Didn\'t Observe');

-- ----------------------------
-- Table structure for sub_activities
-- ----------------------------
DROP TABLE IF EXISTS `sub_activities`;
CREATE TABLE `sub_activities`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 40 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sub_activities
-- ----------------------------
INSERT INTO `sub_activities` VALUES (1, 'Notes, caution, and warnings followed');
INSERT INTO `sub_activities` VALUES (2, 'Individual work step signoff completed');
INSERT INTO `sub_activities` VALUES (3, 'Communication to other departments accomplished');
INSERT INTO `sub_activities` VALUES (4, 'Installation procedures followed');
INSERT INTO `sub_activities` VALUES (5, 'Tools available');
INSERT INTO `sub_activities` VALUES (6, 'Documentation available and review (e.g., task cards, maintenance manuals, service bulletins)');
INSERT INTO `sub_activities` VALUES (7, 'Servicing procedures followed');
INSERT INTO `sub_activities` VALUES (8, 'Strategies developed for identified threats');
INSERT INTO `sub_activities` VALUES (9, 'Notes, caution, and warnings reviewed');
INSERT INTO `sub_activities` VALUES (10, 'Collective protective equipment (e.g., yellow/black streamers, flags) used');
INSERT INTO `sub_activities` VALUES (11, 'Servicing fluids and materials properly stored and handled');
INSERT INTO `sub_activities` VALUES (12, 'Task/shift turnover completed');
INSERT INTO `sub_activities` VALUES (13, 'Notes, cautions, and warnings followed');
INSERT INTO `sub_activities` VALUES (14, 'Required personnel available');
INSERT INTO `sub_activities` VALUES (15, 'Support equipment (e.g., PIV/GSE, hoist, machinery) staged');
INSERT INTO `sub_activities` VALUES (16, 'Inspection signoff completed');
INSERT INTO `sub_activities` VALUES (17, 'Personal Protective Equipment (PPE) used');
INSERT INTO `sub_activities` VALUES (18, 'Removal procedures followed');
INSERT INTO `sub_activities` VALUES (19, 'Communication among technicians accomplished');
INSERT INTO `sub_activities` VALUES (20, 'Generated non-routines for work-not-specified in the tech publications');
INSERT INTO `sub_activities` VALUES (21, 'Task plan communicated to all parties & feedback solicited (“dimintakan”)');
INSERT INTO `sub_activities` VALUES (22, 'Coordination conducted between departments, shifts, or flight crew');
INSERT INTO `sub_activities` VALUES (23, 'Materials utilized');
INSERT INTO `sub_activities` VALUES (24, 'Servicing fluids and materials available');
INSERT INTO `sub_activities` VALUES (25, 'Communication among crew members accomplished');
INSERT INTO `sub_activities` VALUES (26, 'Personnel use correct manual handling, ergonomics (e.g., proper lifting techniques)');
INSERT INTO `sub_activities` VALUES (27, 'Parts staged');
INSERT INTO `sub_activities` VALUES (28, 'Materials staged');
INSERT INTO `sub_activities` VALUES (29, 'Current documentation (e.g., task cards, AMM, service bulletins) available and reviewed');
INSERT INTO `sub_activities` VALUES (30, 'Hazardous energy systems (electrical, hydraulics, pneumatics, stored energy) deactivation LOTO (Lock Out Tag Out) procedures verified');
INSERT INTO `sub_activities` VALUES (31, 'Parts, materials, and wastes dispositioned');
INSERT INTO `sub_activities` VALUES (32, 'Return to normal condition procedures followed');
INSERT INTO `sub_activities` VALUES (33, 'Strategies developed for identified hazards / threats');
INSERT INTO `sub_activities` VALUES (34, 'Close up procedures followed');
INSERT INTO `sub_activities` VALUES (35, 'Fault history reviewed');
INSERT INTO `sub_activities` VALUES (36, 'Fault Isolation/Troubleshooting data consulted/followed');
INSERT INTO `sub_activities` VALUES (37, 'Expendable parts (o-rings, filters) for buildup available');
INSERT INTO `sub_activities` VALUES (38, 'Expendable parts (o-rings, filters) for buildup installed prior to component installation');

-- ----------------------------
-- Table structure for sub_threat_codes
-- ----------------------------
DROP TABLE IF EXISTS `sub_threat_codes`;
CREATE TABLE `sub_threat_codes`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `threat_codes_id` bigint(20) NOT NULL,
  `code` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `description` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 118 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sub_threat_codes
-- ----------------------------
INSERT INTO `sub_threat_codes` VALUES (1, 1, 'A1', 'Not understandable');
INSERT INTO `sub_threat_codes` VALUES (2, 1, 'A2', 'Unavailable or inaccessible');
INSERT INTO `sub_threat_codes` VALUES (3, 1, 'A3', 'Incorrect');
INSERT INTO `sub_threat_codes` VALUES (4, 1, 'A4', 'Inadequate (e.g., missing graphics) ');
INSERT INTO `sub_threat_codes` VALUES (5, 1, 'A5', 'Uncontrolled (e.g., outdated)');
INSERT INTO `sub_threat_codes` VALUES (6, 1, 'A6', 'Too much conflicting information');
INSERT INTO `sub_threat_codes` VALUES (7, 1, 'A7', 'Update process is too long or complicated');
INSERT INTO `sub_threat_codes` VALUES (8, 1, 'A8', 'Incorrectly modified manufacturer’s Maintenance Manual/Service Bulletin');
INSERT INTO `sub_threat_codes` VALUES (9, 1, 'A9', 'Information not used');
INSERT INTO `sub_threat_codes` VALUES (10, 1, 'A10', 'Other (explain below)');
INSERT INTO `sub_threat_codes` VALUES (11, 2, 'B1', 'Defective');
INSERT INTO `sub_threat_codes` VALUES (12, 2, 'B2', 'Unsafe');
INSERT INTO `sub_threat_codes` VALUES (13, 2, 'B3', 'Unreliable');
INSERT INTO `sub_threat_codes` VALUES (14, 2, 'B4', 'Layout of controls or displays');
INSERT INTO `sub_threat_codes` VALUES (15, 2, 'B5', 'Miscalibrated');
INSERT INTO `sub_threat_codes` VALUES (16, 2, 'B6', 'Unavailable');
INSERT INTO `sub_threat_codes` VALUES (17, 2, 'B7', 'Incomplete');
INSERT INTO `sub_threat_codes` VALUES (18, 2, 'B8', 'Inappropriate for the task');
INSERT INTO `sub_threat_codes` VALUES (19, 2, 'B9', 'Cannot use in intended environment');
INSERT INTO `sub_threat_codes` VALUES (20, 2, 'B10', 'No instructions');
INSERT INTO `sub_threat_codes` VALUES (21, 2, 'B11', 'Too complicated');
INSERT INTO `sub_threat_codes` VALUES (22, 2, 'B12', 'Incorrectly labeled');
INSERT INTO `sub_threat_codes` VALUES (23, 2, 'B13', 'Incorrectly used (including unsafely)');
INSERT INTO `sub_threat_codes` VALUES (24, 2, 'B14', 'Inadequate');
INSERT INTO `sub_threat_codes` VALUES (25, 2, 'B15', 'Not used (e.g., personal protection equipment)');
INSERT INTO `sub_threat_codes` VALUES (26, 2, 'B16', 'Other (explain below)');
INSERT INTO `sub_threat_codes` VALUES (27, 3, 'C1', 'Complex');
INSERT INTO `sub_threat_codes` VALUES (28, 3, 'C2', 'Inaccessible');
INSERT INTO `sub_threat_codes` VALUES (29, 3, 'C3', 'Aircraft configuration variability');
INSERT INTO `sub_threat_codes` VALUES (30, 3, 'C4', 'Parts unavailable');
INSERT INTO `sub_threat_codes` VALUES (31, 3, 'C5', 'Parts incorrectly labeled/certified');
INSERT INTO `sub_threat_codes` VALUES (32, 3, 'C6', 'Easy to install incorrectly');
INSERT INTO `sub_threat_codes` VALUES (33, 3, 'C7', 'Parts not used');
INSERT INTO `sub_threat_codes` VALUES (34, 3, 'C8', 'Other (explain below)');
INSERT INTO `sub_threat_codes` VALUES (35, 4, 'D1', 'Repetitive/monotonous');
INSERT INTO `sub_threat_codes` VALUES (36, 4, 'D2', 'Complex/confusing');
INSERT INTO `sub_threat_codes` VALUES (37, 4, 'D3', 'New task or task change');
INSERT INTO `sub_threat_codes` VALUES (38, 4, 'D4', 'Different from other similar tasks');
INSERT INTO `sub_threat_codes` VALUES (39, 4, 'D5', 'Other (explain below)');
INSERT INTO `sub_threat_codes` VALUES (40, 5, 'E1', 'Technical skills');
INSERT INTO `sub_threat_codes` VALUES (41, 5, 'E2', 'Computer skills');
INSERT INTO `sub_threat_codes` VALUES (42, 5, 'E3', 'Teamwork skills');
INSERT INTO `sub_threat_codes` VALUES (43, 5, 'E4', 'English proficiency');
INSERT INTO `sub_threat_codes` VALUES (44, 5, 'E5', 'Task knowledge');
INSERT INTO `sub_threat_codes` VALUES (45, 5, 'E6', 'Task planning');
INSERT INTO `sub_threat_codes` VALUES (46, 5, 'E7', 'Company process knowledge');
INSERT INTO `sub_threat_codes` VALUES (47, 5, 'E8', 'Aircraft system knowledge');
INSERT INTO `sub_threat_codes` VALUES (48, 5, 'E9', 'Other (explain below)');
INSERT INTO `sub_threat_codes` VALUES (49, 6, 'F1', 'Physical health (including hearing and sight)');
INSERT INTO `sub_threat_codes` VALUES (50, 6, 'F2', 'Fatigue');
INSERT INTO `sub_threat_codes` VALUES (51, 6, 'F3', 'Time pressure');
INSERT INTO `sub_threat_codes` VALUES (52, 6, 'F4', 'Peer pressure');
INSERT INTO `sub_threat_codes` VALUES (53, 6, 'F5', 'Complacency');
INSERT INTO `sub_threat_codes` VALUES (54, 6, 'F6', 'Body size/strength');
INSERT INTO `sub_threat_codes` VALUES (55, 6, 'F7', 'Personal event (e.g., family problem, car accident)');
INSERT INTO `sub_threat_codes` VALUES (56, 6, 'F8', 'Workplace distractions or interruptions during task performance');
INSERT INTO `sub_threat_codes` VALUES (57, 6, 'F9', 'Memory lapse (forgot)');
INSERT INTO `sub_threat_codes` VALUES (58, 6, 'F10', 'Visual perception');
INSERT INTO `sub_threat_codes` VALUES (59, 6, 'F11', 'Assertiveness');
INSERT INTO `sub_threat_codes` VALUES (60, 6, 'F12', 'Stress');
INSERT INTO `sub_threat_codes` VALUES (61, 6, 'F13', 'Situational awareness');
INSERT INTO `sub_threat_codes` VALUES (62, 6, 'F14', 'Not properly dressed (e.g., for weather)');
INSERT INTO `sub_threat_codes` VALUES (63, 6, 'F15', 'Other (explain below)');
INSERT INTO `sub_threat_codes` VALUES (64, 7, 'G1', 'High noise levels');
INSERT INTO `sub_threat_codes` VALUES (65, 7, 'G2', 'Hot');
INSERT INTO `sub_threat_codes` VALUES (66, 7, 'G3', 'Cold');
INSERT INTO `sub_threat_codes` VALUES (67, 7, 'G4', 'Humidity');
INSERT INTO `sub_threat_codes` VALUES (68, 7, 'G5', 'Rain');
INSERT INTO `sub_threat_codes` VALUES (69, 7, 'G6', 'Snow');
INSERT INTO `sub_threat_codes` VALUES (70, 7, 'G7', 'Lightning');
INSERT INTO `sub_threat_codes` VALUES (71, 7, 'G8', 'Illumination');
INSERT INTO `sub_threat_codes` VALUES (72, 7, 'G9', 'Wind');
INSERT INTO `sub_threat_codes` VALUES (73, 7, 'G10', 'Jet blast');
INSERT INTO `sub_threat_codes` VALUES (74, 7, 'G11', 'Vibrations');
INSERT INTO `sub_threat_codes` VALUES (75, 7, 'G12', 'Cleanliness');
INSERT INTO `sub_threat_codes` VALUES (76, 7, 'G13', 'Hazardous or toxic substances');
INSERT INTO `sub_threat_codes` VALUES (77, 7, 'G14', 'Contaminated surfaces');
INSERT INTO `sub_threat_codes` VALUES (78, 7, 'G15', 'Power sources');
INSERT INTO `sub_threat_codes` VALUES (79, 7, 'G16', 'Inadequate ventilation');
INSERT INTO `sub_threat_codes` VALUES (80, 7, 'G17', 'Slippery');
INSERT INTO `sub_threat_codes` VALUES (81, 7, 'G18', 'Uneven work surface');
INSERT INTO `sub_threat_codes` VALUES (82, 7, 'G19', 'Restricted/confined work area');
INSERT INTO `sub_threat_codes` VALUES (83, 7, 'G20', 'Elevated work space');
INSERT INTO `sub_threat_codes` VALUES (84, 7, 'G21', 'Marking');
INSERT INTO `sub_threat_codes` VALUES (85, 7, 'G22', 'Labels/placards/signage');
INSERT INTO `sub_threat_codes` VALUES (86, 7, 'G23', 'Other (explain below)');
INSERT INTO `sub_threat_codes` VALUES (87, 8, 'H1', 'Quality of internal support from technical organizations (e.g., engineering, planning, technical pubs)');
INSERT INTO `sub_threat_codes` VALUES (88, 8, 'H2', 'Quality of external support from technical organizations (e.g., manufacturer)');
INSERT INTO `sub_threat_codes` VALUES (89, 8, 'H3', 'Company policies');
INSERT INTO `sub_threat_codes` VALUES (90, 8, 'H4', 'Not enough staff');
INSERT INTO `sub_threat_codes` VALUES (91, 8, 'H5', 'Corporate change / restructuring');
INSERT INTO `sub_threat_codes` VALUES (92, 8, 'H6', 'Labor action');
INSERT INTO `sub_threat_codes` VALUES (93, 8, 'H7', 'Work process / procedure');
INSERT INTO `sub_threat_codes` VALUES (94, 8, 'H8', 'Work process / procedure not followed');
INSERT INTO `sub_threat_codes` VALUES (95, 8, 'H9', 'Work process / procedure not documented');
INSERT INTO `sub_threat_codes` VALUES (96, 8, 'H10', 'Work group normal practice (norm)');
INSERT INTO `sub_threat_codes` VALUES (97, 8, 'H11', 'Team building');
INSERT INTO `sub_threat_codes` VALUES (98, 8, 'H12', 'Other (explain below)');
INSERT INTO `sub_threat_codes` VALUES (99, 9, 'I1', 'Planning / organization of tasks');
INSERT INTO `sub_threat_codes` VALUES (100, 9, 'I2', 'Prioritization of work');
INSERT INTO `sub_threat_codes` VALUES (101, 9, 'I3', 'Delegation / assignment of task');
INSERT INTO `sub_threat_codes` VALUES (102, 9, 'I4', 'Unrealistic attitude / expectations');
INSERT INTO `sub_threat_codes` VALUES (103, 9, 'I5', 'Availability of supervision');
INSERT INTO `sub_threat_codes` VALUES (104, 9, 'I6', 'Other (explain below)');
INSERT INTO `sub_threat_codes` VALUES (105, 10, 'J1', 'Between departments');
INSERT INTO `sub_threat_codes` VALUES (106, 10, 'J2', 'Between mechanics');
INSERT INTO `sub_threat_codes` VALUES (107, 10, 'J3', 'Between shifts');
INSERT INTO `sub_threat_codes` VALUES (108, 10, 'J4', 'Between maintenance crew and lead');
INSERT INTO `sub_threat_codes` VALUES (109, 10, 'J5', 'Between lead and management');
INSERT INTO `sub_threat_codes` VALUES (110, 10, 'J6', 'Between flight crew and maintenance');
INSERT INTO `sub_threat_codes` VALUES (111, 10, 'J7', 'Other (explain below)');
INSERT INTO `sub_threat_codes` VALUES (112, 11, 'K1', 'Missing proper documentation');
INSERT INTO `sub_threat_codes` VALUES (113, 11, 'K2', 'NDT (non destructive test) processes, specify ___________________');
INSERT INTO `sub_threat_codes` VALUES (114, 11, 'K3', 'RII (required inspection) / designee');
INSERT INTO `sub_threat_codes` VALUES (115, 11, 'K4', 'Improper inspection procedures');
INSERT INTO `sub_threat_codes` VALUES (116, 11, 'K5', 'Other (explain below)');
INSERT INTO `sub_threat_codes` VALUES (117, 12, 'L1', 'Explain below...............');

-- ----------------------------
-- Table structure for threat_codes
-- ----------------------------
DROP TABLE IF EXISTS `threat_codes`;
CREATE TABLE `threat_codes`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of threat_codes
-- ----------------------------
INSERT INTO `threat_codes` VALUES (1, 'A', 'Information');
INSERT INTO `threat_codes` VALUES (2, 'B', 'Equipment / Tools / Safety Equipment');
INSERT INTO `threat_codes` VALUES (3, 'C', 'Aircraft Design / Configuration / Parts');
INSERT INTO `threat_codes` VALUES (4, 'D', 'Job / Task');
INSERT INTO `threat_codes` VALUES (5, 'E', 'Knowledge / Skills');
INSERT INTO `threat_codes` VALUES (6, 'F', 'Individual Factors');
INSERT INTO `threat_codes` VALUES (7, 'G', 'Environment / Facilities');
INSERT INTO `threat_codes` VALUES (8, 'H', 'Organizational Factors');
INSERT INTO `threat_codes` VALUES (9, 'I', 'Leadership / Supervision');
INSERT INTO `threat_codes` VALUES (10, 'J', 'Communication');
INSERT INTO `threat_codes` VALUES (11, 'K', 'Inspection/ Double Check');
INSERT INTO `threat_codes` VALUES (12, 'L', 'Other Contributing Factors');

-- ----------------------------
-- Table structure for uics
-- ----------------------------
DROP TABLE IF EXISTS `uics`;
CREATE TABLE `uics`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uic_name` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `uic_code` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 28 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of uics
-- ----------------------------
INSERT INTO `uics` VALUES (1, 'Accounting', 'TA');
INSERT INTO `uics` VALUES (2, 'Wide Body Base Maintenance', 'TB');
INSERT INTO `uics` VALUES (3, 'Component Services', 'TC');
INSERT INTO `uics` VALUES (4, 'Corporate Strategy & Business Development', 'TD');
INSERT INTO `uics` VALUES (5, 'Engineering Services', 'TE');
INSERT INTO `uics` VALUES (6, 'Outstation Line Maintenance', 'TF');
INSERT INTO `uics` VALUES (7, 'Logistic, Bonded & Material Services', 'TG');
INSERT INTO `uics` VALUES (8, 'Human Capital Management', 'TH');
INSERT INTO `uics` VALUES (9, 'Internal Audit', 'TI');
INSERT INTO `uics` VALUES (10, 'Narrow Body Base Maintenance', 'TJ');
INSERT INTO `uics` VALUES (11, 'Line Maintenance', 'TL');
INSERT INTO `uics` VALUES (12, 'Procurement', 'TM');
INSERT INTO `uics` VALUES (13, 'Cabin Maintenance Services', 'TN');
INSERT INTO `uics` VALUES (14, 'Information & Communication Technology', 'TO');
INSERT INTO `uics` VALUES (15, 'Sales & Marketing', 'TP');
INSERT INTO `uics` VALUES (16, 'Quality Assurance & Safety', 'TQ');
INSERT INTO `uics` VALUES (17, 'Enterprise Risk Management', 'TR');
INSERT INTO `uics` VALUES (18, 'Corporate Secretary & Legal', 'TS');
INSERT INTO `uics` VALUES (19, 'Corporate Affairs', 'TU');
INSERT INTO `uics` VALUES (20, 'Engine Maintenance', 'TV');
INSERT INTO `uics` VALUES (21, 'Learning Services', 'TW');
INSERT INTO `uics` VALUES (22, 'Treasury Management', 'TX');
INSERT INTO `uics` VALUES (23, 'Financial Analysis & Enterprise Risk Management', 'TY');
INSERT INTO `uics` VALUES (24, 'Aircraft Support & Power Services', 'TZ');
INSERT INTO `uics` VALUES (27, 'Baru Diubah', 'BR');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `fullname` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `uic_id` int(11) NOT NULL,
  `role` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `obslicense` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 36 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (3, 'agung', 'Agung Setiawan', 'ASSOCIATE QUALITY AUDITOR', 20, 'UIC', 1, '', '', NULL, NULL);
INSERT INTO `users` VALUES (4, 'julian', 'Julian Akbar', 'ASSOCIATE QUALITY AUDITOR', 20, 'UIC', 1, '', '', NULL, NULL);
INSERT INTO `users` VALUES (5, 'norman', 'Norman Hadi', 'ASSOCIATE QUALITY AUDITOR', 20, 'UIC', 1, '', '', NULL, NULL);
INSERT INTO `users` VALUES (6, 'andi', 'M. Andi Arifin', 'ASSOCIATE QUALITY AUDITOR', 20, 'UIC', 1, '', '', NULL, NULL);
INSERT INTO `users` VALUES (7, 'isna', 'Isna Habibie', 'ASSOCIATE QUALITY AUDITOR', 20, 'UIC', 1, '', '', NULL, NULL);
INSERT INTO `users` VALUES (8, 'gede', 'I Gede Agung Wibawa', 'ASSOCIATE QUALITY AUDITOR', 24, 'UIC', 1, '', '', NULL, NULL);
INSERT INTO `users` VALUES (9, 'imar', 'Imar Masriyah', 'ASSOCIATE QUALITY AUDITOR', 24, 'UIC', 1, '', '', NULL, NULL);
INSERT INTO `users` VALUES (10, 'ali', 'Ali Suhanda', 'ASSOCIATE QUALITY AUDITOR', 24, 'UIC', 1, '', '', NULL, NULL);
INSERT INTO `users` VALUES (11, 'sony', 'Sony Mardiana', 'ASSOCIATE QUALITY AUDITOR', 2, 'UIC', 1, '', '', NULL, NULL);
INSERT INTO `users` VALUES (12, 'antara', 'I Gede Nyoman Antara', 'ASSOCIATE QUALITY AUDITOR', 2, 'UIC', 1, '', '', NULL, NULL);
INSERT INTO `users` VALUES (14, 'kholis', 'Kholis', 'ASSOCIATE QUALITY AUDITOR', 10, 'UIC', 1, '', '', NULL, NULL);
INSERT INTO `users` VALUES (15, 'viki', 'Viki', 'ASSOCIATE QUALITY AUDITOR', 10, 'UIC', 1, '', '', NULL, NULL);
INSERT INTO `users` VALUES (16, 'andik', 'Andik', 'ASSOCIATE QUALITY AUDITOR', 10, 'UIC', 1, '', '', NULL, NULL);
INSERT INTO `users` VALUES (17, 'riki', 'Ricky', 'ASSOCIATE QUALITY AUDITOR', 10, 'UIC', 1, '', '', NULL, NULL);
INSERT INTO `users` VALUES (18, 'johari', 'Johari', 'ASSOCIATE QUALITY AUDITOR', 10, 'UIC', 1, '', '', NULL, NULL);
INSERT INTO `users` VALUES (19, 'rizal', 'Rizal Yopy P', 'ASSOCIATE QUALITY AUDITOR', 13, 'UIC', 1, '', '', NULL, NULL);
INSERT INTO `users` VALUES (20, 'dwi', 'Dwi Cahyo', 'ASSOCIATE QUALITY AUDITOR', 13, 'UIC', 1, '', '', NULL, NULL);
INSERT INTO `users` VALUES (21, 'aditya', 'Aditya Eka', 'ASSOCIATE QUALITY AUDITOR', 5, 'UIC', 1, '', '', NULL, NULL);
INSERT INTO `users` VALUES (22, 'fransisca', 'Fransisca Tiur', 'ASSOCIATE QUALITY AUDITOR', 5, 'UIC', 1, '', '', NULL, NULL);
INSERT INTO `users` VALUES (23, 'yogi', 'Yogi Maulana Malik', 'ASSOCIATE QUALITY AUDITOR', 11, 'UIC', 1, '', '', NULL, NULL);
INSERT INTO `users` VALUES (24, 'fitry', 'Fitry Nurlaily Ghozali', 'ASSOCIATE QUALITY AUDITOR', 11, 'UIC', 1, '', '', NULL, NULL);
INSERT INTO `users` VALUES (25, 'wahyu', 'Wahyu Rachmad Wildan', 'ASSOCIATE QUALITY AUDITOR', 11, 'UIC', 1, '', '', NULL, NULL);
INSERT INTO `users` VALUES (35, '580440', 'TEGUH RAHMADANI PAMUNGKAS', 'ASSOCIATE QUALITY AUDITOR', 16, 'Engineer Observer', 1, 'LOSA OBSERVER TRAINING', 'https://talentlead.gmf-aeroasia.co.id/images/avatar/580440.jpg', '2020-01-19 01:52:55', '2020-01-23 13:50:30');

-- ----------------------------
-- View structure for vwuser
-- ----------------------------
DROP VIEW IF EXISTS `vwuser`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `vwuser` AS SELECT us.username, us.role, uc.uic_code, uc.uic_name, us.`status`
FROM users us INNER JOIN uics uc
ON us.uic_id = uc.id ;

-- ----------------------------
-- View structure for vw_maintenance_process
-- ----------------------------
DROP VIEW IF EXISTS `vw_maintenance_process`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `vw_maintenance_process` AS SELECT 
	mpd.id as id_mp_detail,
	mp.`name` as maintenance_name,
	ac.`name` as activity_name,
	sac.description as sub_activity_name

FROM maintenance_processes mp 
INNER JOIN `maintenance_process_details` mpd 
	ON mp.id = mpd.mp_id
INNER JOIN activities ac 
	ON mpd.activity_id = ac.id
INNER JOIN sub_activities sac
	ON mpd.sub_activity_id = sac.id
ORDER BY mpd.id DESC ;

-- ----------------------------
-- View structure for vw_maintenance_process_relation
-- ----------------------------
DROP VIEW IF EXISTS `vw_maintenance_process_relation`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `vw_maintenance_process_relation` AS SELECT mp.id, act.id as activity_id, act.`name` as activity, sb.id as sub_activity_id, sb.description as sub_activity FROM
	maintenance_processes as mp 
		INNER JOIN
	maintenance_process_details as mpd
		on mp.id=mpd.mp_id
	
		INNER JOIN 
	activities as act
		on mpd.activity_id=act.id
		INNER JOIN 
	sub_activities sb 
		on mpd.sub_activity_id=sb.id
		
ORDER BY mp.id  desc ;

-- ----------------------------
-- Procedure structure for sp_User
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_User`;
delimiter ;;
CREATE PROCEDURE `sp_User`(IN `user_id` int)
BEGIN
	#Routine body goes here...
	SELECT * FROM users where id = user_id;
END
;;
delimiter ;

SET FOREIGN_KEY_CHECKS = 1;
