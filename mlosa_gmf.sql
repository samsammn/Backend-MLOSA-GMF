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

 Date: 08/01/2020 23:06:05
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
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

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
) ENGINE = InnoDB AUTO_INCREMENT = 50 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

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

-- ----------------------------
-- Table structure for maintenance_processes
-- ----------------------------
DROP TABLE IF EXISTS `maintenance_processes`;
CREATE TABLE `maintenance_processes`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of maintenance_processes
-- ----------------------------
INSERT INTO `maintenance_processes` VALUES (1, 'Removal', NULL, NULL);
INSERT INTO `maintenance_processes` VALUES (2, 'Servicing', NULL, NULL);
INSERT INTO `maintenance_processes` VALUES (3, 'Prepare to install', NULL, NULL);
INSERT INTO `maintenance_processes` VALUES (4, 'Installation', NULL, NULL);
INSERT INTO `maintenance_processes` VALUES (5, 'Removal Preparation', NULL, NULL);
INSERT INTO `maintenance_processes` VALUES (6, 'Test', NULL, NULL);
INSERT INTO `maintenance_processes` VALUES (7, 'Maintenance Plan', NULL, NULL);
INSERT INTO `maintenance_processes` VALUES (8, 'Close up / Restore', NULL, NULL);
INSERT INTO `maintenance_processes` VALUES (9, 'Troubleshooting', NULL, NULL);

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 23 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

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

-- ----------------------------
-- Table structure for observation_details
-- ----------------------------
DROP TABLE IF EXISTS `observation_details`;
CREATE TABLE `observation_details`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `observation_id` bigint(20) NOT NULL,
  `mp_detail_id` bigint(20) NOT NULL,
  `safety_risk_id` int(11) NOT NULL,
  `sub_threat_code_id` int(11) NOT NULL,
  `risk_index_id` int(11) NULL DEFAULT NULL,
  `control_efectivenes` int(11) NULL DEFAULT NULL,
  `effectively_managed` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `error_outcome` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of observation_details
