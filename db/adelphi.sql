/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : adelphi

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2016-11-09 17:25:45
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for auth_assignment
-- ----------------------------
DROP TABLE IF EXISTS `auth_assignment`;
CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of auth_assignment
-- ----------------------------
INSERT INTO `auth_assignment` VALUES ('ADMIN', '19', null);
INSERT INTO `auth_assignment` VALUES ('ADMIN', '20', null);
INSERT INTO `auth_assignment` VALUES ('ADMIN', '21', null);
INSERT INTO `auth_assignment` VALUES ('IT', '10', null);
INSERT INTO `auth_assignment` VALUES ('ORGANIZER', '14', null);

-- ----------------------------
-- Table structure for auth_item
-- ----------------------------
DROP TABLE IF EXISTS `auth_item`;
CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `idx-auth_item-type` (`type`),
  KEY `rule_name` (`rule_name`),
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of auth_item
-- ----------------------------
INSERT INTO `auth_item` VALUES ('ADMIN', '2', 'user as ADMIN', null, null, null, null);
INSERT INTO `auth_item` VALUES ('IT', '1', 'user as IT', null, null, null, null);
INSERT INTO `auth_item` VALUES ('ORGANIZER', '3', 'user as ORGANIZER', null, null, null, null);

-- ----------------------------
-- Table structure for auth_item_child
-- ----------------------------
DROP TABLE IF EXISTS `auth_item_child`;
CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of auth_item_child
-- ----------------------------
INSERT INTO `auth_item_child` VALUES ('ADMIN', 'ORGANIZER');
INSERT INTO `auth_item_child` VALUES ('IT', 'ADMIN');
INSERT INTO `auth_item_child` VALUES ('IT', 'ORGANIZER');

-- ----------------------------
-- Table structure for auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `auth_rule`;
CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of auth_rule
-- ----------------------------
INSERT INTO `auth_rule` VALUES ('default', null, null, null);

-- ----------------------------
-- Table structure for barangay
-- ----------------------------
DROP TABLE IF EXISTS `barangay`;
CREATE TABLE `barangay` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `barangay` varchar(255) NOT NULL,
  `municipality_city_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `municipality_city_id` (`municipality_city_id`),
  CONSTRAINT `barangay_ibfk_1` FOREIGN KEY (`municipality_city_id`) REFERENCES `municipality_city` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3003 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of barangay
-- ----------------------------
INSERT INTO `barangay` VALUES ('4', 'Adlawon ', '6');
INSERT INTO `barangay` VALUES ('5', 'Agsungot', '6');
INSERT INTO `barangay` VALUES ('6', 'Apas ', '6');
INSERT INTO `barangay` VALUES ('7', 'Bacayan', '6');
INSERT INTO `barangay` VALUES ('8', 'Banilad', '6');
INSERT INTO `barangay` VALUES ('9', 'Binaliw', '6');
INSERT INTO `barangay` VALUES ('10', 'Budla-an', '6');
INSERT INTO `barangay` VALUES ('11', 'Busay', '6');
INSERT INTO `barangay` VALUES ('12', 'Cambinocot', '6');
INSERT INTO `barangay` VALUES ('13', 'Capitol Site', '6');
INSERT INTO `barangay` VALUES ('14', 'Carreta', '6');
INSERT INTO `barangay` VALUES ('15', 'Cogon Ramos', '6');
INSERT INTO `barangay` VALUES ('16', 'Day-as', '6');
INSERT INTO `barangay` VALUES ('17', 'Ermita', '6');
INSERT INTO `barangay` VALUES ('18', 'Guba', '6');
INSERT INTO `barangay` VALUES ('19', 'Hipodromo', '6');
INSERT INTO `barangay` VALUES ('20', 'Kalubihan', '6');
INSERT INTO `barangay` VALUES ('21', 'Kamagayan', '6');
INSERT INTO `barangay` VALUES ('22', 'Kamputhaw', '6');
INSERT INTO `barangay` VALUES ('23', 'Kasambagan', '6');
INSERT INTO `barangay` VALUES ('24', 'Lahug ', '6');
INSERT INTO `barangay` VALUES ('25', 'Lorega San Miguel', '6');
INSERT INTO `barangay` VALUES ('26', 'Losaran', '6');
INSERT INTO `barangay` VALUES ('27', 'Luz', '6');
INSERT INTO `barangay` VALUES ('28', 'Mabini', '6');
INSERT INTO `barangay` VALUES ('29', 'Mabolo', '6');
INSERT INTO `barangay` VALUES ('30', 'Malubog', '6');
INSERT INTO `barangay` VALUES ('31', 'Pahina Central', '6');
INSERT INTO `barangay` VALUES ('32', 'Pari-an', '6');
INSERT INTO `barangay` VALUES ('33', 'Paril', '6');
INSERT INTO `barangay` VALUES ('34', 'Pit-os', '6');
INSERT INTO `barangay` VALUES ('35', 'Pulangbato', '6');
INSERT INTO `barangay` VALUES ('36', 'Sambag1', '6');
INSERT INTO `barangay` VALUES ('37', 'Sambag2', '6');
INSERT INTO `barangay` VALUES ('38', 'San Antonio', '6');
INSERT INTO `barangay` VALUES ('39', 'San Jose', '6');
INSERT INTO `barangay` VALUES ('40', 'San Roque', '6');
INSERT INTO `barangay` VALUES ('41', 'Santa Cruz', '6');
INSERT INTO `barangay` VALUES ('42', 'Santo Niño', '6');
INSERT INTO `barangay` VALUES ('43', 'Sirao', '6');
INSERT INTO `barangay` VALUES ('44', 'T. Padilla', '6');
INSERT INTO `barangay` VALUES ('45', 'Talamban', '6');
INSERT INTO `barangay` VALUES ('46', 'Taptap', '6');
INSERT INTO `barangay` VALUES ('47', 'Tejero', '6');
INSERT INTO `barangay` VALUES ('48', 'Tinago', '6');
INSERT INTO `barangay` VALUES ('49', 'Zapatera', '6');
INSERT INTO `barangay` VALUES ('50', 'Tabogon', '6');
INSERT INTO `barangay` VALUES ('51', 'Babag', '6');
INSERT INTO `barangay` VALUES ('52', 'Banawa', '6');
INSERT INTO `barangay` VALUES ('53', 'Basak Pardo', '6');
INSERT INTO `barangay` VALUES ('54', 'Basak San Nicolas', '6');
INSERT INTO `barangay` VALUES ('55', 'Bonbon', '6');
INSERT INTO `barangay` VALUES ('56', 'Buhisan', '6');
INSERT INTO `barangay` VALUES ('57', 'Bulacao Pardo', '6');
INSERT INTO `barangay` VALUES ('58', 'Buot-Taup Pardo', '6');
INSERT INTO `barangay` VALUES ('59', 'Duljo-Fatima', '6');
INSERT INTO `barangay` VALUES ('60', 'Guadalupe', '6');
INSERT INTO `barangay` VALUES ('61', 'Inayawan', '6');
INSERT INTO `barangay` VALUES ('62', 'Kalunasan', '6');
INSERT INTO `barangay` VALUES ('63', 'Kinasang-an Pardo', '6');
INSERT INTO `barangay` VALUES ('64', 'Labangon', '6');
INSERT INTO `barangay` VALUES ('65', 'Mambaling', '6');
INSERT INTO `barangay` VALUES ('66', 'Pahina San Nicolas', '6');
INSERT INTO `barangay` VALUES ('67', 'Pamutan', '6');
INSERT INTO `barangay` VALUES ('68', 'Pasil', '6');
INSERT INTO `barangay` VALUES ('69', 'Poblacion Pardo', '6');
INSERT INTO `barangay` VALUES ('70', 'Pung-ol-Sibugay', '6');
INSERT INTO `barangay` VALUES ('71', 'Punta Princesa', '6');
INSERT INTO `barangay` VALUES ('72', 'Quiot Pardo', '6');
INSERT INTO `barangay` VALUES ('73', 'San Nicolas Proper', '6');
INSERT INTO `barangay` VALUES ('74', 'Sapangdaku', '6');
INSERT INTO `barangay` VALUES ('75', 'Sawang Calero', '6');
INSERT INTO `barangay` VALUES ('76', 'Sinsin', '6');
INSERT INTO `barangay` VALUES ('77', 'Suba San Nicolas', '6');
INSERT INTO `barangay` VALUES ('78', 'Sudlon I', '6');
INSERT INTO `barangay` VALUES ('79', 'Sudlon II', '6');
INSERT INTO `barangay` VALUES ('80', 'Tabunan', '6');
INSERT INTO `barangay` VALUES ('81', 'Tag-bao', '6');
INSERT INTO `barangay` VALUES ('82', 'Tisa', '6');
INSERT INTO `barangay` VALUES ('83', 'To-ong Pardo', '6');
INSERT INTO `barangay` VALUES ('84', 'Tuburan', '6');
INSERT INTO `barangay` VALUES ('85', 'Barangay 1 ', '9');
INSERT INTO `barangay` VALUES ('86', 'Barangay 2 ', '9');
INSERT INTO `barangay` VALUES ('87', 'Barangay 3', '9');
INSERT INTO `barangay` VALUES ('88', 'Barangay 4', '9');
INSERT INTO `barangay` VALUES ('89', 'Barangay 5', '9');
INSERT INTO `barangay` VALUES ('90', 'Barangay 6', '9');
INSERT INTO `barangay` VALUES ('91', 'Barangay 7', '9');
INSERT INTO `barangay` VALUES ('92', 'Barangay 8 ', '9');
INSERT INTO `barangay` VALUES ('93', 'Barangay 9', '9');
INSERT INTO `barangay` VALUES ('94', 'Barangay 10', '9');
INSERT INTO `barangay` VALUES ('95', 'Barangay 11', '9');
INSERT INTO `barangay` VALUES ('96', 'Barangay 12 ', '9');
INSERT INTO `barangay` VALUES ('97', 'Barangay 13', '9');
INSERT INTO `barangay` VALUES ('98', 'Barangay 14	', '9');
INSERT INTO `barangay` VALUES ('99', 'Barangay 15', '9');
INSERT INTO `barangay` VALUES ('100', 'Barangay 16 ', '9');
INSERT INTO `barangay` VALUES ('101', 'Barangay 17 	', '9');
INSERT INTO `barangay` VALUES ('102', 'Barangay 18 ', '9');
INSERT INTO `barangay` VALUES ('103', 'Barangay 19', '9');
INSERT INTO `barangay` VALUES ('104', 'Barangay 20 ', '9');
INSERT INTO `barangay` VALUES ('105', 'Barangay 21 ', '9');
INSERT INTO `barangay` VALUES ('106', 'Barangay 22 ', '9');
INSERT INTO `barangay` VALUES ('107', 'Barangay 23', '9');
INSERT INTO `barangay` VALUES ('108', 'Barangay 24 ', '9');
INSERT INTO `barangay` VALUES ('109', 'Barangay 25 ', '9');
INSERT INTO `barangay` VALUES ('110', 'Barangay 26 ', '9');
INSERT INTO `barangay` VALUES ('111', 'Barangay 27 ', '9');
INSERT INTO `barangay` VALUES ('112', 'Barangay 28 ', '9');
INSERT INTO `barangay` VALUES ('113', 'Barangay 29 ', '9');
INSERT INTO `barangay` VALUES ('114', 'Barangay 30', '9');
INSERT INTO `barangay` VALUES ('115', 'Barangay 31', '9');
INSERT INTO `barangay` VALUES ('116', 'Barangay 32 ', '9');
INSERT INTO `barangay` VALUES ('117', 'Barangay 33 ', '9');
INSERT INTO `barangay` VALUES ('118', 'Barangay 34 ', '9');
INSERT INTO `barangay` VALUES ('119', 'Barangay 35 ', '9');
INSERT INTO `barangay` VALUES ('120', 'Barangay 36', '9');
INSERT INTO `barangay` VALUES ('121', 'Barangay 37 ', '9');
INSERT INTO `barangay` VALUES ('122', 'Barangay 38 ', '9');
INSERT INTO `barangay` VALUES ('123', 'Barangay 39 ', '9');
INSERT INTO `barangay` VALUES ('124', 'Barangay 40 ', '9');
INSERT INTO `barangay` VALUES ('125', 'Barangay 41', '9');
INSERT INTO `barangay` VALUES ('126', 'Barangay Alangilan', '9');
INSERT INTO `barangay` VALUES ('127', 'Barangay Alijis ', '9');
INSERT INTO `barangay` VALUES ('128', 'Barangay Banago ', '9');
INSERT INTO `barangay` VALUES ('129', 'Barangay Bata ', '9');
INSERT INTO `barangay` VALUES ('130', 'Barangay Cabug ', '9');
INSERT INTO `barangay` VALUES ('131', 'Barangay Estefania', '9');
INSERT INTO `barangay` VALUES ('132', 'Barangay Felisa ', '9');
INSERT INTO `barangay` VALUES ('133', 'Barangay Granada ', '9');
INSERT INTO `barangay` VALUES ('134', 'Barangay Handumanan', '9');
INSERT INTO `barangay` VALUES ('135', 'Barangay Mandalagan', '9');
INSERT INTO `barangay` VALUES ('136', 'Barangay Mansilingan', '9');
INSERT INTO `barangay` VALUES ('137', 'Barangay Montevista', '9');
INSERT INTO `barangay` VALUES ('138', 'Barangay Pahanocoy', '9');
INSERT INTO `barangay` VALUES ('139', ' bullet	Barangay Punta-taytay ', '9');
INSERT INTO `barangay` VALUES ('140', 'Barangay Singcang-Airport ', '9');
INSERT INTO `barangay` VALUES ('141', 'Barangay Sum-ag ', '9');
INSERT INTO `barangay` VALUES ('142', 'Barangay Taculing ', '9');
INSERT INTO `barangay` VALUES ('143', 'Barangay Tangub', '9');
INSERT INTO `barangay` VALUES ('144', 'Barangay Villamonte ', '9');
INSERT INTO `barangay` VALUES ('145', 'Barangay Vista Alegre', '9');
INSERT INTO `barangay` VALUES ('146', 'Abuanan ', '10');
INSERT INTO `barangay` VALUES ('147', 'Alianza', '10');
INSERT INTO `barangay` VALUES ('148', 'Antipuluan', '10');
INSERT INTO `barangay` VALUES ('149', 'Bagroy', '10');
INSERT INTO `barangay` VALUES ('150', 'Bacong', '10');
INSERT INTO `barangay` VALUES ('151', 'Balingasag', '10');
INSERT INTO `barangay` VALUES ('152', 'Busay', '10');
INSERT INTO `barangay` VALUES ('153', 'Binubuhan', '10');
INSERT INTO `barangay` VALUES ('154', 'Caridad', '10');
INSERT INTO `barangay` VALUES ('155', 'Calumangan', '10');
INSERT INTO `barangay` VALUES ('156', 'Don Jorge Araneta', '10');
INSERT INTO `barangay` VALUES ('157', 'Dulao', '10');
INSERT INTO `barangay` VALUES ('158', 'Ilijan', '10');
INSERT INTO `barangay` VALUES ('159', 'Lag-asan', '10');
INSERT INTO `barangay` VALUES ('160', 'Ma-ao', '10');
INSERT INTO `barangay` VALUES ('161', 'Malingin', '10');
INSERT INTO `barangay` VALUES ('162', 'Mailum', '10');
INSERT INTO `barangay` VALUES ('163', 'Napoles', '10');
INSERT INTO `barangay` VALUES ('164', 'Pacol', '10');
INSERT INTO `barangay` VALUES ('165', 'Poblacion', '10');
INSERT INTO `barangay` VALUES ('166', 'Sagasa', '10');
INSERT INTO `barangay` VALUES ('167', 'Sampinit', '10');
INSERT INTO `barangay` VALUES ('168', 'Tabunan', '10');
INSERT INTO `barangay` VALUES ('169', 'Taloc', '10');
INSERT INTO `barangay` VALUES ('170', 'Andres Bonifacio', '11');
INSERT INTO `barangay` VALUES ('171', 'Banquerohan', '11');
INSERT INTO `barangay` VALUES ('172', 'Burgos', '11');
INSERT INTO `barangay` VALUES ('173', 'Cadiz Viejo', '11');
INSERT INTO `barangay` VALUES ('174', ' Caduhaan', '11');
INSERT INTO `barangay` VALUES ('175', 'Cabahug', '11');
INSERT INTO `barangay` VALUES ('176', ' Celestino Villacin', '11');
INSERT INTO `barangay` VALUES ('177', 'Daga', '11');
INSERT INTO `barangay` VALUES ('178', 'Jerusalem', '11');
INSERT INTO `barangay` VALUES ('179', ' Luna', '11');
INSERT INTO `barangay` VALUES ('180', ' Mabini', '11');
INSERT INTO `barangay` VALUES ('181', 'Magsaysay', '11');
INSERT INTO `barangay` VALUES ('182', ' Sicaba', '11');
INSERT INTO `barangay` VALUES ('183', ' Tiglawigan', '11');
INSERT INTO `barangay` VALUES ('184', 'Tinampaan', '11');
INSERT INTO `barangay` VALUES ('185', ' VF Gustilo', '11');
INSERT INTO `barangay` VALUES ('186', 'Zone 1', '11');
INSERT INTO `barangay` VALUES ('187', ' Zone 2', '11');
INSERT INTO `barangay` VALUES ('188', 'Zone 3', '11');
INSERT INTO `barangay` VALUES ('189', 'Zone 4', '11');
INSERT INTO `barangay` VALUES ('190', 'Zone 5', '11');
INSERT INTO `barangay` VALUES ('191', ' Zone 6', '11');
INSERT INTO `barangay` VALUES ('192', 'Alimango ', '12');
INSERT INTO `barangay` VALUES ('193', 'Balintawak', '12');
INSERT INTO `barangay` VALUES ('194', 'Binaguiohan', '12');
INSERT INTO `barangay` VALUES ('195', ' Buenavista ', '12');
INSERT INTO `barangay` VALUES ('196', 'Cervantes  ', '12');
INSERT INTO `barangay` VALUES ('197', 'Dian-ay', '12');
INSERT INTO `barangay` VALUES ('198', ' Hacienda', '12');
INSERT INTO `barangay` VALUES ('199', ' Fe ', '12');
INSERT INTO `barangay` VALUES ('200', ' Japitan', '12');
INSERT INTO `barangay` VALUES ('201', ' Jonobjonob ', '12');
INSERT INTO `barangay` VALUES ('202', 'Langub ', '12');
INSERT INTO `barangay` VALUES ('203', 'Libertad ', '12');
INSERT INTO `barangay` VALUES ('204', 'Mabini', '12');
INSERT INTO `barangay` VALUES ('205', 'Magsaysay ', '12');
INSERT INTO `barangay` VALUES ('206', ' Malasibog', '12');
INSERT INTO `barangay` VALUES ('207', ' Old Poblacion ', '12');
INSERT INTO `barangay` VALUES ('208', 'Paitan ', '12');
INSERT INTO `barangay` VALUES ('209', 'Pinapugasan ', '12');
INSERT INTO `barangay` VALUES ('210', ' Rizal  ', '12');
INSERT INTO `barangay` VALUES ('211', 'Tamlang  ', '12');
INSERT INTO `barangay` VALUES ('212', 'Udtongan', '12');
INSERT INTO `barangay` VALUES ('213', ' Washington ', '12');
INSERT INTO `barangay` VALUES ('214', 'Bantayan', '13');
INSERT INTO `barangay` VALUES ('215', 'Binicuil', '13');
INSERT INTO `barangay` VALUES ('216', 'Camansi', '13');
INSERT INTO `barangay` VALUES ('217', 'Camingawan', '13');
INSERT INTO `barangay` VALUES ('218', 'Camugao', '13');
INSERT INTO `barangay` VALUES ('219', 'Carol-an', '13');
INSERT INTO `barangay` VALUES ('220', 'Daan Banua ', '13');
INSERT INTO `barangay` VALUES ('221', 'Hilamonan', '13');
INSERT INTO `barangay` VALUES ('222', 'Inapoy ', '13');
INSERT INTO `barangay` VALUES ('223', 'Linao', '13');
INSERT INTO `barangay` VALUES ('224', 'Locota', '13');
INSERT INTO `barangay` VALUES ('225', 'Magballo ', '13');
INSERT INTO `barangay` VALUES ('226', 'Oringao', '13');
INSERT INTO `barangay` VALUES ('227', 'Orong', '13');
INSERT INTO `barangay` VALUES ('228', 'Pinaguinpinan ', '13');
INSERT INTO `barangay` VALUES ('229', 'Barangay 5 (Pob.)', '13');
INSERT INTO `barangay` VALUES ('230', ' Barangay 6 (Pob.) ', '13');
INSERT INTO `barangay` VALUES ('231', 'Barangay 7 (Pob.) ', '13');
INSERT INTO `barangay` VALUES ('232', 'Barangay 8 (Pob.)', '13');
INSERT INTO `barangay` VALUES ('233', ' Barangay 9 (Pob.) ', '13');
INSERT INTO `barangay` VALUES ('234', 'Barangay 1 (Pob.) ', '13');
INSERT INTO `barangay` VALUES ('235', 'Barangay 2 (Pob.)', '13');
INSERT INTO `barangay` VALUES ('236', 'Barangay 3 (Pob.) ', '13');
INSERT INTO `barangay` VALUES ('237', 'Barangay 4 (Pob.) ', '13');
INSERT INTO `barangay` VALUES ('238', 'Salong ', '13');
INSERT INTO `barangay` VALUES ('239', 'Tabugon ', '13');
INSERT INTO `barangay` VALUES ('240', 'Tagoc ', '13');
INSERT INTO `barangay` VALUES ('241', 'Talubangi ', '13');
INSERT INTO `barangay` VALUES ('242', 'Tampalon', '13');
INSERT INTO `barangay` VALUES ('243', 'Tan-Awan ', '13');
INSERT INTO `barangay` VALUES ('244', 'Tapi ', '13');
INSERT INTO `barangay` VALUES ('245', 'Tagukon', '13');
INSERT INTO `barangay` VALUES ('246', 'Ara-al ', '14');
INSERT INTO `barangay` VALUES ('247', 'Ayungon ', '14');
INSERT INTO `barangay` VALUES ('248', 'Balabag ', '14');
INSERT INTO `barangay` VALUES ('249', 'Batuan', '14');
INSERT INTO `barangay` VALUES ('250', 'Cubay ', '14');
INSERT INTO `barangay` VALUES ('251', 'Haguimit', '14');
INSERT INTO `barangay` VALUES ('252', ' La Granja ', '14');
INSERT INTO `barangay` VALUES ('253', 'Nagasi ', '14');
INSERT INTO `barangay` VALUES ('254', 'Barangay I (Pob.) ', '14');
INSERT INTO `barangay` VALUES ('255', 'Barangay II (Pob.) ', '14');
INSERT INTO `barangay` VALUES ('256', 'Barangay III (Pob.) ', '14');
INSERT INTO `barangay` VALUES ('257', 'Barangay RSB ', '14');
INSERT INTO `barangay` VALUES ('258', 'San Miguel', '14');
INSERT INTO `barangay` VALUES ('259', 'Yubo', '14');
INSERT INTO `barangay` VALUES ('260', 'Andres Bonifacio', '15');
INSERT INTO `barangay` VALUES ('261', 'Bato', '15');
INSERT INTO `barangay` VALUES ('262', 'Baviera', '15');
INSERT INTO `barangay` VALUES ('263', 'Bulanon', '15');
INSERT INTO `barangay` VALUES ('264', 'Campo Himoga-an', '15');
INSERT INTO `barangay` VALUES ('265', 'Colonia Divina', '15');
INSERT INTO `barangay` VALUES ('266', 'Rafaela Barrera', '15');
INSERT INTO `barangay` VALUES ('267', 'Fabrica', '15');
INSERT INTO `barangay` VALUES ('268', 'General Luna', '15');
INSERT INTO `barangay` VALUES ('269', 'Himoga-an Baybay', '15');
INSERT INTO `barangay` VALUES ('270', 'Lopez Jaena', '15');
INSERT INTO `barangay` VALUES ('271', 'Malubon', '15');
INSERT INTO `barangay` VALUES ('272', 'Makiling', '15');
INSERT INTO `barangay` VALUES ('273', 'Molocaboc ', '15');
INSERT INTO `barangay` VALUES ('274', 'Old Sagay', '15');
INSERT INTO `barangay` VALUES ('275', 'Paraiso ', '15');
INSERT INTO `barangay` VALUES ('276', 'Plaridel', '15');
INSERT INTO `barangay` VALUES ('277', 'Poblacion I (Barangay 1)', '15');
INSERT INTO `barangay` VALUES ('278', 'Poblacion II (Barangay 2)', '15');
INSERT INTO `barangay` VALUES ('279', 'Puey ', '15');
INSERT INTO `barangay` VALUES ('280', 'Rizal', '15');
INSERT INTO `barangay` VALUES ('281', 'Sewahon I (Campo Santiago)', '15');
INSERT INTO `barangay` VALUES ('282', 'Taba-ao ', '15');
INSERT INTO `barangay` VALUES ('283', 'Tadlong Vito', '15');
INSERT INTO `barangay` VALUES ('284', 'Tadlong Vito', '15');
INSERT INTO `barangay` VALUES ('285', 'Bagonbon ', '16');
INSERT INTO `barangay` VALUES ('286', 'Buluangan ', '16');
INSERT INTO `barangay` VALUES ('287', 'Codcod ', '16');
INSERT INTO `barangay` VALUES ('288', 'Ermita (Sipaway) ', '16');
INSERT INTO `barangay` VALUES ('289', 'Guadalupe ', '16');
INSERT INTO `barangay` VALUES ('290', 'Nataban ', '16');
INSERT INTO `barangay` VALUES ('291', 'Palampas ', '16');
INSERT INTO `barangay` VALUES ('292', 'Barangay I (Pob.)', '16');
INSERT INTO `barangay` VALUES ('293', ' Barangay II (Pob.)', '16');
INSERT INTO `barangay` VALUES ('294', 'Barangay III (Pob.) ', '16');
INSERT INTO `barangay` VALUES ('295', 'Barangay IV (Pob.) ', '16');
INSERT INTO `barangay` VALUES ('296', 'Barangay V (Pob.) ', '16');
INSERT INTO `barangay` VALUES ('297', 'Barangay VI (Pob.) ', '16');
INSERT INTO `barangay` VALUES ('298', 'Prosperidad ', '16');
INSERT INTO `barangay` VALUES ('299', 'Punao ', '16');
INSERT INTO `barangay` VALUES ('300', 'Quezon ', '16');
INSERT INTO `barangay` VALUES ('301', 'Rizal ', '16');
INSERT INTO `barangay` VALUES ('302', 'San Juan (Sipaway)', '16');
INSERT INTO `barangay` VALUES ('303', 'Barangay I (Poblacion) (Urban Division) ', '17');
INSERT INTO `barangay` VALUES ('304', 'Barangay II (Pob.) (Urban Division) ', '17');
INSERT INTO `barangay` VALUES ('305', 'Barangay III (Pob.) (Urban Division) ', '17');
INSERT INTO `barangay` VALUES ('306', 'Barangay IV (Pob.) (Urban Division) ', '17');
INSERT INTO `barangay` VALUES ('307', 'Barangay V (Pob.) (Urban Division) ', '17');
INSERT INTO `barangay` VALUES ('308', 'Barangay VI (Pob.) (Hawaiian) (Rural Division)', '17');
INSERT INTO `barangay` VALUES ('309', 'Eustaquio Lopez (Rural Division) ', '17');
INSERT INTO `barangay` VALUES ('310', 'Guimbala-on (Rural Division) ', '17');
INSERT INTO `barangay` VALUES ('311', 'Guinhalaran (Urban Division)', '17');
INSERT INTO `barangay` VALUES ('312', ' Kapitan Ramon (Rural Division) ', '17');
INSERT INTO `barangay` VALUES ('313', 'Lantad (Rural Division) ', '17');
INSERT INTO `barangay` VALUES ('314', 'Mambulac (Urban Division) ', '17');
INSERT INTO `barangay` VALUES ('315', 'Rizal (Urban Division) ', '17');
INSERT INTO `barangay` VALUES ('316', 'Bagtic (Rural Division) ', '17');
INSERT INTO `barangay` VALUES ('317', 'Patag (Rural Division) ', '17');
INSERT INTO `barangay` VALUES ('318', 'Balaring (Rural Division)', '17');
INSERT INTO `barangay` VALUES ('319', 'Barangay 1 (Pob.) ', '18');
INSERT INTO `barangay` VALUES ('320', 'Barangay 2 (Pob.) ', '18');
INSERT INTO `barangay` VALUES ('321', 'Barangay 3 (Pob.) ', '18');
INSERT INTO `barangay` VALUES ('322', 'Barangay 4 (Pob.) ', '18');
INSERT INTO `barangay` VALUES ('323', 'Barangay 5 (Pob.) ', '18');
INSERT INTO `barangay` VALUES ('324', 'Cabadiangan', '18');
INSERT INTO `barangay` VALUES ('325', 'Camindangan ', '18');
INSERT INTO `barangay` VALUES ('326', 'Canturay ', '18');
INSERT INTO `barangay` VALUES ('327', 'Cartagena ', '18');
INSERT INTO `barangay` VALUES ('328', 'Cayhagan', '18');
INSERT INTO `barangay` VALUES ('329', ' Gil Montilla', '18');
INSERT INTO `barangay` VALUES ('330', ' Mambaroto ', '18');
INSERT INTO `barangay` VALUES ('331', 'Manlucahoc', '18');
INSERT INTO `barangay` VALUES ('332', 'Maricalum', '18');
INSERT INTO `barangay` VALUES ('333', ' Nabulao ', '18');
INSERT INTO `barangay` VALUES ('334', 'Nauhang ', '18');
INSERT INTO `barangay` VALUES ('335', 'San Jose ', '18');
INSERT INTO `barangay` VALUES ('336', 'Barangay I (Pob.) ', '19');
INSERT INTO `barangay` VALUES ('337', 'Barangay II (Quezon – Pob.) ', '19');
INSERT INTO `barangay` VALUES ('338', 'Barangay III (Pob.) ', '19');
INSERT INTO `barangay` VALUES ('339', 'Barangay IV (Pob.) ', '19');
INSERT INTO `barangay` VALUES ('340', 'Barangay V (Pob.) ', '19');
INSERT INTO `barangay` VALUES ('341', 'Barangay VI (Estrella/Salvacion – Pob.) ', '19');
INSERT INTO `barangay` VALUES ('342', 'Barangay VII (Pob.) ', '19');
INSERT INTO `barangay` VALUES ('343', 'Barangay VIII (Lobaton – Pob.) ', '19');
INSERT INTO `barangay` VALUES ('344', 'Barangay IX (Daan Banwa) ', '19');
INSERT INTO `barangay` VALUES ('345', 'Barangay X (Estado) ', '19');
INSERT INTO `barangay` VALUES ('346', 'Barangay XI (Gawahon) ', '19');
INSERT INTO `barangay` VALUES ('347', 'Barangay XII', '19');
INSERT INTO `barangay` VALUES ('348', 'Barangay XIII (Gloryville) ', '19');
INSERT INTO `barangay` VALUES ('349', 'Barangay XIV ', '19');
INSERT INTO `barangay` VALUES ('350', 'Barangay XV ', '19');
INSERT INTO `barangay` VALUES ('351', 'Barangay XV-A ', '19');
INSERT INTO `barangay` VALUES ('352', 'Barangay XVI ', '19');
INSERT INTO `barangay` VALUES ('353', 'Barangay XVI-A', '19');
INSERT INTO `barangay` VALUES ('354', ' Barangay XVII ', '19');
INSERT INTO `barangay` VALUES ('355', 'Barangay XVIII ', '19');
INSERT INTO `barangay` VALUES ('356', 'Barangay XVIII-A ', '19');
INSERT INTO `barangay` VALUES ('357', 'Barangay XIX ', '19');
INSERT INTO `barangay` VALUES ('358', 'Barangay XIX-A (Canetown Subdivision) ', '19');
INSERT INTO `barangay` VALUES ('359', 'Barangay XX ', '19');
INSERT INTO `barangay` VALUES ('360', 'Barangay XXI ', '19');
INSERT INTO `barangay` VALUES ('361', 'Barangay VI-A', '19');
INSERT INTO `barangay` VALUES ('362', 'Pagla-um ', '20');
INSERT INTO `barangay` VALUES ('363', 'San Pedro ', '20');
INSERT INTO `barangay` VALUES ('364', 'Sto. Rosario', '20');
INSERT INTO `barangay` VALUES ('365', 'Amontay', '20');
INSERT INTO `barangay` VALUES ('366', ' Bagroy ', '20');
INSERT INTO `barangay` VALUES ('367', 'Bi-ao ', '20');
INSERT INTO `barangay` VALUES ('368', 'Canmoros ', '20');
INSERT INTO `barangay` VALUES ('369', 'Enclaro ', '20');
INSERT INTO `barangay` VALUES ('370', 'Marina ', '20');
INSERT INTO `barangay` VALUES ('371', 'Payao (formerly Soledad[8]) ', '20');
INSERT INTO `barangay` VALUES ('372', 'Progreso ', '20');
INSERT INTO `barangay` VALUES ('373', 'San Jose ', '20');
INSERT INTO `barangay` VALUES ('374', 'San Juan ', '20');
INSERT INTO `barangay` VALUES ('375', 'San Teodoro ', '20');
INSERT INTO `barangay` VALUES ('376', 'San Vicente ', '20');
INSERT INTO `barangay` VALUES ('377', 'Santol', '20');
INSERT INTO `barangay` VALUES ('378', 'Abeto Mirasol Taft South', '41');
INSERT INTO `barangay` VALUES ('379', 'Aguinaldo', '41');
INSERT INTO `barangay` VALUES ('380', 'Airport', '41');
INSERT INTO `barangay` VALUES ('381', 'Alalasan Lapuz', '41');
INSERT INTO `barangay` VALUES ('382', 'Arguelles', '41');
INSERT INTO `barangay` VALUES ('383', 'Arsenal Aduana', '41');
INSERT INTO `barangay` VALUES ('384', 'Bakhaw', '41');
INSERT INTO `barangay` VALUES ('385', 'Balabago', '41');
INSERT INTO `barangay` VALUES ('386', 'Balantang', '41');
INSERT INTO `barangay` VALUES ('387', 'Baldoza', '41');
INSERT INTO `barangay` VALUES ('388', 'Bantud', '41');
INSERT INTO `barangay` VALUES ('389', 'Banuyao', '41');
INSERT INTO `barangay` VALUES ('390', 'Baybay Tanza', '41');
INSERT INTO `barangay` VALUES ('391', 'Bito-on', '41');
INSERT INTO `barangay` VALUES ('392', 'Bolilao', '41');
INSERT INTO `barangay` VALUES ('393', 'Bonifacio Tanza', '41');
INSERT INTO `barangay` VALUES ('394', 'Bonifacio', '41');
INSERT INTO `barangay` VALUES ('395', 'Buhang Taft North', '41');
INSERT INTO `barangay` VALUES ('396', 'Buhang', '41');
INSERT INTO `barangay` VALUES ('397', 'Buntatala', '41');
INSERT INTO `barangay` VALUES ('398', 'Burgos-Mabini-Plaza', '41');
INSERT INTO `barangay` VALUES ('399', 'Caingin', '41');
INSERT INTO `barangay` VALUES ('400', 'Calahunar', '41');
INSERT INTO `barangay` VALUES ('401', 'Calaparan', '41');
INSERT INTO `barangay` VALUES ('402', 'Calubihan', '41');
INSERT INTO `barangay` VALUES ('403', 'Calumpan', '41');
INSERT INTO `barangay` VALUES ('404', 'Camalig', '41');
INSERT INTO `barangay` VALUES ('405', 'Cochero', '41');
INSERT INTO `barangay` VALUES ('406', 'Compania', '41');
INSERT INTO `barangay` VALUES ('407', 'Concepcion-Montes', '41');
INSERT INTO `barangay` VALUES ('408', 'Cuartero', '41');
INSERT INTO `barangay` VALUES ('409', 'Cubay', '41');
INSERT INTO `barangay` VALUES ('410', 'Danao', '41');
INSERT INTO `barangay` VALUES ('411', 'Delgado-Jalandoni-Bagumbay', '41');
INSERT INTO `barangay` VALUES ('412', 'Democrac', '41');
INSERT INTO `barangay` VALUES ('413', 'Desampar', '41');
INSERT INTO `barangay` VALUES ('414', 'Divinagrac', '41');
INSERT INTO `barangay` VALUES ('415', 'Don Esteban-Lapuz', '41');
INSERT INTO `barangay` VALUES ('416', 'Dulonan', '41');
INSERT INTO `barangay` VALUES ('417', 'Dungon A', '41');
INSERT INTO `barangay` VALUES ('418', 'Dungon B', '41');
INSERT INTO `barangay` VALUES ('419', 'Dungon', '41');
INSERT INTO `barangay` VALUES ('420', 'East Baluarte', '41');
INSERT INTO `barangay` VALUES ('421', 'East Timawa', '41');
INSERT INTO `barangay` VALUES ('422', 'Edganzon', '41');
INSERT INTO `barangay` VALUES ('423', 'El 98 Castilla', '41');
INSERT INTO `barangay` VALUES ('424', 'Fajardo', '41');
INSERT INTO `barangay` VALUES ('425', 'Flores', '41');
INSERT INTO `barangay` VALUES ('426', 'General Hughes-Montes', '41');
INSERT INTO `barangay` VALUES ('427', 'Gloria', '41');
INSERT INTO `barangay` VALUES ('428', 'Gustilo', '41');
INSERT INTO `barangay` VALUES ('429', 'Guzman-Jesena', '41');
INSERT INTO `barangay` VALUES ('430', 'Habog-habog Salvacion', '41');
INSERT INTO `barangay` VALUES ('431', 'Hibao-an Norte', '41');
INSERT INTO `barangay` VALUES ('432', 'Hibao-an Sur', '41');
INSERT INTO `barangay` VALUES ('433', 'Hinactacar', '41');
INSERT INTO `barangay` VALUES ('434', 'Hipodromo', '41');
INSERT INTO `barangay` VALUES ('435', 'Inday', '41');
INSERT INTO `barangay` VALUES ('436', 'Infante', '41');
INSERT INTO `barangay` VALUES ('437', 'Ingore', '41');
INSERT INTO `barangay` VALUES ('438', 'Jalandoni Estate-Lapuz', '41');
INSERT INTO `barangay` VALUES ('439', 'Jalandoni-Wilson', '41');
INSERT INTO `barangay` VALUES ('440', 'Jaro (Benedicto)', '41');
INSERT INTO `barangay` VALUES ('441', 'Javellana', '41');
INSERT INTO `barangay` VALUES ('442', 'Jereos', '41');
INSERT INTO `barangay` VALUES ('443', 'Kahirupan', '41');
INSERT INTO `barangay` VALUES ('444', 'Kasingkas', '41');
INSERT INTO `barangay` VALUES ('445', 'Katilingbar', '41');
INSERT INTO `barangay` VALUES ('446', 'Kauswaga', '41');
INSERT INTO `barangay` VALUES ('447', 'Laguda', '41');
INSERT INTO `barangay` VALUES ('448', 'Lanit', '41');
INSERT INTO `barangay` VALUES ('449', 'Lapuz Norte', '41');
INSERT INTO `barangay` VALUES ('450', 'Lapuz Sur', '41');
INSERT INTO `barangay` VALUES ('451', 'Legaspi dela Rama', '41');
INSERT INTO `barangay` VALUES ('452', 'Liberation', '41');
INSERT INTO `barangay` VALUES ('453', 'Libertad-Santa Isabel', '41');
INSERT INTO `barangay` VALUES ('454', 'Libertad-Lapuz', '41');
INSERT INTO `barangay` VALUES ('455', 'Loboc-Lapuz', '41');
INSERT INTO `barangay` VALUES ('456', 'Lopez Jaena Norte', '41');
INSERT INTO `barangay` VALUES ('457', 'Lopez Jaena Sur', '41');
INSERT INTO `barangay` VALUES ('458', 'Lopez Jaena', '41');
INSERT INTO `barangay` VALUES ('459', 'Luna', '41');
INSERT INTO `barangay` VALUES ('460', 'M. V. Hechanova', '41');
INSERT INTO `barangay` VALUES ('461', 'Mabolo-Delgado', '41');
INSERT INTO `barangay` VALUES ('462', 'Macarthur', '41');
INSERT INTO `barangay` VALUES ('463', 'Magdalo', '41');
INSERT INTO `barangay` VALUES ('464', 'Magsaysay Village', '41');
INSERT INTO `barangay` VALUES ('465', 'Magsaysay', '41');
INSERT INTO `barangay` VALUES ('466', 'Malipayon-Delgado', '41');
INSERT INTO `barangay` VALUES ('467', 'Mansaya-Lapuz', '41');
INSERT INTO `barangay` VALUES ('468', 'Marcelo H. del Pilar', '41');
INSERT INTO `barangay` VALUES ('469', 'Maria Clara', '41');
INSERT INTO `barangay` VALUES ('470', 'Maria Cristina', '41');
INSERT INTO `barangay` VALUES ('471', 'Mohon', '41');
INSERT INTO `barangay` VALUES ('472', 'Molo Boulevard', '41');
INSERT INTO `barangay` VALUES ('473', 'Monica Blumentritt', '41');
INSERT INTO `barangay` VALUES ('474', 'Montinola', '41');
INSERT INTO `barangay` VALUES ('475', 'Muelle Loney-Montes', '41');
INSERT INTO `barangay` VALUES ('476', 'Nabitasan', '41');
INSERT INTO `barangay` VALUES ('477', 'Navais', '41');
INSERT INTO `barangay` VALUES ('478', 'Nonoy', '41');
INSERT INTO `barangay` VALUES ('479', 'North Avanceña', '41');
INSERT INTO `barangay` VALUES ('480', 'North Baluarte', '41');
INSERT INTO `barangay` VALUES ('481', 'North Fundidor', '41');
INSERT INTO `barangay` VALUES ('482', 'North San Jose', '41');
INSERT INTO `barangay` VALUES ('483', 'Obrero-Lapuz', '41');
INSERT INTO `barangay` VALUES ('484', 'Oñate de Leon', '41');
INSERT INTO `barangay` VALUES ('485', 'Ortiz', '41');
INSERT INTO `barangay` VALUES ('486', 'Osmeña', '41');
INSERT INTO `barangay` VALUES ('487', 'Our Lady Of Fatima', '41');
INSERT INTO `barangay` VALUES ('488', 'Our Lady Of Lourdes', '41');
INSERT INTO `barangay` VALUES ('489', 'Pale Benedicto Rizal', '41');
INSERT INTO `barangay` VALUES ('490', 'PHHC Block 17', '41');
INSERT INTO `barangay` VALUES ('491', 'PHHC Block 22', '41');
INSERT INTO `barangay` VALUES ('492', 'Poblacion Molo', '41');
INSERT INTO `barangay` VALUES ('493', 'President Roxas', '41');
INSERT INTO `barangay` VALUES ('494', 'Progreso-Lapuz', '41');
INSERT INTO `barangay` VALUES ('495', 'Punong-Lapuz', '41');
INSERT INTO `barangay` VALUES ('496', 'Quezon', '41');
INSERT INTO `barangay` VALUES ('497', 'Quintin Salas', '41');
INSERT INTO `barangay` VALUES ('498', 'Railway', '41');
INSERT INTO `barangay` VALUES ('499', 'Rima-Rizal', '41');
INSERT INTO `barangay` VALUES ('500', 'Rizal', '41');
INSERT INTO `barangay` VALUES ('501', 'Rizal Estanzuela', '41');
INSERT INTO `barangay` VALUES ('502', 'Rizal Ibarra', '41');
INSERT INTO `barangay` VALUES ('503', 'Rizal Palapala I', '41');
INSERT INTO `barangay` VALUES ('504', 'Rizal Palapala II', '41');
INSERT INTO `barangay` VALUES ('505', 'Roxas Village', '41');
INSERT INTO `barangay` VALUES ('506', 'Sambag', '41');
INSERT INTO `barangay` VALUES ('507', 'Sampaguita', '41');
INSERT INTO `barangay` VALUES ('508', 'San Agustin', '41');
INSERT INTO `barangay` VALUES ('509', 'San Antonio', '41');
INSERT INTO `barangay` VALUES ('510', 'San Felix', '41');
INSERT INTO `barangay` VALUES ('511', 'San Isidro', '41');
INSERT INTO `barangay` VALUES ('512', 'San Jose Arevalo', '41');
INSERT INTO `barangay` VALUES ('513', 'San Jose (City Proper)', '41');
INSERT INTO `barangay` VALUES ('514', 'San Jose Jaro', '41');
INSERT INTO `barangay` VALUES ('515', 'San Juan', '41');
INSERT INTO `barangay` VALUES ('516', 'San Nicolas', '41');
INSERT INTO `barangay` VALUES ('517', 'San Pedro Jaro', '41');
INSERT INTO `barangay` VALUES ('518', 'San Pedro', '41');
INSERT INTO `barangay` VALUES ('519', 'San Rafael', '41');
INSERT INTO `barangay` VALUES ('520', 'San Roque', '41');
INSERT INTO `barangay` VALUES ('521', 'San Vicente', '41');
INSERT INTO `barangay` VALUES ('522', 'Santa Cruz', '41');
INSERT INTO `barangay` VALUES ('523', 'Santa Filomena', '41');
INSERT INTO `barangay` VALUES ('524', 'Santa Rosa', '41');
INSERT INTO `barangay` VALUES ('525', 'Santo Domingo', '41');
INSERT INTO `barangay` VALUES ('526', 'Santo Niño Norte', '41');
INSERT INTO `barangay` VALUES ('527', 'Santo Niño Sur', '41');
INSERT INTO `barangay` VALUES ('528', 'Santo Rosario-Duran', '41');
INSERT INTO `barangay` VALUES ('529', 'Seminario', '41');
INSERT INTO `barangay` VALUES ('530', 'Simon Ledesma', '41');
INSERT INTO `barangay` VALUES ('531', 'Sinikway', '41');
INSERT INTO `barangay` VALUES ('532', 'So-oc', '41');
INSERT INTO `barangay` VALUES ('533', 'South Baluarte', '41');
INSERT INTO `barangay` VALUES ('534', 'South Fundidor', '41');
INSERT INTO `barangay` VALUES ('535', 'South San Jose', '41');
INSERT INTO `barangay` VALUES ('536', 'Taal', '41');
INSERT INTO `barangay` VALUES ('537', 'Tabuc Suba', '41');
INSERT INTO `barangay` VALUES ('538', 'Tabucan', '41');
INSERT INTO `barangay` VALUES ('539', 'Tacas', '41');
INSERT INTO `barangay` VALUES ('540', 'Tagbac', '41');
INSERT INTO `barangay` VALUES ('541', 'Tanza-Esperanza', '41');
INSERT INTO `barangay` VALUES ('542', 'Tap-oc', '41');
INSERT INTO `barangay` VALUES ('543', 'Taytay Zone II ', '41');
INSERT INTO `barangay` VALUES ('544', 'Ticud', '41');
INSERT INTO `barangay` VALUES ('545', 'Timawa Tanza I', '41');
INSERT INTO `barangay` VALUES ('546', 'Timawa Tanza II', '41');
INSERT INTO `barangay` VALUES ('547', 'Ungka', '41');
INSERT INTO `barangay` VALUES ('548', 'Veterans Village', '41');
INSERT INTO `barangay` VALUES ('549', 'Villa Anita', '41');
INSERT INTO `barangay` VALUES ('550', 'West Habog-habog', '41');
INSERT INTO `barangay` VALUES ('551', 'West Timawa', '41');
INSERT INTO `barangay` VALUES ('552', 'Yulo Drive', '41');
INSERT INTO `barangay` VALUES ('553', 'Yulo-Arroyo', '41');
INSERT INTO `barangay` VALUES ('554', 'Zamora-Melliza', '41');
INSERT INTO `barangay` VALUES ('555', 'Alang-alang', '7');
INSERT INTO `barangay` VALUES ('556', 'Bakilid', '7');
INSERT INTO `barangay` VALUES ('557', 'Banilad', '7');
INSERT INTO `barangay` VALUES ('558', 'Basak', '7');
INSERT INTO `barangay` VALUES ('559', 'Cabancalan', '7');
INSERT INTO `barangay` VALUES ('560', 'Cambaro', '7');
INSERT INTO `barangay` VALUES ('561', 'Canduman', '7');
INSERT INTO `barangay` VALUES ('562', 'Casili', '7');
INSERT INTO `barangay` VALUES ('563', 'Casuntingan', '7');
INSERT INTO `barangay` VALUES ('564', 'Centro (pob.)', '7');
INSERT INTO `barangay` VALUES ('565', 'Cubacub', '7');
INSERT INTO `barangay` VALUES ('566', 'Guizo', '7');
INSERT INTO `barangay` VALUES ('567', 'Ibabao-Estancia', '7');
INSERT INTO `barangay` VALUES ('568', 'Jagobiao', '7');
INSERT INTO `barangay` VALUES ('569', 'Labogon', '7');
INSERT INTO `barangay` VALUES ('570', 'Looc', '7');
INSERT INTO `barangay` VALUES ('571', 'Maguikay', '7');
INSERT INTO `barangay` VALUES ('572', 'Mantuyong', '7');
INSERT INTO `barangay` VALUES ('573', 'Opao', '7');
INSERT INTO `barangay` VALUES ('574', 'Pakna?an', '7');
INSERT INTO `barangay` VALUES ('575', 'Pagsabungan', '7');
INSERT INTO `barangay` VALUES ('576', 'Subangdaku', '7');
INSERT INTO `barangay` VALUES ('577', 'Tabok', '7');
INSERT INTO `barangay` VALUES ('578', 'Tawason', '7');
INSERT INTO `barangay` VALUES ('579', 'Tingub', '7');
INSERT INTO `barangay` VALUES ('580', 'Tipolo', '7');
INSERT INTO `barangay` VALUES ('581', 'Umapad', '7');
INSERT INTO `barangay` VALUES ('582', 'Agpangi ', '21');
INSERT INTO `barangay` VALUES ('583', 'Ani-e ', '21');
INSERT INTO `barangay` VALUES ('584', 'Bagacay ', '21');
INSERT INTO `barangay` VALUES ('585', 'Bantayanon ', '21');
INSERT INTO `barangay` VALUES ('586', 'Buenavista ', '21');
INSERT INTO `barangay` VALUES ('587', 'Cabungahan ', '21');
INSERT INTO `barangay` VALUES ('588', 'Calampisawan ', '21');
INSERT INTO `barangay` VALUES ('589', 'Cambayobo ', '21');
INSERT INTO `barangay` VALUES ('590', 'Castellano ', '21');
INSERT INTO `barangay` VALUES ('591', 'Cruz ', '21');
INSERT INTO `barangay` VALUES ('592', 'Dolis ', '21');
INSERT INTO `barangay` VALUES ('593', 'Hilub-Ang ', '21');
INSERT INTO `barangay` VALUES ('594', 'Hinab-Ongan ', '21');
INSERT INTO `barangay` VALUES ('595', 'Ilaya', '21');
INSERT INTO `barangay` VALUES ('596', 'Laga-an ', '21');
INSERT INTO `barangay` VALUES ('597', 'Lalong ', '21');
INSERT INTO `barangay` VALUES ('598', 'Lemery', '21');
INSERT INTO `barangay` VALUES ('599', ' Lipat-on', '21');
INSERT INTO `barangay` VALUES ('600', 'Lo-ok (Pob.) ', '21');
INSERT INTO `barangay` VALUES ('601', 'Ma-aslob ', '21');
INSERT INTO `barangay` VALUES ('602', 'Macasilao ', '21');
INSERT INTO `barangay` VALUES ('603', 'Malanog', '21');
INSERT INTO `barangay` VALUES ('604', 'Malatas ', '21');
INSERT INTO `barangay` VALUES ('605', 'Marcelo ', '21');
INSERT INTO `barangay` VALUES ('606', 'Mina-utok ', '21');
INSERT INTO `barangay` VALUES ('607', 'Menchaca ', '21');
INSERT INTO `barangay` VALUES ('608', 'Minapasu', '21');
INSERT INTO `barangay` VALUES ('609', 'Mahilum', '21');
INSERT INTO `barangay` VALUES ('610', 'Paghumayan', '21');
INSERT INTO `barangay` VALUES ('611', 'Pantao', '21');
INSERT INTO `barangay` VALUES ('612', 'Patun-an ', '21');
INSERT INTO `barangay` VALUES ('613', 'Pinocutan ', '21');
INSERT INTO `barangay` VALUES ('614', 'Refugio ', '21');
INSERT INTO `barangay` VALUES ('615', 'San Benito ', '21');
INSERT INTO `barangay` VALUES ('616', 'San Isidro ', '21');
INSERT INTO `barangay` VALUES ('617', 'Suba (Pob.) ', '21');
INSERT INTO `barangay` VALUES ('618', 'Telim ', '21');
INSERT INTO `barangay` VALUES ('619', 'Tigbao ', '21');
INSERT INTO `barangay` VALUES ('620', 'Tigbon ', '21');
INSERT INTO `barangay` VALUES ('621', 'Winaswasan', '21');
INSERT INTO `barangay` VALUES ('622', 'Agboy', '22');
INSERT INTO `barangay` VALUES ('623', 'Banga', '22');
INSERT INTO `barangay` VALUES ('624', 'Cabia-an', '22');
INSERT INTO `barangay` VALUES ('625', 'Caningay', '22');
INSERT INTO `barangay` VALUES ('626', 'Gatuslao', '22');
INSERT INTO `barangay` VALUES ('627', 'Haba', '22');
INSERT INTO `barangay` VALUES ('628', 'Payauan', '22');
INSERT INTO `barangay` VALUES ('629', 'Poblacion East', '22');
INSERT INTO `barangay` VALUES ('630', 'Poblacion West', '22');
INSERT INTO `barangay` VALUES ('631', 'Abaca', '23');
INSERT INTO `barangay` VALUES ('632', 'Baclao', '23');
INSERT INTO `barangay` VALUES ('633', 'Basak', '23');
INSERT INTO `barangay` VALUES ('634', 'Bulata', '23');
INSERT INTO `barangay` VALUES ('635', 'Caliling', '23');
INSERT INTO `barangay` VALUES ('636', 'Camalanda-an', '23');
INSERT INTO `barangay` VALUES ('637', 'Camindangan', '23');
INSERT INTO `barangay` VALUES ('638', 'Elihan	', '23');
INSERT INTO `barangay` VALUES ('639', 'Guiljungan', '23');
INSERT INTO `barangay` VALUES ('640', 'Inayawan', '23');
INSERT INTO `barangay` VALUES ('641', 'Isio', '23');
INSERT INTO `barangay` VALUES ('642', 'Linaon', '23');
INSERT INTO `barangay` VALUES ('643', 'Lumbia', '23');
INSERT INTO `barangay` VALUES ('644', 'Mambugsay', '23');
INSERT INTO `barangay` VALUES ('645', 'Man-uling', '23');
INSERT INTO `barangay` VALUES ('646', 'Masaling', '23');
INSERT INTO `barangay` VALUES ('647', 'Molobolo', '23');
INSERT INTO `barangay` VALUES ('648', 'Poblacion', '23');
INSERT INTO `barangay` VALUES ('649', 'Sura', '23');
INSERT INTO `barangay` VALUES ('650', 'Talacdan', '23');
INSERT INTO `barangay` VALUES ('651', 'Tambad', '23');
INSERT INTO `barangay` VALUES ('652', 'Tiling', '23');
INSERT INTO `barangay` VALUES ('653', 'Tomina', '23');
INSERT INTO `barangay` VALUES ('654', 'Tuyom', '23');
INSERT INTO `barangay` VALUES ('655', 'Tuyom', '23');
INSERT INTO `barangay` VALUES ('656', 'Yaoyao	', '23');
INSERT INTO `barangay` VALUES ('657', 'Awihao', '150');
INSERT INTO `barangay` VALUES ('658', 'Bagakay', '150');
INSERT INTO `barangay` VALUES ('659', 'Bato', '150');
INSERT INTO `barangay` VALUES ('660', 'Biga', '150');
INSERT INTO `barangay` VALUES ('661', 'Bulongan', '150');
INSERT INTO `barangay` VALUES ('662', 'Bunga', '150');
INSERT INTO `barangay` VALUES ('663', 'Cabitoonan', '150');
INSERT INTO `barangay` VALUES ('664', 'Calongcalong', '150');
INSERT INTO `barangay` VALUES ('665', 'Cambang?ug', '150');
INSERT INTO `barangay` VALUES ('666', 'Camp 8', '150');
INSERT INTO `barangay` VALUES ('667', 'Canlumampao', '150');
INSERT INTO `barangay` VALUES ('668', 'Cantabaco', '150');
INSERT INTO `barangay` VALUES ('669', 'Capitan Claudio', '150');
INSERT INTO `barangay` VALUES ('670', 'Carmen', '150');
INSERT INTO `barangay` VALUES ('671', 'Daanglungsod', '150');
INSERT INTO `barangay` VALUES ('672', 'Don Andres Soriano (Lutopan)', '150');
INSERT INTO `barangay` VALUES ('673', 'Dumlog', '150');
INSERT INTO `barangay` VALUES ('674', 'Ibo', '150');
INSERT INTO `barangay` VALUES ('675', 'Ilihan', '150');
INSERT INTO `barangay` VALUES ('676', 'Landahan', '150');
INSERT INTO `barangay` VALUES ('677', 'Loay', '150');
INSERT INTO `barangay` VALUES ('678', 'Luray II', '150');
INSERT INTO `barangay` VALUES ('679', 'Juan Climaco, Sr. (Magdugo)', '150');
INSERT INTO `barangay` VALUES ('680', 'Gen. Climaco (Malubog)', '150');
INSERT INTO `barangay` VALUES ('681', 'Matab?ang', '150');
INSERT INTO `barangay` VALUES ('682', 'Media Once', '150');
INSERT INTO `barangay` VALUES ('683', 'Pangamihan', '150');
INSERT INTO `barangay` VALUES ('684', 'Poblacion', '150');
INSERT INTO `barangay` VALUES ('685', 'Poog', '150');
INSERT INTO `barangay` VALUES ('686', 'Putingbato', '150');
INSERT INTO `barangay` VALUES ('687', 'Sagay', '150');
INSERT INTO `barangay` VALUES ('688', 'Sam?ang', '150');
INSERT INTO `barangay` VALUES ('689', 'Sangi', '150');
INSERT INTO `barangay` VALUES ('690', 'Santo Niño (Mainggit)', '150');
INSERT INTO `barangay` VALUES ('691', 'Subayon', '150');
INSERT INTO `barangay` VALUES ('692', 'Talavera', '150');
INSERT INTO `barangay` VALUES ('693', 'Tungkay', '150');
INSERT INTO `barangay` VALUES ('694', 'Tubod', '150');
INSERT INTO `barangay` VALUES ('695', 'Alacaygan', '24');
INSERT INTO `barangay` VALUES ('696', 'Alicante', '24');
INSERT INTO `barangay` VALUES ('697', 'Poblacion I (Barangay 1)', '24');
INSERT INTO `barangay` VALUES ('698', 'Poblacion II (Barangay 2)', '24');
INSERT INTO `barangay` VALUES ('699', 'Poblacion III (Barangay 3)', '24');
INSERT INTO `barangay` VALUES ('700', 'Batea', '24');
INSERT INTO `barangay` VALUES ('701', 'Consing', '24');
INSERT INTO `barangay` VALUES ('702', 'Cudangdang', '24');
INSERT INTO `barangay` VALUES ('703', 'Damgo', '24');
INSERT INTO `barangay` VALUES ('704', 'Gahit', '24');
INSERT INTO `barangay` VALUES ('705', 'Canlusong', '24');
INSERT INTO `barangay` VALUES ('706', 'Latasan', '24');
INSERT INTO `barangay` VALUES ('707', 'Madalag', '24');
INSERT INTO `barangay` VALUES ('708', 'Manta-angan', '24');
INSERT INTO `barangay` VALUES ('709', 'Nanca', '24');
INSERT INTO `barangay` VALUES ('710', 'Pasil', '24');
INSERT INTO `barangay` VALUES ('711', 'San Isidro', '24');
INSERT INTO `barangay` VALUES ('712', 'San Jose', '24');
INSERT INTO `barangay` VALUES ('713', 'Santo Niño', '24');
INSERT INTO `barangay` VALUES ('714', 'Tabigue', '24');
INSERT INTO `barangay` VALUES ('715', 'Tanza', '24');
INSERT INTO `barangay` VALUES ('716', 'Tuburan', '24');
INSERT INTO `barangay` VALUES ('717', 'Tomongtong', '24');
INSERT INTO `barangay` VALUES ('718', 'Aguisan ', '25');
INSERT INTO `barangay` VALUES ('719', 'Buenavista ', '25');
INSERT INTO `barangay` VALUES ('720', 'Cabadiangan', '25');
INSERT INTO `barangay` VALUES ('721', 'Cabanbanan', '25');
INSERT INTO `barangay` VALUES ('722', 'Carabalan ', '25');
INSERT INTO `barangay` VALUES ('723', 'Caradio-an ', '25');
INSERT INTO `barangay` VALUES ('724', 'Libacao ', '25');
INSERT INTO `barangay` VALUES ('725', 'Mambagaton ', '25');
INSERT INTO `barangay` VALUES ('726', 'Nabali-an ', '25');
INSERT INTO `barangay` VALUES ('727', 'Mahalang ', '25');
INSERT INTO `barangay` VALUES ('728', 'San Antonio ', '25');
INSERT INTO `barangay` VALUES ('729', 'Sara-et ', '25');
INSERT INTO `barangay` VALUES ('730', 'Su-ay ', '25');
INSERT INTO `barangay` VALUES ('731', 'Talaban ', '25');
INSERT INTO `barangay` VALUES ('732', 'To-oy ', '25');
INSERT INTO `barangay` VALUES ('733', 'Barangay I (Poblacion) ', '25');
INSERT INTO `barangay` VALUES ('734', 'Barangay II (Poblacion)', '25');
INSERT INTO `barangay` VALUES ('735', ' Barangay III (Poblacion) ', '25');
INSERT INTO `barangay` VALUES ('736', 'Barangay IV (Poblacion)', '25');
INSERT INTO `barangay` VALUES ('737', 'Biasong', '8');
INSERT INTO `barangay` VALUES ('738', 'Bulacao', '8');
INSERT INTO `barangay` VALUES ('739', 'Camp IV', '8');
INSERT INTO `barangay` VALUES ('740', 'Candulawan', '8');
INSERT INTO `barangay` VALUES ('741', 'Cansojong', '8');
INSERT INTO `barangay` VALUES ('742', 'Dumlog', '8');
INSERT INTO `barangay` VALUES ('743', 'Jaclupan', '8');
INSERT INTO `barangay` VALUES ('744', 'Lagtang', '8');
INSERT INTO `barangay` VALUES ('745', 'Lawaan I', '8');
INSERT INTO `barangay` VALUES ('746', 'Lawaan II', '8');
INSERT INTO `barangay` VALUES ('747', 'Lawaan III', '8');
INSERT INTO `barangay` VALUES ('748', 'Linao', '8');
INSERT INTO `barangay` VALUES ('749', 'Maghaway', '8');
INSERT INTO `barangay` VALUES ('750', 'Manipis', '8');
INSERT INTO `barangay` VALUES ('751', 'Mohon', '8');
INSERT INTO `barangay` VALUES ('752', 'Poblacion', '8');
INSERT INTO `barangay` VALUES ('753', 'Pooc', '8');
INSERT INTO `barangay` VALUES ('754', 'San Isidro', '8');
INSERT INTO `barangay` VALUES ('755', 'San Roque', '8');
INSERT INTO `barangay` VALUES ('756', 'Tabunoc', '8');
INSERT INTO `barangay` VALUES ('757', 'Tangke', '8');
INSERT INTO `barangay` VALUES ('758', 'Tapul', '8');
INSERT INTO `barangay` VALUES ('759', 'Alim ', '27');
INSERT INTO `barangay` VALUES ('760', 'Asia ', '27');
INSERT INTO `barangay` VALUES ('761', 'Bacuyangan ', '27');
INSERT INTO `barangay` VALUES ('762', 'Barangay I (Pob.) ', '27');
INSERT INTO `barangay` VALUES ('763', 'Barangay II (Pob.) ', '27');
INSERT INTO `barangay` VALUES ('764', 'Bulwangan ', '27');
INSERT INTO `barangay` VALUES ('765', 'Culipapa ', '27');
INSERT INTO `barangay` VALUES ('766', 'Damutan ', '27');
INSERT INTO `barangay` VALUES ('767', 'Daug ', '27');
INSERT INTO `barangay` VALUES ('768', 'Po-ok ', '27');
INSERT INTO `barangay` VALUES ('769', 'San Rafael ', '27');
INSERT INTO `barangay` VALUES ('770', 'Sangke ', '27');
INSERT INTO `barangay` VALUES ('771', 'Talacagay', '27');
INSERT INTO `barangay` VALUES ('772', 'Andulauan ', '28');
INSERT INTO `barangay` VALUES ('773', 'Balicotoc ', '28');
INSERT INTO `barangay` VALUES ('774', 'Bocana ', '28');
INSERT INTO `barangay` VALUES ('775', 'Calubang ', '28');
INSERT INTO `barangay` VALUES ('776', 'Canlamay ', '28');
INSERT INTO `barangay` VALUES ('777', 'Consuelo ', '28');
INSERT INTO `barangay` VALUES ('778', 'Dancalan ', '28');
INSERT INTO `barangay` VALUES ('779', 'Delicioso', '28');
INSERT INTO `barangay` VALUES ('780', 'Galicia ', '28');
INSERT INTO `barangay` VALUES ('781', 'Manalad', '28');
INSERT INTO `barangay` VALUES ('782', 'Pinggot', '28');
INSERT INTO `barangay` VALUES ('783', ' Barangay I (Pob.) ', '28');
INSERT INTO `barangay` VALUES ('784', 'Barangay II (Pob.) ', '28');
INSERT INTO `barangay` VALUES ('785', 'Tabu ', '28');
INSERT INTO `barangay` VALUES ('786', 'Vista Alegre', '28');
INSERT INTO `barangay` VALUES ('787', 'Alfaco', '148');
INSERT INTO `barangay` VALUES ('788', 'Bairan', '148');
INSERT INTO `barangay` VALUES ('789', 'Balirong', '148');
INSERT INTO `barangay` VALUES ('790', 'Cabungahan', '148');
INSERT INTO `barangay` VALUES ('791', 'Cantao?an', '148');
INSERT INTO `barangay` VALUES ('792', 'Central Poblacion', '148');
INSERT INTO `barangay` VALUES ('793', 'Cogon', '148');
INSERT INTO `barangay` VALUES ('794', 'Colon', '148');
INSERT INTO `barangay` VALUES ('795', 'East Poblacion', '148');
INSERT INTO `barangay` VALUES ('796', 'Inoburan', '148');
INSERT INTO `barangay` VALUES ('797', 'Inayagan', '148');
INSERT INTO `barangay` VALUES ('798', 'Jaguimit', '148');
INSERT INTO `barangay` VALUES ('799', 'Lanas', '148');
INSERT INTO `barangay` VALUES ('800', 'Langtad', '148');
INSERT INTO `barangay` VALUES ('801', 'Lutac', '148');
INSERT INTO `barangay` VALUES ('802', 'Mainit', '148');
INSERT INTO `barangay` VALUES ('803', 'Mayana', '148');
INSERT INTO `barangay` VALUES ('804', 'Naalad', '148');
INSERT INTO `barangay` VALUES ('805', 'North Poblacion', '148');
INSERT INTO `barangay` VALUES ('806', 'Pangdan', '148');
INSERT INTO `barangay` VALUES ('807', 'Patag', '148');
INSERT INTO `barangay` VALUES ('808', 'South Poblacion', '148');
INSERT INTO `barangay` VALUES ('809', 'Tagjaguimit', '148');
INSERT INTO `barangay` VALUES ('810', 'Tangke', '148');
INSERT INTO `barangay` VALUES ('811', 'Tinaan', '148');
INSERT INTO `barangay` VALUES ('812', 'Tuyan', '148');
INSERT INTO `barangay` VALUES ('813', 'Uling', '148');
INSERT INTO `barangay` VALUES ('814', 'West Poblacion', '148');
INSERT INTO `barangay` VALUES ('815', 'Amin ', '29');
INSERT INTO `barangay` VALUES ('816', 'Banogbanog ', '29');
INSERT INTO `barangay` VALUES ('817', 'Bulad ', '29');
INSERT INTO `barangay` VALUES ('818', 'Bungahin ', '29');
INSERT INTO `barangay` VALUES ('819', 'Cabcab ', '29');
INSERT INTO `barangay` VALUES ('820', 'Camangcamang ', '29');
INSERT INTO `barangay` VALUES ('821', 'Camp Clark ', '29');
INSERT INTO `barangay` VALUES ('822', 'Cansalongon ', '29');
INSERT INTO `barangay` VALUES ('823', 'Guintubhan ', '29');
INSERT INTO `barangay` VALUES ('824', 'Libas ', '29');
INSERT INTO `barangay` VALUES ('825', 'Limalima ', '29');
INSERT INTO `barangay` VALUES ('826', 'Makilignit', '29');
INSERT INTO `barangay` VALUES ('827', 'Mansablay ', '29');
INSERT INTO `barangay` VALUES ('828', 'Maytubig ', '29');
INSERT INTO `barangay` VALUES ('829', 'Panaquiao Barangay 1 (Pob.) Barangay 2 (Pob.) Barangay 3 (Pob.) Barangay 4 (Pob.) Barangay 5 (Pob.) Barangay 6 (Pob.) Barangay 7 (Pob.) Barangay 8 (Pob.) Barangay 9 (Pob.) Riverside Rumirang San Agustin Sebucawan Sikatuna Tinongan', '29');
INSERT INTO `barangay` VALUES ('830', 'Panaquiao Barangay 1 (Pob.) ', '29');
INSERT INTO `barangay` VALUES ('831', 'Barangay 2 (Pob.) ', '29');
INSERT INTO `barangay` VALUES ('832', 'Barangay 3 (Pob.) ', '29');
INSERT INTO `barangay` VALUES ('833', 'Barangay 4 (Pob.) ', '29');
INSERT INTO `barangay` VALUES ('834', 'Barangay 5 (Pob.) ', '29');
INSERT INTO `barangay` VALUES ('835', 'Barangay 6 (Pob.) ', '29');
INSERT INTO `barangay` VALUES ('836', 'Barangay 7 (Pob.) ', '29');
INSERT INTO `barangay` VALUES ('837', 'Barangay 8 (Pob.) ', '29');
INSERT INTO `barangay` VALUES ('838', 'Barangay 9 (Pob.) ', '29');
INSERT INTO `barangay` VALUES ('839', 'Riverside ', '29');
INSERT INTO `barangay` VALUES ('840', 'Rumirang ', '29');
INSERT INTO `barangay` VALUES ('841', 'San Agustin', '29');
INSERT INTO `barangay` VALUES ('842', ' Sebucawan ', '29');
INSERT INTO `barangay` VALUES ('843', 'Sikatuna ', '29');
INSERT INTO `barangay` VALUES ('844', 'Tinongan', '29');
INSERT INTO `barangay` VALUES ('845', 'Biaknabato ', '30');
INSERT INTO `barangay` VALUES ('846', 'Cabacungan ', '30');
INSERT INTO `barangay` VALUES ('847', 'Cabagnaan ', '30');
INSERT INTO `barangay` VALUES ('848', 'Camandag ', '30');
INSERT INTO `barangay` VALUES ('849', 'Lalagsan ', '30');
INSERT INTO `barangay` VALUES ('850', 'Manghanoy ', '30');
INSERT INTO `barangay` VALUES ('851', 'Mansalanao ', '30');
INSERT INTO `barangay` VALUES ('852', 'Masulog ', '30');
INSERT INTO `barangay` VALUES ('853', 'Nato ', '30');
INSERT INTO `barangay` VALUES ('854', 'Puso ', '30');
INSERT INTO `barangay` VALUES ('855', 'Robles (Pob.) ', '30');
INSERT INTO `barangay` VALUES ('856', 'Sag-Ang ', '30');
INSERT INTO `barangay` VALUES ('857', 'Talaptap', '30');
INSERT INTO `barangay` VALUES ('858', 'Chambéry ', '31');
INSERT INTO `barangay` VALUES ('859', 'Barangay I (Pob.) ', '31');
INSERT INTO `barangay` VALUES ('860', 'Barangay I-A (Pob.) ', '31');
INSERT INTO `barangay` VALUES ('861', 'Barangay I-B (Pob.)', '31');
INSERT INTO `barangay` VALUES ('862', 'Barangay II (Pob.) ', '31');
INSERT INTO `barangay` VALUES ('863', 'Barangay II-A (Pob.) ', '31');
INSERT INTO `barangay` VALUES ('864', 'Punta Mesa ', '31');
INSERT INTO `barangay` VALUES ('865', 'Punta Salong ', '31');
INSERT INTO `barangay` VALUES ('866', 'Purisima ', '31');
INSERT INTO `barangay` VALUES ('867', 'San Pablo ', '31');
INSERT INTO `barangay` VALUES ('868', 'Santa Teresa ', '31');
INSERT INTO `barangay` VALUES ('869', 'Tortosa', '31');
INSERT INTO `barangay` VALUES ('870', 'Bolinawan', '152');
INSERT INTO `barangay` VALUES ('871', 'Buenavista', '152');
INSERT INTO `barangay` VALUES ('872', 'Calidngan', '152');
INSERT INTO `barangay` VALUES ('873', 'Can?asujan', '152');
INSERT INTO `barangay` VALUES ('874', 'Guadalupe', '152');
INSERT INTO `barangay` VALUES ('875', 'Liburon', '152');
INSERT INTO `barangay` VALUES ('876', 'Napo', '152');
INSERT INTO `barangay` VALUES ('877', 'Ocaña', '152');
INSERT INTO `barangay` VALUES ('878', 'Perrelos', '152');
INSERT INTO `barangay` VALUES ('879', 'Poblacion I', '152');
INSERT INTO `barangay` VALUES ('880', 'Poblacion II', '152');
INSERT INTO `barangay` VALUES ('881', 'Poblacion III', '152');
INSERT INTO `barangay` VALUES ('882', 'Tuyom', '152');
INSERT INTO `barangay` VALUES ('883', 'Valencia', '152');
INSERT INTO `barangay` VALUES ('884', 'Valladolid', '152');
INSERT INTO `barangay` VALUES ('885', 'Barangay 1 (Pob.) ', '32');
INSERT INTO `barangay` VALUES ('886', 'Barangay 2 (Pob.)', '32');
INSERT INTO `barangay` VALUES ('887', ' Barangay 3 (Pob.) ', '32');
INSERT INTO `barangay` VALUES ('888', 'Barangay 4 (Pob.) ', '32');
INSERT INTO `barangay` VALUES ('889', 'Barangay 5 (Pob.) ', '32');
INSERT INTO `barangay` VALUES ('890', 'Barangay 6 (Pob.) ', '32');
INSERT INTO `barangay` VALUES ('891', 'Barangay 7 (Pob.) ', '32');
INSERT INTO `barangay` VALUES ('892', 'Crossing Magallon ', '32');
INSERT INTO `barangay` VALUES ('893', 'Guinpana-an', '32');
INSERT INTO `barangay` VALUES ('894', 'Inolingan (Hda. Salapid) ', '32');
INSERT INTO `barangay` VALUES ('895', 'Macagahay ', '32');
INSERT INTO `barangay` VALUES ('896', 'Magallon Cadre ', '32');
INSERT INTO `barangay` VALUES ('897', 'Montilla ', '32');
INSERT INTO `barangay` VALUES ('898', 'Odiong ', '32');
INSERT INTO `barangay` VALUES ('899', 'Quintin Remo', '32');
INSERT INTO `barangay` VALUES ('900', 'Anahaw ', '26');
INSERT INTO `barangay` VALUES ('901', 'Aranda ', '26');
INSERT INTO `barangay` VALUES ('902', 'Baga-as ', '26');
INSERT INTO `barangay` VALUES ('903', 'Barangay I (Pob.) ', '26');
INSERT INTO `barangay` VALUES ('904', 'Barangay II (Pob.) ', '26');
INSERT INTO `barangay` VALUES ('905', 'Barangay III (Pob.) ', '26');
INSERT INTO `barangay` VALUES ('906', 'Barangay IV (Pob.)', '26');
INSERT INTO `barangay` VALUES ('907', 'Bato', '26');
INSERT INTO `barangay` VALUES ('908', 'Calapi', '26');
INSERT INTO `barangay` VALUES ('909', 'Camalobalo', '26');
INSERT INTO `barangay` VALUES ('910', 'Camba-og', '26');
INSERT INTO `barangay` VALUES ('911', 'Cambugsa', '26');
INSERT INTO `barangay` VALUES ('912', 'Candumarao', '26');
INSERT INTO `barangay` VALUES ('913', 'Gargato', '26');
INSERT INTO `barangay` VALUES ('914', 'Himaya', '26');
INSERT INTO `barangay` VALUES ('915', 'Miranda', '26');
INSERT INTO `barangay` VALUES ('916', 'Nanunga', '26');
INSERT INTO `barangay` VALUES ('917', 'Narauis', '26');
INSERT INTO `barangay` VALUES ('918', 'Palayog', '26');
INSERT INTO `barangay` VALUES ('919', 'Paticui', '26');
INSERT INTO `barangay` VALUES ('920', 'Pilar', '26');
INSERT INTO `barangay` VALUES ('921', 'Quiwi', '26');
INSERT INTO `barangay` VALUES ('922', 'Tagda', '26');
INSERT INTO `barangay` VALUES ('923', 'Tuguis', '26');
INSERT INTO `barangay` VALUES ('924', 'Baliang', '153');
INSERT INTO `barangay` VALUES ('925', 'Bayabas', '153');
INSERT INTO `barangay` VALUES ('926', 'Binaliw', '153');
INSERT INTO `barangay` VALUES ('927', 'Cabungahan', '153');
INSERT INTO `barangay` VALUES ('928', 'Cagat?Lamac', '153');
INSERT INTO `barangay` VALUES ('929', 'Cahumayan', '153');
INSERT INTO `barangay` VALUES ('930', 'Cambanay', '153');
INSERT INTO `barangay` VALUES ('931', 'Cambubho', '153');
INSERT INTO `barangay` VALUES ('932', 'Cogon?Cruz', '153');
INSERT INTO `barangay` VALUES ('933', 'Danasan', '153');
INSERT INTO `barangay` VALUES ('934', 'Dungga', '153');
INSERT INTO `barangay` VALUES ('935', 'Dunggo?an', '153');
INSERT INTO `barangay` VALUES ('936', 'Guinacot', '153');
INSERT INTO `barangay` VALUES ('937', 'Guinsay', '153');
INSERT INTO `barangay` VALUES ('938', 'Ibo', '153');
INSERT INTO `barangay` VALUES ('939', 'Langosig', '153');
INSERT INTO `barangay` VALUES ('940', 'Lawaan', '153');
INSERT INTO `barangay` VALUES ('941', 'Licos', '153');
INSERT INTO `barangay` VALUES ('942', 'Looc', '153');
INSERT INTO `barangay` VALUES ('943', 'Magtagobtob', '153');
INSERT INTO `barangay` VALUES ('944', 'Malapoc', '153');
INSERT INTO `barangay` VALUES ('945', 'Manlayag', '153');
INSERT INTO `barangay` VALUES ('946', 'Mantija', '153');
INSERT INTO `barangay` VALUES ('947', 'Masaba', '153');
INSERT INTO `barangay` VALUES ('948', 'Maslog', '153');
INSERT INTO `barangay` VALUES ('949', 'Nangka', '153');
INSERT INTO `barangay` VALUES ('950', 'Oguis', '153');
INSERT INTO `barangay` VALUES ('951', 'Pili', '153');
INSERT INTO `barangay` VALUES ('952', 'Poblacion', '153');
INSERT INTO `barangay` VALUES ('953', 'Quisol', '153');
INSERT INTO `barangay` VALUES ('954', 'Sabang', '153');
INSERT INTO `barangay` VALUES ('955', 'Sacsac', '153');
INSERT INTO `barangay` VALUES ('956', 'Sandayong Norte', '153');
INSERT INTO `barangay` VALUES ('957', 'Sandayong Sur', '153');
INSERT INTO `barangay` VALUES ('958', 'Santa Rosa', '153');
INSERT INTO `barangay` VALUES ('959', 'Santican', '153');
INSERT INTO `barangay` VALUES ('960', 'Sibacan', '153');
INSERT INTO `barangay` VALUES ('961', 'Suba', '153');
INSERT INTO `barangay` VALUES ('962', 'Taboc', '153');
INSERT INTO `barangay` VALUES ('963', 'Taytay', '153');
INSERT INTO `barangay` VALUES ('964', 'Togonon', '153');
INSERT INTO `barangay` VALUES ('965', 'Tuburan Sur', '153');
INSERT INTO `barangay` VALUES ('966', 'Abo-abo ', '33');
INSERT INTO `barangay` VALUES ('967', 'Alegria ', '33');
INSERT INTO `barangay` VALUES ('968', 'Zone I (Pob.) ', '33');
INSERT INTO `barangay` VALUES ('969', 'Zone II (Pob.) ', '33');
INSERT INTO `barangay` VALUES ('970', 'Zone III (Pob.) ', '33');
INSERT INTO `barangay` VALUES ('971', 'Zone IV (Pob.) ', '33');
INSERT INTO `barangay` VALUES ('972', 'Zone V (Pob.) ', '33');
INSERT INTO `barangay` VALUES ('973', 'Blumentritt', '33');
INSERT INTO `barangay` VALUES ('974', 'Buenavista ', '33');
INSERT INTO `barangay` VALUES ('975', 'Caliban ', '33');
INSERT INTO `barangay` VALUES ('976', 'Canlandog ', '33');
INSERT INTO `barangay` VALUES ('977', 'Cansilayan ', '33');
INSERT INTO `barangay` VALUES ('978', 'Damsite ', '33');
INSERT INTO `barangay` VALUES ('979', 'Iglau-an ', '33');
INSERT INTO `barangay` VALUES ('980', 'Lopez Jaena ', '33');
INSERT INTO `barangay` VALUES ('981', 'Minoyan ', '33');
INSERT INTO `barangay` VALUES ('982', 'Pandanon (Silos) ', '33');
INSERT INTO `barangay` VALUES ('983', 'San Miguel', '33');
INSERT INTO `barangay` VALUES ('984', ' Santa Cruz', '33');
INSERT INTO `barangay` VALUES ('985', ' Santa Rosa ', '33');
INSERT INTO `barangay` VALUES ('986', 'Salvacion ', '33');
INSERT INTO `barangay` VALUES ('987', 'Talotog', '33');
INSERT INTO `barangay` VALUES ('988', 'Amayco', '33');
INSERT INTO `barangay` VALUES ('989', 'Barangay Zone 1-A (Pob. / Paco beach) ', '35');
INSERT INTO `barangay` VALUES ('990', 'Barangay Zone 4-A (Pob.) ', '35');
INSERT INTO `barangay` VALUES ('991', 'Barangay Zone 1 (Pob. / Green beach) ', '35');
INSERT INTO `barangay` VALUES ('992', 'Barangay Zone 2 (Pob.) ', '35');
INSERT INTO `barangay` VALUES ('993', 'Barangay Zone 3 (Pob.) ', '35');
INSERT INTO `barangay` VALUES ('994', 'Barangay Zone 4 (Pob.) ', '35');
INSERT INTO `barangay` VALUES ('995', 'Barangay Zone 5 (Pob.) ', '35');
INSERT INTO `barangay` VALUES ('996', 'Barangay Zone 6 (Pob.) ', '35');
INSERT INTO `barangay` VALUES ('997', 'Barangay Zone 7 (Pob.) ', '35');
INSERT INTO `barangay` VALUES ('998', 'Canjusa ', '35');
INSERT INTO `barangay` VALUES ('999', 'Crossing Pulupandan ', '35');
INSERT INTO `barangay` VALUES ('1000', 'Culo ', '35');
INSERT INTO `barangay` VALUES ('1001', 'Mabini ', '35');
INSERT INTO `barangay` VALUES ('1002', 'Pag-ayon ', '35');
INSERT INTO `barangay` VALUES ('1003', 'Palaka Norte ', '35');
INSERT INTO `barangay` VALUES ('1004', 'Palaka Sur ', '35');
INSERT INTO `barangay` VALUES ('1005', 'Patic ', '35');
INSERT INTO `barangay` VALUES ('1006', 'Tapong ', '35');
INSERT INTO `barangay` VALUES ('1007', 'Ubay ', '35');
INSERT INTO `barangay` VALUES ('1008', 'Utod', '35');
INSERT INTO `barangay` VALUES ('1009', 'Barangay I (Pob.) ', '36');
INSERT INTO `barangay` VALUES ('1010', 'Barangay II (Pob.) ', '36');
INSERT INTO `barangay` VALUES ('1011', 'Barangay III (Pob.) ', '36');
INSERT INTO `barangay` VALUES ('1012', 'Buenavista Gibong ', '36');
INSERT INTO `barangay` VALUES ('1013', 'Buenavista Rizal ', '36');
INSERT INTO `barangay` VALUES ('1014', 'Burgos ', '36');
INSERT INTO `barangay` VALUES ('1015', 'Cambarus ', '36');
INSERT INTO `barangay` VALUES ('1016', 'Canroma ', '36');
INSERT INTO `barangay` VALUES ('1017', 'Don Salvador Benedicto ', '36');
INSERT INTO `barangay` VALUES ('1018', 'General Malvar ', '36');
INSERT INTO `barangay` VALUES ('1019', 'Gomez ', '36');
INSERT INTO `barangay` VALUES ('1020', 'M. H. Del Pilar ', '36');
INSERT INTO `barangay` VALUES ('1021', 'Mabini ', '36');
INSERT INTO `barangay` VALUES ('1022', 'Miranda', '36');
INSERT INTO `barangay` VALUES ('1023', 'Pandan ', '36');
INSERT INTO `barangay` VALUES ('1024', 'Recreo ', '36');
INSERT INTO `barangay` VALUES ('1025', 'San Isidro ', '36');
INSERT INTO `barangay` VALUES ('1026', 'San Juan ', '36');
INSERT INTO `barangay` VALUES ('1027', 'Zamora', '36');
INSERT INTO `barangay` VALUES ('1028', 'Antipolo', '36');
INSERT INTO `barangay` VALUES ('1029', 'Bagonawa ', '37');
INSERT INTO `barangay` VALUES ('1030', 'Baliwagan', '37');
INSERT INTO `barangay` VALUES ('1031', ' Batuan ', '37');
INSERT INTO `barangay` VALUES ('1032', 'Guintorilan ', '37');
INSERT INTO `barangay` VALUES ('1033', 'Nayon ', '37');
INSERT INTO `barangay` VALUES ('1034', 'Poblacion ', '37');
INSERT INTO `barangay` VALUES ('1035', 'Sibucao ', '37');
INSERT INTO `barangay` VALUES ('1036', 'Tabao Baybay ', '37');
INSERT INTO `barangay` VALUES ('1037', 'Tabao Rizal ', '37');
INSERT INTO `barangay` VALUES ('1038', 'Tibsoc', '37');
INSERT INTO `barangay` VALUES ('1039', 'Bandila ', '39');
INSERT INTO `barangay` VALUES ('1040', 'Bug-ang ', '39');
INSERT INTO `barangay` VALUES ('1041', 'General Luna ', '39');
INSERT INTO `barangay` VALUES ('1042', 'Magticol ', '39');
INSERT INTO `barangay` VALUES ('1043', 'Poblacion ', '39');
INSERT INTO `barangay` VALUES ('1044', 'Salamanca ', '39');
INSERT INTO `barangay` VALUES ('1045', 'San Isidro ', '39');
INSERT INTO `barangay` VALUES ('1046', 'San Jose ', '39');
INSERT INTO `barangay` VALUES ('1047', 'Tabun-ac', '39');
INSERT INTO `barangay` VALUES ('1048', 'Alijis ', '40');
INSERT INTO `barangay` VALUES ('1049', 'Ayungon ', '40');
INSERT INTO `barangay` VALUES ('1050', 'Bagumbayan ', '40');
INSERT INTO `barangay` VALUES ('1051', 'Batuan', '40');
INSERT INTO `barangay` VALUES ('1052', 'Bayabas ', '40');
INSERT INTO `barangay` VALUES ('1053', 'Central Tabao ', '40');
INSERT INTO `barangay` VALUES ('1054', 'Doldol ', '40');
INSERT INTO `barangay` VALUES ('1055', 'Guintorilan ', '40');
INSERT INTO `barangay` VALUES ('1056', 'Lacaron ', '40');
INSERT INTO `barangay` VALUES ('1057', 'Mabini ', '40');
INSERT INTO `barangay` VALUES ('1058', 'Pacol ', '40');
INSERT INTO `barangay` VALUES ('1059', 'Palaka ', '40');
INSERT INTO `barangay` VALUES ('1060', 'Paloma ', '40');
INSERT INTO `barangay` VALUES ('1061', 'Poblacion ', '40');
INSERT INTO `barangay` VALUES ('1062', 'Sagua Banua ', '40');
INSERT INTO `barangay` VALUES ('1063', 'Tabao Proper', '40');
INSERT INTO `barangay` VALUES ('1064', 'Cabadiangan', '102');
INSERT INTO `barangay` VALUES ('1065', 'Cabil?isan', '102');
INSERT INTO `barangay` VALUES ('1066', 'Candabong', '102');
INSERT INTO `barangay` VALUES ('1067', 'Lawaan', '102');
INSERT INTO `barangay` VALUES ('1068', 'Manga', '102');
INSERT INTO `barangay` VALUES ('1069', 'Palanas', '102');
INSERT INTO `barangay` VALUES ('1070', 'Poblacion', '102');
INSERT INTO `barangay` VALUES ('1071', 'Polo', '102');
INSERT INTO `barangay` VALUES ('1072', 'Salagmaya', '102');
INSERT INTO `barangay` VALUES ('1073', 'Atabay', '103');
INSERT INTO `barangay` VALUES ('1074', 'Daan-Lungsod', '103');
INSERT INTO `barangay` VALUES ('1075', 'Guiwang', '103');
INSERT INTO `barangay` VALUES ('1076', 'Nug?as', '103');
INSERT INTO `barangay` VALUES ('1077', 'Pasol', '103');
INSERT INTO `barangay` VALUES ('1078', 'Poblacion', '103');
INSERT INTO `barangay` VALUES ('1079', 'Pugalo', '103');
INSERT INTO `barangay` VALUES ('1080', 'San Agustin', '103');
INSERT INTO `barangay` VALUES ('1081', 'Angilan', '104');
INSERT INTO `barangay` VALUES ('1082', 'Bojo', '104');
INSERT INTO `barangay` VALUES ('1083', 'Bonbon', '104');
INSERT INTO `barangay` VALUES ('1084', 'Esperanza', '104');
INSERT INTO `barangay` VALUES ('1085', 'Kandingan', '104');
INSERT INTO `barangay` VALUES ('1086', 'Kantabogon', '104');
INSERT INTO `barangay` VALUES ('1087', 'Kawasan', '104');
INSERT INTO `barangay` VALUES ('1088', 'Olango', '104');
INSERT INTO `barangay` VALUES ('1089', 'Poblacion', '104');
INSERT INTO `barangay` VALUES ('1090', 'Punay', '104');
INSERT INTO `barangay` VALUES ('1091', 'Rosario', '104');
INSERT INTO `barangay` VALUES ('1092', 'Saksak', '104');
INSERT INTO `barangay` VALUES ('1093', 'Tampa?an', '104');
INSERT INTO `barangay` VALUES ('1094', 'Toyokon', '104');
INSERT INTO `barangay` VALUES ('1095', 'Zaragos', '104');
INSERT INTO `barangay` VALUES ('1096', 'Cabangila ', '85');
INSERT INTO `barangay` VALUES ('1097', 'Cabugao ', '85');
INSERT INTO `barangay` VALUES ('1098', 'Catmon ', '85');
INSERT INTO `barangay` VALUES ('1099', 'Dalipdip ', '85');
INSERT INTO `barangay` VALUES ('1100', 'Ginictan ', '85');
INSERT INTO `barangay` VALUES ('1101', 'Linayasan', '85');
INSERT INTO `barangay` VALUES ('1102', 'Lumaynay ', '85');
INSERT INTO `barangay` VALUES ('1103', 'Lupo ', '85');
INSERT INTO `barangay` VALUES ('1104', 'Man-up ', '85');
INSERT INTO `barangay` VALUES ('1105', 'Odiong ', '85');
INSERT INTO `barangay` VALUES ('1106', 'Poblacion ', '85');
INSERT INTO `barangay` VALUES ('1107', 'Quinasay-an ', '85');
INSERT INTO `barangay` VALUES ('1108', 'Talon ', '85');
INSERT INTO `barangay` VALUES ('1109', 'Tibiao', '85');
INSERT INTO `barangay` VALUES ('1110', 'Alambijud', '105');
INSERT INTO `barangay` VALUES ('1111', 'Anajao', '105');
INSERT INTO `barangay` VALUES ('1112', 'Apo', '105');
INSERT INTO `barangay` VALUES ('1113', 'Balaas', '105');
INSERT INTO `barangay` VALUES ('1114', 'Balisong', '105');
INSERT INTO `barangay` VALUES ('1115', 'Binlod', '105');
INSERT INTO `barangay` VALUES ('1116', 'Bogo', '105');
INSERT INTO `barangay` VALUES ('1117', 'Butong', '105');
INSERT INTO `barangay` VALUES ('1118', 'Bug?ot', '105');
INSERT INTO `barangay` VALUES ('1119', 'Bulasa', '105');
INSERT INTO `barangay` VALUES ('1120', 'Calagasan', '105');
INSERT INTO `barangay` VALUES ('1121', 'Canbantug', '105');
INSERT INTO `barangay` VALUES ('1122', 'Canbanua', '105');
INSERT INTO `barangay` VALUES ('1123', 'Cansuje', '105');
INSERT INTO `barangay` VALUES ('1124', 'Capio?an', '105');
INSERT INTO `barangay` VALUES ('1125', 'Casay', '105');
INSERT INTO `barangay` VALUES ('1126', 'Catang', '105');
INSERT INTO `barangay` VALUES ('1127', 'Colawin', '105');
INSERT INTO `barangay` VALUES ('1128', 'Conalum', '105');
INSERT INTO `barangay` VALUES ('1129', 'Guiwanon', '105');
INSERT INTO `barangay` VALUES ('1130', 'Gutlang', '105');
INSERT INTO `barangay` VALUES ('1131', 'Jampang', '105');
INSERT INTO `barangay` VALUES ('1132', 'Jomgao', '105');
INSERT INTO `barangay` VALUES ('1133', 'Lamacan', '105');
INSERT INTO `barangay` VALUES ('1134', 'Langtad', '105');
INSERT INTO `barangay` VALUES ('1135', 'Langub', '105');
INSERT INTO `barangay` VALUES ('1136', 'Lapay', '105');
INSERT INTO `barangay` VALUES ('1137', 'Lengigon', '105');
INSERT INTO `barangay` VALUES ('1138', 'Linut?od', '105');
INSERT INTO `barangay` VALUES ('1139', 'Mabasa', '105');
INSERT INTO `barangay` VALUES ('1140', 'Mandilikit', '105');
INSERT INTO `barangay` VALUES ('1141', 'Mompeller', '105');
INSERT INTO `barangay` VALUES ('1142', 'Panadtaran', '105');
INSERT INTO `barangay` VALUES ('1143', 'Poblacion', '105');
INSERT INTO `barangay` VALUES ('1144', 'Sua', '105');
INSERT INTO `barangay` VALUES ('1145', 'Sumaguan', '105');
INSERT INTO `barangay` VALUES ('1146', 'Tabayag', '105');
INSERT INTO `barangay` VALUES ('1147', 'Talaga', '105');
INSERT INTO `barangay` VALUES ('1148', 'Talaytay', '105');
INSERT INTO `barangay` VALUES ('1149', 'Talo?ot', '105');
INSERT INTO `barangay` VALUES ('1150', 'Tiguib', '105');
INSERT INTO `barangay` VALUES ('1151', 'Tulang', '105');
INSERT INTO `barangay` VALUES ('1152', 'Tulic', '105');
INSERT INTO `barangay` VALUES ('1153', 'Ubaub', '105');
INSERT INTO `barangay` VALUES ('1154', 'Usmad', '105');
INSERT INTO `barangay` VALUES ('1155', 'Aranas ', '86');
INSERT INTO `barangay` VALUES ('1156', 'Arcangel ', '86');
INSERT INTO `barangay` VALUES ('1157', 'Calizo ', '86');
INSERT INTO `barangay` VALUES ('1158', 'Cortes ', '86');
INSERT INTO `barangay` VALUES ('1159', 'Feliciano ', '86');
INSERT INTO `barangay` VALUES ('1160', 'Fulgencio (formerly Morthon[4]) ', '86');
INSERT INTO `barangay` VALUES ('1161', 'Guanko ', '86');
INSERT INTO `barangay` VALUES ('1162', 'Morales ', '86');
INSERT INTO `barangay` VALUES ('1163', 'Oquendo ', '86');
INSERT INTO `barangay` VALUES ('1164', 'Poblacion', '86');
INSERT INTO `barangay` VALUES ('1165', 'Agbanga', '106');
INSERT INTO `barangay` VALUES ('1166', 'Agtugop', '106');
INSERT INTO `barangay` VALUES ('1167', 'Bago', '106');
INSERT INTO `barangay` VALUES ('1168', 'Bairan', '106');
INSERT INTO `barangay` VALUES ('1169', 'Banban', '106');
INSERT INTO `barangay` VALUES ('1170', 'Baye', '106');
INSERT INTO `barangay` VALUES ('1171', 'Bog?o', '106');
INSERT INTO `barangay` VALUES ('1172', 'Kaluangan', '106');
INSERT INTO `barangay` VALUES ('1173', 'Lanao', '106');
INSERT INTO `barangay` VALUES ('1174', 'Langub', '106');
INSERT INTO `barangay` VALUES ('1175', 'Looc Norte', '106');
INSERT INTO `barangay` VALUES ('1176', 'Lunas', '106');
INSERT INTO `barangay` VALUES ('1177', 'Magcalape', '106');
INSERT INTO `barangay` VALUES ('1178', 'Manguiao', '106');
INSERT INTO `barangay` VALUES ('1179', 'New Bago', '106');
INSERT INTO `barangay` VALUES ('1180', 'Owak', '106');
INSERT INTO `barangay` VALUES ('1181', 'Poblacion', '106');
INSERT INTO `barangay` VALUES ('1182', 'Saksak', '106');
INSERT INTO `barangay` VALUES ('1183', 'San Isidro', '106');
INSERT INTO `barangay` VALUES ('1184', 'San Roque', '106');
INSERT INTO `barangay` VALUES ('1185', 'Santa Lucia', '106');
INSERT INTO `barangay` VALUES ('1186', 'Santa Rita', '106');
INSERT INTO `barangay` VALUES ('1187', 'Tag?amakan', '106');
INSERT INTO `barangay` VALUES ('1188', 'Tagbubonga', '106');
INSERT INTO `barangay` VALUES ('1189', 'Tubigagmanok', '106');
INSERT INTO `barangay` VALUES ('1190', 'Tubod', '106');
INSERT INTO `barangay` VALUES ('1191', 'Ubogon', '106');
INSERT INTO `barangay` VALUES ('1192', 'Agbanawan ', '87');
INSERT INTO `barangay` VALUES ('1193', 'Bacan ', '87');
INSERT INTO `barangay` VALUES ('1194', 'Badiangan ', '87');
INSERT INTO `barangay` VALUES ('1195', 'Cerrudo ', '87');
INSERT INTO `barangay` VALUES ('1196', 'Cupang ', '87');
INSERT INTO `barangay` VALUES ('1197', 'Daguitan ', '87');
INSERT INTO `barangay` VALUES ('1198', 'Daja Norte ', '87');
INSERT INTO `barangay` VALUES ('1199', 'Daja Sur ', '87');
INSERT INTO `barangay` VALUES ('1200', 'Dingle ', '87');
INSERT INTO `barangay` VALUES ('1201', 'Jumarap ', '87');
INSERT INTO `barangay` VALUES ('1202', 'Lapnag ', '87');
INSERT INTO `barangay` VALUES ('1203', 'Libas ', '87');
INSERT INTO `barangay` VALUES ('1204', 'Linabuan Sur ', '87');
INSERT INTO `barangay` VALUES ('1205', 'Mambog ', '87');
INSERT INTO `barangay` VALUES ('1206', 'Mangan ', '87');
INSERT INTO `barangay` VALUES ('1207', 'Muguing ', '87');
INSERT INTO `barangay` VALUES ('1208', 'Pagsanghan ', '87');
INSERT INTO `barangay` VALUES ('1209', 'Palale ', '87');
INSERT INTO `barangay` VALUES ('1210', 'Poblacion ', '87');
INSERT INTO `barangay` VALUES ('1211', 'Polo ', '87');
INSERT INTO `barangay` VALUES ('1212', 'Polocate ', '87');
INSERT INTO `barangay` VALUES ('1213', 'San Isidro ', '87');
INSERT INTO `barangay` VALUES ('1214', 'Sibalew ', '87');
INSERT INTO `barangay` VALUES ('1215', 'Sigcay ', '87');
INSERT INTO `barangay` VALUES ('1216', 'Taba-ao ', '87');
INSERT INTO `barangay` VALUES ('1217', 'Tabayon ', '87');
INSERT INTO `barangay` VALUES ('1218', 'Tinapuay ', '87');
INSERT INTO `barangay` VALUES ('1219', 'Torralba ', '87');
INSERT INTO `barangay` VALUES ('1220', 'Ugsod ', '87');
INSERT INTO `barangay` VALUES ('1221', 'Venturanz', '87');
INSERT INTO `barangay` VALUES ('1222', 'Alawijao', '107');
INSERT INTO `barangay` VALUES ('1223', 'Balhaan', '107');
INSERT INTO `barangay` VALUES ('1224', 'Banhigan', '107');
INSERT INTO `barangay` VALUES ('1225', 'Basak', '107');
INSERT INTO `barangay` VALUES ('1226', 'Basiao', '107');
INSERT INTO `barangay` VALUES ('1227', 'Bato', '107');
INSERT INTO `barangay` VALUES ('1228', 'Bugas', '107');
INSERT INTO `barangay` VALUES ('1229', 'Calangcang', '107');
INSERT INTO `barangay` VALUES ('1230', 'Candiis', '107');
INSERT INTO `barangay` VALUES ('1231', 'Dagatan', '107');
INSERT INTO `barangay` VALUES ('1232', 'Dobdob', '107');
INSERT INTO `barangay` VALUES ('1233', 'Ginablan', '107');
INSERT INTO `barangay` VALUES ('1234', 'Lambug', '107');
INSERT INTO `barangay` VALUES ('1235', 'Malabago', '107');
INSERT INTO `barangay` VALUES ('1236', 'Malhiao', '107');
INSERT INTO `barangay` VALUES ('1237', 'Manduyong', '107');
INSERT INTO `barangay` VALUES ('1238', 'Matutinao', '107');
INSERT INTO `barangay` VALUES ('1239', 'Patong', '107');
INSERT INTO `barangay` VALUES ('1240', 'Poblacion', '107');
INSERT INTO `barangay` VALUES ('1241', 'Sanlagan', '107');
INSERT INTO `barangay` VALUES ('1242', 'Santicon', '107');
INSERT INTO `barangay` VALUES ('1243', 'Sohoton', '107');
INSERT INTO `barangay` VALUES ('1244', 'Sulsugan', '107');
INSERT INTO `barangay` VALUES ('1245', 'Talayong', '107');
INSERT INTO `barangay` VALUES ('1246', 'Taytay', '107');
INSERT INTO `barangay` VALUES ('1247', 'Tigbao', '107');
INSERT INTO `barangay` VALUES ('1248', 'Tiguib', '107');
INSERT INTO `barangay` VALUES ('1249', 'Tubod', '107');
INSERT INTO `barangay` VALUES ('1250', 'Zaragosa', '107');
INSERT INTO `barangay` VALUES ('1251', 'Ambolong', '88');
INSERT INTO `barangay` VALUES ('1252', 'Angas', '88');
INSERT INTO `barangay` VALUES ('1253', 'Bay-ang', '88');
INSERT INTO `barangay` VALUES ('1254', 'Caiyang', '88');
INSERT INTO `barangay` VALUES ('1255', 'Cabugao', '88');
INSERT INTO `barangay` VALUES ('1256', 'Camaligan', '88');
INSERT INTO `barangay` VALUES ('1257', 'Camanci', '88');
INSERT INTO `barangay` VALUES ('1258', 'Ipil', '88');
INSERT INTO `barangay` VALUES ('1259', 'Lalab', '88');
INSERT INTO `barangay` VALUES ('1260', 'Lupit', '88');
INSERT INTO `barangay` VALUES ('1261', 'Magpag-ong', '88');
INSERT INTO `barangay` VALUES ('1262', 'Magubahay', '88');
INSERT INTO `barangay` VALUES ('1263', 'Mambuquiao', '88');
INSERT INTO `barangay` VALUES ('1264', 'Man-up', '88');
INSERT INTO `barangay` VALUES ('1265', 'Mandong', '88');
INSERT INTO `barangay` VALUES ('1266', 'Napti', '88');
INSERT INTO `barangay` VALUES ('1267', 'Palay', '88');
INSERT INTO `barangay` VALUES ('1268', 'Poblacion', '88');
INSERT INTO `barangay` VALUES ('1269', 'Songcolan', '88');
INSERT INTO `barangay` VALUES ('1270', 'Tabon', '88');
INSERT INTO `barangay` VALUES ('1271', 'Abucayan', '108');
INSERT INTO `barangay` VALUES ('1272', 'Aliwanay', '108');
INSERT INTO `barangay` VALUES ('1273', 'Arpili', '108');
INSERT INTO `barangay` VALUES ('1274', 'Bayong', '108');
INSERT INTO `barangay` VALUES ('1275', 'Biasong', '108');
INSERT INTO `barangay` VALUES ('1276', 'Buanoy', '108');
INSERT INTO `barangay` VALUES ('1277', 'Cabagdalan', '108');
INSERT INTO `barangay` VALUES ('1278', 'Cabasiangan', '108');
INSERT INTO `barangay` VALUES ('1279', 'Cambuhawe', '108');
INSERT INTO `barangay` VALUES ('1280', 'Cansomoroy', '108');
INSERT INTO `barangay` VALUES ('1281', 'Cantibas', '108');
INSERT INTO `barangay` VALUES ('1282', 'Cantuod', '108');
INSERT INTO `barangay` VALUES ('1283', 'Duangan', '108');
INSERT INTO `barangay` VALUES ('1284', 'Gaas', '108');
INSERT INTO `barangay` VALUES ('1285', 'Ginatilan', '108');
INSERT INTO `barangay` VALUES ('1286', 'Hingatmonan', '108');
INSERT INTO `barangay` VALUES ('1287', 'Lamesa', '108');
INSERT INTO `barangay` VALUES ('1288', 'Liki', '108');
INSERT INTO `barangay` VALUES ('1289', 'Luca', '108');
INSERT INTO `barangay` VALUES ('1290', 'Matun?og', '108');
INSERT INTO `barangay` VALUES ('1291', 'Nangka', '108');
INSERT INTO `barangay` VALUES ('1292', 'Pondol', '108');
INSERT INTO `barangay` VALUES ('1293', 'Prenza', '108');
INSERT INTO `barangay` VALUES ('1294', 'Singsing', '108');
INSERT INTO `barangay` VALUES ('1295', 'Sunog (Magsaysay)', '108');
INSERT INTO `barangay` VALUES ('1296', 'Vito', '108');
INSERT INTO `barangay` VALUES ('1297', 'Baliwagan (pob.)', '108');
INSERT INTO `barangay` VALUES ('1298', 'Santa Cruz–Santo Niño (pob.)', '108');
INSERT INTO `barangay` VALUES ('1299', 'Alegria ', '89');
INSERT INTO `barangay` VALUES ('1300', 'Bagongbayan ', '89');
INSERT INTO `barangay` VALUES ('1301', 'Balusbos ', '89');
INSERT INTO `barangay` VALUES ('1302', 'Bel-is ', '89');
INSERT INTO `barangay` VALUES ('1303', 'Cabugan ', '89');
INSERT INTO `barangay` VALUES ('1304', 'El Progreso ', '89');
INSERT INTO `barangay` VALUES ('1305', 'Habana ', '89');
INSERT INTO `barangay` VALUES ('1306', 'Katipunan ', '89');
INSERT INTO `barangay` VALUES ('1307', 'Mayapay ', '89');
INSERT INTO `barangay` VALUES ('1308', 'Nazareth ', '89');
INSERT INTO `barangay` VALUES ('1309', 'Panilongan ', '89');
INSERT INTO `barangay` VALUES ('1310', 'Poblacion ', '89');
INSERT INTO `barangay` VALUES ('1311', 'Santander ', '89');
INSERT INTO `barangay` VALUES ('1312', 'Tag-osip ', '89');
INSERT INTO `barangay` VALUES ('1313', 'Tigum', '89');
INSERT INTO `barangay` VALUES ('1314', 'Atop-atop', '109');
INSERT INTO `barangay` VALUES ('1315', 'Baigad', '109');
INSERT INTO `barangay` VALUES ('1316', 'Bantigue (pob.', '109');
INSERT INTO `barangay` VALUES ('1317', 'Baod', '109');
INSERT INTO `barangay` VALUES ('1318', 'Binaobao (pob.)', '109');
INSERT INTO `barangay` VALUES ('1319', 'Botigues', '109');
INSERT INTO `barangay` VALUES ('1320', 'Kabac', '109');
INSERT INTO `barangay` VALUES ('1321', 'Doong', '109');
INSERT INTO `barangay` VALUES ('1322', 'Guiwanon', '109');
INSERT INTO `barangay` VALUES ('1323', 'Hilotongan', '109');
INSERT INTO `barangay` VALUES ('1324', 'Kabangbang', '109');
INSERT INTO `barangay` VALUES ('1325', 'Kampingganon', '109');
INSERT INTO `barangay` VALUES ('1326', 'Kangkaibe', '109');
INSERT INTO `barangay` VALUES ('1327', 'Lipayran', '109');
INSERT INTO `barangay` VALUES ('1328', 'Luyongbaybay', '109');
INSERT INTO `barangay` VALUES ('1329', 'Mojon', '109');
INSERT INTO `barangay` VALUES ('1330', 'Obo?ob', '109');
INSERT INTO `barangay` VALUES ('1331', 'Patao', '109');
INSERT INTO `barangay` VALUES ('1332', 'Putian', '109');
INSERT INTO `barangay` VALUES ('1333', 'Sillon', '109');
INSERT INTO `barangay` VALUES ('1334', 'Suba (pob.)', '109');
INSERT INTO `barangay` VALUES ('1335', 'Sulangan', '109');
INSERT INTO `barangay` VALUES ('1336', 'Sungko', '109');
INSERT INTO `barangay` VALUES ('1337', 'Tamiao', '109');
INSERT INTO `barangay` VALUES ('1338', 'Ticad', '109');
INSERT INTO `barangay` VALUES ('1339', 'Agbago ', '90');
INSERT INTO `barangay` VALUES ('1340', 'Agdugayan ', '90');
INSERT INTO `barangay` VALUES ('1341', 'Antipolo ', '90');
INSERT INTO `barangay` VALUES ('1342', 'Aparicio ', '90');
INSERT INTO `barangay` VALUES ('1343', 'Aquino ', '90');
INSERT INTO `barangay` VALUES ('1344', 'Aslum ', '90');
INSERT INTO `barangay` VALUES ('1345', 'Bagacay ', '90');
INSERT INTO `barangay` VALUES ('1346', 'Batuan ', '90');
INSERT INTO `barangay` VALUES ('1347', 'Buenavista ', '90');
INSERT INTO `barangay` VALUES ('1348', 'Bugtongbato ', '90');
INSERT INTO `barangay` VALUES ('1349', 'Cabugao ', '90');
INSERT INTO `barangay` VALUES ('1350', 'Capilijan ', '90');
INSERT INTO `barangay` VALUES ('1351', 'Colongcolong ', '90');
INSERT INTO `barangay` VALUES ('1352', 'Laguinbanua ', '90');
INSERT INTO `barangay` VALUES ('1353', 'Mabusao ', '90');
INSERT INTO `barangay` VALUES ('1354', 'Malindog ', '90');
INSERT INTO `barangay` VALUES ('1355', 'Maloco ', '90');
INSERT INTO `barangay` VALUES ('1356', 'Mina-a ', '90');
INSERT INTO `barangay` VALUES ('1357', 'Monlaque ', '90');
INSERT INTO `barangay` VALUES ('1358', 'Naile ', '90');
INSERT INTO `barangay` VALUES ('1359', 'Naisud ', '90');
INSERT INTO `barangay` VALUES ('1360', 'Naligusan ', '90');
INSERT INTO `barangay` VALUES ('1361', 'Ondoy ', '90');
INSERT INTO `barangay` VALUES ('1362', 'Poblacion ', '90');
INSERT INTO `barangay` VALUES ('1363', 'Polo ', '90');
INSERT INTO `barangay` VALUES ('1364', 'Regador ', '90');
INSERT INTO `barangay` VALUES ('1365', 'Rivera ', '90');
INSERT INTO `barangay` VALUES ('1366', 'Rizal ', '90');
INSERT INTO `barangay` VALUES ('1367', 'San Isidro ', '90');
INSERT INTO `barangay` VALUES ('1368', 'San Jose ', '90');
INSERT INTO `barangay` VALUES ('1369', 'Santa Cruz ', '90');
INSERT INTO `barangay` VALUES ('1370', 'Tagbaya ', '90');
INSERT INTO `barangay` VALUES ('1371', 'Tul-ang ', '90');
INSERT INTO `barangay` VALUES ('1372', 'Unat Yawan', '90');
INSERT INTO `barangay` VALUES ('1373', 'Yawan', '90');
INSERT INTO `barangay` VALUES ('1374', 'Azucena', '110');
INSERT INTO `barangay` VALUES ('1375', 'Bagakay', '110');
INSERT INTO `barangay` VALUES ('1376', 'Balao', '110');
INSERT INTO `barangay` VALUES ('1377', 'Bolocboloc', '110');
INSERT INTO `barangay` VALUES ('1378', 'Budbud', '110');
INSERT INTO `barangay` VALUES ('1379', 'Bugtong Kawayan', '110');
INSERT INTO `barangay` VALUES ('1380', 'Cabcaban', '110');
INSERT INTO `barangay` VALUES ('1381', 'Cagay', '110');
INSERT INTO `barangay` VALUES ('1382', 'Campangga', '110');
INSERT INTO `barangay` VALUES ('1383', 'Candugay', '110');
INSERT INTO `barangay` VALUES ('1384', 'Dakit', '110');
INSERT INTO `barangay` VALUES ('1385', 'Giloctog', '110');
INSERT INTO `barangay` VALUES ('1386', 'Giwanon', '110');
INSERT INTO `barangay` VALUES ('1387', 'Guibuangan', '110');
INSERT INTO `barangay` VALUES ('1388', 'Gunting', '110');
INSERT INTO `barangay` VALUES ('1389', 'Hilasgasan', '110');
INSERT INTO `barangay` VALUES ('1390', 'Japitan', '110');
INSERT INTO `barangay` VALUES ('1391', 'Kalubihan', '110');
INSERT INTO `barangay` VALUES ('1392', 'Kangdampas', '110');
INSERT INTO `barangay` VALUES ('1393', 'Luhod', '110');
INSERT INTO `barangay` VALUES ('1394', 'Lupo', '110');
INSERT INTO `barangay` VALUES ('1395', 'Luyo', '110');
INSERT INTO `barangay` VALUES ('1396', 'Maghanoy', '110');
INSERT INTO `barangay` VALUES ('1397', 'Maigang', '110');
INSERT INTO `barangay` VALUES ('1398', 'Malolos', '110');
INSERT INTO `barangay` VALUES ('1399', 'Mantalongon', '110');
INSERT INTO `barangay` VALUES ('1400', 'Mantayupan', '110');
INSERT INTO `barangay` VALUES ('1401', 'Mayana', '110');
INSERT INTO `barangay` VALUES ('1402', 'Minolos', '110');
INSERT INTO `barangay` VALUES ('1403', 'Nabunturan', '110');
INSERT INTO `barangay` VALUES ('1404', 'Nasipit', '110');
INSERT INTO `barangay` VALUES ('1405', 'Pancil', '110');
INSERT INTO `barangay` VALUES ('1406', 'Pangpang', '110');
INSERT INTO `barangay` VALUES ('1407', 'Paril', '110');
INSERT INTO `barangay` VALUES ('1408', 'Patupat', '110');
INSERT INTO `barangay` VALUES ('1409', 'Poblacion', '110');
INSERT INTO `barangay` VALUES ('1410', 'San Rafael', '110');
INSERT INTO `barangay` VALUES ('1411', 'Santa Ana', '110');
INSERT INTO `barangay` VALUES ('1412', 'Sayaw', '110');
INSERT INTO `barangay` VALUES ('1413', 'Tal?ot', '110');
INSERT INTO `barangay` VALUES ('1414', 'Tubod', '110');
INSERT INTO `barangay` VALUES ('1415', 'Vito', '110');
INSERT INTO `barangay` VALUES ('1416', 'Andagao', '91');
INSERT INTO `barangay` VALUES ('1417', 'Bachaw Norte', '91');
INSERT INTO `barangay` VALUES ('1418', 'Bachaw Sur', '91');
INSERT INTO `barangay` VALUES ('1419', 'Briones', '91');
INSERT INTO `barangay` VALUES ('1420', 'Buswang, New', '91');
INSERT INTO `barangay` VALUES ('1421', 'Buswang, Old', '91');
INSERT INTO `barangay` VALUES ('1422', 'Caano', '91');
INSERT INTO `barangay` VALUES ('1423', 'Estancia', '91');
INSERT INTO `barangay` VALUES ('1424', 'Linabuan Norte', '91');
INSERT INTO `barangay` VALUES ('1425', 'Mabilo', '91');
INSERT INTO `barangay` VALUES ('1426', 'Mobo', '91');
INSERT INTO `barangay` VALUES ('1427', 'Nalook', '91');
INSERT INTO `barangay` VALUES ('1428', 'Poblacion', '91');
INSERT INTO `barangay` VALUES ('1429', 'Pook', '91');
INSERT INTO `barangay` VALUES ('1430', 'Tigayon', '91');
INSERT INTO `barangay` VALUES ('1431', 'Tinigao', '91');
INSERT INTO `barangay` VALUES ('1432', 'Arbor', '111');
INSERT INTO `barangay` VALUES ('1433', 'Baclayan', '111');
INSERT INTO `barangay` VALUES ('1434', 'El Pardo', '111');
INSERT INTO `barangay` VALUES ('1435', 'Granada', '111');
INSERT INTO `barangay` VALUES ('1436', 'Lower Becerril', '111');
INSERT INTO `barangay` VALUES ('1437', 'Lunop', '111');
INSERT INTO `barangay` VALUES ('1438', 'Nangka', '111');
INSERT INTO `barangay` VALUES ('1439', 'Poblacion', '111');
INSERT INTO `barangay` VALUES ('1440', 'San Antonio', '111');
INSERT INTO `barangay` VALUES ('1441', 'South Granada', '111');
INSERT INTO `barangay` VALUES ('1442', 'Upper Becerril', '111');
INSERT INTO `barangay` VALUES ('1443', 'Agcawilan ', '92');
INSERT INTO `barangay` VALUES ('1444', 'Bagto ', '92');
INSERT INTO `barangay` VALUES ('1445', 'Bugasongan ', '92');
INSERT INTO `barangay` VALUES ('1446', 'Carugdog ', '92');
INSERT INTO `barangay` VALUES ('1447', 'Cogon ', '92');
INSERT INTO `barangay` VALUES ('1448', 'Ibao ', '92');
INSERT INTO `barangay` VALUES ('1449', 'Mina ', '92');
INSERT INTO `barangay` VALUES ('1450', 'Poblacion ', '92');
INSERT INTO `barangay` VALUES ('1451', 'Sta. Cruz ', '92');
INSERT INTO `barangay` VALUES ('1452', 'Sta. Cruz Biga-a ', '92');
INSERT INTO `barangay` VALUES ('1453', 'Silakat-Nonok ', '92');
INSERT INTO `barangay` VALUES ('1454', 'Tayhawan', '92');
INSERT INTO `barangay` VALUES ('1455', 'Bagacay', '112');
INSERT INTO `barangay` VALUES ('1456', 'Bili', '112');
INSERT INTO `barangay` VALUES ('1457', 'Bingay', '112');
INSERT INTO `barangay` VALUES ('1458', 'Bongdo', '112');
INSERT INTO `barangay` VALUES ('1459', 'Bongdo Gua', '112');
INSERT INTO `barangay` VALUES ('1460', 'Bongoyan', '112');
INSERT INTO `barangay` VALUES ('1461', 'Cadaruhan', '112');
INSERT INTO `barangay` VALUES ('1462', 'Cajel', '112');
INSERT INTO `barangay` VALUES ('1463', 'Campusong', '112');
INSERT INTO `barangay` VALUES ('1464', 'Clavera', '112');
INSERT INTO `barangay` VALUES ('1465', 'Don Gregorio Antigua (Taytayan)', '112');
INSERT INTO `barangay` VALUES ('1466', 'Laaw', '112');
INSERT INTO `barangay` VALUES ('1467', 'Lugo', '112');
INSERT INTO `barangay` VALUES ('1468', 'Managase', '112');
INSERT INTO `barangay` VALUES ('1469', 'Poblacion', '112');
INSERT INTO `barangay` VALUES ('1470', 'Sagay', '112');
INSERT INTO `barangay` VALUES ('1471', 'San Jose', '112');
INSERT INTO `barangay` VALUES ('1472', 'Tabunan', '112');
INSERT INTO `barangay` VALUES ('1473', 'Tagnucan', '112');
INSERT INTO `barangay` VALUES ('1474', 'Agmailig ', '93');
INSERT INTO `barangay` VALUES ('1475', 'Alfonso XII ', '93');
INSERT INTO `barangay` VALUES ('1476', 'Batobato ', '93');
INSERT INTO `barangay` VALUES ('1477', 'Bonza ', '93');
INSERT INTO `barangay` VALUES ('1478', 'Calacabian ', '93');
INSERT INTO `barangay` VALUES ('1479', 'Calamcan ', '93');
INSERT INTO `barangay` VALUES ('1480', 'Can-Awan ', '93');
INSERT INTO `barangay` VALUES ('1481', 'Casit-an ', '93');
INSERT INTO `barangay` VALUES ('1482', 'Dalagsa-an ', '93');
INSERT INTO `barangay` VALUES ('1483', 'Guadalupe ', '93');
INSERT INTO `barangay` VALUES ('1484', 'Janlud ', '93');
INSERT INTO `barangay` VALUES ('1485', 'Julita ', '93');
INSERT INTO `barangay` VALUES ('1486', 'Luctoga ', '93');
INSERT INTO `barangay` VALUES ('1487', 'Magugba ', '93');
INSERT INTO `barangay` VALUES ('1488', 'Manika ', '93');
INSERT INTO `barangay` VALUES ('1489', 'Ogsip ', '93');
INSERT INTO `barangay` VALUES ('1490', 'Ortega ', '93');
INSERT INTO `barangay` VALUES ('1491', 'Oyang ', '93');
INSERT INTO `barangay` VALUES ('1492', 'Pampango ', '93');
INSERT INTO `barangay` VALUES ('1493', 'Pinonoy ', '93');
INSERT INTO `barangay` VALUES ('1494', 'Poblacion ', '93');
INSERT INTO `barangay` VALUES ('1495', 'Rivera ', '93');
INSERT INTO `barangay` VALUES ('1496', 'Rosal ', '93');
INSERT INTO `barangay` VALUES ('1497', 'Sibalew', '93');
INSERT INTO `barangay` VALUES ('1498', 'Baring', '113');
INSERT INTO `barangay` VALUES ('1499', 'Cantipay', '113');
INSERT INTO `barangay` VALUES ('1500', 'Cantumog', '113');
INSERT INTO `barangay` VALUES ('1501', 'Cantukong', '113');
INSERT INTO `barangay` VALUES ('1502', 'Caurasan', '113');
INSERT INTO `barangay` VALUES ('1503', 'Cogon East', '113');
INSERT INTO `barangay` VALUES ('1504', 'Cogon West', '113');
INSERT INTO `barangay` VALUES ('1505', 'Corte', '113');
INSERT INTO `barangay` VALUES ('1506', 'Dawis Norte', '113');
INSERT INTO `barangay` VALUES ('1507', 'Dawis Sur', '113');
INSERT INTO `barangay` VALUES ('1508', 'Hagnaya', '113');
INSERT INTO `barangay` VALUES ('1509', 'Ipil', '113');
INSERT INTO `barangay` VALUES ('1510', 'Lanipga', '113');
INSERT INTO `barangay` VALUES ('1511', 'Liboron', '113');
INSERT INTO `barangay` VALUES ('1512', 'Lower Natimao?an', '113');
INSERT INTO `barangay` VALUES ('1513', 'Luyang', '113');
INSERT INTO `barangay` VALUES ('1514', 'Poblacion', '113');
INSERT INTO `barangay` VALUES ('1515', 'Puente', '113');
INSERT INTO `barangay` VALUES ('1516', 'Sac?on', '113');
INSERT INTO `barangay` VALUES ('1517', 'Triumfo', '113');
INSERT INTO `barangay` VALUES ('1518', 'Upper Natimao?an', '113');
INSERT INTO `barangay` VALUES ('1519', 'Alaminos ', '94');
INSERT INTO `barangay` VALUES ('1520', 'Alas-as ', '94');
INSERT INTO `barangay` VALUES ('1521', 'Bacyang ', '94');
INSERT INTO `barangay` VALUES ('1522', 'Balactasan ', '94');
INSERT INTO `barangay` VALUES ('1523', 'Cabangahan ', '94');
INSERT INTO `barangay` VALUES ('1524', 'Cabilawan ', '94');
INSERT INTO `barangay` VALUES ('1525', 'Catabana ', '94');
INSERT INTO `barangay` VALUES ('1526', 'Dit-Ana ', '94');
INSERT INTO `barangay` VALUES ('1527', 'Galicia ', '94');
INSERT INTO `barangay` VALUES ('1528', 'Guinatu-an ', '94');
INSERT INTO `barangay` VALUES ('1529', 'Logohon ', '94');
INSERT INTO `barangay` VALUES ('1530', 'Mamba ', '94');
INSERT INTO `barangay` VALUES ('1531', 'Maria Cristina ', '94');
INSERT INTO `barangay` VALUES ('1532', 'Medina ', '94');
INSERT INTO `barangay` VALUES ('1533', 'Mercedes ', '94');
INSERT INTO `barangay` VALUES ('1534', 'Napnot ', '94');
INSERT INTO `barangay` VALUES ('1535', 'Pang-Itan ', '94');
INSERT INTO `barangay` VALUES ('1536', 'Paningayan ', '94');
INSERT INTO `barangay` VALUES ('1537', 'Panipiason ', '94');
INSERT INTO `barangay` VALUES ('1538', 'Poblacion ', '94');
INSERT INTO `barangay` VALUES ('1539', 'San Jose ', '94');
INSERT INTO `barangay` VALUES ('1540', 'Singay ', '94');
INSERT INTO `barangay` VALUES ('1541', 'Talangban ', '94');
INSERT INTO `barangay` VALUES ('1542', 'Talimagao ', '94');
INSERT INTO `barangay` VALUES ('1543', 'Tigbawan', '94');
INSERT INTO `barangay` VALUES ('1544', 'Agsuwao', '114');
INSERT INTO `barangay` VALUES ('1545', 'Amancion', '114');
INSERT INTO `barangay` VALUES ('1546', 'Anapog', '114');
INSERT INTO `barangay` VALUES ('1547', 'Bactas', '114');
INSERT INTO `barangay` VALUES ('1548', 'Basak', '114');
INSERT INTO `barangay` VALUES ('1549', 'Binongkalan', '114');
INSERT INTO `barangay` VALUES ('1550', 'Bongyas', '114');
INSERT INTO `barangay` VALUES ('1551', 'Cabungaan', '114');
INSERT INTO `barangay` VALUES ('1552', 'Cambangkaya', '114');
INSERT INTO `barangay` VALUES ('1553', 'Can?ibuang', '114');
INSERT INTO `barangay` VALUES ('1554', 'Catmondaan', '114');
INSERT INTO `barangay` VALUES ('1555', 'Corazon (pob.)', '114');
INSERT INTO `barangay` VALUES ('1556', 'Duyan', '114');
INSERT INTO `barangay` VALUES ('1557', 'Flores (pob.)', '114');
INSERT INTO `barangay` VALUES ('1558', 'Ginabucan', '114');
INSERT INTO `barangay` VALUES ('1559', 'Macaas', '114');
INSERT INTO `barangay` VALUES ('1560', 'Panalipan', '114');
INSERT INTO `barangay` VALUES ('1561', 'San Jose Pob. (Catadman)', '114');
INSERT INTO `barangay` VALUES ('1562', 'Tabili', '114');
INSERT INTO `barangay` VALUES ('1563', 'Tinabyonan', '114');
INSERT INTO `barangay` VALUES ('1564', 'Bagalnga', '116');
INSERT INTO `barangay` VALUES ('1565', 'Basak', '116');
INSERT INTO `barangay` VALUES ('1566', 'Buluang', '116');
INSERT INTO `barangay` VALUES ('1567', 'Cabadiangan', '116');
INSERT INTO `barangay` VALUES ('1568', 'Cambayog', '116');
INSERT INTO `barangay` VALUES ('1569', 'Canamucan', '116');
INSERT INTO `barangay` VALUES ('1570', 'Cogon', '116');
INSERT INTO `barangay` VALUES ('1571', 'Dapdap', '116');
INSERT INTO `barangay` VALUES ('1572', 'Estaca', '116');
INSERT INTO `barangay` VALUES ('1573', 'Lupa', '116');
INSERT INTO `barangay` VALUES ('1574', 'Magay', '116');
INSERT INTO `barangay` VALUES ('1575', 'Mulao', '116');
INSERT INTO `barangay` VALUES ('1576', 'Panangban', '116');
INSERT INTO `barangay` VALUES ('1577', 'Poblacion', '116');
INSERT INTO `barangay` VALUES ('1578', 'Tag?ube', '116');
INSERT INTO `barangay` VALUES ('1579', 'Tamiao', '116');
INSERT INTO `barangay` VALUES ('1580', 'Tubigan', '116');
INSERT INTO `barangay` VALUES ('1581', 'Agbalogo ', '95');
INSERT INTO `barangay` VALUES ('1582', 'Aglucay ', '95');
INSERT INTO `barangay` VALUES ('1583', 'Alibagon ', '95');
INSERT INTO `barangay` VALUES ('1584', 'Bagong Barrio ', '95');
INSERT INTO `barangay` VALUES ('1585', 'Baybay ', '95');
INSERT INTO `barangay` VALUES ('1586', 'Cabatanga ', '95');
INSERT INTO `barangay` VALUES ('1587', 'Cajilo ', '95');
INSERT INTO `barangay` VALUES ('1588', 'Calangcang ', '95');
INSERT INTO `barangay` VALUES ('1589', 'Calimbajan ', '95');
INSERT INTO `barangay` VALUES ('1590', 'Castillo ', '95');
INSERT INTO `barangay` VALUES ('1591', 'Cayangwan ', '95');
INSERT INTO `barangay` VALUES ('1592', 'Dumga ', '95');
INSERT INTO `barangay` VALUES ('1593', 'Libang ', '95');
INSERT INTO `barangay` VALUES ('1594', 'Mantiguib ', '95');
INSERT INTO `barangay` VALUES ('1595', 'Poblacion ', '95');
INSERT INTO `barangay` VALUES ('1596', 'Tibiawan', '95');
INSERT INTO `barangay` VALUES ('1597', 'Tina ', '95');
INSERT INTO `barangay` VALUES ('1598', 'Tugas', '95');
INSERT INTO `barangay` VALUES ('1599', 'Cabangahan', '117');
INSERT INTO `barangay` VALUES ('1600', 'Cansaga', '117');
INSERT INTO `barangay` VALUES ('1601', 'Casili', '117');
INSERT INTO `barangay` VALUES ('1602', 'Danglag', '117');
INSERT INTO `barangay` VALUES ('1603', 'Garing', '117');
INSERT INTO `barangay` VALUES ('1604', 'Jugan', '117');
INSERT INTO `barangay` VALUES ('1605', 'Lamac', '117');
INSERT INTO `barangay` VALUES ('1606', 'Lanipga', '117');
INSERT INTO `barangay` VALUES ('1607', 'Nangka', '117');
INSERT INTO `barangay` VALUES ('1608', 'Panas', '117');
INSERT INTO `barangay` VALUES ('1609', 'Panoypoy', '117');
INSERT INTO `barangay` VALUES ('1610', 'Poblacion Occidental', '117');
INSERT INTO `barangay` VALUES ('1611', 'Poblacion Oriental', '117');
INSERT INTO `barangay` VALUES ('1612', 'Polog', '117');
INSERT INTO `barangay` VALUES ('1613', 'Pulpogan', '117');
INSERT INTO `barangay` VALUES ('1614', 'Sacsac', '117');
INSERT INTO `barangay` VALUES ('1615', 'Tayud', '117');
INSERT INTO `barangay` VALUES ('1616', 'Tilhaong', '117');
INSERT INTO `barangay` VALUES ('1617', 'Tolotolo', '117');
INSERT INTO `barangay` VALUES ('1618', 'Tugbongan', '117');
INSERT INTO `barangay` VALUES ('1619', 'Argao', '96');
INSERT INTO `barangay` VALUES ('1620', 'Balusbos', '96');
INSERT INTO `barangay` VALUES ('1621', 'Cabulihan', '96');
INSERT INTO `barangay` VALUES ('1622', 'Caticlan', '96');
INSERT INTO `barangay` VALUES ('1623', 'Cogon', '96');
INSERT INTO `barangay` VALUES ('1624', 'Cubay Norte', '96');
INSERT INTO `barangay` VALUES ('1625', 'Cubay Sur', '96');
INSERT INTO `barangay` VALUES ('1626', 'Dumlog', '96');
INSERT INTO `barangay` VALUES ('1627', 'Motag', '96');
INSERT INTO `barangay` VALUES ('1628', 'Naasug', '96');
INSERT INTO `barangay` VALUES ('1629', 'Nabaoy', '96');
INSERT INTO `barangay` VALUES ('1630', 'Napaan', '96');
INSERT INTO `barangay` VALUES ('1631', 'Poblacion', '96');
INSERT INTO `barangay` VALUES ('1632', 'Sambiray', '96');
INSERT INTO `barangay` VALUES ('1633', 'Balabag', '96');
INSERT INTO `barangay` VALUES ('1634', 'Manoc-Manoc', '96');
INSERT INTO `barangay` VALUES ('1635', 'Yapak', '96');
INSERT INTO `barangay` VALUES ('1636', 'Alegria', '118');
INSERT INTO `barangay` VALUES ('1637', 'Bangbang', '118');
INSERT INTO `barangay` VALUES ('1638', 'Buagsong', '118');
INSERT INTO `barangay` VALUES ('1639', 'Catarman', '118');
INSERT INTO `barangay` VALUES ('1640', 'Cogon', '118');
INSERT INTO `barangay` VALUES ('1641', 'Dapitan', '118');
INSERT INTO `barangay` VALUES ('1642', 'Day?as', '118');
INSERT INTO `barangay` VALUES ('1643', 'Gabi', '118');
INSERT INTO `barangay` VALUES ('1644', 'Gilutongan', '118');
INSERT INTO `barangay` VALUES ('1645', 'Ibabao', '118');
INSERT INTO `barangay` VALUES ('1646', 'Pilipog', '118');
INSERT INTO `barangay` VALUES ('1647', 'Poblacion', '118');
INSERT INTO `barangay` VALUES ('1648', 'San Miguel', '118');
INSERT INTO `barangay` VALUES ('1649', 'Banaybanay ', '97');
INSERT INTO `barangay` VALUES ('1650', 'Biga-a ', '97');
INSERT INTO `barangay` VALUES ('1651', 'Bulabud ', '97');
INSERT INTO `barangay` VALUES ('1652', 'Cabayugan ', '97');
INSERT INTO `barangay` VALUES ('1653', 'Capataga ', '97');
INSERT INTO `barangay` VALUES ('1654', 'Cogon ', '97');
INSERT INTO `barangay` VALUES ('1655', 'Dangcalan ', '97');
INSERT INTO `barangay` VALUES ('1656', 'Kinalangay Nuevo ', '97');
INSERT INTO `barangay` VALUES ('1657', 'Kinalangay Viejo ', '97');
INSERT INTO `barangay` VALUES ('1658', 'Lilo-an ', '97');
INSERT INTO `barangay` VALUES ('1659', 'Malandayon ', '97');
INSERT INTO `barangay` VALUES ('1660', 'Manhanip ', '97');
INSERT INTO `barangay` VALUES ('1661', 'Navitas ', '97');
INSERT INTO `barangay` VALUES ('1662', 'Osman ', '97');
INSERT INTO `barangay` VALUES ('1663', 'Poblacion ', '97');
INSERT INTO `barangay` VALUES ('1664', 'Rosario ', '97');
INSERT INTO `barangay` VALUES ('1665', 'San Dimas ', '97');
INSERT INTO `barangay` VALUES ('1666', 'San Ramon ', '97');
INSERT INTO `barangay` VALUES ('1667', 'San Roque ', '97');
INSERT INTO `barangay` VALUES ('1668', 'Sipac ', '97');
INSERT INTO `barangay` VALUES ('1669', 'Sugnod ', '97');
INSERT INTO `barangay` VALUES ('1670', 'Tambuan ', '97');
INSERT INTO `barangay` VALUES ('1671', 'Tigpalas', '97');
INSERT INTO `barangay` VALUES ('1672', 'Agujo', '119');
INSERT INTO `barangay` VALUES ('1673', 'Bagay', '119');
INSERT INTO `barangay` VALUES ('1674', 'Bakhawan', '119');
INSERT INTO `barangay` VALUES ('1675', 'Bateria', '119');
INSERT INTO `barangay` VALUES ('1676', 'Bitoon', '119');
INSERT INTO `barangay` VALUES ('1677', 'Calape', '119');
INSERT INTO `barangay` VALUES ('1678', 'Carnaza', '119');
INSERT INTO `barangay` VALUES ('1679', 'Dalingding', '119');
INSERT INTO `barangay` VALUES ('1680', 'Lanao', '119');
INSERT INTO `barangay` VALUES ('1681', 'Logon', '119');
INSERT INTO `barangay` VALUES ('1682', 'Malbago', '119');
INSERT INTO `barangay` VALUES ('1683', 'Malingin', '119');
INSERT INTO `barangay` VALUES ('1684', 'Maya', '119');
INSERT INTO `barangay` VALUES ('1685', 'Pajo', '119');
INSERT INTO `barangay` VALUES ('1686', 'Paypay', '119');
INSERT INTO `barangay` VALUES ('1687', 'Poblacion', '119');
INSERT INTO `barangay` VALUES ('1688', 'Talisay', '119');
INSERT INTO `barangay` VALUES ('1689', 'Tapilon', '119');
INSERT INTO `barangay` VALUES ('1690', 'Tinubdan', '119');
INSERT INTO `barangay` VALUES ('1691', 'Tominjao', '119');
INSERT INTO `barangay` VALUES ('1692', 'Alimbo-Baybay ', '98');
INSERT INTO `barangay` VALUES ('1693', 'Buenasuerte ', '98');
INSERT INTO `barangay` VALUES ('1694', 'Buenafortuna ', '98');
INSERT INTO `barangay` VALUES ('1695', 'Buenavista ', '98');
INSERT INTO `barangay` VALUES ('1696', 'Gibon ', '98');
INSERT INTO `barangay` VALUES ('1697', 'Habana ', '98');
INSERT INTO `barangay` VALUES ('1698', 'Laserna ', '98');
INSERT INTO `barangay` VALUES ('1699', 'Libertad ', '98');
INSERT INTO `barangay` VALUES ('1700', 'Magallanes ', '98');
INSERT INTO `barangay` VALUES ('1701', 'Matabana ', '98');
INSERT INTO `barangay` VALUES ('1702', 'Nagustan ', '98');
INSERT INTO `barangay` VALUES ('1703', 'Pawa ', '98');
INSERT INTO `barangay` VALUES ('1704', 'Pinatuad ', '98');
INSERT INTO `barangay` VALUES ('1705', 'Poblacion ', '98');
INSERT INTO `barangay` VALUES ('1706', 'Rizal ', '98');
INSERT INTO `barangay` VALUES ('1707', 'Solido ', '98');
INSERT INTO `barangay` VALUES ('1708', 'Tagororoc ', '98');
INSERT INTO `barangay` VALUES ('1709', 'Toledo ', '98');
INSERT INTO `barangay` VALUES ('1710', 'Unidos ', '98');
INSERT INTO `barangay` VALUES ('1711', 'Union', '98');
INSERT INTO `barangay` VALUES ('1712', 'Candelaria ', '99');
INSERT INTO `barangay` VALUES ('1713', 'Cawayan ', '99');
INSERT INTO `barangay` VALUES ('1714', 'Dumaguit ', '99');
INSERT INTO `barangay` VALUES ('1715', 'Fatima ', '99');
INSERT INTO `barangay` VALUES ('1716', 'Guinbaliwan ', '99');
INSERT INTO `barangay` VALUES ('1717', 'Jalas ', '99');
INSERT INTO `barangay` VALUES ('1718', 'Jugas ', '99');
INSERT INTO `barangay` VALUES ('1719', 'Lawa-an ', '99');
INSERT INTO `barangay` VALUES ('1720', 'Mabilo ', '99');
INSERT INTO `barangay` VALUES ('1721', 'Mataphao', '99');
INSERT INTO `barangay` VALUES ('1722', 'Ochando ', '99');
INSERT INTO `barangay` VALUES ('1723', 'Pinamuk-an ', '99');
INSERT INTO `barangay` VALUES ('1724', 'Poblacion ', '99');
INSERT INTO `barangay` VALUES ('1725', 'Polo ', '99');
INSERT INTO `barangay` VALUES ('1726', 'Puis ', '99');
INSERT INTO `barangay` VALUES ('1727', 'Tambak', '99');
INSERT INTO `barangay` VALUES ('1728', 'Ablayan', '120');
INSERT INTO `barangay` VALUES ('1729', 'Babayongan', '120');
INSERT INTO `barangay` VALUES ('1730', 'Balud', '120');
INSERT INTO `barangay` VALUES ('1731', 'Banhigan', '120');
INSERT INTO `barangay` VALUES ('1732', 'Bulak', '120');
INSERT INTO `barangay` VALUES ('1733', 'Caleriohan', '120');
INSERT INTO `barangay` VALUES ('1734', 'Caliongan', '120');
INSERT INTO `barangay` VALUES ('1735', 'Casay', '120');
INSERT INTO `barangay` VALUES ('1736', 'Catolohan', '120');
INSERT INTO `barangay` VALUES ('1737', 'Cawayan', '120');
INSERT INTO `barangay` VALUES ('1738', 'Consolacion', '120');
INSERT INTO `barangay` VALUES ('1739', 'Coro', '120');
INSERT INTO `barangay` VALUES ('1740', 'Dugyan', '120');
INSERT INTO `barangay` VALUES ('1741', 'Dumalan', '120');
INSERT INTO `barangay` VALUES ('1742', 'Jolomaynon	', '120');
INSERT INTO `barangay` VALUES ('1743', 'Lanao', '120');
INSERT INTO `barangay` VALUES ('1744', 'Langkas', '120');
INSERT INTO `barangay` VALUES ('1745', 'Lumbang', '120');
INSERT INTO `barangay` VALUES ('1746', 'Malones', '120');
INSERT INTO `barangay` VALUES ('1747', 'Maloray', '120');
INSERT INTO `barangay` VALUES ('1748', 'Manangga', '120');
INSERT INTO `barangay` VALUES ('1749', 'Manlapay', '120');
INSERT INTO `barangay` VALUES ('1750', 'Mantalongon', '120');
INSERT INTO `barangay` VALUES ('1751', 'Nalhub', '120');
INSERT INTO `barangay` VALUES ('1752', 'Obo', '120');
INSERT INTO `barangay` VALUES ('1753', 'Obong', '120');
INSERT INTO `barangay` VALUES ('1754', 'Pañas', '120');
INSERT INTO `barangay` VALUES ('1755', 'Poblacion', '120');
INSERT INTO `barangay` VALUES ('1756', 'Sacsac', '120');
INSERT INTO `barangay` VALUES ('1757', 'Salug', '120');
INSERT INTO `barangay` VALUES ('1758', 'Tabon', '120');
INSERT INTO `barangay` VALUES ('1759', 'Tapun', '120');
INSERT INTO `barangay` VALUES ('1760', 'Tuba', '120');
INSERT INTO `barangay` VALUES ('1761', 'Albasan ', '100');
INSERT INTO `barangay` VALUES ('1762', 'Aliputos ', '100');
INSERT INTO `barangay` VALUES ('1763', 'Badio ', '100');
INSERT INTO `barangay` VALUES ('1764', 'Bubog ', '100');
INSERT INTO `barangay` VALUES ('1765', 'Bulwang ', '100');
INSERT INTO `barangay` VALUES ('1766', 'Camanci Norte ', '100');
INSERT INTO `barangay` VALUES ('1767', 'Camanci Sur ', '100');
INSERT INTO `barangay` VALUES ('1768', 'Dongon East ', '100');
INSERT INTO `barangay` VALUES ('1769', 'Dongon West ', '100');
INSERT INTO `barangay` VALUES ('1770', 'Joyao-Joyao ', '100');
INSERT INTO `barangay` VALUES ('1771', 'Laguinbanwa East ', '100');
INSERT INTO `barangay` VALUES ('1772', 'Laguinbanwa West ', '100');
INSERT INTO `barangay` VALUES ('1773', 'Marianos ', '100');
INSERT INTO `barangay` VALUES ('1774', 'Navitas ', '100');
INSERT INTO `barangay` VALUES ('1775', 'Poblacion ', '100');
INSERT INTO `barangay` VALUES ('1776', ' Pusiw ', '100');
INSERT INTO `barangay` VALUES ('1777', 'Tabangka', '100');
INSERT INTO `barangay` VALUES ('1778', 'Afga ', '101');
INSERT INTO `barangay` VALUES ('1779', 'Baybay ', '101');
INSERT INTO `barangay` VALUES ('1780', 'Dapdap ', '101');
INSERT INTO `barangay` VALUES ('1781', 'Dumatad ', '101');
INSERT INTO `barangay` VALUES ('1782', 'Jawili ', '101');
INSERT INTO `barangay` VALUES ('1783', 'Lanipga ', '101');
INSERT INTO `barangay` VALUES ('1784', 'Napatag ', '101');
INSERT INTO `barangay` VALUES ('1785', 'Panayakan ', '101');
INSERT INTO `barangay` VALUES ('1786', 'Poblacion ', '101');
INSERT INTO `barangay` VALUES ('1787', 'Pudiot ', '101');
INSERT INTO `barangay` VALUES ('1788', 'Tagas ', '101');
INSERT INTO `barangay` VALUES ('1789', 'Tamalagon ', '101');
INSERT INTO `barangay` VALUES ('1790', 'Tamokoe ', '101');
INSERT INTO `barangay` VALUES ('1791', 'Tondog ', '101');
INSERT INTO `barangay` VALUES ('1792', 'Vivo', '101');
INSERT INTO `barangay` VALUES ('1793', 'Balaygtiki', '121');
INSERT INTO `barangay` VALUES ('1794', 'Bitoon', '121');
INSERT INTO `barangay` VALUES ('1795', 'Bulak', '121');
INSERT INTO `barangay` VALUES ('1796', 'Bullogan', '121');
INSERT INTO `barangay` VALUES ('1797', 'Calaboon', '121');
INSERT INTO `barangay` VALUES ('1798', 'Camboang', '121');
INSERT INTO `barangay` VALUES ('1799', 'Candabong', '121');
INSERT INTO `barangay` VALUES ('1800', 'Cogon', '121');
INSERT INTO `barangay` VALUES ('1801', 'Cotcoton', '121');
INSERT INTO `barangay` VALUES ('1802', 'Doldol', '121');
INSERT INTO `barangay` VALUES ('1803', 'Ilaya (pob.)', '121');
INSERT INTO `barangay` VALUES ('1804', 'Kabalaasnan', '121');
INSERT INTO `barangay` VALUES ('1805', 'Kabatbatan', '121');
INSERT INTO `barangay` VALUES ('1806', 'Kambanog', '121');
INSERT INTO `barangay` VALUES ('1807', 'Kang?actol', '121');
INSERT INTO `barangay` VALUES ('1808', 'Kanghalo', '121');
INSERT INTO `barangay` VALUES ('1809', 'Kanghumaod', '121');
INSERT INTO `barangay` VALUES ('1810', 'Kanguha', '121');
INSERT INTO `barangay` VALUES ('1811', 'Kanyuko', '121');
INSERT INTO `barangay` VALUES ('1812', 'Kolabtingon', '121');
INSERT INTO `barangay` VALUES ('1813', 'Lamak', '121');
INSERT INTO `barangay` VALUES ('1814', 'Lawaan', '121');
INSERT INTO `barangay` VALUES ('1815', 'Liong', '121');
INSERT INTO `barangay` VALUES ('1816', 'Manlapay', '121');
INSERT INTO `barangay` VALUES ('1817', 'Masa', '121');
INSERT INTO `barangay` VALUES ('1818', 'Matalao', '121');
INSERT INTO `barangay` VALUES ('1819', 'Paculob', '121');
INSERT INTO `barangay` VALUES ('1820', 'Panlaan', '121');
INSERT INTO `barangay` VALUES ('1821', 'Pawa', '121');
INSERT INTO `barangay` VALUES ('1822', 'Poblacion Central', '121');
INSERT INTO `barangay` VALUES ('1823', 'Poblacion Looc', '121');
INSERT INTO `barangay` VALUES ('1824', 'Poblacion Sima', '121');
INSERT INTO `barangay` VALUES ('1825', 'Tapon', '121');
INSERT INTO `barangay` VALUES ('1826', 'Tubod-Bitoon', '121');
INSERT INTO `barangay` VALUES ('1827', 'Tubod-Dugoan', '121');
INSERT INTO `barangay` VALUES ('1828', 'Anao', '122');
INSERT INTO `barangay` VALUES ('1829', 'Cagsing', '122');
INSERT INTO `barangay` VALUES ('1830', 'Calabawan', '122');
INSERT INTO `barangay` VALUES ('1831', 'Cambagte', '122');
INSERT INTO `barangay` VALUES ('1832', 'Campisong', '122');
INSERT INTO `barangay` VALUES ('1833', 'Canorong', '122');
INSERT INTO `barangay` VALUES ('1834', 'Guiwanon', '122');
INSERT INTO `barangay` VALUES ('1835', 'Looc', '122');
INSERT INTO `barangay` VALUES ('1836', 'Malatbo', '122');
INSERT INTO `barangay` VALUES ('1837', 'Mangaco	', '122');
INSERT INTO `barangay` VALUES ('1838', 'Palanas', '122');
INSERT INTO `barangay` VALUES ('1839', 'Poblacion', '122');
INSERT INTO `barangay` VALUES ('1840', 'Salamanca', '122');
INSERT INTO `barangay` VALUES ('1841', 'San Roque', '122');
INSERT INTO `barangay` VALUES ('1842', 'Cabadiangan', '123');
INSERT INTO `barangay` VALUES ('1843', 'Calero', '123');
INSERT INTO `barangay` VALUES ('1844', 'Catarman', '123');
INSERT INTO `barangay` VALUES ('1845', 'Cotcot', '123');
INSERT INTO `barangay` VALUES ('1846', 'Jubay', '123');
INSERT INTO `barangay` VALUES ('1847', 'Lataban', '123');
INSERT INTO `barangay` VALUES ('1848', 'Mulao', '123');
INSERT INTO `barangay` VALUES ('1849', 'Poblacion', '123');
INSERT INTO `barangay` VALUES ('1850', 'San Roque', '123');
INSERT INTO `barangay` VALUES ('1851', 'San Vicente', '123');
INSERT INTO `barangay` VALUES ('1852', 'Santa Cruz', '123');
INSERT INTO `barangay` VALUES ('1853', 'Tabla', '123');
INSERT INTO `barangay` VALUES ('1854', 'Tayud', '123');
INSERT INTO `barangay` VALUES ('1855', 'Yati', '123');
INSERT INTO `barangay` VALUES ('1856', 'Agdahon ', '42');
INSERT INTO `barangay` VALUES ('1857', 'Agdayao ', '42');
INSERT INTO `barangay` VALUES ('1858', 'Aglalana ', '42');
INSERT INTO `barangay` VALUES ('1859', 'Agtabo ', '42');
INSERT INTO `barangay` VALUES ('1860', 'Agtambo ', '42');
INSERT INTO `barangay` VALUES ('1861', 'Alimono ', '42');
INSERT INTO `barangay` VALUES ('1862', 'Arac ', '42');
INSERT INTO `barangay` VALUES ('1863', 'Ayuyan', '42');
INSERT INTO `barangay` VALUES ('1864', 'Bacuranan ', '42');
INSERT INTO `barangay` VALUES ('1865', 'Bagacay ', '42');
INSERT INTO `barangay` VALUES ('1866', 'Batu ', '42');
INSERT INTO `barangay` VALUES ('1867', 'Bayan', '42');
INSERT INTO `barangay` VALUES ('1868', 'Bitaogan ', '42');
INSERT INTO `barangay` VALUES ('1869', 'Buenavista ', '42');
INSERT INTO `barangay` VALUES ('1870', 'Buyo ', '42');
INSERT INTO `barangay` VALUES ('1871', 'Cabunga ', '42');
INSERT INTO `barangay` VALUES ('1872', 'Cadilang', '42');
INSERT INTO `barangay` VALUES ('1873', 'Cairojan ', '42');
INSERT INTO `barangay` VALUES ('1874', 'Dalicanan ', '42');
INSERT INTO `barangay` VALUES ('1875', 'Gemat-y ', '42');
INSERT INTO `barangay` VALUES ('1876', 'Gemumua-Agahon ', '42');
INSERT INTO `barangay` VALUES ('1877', 'Gegacjac ', '42');
INSERT INTO `barangay` VALUES ('1878', 'Gines Viejo', '42');
INSERT INTO `barangay` VALUES ('1879', 'Imbang Grande ', '42');
INSERT INTO `barangay` VALUES ('1880', 'Jaguimitan -', '42');
INSERT INTO `barangay` VALUES ('1881', 'Libo-o ', '42');
INSERT INTO `barangay` VALUES ('1882', 'Maasin ', '42');
INSERT INTO `barangay` VALUES ('1883', 'Magdungao ', '42');
INSERT INTO `barangay` VALUES ('1884', 'Malag-it Grande ', '42');
INSERT INTO `barangay` VALUES ('1885', 'Malag-it Pequeño ', '42');
INSERT INTO `barangay` VALUES ('1886', 'Mambiranan Grande ', '42');
INSERT INTO `barangay` VALUES ('1887', 'Mambiranan Pequeño ', '42');
INSERT INTO `barangay` VALUES ('1888', 'Man-it ', '42');
INSERT INTO `barangay` VALUES ('1889', ' Mantulang ', '42');
INSERT INTO `barangay` VALUES ('1890', 'Mulapula ', '42');
INSERT INTO `barangay` VALUES ('1891', 'Nueva Union', '42');
INSERT INTO `barangay` VALUES ('1892', 'Pangi ', '42');
INSERT INTO `barangay` VALUES ('1893', 'Pagaypay ', '42');
INSERT INTO `barangay` VALUES ('1894', 'Poblacion Ilawod', '42');
INSERT INTO `barangay` VALUES ('1895', 'Poblacion Ilaya ', '42');
INSERT INTO `barangay` VALUES ('1896', 'Punong ', '42');
INSERT INTO `barangay` VALUES ('1897', 'Quinagaringan Grande ', '42');
INSERT INTO `barangay` VALUES ('1898', 'Quinagaringan Pequeño ', '42');
INSERT INTO `barangay` VALUES ('1899', 'Sablogon ', '42');
INSERT INTO `barangay` VALUES ('1900', 'Salngan ', '42');
INSERT INTO `barangay` VALUES ('1901', 'Santo Tomas ', '42');
INSERT INTO `barangay` VALUES ('1902', 'Sarapan ', '42');
INSERT INTO `barangay` VALUES ('1903', 'Tagubong ', '42');
INSERT INTO `barangay` VALUES ('1904', 'Talongonan ', '42');
INSERT INTO `barangay` VALUES ('1905', 'Tubod ', '42');
INSERT INTO `barangay` VALUES ('1906', 'Tuburan', '42');
INSERT INTO `barangay` VALUES ('1907', 'Bunakan', '124');
INSERT INTO `barangay` VALUES ('1908', 'Kangwayan	', '124');
INSERT INTO `barangay` VALUES ('1909', 'Kaongkod', '124');
INSERT INTO `barangay` VALUES ('1910', 'Kodia', '124');
INSERT INTO `barangay` VALUES ('1911', 'Maalat', '124');
INSERT INTO `barangay` VALUES ('1912', 'Malbago', '124');
INSERT INTO `barangay` VALUES ('1913', 'Mancilang', '124');
INSERT INTO `barangay` VALUES ('1914', 'Pili', '124');
INSERT INTO `barangay` VALUES ('1915', 'Poblacion', '124');
INSERT INTO `barangay` VALUES ('1916', 'San Agustin', '124');
INSERT INTO `barangay` VALUES ('1917', 'Tabagak', '124');
INSERT INTO `barangay` VALUES ('1918', 'Talangnan', '124');
INSERT INTO `barangay` VALUES ('1919', 'Tarong', '124');
INSERT INTO `barangay` VALUES ('1920', 'Tugas', '124');
INSERT INTO `barangay` VALUES ('1921', 'Armeña (Cansilongan)', '125');
INSERT INTO `barangay` VALUES ('1922', 'Barangay I (pob.)', '125');
INSERT INTO `barangay` VALUES ('1923', 'Barangay II (pob.)', '125');
INSERT INTO `barangay` VALUES ('1924', 'Cerdeña (Ansan)', '125');
INSERT INTO `barangay` VALUES ('1925', 'Labrador (Bulod)', '125');
INSERT INTO `barangay` VALUES ('1926', 'Looc', '125');
INSERT INTO `barangay` VALUES ('1927', 'Lombo', '125');
INSERT INTO `barangay` VALUES ('1928', 'Mahanlud', '125');
INSERT INTO `barangay` VALUES ('1929', 'Mindanao (Pajo)', '125');
INSERT INTO `barangay` VALUES ('1930', 'Montañeza (Inamlang)', '125');
INSERT INTO `barangay` VALUES ('1931', 'Salmeron (Bulok)', '125');
INSERT INTO `barangay` VALUES ('1932', 'Santo Niño (Saliring)', '125');
INSERT INTO `barangay` VALUES ('1933', 'Sorsogon (Balikmaya)	', '125');
INSERT INTO `barangay` VALUES ('1934', 'Tolosa (Calatagan)', '125');
INSERT INTO `barangay` VALUES ('1935', 'Antipolo', '126');
INSERT INTO `barangay` VALUES ('1936', 'Canhabagat', '126');
INSERT INTO `barangay` VALUES ('1937', 'Caputatan Norte', '126');
INSERT INTO `barangay` VALUES ('1938', 'Caputatan Sur', '126');
INSERT INTO `barangay` VALUES ('1939', 'Curva', '126');
INSERT INTO `barangay` VALUES ('1940', 'Daanlungsod', '126');
INSERT INTO `barangay` VALUES ('1941', 'Dalingding Sur', '126');
INSERT INTO `barangay` VALUES ('1942', 'Dayhagon', '126');
INSERT INTO `barangay` VALUES ('1943', 'Don Virgilio Gonzales', '126');
INSERT INTO `barangay` VALUES ('1944', 'Gibitngil', '126');
INSERT INTO `barangay` VALUES ('1945', 'Kawit', '126');
INSERT INTO `barangay` VALUES ('1946', 'Lamintak Norte', '126');
INSERT INTO `barangay` VALUES ('1947', 'Lamintak Sur', '126');
INSERT INTO `barangay` VALUES ('1948', 'Luy?a', '126');
INSERT INTO `barangay` VALUES ('1949', 'Maharuhay', '126');
INSERT INTO `barangay` VALUES ('1950', 'Mahawak', '126');
INSERT INTO `barangay` VALUES ('1951', 'Panugnawan', '126');
INSERT INTO `barangay` VALUES ('1952', 'Poblacion', '126');
INSERT INTO `barangay` VALUES ('1953', 'Tindog', '126');
INSERT INTO `barangay` VALUES ('1954', 'Adcadarao ', '43');
INSERT INTO `barangay` VALUES ('1955', 'Agbobolo ', '43');
INSERT INTO `barangay` VALUES ('1956', 'Badiangan ', '43');
INSERT INTO `barangay` VALUES ('1957', 'Barrido ', '43');
INSERT INTO `barangay` VALUES ('1958', 'Bato Biasong ', '43');
INSERT INTO `barangay` VALUES ('1959', 'Bay-ang ', '43');
INSERT INTO `barangay` VALUES ('1960', 'Bucana Bunglas', '43');
INSERT INTO `barangay` VALUES ('1961', 'Central ', '43');
INSERT INTO `barangay` VALUES ('1962', 'Culasi ', '43');
INSERT INTO `barangay` VALUES ('1963', 'Lanjagan ', '43');
INSERT INTO `barangay` VALUES ('1964', 'Luca ajuy ', '43');
INSERT INTO `barangay` VALUES ('1965', 'Malayu-an ', '43');
INSERT INTO `barangay` VALUES ('1966', 'Mangorocoro ', '43');
INSERT INTO `barangay` VALUES ('1967', 'Nasidman ', '43');
INSERT INTO `barangay` VALUES ('1968', 'Pantalan Nabaye ', '43');
INSERT INTO `barangay` VALUES ('1969', 'Pantalan Navarro ', '43');
INSERT INTO `barangay` VALUES ('1970', 'Pedada ', '43');
INSERT INTO `barangay` VALUES ('1971', 'Pili ', '43');
INSERT INTO `barangay` VALUES ('1972', 'Pinantan Diel ', '43');
INSERT INTO `barangay` VALUES ('1973', 'Pinantan Elizalde', '43');
INSERT INTO `barangay` VALUES ('1974', ' Pinay Espinosa ', '43');
INSERT INTO `barangay` VALUES ('1975', 'Poblacion ', '43');
INSERT INTO `barangay` VALUES ('1976', 'Progreso ', '43');
INSERT INTO `barangay` VALUES ('1977', 'Puente Bunglas ', '43');
INSERT INTO `barangay` VALUES ('1978', 'Punta Buri ', '43');
INSERT INTO `barangay` VALUES ('1979', 'Rojas ', '43');
INSERT INTO `barangay` VALUES ('1980', 'San Antonio ', '43');
INSERT INTO `barangay` VALUES ('1981', 'Silagon ', '43');
INSERT INTO `barangay` VALUES ('1982', 'Santo Rosario ', '43');
INSERT INTO `barangay` VALUES ('1983', 'Tagubanhan ', '43');
INSERT INTO `barangay` VALUES ('1984', 'Taguhangin ', '43');
INSERT INTO `barangay` VALUES ('1985', 'Tanduyan ', '43');
INSERT INTO `barangay` VALUES ('1986', 'Tipacla ', '43');
INSERT INTO `barangay` VALUES ('1987', 'Tubogan', '43');
INSERT INTO `barangay` VALUES ('1988', 'Cadulawan', '127');
INSERT INTO `barangay` VALUES ('1989', 'Calajo?an', '127');
INSERT INTO `barangay` VALUES ('1990', 'Camp 7', '127');
INSERT INTO `barangay` VALUES ('1991', 'Camp 8', '127');
INSERT INTO `barangay` VALUES ('1992', 'Cuanos', '127');
INSERT INTO `barangay` VALUES ('1993', 'Guindaruhan', '127');
INSERT INTO `barangay` VALUES ('1994', 'Linao', '127');
INSERT INTO `barangay` VALUES ('1995', 'Manduang', '127');
INSERT INTO `barangay` VALUES ('1996', 'Pakigne', '127');
INSERT INTO `barangay` VALUES ('1997', '	Poblacion Ward I', '127');
INSERT INTO `barangay` VALUES ('1998', 'Poblacion Ward II', '127');
INSERT INTO `barangay` VALUES ('1999', 'Poblacion Ward III', '127');
INSERT INTO `barangay` VALUES ('2000', 'Poblacion Ward IV', '127');
INSERT INTO `barangay` VALUES ('2001', 'Tubod', '127');
INSERT INTO `barangay` VALUES ('2002', 'Tulay', '127');
INSERT INTO `barangay` VALUES ('2003', 'Tunghaan', '127');
INSERT INTO `barangay` VALUES ('2004', 'Tungkop', '127');
INSERT INTO `barangay` VALUES ('2005', 'Vito', '127');
INSERT INTO `barangay` VALUES ('2006', 'Tungkil', '127');
INSERT INTO `barangay` VALUES ('2007', 'Agbalanga', '128');
INSERT INTO `barangay` VALUES ('2008', 'Bala', '128');
INSERT INTO `barangay` VALUES ('2009', 'Balabagon', '128');
INSERT INTO `barangay` VALUES ('2010', 'Basdiot', '128');
INSERT INTO `barangay` VALUES ('2011', 'Batadbatad', '128');
INSERT INTO `barangay` VALUES ('2012', 'Bugho', '128');
INSERT INTO `barangay` VALUES ('2013', 'Bugho', '128');
INSERT INTO `barangay` VALUES ('2014', 'Busay', '128');
INSERT INTO `barangay` VALUES ('2015', 'Lanao', '128');
INSERT INTO `barangay` VALUES ('2016', 'Poblacion East', '128');
INSERT INTO `barangay` VALUES ('2017', 'Poblacion West', '128');
INSERT INTO `barangay` VALUES ('2018', 'Saavedra', '128');
INSERT INTO `barangay` VALUES ('2019', 'Tomonoy', '128');
INSERT INTO `barangay` VALUES ('2020', 'Tuble', '128');
INSERT INTO `barangay` VALUES ('2021', 'Tunga', '128');
INSERT INTO `barangay` VALUES ('2022', 'Abang-abang ', '44');
INSERT INTO `barangay` VALUES ('2023', 'Agsing ', '44');
INSERT INTO `barangay` VALUES ('2024', 'Atabay ', '44');
INSERT INTO `barangay` VALUES ('2025', 'Ba-ong ', '44');
INSERT INTO `barangay` VALUES ('2026', 'Baguingin-Lanot ', '44');
INSERT INTO `barangay` VALUES ('2027', 'Bagsakan ', '44');
INSERT INTO `barangay` VALUES ('2028', 'Bagumbayan-Ilajas ', '44');
INSERT INTO `barangay` VALUES ('2029', 'Balabago ', '44');
INSERT INTO `barangay` VALUES ('2030', 'Ban-ag ', '44');
INSERT INTO `barangay` VALUES ('2031', 'Bancal ', '44');
INSERT INTO `barangay` VALUES ('2032', 'Binalud ', '44');
INSERT INTO `barangay` VALUES ('2033', 'Bugang ', '44');
INSERT INTO `barangay` VALUES ('2034', 'Buhay ', '44');
INSERT INTO `barangay` VALUES ('2035', 'Bulod ', '44');
INSERT INTO `barangay` VALUES ('2036', 'Cabacanan Proper ', '44');
INSERT INTO `barangay` VALUES ('2037', 'Cabacanan Rizal ', '44');
INSERT INTO `barangay` VALUES ('2038', 'Cagay ', '44');
INSERT INTO `barangay` VALUES ('2039', 'Coline ', '44');
INSERT INTO `barangay` VALUES ('2040', 'Coline-Dalag ', '44');
INSERT INTO `barangay` VALUES ('2041', 'Cunsad ', '44');
INSERT INTO `barangay` VALUES ('2042', 'Cuyad ', '44');
INSERT INTO `barangay` VALUES ('2043', 'Dalid ', '44');
INSERT INTO `barangay` VALUES ('2044', 'Dao ', '44');
INSERT INTO `barangay` VALUES ('2045', 'Gines ', '44');
INSERT INTO `barangay` VALUES ('2046', 'Ginomoy ', '44');
INSERT INTO `barangay` VALUES ('2047', 'Ingwan ', '44');
INSERT INTO `barangay` VALUES ('2048', 'Laylayan ', '44');
INSERT INTO `barangay` VALUES ('2049', 'Lico ', '44');
INSERT INTO `barangay` VALUES ('2050', 'Luan-luan ', '44');
INSERT INTO `barangay` VALUES ('2051', 'Malamhay ', '44');
INSERT INTO `barangay` VALUES ('2052', 'Malamboy-Bondolan ', '44');
INSERT INTO `barangay` VALUES ('2053', 'Mambawi ', '44');
INSERT INTO `barangay` VALUES ('2054', 'Manasa ', '44');
INSERT INTO `barangay` VALUES ('2055', 'Manduyog ', '44');
INSERT INTO `barangay` VALUES ('2056', 'Pajo ', '44');
INSERT INTO `barangay` VALUES ('2057', 'Pianda-an Norte', '44');
INSERT INTO `barangay` VALUES ('2058', 'Pianda-an Sur ', '44');
INSERT INTO `barangay` VALUES ('2059', 'Poblacion ', '44');
INSERT INTO `barangay` VALUES ('2060', 'Punong ', '44');
INSERT INTO `barangay` VALUES ('2061', 'Quinaspan ', '44');
INSERT INTO `barangay` VALUES ('2062', 'Sinamay ', '44');
INSERT INTO `barangay` VALUES ('2063', 'Sulong ', '44');
INSERT INTO `barangay` VALUES ('2064', 'Taban-Manguining ', '44');
INSERT INTO `barangay` VALUES ('2065', 'Tabug ', '44');
INSERT INTO `barangay` VALUES ('2066', 'Tarug ', '44');
INSERT INTO `barangay` VALUES ('2067', 'Tugaslon ', '44');
INSERT INTO `barangay` VALUES ('2068', 'Ubodan ', '44');
INSERT INTO `barangay` VALUES ('2069', 'Ugbo ', '44');
INSERT INTO `barangay` VALUES ('2070', 'Ulay-Bugang ', '44');
INSERT INTO `barangay` VALUES ('2071', 'Ulay-Hinablan ', '44');
INSERT INTO `barangay` VALUES ('2072', 'Umingan', '44');
INSERT INTO `barangay` VALUES ('2073', 'Alo', '129');
INSERT INTO `barangay` VALUES ('2074', 'Bangcogon', '129');
INSERT INTO `barangay` VALUES ('2075', 'Bonbon', '129');
INSERT INTO `barangay` VALUES ('2076', 'Calumpang', '129');
INSERT INTO `barangay` VALUES ('2077', 'Canangca?an	', '129');
INSERT INTO `barangay` VALUES ('2078', 'Cañang', '129');
INSERT INTO `barangay` VALUES ('2079', 'Can?ukban', '129');
INSERT INTO `barangay` VALUES ('2080', 'Cansalo?ay', '129');
INSERT INTO `barangay` VALUES ('2081', 'Cansalo?ay', '129');
INSERT INTO `barangay` VALUES ('2082', 'Daanlungsod', '129');
INSERT INTO `barangay` VALUES ('2083', 'Gawi', '129');
INSERT INTO `barangay` VALUES ('2084', 'Hagdan', '129');
INSERT INTO `barangay` VALUES ('2085', 'Lagunde', '129');
INSERT INTO `barangay` VALUES ('2086', 'Looc', '129');
INSERT INTO `barangay` VALUES ('2087', 'Luka', '129');
INSERT INTO `barangay` VALUES ('2088', 'Mainit', '129');
INSERT INTO `barangay` VALUES ('2089', 'Manlum', '129');
INSERT INTO `barangay` VALUES ('2090', 'Nueva Caceres', '129');
INSERT INTO `barangay` VALUES ('2091', 'Poblacion', '129');
INSERT INTO `barangay` VALUES ('2092', 'Pungtod', '129');
INSERT INTO `barangay` VALUES ('2093', 'Tan?awan', '129');
INSERT INTO `barangay` VALUES ('2094', '	Tumalog', '129');
INSERT INTO `barangay` VALUES ('2095', 'Agbatuan ', '45');
INSERT INTO `barangay` VALUES ('2096', 'Badiang ', '45');
INSERT INTO `barangay` VALUES ('2097', 'Balabag ', '45');
INSERT INTO `barangay` VALUES ('2098', 'Balunos ', '45');
INSERT INTO `barangay` VALUES ('2099', 'Cag-an ', '45');
INSERT INTO `barangay` VALUES ('2100', 'Camiros ', '45');
INSERT INTO `barangay` VALUES ('2101', 'Sambag Culob ', '45');
INSERT INTO `barangay` VALUES ('2102', 'Dangula-an ', '45');
INSERT INTO `barangay` VALUES ('2103', 'Guipis ', '45');
INSERT INTO `barangay` VALUES ('2104', 'Manganese ', '45');
INSERT INTO `barangay` VALUES ('2105', 'Medina ', '45');
INSERT INTO `barangay` VALUES ('2106', 'Mostro ', '45');
INSERT INTO `barangay` VALUES ('2107', 'Palaypay ', '45');
INSERT INTO `barangay` VALUES ('2108', 'Pantalan ', '45');
INSERT INTO `barangay` VALUES ('2109', 'Poblacion ', '45');
INSERT INTO `barangay` VALUES ('2110', 'San Carlos ', '45');
INSERT INTO `barangay` VALUES ('2111', 'San Juan Crisostomo ', '45');
INSERT INTO `barangay` VALUES ('2112', 'Santa Rita ', '45');
INSERT INTO `barangay` VALUES ('2113', 'Santo Rosario ', '45');
INSERT INTO `barangay` VALUES ('2114', 'Serallo ', '45');
INSERT INTO `barangay` VALUES ('2115', 'Vista Alegre', '45');
INSERT INTO `barangay` VALUES ('2116', 'Biasong', '130');
INSERT INTO `barangay` VALUES ('2117', 'Cawit', '130');
INSERT INTO `barangay` VALUES ('2118', 'Dapdap', '130');
INSERT INTO `barangay` VALUES ('2119', 'Esperanza', '130');
INSERT INTO `barangay` VALUES ('2120', 'Imelda', '130');
INSERT INTO `barangay` VALUES ('2121', 'Lanao', '130');
INSERT INTO `barangay` VALUES ('2122', 'Lower Poblacion', '130');
INSERT INTO `barangay` VALUES ('2123', 'Moabog', '130');
INSERT INTO `barangay` VALUES ('2124', 'Montserrat', '130');
INSERT INTO `barangay` VALUES ('2125', 'San Isidro', '130');
INSERT INTO `barangay` VALUES ('2126', 'San Juan', '130');
INSERT INTO `barangay` VALUES ('2127', 'Upper Poblacion	', '130');
INSERT INTO `barangay` VALUES ('2128', 'Villahermosa', '130');
INSERT INTO `barangay` VALUES ('2129', 'Agusipan ', '46');
INSERT INTO `barangay` VALUES ('2130', 'Astorga ', '46');
INSERT INTO `barangay` VALUES ('2131', 'Bingauan ', '46');
INSERT INTO `barangay` VALUES ('2132', 'Bita-oyan ', '46');
INSERT INTO `barangay` VALUES ('2133', 'Botong ', '46');
INSERT INTO `barangay` VALUES ('2134', 'Budiawe ', '46');
INSERT INTO `barangay` VALUES ('2135', 'Cabanga-an ', '46');
INSERT INTO `barangay` VALUES ('2136', 'Cabayogan ', '46');
INSERT INTO `barangay` VALUES ('2137', 'Calansanan ', '46');
INSERT INTO `barangay` VALUES ('2138', 'Catubig ', '46');
INSERT INTO `barangay` VALUES ('2139', 'Guinawahan ', '46');
INSERT INTO `barangay` VALUES ('2140', 'Ilongbukid ', '46');
INSERT INTO `barangay` VALUES ('2141', 'Indorohan ', '46');
INSERT INTO `barangay` VALUES ('2142', 'Iniligan ', '46');
INSERT INTO `barangay` VALUES ('2143', 'Latawan ', '46');
INSERT INTO `barangay` VALUES ('2144', 'Linayuan ', '46');
INSERT INTO `barangay` VALUES ('2145', 'Mainguit ', '46');
INSERT INTO `barangay` VALUES ('2146', 'Malublub ', '46');
INSERT INTO `barangay` VALUES ('2147', 'Manaolan ', '46');
INSERT INTO `barangay` VALUES ('2148', 'Mapili Grande ', '46');
INSERT INTO `barangay` VALUES ('2149', 'Mapili Sanjo ', '46');
INSERT INTO `barangay` VALUES ('2150', 'Odiongan ', '46');
INSERT INTO `barangay` VALUES ('2151', 'Poblacion ', '46');
INSERT INTO `barangay` VALUES ('2152', 'San Julian ', '46');
INSERT INTO `barangay` VALUES ('2153', 'Sariri ', '46');
INSERT INTO `barangay` VALUES ('2154', 'Sianon ', '46');
INSERT INTO `barangay` VALUES ('2155', 'Sinuagan ', '46');
INSERT INTO `barangay` VALUES ('2156', 'Talaba ', '46');
INSERT INTO `barangay` VALUES ('2157', 'Tamocol ', '46');
INSERT INTO `barangay` VALUES ('2158', 'Teneclan ', '46');
INSERT INTO `barangay` VALUES ('2159', 'Tina', '46');
INSERT INTO `barangay` VALUES ('2160', 'Anislag', '131');
INSERT INTO `barangay` VALUES ('2161', 'Anopog', '131');
INSERT INTO `barangay` VALUES ('2162', 'Binabag', '131');
INSERT INTO `barangay` VALUES ('2163', 'Buhingtubig', '131');
INSERT INTO `barangay` VALUES ('2164', 'Busay', '131');
INSERT INTO `barangay` VALUES ('2165', 'Butong', '131');
INSERT INTO `barangay` VALUES ('2166', 'Cabiangon	', '131');
INSERT INTO `barangay` VALUES ('2167', 'Camugao', '131');
INSERT INTO `barangay` VALUES ('2168', 'Duangan', '131');
INSERT INTO `barangay` VALUES ('2169', 'Guimbawian', '131');
INSERT INTO `barangay` VALUES ('2170', 'Lamac', '131');
INSERT INTO `barangay` VALUES ('2171', 'Lut?od', '131');
INSERT INTO `barangay` VALUES ('2172', 'Mangoto', '131');
INSERT INTO `barangay` VALUES ('2173', 'Opao', '131');
INSERT INTO `barangay` VALUES ('2174', 'Pandacan', '131');
INSERT INTO `barangay` VALUES ('2175', 'Poblacion', '131');
INSERT INTO `barangay` VALUES ('2176', 'Punod', '131');
INSERT INTO `barangay` VALUES ('2177', 'Rizal', '131');
INSERT INTO `barangay` VALUES ('2178', 'Sacsac', '131');
INSERT INTO `barangay` VALUES ('2179', 'Sambagon', '131');
INSERT INTO `barangay` VALUES ('2180', '	Sibago', '131');
INSERT INTO `barangay` VALUES ('2181', 'Tajao', '131');
INSERT INTO `barangay` VALUES ('2182', 'Tangub', '131');
INSERT INTO `barangay` VALUES ('2183', 'Tanibag', '131');
INSERT INTO `barangay` VALUES ('2184', 'Tupas', '131');
INSERT INTO `barangay` VALUES ('2185', 'Tutay', '131');
INSERT INTO `barangay` VALUES ('2186', 'Adela', '132');
INSERT INTO `barangay` VALUES ('2187', 'Altavista', '132');
INSERT INTO `barangay` VALUES ('2188', 'Cagcagan', '132');
INSERT INTO `barangay` VALUES ('2189', 'Cansabusab', '132');
INSERT INTO `barangay` VALUES ('2190', 'Daan Paz', '132');
INSERT INTO `barangay` VALUES ('2191', 'Eastern Poblacion	', '132');
INSERT INTO `barangay` VALUES ('2192', 'Esperanza', '132');
INSERT INTO `barangay` VALUES ('2193', 'Libertad', '132');
INSERT INTO `barangay` VALUES ('2194', 'Mabini', '132');
INSERT INTO `barangay` VALUES ('2195', 'Mercedes', '132');
INSERT INTO `barangay` VALUES ('2196', 'Pagsa', '132');
INSERT INTO `barangay` VALUES ('2197', 'Paz', '132');
INSERT INTO `barangay` VALUES ('2198', 'Rizal', '132');
INSERT INTO `barangay` VALUES ('2199', 'San Jose', '132');
INSERT INTO `barangay` VALUES ('2200', 'Santa Rita', '132');
INSERT INTO `barangay` VALUES ('2201', 'Teguis', '132');
INSERT INTO `barangay` VALUES ('2202', 'Western Poblacion', '132');
INSERT INTO `barangay` VALUES ('2203', 'Aranjuez ', '47');
INSERT INTO `barangay` VALUES ('2204', 'Bacolod ', '47');
INSERT INTO `barangay` VALUES ('2205', 'Balanti-an ', '47');
INSERT INTO `barangay` VALUES ('2206', 'Batuan ', '47');
INSERT INTO `barangay` VALUES ('2207', 'Cabalic ', '47');
INSERT INTO `barangay` VALUES ('2208', 'Camambugan ', '47');
INSERT INTO `barangay` VALUES ('2209', 'Dolores ', '47');
INSERT INTO `barangay` VALUES ('2210', 'Gimamanay ', '47');
INSERT INTO `barangay` VALUES ('2211', 'Ipil ', '47');
INSERT INTO `barangay` VALUES ('2212', 'Kinalkalan ', '47');
INSERT INTO `barangay` VALUES ('2213', 'Lawis ', '47');
INSERT INTO `barangay` VALUES ('2214', 'Malapoc ', '47');
INSERT INTO `barangay` VALUES ('2215', 'Mamhut Norte ', '47');
INSERT INTO `barangay` VALUES ('2216', 'Mamhut Sur ', '47');
INSERT INTO `barangay` VALUES ('2217', 'Maya ', '47');
INSERT INTO `barangay` VALUES ('2218', 'Pani-an ', '47');
INSERT INTO `barangay` VALUES ('2219', 'Poblacion Norte ', '47');
INSERT INTO `barangay` VALUES ('2220', 'Poblacion Sur ', '47');
INSERT INTO `barangay` VALUES ('2221', 'Quiasan ', '47');
INSERT INTO `barangay` VALUES ('2222', 'Salong ', '47');
INSERT INTO `barangay` VALUES ('2223', 'Salvacion ', '47');
INSERT INTO `barangay` VALUES ('2224', 'Tingui-an ', '47');
INSERT INTO `barangay` VALUES ('2225', 'Zaragosa', '47');
INSERT INTO `barangay` VALUES ('2226', 'Butong', '133');
INSERT INTO `barangay` VALUES ('2227', 'Can?abuhon', '133');
INSERT INTO `barangay` VALUES ('2228', 'Canduling', '133');
INSERT INTO `barangay` VALUES ('2229', 'Cansalonoy	', '133');
INSERT INTO `barangay` VALUES ('2230', 'Cansayahon', '133');
INSERT INTO `barangay` VALUES ('2231', 'Ilaya', '133');
INSERT INTO `barangay` VALUES ('2232', 'Langin', '133');
INSERT INTO `barangay` VALUES ('2233', 'Libo?o', '133');
INSERT INTO `barangay` VALUES ('2234', 'Malalay', '133');
INSERT INTO `barangay` VALUES ('2235', 'Palanas', '133');
INSERT INTO `barangay` VALUES ('2236', 'Poblacion', '133');
INSERT INTO `barangay` VALUES ('2237', 'Santa Cruz', '133');
INSERT INTO `barangay` VALUES ('2238', 'Tupas', '133');
INSERT INTO `barangay` VALUES ('2239', 'Vive', '133');
INSERT INTO `barangay` VALUES ('2240', 'Alacaygan ', '48');
INSERT INTO `barangay` VALUES ('2241', 'Bariga ', '48');
INSERT INTO `barangay` VALUES ('2242', 'Belen ', '48');
INSERT INTO `barangay` VALUES ('2243', 'Bobon ', '48');
INSERT INTO `barangay` VALUES ('2244', 'Bularan ', '48');
INSERT INTO `barangay` VALUES ('2245', 'Carmelo ', '48');
INSERT INTO `barangay` VALUES ('2246', 'De La Paz ', '48');
INSERT INTO `barangay` VALUES ('2247', 'Dugwakan ', '48');
INSERT INTO `barangay` VALUES ('2248', 'Juanico ', '48');
INSERT INTO `barangay` VALUES ('2249', 'Libertad ', '48');
INSERT INTO `barangay` VALUES ('2250', 'Magdalo ', '48');
INSERT INTO `barangay` VALUES ('2251', 'Managopaya ', '48');
INSERT INTO `barangay` VALUES ('2252', 'Merced ', '48');
INSERT INTO `barangay` VALUES ('2253', 'Poblacion ', '48');
INSERT INTO `barangay` VALUES ('2254', 'San Salvador ', '48');
INSERT INTO `barangay` VALUES ('2255', 'Talokgangan ', '48');
INSERT INTO `barangay` VALUES ('2256', 'Zona Sur ', '48');
INSERT INTO `barangay` VALUES ('2257', 'Fuentes', '48');
INSERT INTO `barangay` VALUES ('2258', 'Basak', '134');
INSERT INTO `barangay` VALUES ('2259', 'Bonbon', '134');
INSERT INTO `barangay` VALUES ('2260', 'Bulangsuran', '134');
INSERT INTO `barangay` VALUES ('2261', 'Calatagan', '134');
INSERT INTO `barangay` VALUES ('2262', 'Cambigong', '134');
INSERT INTO `barangay` VALUES ('2263', 'Camburoy', '134');
INSERT INTO `barangay` VALUES ('2264', 'Canorong', '134');
INSERT INTO `barangay` VALUES ('2265', 'Colase', '134');
INSERT INTO `barangay` VALUES ('2266', 'Dalahikan', '134');
INSERT INTO `barangay` VALUES ('2267', 'Jumangpas', '134');
INSERT INTO `barangay` VALUES ('2268', 'Monteverde', '134');
INSERT INTO `barangay` VALUES ('2269', 'Poblacion', '134');
INSERT INTO `barangay` VALUES ('2270', 'San Sebastian', '134');
INSERT INTO `barangay` VALUES ('2271', 'Suba', '134');
INSERT INTO `barangay` VALUES ('2272', 'Tangbo', '134');
INSERT INTO `barangay` VALUES ('2273', 'Acuit ', '49');
INSERT INTO `barangay` VALUES ('2274', 'Agcuyawan Calsada ', '49');
INSERT INTO `barangay` VALUES ('2275', 'Agcuyawan Pulo ', '49');
INSERT INTO `barangay` VALUES ('2276', 'Bagongbong ', '49');
INSERT INTO `barangay` VALUES ('2277', 'Baras ', '49');
INSERT INTO `barangay` VALUES ('2278', 'Bungca ', '49');
INSERT INTO `barangay` VALUES ('2279', 'Cabilauan ', '49');
INSERT INTO `barangay` VALUES ('2280', 'Cruz ', '49');
INSERT INTO `barangay` VALUES ('2281', 'Guintas ', '49');
INSERT INTO `barangay` VALUES ('2282', 'Igbong ', '49');
INSERT INTO `barangay` VALUES ('2283', 'Ilaud Poblacion ', '49');
INSERT INTO `barangay` VALUES ('2284', 'Jalaud ', '49');
INSERT INTO `barangay` VALUES ('2285', 'Lagubang ', '49');
INSERT INTO `barangay` VALUES ('2286', 'Lanas ', '49');
INSERT INTO `barangay` VALUES ('2287', 'Lico-an ', '49');
INSERT INTO `barangay` VALUES ('2288', 'Linao ', '49');
INSERT INTO `barangay` VALUES ('2289', 'Monpon ', '49');
INSERT INTO `barangay` VALUES ('2290', 'Palaciawan ', '49');
INSERT INTO `barangay` VALUES ('2291', 'Patag ', '49');
INSERT INTO `barangay` VALUES ('2292', 'Salihid ', '49');
INSERT INTO `barangay` VALUES ('2293', 'So-ol ', '49');
INSERT INTO `barangay` VALUES ('2294', 'Sohoton ', '49');
INSERT INTO `barangay` VALUES ('2295', 'Tabuc-Suba ', '49');
INSERT INTO `barangay` VALUES ('2296', 'Tabucan ', '49');
INSERT INTO `barangay` VALUES ('2297', 'Talisay ', '49');
INSERT INTO `barangay` VALUES ('2298', 'Tinorian ', '49');
INSERT INTO `barangay` VALUES ('2299', 'Tiwi ', '49');
INSERT INTO `barangay` VALUES ('2300', 'Tubungan', '49');
INSERT INTO `barangay` VALUES ('2301', 'Ilaya Poblacion', '49');
INSERT INTO `barangay` VALUES ('2302', 'Balud', '135');
INSERT INTO `barangay` VALUES ('2303', 'Balungag', '135');
INSERT INTO `barangay` VALUES ('2304', 'Basak', '135');
INSERT INTO `barangay` VALUES ('2305', 'Bugho', '135');
INSERT INTO `barangay` VALUES ('2306', 'Cabatbatan', '135');
INSERT INTO `barangay` VALUES ('2307', 'Greenhills', '135');
INSERT INTO `barangay` VALUES ('2308', 'Ilaya', '135');
INSERT INTO `barangay` VALUES ('2309', 'Lantawan', '135');
INSERT INTO `barangay` VALUES ('2310', 'Liburon', '135');
INSERT INTO `barangay` VALUES ('2311', 'Magsico', '135');
INSERT INTO `barangay` VALUES ('2312', 'Poblacion North', '135');
INSERT INTO `barangay` VALUES ('2313', 'Poblacion South', '135');
INSERT INTO `barangay` VALUES ('2314', 'Panadtaran', '135');
INSERT INTO `barangay` VALUES ('2315', 'Pitalo', '135');
INSERT INTO `barangay` VALUES ('2316', 'San Isidro', '135');
INSERT INTO `barangay` VALUES ('2317', 'Sangat', '135');
INSERT INTO `barangay` VALUES ('2318', 'Tabionan', '135');
INSERT INTO `barangay` VALUES ('2319', 'Tananas', '135');
INSERT INTO `barangay` VALUES ('2320', 'Tinubdan', '135');
INSERT INTO `barangay` VALUES ('2321', 'Tonggo', '135');
INSERT INTO `barangay` VALUES ('2322', '	Tubod', '135');
INSERT INTO `barangay` VALUES ('2323', 'Cabunga?an', '136');
INSERT INTO `barangay` VALUES ('2324', 'Campo', '136');
INSERT INTO `barangay` VALUES ('2325', 'Consuelo', '136');
INSERT INTO `barangay` VALUES ('2326', 'Esperanza', '136');
INSERT INTO `barangay` VALUES ('2327', 'Himensulan', '136');
INSERT INTO `barangay` VALUES ('2328', 'Montealegre', '136');
INSERT INTO `barangay` VALUES ('2329', 'Northern Poblacion	', '136');
INSERT INTO `barangay` VALUES ('2330', 'San Isidro', '136');
INSERT INTO `barangay` VALUES ('2331', 'Santa Cruz', '136');
INSERT INTO `barangay` VALUES ('2332', 'Santiago', '136');
INSERT INTO `barangay` VALUES ('2333', 'Sonog', '136');
INSERT INTO `barangay` VALUES ('2334', 'Southern Poblacion', '136');
INSERT INTO `barangay` VALUES ('2335', 'Unidos', '136');
INSERT INTO `barangay` VALUES ('2336', 'Union', '136');
INSERT INTO `barangay` VALUES ('2337', 'Western Poblacion', '136');
INSERT INTO `barangay` VALUES ('2338', 'Bugnay ', '50');
INSERT INTO `barangay` VALUES ('2339', 'California ', '50');
INSERT INTO `barangay` VALUES ('2340', 'Del Pilar ', '50');
INSERT INTO `barangay` VALUES ('2341', 'De la Peña ', '50');
INSERT INTO `barangay` VALUES ('2342', 'General Luna ', '50');
INSERT INTO `barangay` VALUES ('2343', 'La Fortuna ', '50');
INSERT INTO `barangay` VALUES ('2344', 'Lipata ', '50');
INSERT INTO `barangay` VALUES ('2345', 'Natividad ', '50');
INSERT INTO `barangay` VALUES ('2346', 'Nueva Invencion ', '50');
INSERT INTO `barangay` VALUES ('2347', 'Nueva Sevilla ', '50');
INSERT INTO `barangay` VALUES ('2348', 'Poblacion ', '50');
INSERT INTO `barangay` VALUES ('2349', 'Puerto Princesa ', '50');
INSERT INTO `barangay` VALUES ('2350', 'Rizal ', '50');
INSERT INTO `barangay` VALUES ('2351', 'San Antonio ', '50');
INSERT INTO `barangay` VALUES ('2352', 'San Fernando ', '50');
INSERT INTO `barangay` VALUES ('2353', 'San Francisco ', '50');
INSERT INTO `barangay` VALUES ('2354', 'San Geronimo ', '50');
INSERT INTO `barangay` VALUES ('2355', 'San Juan ', '50');
INSERT INTO `barangay` VALUES ('2356', 'San Lucas ', '50');
INSERT INTO `barangay` VALUES ('2357', 'San Miguel ', '50');
INSERT INTO `barangay` VALUES ('2358', 'San Roque ', '50');
INSERT INTO `barangay` VALUES ('2359', 'Santiago ', '50');
INSERT INTO `barangay` VALUES ('2360', 'Santo Domingo ', '50');
INSERT INTO `barangay` VALUES ('2361', 'Santo Tomas ', '50');
INSERT INTO `barangay` VALUES ('2362', 'Ugasan ', '50');
INSERT INTO `barangay` VALUES ('2363', 'Vista Alegre', '50');
INSERT INTO `barangay` VALUES ('2364', 'Alapasco ', '51');
INSERT INTO `barangay` VALUES ('2365', 'Alinsolong ', '51');
INSERT INTO `barangay` VALUES ('2366', 'Banban ', '51');
INSERT INTO `barangay` VALUES ('2367', 'Batad Viejo ', '51');
INSERT INTO `barangay` VALUES ('2368', 'Binon-an ', '51');
INSERT INTO `barangay` VALUES ('2369', 'Bolhog ', '51');
INSERT INTO `barangay` VALUES ('2370', 'Bulak Norte ', '51');
INSERT INTO `barangay` VALUES ('2371', 'Bulak Sur ', '51');
INSERT INTO `barangay` VALUES ('2372', 'Cabagohan ', '51');
INSERT INTO `barangay` VALUES ('2373', 'Calangag ', '51');
INSERT INTO `barangay` VALUES ('2374', 'Caw-i ', '51');
INSERT INTO `barangay` VALUES ('2375', 'Drancalan ', '51');
INSERT INTO `barangay` VALUES ('2376', 'Embarcadero ', '51');
INSERT INTO `barangay` VALUES ('2377', 'Hamod ', '51');
INSERT INTO `barangay` VALUES ('2378', 'Malico ', '51');
INSERT INTO `barangay` VALUES ('2379', 'Nangka ', '51');
INSERT INTO `barangay` VALUES ('2380', 'Pasayan ', '51');
INSERT INTO `barangay` VALUES ('2381', 'Poblacion ', '51');
INSERT INTO `barangay` VALUES ('2382', 'Quiazan Florete ', '51');
INSERT INTO `barangay` VALUES ('2383', 'Quiazan Lopez ', '51');
INSERT INTO `barangay` VALUES ('2384', 'Salong ', '51');
INSERT INTO `barangay` VALUES ('2385', 'Santa Ana ', '51');
INSERT INTO `barangay` VALUES ('2386', 'Tanao ', '51');
INSERT INTO `barangay` VALUES ('2387', 'Tapi-an', '51');
INSERT INTO `barangay` VALUES ('2388', 'Agba-o ', '52');
INSERT INTO `barangay` VALUES ('2389', 'Alabidhan ', '52');
INSERT INTO `barangay` VALUES ('2390', 'Bulabog (with 1 Sitio, namely: Sitio Sinamungan) ', '52');
INSERT INTO `barangay` VALUES ('2391', 'Cairohan ', '52');
INSERT INTO `barangay` VALUES ('2392', 'Guinhulacan ', '52');
INSERT INTO `barangay` VALUES ('2393', 'Inamyungan ', '52');
INSERT INTO `barangay` VALUES ('2394', 'Malitbog Ilawod ', '52');
INSERT INTO `barangay` VALUES ('2395', 'Malitbog Ilaya (with 1 Sitio, namely: Sitio San Isidro) ', '52');
INSERT INTO `barangay` VALUES ('2396', 'Ngingi-an ', '52');
INSERT INTO `barangay` VALUES ('2397', 'Poblacion (Comprises 8 Puroks in the town proper and 4 Sitios, namely: Cubay, Inaquigan, Maganhop and Maldespina) ', '52');
INSERT INTO `barangay` VALUES ('2398', 'Quinangyana ', '52');
INSERT INTO `barangay` VALUES ('2399', 'Quinar-Upan (with 4 Sitios, namely: Dalusan, Kala-igang, Karuntingan and Nalundan) ', '52');
INSERT INTO `barangay` VALUES ('2400', 'Tapacon (with 1 Sitio, namely: Sitio Fatima) ', '52');
INSERT INTO `barangay` VALUES ('2401', 'Tubod', '52');
INSERT INTO `barangay` VALUES ('2402', 'Anapog', '137');
INSERT INTO `barangay` VALUES ('2403', 'Argawanon', '137');
INSERT INTO `barangay` VALUES ('2404', 'Bagtic', '137');
INSERT INTO `barangay` VALUES ('2405', 'Bancasan	', '137');
INSERT INTO `barangay` VALUES ('2406', 'Batad', '137');
INSERT INTO `barangay` VALUES ('2407', 'Busogon', '137');
INSERT INTO `barangay` VALUES ('2408', 'Calambua', '137');
INSERT INTO `barangay` VALUES ('2409', 'Canagahan', '137');
INSERT INTO `barangay` VALUES ('2410', 'Dapdap', '137');
INSERT INTO `barangay` VALUES ('2411', 'Gawaygaway', '137');
INSERT INTO `barangay` VALUES ('2412', 'Hagnaya', '137');
INSERT INTO `barangay` VALUES ('2413', 'Kayam', '137');
INSERT INTO `barangay` VALUES ('2414', 'Kinawahan', '137');
INSERT INTO `barangay` VALUES ('2415', 'Lambusan', '137');
INSERT INTO `barangay` VALUES ('2416', 'Lawis', '137');
INSERT INTO `barangay` VALUES ('2417', 'Libaong', '137');
INSERT INTO `barangay` VALUES ('2418', 'Looc', '137');
INSERT INTO `barangay` VALUES ('2419', 'Luyang', '137');
INSERT INTO `barangay` VALUES ('2420', 'Mano', '137');
INSERT INTO `barangay` VALUES ('2421', 'Poblacion', '137');
INSERT INTO `barangay` VALUES ('2422', 'Punta', '137');
INSERT INTO `barangay` VALUES ('2423', 'Sab?a', '137');
INSERT INTO `barangay` VALUES ('2424', 'San Miguel', '137');
INSERT INTO `barangay` VALUES ('2425', 'Tacup', '137');
INSERT INTO `barangay` VALUES ('2426', 'Tambongon', '137');
INSERT INTO `barangay` VALUES ('2427', 'To?ong', '137');
INSERT INTO `barangay` VALUES ('2428', 'Victoria', '137');
INSERT INTO `barangay` VALUES ('2429', 'Balidbid', '138');
INSERT INTO `barangay` VALUES ('2430', 'Hagdan	', '138');
INSERT INTO `barangay` VALUES ('2431', 'Hilantagaan	', '138');
INSERT INTO `barangay` VALUES ('2432', 'Kinatarkan', '138');
INSERT INTO `barangay` VALUES ('2433', 'Langub', '138');
INSERT INTO `barangay` VALUES ('2434', 'Maricaban', '138');
INSERT INTO `barangay` VALUES ('2435', 'Okoy', '138');
INSERT INTO `barangay` VALUES ('2436', 'Poblacion', '138');
INSERT INTO `barangay` VALUES ('2437', 'Pooc', '138');
INSERT INTO `barangay` VALUES ('2438', 'Talisay', '138');
INSERT INTO `barangay` VALUES ('2439', 'Bunlan', '139');
INSERT INTO `barangay` VALUES ('2440', 'Cabutongan', '139');
INSERT INTO `barangay` VALUES ('2441', 'Candamiang', '139');
INSERT INTO `barangay` VALUES ('2442', 'Canlumacad', '139');
INSERT INTO `barangay` VALUES ('2443', 'Liloan', '139');
INSERT INTO `barangay` VALUES ('2444', 'Lip?tong', '139');
INSERT INTO `barangay` VALUES ('2445', 'Looc', '139');
INSERT INTO `barangay` VALUES ('2446', 'Pasil', '139');
INSERT INTO `barangay` VALUES ('2447', 'Poblacion', '139');
INSERT INTO `barangay` VALUES ('2448', 'Talisay', '139');
INSERT INTO `barangay` VALUES ('2449', 'Acao ', '53');
INSERT INTO `barangay` VALUES ('2450', 'Amerang ', '53');
INSERT INTO `barangay` VALUES ('2451', 'Amurao ', '53');
INSERT INTO `barangay` VALUES ('2452', 'Anuang ', '53');
INSERT INTO `barangay` VALUES ('2453', 'Ayaman ', '53');
INSERT INTO `barangay` VALUES ('2454', 'Ayong ', '53');
INSERT INTO `barangay` VALUES ('2455', 'Bacan ', '53');
INSERT INTO `barangay` VALUES ('2456', 'Balabag ', '53');
INSERT INTO `barangay` VALUES ('2457', 'Baluyan ', '53');
INSERT INTO `barangay` VALUES ('2458', 'Banguit ', '53');
INSERT INTO `barangay` VALUES ('2459', 'Bulay ', '53');
INSERT INTO `barangay` VALUES ('2460', 'Cadoldolan ', '53');
INSERT INTO `barangay` VALUES ('2461', 'Cagban ', '53');
INSERT INTO `barangay` VALUES ('2462', 'Calawagan ', '53');
INSERT INTO `barangay` VALUES ('2463', 'Calayo ', '53');
INSERT INTO `barangay` VALUES ('2464', 'Duyan-Duyan ', '53');
INSERT INTO `barangay` VALUES ('2465', 'Gaub ', '53');
INSERT INTO `barangay` VALUES ('2466', 'Gines Interior ', '53');
INSERT INTO `barangay` VALUES ('2467', 'Gines Patag ', '53');
INSERT INTO `barangay` VALUES ('2468', 'Guibuangan Tigbauan ', '53');
INSERT INTO `barangay` VALUES ('2469', 'Inabasan ', '53');
INSERT INTO `barangay` VALUES ('2470', 'Inaca ', '53');
INSERT INTO `barangay` VALUES ('2471', 'Inaladan ', '53');
INSERT INTO `barangay` VALUES ('2472', 'Ingas ', '53');
INSERT INTO `barangay` VALUES ('2473', 'Ito Norte ', '53');
INSERT INTO `barangay` VALUES ('2474', 'Ito Sur ', '53');
INSERT INTO `barangay` VALUES ('2475', 'Janipaan Central ', '53');
INSERT INTO `barangay` VALUES ('2476', 'Janipaan Este ', '53');
INSERT INTO `barangay` VALUES ('2477', 'Janipaan Oeste ', '53');
INSERT INTO `barangay` VALUES ('2478', 'Janipaan Olo ', '53');
INSERT INTO `barangay` VALUES ('2479', 'Jelicuon Lusaya ', '53');
INSERT INTO `barangay` VALUES ('2480', 'Jelicuon Montinola ', '53');
INSERT INTO `barangay` VALUES ('2481', 'Lag-an ', '53');
INSERT INTO `barangay` VALUES ('2482', 'Leong ', '53');
INSERT INTO `barangay` VALUES ('2483', 'Lutac ', '53');
INSERT INTO `barangay` VALUES ('2484', 'Manguna ', '53');
INSERT INTO `barangay` VALUES ('2485', 'Maraguit ', '53');
INSERT INTO `barangay` VALUES ('2486', 'Morubuan ', '53');
INSERT INTO `barangay` VALUES ('2487', 'Pacatin ', '53');
INSERT INTO `barangay` VALUES ('2488', 'Pagotpot ', '53');
INSERT INTO `barangay` VALUES ('2489', 'Pamul-ogan ', '53');
INSERT INTO `barangay` VALUES ('2490', 'Pamuringao Proper ', '53');
INSERT INTO `barangay` VALUES ('2491', 'Pamuringao Garrido ', '53');
INSERT INTO `barangay` VALUES ('2492', 'Zone I Pob. (Barangay 1) ', '53');
INSERT INTO `barangay` VALUES ('2493', 'Zone II Pob. (Barangay 2) ', '53');
INSERT INTO `barangay` VALUES ('2494', 'Zone III Pob. (Barangay 3) ', '53');
INSERT INTO `barangay` VALUES ('2495', 'Zone IV Pob. (Barangay 4) ', '53');
INSERT INTO `barangay` VALUES ('2496', 'Zone V Pob. (Barangay 5) ', '53');
INSERT INTO `barangay` VALUES ('2497', 'Zone VI Pob. (Barangay 6) ', '53');
INSERT INTO `barangay` VALUES ('2498', 'Zone VII Pob. (Barangay 7) ', '53');
INSERT INTO `barangay` VALUES ('2499', 'Zone VIII Pob. (Barangay 8) ', '53');
INSERT INTO `barangay` VALUES ('2500', 'Zone IX Pob. (Barangay 9) ', '53');
INSERT INTO `barangay` VALUES ('2501', 'Zone X Pob. (Barangay 10) ', '53');
INSERT INTO `barangay` VALUES ('2502', 'Zone XI Pob. (Barangay 11) ', '53');
INSERT INTO `barangay` VALUES ('2503', 'Pungtod ', '53');
INSERT INTO `barangay` VALUES ('2504', 'Puyas ', '53');
INSERT INTO `barangay` VALUES ('2505', 'Salacay ', '53');
INSERT INTO `barangay` VALUES ('2506', 'Sulanga ', '53');
INSERT INTO `barangay` VALUES ('2507', 'Tabucan ', '53');
INSERT INTO `barangay` VALUES ('2508', 'Tacdangan ', '53');
INSERT INTO `barangay` VALUES ('2509', 'Talanghauan ', '53');
INSERT INTO `barangay` VALUES ('2510', 'Tigbauan Road ', '53');
INSERT INTO `barangay` VALUES ('2511', 'Tinio-an ', '53');
INSERT INTO `barangay` VALUES ('2512', 'Tiring ', '53');
INSERT INTO `barangay` VALUES ('2513', 'Tupol Central ', '53');
INSERT INTO `barangay` VALUES ('2514', 'Tupol Este ', '53');
INSERT INTO `barangay` VALUES ('2515', 'Tupol Oeste ', '53');
INSERT INTO `barangay` VALUES ('2516', 'Tuy-an', '53');
INSERT INTO `barangay` VALUES ('2517', 'Abugon', '140');
INSERT INTO `barangay` VALUES ('2518', 'Bae', '140');
INSERT INTO `barangay` VALUES ('2519', 'Bagacay', '140');
INSERT INTO `barangay` VALUES ('2520', 'Bahay', '140');
INSERT INTO `barangay` VALUES ('2521', 'Banlot', '140');
INSERT INTO `barangay` VALUES ('2522', 'Basak', '140');
INSERT INTO `barangay` VALUES ('2523', 'Bato', '140');
INSERT INTO `barangay` VALUES ('2524', 'Cagay', '140');
INSERT INTO `barangay` VALUES ('2525', 'Can?aga', '140');
INSERT INTO `barangay` VALUES ('2526', 'Candaguit', '140');
INSERT INTO `barangay` VALUES ('2527', 'Cantolaroy', '140');
INSERT INTO `barangay` VALUES ('2528', 'Dugoan', '140');
INSERT INTO `barangay` VALUES ('2529', 'Guimbangco?an', '140');
INSERT INTO `barangay` VALUES ('2530', 'Lamacan', '140');
INSERT INTO `barangay` VALUES ('2531', 'Libo', '140');
INSERT INTO `barangay` VALUES ('2532', 'Lindogon', '140');
INSERT INTO `barangay` VALUES ('2533', 'Magcagong', '140');
INSERT INTO `barangay` VALUES ('2534', 'Manatad', '140');
INSERT INTO `barangay` VALUES ('2535', 'Mangyan', '140');
INSERT INTO `barangay` VALUES ('2536', 'Papan', '140');
INSERT INTO `barangay` VALUES ('2537', 'Poblacion', '140');
INSERT INTO `barangay` VALUES ('2538', 'Sabang', '140');
INSERT INTO `barangay` VALUES ('2539', 'Sayao', '140');
INSERT INTO `barangay` VALUES ('2540', 'Simala', '140');
INSERT INTO `barangay` VALUES ('2541', 'Tubod', '140');
INSERT INTO `barangay` VALUES ('2542', 'Ampongol', '141');
INSERT INTO `barangay` VALUES ('2543', 'Bagakay', '141');
INSERT INTO `barangay` VALUES ('2544', 'Bagatayam', '141');
INSERT INTO `barangay` VALUES ('2545', 'Bawo', '141');
INSERT INTO `barangay` VALUES ('2546', 'Cabalawan	', '141');
INSERT INTO `barangay` VALUES ('2547', 'Cabangahan', '141');
INSERT INTO `barangay` VALUES ('2548', 'Calumboyan', '141');
INSERT INTO `barangay` VALUES ('2549', 'Dakit', '141');
INSERT INTO `barangay` VALUES ('2550', 'Damolog', '141');
INSERT INTO `barangay` VALUES ('2551', 'Ibabao', '141');
INSERT INTO `barangay` VALUES ('2552', 'Liki', '141');
INSERT INTO `barangay` VALUES ('2553', 'Lubo', '141');
INSERT INTO `barangay` VALUES ('2554', 'Mohon', '141');
INSERT INTO `barangay` VALUES ('2555', 'Nahus?an	', '141');
INSERT INTO `barangay` VALUES ('2556', 'Poblacion', '141');
INSERT INTO `barangay` VALUES ('2557', 'Tabunok', '141');
INSERT INTO `barangay` VALUES ('2558', 'Takay', '141');
INSERT INTO `barangay` VALUES ('2559', 'Pansoy', '141');
INSERT INTO `barangay` VALUES ('2560', 'Agcalaga ', '54');
INSERT INTO `barangay` VALUES ('2561', 'Aglibacao ', '54');
INSERT INTO `barangay` VALUES ('2562', 'Aglonok ', '54');
INSERT INTO `barangay` VALUES ('2563', 'Alibunan ', '54');
INSERT INTO `barangay` VALUES ('2564', 'Badlan Grande ', '54');
INSERT INTO `barangay` VALUES ('2565', 'Badlan Pequeño ', '54');
INSERT INTO `barangay` VALUES ('2566', 'Badu ', '54');
INSERT INTO `barangay` VALUES ('2567', 'Balaticon ', '54');
INSERT INTO `barangay` VALUES ('2568', 'Banban Grande ', '54');
INSERT INTO `barangay` VALUES ('2569', 'Banban Pequeño ', '54');
INSERT INTO `barangay` VALUES ('2570', 'Bangga Central ', '54');
INSERT INTO `barangay` VALUES ('2571', 'Binolosan Grande ', '54');
INSERT INTO `barangay` VALUES ('2572', 'Binolosan Pequeño ', '54');
INSERT INTO `barangay` VALUES ('2573', 'Cabagiao ', '54');
INSERT INTO `barangay` VALUES ('2574', 'Cabugao ', '54');
INSERT INTO `barangay` VALUES ('2575', 'Cahigon ', '54');
INSERT INTO `barangay` VALUES ('2576', 'Barrio Calinog ', '54');
INSERT INTO `barangay` VALUES ('2577', 'Camalongo ', '54');
INSERT INTO `barangay` VALUES ('2578', 'Canabajan ', '54');
INSERT INTO `barangay` VALUES ('2579', 'Caratagan ', '54');
INSERT INTO `barangay` VALUES ('2580', 'Carvasana ', '54');
INSERT INTO `barangay` VALUES ('2581', 'Dalid ', '54');
INSERT INTO `barangay` VALUES ('2582', 'Datagan ', '54');
INSERT INTO `barangay` VALUES ('2583', 'Gama Grande ', '54');
INSERT INTO `barangay` VALUES ('2584', 'Gama Pequeño ', '54');
INSERT INTO `barangay` VALUES ('2585', 'Garangan ', '54');
INSERT INTO `barangay` VALUES ('2586', 'Guinbonyugan ', '54');
INSERT INTO `barangay` VALUES ('2587', 'Guiso ', '54');
INSERT INTO `barangay` VALUES ('2588', 'Hilwan ', '54');
INSERT INTO `barangay` VALUES ('2589', 'Impalidan ', '54');
INSERT INTO `barangay` VALUES ('2590', 'Ipil ', '54');
INSERT INTO `barangay` VALUES ('2591', 'Jamin-ay ', '54');
INSERT INTO `barangay` VALUES ('2592', 'Lampaya', '54');
INSERT INTO `barangay` VALUES ('2593', ' Libot ', '54');
INSERT INTO `barangay` VALUES ('2594', 'Lonoy ', '54');
INSERT INTO `barangay` VALUES ('2595', 'Malaguinabot ', '54');
INSERT INTO `barangay` VALUES ('2596', 'Malapawe ', '54');
INSERT INTO `barangay` VALUES ('2597', 'Malitbog Centro ', '54');
INSERT INTO `barangay` VALUES ('2598', 'Mambiranan ', '54');
INSERT INTO `barangay` VALUES ('2599', 'Manaripay ', '54');
INSERT INTO `barangay` VALUES ('2600', 'Marandig ', '54');
INSERT INTO `barangay` VALUES ('2601', 'Masaroy ', '54');
INSERT INTO `barangay` VALUES ('2602', 'Maspasan ', '54');
INSERT INTO `barangay` VALUES ('2603', 'Nalbugan ', '54');
INSERT INTO `barangay` VALUES ('2604', 'Owak ', '54');
INSERT INTO `barangay` VALUES ('2605', 'Poblacion Centro ', '54');
INSERT INTO `barangay` VALUES ('2606', 'Poblacion Delgado ', '54');
INSERT INTO `barangay` VALUES ('2607', 'Poblacion Rizal Ilaud', '54');
INSERT INTO `barangay` VALUES ('2608', ' Poblacion Ilaya ', '54');
INSERT INTO `barangay` VALUES ('2609', 'Baje San Julian ', '54');
INSERT INTO `barangay` VALUES ('2610', 'San Nicolas ', '54');
INSERT INTO `barangay` VALUES ('2611', 'Simsiman ', '54');
INSERT INTO `barangay` VALUES ('2612', 'Tabucan ', '54');
INSERT INTO `barangay` VALUES ('2613', 'Tahing ', '54');
INSERT INTO `barangay` VALUES ('2614', 'Tibiao ', '54');
INSERT INTO `barangay` VALUES ('2615', 'Tigbayog ', '54');
INSERT INTO `barangay` VALUES ('2616', 'Toyungan ', '54');
INSERT INTO `barangay` VALUES ('2617', 'Ulayan ', '54');
INSERT INTO `barangay` VALUES ('2618', 'Malag-it ', '54');
INSERT INTO `barangay` VALUES ('2619', 'Supanga', '54');
INSERT INTO `barangay` VALUES ('2620', 'Alang?alang', '142');
INSERT INTO `barangay` VALUES ('2621', 'Caduawan', '142');
INSERT INTO `barangay` VALUES ('2622', 'Camoboan', '142');
INSERT INTO `barangay` VALUES ('2623', 'Canaocanao', '142');
INSERT INTO `barangay` VALUES ('2624', 'Combado', '142');
INSERT INTO `barangay` VALUES ('2625', 'Daantabogon	', '142');
INSERT INTO `barangay` VALUES ('2626', 'Ilihan', '142');
INSERT INTO `barangay` VALUES ('2627', 'Kal?anan', '142');
INSERT INTO `barangay` VALUES ('2628', 'Labangon', '142');
INSERT INTO `barangay` VALUES ('2629', 'Libjo', '142');
INSERT INTO `barangay` VALUES ('2630', 'Loong', '142');
INSERT INTO `barangay` VALUES ('2631', 'Mabuli', '142');
INSERT INTO `barangay` VALUES ('2632', 'Managase', '142');
INSERT INTO `barangay` VALUES ('2633', 'Manlagtang', '142');
INSERT INTO `barangay` VALUES ('2634', 'Maslog', '142');
INSERT INTO `barangay` VALUES ('2635', 'Muabog', '142');
INSERT INTO `barangay` VALUES ('2636', 'Pio', '142');
INSERT INTO `barangay` VALUES ('2637', 'Poblacion', '142');
INSERT INTO `barangay` VALUES ('2638', 'Salag', '142');
INSERT INTO `barangay` VALUES ('2639', 'Sambag	', '142');
INSERT INTO `barangay` VALUES ('2640', 'San Isidro	', '142');
INSERT INTO `barangay` VALUES ('2641', 'San Vicente', '142');
INSERT INTO `barangay` VALUES ('2642', 'Somosa	', '142');
INSERT INTO `barangay` VALUES ('2643', 'Taba?ao', '142');
INSERT INTO `barangay` VALUES ('2644', 'Tapul', '142');
INSERT INTO `barangay` VALUES ('2645', 'Abong ', '55');
INSERT INTO `barangay` VALUES ('2646', 'Alipata (Sicogon Island) ', '55');
INSERT INTO `barangay` VALUES ('2647', 'Asluman (Gigantes Norte) ', '55');
INSERT INTO `barangay` VALUES ('2648', 'Bancal ', '55');
INSERT INTO `barangay` VALUES ('2649', 'Barangcalan ', '55');
INSERT INTO `barangay` VALUES ('2650', 'Barosbos ', '55');
INSERT INTO `barangay` VALUES ('2651', 'Punta Batuanan ', '55');
INSERT INTO `barangay` VALUES ('2652', 'Binuluangan ', '55');
INSERT INTO `barangay` VALUES ('2653', 'Bito-on ', '55');
INSERT INTO `barangay` VALUES ('2654', 'Bolo Buaya (Sicogon Island) ', '55');
INSERT INTO `barangay` VALUES ('2655', 'Buenavista ', '55');
INSERT INTO `barangay` VALUES ('2656', 'Isla De Cana ', '55');
INSERT INTO `barangay` VALUES ('2657', 'Cabilao Grande ', '55');
INSERT INTO `barangay` VALUES ('2658', 'Cabilao Pequeño ', '55');
INSERT INTO `barangay` VALUES ('2659', 'Cabuguana ', '55');
INSERT INTO `barangay` VALUES ('2660', 'Cawayan ', '55');
INSERT INTO `barangay` VALUES ('2661', 'Dayhagan ', '55');
INSERT INTO `barangay` VALUES ('2662', 'Gabi (Gigantes Sur) ', '55');
INSERT INTO `barangay` VALUES ('2663', 'Granada (Gigantes Norte) ', '55');
INSERT INTO `barangay` VALUES ('2664', 'Guinticgan ', '55');
INSERT INTO `barangay` VALUES ('2665', 'Lantangan (Gigantes Sur) ', '55');
INSERT INTO `barangay` VALUES ('2666', 'Manlot (Manlot Island) ', '55');
INSERT INTO `barangay` VALUES ('2667', 'Nalumsan ', '55');
INSERT INTO `barangay` VALUES ('2668', 'Pantalan ', '55');
INSERT INTO `barangay` VALUES ('2669', 'Poblacion ', '55');
INSERT INTO `barangay` VALUES ('2670', 'Punta (Bolocawe) ', '55');
INSERT INTO `barangay` VALUES ('2671', 'San Fernando (Sicogon Island) ', '55');
INSERT INTO `barangay` VALUES ('2672', 'Tabugon ', '55');
INSERT INTO `barangay` VALUES ('2673', 'Talingting ', '55');
INSERT INTO `barangay` VALUES ('2674', 'Tarong ', '55');
INSERT INTO `barangay` VALUES ('2675', 'Tinigban ', '55');
INSERT INTO `barangay` VALUES ('2676', 'Tupaz', '55');
INSERT INTO `barangay` VALUES ('2677', 'Bongon', '143');
INSERT INTO `barangay` VALUES ('2678', 'Kanlim?ao', '143');
INSERT INTO `barangay` VALUES ('2679', 'Kanluhagon', '143');
INSERT INTO `barangay` VALUES ('2680', 'Kantubaon', '143');
INSERT INTO `barangay` VALUES ('2681', 'Dalid', '143');
INSERT INTO `barangay` VALUES ('2682', 'Mabunao', '143');
INSERT INTO `barangay` VALUES ('2683', 'Maravilla', '143');
INSERT INTO `barangay` VALUES ('2684', 'Olivo', '143');
INSERT INTO `barangay` VALUES ('2685', 'Poblacion', '143');
INSERT INTO `barangay` VALUES ('2686', 'Tabunok', '143');
INSERT INTO `barangay` VALUES ('2687', 'Tigbawan', '143');
INSERT INTO `barangay` VALUES ('2688', 'Villahermosa', '143');
INSERT INTO `barangay` VALUES ('2689', 'Aglosong ', '56');
INSERT INTO `barangay` VALUES ('2690', 'Agnaga ', '56');
INSERT INTO `barangay` VALUES ('2691', 'Bacjawan Norte ', '56');
INSERT INTO `barangay` VALUES ('2692', 'Bacjawan Sur ', '56');
INSERT INTO `barangay` VALUES ('2693', 'Bagongon ', '56');
INSERT INTO `barangay` VALUES ('2694', 'Batiti ', '56');
INSERT INTO `barangay` VALUES ('2695', 'Botlog ', '56');
INSERT INTO `barangay` VALUES ('2696', 'Calamigan ', '56');
INSERT INTO `barangay` VALUES ('2697', 'Dungon ', '56');
INSERT INTO `barangay` VALUES ('2698', 'Igbon ', '56');
INSERT INTO `barangay` VALUES ('2699', 'Jamul-awon ', '56');
INSERT INTO `barangay` VALUES ('2700', 'Lo-ong ', '56');
INSERT INTO `barangay` VALUES ('2701', 'Macalbang ', '56');
INSERT INTO `barangay` VALUES ('2702', 'Macatunao ', '56');
INSERT INTO `barangay` VALUES ('2703', 'Malangabang ', '56');
INSERT INTO `barangay` VALUES ('2704', 'Maliogliog ', '56');
INSERT INTO `barangay` VALUES ('2705', 'Ni?o ', '56');
INSERT INTO `barangay` VALUES ('2706', 'Nipa ', '56');
INSERT INTO `barangay` VALUES ('2707', 'Plandico ', '56');
INSERT INTO `barangay` VALUES ('2708', 'Poblacion ', '56');
INSERT INTO `barangay` VALUES ('2709', 'Polopi?a (Bulubadiangan Island) ', '56');
INSERT INTO `barangay` VALUES ('2710', 'Salvacion ', '56');
INSERT INTO `barangay` VALUES ('2711', 'Talotu-an ', '56');
INSERT INTO `barangay` VALUES ('2712', 'Tambaliza (Pan de Azucar Island)', '56');
INSERT INTO `barangay` VALUES ('2713', ' Tamis-ac', '56');
INSERT INTO `barangay` VALUES ('2714', 'Alegria', '144');
INSERT INTO `barangay` VALUES ('2715', 'Amatugan', '144');
INSERT INTO `barangay` VALUES ('2716', 'Antipolo', '144');
INSERT INTO `barangay` VALUES ('2717', 'Apalan', '144');
INSERT INTO `barangay` VALUES ('2718', 'Bagasawe', '144');
INSERT INTO `barangay` VALUES ('2719', 'Bakyawan', '144');
INSERT INTO `barangay` VALUES ('2720', 'Bangkito', '144');
INSERT INTO `barangay` VALUES ('2721', 'Barangay I (pob.)', '144');
INSERT INTO `barangay` VALUES ('2722', 'Barangay II (pob.)', '144');
INSERT INTO `barangay` VALUES ('2723', 'Barangay III (pob.)', '144');
INSERT INTO `barangay` VALUES ('2724', 'Barangay IV (pob.)', '144');
INSERT INTO `barangay` VALUES ('2725', 'Barangay V (pob.)', '144');
INSERT INTO `barangay` VALUES ('2726', 'Barangay VI (pob.)', '144');
INSERT INTO `barangay` VALUES ('2727', 'Barangay VII (pob.)', '144');
INSERT INTO `barangay` VALUES ('2728', 'Barangay VIII (pob.)	', '144');
INSERT INTO `barangay` VALUES ('2729', 'Bulwang', '144');
INSERT INTO `barangay` VALUES ('2730', 'Caridad', '144');
INSERT INTO `barangay` VALUES ('2731', 'Carmelo', '144');
INSERT INTO `barangay` VALUES ('2732', 'Cogon', '144');
INSERT INTO `barangay` VALUES ('2733', 'Colonia', '144');
INSERT INTO `barangay` VALUES ('2734', 'Daan Lungsod', '144');
INSERT INTO `barangay` VALUES ('2735', 'Fortaliza', '144');
INSERT INTO `barangay` VALUES ('2736', 'Ga?ang', '144');
INSERT INTO `barangay` VALUES ('2737', 'Gimama?a', '144');
INSERT INTO `barangay` VALUES ('2738', 'Jagbuaya', '144');
INSERT INTO `barangay` VALUES ('2739', 'Kabangkalan', '144');
INSERT INTO `barangay` VALUES ('2740', 'Kabkaban', '144');
INSERT INTO `barangay` VALUES ('2741', 'Kagba?o', '144');
INSERT INTO `barangay` VALUES ('2742', 'Kalangahan', '144');
INSERT INTO `barangay` VALUES ('2743', 'Kamansi', '144');
INSERT INTO `barangay` VALUES ('2744', 'Kampoot', '144');
INSERT INTO `barangay` VALUES ('2745', 'Kan?an', '144');
INSERT INTO `barangay` VALUES ('2746', 'Kanlunsing', '144');
INSERT INTO `barangay` VALUES ('2747', 'Kansi', '144');
INSERT INTO `barangay` VALUES ('2748', 'Kaorasan', '144');
INSERT INTO `barangay` VALUES ('2749', 'Libo', '144');
INSERT INTO `barangay` VALUES ('2750', 'Lusong', '144');
INSERT INTO `barangay` VALUES ('2751', 'Macupa', '144');
INSERT INTO `barangay` VALUES ('2752', 'Mag?alwa', '144');
INSERT INTO `barangay` VALUES ('2753', 'Mag?antoy', '144');
INSERT INTO `barangay` VALUES ('2754', 'Mag?atubang', '144');
INSERT INTO `barangay` VALUES ('2755', 'Mangga', '144');
INSERT INTO `barangay` VALUES ('2756', 'Maghan?ay', '144');
INSERT INTO `barangay` VALUES ('2757', 'Marmol', '144');
INSERT INTO `barangay` VALUES ('2758', 'Molobolo', '144');
INSERT INTO `barangay` VALUES ('2759', 'Montealegre', '144');
INSERT INTO `barangay` VALUES ('2760', 'Putat', '144');
INSERT INTO `barangay` VALUES ('2761', 'San Juan', '144');
INSERT INTO `barangay` VALUES ('2762', 'Sandayong', '144');
INSERT INTO `barangay` VALUES ('2763', 'Santo Niño', '144');
INSERT INTO `barangay` VALUES ('2764', 'Siotes', '144');
INSERT INTO `barangay` VALUES ('2765', 'Sumon', '144');
INSERT INTO `barangay` VALUES ('2766', 'Tominjao', '144');
INSERT INTO `barangay` VALUES ('2767', 'Tomugpa', '144');
INSERT INTO `barangay` VALUES ('2768', 'Abangay', '57');
INSERT INTO `barangay` VALUES ('2769', 'Agsalanan ', '57');
INSERT INTO `barangay` VALUES ('2770', 'Agtatacay ', '57');
INSERT INTO `barangay` VALUES ('2771', 'Alegria ', '57');
INSERT INTO `barangay` VALUES ('2772', 'Bongloy ', '57');
INSERT INTO `barangay` VALUES ('2773', 'Buenavista ', '57');
INSERT INTO `barangay` VALUES ('2774', 'Caguyuman ', '57');
INSERT INTO `barangay` VALUES ('2775', 'Calicuang ', '57');
INSERT INTO `barangay` VALUES ('2776', 'Camambugan ', '57');
INSERT INTO `barangay` VALUES ('2777', 'Dawis ', '57');
INSERT INTO `barangay` VALUES ('2778', 'Ginalinan Nuevo ', '57');
INSERT INTO `barangay` VALUES ('2779', 'Ginalinan Viejo ', '57');
INSERT INTO `barangay` VALUES ('2780', 'Gutao ', '57');
INSERT INTO `barangay` VALUES ('2781', 'Ilajas ', '57');
INSERT INTO `barangay` VALUES ('2782', 'Libo-o ', '57');
INSERT INTO `barangay` VALUES ('2783', 'Licu-an ', '57');
INSERT INTO `barangay` VALUES ('2784', 'Lincud ', '57');
INSERT INTO `barangay` VALUES ('2785', 'Matangharon ', '57');
INSERT INTO `barangay` VALUES ('2786', 'Moroboro ', '57');
INSERT INTO `barangay` VALUES ('2787', 'Namatay ', '57');
INSERT INTO `barangay` VALUES ('2788', 'Nazuni ', '57');
INSERT INTO `barangay` VALUES ('2789', 'Pandan ', '57');
INSERT INTO `barangay` VALUES ('2790', 'Poblacion ', '57');
INSERT INTO `barangay` VALUES ('2791', 'Potolan ', '57');
INSERT INTO `barangay` VALUES ('2792', 'San Jose ', '57');
INSERT INTO `barangay` VALUES ('2793', 'San Matias ', '57');
INSERT INTO `barangay` VALUES ('2794', 'Siniba-an ', '57');
INSERT INTO `barangay` VALUES ('2795', 'Tabugon ', '57');
INSERT INTO `barangay` VALUES ('2796', 'Tambunac ', '57');
INSERT INTO `barangay` VALUES ('2797', 'Tanghawan ', '57');
INSERT INTO `barangay` VALUES ('2798', 'Tiguib ', '57');
INSERT INTO `barangay` VALUES ('2799', 'Tinocuan Tulatula-an', '57');
INSERT INTO `barangay` VALUES ('2800', ' Tulatula-an', '57');
INSERT INTO `barangay` VALUES ('2801', 'Buenavista', '145');
INSERT INTO `barangay` VALUES ('2802', 'Calmante', '145');
INSERT INTO `barangay` VALUES ('2803', 'Daan Secante', '145');
INSERT INTO `barangay` VALUES ('2804', 'General', '145');
INSERT INTO `barangay` VALUES ('2805', 'McArthur', '145');
INSERT INTO `barangay` VALUES ('2806', 'Northern Poblacion', '145');
INSERT INTO `barangay` VALUES ('2807', 'Puertobello', '145');
INSERT INTO `barangay` VALUES ('2808', 'Santander', '145');
INSERT INTO `barangay` VALUES ('2809', 'Secante Bag?o', '145');
INSERT INTO `barangay` VALUES ('2810', 'Southern Poblacion	', '145');
INSERT INTO `barangay` VALUES ('2811', '	Villahermosa', '145');
INSERT INTO `barangay` VALUES ('2812', 'Buenavista', '146');
INSERT INTO `barangay` VALUES ('2813', 'Calmante', '146');
INSERT INTO `barangay` VALUES ('2814', 'Daan Secante', '146');
INSERT INTO `barangay` VALUES ('2815', 'General', '146');
INSERT INTO `barangay` VALUES ('2816', 'McArthur', '146');
INSERT INTO `barangay` VALUES ('2817', 'Northern Poblacion	', '146');
INSERT INTO `barangay` VALUES ('2818', 'Puertobello', '146');
INSERT INTO `barangay` VALUES ('2819', 'Santander', '146');
INSERT INTO `barangay` VALUES ('2820', 'Secante Bag?o', '146');
INSERT INTO `barangay` VALUES ('2821', 'Southern Poblacion	', '146');
INSERT INTO `barangay` VALUES ('2822', 'Villahermosa', '146');
INSERT INTO `barangay` VALUES ('2823', 'Agutayan ', '58');
INSERT INTO `barangay` VALUES ('2824', 'Angare ', '58');
INSERT INTO `barangay` VALUES ('2825', 'Anjawan ', '58');
INSERT INTO `barangay` VALUES ('2826', 'Baac ', '58');
INSERT INTO `barangay` VALUES ('2827', 'Bagongbong ', '58');
INSERT INTO `barangay` VALUES ('2828', 'Balangigan ', '58');
INSERT INTO `barangay` VALUES ('2829', 'Balingasag ', '58');
INSERT INTO `barangay` VALUES ('2830', 'Banugan ', '58');
INSERT INTO `barangay` VALUES ('2831', 'Batuan ', '58');
INSERT INTO `barangay` VALUES ('2832', 'Bita ', '58');
INSERT INTO `barangay` VALUES ('2833', 'Buenavista ', '58');
INSERT INTO `barangay` VALUES ('2834', 'Bugtongan ', '58');
INSERT INTO `barangay` VALUES ('2835', 'Cabudian ', '58');
INSERT INTO `barangay` VALUES ('2836', 'Calaca-an ', '58');
INSERT INTO `barangay` VALUES ('2837', 'Calang ', '58');
INSERT INTO `barangay` VALUES ('2838', 'Calawinan ', '58');
INSERT INTO `barangay` VALUES ('2839', 'Capaycapay ', '58');
INSERT INTO `barangay` VALUES ('2840', 'Capuling ', '58');
INSERT INTO `barangay` VALUES ('2841', 'Catig ', '58');
INSERT INTO `barangay` VALUES ('2842', 'Dila-an ', '58');
INSERT INTO `barangay` VALUES ('2843', 'Fundacion ', '58');
INSERT INTO `barangay` VALUES ('2844', 'Inadlawan ', '58');
INSERT INTO `barangay` VALUES ('2845', 'Jagdong ', '58');
INSERT INTO `barangay` VALUES ('2846', 'Jaguimit ', '58');
INSERT INTO `barangay` VALUES ('2847', 'Lacadon ', '58');
INSERT INTO `barangay` VALUES ('2848', 'Luag ', '58');
INSERT INTO `barangay` VALUES ('2849', 'Malusgod ', '58');
INSERT INTO `barangay` VALUES ('2850', 'Maribuyong ', '58');
INSERT INTO `barangay` VALUES ('2851', 'Minanga ', '58');
INSERT INTO `barangay` VALUES ('2852', 'Monpon ', '58');
INSERT INTO `barangay` VALUES ('2853', 'Navalas ', '58');
INSERT INTO `barangay` VALUES ('2854', 'Pader ', '58');
INSERT INTO `barangay` VALUES ('2855', 'Pandan ', '58');
INSERT INTO `barangay` VALUES ('2856', 'Ponong Grande ', '58');
INSERT INTO `barangay` VALUES ('2857', 'Ponong Pequeño ', '58');
INSERT INTO `barangay` VALUES ('2858', 'Purog ', '58');
INSERT INTO `barangay` VALUES ('2859', 'Romblon ', '58');
INSERT INTO `barangay` VALUES ('2860', 'San Isidro ', '58');
INSERT INTO `barangay` VALUES ('2861', 'Santo Niño ', '58');
INSERT INTO `barangay` VALUES ('2862', 'Sawe ', '58');
INSERT INTO `barangay` VALUES ('2863', 'Taminla ', '58');
INSERT INTO `barangay` VALUES ('2864', 'Tinocuan ', '58');
INSERT INTO `barangay` VALUES ('2865', 'Tipolo ', '58');
INSERT INTO `barangay` VALUES ('2866', 'Poblacion A ', '58');
INSERT INTO `barangay` VALUES ('2867', 'Poblacion B ', '58');
INSERT INTO `barangay` VALUES ('2868', 'Poblacion C ', '58');
INSERT INTO `barangay` VALUES ('2869', 'Poblacion D', '58');
INSERT INTO `barangay` VALUES ('2870', 'Agus', '147');
INSERT INTO `barangay` VALUES ('2871', 'Babag', '147');
INSERT INTO `barangay` VALUES ('2872', 'Bankal', '147');
INSERT INTO `barangay` VALUES ('2873', 'Baring', '147');
INSERT INTO `barangay` VALUES ('2874', 'Basak', '147');
INSERT INTO `barangay` VALUES ('2875', 'Buaya', '147');
INSERT INTO `barangay` VALUES ('2876', 'Calawisan', '147');
INSERT INTO `barangay` VALUES ('2877', 'Canjulao', '147');
INSERT INTO `barangay` VALUES ('2878', 'Caubian', '147');
INSERT INTO `barangay` VALUES ('2879', 'Caw?oy', '147');
INSERT INTO `barangay` VALUES ('2880', 'Cawhagan', '147');
INSERT INTO `barangay` VALUES ('2881', 'Gun?ob', '147');
INSERT INTO `barangay` VALUES ('2882', 'Ibo', '147');
INSERT INTO `barangay` VALUES ('2883', 'Looc', '147');
INSERT INTO `barangay` VALUES ('2884', 'Mactan', '147');
INSERT INTO `barangay` VALUES ('2885', 'Maribago', '147');
INSERT INTO `barangay` VALUES ('2886', 'Marigondon	', '147');
INSERT INTO `barangay` VALUES ('2887', 'Pajac', '147');
INSERT INTO `barangay` VALUES ('2888', 'Pajo', '147');
INSERT INTO `barangay` VALUES ('2889', 'Pangan?an', '147');
INSERT INTO `barangay` VALUES ('2890', 'Poblacion', '147');
INSERT INTO `barangay` VALUES ('2891', 'Punta Engaño', '147');
INSERT INTO `barangay` VALUES ('2892', 'Pusok', '147');
INSERT INTO `barangay` VALUES ('2893', 'Sabang', '147');
INSERT INTO `barangay` VALUES ('2894', 'San Vicente', '147');
INSERT INTO `barangay` VALUES ('2895', 'Santa Rosa', '147');
INSERT INTO `barangay` VALUES ('2896', 'Subabasbas', '147');
INSERT INTO `barangay` VALUES ('2897', 'Talima', '147');
INSERT INTO `barangay` VALUES ('2898', 'Tingo', '147');
INSERT INTO `barangay` VALUES ('2899', 'Tungasan', '147');
INSERT INTO `barangay` VALUES ('2900', 'Bacay ', '59');
INSERT INTO `barangay` VALUES ('2901', 'Bacong ', '59');
INSERT INTO `barangay` VALUES ('2902', 'Balabag ', '59');
INSERT INTO `barangay` VALUES ('2903', 'Balud ', '59');
INSERT INTO `barangay` VALUES ('2904', 'Bantud ', '59');
INSERT INTO `barangay` VALUES ('2905', 'Bantud Fabrica ', '59');
INSERT INTO `barangay` VALUES ('2906', 'Baras ', '59');
INSERT INTO `barangay` VALUES ('2907', 'Barasan ', '59');
INSERT INTO `barangay` VALUES ('2908', 'Bolilao ', '59');
INSERT INTO `barangay` VALUES ('2909', 'Calao ', '59');
INSERT INTO `barangay` VALUES ('2910', 'Cali ', '59');
INSERT INTO `barangay` VALUES ('2911', 'Cansilayan ', '59');
INSERT INTO `barangay` VALUES ('2912', 'Capaliz ', '59');
INSERT INTO `barangay` VALUES ('2913', 'Cayos ', '59');
INSERT INTO `barangay` VALUES ('2914', 'Compayan ', '59');
INSERT INTO `barangay` VALUES ('2915', 'Dacutan ', '59');
INSERT INTO `barangay` VALUES ('2916', 'Ermita ', '59');
INSERT INTO `barangay` VALUES ('2917', 'PD Monfort South (Guinsampanan) ', '59');
INSERT INTO `barangay` VALUES ('2918', 'Ilaya 1st ', '59');
INSERT INTO `barangay` VALUES ('2919', 'Ilaya 2nd ', '59');
INSERT INTO `barangay` VALUES ('2920', 'Ilaya 3rd ', '59');
INSERT INTO `barangay` VALUES ('2921', 'Jardin ', '59');
INSERT INTO `barangay` VALUES ('2922', 'Lacturan ', '59');
INSERT INTO `barangay` VALUES ('2923', 'PD Monfort North (Lublub) ', '59');
INSERT INTO `barangay` VALUES ('2924', 'Managuit ', '59');
INSERT INTO `barangay` VALUES ('2925', 'Maquina ', '59');
INSERT INTO `barangay` VALUES ('2926', 'Nanding Lopez ', '59');
INSERT INTO `barangay` VALUES ('2927', 'Pagdugue ', '59');
INSERT INTO `barangay` VALUES ('2928', 'Paloc Bigque', '59');
INSERT INTO `barangay` VALUES ('2929', ' Paloc Sool ', '59');
INSERT INTO `barangay` VALUES ('2930', 'Patlad ', '59');
INSERT INTO `barangay` VALUES ('2931', 'Pulao ', '59');
INSERT INTO `barangay` VALUES ('2932', 'Rosario ', '59');
INSERT INTO `barangay` VALUES ('2933', 'Sapao ', '59');
INSERT INTO `barangay` VALUES ('2934', 'Sulangan ', '59');
INSERT INTO `barangay` VALUES ('2935', 'Tabucan ', '59');
INSERT INTO `barangay` VALUES ('2936', 'Talusan ', '59');
INSERT INTO `barangay` VALUES ('2937', 'Tambobo ', '59');
INSERT INTO `barangay` VALUES ('2938', 'Tamboilan ', '59');
INSERT INTO `barangay` VALUES ('2939', 'Victorias ', '59');
INSERT INTO `barangay` VALUES ('2940', 'Burgos-Regidor (Pob.) ', '59');
INSERT INTO `barangay` VALUES ('2941', 'Aurora-del Pilar (Pob.) ', '59');
INSERT INTO `barangay` VALUES ('2942', 'Buenaflor-Embarcadero (Pob.) ', '59');
INSERT INTO `barangay` VALUES ('2943', 'Lopez Jaena-Rizal (Pob.) ', '59');
INSERT INTO `barangay` VALUES ('2944', 'J.M. Basa-Mabini Bonifacio (Pob.)', '59');
INSERT INTO `barangay` VALUES ('2945', 'Lumbia (Ana Cuenca) ', '60');
INSERT INTO `barangay` VALUES ('2946', 'Bayas ', '60');
INSERT INTO `barangay` VALUES ('2947', 'Bayuyan ', '60');
INSERT INTO `barangay` VALUES ('2948', 'Botongon ', '60');
INSERT INTO `barangay` VALUES ('2949', 'Bulaqueña ', '60');
INSERT INTO `barangay` VALUES ('2950', 'Calapdan ', '60');
INSERT INTO `barangay` VALUES ('2951', 'Cano-an ', '60');
INSERT INTO `barangay` VALUES ('2952', 'Daan Banua ', '60');
INSERT INTO `barangay` VALUES ('2953', 'Daculan ', '60');
INSERT INTO `barangay` VALUES ('2954', 'Gogo ', '60');
INSERT INTO `barangay` VALUES ('2955', 'Jolog ', '60');
INSERT INTO `barangay` VALUES ('2956', 'Loguingot ', '60');
INSERT INTO `barangay` VALUES ('2957', 'Malbog ', '60');
INSERT INTO `barangay` VALUES ('2958', 'Manipulon ', '60');
INSERT INTO `barangay` VALUES ('2959', 'Pa-on ', '60');
INSERT INTO `barangay` VALUES ('2960', 'Pani-an ', '60');
INSERT INTO `barangay` VALUES ('2961', 'Poblacion Zone 1 ', '60');
INSERT INTO `barangay` VALUES ('2962', 'Lonoy (Roman Mosqueda) ', '60');
INSERT INTO `barangay` VALUES ('2963', 'San Roque ', '60');
INSERT INTO `barangay` VALUES ('2964', 'Santa Ana ', '60');
INSERT INTO `barangay` VALUES ('2965', 'Tabu-an ', '60');
INSERT INTO `barangay` VALUES ('2966', 'Tacbuyan ', '60');
INSERT INTO `barangay` VALUES ('2967', 'Tanza ', '60');
INSERT INTO `barangay` VALUES ('2968', 'Poblacion Zone II', '60');
INSERT INTO `barangay` VALUES ('2969', ' Poblacion Zone III', '60');
INSERT INTO `barangay` VALUES ('2970', 'Anono-o ', '61');
INSERT INTO `barangay` VALUES ('2971', 'Bacong ', '61');
INSERT INTO `barangay` VALUES ('2972', 'Baras ', '61');
INSERT INTO `barangay` VALUES ('2973', 'Binanua-an ', '61');
INSERT INTO `barangay` VALUES ('2974', 'Bongol San Miguel ', '61');
INSERT INTO `barangay` VALUES ('2975', 'Bongol San Vicente ', '61');
INSERT INTO `barangay` VALUES ('2976', 'Bulad ', '61');
INSERT INTO `barangay` VALUES ('2977', 'Buluangan ', '61');
INSERT INTO `barangay` VALUES ('2978', 'Cabasi ', '61');
INSERT INTO `barangay` VALUES ('2979', 'Cabubugan ', '61');
INSERT INTO `barangay` VALUES ('2980', 'Calampitao ', '61');
INSERT INTO `barangay` VALUES ('2981', 'Camangahan ', '61');
INSERT INTO `barangay` VALUES ('2982', 'Igcocolo ', '61');
INSERT INTO `barangay` VALUES ('2983', 'Iyasan ', '61');
INSERT INTO `barangay` VALUES ('2984', 'Lubacan ', '61');
INSERT INTO `barangay` VALUES ('2985', 'Nahapay ', '61');
INSERT INTO `barangay` VALUES ('2986', 'Nalundan ', '61');
INSERT INTO `barangay` VALUES ('2987', 'Nanga ', '61');
INSERT INTO `barangay` VALUES ('2988', 'Nito-an Lupsag ', '61');
INSERT INTO `barangay` VALUES ('2989', 'Particion ', '61');
INSERT INTO `barangay` VALUES ('2990', 'Sipitan-Badiang ', '61');
INSERT INTO `barangay` VALUES ('2991', 'Sta. Rosa-Laguna ', '61');
INSERT INTO `barangay` VALUES ('2992', 'Bagumbayan ', '61');
INSERT INTO `barangay` VALUES ('2993', 'Balantad-Carlos Fruto ', '61');
INSERT INTO `barangay` VALUES ('2994', 'Burgos-Gengos ', '61');
INSERT INTO `barangay` VALUES ('2995', 'Generosa-Cristobal Colon', '61');
INSERT INTO `barangay` VALUES ('2996', ' Gerona-Gimeno ', '61');
INSERT INTO `barangay` VALUES ('2997', 'Girado-Magsaysay ', '61');
INSERT INTO `barangay` VALUES ('2998', 'Gotera ', '61');
INSERT INTO `barangay` VALUES ('2999', 'Libo-on Gonzales ', '61');
INSERT INTO `barangay` VALUES ('3000', 'Pescadores ', '61');
INSERT INTO `barangay` VALUES ('3001', 'Rizal-Tuguisan ', '61');
INSERT INTO `barangay` VALUES ('3002', 'Torreblanca-Blumentritt', '61');

-- ----------------------------
-- Table structure for borrower
-- ----------------------------
DROP TABLE IF EXISTS `borrower`;
CREATE TABLE `borrower` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `profile_pic` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `suffix` varchar(255) DEFAULT NULL,
  `birthdate` date NOT NULL,
  `age` int(11) NOT NULL,
  `birthplace` varchar(255) NOT NULL,
  `address_province_id` int(11) NOT NULL,
  `address_city_municipality_id` int(11) NOT NULL,
  `address_barangay_id` int(11) NOT NULL,
  `address_street_house_no` varchar(255) NOT NULL,
  `civil_status` varchar(255) NOT NULL,
  `contact_no` varchar(255) NOT NULL,
  `canvass_date` date DEFAULT NULL,
  `tin_no` varchar(255) DEFAULT NULL,
  `sss_no` varchar(255) DEFAULT NULL,
  `ctc_no` varchar(255) DEFAULT NULL,
  `license_no` varchar(255) DEFAULT NULL,
  `spouse_name` varchar(255) DEFAULT NULL,
  `spouse_occupation` varchar(255) DEFAULT NULL,
  `spouse_age` int(11) DEFAULT NULL,
  `spouse_birthdate` date DEFAULT NULL,
  `no_dependent` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `attachment` text,
  `acount_type` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `gender` varchar(255) NOT NULL,
  `mother_name` varchar(255) DEFAULT NULL,
  `mother_age` int(11) DEFAULT NULL,
  `mother_birthdate` date DEFAULT NULL,
  `father_name` varchar(255) DEFAULT NULL,
  `father_age` int(11) DEFAULT NULL,
  `father_birthdate` date DEFAULT NULL,
  `canvass_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `borrower_ibfk_3` (`spouse_birthdate`),
  KEY `borrower_ibfk_2` (`civil_status`),
  KEY `address_province_id` (`address_province_id`),
  KEY `status` (`status`),
  KEY `address_barangay_id` (`address_barangay_id`),
  KEY `address_city_municipality_id` (`address_city_municipality_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of borrower
-- ----------------------------
INSERT INTO `borrower` VALUES ('5', 'fileupload/Russel-Dinoy-Wahing.jpg', 'Russel', 'Dinoy', 'Wahing', '', '2016-09-13', '0', 'Villaflor, Carmen, Bohol', '4', '6', '29', 'Centro 1', 'Married', '09454121', '2016-09-14', '', '', '', '', '', '', '0', null, '0', 'CA', '2', null, 'B', '2016-09-13 10:28:05', '2016-09-16 13:27:52', 'Male', '', '0', null, '', '0', null, '1');
INSERT INTO `borrower` VALUES ('6', null, 'Mary Joy', 'Asis ', 'Hinacay', '', '1990-10-10', '25', 'Guildulman, Bohol', '4', '6', '6', 'UCMA Village', 'Single', '09101737965', '2016-09-16', '', '', '', '', 'Russel Dinoy', 'Programmer', '25', '1991-06-11', '0', 'CA', '5', null, 'B', '2016-09-16 13:22:28', '2016-09-20 10:34:18', 'Female', 'Norma W. Dinoy', '36', '1980-07-22', 'Olipio T. Dinoy', '27', '1989-09-13', '2');
INSERT INTO `borrower` VALUES ('7', null, 'Joseph', 'Baldoza', 'Loso', '', '1985-07-18', '31', 'Apas, Cebu City, Cebu', '4', '6', '6', 'Kalibat', 'Married', '0945124885', '2016-09-22', '', '', '', '', 'Marlyn Baldoza', 'Teacher', '32', '1984-06-19', '3', 'CA', '4', null, 'B', '2016-09-22 14:51:45', '2016-09-22 14:51:45', 'Male', 'Mothername', '42', '1974-06-18', 'Fathername', '316', '1700-06-08', '2');
INSERT INTO `borrower` VALUES ('8', null, 'MILANILA', 'NAZARENO', 'EMBODO', '', '1980-01-06', '36', 'SIBONGA CEBU', '4', '105', '1145', 'SUMAGUAN', 'Single', '09434416589', '2016-11-02', '', '', '', '', '', '', '0', null, '1', 'CA', '2', null, 'B', '2016-09-30 09:54:26', '2016-09-30 09:54:26', 'Female', 'FELICISIMA NAZARENO', '68', '1948-08-06', 'CIRILO NAZARENO', '67', '1949-07-09', '2');
INSERT INTO `borrower` VALUES ('9', null, 'JERAME', 'FAMUAGAN', 'BANQUIL', '', '1988-12-03', '27', 'DUB-DOB, BOGO, ARGAO, CEBU', '4', '105', '1116', 'N/A', 'Single', '09273343935', '2016-08-28', '', '', '', '', '', '', '0', null, '1', 'CA', '2', null, 'B', '2016-09-30 10:05:32', '2016-09-30 10:05:32', 'Female', 'JOVENCIA FAMULAGAN BANQUIL', '52', '1964-06-01', 'LUCAS GELBOLINGO FAMULAGAN', '53', '1962-10-18', '2');
INSERT INTO `borrower` VALUES ('10', null, 'MRIA TARA', 'MONDAREZ', 'CONDE', '', '2016-08-01', '0', 'Cebu City', '4', '6', '36', '576- P. DEL ROSARIO EXT. CEBU CITY', 'Single', '09267073405', '2016-08-29', '', '', '', '', '', '', '0', null, '1', 'CA', '2', null, 'B', '2016-09-30 10:13:12', '2016-09-30 10:13:12', 'Female', '', '0', null, 'MARY ANN M. SAQUIN', '53', '1962-10-01', '2');
INSERT INTO `borrower` VALUES ('11', null, 'SPUDSCOTTIE', 'SAQUIN', 'MONDARES', '', '1992-12-31', '23', 'Cebu City', '4', '6', '36', '577- P. DEL ROSARIO EXT. CEBU CITY', 'Single', '09087659315', '1992-12-31', '', '', '', '', '', '', '0', null, '1', 'CA', '2', null, 'B', '2016-09-30 10:22:57', '2016-09-30 10:22:57', 'Male', '', '0', null, '', '0', null, '2');
INSERT INTO `borrower` VALUES ('12', null, 'SIGFRED CHRISTIAN', 'GUAREN', 'REÑA', '', '1981-05-10', '35', 'BULACAO', '4', '6', '57', '132', 'Single', '09434416589', '2016-09-30', '', '', '', '', '', '', '0', null, '1', 'CA', '2', null, 'B', '2016-09-30 10:31:31', '2016-09-30 10:31:31', 'Male', 'ASUNCION REÑA', '0', '2016-08-10', 'REYNALDO GUAREN', '52', '1964-06-10', '2');
INSERT INTO `borrower` VALUES ('13', null, 'SOFIAH STARLA', 'BAYRON ', 'FAMULAGAN', '', '2015-09-28', '1', 'DR IDELFONSO ALCANTARA MEMORIAL HOSPITAL DALAGUETE CEBU', '4', '105', '1116', 'SITIO LOWER DUB-DOB ', 'Single', '09087659315', '2016-08-29', '', '', '', '', '', '', '0', null, '1', 'CA', '2', null, 'B', '2016-09-30 10:48:09', '2016-09-30 13:23:27', 'Female', 'FAMULAGAN JERAME B', '27', '1988-12-03', 'JAMES BAYRON', '43', '1973-09-14', '1');

-- ----------------------------
-- Table structure for borrower_comaker
-- ----------------------------
DROP TABLE IF EXISTS `borrower_comaker`;
CREATE TABLE `borrower_comaker` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `borrower_id` int(11) NOT NULL,
  `comaker_id` int(11) NOT NULL,
  `relationship` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `borrower_id` (`borrower_id`),
  KEY `comaker_id` (`comaker_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of borrower_comaker
-- ----------------------------

-- ----------------------------
-- Table structure for borrower_status
-- ----------------------------
DROP TABLE IF EXISTS `borrower_status`;
CREATE TABLE `borrower_status` (
  `id` int(11) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of borrower_status
-- ----------------------------

-- ----------------------------
-- Table structure for branch
-- ----------------------------
DROP TABLE IF EXISTS `branch`;
CREATE TABLE `branch` (
  `branch_id` int(11) NOT NULL AUTO_INCREMENT,
  `branch_description` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `telephone_no` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`branch_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of branch
-- ----------------------------
INSERT INTO `branch` VALUES ('1', 'Pardo', '#6 Casa Feneza, Villamanga, Bulacao, Cebu City', '(032) 416 - 3142', '0000-00-00 00:00:00', '2016-08-16 10:33:17');
INSERT INTO `branch` VALUES ('2', 'Mandaue', '--', '(032) 414 - 3432', '0000-00-00 00:00:00', '2016-08-16 10:37:25');
INSERT INTO `branch` VALUES ('3', 'Toledo', '- ', '(032) 322 - 6165', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `branch` VALUES ('4', 'Boracay', '-', '(036) 390 - 0337', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `branch` VALUES ('5', 'Iloilo', '-', '(033) 501 - 4413', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `branch` VALUES ('6', 'Bacolod', '-', '(034) 709 - 6157', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `branch` VALUES ('9', 'Main', '#6 Casa Feneza Villamanga, Bulacao, Pardo, Cebu City', '416 - 4347', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for business
-- ----------------------------
DROP TABLE IF EXISTS `business`;
CREATE TABLE `business` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `business_name` varchar(255) NOT NULL,
  `business_type_id` int(11) NOT NULL,
  `address_province_id` int(11) NOT NULL,
  `address_city_municipality_id` int(11) NOT NULL,
  `address_barangay_id` int(11) NOT NULL,
  `address_st_bldng_no` varchar(255) NOT NULL,
  `business_years` int(11) NOT NULL,
  `permit_no` varchar(255) NOT NULL,
  `average_weekly_income` double(255,0) NOT NULL,
  `average_gross_daily_income` double(255,0) NOT NULL,
  `ownership` varchar(255) NOT NULL,
  `borrower_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `business_ibfk_5` (`borrower_id`),
  KEY `address_city_municipality_id` (`address_city_municipality_id`) USING BTREE,
  KEY `address_barangay_id` (`address_barangay_id`) USING BTREE,
  KEY `business_type_id` (`business_type_id`) USING BTREE,
  KEY `business_ibfk_6` (`address_province_id`),
  CONSTRAINT `business_ibfk_4` FOREIGN KEY (`business_type_id`) REFERENCES `business_type` (`id`) ON DELETE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=729535 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of business
-- ----------------------------
INSERT INTO `business` VALUES ('5', 'JHESS BOTIQUE', '12', '4', '105', '1116', 'N/A', '2014', '14344', '15000', '3000', 'Owned', '9');
INSERT INTO `business` VALUES ('8', 'ITBELONGS', '10', '4', '6', '24', 'Centro 1', '3', 'TIP66GFH', '15000', '25000', 'Owned', '6');
INSERT INTO `business` VALUES ('21', 'ESHOP', '10', '4', '8', '738', 'Basak III', '3', '895YTDSFS', '10000', '20000', 'Rented', '2');
INSERT INTO `business` VALUES ('70', 'CIRCLE K', '1', '4', '6', '36', '576- P. DEL ROSARIO EXT. CEBU CITY', '6', '12345', '150000', '10000', 'Owned', '10');
INSERT INTO `business` VALUES ('744', 'ESHOP', '10', '4', '6', '5', 'Basak II', '5', '897TDG9090', '20000', '40000', 'Owned', '1');
INSERT INTO `business` VALUES ('745', 'ESHOP', '2', '4', '8', '739', 'Tubigan 2', '3', 'HJFH90787', '10000', '20000', 'Owned', '3');
INSERT INTO `business` VALUES ('746', 'ESHOP', '10', '4', '6', '24', 'Basak II', '5', 'TUDG667', '10000', '10000', 'Rented', '5');
INSERT INTO `business` VALUES ('52762', 'SHOP', '4', '4', '105', '1116', 'CARLOCK ST. LAMACAN ARGAO', '12', '46666', '10000', '3000', 'Rented', '13');
INSERT INTO `business` VALUES ('729531', 'Joseph Photo Studio', '11', '4', '6', '6', 'Baklayon', '5', 'T778HHJG', '90000', '50000', 'Owned', '7');
INSERT INTO `business` VALUES ('729532', 'ICE WATER REFILLING', '25', '4', '105', '1145', 'SUMAGUAN', '1', '012456', '2000', '500', 'Owned', '8');
INSERT INTO `business` VALUES ('729533', 'SPUDSCOTTIE PARLOR', '6', '4', '6', '36', '577- P. DEL ROSARIO EXT. CEBU CITY', '5', '123456', '150000', '10000', 'Owned', '11');
INSERT INTO `business` VALUES ('729534', 'HAYAHAY RESORT', '38', '4', '129', '2085', 'SITIO CONDE', '1', '12365', '10000', '2000', 'Owned', '12');

-- ----------------------------
-- Table structure for business_type
-- ----------------------------
DROP TABLE IF EXISTS `business_type`;
CREATE TABLE `business_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `business_description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of business_type
-- ----------------------------
INSERT INTO `business_type` VALUES ('1', 'Sari-sari Store');
INSERT INTO `business_type` VALUES ('2', 'Appliance Repair');
INSERT INTO `business_type` VALUES ('3', 'Auto /  Motor Parts');
INSERT INTO `business_type` VALUES ('4', 'Auto / Motor Repair');
INSERT INTO `business_type` VALUES ('5', 'Bakery');
INSERT INTO `business_type` VALUES ('6', 'Barber Shop / Beauty Shop');
INSERT INTO `business_type` VALUES ('7', 'Bicycle Store');
INSERT INTO `business_type` VALUES ('8', 'Carenderia');
INSERT INTO `business_type` VALUES ('9', 'Carenderia / Sari-sari Store');
INSERT INTO `business_type` VALUES ('10', 'Cellphone Repair / Sales');
INSERT INTO `business_type` VALUES ('11', 'Computer Repair / Sales');
INSERT INTO `business_type` VALUES ('12', 'Dress Shop');
INSERT INTO `business_type` VALUES ('13', 'Fish Vendor / Wholesaler');
INSERT INTO `business_type` VALUES ('14', 'Flower Shop');
INSERT INTO `business_type` VALUES ('15', 'Food Vending');
INSERT INTO `business_type` VALUES ('16', 'Fruit Vendor / Wholesaler');
INSERT INTO `business_type` VALUES ('17', 'Furniture Dealer');
INSERT INTO `business_type` VALUES ('18', 'Gasoline Retailer');
INSERT INTO `business_type` VALUES ('19', 'Ice Cream / Buko Vendor');
INSERT INTO `business_type` VALUES ('20', 'Machine Shop');
INSERT INTO `business_type` VALUES ('21', 'Meat Vendor');
INSERT INTO `business_type` VALUES ('22', 'Frozen Food Supplier');
INSERT INTO `business_type` VALUES ('23', 'Pharmacy');
INSERT INTO `business_type` VALUES ('24', 'Softdrinks Distribution');
INSERT INTO `business_type` VALUES ('25', 'Water Refilling Station');
INSERT INTO `business_type` VALUES ('26', 'Rice Wholesaler');
INSERT INTO `business_type` VALUES ('27', 'RTW / Ukay-ukay Vendor');
INSERT INTO `business_type` VALUES ('28', 'Shells Craft Maker / Dealer');
INSERT INTO `business_type` VALUES ('29', 'Shoe Maker / Repair');
INSERT INTO `business_type` VALUES ('30', 'Vegetable Vendor');
INSERT INTO `business_type` VALUES ('31', 'Videoke /  Video Games / Billiard');
INSERT INTO `business_type` VALUES ('32', 'Vulcanizing Shop');
INSERT INTO `business_type` VALUES ('33', 'Tailoring');
INSERT INTO `business_type` VALUES ('34', 'Halo-halo / Sari-sari');
INSERT INTO `business_type` VALUES ('35', 'Autoload / E-Load');
INSERT INTO `business_type` VALUES ('36', 'Party Needs / Ballons');
INSERT INTO `business_type` VALUES ('37', 'Agrivet Supply');
INSERT INTO `business_type` VALUES ('38', 'Others');

-- ----------------------------
-- Table structure for canvasser
-- ----------------------------
DROP TABLE IF EXISTS `canvasser`;
CREATE TABLE `canvasser` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `middlename` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `birthdate` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `branch_id` (`branch_id`),
  CONSTRAINT `canvasser_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`branch_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of canvasser
-- ----------------------------
INSERT INTO `canvasser` VALUES ('1', 'Russel', 'Dinoy', 'Wahing', '25', '1991-09-15', 'Carmen, Bohol', '1', '2016-09-02 10:09:52', '2016-08-31 10:07:27');
INSERT INTO `canvasser` VALUES ('2', 'Benson', 'Gabutan', 'Lala', '45', '2016-08-31', 'Villamanga', '2', '2016-08-31 10:36:14', '2016-08-31 10:36:14');

-- ----------------------------
-- Table structure for ci
-- ----------------------------
DROP TABLE IF EXISTS `ci`;
CREATE TABLE `ci` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `middlename` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `birthdate` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `branch_id` (`branch_id`),
  CONSTRAINT `ci_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`branch_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ci
-- ----------------------------
INSERT INTO `ci` VALUES ('1', 'Russel ', 'Dinoy', 'Wahing', '24', '1991-09-15', 'Villaflor, Carmen, Bohol', '1', '2016-10-28 13:32:48', '2016-10-28 13:32:48');

-- ----------------------------
-- Table structure for comaker
-- ----------------------------
DROP TABLE IF EXISTS `comaker`;
CREATE TABLE `comaker` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `profile_pic` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `suffix` varchar(255) DEFAULT NULL,
  `birthdate` date NOT NULL,
  `age` int(11) NOT NULL,
  `birthplace` varchar(255) NOT NULL,
  `address_province_id` int(11) NOT NULL,
  `address_city_municipality_id` int(11) NOT NULL,
  `address_barangay_id` int(11) NOT NULL,
  `address_street_house_no` varchar(255) NOT NULL,
  `civil_status` varchar(255) NOT NULL,
  `contact_no` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `attachment` text,
  `gender` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `borrower_ibfk_2` (`civil_status`),
  KEY `address_province_id` (`address_province_id`),
  KEY `status` (`status`),
  KEY `address_barangay_id` (`address_barangay_id`),
  KEY `address_city_municipality_id` (`address_city_municipality_id`)
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of comaker
-- ----------------------------
INSERT INTO `comaker` VALUES ('87', null, 'fsdfsf', 'fsfsd', 'fsdf', null, '2016-11-17', '10', 'Carmen', '5', '12', '195', 'Banilad one', 'Single', '03126464', null, null, null, 'Male', '2016-11-03 14:05:33', '2016-11-03 14:05:33', '10', '10');

-- ----------------------------
-- Table structure for dependent
-- ----------------------------
DROP TABLE IF EXISTS `dependent`;
CREATE TABLE `dependent` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `borrower_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of dependent
-- ----------------------------
INSERT INTO `dependent` VALUES ('1', 'Carl Dinoy', '0', '2016-08-24', '1');
INSERT INTO `dependent` VALUES ('2', 'Mark Ajoc', '0', '2016-08-10', '3');
INSERT INTO `dependent` VALUES ('3', 'Glea Ajoc', '0', '2016-08-17', '3');
INSERT INTO `dependent` VALUES ('4', 'Grace Ajoc', '0', '2016-08-25', '3');
INSERT INTO `dependent` VALUES ('5', 'Josh', '16', '2000-01-16', '5');
INSERT INTO `dependent` VALUES ('6', '5454', '0', null, '4');
INSERT INTO `dependent` VALUES ('7', 'Bata 1', '26', '1990-06-19', '6');
INSERT INTO `dependent` VALUES ('8', 'Bata 2', '12', '2004-06-22', '6');
INSERT INTO `dependent` VALUES ('9', 'Bata 3', '32', '1984-09-18', '6');
INSERT INTO `dependent` VALUES ('10', 'Mark Galoso', '0', '2016-09-13', '1');
INSERT INTO `dependent` VALUES ('11', 'Child1', '121', '1895-06-20', '7');
INSERT INTO `dependent` VALUES ('12', 'Child2', '23', '1993-06-15', '7');
INSERT INTO `dependent` VALUES ('13', 'Child3', '25', '1991-07-22', '7');
INSERT INTO `dependent` VALUES ('14', 'JOHLYEN MIGUELLE NAZARENO UPHILL', '6', '2010-03-08', '8');
INSERT INTO `dependent` VALUES ('15', 'SOFIAH STARLA FAMULAGAN', '0', '2015-10-28', '9');
INSERT INTO `dependent` VALUES ('16', 'MARY ANN SAQUIN', '53', '1962-10-01', '10');
INSERT INTO `dependent` VALUES ('17', 'NICOLE SAQUIN', '0', '2016-10-09', '11');
INSERT INTO `dependent` VALUES ('18', 'ASCUNSION REÑA', '67', '1949-08-15', '12');
INSERT INTO `dependent` VALUES ('19', 'FAMULAGAN JERAME B.', '27', '1988-12-03', '13');

-- ----------------------------
-- Table structure for exceltest
-- ----------------------------
DROP TABLE IF EXISTS `exceltest`;
CREATE TABLE `exceltest` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `daily` float DEFAULT NULL,
  `term` int(11) DEFAULT NULL,
  `gross_amt` float DEFAULT NULL,
  `interest` float DEFAULT NULL,
  `vat` float DEFAULT NULL,
  `notarial` float DEFAULT NULL,
  `processing_fee` float DEFAULT NULL,
  `total_deductions` float DEFAULT NULL,
  `add_days` int(11) DEFAULT NULL,
  `add_coll` float DEFAULT NULL,
  `net_proceeds` float DEFAULT NULL,
  `penalty` float DEFAULT NULL,
  `pen_days` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of exceltest
-- ----------------------------
INSERT INTO `exceltest` VALUES ('1', '90', '52', '4230', '846', '122.67', '200', '315', '637.67', '3', '481.5', '3227.83', '15', '3');
INSERT INTO `exceltest` VALUES ('2', '100', '52', '4700', '940', '136.3', '201', '325', '662.3', '4', '635', '3732.7', '15', '3');
INSERT INTO `exceltest` VALUES ('3', '110', '52', '5170', '1034', '149.93', '202', '335', '686.93', '5', '808.5', '4257.57', '15', '3');
INSERT INTO `exceltest` VALUES ('4', '120', '52', '5640', '1128', '163.56', '203', '345', '711.56', '6', '1002', '4802.44', '15', '3');
INSERT INTO `exceltest` VALUES ('5', '130', '52', '6110', '1222', '177.19', '204', '355', '736.19', '7', '1215.5', '5367.31', '15', '3');
INSERT INTO `exceltest` VALUES ('6', '140', '52', '6580', '1316', '190.82', '205', '365', '760.82', '8', '1449', '5952.18', '15', '3');
INSERT INTO `exceltest` VALUES ('7', '150', '51', '7050', '1410', '204.45', '206', '375', '785.45', '9', '1702.5', '6557.05', '15', '3');
INSERT INTO `exceltest` VALUES ('8', '160', '51', '7520', '1504', '218.08', '207', '385', '810.08', '10', '1976', '7181.92', '15', '3');
INSERT INTO `exceltest` VALUES ('9', '170', '51', '7990', '1598', '231.71', '208', '395', '834.71', '11', '2269.5', '7826.79', '15', '3');
INSERT INTO `exceltest` VALUES ('10', '180', '51', '8460', '1692', '245.34', '209', '405', '859.34', '12', '2583', '8491.66', '15', '3');
INSERT INTO `exceltest` VALUES ('11', '190', '51', '8930', '1786', '258.97', '210', '415', '883.97', '13', '2916.5', '9176.53', '15', '3');
INSERT INTO `exceltest` VALUES ('12', '200', '51', '9400', '1880', '272.6', '211', '425', '908.6', '14', '3270', '9881.4', '15', '3');
INSERT INTO `exceltest` VALUES ('13', '220', '51', '10340', '2068', '299.86', '212', '445', '956.86', '15', '3817', '11132.1', '15', '3');
INSERT INTO `exceltest` VALUES ('14', '250', '51', '11750', '2350', '340.75', '213', '475', '1028.75', '16', '4587.5', '12958.8', '15', '3');
INSERT INTO `exceltest` VALUES ('15', '270', '51', '12690', '2538', '368.01', '214', '495', '1077.01', '17', '5224.5', '14299.5', '15', '3');
INSERT INTO `exceltest` VALUES ('16', '280', '51', '13160', '2632', '381.64', '215', '505', '1101.64', '18', '5698', '15124.4', '15', '3');
INSERT INTO `exceltest` VALUES ('17', '300', '51', '14100', '2820', '408.9', '216', '525', '1149.9', '19', '6405', '16535.1', '15', '3');
INSERT INTO `exceltest` VALUES ('18', '350', '50', '16450', '3290', '477.05', '217', '575', '1269.05', '20', '7822.5', '19713.4', '15', '3');
INSERT INTO `exceltest` VALUES ('19', '400', '50', '18800', '3760', '545.2', '218', '625', '1388.2', '21', '9340', '22991.8', '15', '3');

-- ----------------------------
-- Table structure for jumpdate
-- ----------------------------
DROP TABLE IF EXISTS `jumpdate`;
CREATE TABLE `jumpdate` (
  `jump_id` int(11) NOT NULL AUTO_INCREMENT,
  `jump_date` date NOT NULL,
  `jump_description` varchar(255) NOT NULL,
  PRIMARY KEY (`jump_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of jumpdate
-- ----------------------------
INSERT INTO `jumpdate` VALUES ('1', '2016-07-20', 'Ramadan');

-- ----------------------------
-- Table structure for loan
-- ----------------------------
DROP TABLE IF EXISTS `loan`;
CREATE TABLE `loan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `loan_no` varchar(50) NOT NULL,
  `loan_type` int(11) NOT NULL,
  `borrower` int(11) NOT NULL,
  `unit` int(11) NOT NULL,
  `release_date` date NOT NULL,
  `maturity_date` date NOT NULL,
  `daily` int(11) NOT NULL,
  `term` int(11) NOT NULL,
  `gross_amount` float NOT NULL,
  `interest_bdays` float NOT NULL,
  `gas` float NOT NULL,
  `doc_stamp` float NOT NULL,
  `misc` float NOT NULL,
  `admin_fee` float NOT NULL,
  `notarial_fee` float NOT NULL,
  `additional_fee` float NOT NULL,
  `total_deductions` float NOT NULL,
  `add_days` int(11) NOT NULL,
  `add_coll` float NOT NULL,
  `net_proceeds` float NOT NULL,
  `penalty` float NOT NULL,
  `collaterals` varchar(255) NOT NULL,
  `ci_officer` int(11) NOT NULL,
  `ci_date` date NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`,`loan_no`),
  KEY `loan_no` (`loan_no`),
  KEY `loan_type` (`loan_type`),
  KEY `loan_ibfk_2` (`unit`),
  KEY `loan_ibfk_3` (`borrower`),
  CONSTRAINT `loan_ibfk_1` FOREIGN KEY (`loan_type`) REFERENCES `loan_type` (`loan_id`) ON UPDATE CASCADE,
  CONSTRAINT `loan_ibfk_2` FOREIGN KEY (`unit`) REFERENCES `unit` (`unit_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of loan
-- ----------------------------

-- ----------------------------
-- Table structure for loanscheme
-- ----------------------------
DROP TABLE IF EXISTS `loanscheme`;
CREATE TABLE `loanscheme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `loanscheme_name` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8561417 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of loanscheme
-- ----------------------------
INSERT INTO `loanscheme` VALUES ('8561416', 'Loanscheme v.1', '2016-09-15 13:24:52', '2016-09-15 06:26:30', '10', '10');

-- ----------------------------
-- Table structure for loanscheme_assignment
-- ----------------------------
DROP TABLE IF EXISTS `loanscheme_assignment`;
CREATE TABLE `loanscheme_assignment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `loanscheme_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `loanscheme_assignment_ibfk_1` (`branch_id`),
  KEY `loanscheme_assignment_ibfk_2` (`loanscheme_id`),
  CONSTRAINT `loanscheme_assignment_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`branch_id`) ON DELETE CASCADE,
  CONSTRAINT `loanscheme_assignment_ibfk_2` FOREIGN KEY (`loanscheme_id`) REFERENCES `loanscheme` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=499350603 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of loanscheme_assignment
-- ----------------------------
INSERT INTO `loanscheme_assignment` VALUES ('807', '8561416', '6', '2016-09-15 06:13:44', '2016-09-29 14:39:17', '10', '10');
INSERT INTO `loanscheme_assignment` VALUES ('72095', '8561416', '4', '2016-09-29 14:39:17', '2016-09-29 14:39:17', '10', '10');
INSERT INTO `loanscheme_assignment` VALUES ('808087', '8561416', '5', '2016-09-15 06:13:44', '2016-09-29 14:39:17', '10', '10');
INSERT INTO `loanscheme_assignment` VALUES ('499350600', '8561416', '1', '2016-09-15 06:09:14', '2016-09-29 14:39:17', '10', '10');
INSERT INTO `loanscheme_assignment` VALUES ('499350601', '8561416', '2', '2016-09-15 06:09:14', '2016-09-29 14:39:17', '10', '10');
INSERT INTO `loanscheme_assignment` VALUES ('499350602', '8561416', '3', '2016-09-15 06:09:14', '2016-09-29 14:39:17', '10', '10');

-- ----------------------------
-- Table structure for loanscheme_values
-- ----------------------------
DROP TABLE IF EXISTS `loanscheme_values`;
CREATE TABLE `loanscheme_values` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `loanscheme_id` int(11) NOT NULL,
  `daily` float NOT NULL,
  `term` int(11) NOT NULL,
  `gross_amt` float NOT NULL,
  `interest` float NOT NULL,
  `vat` float NOT NULL,
  `admin_fee` float NOT NULL,
  `notary_fee` float NOT NULL,
  `misc` float NOT NULL,
  `doc_stamp` float NOT NULL,
  `gas` float NOT NULL,
  `total_deductions` float NOT NULL,
  `add_days` int(11) NOT NULL,
  `add_coll` float NOT NULL,
  `net_proceeds` float NOT NULL,
  `penalty` float NOT NULL,
  `pen_days` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `loanscheme_values_ibfk_1` (`loanscheme_id`),
  CONSTRAINT `loanscheme_values_ibfk_1` FOREIGN KEY (`loanscheme_id`) REFERENCES `loanscheme` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=289759287 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of loanscheme_values
-- ----------------------------
INSERT INTO `loanscheme_values` VALUES ('289759268', '8561416', '100', '51', '4566', '5000.56', '100.5', '75.56', '50.36', '150.75', '50', '50', '5477.73', '3', '1000', '7089.5', '25.5', '3', '2016-09-15 13:24:53', '2016-09-29 14:39:17', '10', '10');
INSERT INTO `loanscheme_values` VALUES ('289759269', '8561416', '120', '51', '4566', '5000.56', '100.5', '75.56', '50.36', '150.75', '50', '50', '5477.73', '3', '1000', '7089.5', '25.5', '3', '2016-09-15 13:24:53', '2016-09-29 14:39:17', '10', '10');
INSERT INTO `loanscheme_values` VALUES ('289759270', '8561416', '140', '51', '4566', '5000.56', '100.5', '75.56', '50.36', '150.75', '50', '50', '5477.73', '3', '1000', '7089.5', '25.5', '3', '2016-09-15 13:24:53', '2016-09-29 14:39:17', '10', '10');
INSERT INTO `loanscheme_values` VALUES ('289759271', '8561416', '160', '51', '4566', '5000.56', '100.5', '75.56', '50.36', '150.75', '50', '50', '5477.73', '3', '1000', '7089.5', '25.5', '3', '2016-09-15 13:24:53', '2016-09-29 14:39:17', '10', '10');
INSERT INTO `loanscheme_values` VALUES ('289759272', '8561416', '180', '51', '4566', '5000.56', '100.5', '75.56', '50.36', '150.75', '50', '50', '5477.73', '3', '1000', '7089.5', '25.5', '3', '2016-09-15 13:24:53', '2016-09-29 14:39:17', '10', '10');
INSERT INTO `loanscheme_values` VALUES ('289759273', '8561416', '200', '51', '4566', '5000.56', '100.5', '75.56', '50.36', '150.75', '50', '50', '5477.73', '3', '1000', '7089.5', '25.5', '3', '2016-09-15 13:24:53', '2016-09-29 14:39:17', '10', '10');
INSERT INTO `loanscheme_values` VALUES ('289759274', '8561416', '220', '51', '4566', '5000.56', '100.5', '75.56', '50.36', '150.75', '50', '50', '5477.73', '3', '1000', '7089.5', '25.5', '3', '2016-09-15 13:24:53', '2016-09-29 14:39:17', '10', '10');
INSERT INTO `loanscheme_values` VALUES ('289759275', '8561416', '240', '51', '4566', '5000.56', '100.5', '75.56', '50.36', '150.75', '50', '50', '5477.73', '3', '1000', '7089.5', '25.5', '3', '2016-09-15 13:24:53', '2016-09-29 14:39:17', '10', '10');
INSERT INTO `loanscheme_values` VALUES ('289759276', '8561416', '260', '51', '4566', '5000.56', '100.5', '75.56', '50.36', '150.75', '50', '50', '5477.73', '3', '1000', '7089.5', '25.5', '3', '2016-09-15 13:24:53', '2016-09-29 14:39:17', '10', '10');
INSERT INTO `loanscheme_values` VALUES ('289759277', '8561416', '280', '51', '4566', '5000.56', '100.5', '75.56', '50.36', '150.75', '50', '50', '5477.73', '3', '1000', '7089.5', '25.5', '3', '2016-09-15 13:24:53', '2016-09-29 14:39:17', '10', '10');
INSERT INTO `loanscheme_values` VALUES ('289759278', '8561416', '300', '51', '4566', '5000.56', '100.5', '75.56', '50.36', '150.75', '50', '50', '5477.73', '3', '1000', '7089.5', '25.5', '3', '2016-09-15 13:24:53', '2016-09-29 14:39:17', '10', '10');
INSERT INTO `loanscheme_values` VALUES ('289759279', '8561416', '320', '51', '4566', '5000.56', '100.5', '75.56', '50.36', '150.75', '50', '50', '5477.73', '3', '1000', '7089.5', '25.5', '3', '2016-09-15 13:24:53', '2016-09-29 14:39:17', '10', '10');
INSERT INTO `loanscheme_values` VALUES ('289759280', '8561416', '340', '51', '4566', '5000.56', '100.5', '75.56', '50.36', '150.75', '50', '50', '5477.73', '3', '1000', '7089.5', '25.5', '3', '2016-09-15 13:24:53', '2016-09-29 14:39:17', '10', '10');
INSERT INTO `loanscheme_values` VALUES ('289759281', '8561416', '360', '51', '4566', '5000.56', '100.5', '75.56', '50.36', '150.75', '50', '50', '5477.73', '3', '1000', '7089.5', '25.5', '3', '2016-09-15 13:24:53', '2016-09-29 14:39:17', '10', '10');
INSERT INTO `loanscheme_values` VALUES ('289759282', '8561416', '380', '51', '4566', '5000.56', '100.5', '75.56', '50.36', '150.75', '50', '50', '5477.73', '3', '1000', '7089.5', '25.5', '3', '2016-09-15 13:24:53', '2016-09-29 14:39:17', '10', '10');
INSERT INTO `loanscheme_values` VALUES ('289759283', '8561416', '400', '51', '4566', '5000.56', '100.5', '75.56', '50.36', '150.75', '50', '50', '5477.73', '3', '1000', '7089.5', '25.5', '3', '2016-09-15 13:24:53', '2016-09-29 14:39:17', '10', '10');
INSERT INTO `loanscheme_values` VALUES ('289759284', '8561416', '420', '51', '4566', '5000.56', '100.5', '75.56', '50.36', '150.75', '50', '50', '5477.73', '3', '1000', '7089.5', '25.5', '3', '2016-09-15 13:24:53', '2016-09-29 14:39:17', '10', '10');
INSERT INTO `loanscheme_values` VALUES ('289759285', '8561416', '440', '51', '4566', '5000.56', '100.5', '75.56', '50.36', '150.75', '50', '50', '5477.73', '3', '1000', '7089.5', '25.5', '3', '2016-09-15 13:24:53', '2016-09-29 14:39:17', '10', '10');
INSERT INTO `loanscheme_values` VALUES ('289759286', '8561416', '460', '51', '4566', '5000.56', '100.5', '75.56', '50.36', '150.75', '50', '50', '5477.73', '3', '1000', '7089.5', '25.5', '3', '2016-09-15 13:24:53', '2016-09-29 14:39:17', '10', '10');

-- ----------------------------
-- Table structure for loan_type
-- ----------------------------
DROP TABLE IF EXISTS `loan_type`;
CREATE TABLE `loan_type` (
  `loan_id` int(11) NOT NULL AUTO_INCREMENT,
  `loan_description` varchar(255) NOT NULL,
  PRIMARY KEY (`loan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of loan_type
-- ----------------------------
INSERT INTO `loan_type` VALUES ('1', 'N-CELP');
INSERT INTO `loan_type` VALUES ('2', 'PD-CELP');
INSERT INTO `loan_type` VALUES ('3', 'ERP-CELP');
INSERT INTO `loan_type` VALUES ('4', 'PO - CELP');

-- ----------------------------
-- Table structure for log
-- ----------------------------
DROP TABLE IF EXISTS `log`;
CREATE TABLE `log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `log_type` varchar(255) DEFAULT NULL,
  `log_description` varchar(255) DEFAULT NULL,
  `log_date` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `log_type` (`log_type`)
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of log
-- ----------------------------
INSERT INTO `log` VALUES ('1', 'logout', 'user logout: russel', '2016-09-15 15:20:10', '10', '9');
INSERT INTO `log` VALUES ('2', 'login', 'user login: benson', '2016-09-15 15:20:23', '20', '9');
INSERT INTO `log` VALUES ('3', 'logout', 'user logout: benson', '2016-09-15 15:21:04', '20', '9');
INSERT INTO `log` VALUES ('4', 'login', 'user login: russel', '2016-09-15 15:21:12', '10', '9');
INSERT INTO `log` VALUES ('5', 'create', 'borrower created: 6', '2016-09-16 13:22:29', '10', '9');
INSERT INTO `log` VALUES ('6', 'update', 'borrower updated: 5', '2016-09-16 13:24:57', '10', '9');
INSERT INTO `log` VALUES ('7', 'update', 'borrower updated: 5', '2016-09-16 13:27:52', '10', '9');
INSERT INTO `log` VALUES ('8', 'logout', 'user logout: russel', '2016-09-16 13:56:41', '10', '9');
INSERT INTO `log` VALUES ('9', 'login', 'user login: joseph', '2016-09-16 13:57:27', '19', '2');
INSERT INTO `log` VALUES ('10', 'logout', 'user logout: joseph', '2016-09-16 14:00:05', '19', '2');
INSERT INTO `log` VALUES ('11', 'login', 'user login: russel', '2016-09-16 14:00:17', '10', '9');
INSERT INTO `log` VALUES ('12', 'logout', 'user logout: russel', '2016-09-16 14:00:46', '10', '9');
INSERT INTO `log` VALUES ('13', 'login', 'user login: nerissa', '2016-09-16 14:00:59', '21', '9');
INSERT INTO `log` VALUES ('14', 'logout', 'user logout: nerissa', '2016-09-16 14:01:55', '21', '9');
INSERT INTO `log` VALUES ('15', 'login', 'user login: russel', '2016-09-16 14:02:08', '10', '9');
INSERT INTO `log` VALUES ('16', 'update', 'borrower updated: 6', '2016-09-16 15:57:34', '10', '9');
INSERT INTO `log` VALUES ('17', 'logout', 'user logout: russel', '2016-09-16 16:04:43', '10', '9');
INSERT INTO `log` VALUES ('18', 'login', 'user login: nerissa', '2016-09-16 16:05:01', '21', '9');
INSERT INTO `log` VALUES ('19', 'logout', 'user logout: nerissa', '2016-09-17 15:38:53', '21', '9');
INSERT INTO `log` VALUES ('20', 'login', 'user login: jing', '2016-09-17 15:39:00', '14', '2');
INSERT INTO `log` VALUES ('21', 'logout', 'user logout: jing', '2016-09-17 15:39:11', '14', '2');
INSERT INTO `log` VALUES ('22', 'login', 'user login: russel', '2016-09-17 15:39:21', '10', '9');
INSERT INTO `log` VALUES ('23', 'update', 'user update user nerissa', '2016-09-17 15:39:49', '10', '9');
INSERT INTO `log` VALUES ('24', 'logout', 'user logout: russel', '2016-09-17 15:40:01', '10', '9');
INSERT INTO `log` VALUES ('25', 'login', 'user login: nerissa', '2016-09-17 15:40:13', '21', '4');
INSERT INTO `log` VALUES ('26', 'logout', 'user logout: nerissa', '2016-09-17 15:46:50', '21', '4');
INSERT INTO `log` VALUES ('27', 'login', 'user login: joseph', '2016-09-17 15:47:02', '19', '2');
INSERT INTO `log` VALUES ('28', 'logout', 'user logout: joseph', '2016-09-19 10:32:53', '19', '2');
INSERT INTO `log` VALUES ('29', 'login', 'user login: russel', '2016-09-19 10:33:00', '10', '9');
INSERT INTO `log` VALUES ('30', 'logout', 'user logout: russel', '2016-09-19 11:32:59', '10', '9');
INSERT INTO `log` VALUES ('31', 'login', 'user login: nerissa', '2016-09-19 11:33:11', '21', '4');
INSERT INTO `log` VALUES ('32', 'logout', 'user logout: nerissa', '2016-09-19 11:33:18', '21', '4');
INSERT INTO `log` VALUES ('33', 'login', 'user login: russel', '2016-09-19 11:33:35', '10', '9');
INSERT INTO `log` VALUES ('34', 'update', 'borrower updated: 6', '2016-09-19 14:01:50', '10', '9');
INSERT INTO `log` VALUES ('35', 'update', 'borrower updated: 6', '2016-09-20 10:34:18', '10', '9');
INSERT INTO `log` VALUES ('36', 'login', 'user login: russel', '2016-09-21 10:25:55', '10', '9');
INSERT INTO `log` VALUES ('37', 'logout', 'user logout: russel', '2016-09-21 11:17:10', '10', '9');
INSERT INTO `log` VALUES ('38', 'login', 'user login: nerissa', '2016-09-21 11:17:22', '21', '4');
INSERT INTO `log` VALUES ('39', 'logout', 'user logout: nerissa', '2016-09-21 11:19:57', '21', '4');
INSERT INTO `log` VALUES ('40', 'login', 'user login: russel', '2016-09-21 11:20:04', '10', '9');
INSERT INTO `log` VALUES ('41', 'logout', 'user logout: russel', '2016-09-21 11:20:28', '10', '9');
INSERT INTO `log` VALUES ('42', 'login', 'user login: jing', '2016-09-21 11:20:40', '14', '2');
INSERT INTO `log` VALUES ('43', 'logout', 'user logout: jing', '2016-09-21 11:25:07', '14', '2');
INSERT INTO `log` VALUES ('44', 'login', 'user login: russel', '2016-09-21 11:25:14', '10', '9');
INSERT INTO `log` VALUES ('45', 'create', 'borrower created: 7', '2016-09-22 14:51:45', '10', '9');
INSERT INTO `log` VALUES ('46', 'login', 'user login: russel', '2016-09-28 14:33:32', '10', '9');
INSERT INTO `log` VALUES ('47', 'login', 'user login: russel', '2016-09-29 09:46:59', '10', '9');
INSERT INTO `log` VALUES ('48', 'login', 'user login: russel', '2016-09-29 10:18:39', '10', '9');
INSERT INTO `log` VALUES ('49', 'login', 'user login: russel', '2016-09-29 11:03:13', '10', '9');
INSERT INTO `log` VALUES ('50', 'login', 'user login: jing', '2016-09-30 09:47:09', '14', '2');
INSERT INTO `log` VALUES ('51', 'create', 'borrower created: 8', '2016-09-30 09:54:27', '14', '2');
INSERT INTO `log` VALUES ('52', 'create', 'borrower created: 9', '2016-09-30 10:05:32', '14', '2');
INSERT INTO `log` VALUES ('53', 'create', 'borrower created: 10', '2016-09-30 10:13:12', '14', '2');
INSERT INTO `log` VALUES ('54', 'create', 'borrower created: 11', '2016-09-30 10:22:58', '14', '2');
INSERT INTO `log` VALUES ('55', 'create', 'borrower created: 12', '2016-09-30 10:31:31', '14', '2');
INSERT INTO `log` VALUES ('56', 'create', 'borrower created: 13', '2016-09-30 10:48:09', '14', '2');
INSERT INTO `log` VALUES ('57', 'logout', 'user logout: jing', '2016-09-30 10:55:36', '14', '2');
INSERT INTO `log` VALUES ('58', 'login', 'user login: russel', '2016-09-30 10:55:49', '10', '9');
INSERT INTO `log` VALUES ('59', 'update', 'borrower updated: 13', '2016-09-30 13:23:28', '10', '9');
INSERT INTO `log` VALUES ('60', 'login', 'user login: russel', '2016-10-04 09:27:00', '10', '9');
INSERT INTO `log` VALUES ('61', 'logout', 'user logout: russel', '2016-10-04 17:33:42', '10', '9');
INSERT INTO `log` VALUES ('62', 'login', 'user login: russel', '2016-10-04 17:33:51', '10', '9');
INSERT INTO `log` VALUES ('63', 'login', 'user login: russel', '2016-10-05 08:58:16', '10', '9');
INSERT INTO `log` VALUES ('64', 'login', 'user login: russel', '2016-10-06 08:46:44', '10', '9');
INSERT INTO `log` VALUES ('65', 'login', 'user login: russel', '2016-10-11 15:58:07', '10', '9');
INSERT INTO `log` VALUES ('66', 'login', 'user login: russel', '2016-10-12 09:41:44', '10', '9');
INSERT INTO `log` VALUES ('67', 'login', 'user login: russel', '2016-10-18 13:40:44', '10', '9');
INSERT INTO `log` VALUES ('68', 'logout', 'user logout: russel', '2016-10-21 11:39:24', '10', '9');
INSERT INTO `log` VALUES ('69', 'login', 'user login: russel', '2016-10-21 11:39:33', '10', '9');
INSERT INTO `log` VALUES ('70', 'logout', 'user logout: russel', '2016-10-21 11:39:36', '10', '9');
INSERT INTO `log` VALUES ('71', 'login', 'user login: russel', '2016-10-21 11:40:03', '10', '9');
INSERT INTO `log` VALUES ('72', 'login', 'user login: russel', '2016-10-28 09:53:55', '10', '9');
INSERT INTO `log` VALUES ('73', 'login', 'user login: russel', '2016-11-05 09:36:34', '10', '9');
INSERT INTO `log` VALUES ('74', 'logout', 'user logout: russel', '2016-11-07 09:05:39', '10', '9');
INSERT INTO `log` VALUES ('75', 'login', 'user login: joseph', '2016-11-07 09:05:51', '19', '2');
INSERT INTO `log` VALUES ('76', 'logout', 'user logout: joseph', '2016-11-07 09:15:20', '19', '2');
INSERT INTO `log` VALUES ('77', 'login', 'user login: russel', '2016-11-07 09:15:27', '10', '9');
INSERT INTO `log` VALUES ('78', 'login', 'user login: russel', '2016-11-09 13:26:04', '10', '9');

-- ----------------------------
-- Table structure for migration
-- ----------------------------
DROP TABLE IF EXISTS `migration`;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of migration
-- ----------------------------
INSERT INTO `migration` VALUES ('m000000_000000_base', '1468285768');
INSERT INTO `migration` VALUES ('m130524_201442_init', '1468285776');
INSERT INTO `migration` VALUES ('m140506_102106_rbac_init', '1468286735');

-- ----------------------------
-- Table structure for money
-- ----------------------------
DROP TABLE IF EXISTS `money`;
CREATE TABLE `money` (
  `money_id` int(11) NOT NULL AUTO_INCREMENT,
  `money_branch` int(11) DEFAULT NULL,
  `money_unit` int(11) DEFAULT NULL,
  `money_1000` float(255,0) DEFAULT NULL,
  `money_500` float(255,0) DEFAULT NULL,
  `money_200` float(255,0) DEFAULT NULL,
  `money_100` float(255,0) DEFAULT NULL,
  `money_50` float(255,0) DEFAULT NULL,
  `money_20` float(255,0) DEFAULT NULL,
  `money_10` float(255,0) DEFAULT NULL,
  `money_coin` float(255,0) DEFAULT NULL,
  `money_bill` float(255,0) DEFAULT NULL,
  `money_total_amount` float(255,0) DEFAULT NULL,
  `money_date` date DEFAULT NULL,
  PRIMARY KEY (`money_id`),
  KEY `money_ibfk_1` (`money_branch`),
  KEY `money_unit` (`money_unit`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of money
-- ----------------------------

-- ----------------------------
-- Table structure for municipality_city
-- ----------------------------
DROP TABLE IF EXISTS `municipality_city`;
CREATE TABLE `municipality_city` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `municipality_city` varchar(255) NOT NULL,
  `province_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `province_id` (`province_id`),
  CONSTRAINT `municipality_city_ibfk_1` FOREIGN KEY (`province_id`) REFERENCES `province` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=154 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of municipality_city
-- ----------------------------
INSERT INTO `municipality_city` VALUES ('6', 'Cebu City ', '4');
INSERT INTO `municipality_city` VALUES ('7', 'Mandaue City', '4');
INSERT INTO `municipality_city` VALUES ('8', 'Talisay City', '4');
INSERT INTO `municipality_city` VALUES ('9', 'Bacolod City', '5');
INSERT INTO `municipality_city` VALUES ('10', 'Bago City', '5');
INSERT INTO `municipality_city` VALUES ('11', 'Cadiz City', '5');
INSERT INTO `municipality_city` VALUES ('12', 'Escalante City', '5');
INSERT INTO `municipality_city` VALUES ('13', 'Kabankalan City', '5');
INSERT INTO `municipality_city` VALUES ('14', 'La Carlota City', '5');
INSERT INTO `municipality_city` VALUES ('15', 'Sagay City', '5');
INSERT INTO `municipality_city` VALUES ('16', 'San Carlos City', '5');
INSERT INTO `municipality_city` VALUES ('17', 'Silay City', '5');
INSERT INTO `municipality_city` VALUES ('18', 'Sipalay City', '5');
INSERT INTO `municipality_city` VALUES ('19', 'Victorias City', '5');
INSERT INTO `municipality_city` VALUES ('20', 'Binalbagan', '5');
INSERT INTO `municipality_city` VALUES ('21', 'Calatrava', '5');
INSERT INTO `municipality_city` VALUES ('22', 'Candoni', '5');
INSERT INTO `municipality_city` VALUES ('23', 'Cauayan', '5');
INSERT INTO `municipality_city` VALUES ('24', 'Enrique Magalona', '5');
INSERT INTO `municipality_city` VALUES ('25', 'Himamaylan City', '5');
INSERT INTO `municipality_city` VALUES ('26', 'Hinigaran', '5');
INSERT INTO `municipality_city` VALUES ('27', 'Hinoban', '5');
INSERT INTO `municipality_city` VALUES ('28', 'Ilog', '5');
INSERT INTO `municipality_city` VALUES ('29', 'Isabela', '5');
INSERT INTO `municipality_city` VALUES ('30', 'La Castellana', '5');
INSERT INTO `municipality_city` VALUES ('31', 'Manapla', '5');
INSERT INTO `municipality_city` VALUES ('32', 'Moises Padilla', '5');
INSERT INTO `municipality_city` VALUES ('33', 'Murcia', '5');
INSERT INTO `municipality_city` VALUES ('34', 'Paraiso (Fabrica)', '5');
INSERT INTO `municipality_city` VALUES ('35', 'Pulupandan', '5');
INSERT INTO `municipality_city` VALUES ('36', 'Pontevedra', '5');
INSERT INTO `municipality_city` VALUES ('37', 'San Enrique', '5');
INSERT INTO `municipality_city` VALUES ('39', 'Toboso', '5');
INSERT INTO `municipality_city` VALUES ('40', 'Valladolid', '5');
INSERT INTO `municipality_city` VALUES ('41', 'Iloilo City', '6');
INSERT INTO `municipality_city` VALUES ('42', 'Passi City', '6');
INSERT INTO `municipality_city` VALUES ('43', 'Ajuy', '6');
INSERT INTO `municipality_city` VALUES ('44', 'Alimodian', '6');
INSERT INTO `municipality_city` VALUES ('45', 'Anilao', '6');
INSERT INTO `municipality_city` VALUES ('46', 'Badiangan ', '6');
INSERT INTO `municipality_city` VALUES ('47', 'Balasan', '6');
INSERT INTO `municipality_city` VALUES ('48', 'Banate', '6');
INSERT INTO `municipality_city` VALUES ('49', 'Barotac Nuevo', '6');
INSERT INTO `municipality_city` VALUES ('50', 'Barotac Viejo', '6');
INSERT INTO `municipality_city` VALUES ('51', 'Batad', '6');
INSERT INTO `municipality_city` VALUES ('52', 'Bingawan', '6');
INSERT INTO `municipality_city` VALUES ('53', 'Cabatuan', '6');
INSERT INTO `municipality_city` VALUES ('54', 'Calinog', '6');
INSERT INTO `municipality_city` VALUES ('55', 'Carles', '6');
INSERT INTO `municipality_city` VALUES ('56', 'Concepcion', '6');
INSERT INTO `municipality_city` VALUES ('57', 'Dingle', '6');
INSERT INTO `municipality_city` VALUES ('58', 'Dueñas', '6');
INSERT INTO `municipality_city` VALUES ('59', 'Dumangas', '6');
INSERT INTO `municipality_city` VALUES ('60', 'Estancia', '6');
INSERT INTO `municipality_city` VALUES ('61', 'Guimbal', '6');
INSERT INTO `municipality_city` VALUES ('62', 'Igbaras', '6');
INSERT INTO `municipality_city` VALUES ('63', 'Janiuay', '6');
INSERT INTO `municipality_city` VALUES ('64', 'Lambunao ', '6');
INSERT INTO `municipality_city` VALUES ('65', 'Leganes ', '6');
INSERT INTO `municipality_city` VALUES ('66', 'Lemery', '6');
INSERT INTO `municipality_city` VALUES ('67', ' Leon', '6');
INSERT INTO `municipality_city` VALUES ('68', 'Maasin ', '6');
INSERT INTO `municipality_city` VALUES ('69', 'Miagao ', '6');
INSERT INTO `municipality_city` VALUES ('70', 'Mina ', '6');
INSERT INTO `municipality_city` VALUES ('71', 'New Lucena ', '6');
INSERT INTO `municipality_city` VALUES ('72', 'Oton', '6');
INSERT INTO `municipality_city` VALUES ('73', ' Pavia ', '6');
INSERT INTO `municipality_city` VALUES ('74', 'Pototan ', '6');
INSERT INTO `municipality_city` VALUES ('75', 'San Dionisio', '6');
INSERT INTO `municipality_city` VALUES ('76', ' San Enrique', '6');
INSERT INTO `municipality_city` VALUES ('77', ' San Joaquin', '6');
INSERT INTO `municipality_city` VALUES ('78', ' San Miguel ', '6');
INSERT INTO `municipality_city` VALUES ('79', 'San Rafael ', '6');
INSERT INTO `municipality_city` VALUES ('80', 'Santa Barbara', '6');
INSERT INTO `municipality_city` VALUES ('81', ' Sara ', '6');
INSERT INTO `municipality_city` VALUES ('82', 'Tigbauan ', '6');
INSERT INTO `municipality_city` VALUES ('83', 'Tubungan', '6');
INSERT INTO `municipality_city` VALUES ('84', ' Zarraga', '6');
INSERT INTO `municipality_city` VALUES ('85', ' Altavas', '7');
INSERT INTO `municipality_city` VALUES ('86', ' Balete ', '7');
INSERT INTO `municipality_city` VALUES ('87', 'Banga ', '7');
INSERT INTO `municipality_city` VALUES ('88', 'Batan ', '7');
INSERT INTO `municipality_city` VALUES ('89', 'Buruanga', '7');
INSERT INTO `municipality_city` VALUES ('90', ' Ibajay ', '7');
INSERT INTO `municipality_city` VALUES ('91', 'Kalibo', '7');
INSERT INTO `municipality_city` VALUES ('92', ' Lezo ', '7');
INSERT INTO `municipality_city` VALUES ('93', 'Libacao ', '7');
INSERT INTO `municipality_city` VALUES ('94', 'Madalag ', '7');
INSERT INTO `municipality_city` VALUES ('95', 'Makato ', '7');
INSERT INTO `municipality_city` VALUES ('96', 'Malay', '7');
INSERT INTO `municipality_city` VALUES ('97', ' Malinao ', '7');
INSERT INTO `municipality_city` VALUES ('98', 'Nabas', '7');
INSERT INTO `municipality_city` VALUES ('99', ' New Washington ', '7');
INSERT INTO `municipality_city` VALUES ('100', 'Numancia', '7');
INSERT INTO `municipality_city` VALUES ('101', ' Tangalan', '7');
INSERT INTO `municipality_city` VALUES ('102', 'Alcantara', '4');
INSERT INTO `municipality_city` VALUES ('103', 'Alcoy', '4');
INSERT INTO `municipality_city` VALUES ('104', 'Aloguinsan', '4');
INSERT INTO `municipality_city` VALUES ('105', 'Argao', '4');
INSERT INTO `municipality_city` VALUES ('106', 'Asturias', '4');
INSERT INTO `municipality_city` VALUES ('107', 'Badian', '4');
INSERT INTO `municipality_city` VALUES ('108', 'Balamban', '4');
INSERT INTO `municipality_city` VALUES ('109', 'Bantayan', '4');
INSERT INTO `municipality_city` VALUES ('110', 'Barili', '4');
INSERT INTO `municipality_city` VALUES ('111', 'Boljoon', '4');
INSERT INTO `municipality_city` VALUES ('112', 'Borbon', '4');
INSERT INTO `municipality_city` VALUES ('113', 'Carmen', '4');
INSERT INTO `municipality_city` VALUES ('114', 'Catmon', '4');
INSERT INTO `municipality_city` VALUES ('116', 'Compostela', '4');
INSERT INTO `municipality_city` VALUES ('117', 'Consolacion', '4');
INSERT INTO `municipality_city` VALUES ('118', 'Cordova', '4');
INSERT INTO `municipality_city` VALUES ('119', 'Daanbantayan', '4');
INSERT INTO `municipality_city` VALUES ('120', 'Dalaguete', '4');
INSERT INTO `municipality_city` VALUES ('121', 'Dumanjug', '4');
INSERT INTO `municipality_city` VALUES ('122', 'Ginatilan', '4');
INSERT INTO `municipality_city` VALUES ('123', 'Liloan', '4');
INSERT INTO `municipality_city` VALUES ('124', 'Madridejos', '4');
INSERT INTO `municipality_city` VALUES ('125', 'Malabuyoc', '4');
INSERT INTO `municipality_city` VALUES ('126', 'Medellin', '4');
INSERT INTO `municipality_city` VALUES ('127', 'Minglanilla', '4');
INSERT INTO `municipality_city` VALUES ('128', 'Moalboal', '4');
INSERT INTO `municipality_city` VALUES ('129', 'Oslob', '4');
INSERT INTO `municipality_city` VALUES ('130', 'Pilar', '4');
INSERT INTO `municipality_city` VALUES ('131', 'Pinamungajan', '4');
INSERT INTO `municipality_city` VALUES ('132', 'Poro', '4');
INSERT INTO `municipality_city` VALUES ('133', 'Ronda', '4');
INSERT INTO `municipality_city` VALUES ('134', 'Samboan', '4');
INSERT INTO `municipality_city` VALUES ('135', 'San Fernando', '4');
INSERT INTO `municipality_city` VALUES ('136', 'San Francisco', '4');
INSERT INTO `municipality_city` VALUES ('137', 'San Remigio', '4');
INSERT INTO `municipality_city` VALUES ('138', 'Santa Fe', '4');
INSERT INTO `municipality_city` VALUES ('139', 'Santander', '4');
INSERT INTO `municipality_city` VALUES ('140', 'Sibonga', '4');
INSERT INTO `municipality_city` VALUES ('141', 'Sogod', '4');
INSERT INTO `municipality_city` VALUES ('142', 'Tabogon', '4');
INSERT INTO `municipality_city` VALUES ('143', 'Tabuelan', '4');
INSERT INTO `municipality_city` VALUES ('144', 'Tuburan', '4');
INSERT INTO `municipality_city` VALUES ('145', 'Tudela', '4');
INSERT INTO `municipality_city` VALUES ('146', 'Catmon', '4');
INSERT INTO `municipality_city` VALUES ('147', 'Lapu-Lapu', '4');
INSERT INTO `municipality_city` VALUES ('148', 'Naga City', '4');
INSERT INTO `municipality_city` VALUES ('150', 'Toledo', '4');
INSERT INTO `municipality_city` VALUES ('152', 'Carcar City', '4');
INSERT INTO `municipality_city` VALUES ('153', 'Danao City', '4');

-- ----------------------------
-- Table structure for payment
-- ----------------------------
DROP TABLE IF EXISTS `payment`;
CREATE TABLE `payment` (
  `pay_id` int(11) NOT NULL AUTO_INCREMENT,
  `loan_no` varchar(255) DEFAULT NULL,
  `pay_amount` varchar(255) DEFAULT NULL,
  `pay_date` date DEFAULT NULL,
  `money` int(11) DEFAULT NULL,
  PRIMARY KEY (`pay_id`),
  KEY `loan_no` (`loan_no`),
  KEY `payment_ibfk_2` (`money`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of payment
-- ----------------------------

-- ----------------------------
-- Table structure for province
-- ----------------------------
DROP TABLE IF EXISTS `province`;
CREATE TABLE `province` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `province` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of province
-- ----------------------------
INSERT INTO `province` VALUES ('4', 'Cebu');
INSERT INTO `province` VALUES ('5', 'Negros Occidental');
INSERT INTO `province` VALUES ('6', 'Iloilo');
INSERT INTO `province` VALUES ('7', 'Aklan ');

-- ----------------------------
-- Table structure for status
-- ----------------------------
DROP TABLE IF EXISTS `status`;
CREATE TABLE `status` (
  `code` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of status
-- ----------------------------
INSERT INTO `status` VALUES ('A', 'Approved');
INSERT INTO `status` VALUES ('C', 'Canvassed');

-- ----------------------------
-- Table structure for tag
-- ----------------------------
DROP TABLE IF EXISTS `tag`;
CREATE TABLE `tag` (
  `tag_id` int(11) NOT NULL AUTO_INCREMENT,
  `borrower` int(11) DEFAULT NULL,
  `tag_description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tag
-- ----------------------------

-- ----------------------------
-- Table structure for unit
-- ----------------------------
DROP TABLE IF EXISTS `unit`;
CREATE TABLE `unit` (
  `unit_id` int(11) NOT NULL AUTO_INCREMENT,
  `unit_description` varchar(255) NOT NULL,
  `branch_id` int(11) NOT NULL,
  PRIMARY KEY (`unit_id`),
  KEY `unit_ibfk_1` (`branch_id`),
  CONSTRAINT `unit_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`branch_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of unit
-- ----------------------------
INSERT INTO `unit` VALUES ('1', 'A1', '1');
INSERT INTO `unit` VALUES ('2', 'A2', '1');
INSERT INTO `unit` VALUES ('3', 'A3', '1');
INSERT INTO `unit` VALUES ('4', 'A4', '1');
INSERT INTO `unit` VALUES ('5', 'A5', '1');
INSERT INTO `unit` VALUES ('6', 'B1', '2');
INSERT INTO `unit` VALUES ('7', 'B2', '2');
INSERT INTO `unit` VALUES ('8', 'B3', '2');
INSERT INTO `unit` VALUES ('9', 'B4', '2');
INSERT INTO `unit` VALUES ('10', 'B5', '2');
INSERT INTO `unit` VALUES ('11', 'T1', '3');
INSERT INTO `unit` VALUES ('12', 'T2', '3');
INSERT INTO `unit` VALUES ('13', 'T3', '3');
INSERT INTO `unit` VALUES ('14', 'T4', '3');
INSERT INTO `unit` VALUES ('15', 'M1', '4');
INSERT INTO `unit` VALUES ('16', 'M2', '4');
INSERT INTO `unit` VALUES ('17', 'M3', '4');
INSERT INTO `unit` VALUES ('18', 'I1', '5');
INSERT INTO `unit` VALUES ('19', 'I2', '5');
INSERT INTO `unit` VALUES ('20', 'I3', '5');
INSERT INTO `unit` VALUES ('21', 'N1', '6');
INSERT INTO `unit` VALUES ('22', 'N2', '6');
INSERT INTO `unit` VALUES ('23', 'N3', '6');
INSERT INTO `unit` VALUES ('24', 'N4', '6');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `firstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `middlename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `birthdate` date NOT NULL,
  `age` int(11) NOT NULL,
  `civil_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `home_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sss_no` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `philhealth_no` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tin_no` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `temp_pass` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('10', 'russel', 'mqNUgibbYOLDjA5iyWV1BTb-p2K4exo4', '$2y$13$EeRlMjA1q3Ypd5uVUqiq/eFhAbFne3t3gM5FKHyQEqrHVXmU9.tYK', null, 'dinoyrussel@gmail.com', '10', '1469146040', '2147483647', '9', 'Russel', 'Dinoy', 'Wahing', '1991-09-15', '24', 'Single', 'Male', 'Villaflor, Carmen, Bohol', '', '', '', '09101737965', 'fileupload/Dinoy-Russel-Wahing-1991-09-15-photo.jpg', 'russel12345');
INSERT INTO `user` VALUES ('14', 'jing', 'S6ho-6mlzqAinnEbrEl-IUpPvitouxAs', '$2y$13$QPkWtz.QIqwp9fNKMgwhPeyQNkjwAwoV5fhTt5dt1I7r6Zv6gQvQK', null, 'jing@gmail.com', '10', '1469586014', '2147483647', '2', 'Jingjing', 'Ahmmm', 'Hayyy', '0000-00-00', '25', 'Married', 'Female', 'Cebu City', '', '', '', '0956455528', 'fileupload/Ahmmm-Jingjing-Hayyy-0000-00-00-photo.jpg', 'jing12345');
INSERT INTO `user` VALUES ('19', 'joseph', 'Z2Xa7HjImN5hSgkW0miuGZHqjNDNkTiH', '$2y$13$YcSTNoQ.RqYOkLadjeXYnu82m/taDcPEi357Qq8HhJAdfzNgqwpwu', null, 'josephbaldoza@gmail.com', '10', '2147483647', '2147483647', '2', 'Joseph', 'Baldoza', 'Gonzales', '2016-08-09', '35', 'Married', 'Male', 'Apas, Cebu city', '', '', '', '099945854', 'fileupload/Baldoza-Joseph-Gonzales-2016-08-09-photo.jpg', 'joseph12345');
INSERT INTO `user` VALUES ('20', 'benson', 'okXq3CyxsI3tehq8_0pNIvCEGEIslMvu', '$2y$13$Rpy4XaDJt635P1LGEbczFu0g8qyV0bLZFGBkUNKYY7g2bXxHXMvGS', null, 'benson@gmail.com', '10', '2147483647', '2147483647', '9', 'Robinson', 'Gabutan', 'Wills', '2016-08-23', '30', 'Married', 'Male', 'Guadalupe, Cebu city', '', '', '', '0000000000', 'fileupload/Gabutan-Robinson-Wills-2016-08-23-photo.jpg', 'benson12345');
INSERT INTO `user` VALUES ('21', 'nerissa', '5srvcmU6cJ-npS6mL1w6BNO3syZbgR-D', '$2y$13$4oUzKlOwRgLx9SG6YYzyTu67Iw1NDmffda6AD0ABv9xjBWmAWSGUi', null, 'nerissa@gmail.com', '10', '2147483647', '2147483647', '4', 'Nerissa', 'Sayson', 'Hmmm', '2016-08-31', '25', 'Single', 'Female', 'Mambaling Cebu City', '345634563', '3413453', '345345354', '099451224', 'fileupload/Sayson-Nerissa-Hmmm-2016-08-31-photo.jpg', 'nerissa12345');
