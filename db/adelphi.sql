/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : adelphi

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2016-08-31 16:40:10
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
  CONSTRAINT `barangay_ibfk_1` FOREIGN KEY (`municipality_city_id`) REFERENCES `municipality_city` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of barangay
-- ----------------------------
INSERT INTO `barangay` VALUES ('1', 'Villaflor', '1');
INSERT INTO `barangay` VALUES ('2', 'Alegria', '1');
INSERT INTO `barangay` VALUES ('3', 'Nueva Fuerza', '1');
INSERT INTO `barangay` VALUES ('4', 'Lahug', '6');
INSERT INTO `barangay` VALUES ('5', 'Apas', '6');

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
  KEY `address_city_municipality_id` (`address_city_municipality_id`),
  CONSTRAINT `borrower_ibfk_1` FOREIGN KEY (`address_province_id`) REFERENCES `province` (`id`),
  CONSTRAINT `borrower_ibfk_5` FOREIGN KEY (`address_barangay_id`) REFERENCES `barangay` (`id`),
  CONSTRAINT `borrower_ibfk_6` FOREIGN KEY (`address_city_municipality_id`) REFERENCES `municipality_city` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of borrower
-- ----------------------------
INSERT INTO `borrower` VALUES ('1', 'fileupload/Mary  Joy-Asis-Hinacay.jpg', 'Mary', 'Asiss', 'Hinacay', '', '2016-10-10', '23', 'Guindulman', '4', '6', '4', 'Centro 1', 'Married', '0999545122', '2016-08-16', '', '', '', '', 'Russel Dinoy', 'IT Programmer', '24', '2016-08-31', '1', 'A', '2', 'fileupload/2016-10-10-Asis-Mary  Joy-Hinacay-attachment0.jpg;fileupload/2016-10-10-Asis-Mary  Joy-Hinacay-attachment1.jpg;fileupload/2016-10-10-Asis-Mary  Joy-Hinacay-attachment2.jpg', 'B', '2016-08-26 13:31:18', '2016-08-31 14:06:12', 'Female', 'Norma W. Dinoy', '60', '2016-08-17', 'Olipio T. Dinoy', '56', '2016-08-16', '2');
INSERT INTO `borrower` VALUES ('2', 'fileupload/Anna Mae-Casol-Lilyoso.jpg', 'Anna Mae', 'Casol', 'Lilyoso', '', '2016-08-17', '20', 'Villaflor, Carmen, Bohol', '3', '1', '1', 'Centro 2', 'Single', '0999144456', '2016-08-17', '', '', '', '', '', '', null, null, '0', 'A', '1', null, 'B', '2016-08-30 13:18:50', '2016-08-31 14:57:49', 'Female', '', null, null, '', null, null, '2');
INSERT INTO `borrower` VALUES ('3', 'fileupload/robert-ajoc-buro.jpg', 'Robert', 'Ajoc', 'Buro', '', '2016-08-18', '25', 'Villaflor, Carmen, Bohol', '3', '1', '1', 'Centro 1', 'Married', '095565521', '2016-08-09', '989865656', '54565651321', '4548653465', '4165431345', 'Ruth Lagria', 'Farmer', '54', '2016-08-23', '3', 'A', '3', 'fileupload/2016-08-18-ajoc-robert-buro-attachment0.jpg;fileupload/2016-08-18-ajoc-robert-buro-attachment1.jpg;fileupload/2016-08-18-ajoc-robert-buro-attachment2.jpg', 'B', '2016-08-31 14:43:16', '2016-08-31 14:44:29', 'Male', 'Marciano Ajoc', '60', '2016-08-31', 'Ligaya Ajoc', '56', '2016-08-24', '2');

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
-- Table structure for branch_loanscheme
-- ----------------------------
DROP TABLE IF EXISTS `branch_loanscheme`;
CREATE TABLE `branch_loanscheme` (
  `branch_loanscheme_id` int(11) NOT NULL,
  `loanscheme` int(11) NOT NULL,
  `branch` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `date_updated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`branch_loanscheme_id`),
  KEY `branch_loanscheme_ibfk_1` (`loanscheme`),
  KEY `branch_loanscheme_ibfk_2` (`branch`),
  CONSTRAINT `branch_loanscheme_ibfk_1` FOREIGN KEY (`loanscheme`) REFERENCES `loan_scheme` (`loan_scheme_id`) ON UPDATE CASCADE,
  CONSTRAINT `branch_loanscheme_ibfk_2` FOREIGN KEY (`branch`) REFERENCES `branch` (`branch_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of branch_loanscheme
-- ----------------------------

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
  KEY `address_province_id` (`address_province_id`),
  KEY `address_city_municipality_id` (`address_city_municipality_id`),
  KEY `address_barangay_id` (`address_barangay_id`),
  KEY `business_type_id` (`business_type_id`),
  KEY `business_ibfk_5` (`borrower_id`),
  CONSTRAINT `business_ibfk_1` FOREIGN KEY (`address_province_id`) REFERENCES `province` (`id`),
  CONSTRAINT `business_ibfk_2` FOREIGN KEY (`address_city_municipality_id`) REFERENCES `municipality_city` (`id`),
  CONSTRAINT `business_ibfk_3` FOREIGN KEY (`address_barangay_id`) REFERENCES `barangay` (`id`),
  CONSTRAINT `business_ibfk_4` FOREIGN KEY (`business_type_id`) REFERENCES `business_type` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3285 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of business
-- ----------------------------
INSERT INTO `business` VALUES ('1', 'DinzDev', '1', '3', '1', '1', 'Centro 1', '3', '999999', '10000', '20000', 'Owned', '1');
INSERT INTO `business` VALUES ('3', 'Casol Sari-sari Store', '1', '3', '1', '1', 'Suba 2', '5', '98878454845', '10000', '10000', 'Owned', '2');
INSERT INTO `business` VALUES ('7', 'Baldoza Store', '1', '4', '6', '5', 'Lakaw 1 ', '5', '898589', '10000', '30000', 'Rented', '3');
INSERT INTO `business` VALUES ('50', 'IT FERM', '1', '3', '1', '1', 'Suba 2', '3', '698584545', '20000', '10000000', 'Owned', '1');
INSERT INTO `business` VALUES ('3284', 'Tindahan Ni Opaw', '1', '3', '1', '1', 'Poblacion Sur.', '5', 'uyuyt646jg4hj', '10500', '11000', 'Rented', '3');

-- ----------------------------
-- Table structure for business_type
-- ----------------------------
DROP TABLE IF EXISTS `business_type`;
CREATE TABLE `business_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `business_description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of business_type
-- ----------------------------
INSERT INTO `business_type` VALUES ('1', 'Sari-sari Store');

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
INSERT INTO `canvasser` VALUES ('1', 'Russel', 'Dinoy', 'Wahing', '25', '1991-09-15', 'Carmen, Bohol', '2', '2016-08-31 10:07:27', '2016-08-31 10:07:27');
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ci
-- ----------------------------

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of dependent
-- ----------------------------
INSERT INTO `dependent` VALUES ('1', 'Carl Dinoy', '8', '2016-08-24', '1');
INSERT INTO `dependent` VALUES ('2', 'Mark Ajoc', '12', '2016-08-10', '3');
INSERT INTO `dependent` VALUES ('3', 'Glea Ajoc', '14', '2016-08-17', '3');
INSERT INTO `dependent` VALUES ('4', 'Grace Ajoc', '10', '2016-08-25', '3');

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
  `loan_id` int(11) NOT NULL AUTO_INCREMENT,
  `loan_no` varchar(255) NOT NULL,
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
  PRIMARY KEY (`loan_id`,`loan_no`),
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
-- Table structure for loanscheme_type
-- ----------------------------
DROP TABLE IF EXISTS `loanscheme_type`;
CREATE TABLE `loanscheme_type` (
  `loanscheme_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `type_description` varchar(255) NOT NULL,
  `created_date` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_date` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`loanscheme_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of loanscheme_type
-- ----------------------------
INSERT INTO `loanscheme_type` VALUES ('1', 'default', '2016-07-15 13:49:00', '2016-07-15 13:49:05');

-- ----------------------------
-- Table structure for loan_scheme
-- ----------------------------
DROP TABLE IF EXISTS `loan_scheme`;
CREATE TABLE `loan_scheme` (
  `loan_scheme_id` int(11) NOT NULL AUTO_INCREMENT,
  `loanscheme_type` int(11) NOT NULL,
  `daily` float NOT NULL,
  `term` int(11) NOT NULL,
  `gross_day` int(11) NOT NULL,
  `gross_amount` float NOT NULL,
  `interest` float(11,0) NOT NULL,
  `interest_amount` float NOT NULL,
  `gas` float NOT NULL,
  `doc_percentage` float NOT NULL,
  `doc_stamp` float NOT NULL,
  `mis_percentage` float NOT NULL,
  `misc` float NOT NULL,
  `admin_fee` float NOT NULL,
  `notarial_fee` float NOT NULL,
  `additional_fee` float NOT NULL,
  `total_deductions` float NOT NULL,
  `add_days` float NOT NULL,
  `add_coll` float NOT NULL,
  `net_proceeds` float NOT NULL,
  `penalty` float NOT NULL,
  `vat_interest` float NOT NULL,
  `vat_amount` float NOT NULL,
  `processing_fee` float NOT NULL,
  PRIMARY KEY (`loan_scheme_id`),
  KEY `loan_scheme_ibfk_1` (`loanscheme_type`),
  CONSTRAINT `loan_scheme_ibfk_1` FOREIGN KEY (`loanscheme_type`) REFERENCES `loanscheme_type` (`loanscheme_type_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of loan_scheme
-- ----------------------------
INSERT INTO `loan_scheme` VALUES ('1', '1', '50', '52', '47', '2350', '20', '470', '50', '0.5', '11.75', '2.4', '56.4', '175', '150', '50', '493.15', '4', '200', '1586.85', '15', '14.5', '68.15', '275');
INSERT INTO `loan_scheme` VALUES ('2', '1', '6000', '50', '47', '282000', '20', '56400', '50', '0.5', '1410', '2.4', '6768', '175', '300', '6000', '14703', '2', '12000', '222897', '900', '14.5', '8178', '6225');

-- ----------------------------
-- Table structure for loan_type
-- ----------------------------
DROP TABLE IF EXISTS `loan_type`;
CREATE TABLE `loan_type` (
  `loan_id` int(11) NOT NULL AUTO_INCREMENT,
  `loan_description` varchar(255) NOT NULL,
  PRIMARY KEY (`loan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of loan_type
-- ----------------------------
INSERT INTO `loan_type` VALUES ('1', 'N-CELP');
INSERT INTO `loan_type` VALUES ('2', 'PD-CELP');

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
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of log
-- ----------------------------
INSERT INTO `log` VALUES ('1', 'logout', 'user logout: russel', '2016-08-25 13:29:55', '10', '9');
INSERT INTO `log` VALUES ('2', 'login', 'user login: russel', '2016-08-25 13:30:05', '10', '9');
INSERT INTO `log` VALUES ('3', 'logout', 'user logout: russel', '2016-08-25 14:06:44', '10', '9');
INSERT INTO `log` VALUES ('4', 'login', 'user login: benson', '2016-08-25 14:07:00', '20', '1');
INSERT INTO `log` VALUES ('5', 'logout', 'user logout: benson', '2016-08-25 14:07:37', '20', '1');
INSERT INTO `log` VALUES ('6', 'login', 'user login: russel', '2016-08-25 14:07:47', '10', '9');
INSERT INTO `log` VALUES ('7', 'login', 'user login: russel', '2016-08-26 09:03:27', '10', '9');
INSERT INTO `log` VALUES ('8', 'create', 'borrower created: 5', '2016-08-26 13:29:51', '10', '9');
INSERT INTO `log` VALUES ('9', 'create', 'borrower created: 1', '2016-08-26 13:31:18', '10', '9');
INSERT INTO `log` VALUES ('10', 'update', 'borrower updated: 1', '2016-08-26 13:52:06', '10', '9');
INSERT INTO `log` VALUES ('11', 'update', 'borrower updated: 1', '2016-08-26 14:44:04', '10', '9');
INSERT INTO `log` VALUES ('12', 'update', 'borrower updated: 1', '2016-08-26 14:50:15', '10', '9');
INSERT INTO `log` VALUES ('13', 'login', 'user login: russel', '2016-08-30 08:33:42', '10', '9');
INSERT INTO `log` VALUES ('14', 'login', 'user login: russel', '2016-08-30 10:43:31', '10', '9');
INSERT INTO `log` VALUES ('15', 'update', 'borrower updated: 1', '2016-08-30 11:19:56', '10', '9');
INSERT INTO `log` VALUES ('16', 'update', 'borrower updated: 1', '2016-08-30 11:25:06', '10', '9');
INSERT INTO `log` VALUES ('17', 'update', 'borrower updated: 1', '2016-08-30 11:27:39', '10', '9');
INSERT INTO `log` VALUES ('18', 'update', 'borrower updated: 1', '2016-08-30 11:36:57', '10', '9');
INSERT INTO `log` VALUES ('19', 'update', 'borrower updated: 1', '2016-08-30 11:42:03', '10', '9');
INSERT INTO `log` VALUES ('20', 'logout', 'user logout: russel', '2016-08-30 12:00:00', '10', '9');
INSERT INTO `log` VALUES ('21', 'login', 'user login: jing', '2016-08-30 12:00:08', '14', '2');
INSERT INTO `log` VALUES ('22', 'logout', 'user logout: jing', '2016-08-30 12:00:16', '14', '2');
INSERT INTO `log` VALUES ('23', 'login', 'user login: russel', '2016-08-30 12:00:35', '10', '9');
INSERT INTO `log` VALUES ('24', 'logout', 'user logout: russel', '2016-08-30 12:00:51', '10', '9');
INSERT INTO `log` VALUES ('25', 'login', 'user login: jing', '2016-08-30 12:00:58', '14', '2');
INSERT INTO `log` VALUES ('26', 'create', 'borrower created: 2', '2016-08-30 13:18:50', '14', '2');
INSERT INTO `log` VALUES ('27', 'logout', 'user logout: jing', '2016-08-30 13:35:38', '14', '2');
INSERT INTO `log` VALUES ('28', 'login', 'user login: russel', '2016-08-30 13:35:46', '10', '9');
INSERT INTO `log` VALUES ('29', 'logout', 'user logout: russel', '2016-08-30 13:39:38', '10', '9');
INSERT INTO `log` VALUES ('30', 'login', 'user login: jing', '2016-08-30 13:39:46', '14', '2');
INSERT INTO `log` VALUES ('31', 'logout', 'user logout: jing', '2016-08-30 13:39:53', '14', '2');
INSERT INTO `log` VALUES ('32', 'login', 'user login: russel', '2016-08-30 13:40:01', '10', '9');
INSERT INTO `log` VALUES ('33', 'logout', 'user logout: russel', '2016-08-30 13:41:33', '10', '9');
INSERT INTO `log` VALUES ('34', 'login', 'user login: benson', '2016-08-30 13:41:43', '20', '1');
INSERT INTO `log` VALUES ('35', 'logout', 'user logout: benson', '2016-08-30 13:41:58', '20', '1');
INSERT INTO `log` VALUES ('36', 'login', 'user login: russel', '2016-08-30 13:42:06', '10', '9');
INSERT INTO `log` VALUES ('37', 'logout', 'user logout: russel', '2016-08-30 13:44:05', '10', '9');
INSERT INTO `log` VALUES ('38', 'login', 'user login: jing', '2016-08-30 13:44:12', '14', '2');
INSERT INTO `log` VALUES ('39', 'logout', 'user logout: jing', '2016-08-30 14:04:31', '14', '2');
INSERT INTO `log` VALUES ('40', 'login', 'user login: russel', '2016-08-30 14:04:38', '10', '9');
INSERT INTO `log` VALUES ('41', 'logout', 'user logout: russel', '2016-08-31 10:24:04', '10', '9');
INSERT INTO `log` VALUES ('42', 'login', 'user login: jing', '2016-08-31 10:24:17', '14', '2');
INSERT INTO `log` VALUES ('43', 'logout', 'user logout: jing', '2016-08-31 10:33:50', '14', '2');
INSERT INTO `log` VALUES ('44', 'login', 'user login: russel', '2016-08-31 10:33:57', '10', '9');
INSERT INTO `log` VALUES ('45', 'logout', 'user logout: russel', '2016-08-31 11:03:23', '10', '9');
INSERT INTO `log` VALUES ('46', 'login', 'user login: jing', '2016-08-31 11:03:32', '14', '2');
INSERT INTO `log` VALUES ('47', 'logout', 'user logout: jing', '2016-08-31 11:07:00', '14', '2');
INSERT INTO `log` VALUES ('48', 'login', 'user login: russel', '2016-08-31 11:07:07', '10', '9');
INSERT INTO `log` VALUES ('49', 'update', 'borrower updated: 1', '2016-08-31 11:45:03', '10', '9');
INSERT INTO `log` VALUES ('50', 'update', 'borrower updated: 1', '2016-08-31 11:45:13', '10', '9');
INSERT INTO `log` VALUES ('51', 'update', 'borrower updated: 1', '2016-08-31 11:45:30', '10', '9');
INSERT INTO `log` VALUES ('52', 'update', 'borrower updated: 1', '2016-08-31 11:46:18', '10', '9');
INSERT INTO `log` VALUES ('53', 'update', 'borrower updated: 2', '2016-08-31 11:46:47', '10', '9');
INSERT INTO `log` VALUES ('54', 'logout', 'user logout: russel', '2016-08-31 13:45:23', '10', '9');
INSERT INTO `log` VALUES ('55', 'login', 'user login: joseph', '2016-08-31 13:45:42', '19', '2');
INSERT INTO `log` VALUES ('56', 'logout', 'user logout: joseph', '2016-08-31 13:45:49', '19', '2');
INSERT INTO `log` VALUES ('57', 'login', 'user login: jing', '2016-08-31 13:45:55', '14', '2');
INSERT INTO `log` VALUES ('58', 'logout', 'user logout: jing', '2016-08-31 13:46:04', '14', '2');
INSERT INTO `log` VALUES ('59', 'login', 'user login: russel', '2016-08-31 13:46:12', '10', '9');
INSERT INTO `log` VALUES ('60', 'update', 'borrower updated: 1', '2016-08-31 13:46:22', '10', '9');
INSERT INTO `log` VALUES ('61', 'update', 'borrower updated: 2', '2016-08-31 13:46:32', '10', '9');
INSERT INTO `log` VALUES ('62', 'logout', 'user logout: russel', '2016-08-31 13:46:36', '10', '9');
INSERT INTO `log` VALUES ('63', 'login', 'user login: jing', '2016-08-31 13:46:45', '14', '2');
INSERT INTO `log` VALUES ('64', 'logout', 'user logout: jing', '2016-08-31 13:53:52', '14', '2');
INSERT INTO `log` VALUES ('65', 'login', 'user login: russel', '2016-08-31 13:54:05', '10', '9');
INSERT INTO `log` VALUES ('66', 'update', 'borrower updated: 1', '2016-08-31 13:56:48', '10', '9');
INSERT INTO `log` VALUES ('67', 'update', 'borrower updated: 1', '2016-08-31 14:06:12', '10', '9');
INSERT INTO `log` VALUES ('68', 'logout', 'user logout: russel', '2016-08-31 14:06:58', '10', '9');
INSERT INTO `log` VALUES ('69', 'login', 'user login: jing', '2016-08-31 14:07:05', '14', '2');
INSERT INTO `log` VALUES ('70', 'logout', 'user logout: jing', '2016-08-31 14:07:56', '14', '2');
INSERT INTO `log` VALUES ('71', 'login', 'user login: russel', '2016-08-31 14:08:17', '10', '9');
INSERT INTO `log` VALUES ('72', 'logout', 'user logout: russel', '2016-08-31 14:15:01', '10', '9');
INSERT INTO `log` VALUES ('73', 'login', 'user login: jing', '2016-08-31 14:15:14', '14', '2');
INSERT INTO `log` VALUES ('74', 'logout', 'user logout: jing', '2016-08-31 14:22:44', '14', '2');
INSERT INTO `log` VALUES ('75', 'login', 'user login: russel', '2016-08-31 14:23:00', '10', '9');
INSERT INTO `log` VALUES ('76', 'create', 'borrower created: 3', '2016-08-31 14:43:16', '10', '9');
INSERT INTO `log` VALUES ('77', 'update', 'borrower updated: 3', '2016-08-31 14:44:29', '10', '9');
INSERT INTO `log` VALUES ('78', 'logout', 'user logout: russel', '2016-08-31 14:52:13', '10', '9');
INSERT INTO `log` VALUES ('79', 'login', 'user login: benson', '2016-08-31 14:52:22', '20', '1');
INSERT INTO `log` VALUES ('80', 'logout', 'user logout: benson', '2016-08-31 14:52:30', '20', '1');
INSERT INTO `log` VALUES ('81', 'login', 'user login: russel', '2016-08-31 14:52:38', '10', '9');
INSERT INTO `log` VALUES ('82', 'update', 'borrower updated: 2', '2016-08-31 14:52:51', '10', '9');
INSERT INTO `log` VALUES ('83', 'logout', 'user logout: russel', '2016-08-31 14:52:57', '10', '9');
INSERT INTO `log` VALUES ('84', 'login', 'user login: benson', '2016-08-31 14:53:07', '20', '1');
INSERT INTO `log` VALUES ('85', 'logout', 'user logout: benson', '2016-08-31 14:54:19', '20', '1');
INSERT INTO `log` VALUES ('86', 'login', 'user login: russel', '2016-08-31 14:54:27', '10', '9');
INSERT INTO `log` VALUES ('87', 'update', 'borrower updated: 2', '2016-08-31 14:57:49', '10', '9');
INSERT INTO `log` VALUES ('88', 'logout', 'user logout: russel', '2016-08-31 15:02:17', '10', '9');
INSERT INTO `log` VALUES ('89', 'login', 'user login: nerissa', '2016-08-31 15:02:26', '21', '9');
INSERT INTO `log` VALUES ('90', 'logout', 'user logout: nerissa', '2016-08-31 15:03:16', '21', '9');
INSERT INTO `log` VALUES ('91', 'login', 'user login: russel', '2016-08-31 15:03:23', '10', '9');
INSERT INTO `log` VALUES ('92', 'logout', 'user logout: russel', '2016-08-31 15:35:41', '10', '9');
INSERT INTO `log` VALUES ('93', 'login', 'user login: benson', '2016-08-31 15:36:32', '20', '1');
INSERT INTO `log` VALUES ('94', 'logout', 'user logout: benson', '2016-08-31 15:36:53', '20', '1');
INSERT INTO `log` VALUES ('95', 'login', 'user login: russel', '2016-08-31 15:37:01', '10', '9');

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
  CONSTRAINT `municipality_city_ibfk_1` FOREIGN KEY (`province_id`) REFERENCES `province` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of municipality_city
-- ----------------------------
INSERT INTO `municipality_city` VALUES ('1', 'Carmen', '3');
INSERT INTO `municipality_city` VALUES ('2', 'Loay', '3');
INSERT INTO `municipality_city` VALUES ('3', 'Pilar', '3');
INSERT INTO `municipality_city` VALUES ('4', 'Sagbayan', '3');
INSERT INTO `municipality_city` VALUES ('5', 'Batuan', '3');
INSERT INTO `municipality_city` VALUES ('6', 'Cebu City', '4');
INSERT INTO `municipality_city` VALUES ('7', 'Mandaue City', '4');
INSERT INTO `municipality_city` VALUES ('8', 'Talisay City', '4');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of province
-- ----------------------------
INSERT INTO `province` VALUES ('3', 'Bohol');
INSERT INTO `province` VALUES ('4', 'Cebu');

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
INSERT INTO `user` VALUES ('20', 'benson', 'M8efQNwMU-fhFbxkkC__BrSr1fmRD-vi', '$2y$13$yuo0QEXQ2G9XR.lEGwkJee5VXfr.um1.Uc3xwBq1xiRwQzjvqNPOm', null, 'benson@gmail.com', '10', '2147483647', '2147483647', '1', 'Robinson', 'Gabutan', 'Wills', '2016-08-23', '30', 'Married', 'Male', 'Guadalupe, Cebu city', '', '', '', '0000000000', 'fileupload/Gabutan-Robinson-Wills-2016-08-23-photo.jpg', 'benson12345');
INSERT INTO `user` VALUES ('21', 'nerissa', 'DPQ4HWRtwxZB-g7pmznblNg88xoArEnB', '$2y$13$ORmDlHIxn3oBLWYeDgxhdOnspkliNvFwow5QzfmjsQE6.PEqZUk7S', null, 'nerissa@gmail.com', '10', '2147483647', '2147483647', '9', 'Nerissa', 'Sayson', 'Hmmm', '2016-08-31', '25', 'Single', 'Female', 'Mambaling Cebu City', '345634563', '3413453', '345345354', '099451224', 'fileupload/Sayson-Nerissa-Hmmm-2016-08-31-photo.jpg', 'nerissa12345');