-- ----------------------------
INSERT INTO `observation_details` VALUES (1, 1, 49, 2, 7, NULL, NULL, 'Y', '1');
INSERT INTO `observation_details` VALUES (2, 1, 48, 2, 7, NULL, NULL, 'Y', '1');
INSERT INTO `observation_details` VALUES (3, 2, 47, 2, 10, NULL, NULL, 'Y', '1');
INSERT INTO `observation_details` VALUES (4, 2, 46, 1, 5, NULL, NULL, 'Y', '1');

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
-- Table structure for observations
-- ----------------------------
DROP TABLE IF EXISTS `observations`;
CREATE TABLE `observations`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `observation_no` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `observation_date` date NOT NULL,
  `start_time` time(0) NOT NULL,
  `end_time` time(0) NOT NULL,
  `subtitle` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `due_date` date NOT NULL,
  `mp_id` int(11) NOT NULL,
  `uic_id` int(11) NULL DEFAULT NULL,
  `component_type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `observer_team` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `task_observed` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `action` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of observations
-- ----------------------------
INSERT INTO `observations` VALUES (1, '001-08-2019-TZ', '2019-08-09', '09:00:00', '10:00:00', NULL, '2020-01-08', 9, NULL, 'Baggage Towing Car', NULL, 'Changing the Battery', 'GSE Workshop', NULL, NULL, '2020-01-08 15:55:19', '2020-01-08 15:55:19');
INSERT INTO `observations` VALUES (2, '003-05-2019-TB', '2019-05-24', '09:25:00', '10:20:00', NULL, '2020-01-08', 6, NULL, '\"B 777 PK-GIA\"', NULL, 'PRSOV and HPSOV Inspection and Test (LH Engine)', 'Hangar 1', NULL, NULL, '2020-01-08 15:59:12', '2020-01-08 15:59:12');

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
  `code` varchar(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `qualitative` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

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
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

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
) ENGINE = InnoDB AUTO_INCREMENT = 39 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

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
) ENGINE = InnoDB AUTO_INCREMENT = 83 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sub_threat_codes
-- ----------------------------
INSERT INTO `sub_threat_codes` VALUES (1, 1, 'A4', 'Inadequate (e.g., missing graphics)');
INSERT INTO `sub_threat_codes` VALUES (2, 1, 'A9', '');
INSERT INTO `sub_threat_codes` VALUES (3, 1, 'A1', 'Not understandable');
INSERT INTO `sub_threat_codes` VALUES (4, 1, 'A2', 'Unavailable or inaccessible');
INSERT INTO `sub_threat_codes` VALUES (5, 1, 'A3', 'Incorrect');
INSERT INTO `sub_threat_codes` VALUES (6, 1, 'A5', 'Uncontrolled (e.g., missing graphics)');
INSERT INTO `sub_threat_codes` VALUES (7, 1, 'A9', 'Information not used');
INSERT INTO `sub_threat_codes` VALUES (8, 2, 'B1', 'Defective');
INSERT INTO `sub_threat_codes` VALUES (9, 2, 'B13', 'Incorrectly used (including unsafely)');
INSERT INTO `sub_threat_codes` VALUES (10, 2, 'B15', 'Not used');
INSERT INTO `sub_threat_codes` VALUES (11, 2, 'B16', 'Other');
INSERT INTO `sub_threat_codes` VALUES (12, 2, 'B6', 'Unavailable');
INSERT INTO `sub_threat_codes` VALUES (13, 2, 'B7', 'Incomplete');
INSERT INTO `sub_threat_codes` VALUES (14, 3, 'C4', 'Parts Unavailable');
INSERT INTO `sub_threat_codes` VALUES (15, 3, 'C5', 'Parts incorrectly labeled/certified');
INSERT INTO `sub_threat_codes` VALUES (16, 3, 'C8', 'C8.');
INSERT INTO `sub_threat_codes` VALUES (17, 4, 'D5', 'Other');
INSERT INTO `sub_threat_codes` VALUES (18, 5, 'E5', 'Task Knowledge');
INSERT INTO `sub_threat_codes` VALUES (19, 5, 'E6', 'Task Planning');
INSERT INTO `sub_threat_codes` VALUES (20, 6, 'F13', 'Situational Awareness');
INSERT INTO `sub_threat_codes` VALUES (21, 6, 'F2', 'Fatigue');
INSERT INTO `sub_threat_codes` VALUES (22, 6, 'F3', 'Time Pressure');
INSERT INTO `sub_threat_codes` VALUES (23, 6, 'F5', 'Complacency');
INSERT INTO `sub_threat_codes` VALUES (24, 7, 'G12', 'Cleanliness');
INSERT INTO `sub_threat_codes` VALUES (25, 7, 'G13', 'Hazardous or toxic subtances');
INSERT INTO `sub_threat_codes` VALUES (26, 7, 'G17', 'Slippery');
INSERT INTO `sub_threat_codes` VALUES (27, 7, 'G2', 'Hot');
INSERT INTO `sub_threat_codes` VALUES (28, 7, 'G22', 'Labels / placards / signage');
INSERT INTO `sub_threat_codes` VALUES (29, 7, 'G7', 'Lighting');
INSERT INTO `sub_threat_codes` VALUES (30, 8, 'H1', 'Quality of internal support from technical organizations');
INSERT INTO `sub_threat_codes` VALUES (31, 8, 'H10', 'Work group normal practice (norm)');
INSERT INTO `sub_threat_codes` VALUES (32, 8, 'H3', 'Company policies');
INSERT INTO `sub_threat_codes` VALUES (33, 8, 'H8', 'Work process / procedure not followed');
INSERT INTO `sub_threat_codes` VALUES (34, 9, 'I1', 'Planning / organization of task');
INSERT INTO `sub_threat_codes` VALUES (35, 9, 'I5', 'Availibility of supervision');
INSERT INTO `sub_threat_codes` VALUES (36, 10, 'J1', 'Between department');
INSERT INTO `sub_threat_codes` VALUES (37, 10, 'J2', 'Between mechanics');
INSERT INTO `sub_threat_codes` VALUES (38, 10, 'J3', 'Between shifts');
INSERT INTO `sub_threat_codes` VALUES (39, 10, 'J4', 'Between maintenance crew and lead');
INSERT INTO `sub_threat_codes` VALUES (40, 10, 'J7', 'Other');
INSERT INTO `sub_threat_codes` VALUES (41, 11, 'K1', 'Missing proper documentation');
INSERT INTO `sub_threat_codes` VALUES (42, 1, 'A4', 'Inadequate (eg , missing graphics)');
INSERT INTO `sub_threat_codes` VALUES (43, 1, 'A9', '');
INSERT INTO `sub_threat_codes` VALUES (44, 1, 'A1', 'Not understandable');
INSERT INTO `sub_threat_codes` VALUES (45, 1, 'A2', 'Unavailable or inaccessible');
INSERT INTO `sub_threat_codes` VALUES (46, 1, 'A3', 'Incorrect');
INSERT INTO `sub_threat_codes` VALUES (47, 1, 'A5', 'Uncontrolled (eg , missing graphics)');
INSERT INTO `sub_threat_codes` VALUES (48, 1, 'A9', 'Information not used');
INSERT INTO `sub_threat_codes` VALUES (49, 2, 'B1', 'Defective');
INSERT INTO `sub_threat_codes` VALUES (50, 2, 'B13', 'Incorrectly used (including unsafely)');
INSERT INTO `sub_threat_codes` VALUES (51, 2, 'B15', 'Not used');
INSERT INTO `sub_threat_codes` VALUES (52, 2, 'B16', 'Other');
INSERT INTO `sub_threat_codes` VALUES (53, 2, 'B6', 'Unavailable');
INSERT INTO `sub_threat_codes` VALUES (54, 2, 'B7', 'Incomplete');
INSERT INTO `sub_threat_codes` VALUES (55, 3, 'C4', 'Parts Unavailable');
INSERT INTO `sub_threat_codes` VALUES (56, 3, 'C5', 'Parts incorrectly labeled/certified');
INSERT INTO `sub_threat_codes` VALUES (57, 3, 'C8', 'C8');
INSERT INTO `sub_threat_codes` VALUES (58, 4, 'D5', 'Other');
INSERT INTO `sub_threat_codes` VALUES (59, 5, 'E5', 'Task Knowledge');
INSERT INTO `sub_threat_codes` VALUES (60, 5, 'E6', 'Task Planning');
INSERT INTO `sub_threat_codes` VALUES (61, 6, 'F13', 'Situational Awareness');
INSERT INTO `sub_threat_codes` VALUES (62, 6, 'F2', 'Fatigue');
INSERT INTO `sub_threat_codes` VALUES (63, 6, 'F3', 'Time Pressure');
INSERT INTO `sub_threat_codes` VALUES (64, 6, 'F5', 'Complacency');
INSERT INTO `sub_threat_codes` VALUES (65, 7, 'G12', 'Cleanliness');
INSERT INTO `sub_threat_codes` VALUES (66, 7, 'G13', 'Hazardous or toxic subtances');
INSERT INTO `sub_threat_codes` VALUES (67, 7, 'G17', 'Slippery');
INSERT INTO `sub_threat_codes` VALUES (68, 7, 'G2', 'Hot');
INSERT INTO `sub_threat_codes` VALUES (69, 7, 'G22', 'Labels / placards / signage');
INSERT INTO `sub_threat_codes` VALUES (70, 7, 'G7', 'Lighting');
INSERT INTO `sub_threat_codes` VALUES (71, 8, 'H1', 'Quality of internal support from technical organizations');
INSERT INTO `sub_threat_codes` VALUES (72, 8, 'H10', 'Work group normal practice (norm)');
INSERT INTO `sub_threat_codes` VALUES (73, 8, 'H3', 'Company policies');
INSERT INTO `sub_threat_codes` VALUES (74, 8, 'H8', 'Work process / procedure not followed');
INSERT INTO `sub_threat_codes` VALUES (75, 9, 'I1', 'Planning / organization of task');
INSERT INTO `sub_threat_codes` VALUES (76, 9, 'I5', 'Availibility of supervision');
INSERT INTO `sub_threat_codes` VALUES (77, 10, 'J1', 'Between department');
INSERT INTO `sub_threat_codes` VALUES (78, 10, 'J2', 'Between mechanics');
INSERT INTO `sub_threat_codes` VALUES (79, 10, 'J3', 'Between shifts');
INSERT INTO `sub_threat_codes` VALUES (80, 10, 'J4', 'Between maintenance crew and lead');
INSERT INTO `sub_threat_codes` VALUES (81, 10, 'J7', 'Other');
INSERT INTO `sub_threat_codes` VALUES (82, 11, 'K1', 'Missing proper documentation');

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
) ENGINE = InnoDB AUTO_INCREMENT = 25 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

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

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `uic_id` int(11) NOT NULL,
  `role` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 26 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'samsam', '111', 1, 'Admin', 0, NULL, '2020-01-03 01:08:41');
INSERT INTO `users` VALUES (2, 'andy', '123', 2, 'Staff', 1, NULL, NULL);
INSERT INTO `users` VALUES (3, 'Agung Setiawan', '123', 20, 'UIC', 0, NULL, NULL);
INSERT INTO `users` VALUES (4, 'Julian Akbar', '123', 20, 'UIC', 0, NULL, NULL);
INSERT INTO `users` VALUES (5, 'Norman Hadi', '123', 20, 'UIC', 0, NULL, NULL);
INSERT INTO `users` VALUES (6, 'M. Andi Arifin', '123', 20, 'UIC', 0, NULL, NULL);
INSERT INTO `users` VALUES (7, 'Isna Habibie', '123', 20, 'UIC', 0, NULL, NULL);
INSERT INTO `users` VALUES (8, 'I Gede Agung Wibawa', '213', 24, 'UIC', 0, NULL, NULL);
INSERT INTO `users` VALUES (9, 'Imar Masriyah', '213', 24, 'UIC', 0, NULL, NULL);
INSERT INTO `users` VALUES (10, 'Ali Suhanda', '213', 24, 'UIC', 0, NULL, NULL);
INSERT INTO `users` VALUES (11, 'Sony Mardiana', '123', 2, 'UIC', 0, NULL, NULL);
INSERT INTO `users` VALUES (12, 'I Gede Nyoman Antara', '123', 2, 'UIC', 0, NULL, NULL);
INSERT INTO `users` VALUES (13, 'TQY', '123', 2, 'UIC', 0, NULL, NULL);
INSERT INTO `users` VALUES (14, 'Kholis', '123', 10, 'UIC', 0, NULL, NULL);
INSERT INTO `users` VALUES (15, 'Viki', '123', 10, 'UIC', 0, NULL, NULL);
INSERT INTO `users` VALUES (16, 'Andik', '123', 10, 'UIC', 0, NULL, NULL);
INSERT INTO `users` VALUES (17, 'Ricky', '123', 10, 'UIC', 0, NULL, NULL);
INSERT INTO `users` VALUES (18, 'Johari', '123', 10, 'UIC', 0, NULL, NULL);
INSERT INTO `users` VALUES (19, 'Rizal Yopy P', '123', 13, 'UIC', 0, NULL, NULL);
INSERT INTO `users` VALUES (20, 'Dwi Cahyo', '123', 13, 'UIC', 0, NULL, NULL);
INSERT INTO `users` VALUES (21, 'Aditya Eka', '123', 5, 'UIC', 0, NULL, NULL);
INSERT INTO `users` VALUES (22, 'Fransisca Tiur', '123', 5, 'UIC', 0, NULL, NULL);
INSERT INTO `users` VALUES (23, 'Yogi Maulana Malik', '123', 11, 'UIC', 0, NULL, NULL);
INSERT INTO `users` VALUES (24, 'Fitry Nurlaily Ghozali', '123', 11, 'UIC', 0, NULL, NULL);
INSERT INTO `users` VALUES (25, 'Wahyu Rachmad Wildan', '123', 11, 'UIC', 0, NULL, NULL);

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
