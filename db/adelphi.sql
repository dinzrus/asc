/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : adelphi

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2016-08-16 17:29:47
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for auth_assignment
-- ----------------------------
DROP TABLE IF EXISTS `auth_assignment`;
CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of auth_assignment
-- ----------------------------
INSERT INTO `auth_assignment` VALUES ('admin', '12', null);
INSERT INTO `auth_assignment` VALUES ('IT', '10', null);
INSERT INTO `auth_assignment` VALUES ('organizer', '13', null);

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
INSERT INTO `auth_item` VALUES ('admin', '2', 'User is admin', null, null, null, null);
INSERT INTO `auth_item` VALUES ('IT', '1', 'User is IT', null, null, null, null);
INSERT INTO `auth_item` VALUES ('organizer', '3', 'User is Organizer', null, null, null, null);

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
INSERT INTO `auth_item_child` VALUES ('admin', 'organizer');
INSERT INTO `auth_item_child` VALUES ('IT', 'admin');

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
  `ci_date` date DEFAULT NULL,
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
  `collaterals` text CHARACTER SET latin5,
  `status` varchar(255) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `attachment` text,
  `acount_type` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `borrower_ibfk_3` (`spouse_birthdate`),
  KEY `borrower_ibfk_2` (`civil_status`),
  KEY `address_province_id` (`address_province_id`),
  KEY `status` (`status`),
  KEY `address_barangay_id` (`address_barangay_id`),
  KEY `address_city_municipality_id` (`address_city_municipality_id`),
  CONSTRAINT `borrower_ibfk_1` FOREIGN KEY (`address_province_id`) REFERENCES `province` (`id`),
  CONSTRAINT `borrower_ibfk_4` FOREIGN KEY (`status`) REFERENCES `status` (`code`),
  CONSTRAINT `borrower_ibfk_5` FOREIGN KEY (`address_barangay_id`) REFERENCES `barangay` (`id`),
  CONSTRAINT `borrower_ibfk_6` FOREIGN KEY (`address_city_municipality_id`) REFERENCES `municipality_city` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of borrower
-- ----------------------------
INSERT INTO `borrower` VALUES ('1', 'fileupload/Tamekah-Cannon-Harding Schneider.jpg', 'Tamekah', 'Cannon', 'Harding Schneider', '', '2016-08-10', '23', 'Qui quam qui quasi praesentium dolorem illum ut aut aliqua Deserunt ipsam sint illum nulla architecto ullam est magnam incidunt', '3', '1', '2', 'Enim in voluptatem quasi aute deleniti modi dolore et voluptate', 'married', '094542145754', '2016-08-24', '2016-08-23', 'Possimus et proident quidem consequatur in beatae quo quos ipsum dicta voluptatum ut expedita voluptatem aliqua', 'Laudantium consequatur et corporis ut assumenda pariatur Consequatur Excepteur sequi hic irure qui', 'Debitis eos accusantium sunt ratione et fugiat inventore quia ea', 'Deserunt beatae quos facilis ea sit omnis et dolorem repudiandae labore modi quis quidem ipsa aut dolores', 'Reagan Sykes', 'Rerum ducimus sed amet dolor consequatur Rem sint', '2', '2016-08-23', '2', 'Rerum quia in ea ipsum inventore blanditiis enim temporibus aut aut dolore deserunt velit sed aliquip inventore.', 'C', '9', 'fileupload/2016-08-10-Cannon-Tamekah-Harding Schneider-attachment0.jpg fileupload/2016-08-10-Cannon-Tamekah-Harding Schneider-attachment1.png fileupload/2016-08-10-Cannon-Tamekah-Harding Schneider-attachment2.jpg', 'B', '0000-00-00 00:00:00', '2016-08-16 11:04:48');
INSERT INTO `borrower` VALUES ('2', 'fileupload/Isadora-Weiss-Solomon Cohen.jpg', 'Isadora', 'Weiss', 'Solomon Cohen', 'Non veniam dolore sit esse do qui maxime', '2016-09-08', '23', 'Corporis voluptas id deleniti rerum corporis dolor repellendus Delectus pariatur Architecto', '4', '6', '5', 'Fugiat quo ea temporibus magni ullam', 'married', '09445451215', null, null, 'Neque impedit veritatis similique doloremque vel pariatur Accusamus fugit dolore dolorum quos laborum atque eiusmod mollit deserunt id consequatur', 'Quis et nulla sapiente sunt eos officia in ipsa', 'Voluptatem Ut elit doloribus ut consequatur Itaque laborum Eligendi maiores et ullamco reprehenderit eiusmod dolor exercitation eum ea', 'Dolorem architecto et reprehenderit neque earum', 'Baker Pratt', 'Doloremque ex voluptatum sit voluptas nisi nisi vel lorem rerum omnis enim cupidatat incididunt aut voluptas provident numquam fugit veniam', '23', '2016-08-08', null, null, null, null, null, 'C', '0000-00-00 00:00:00', '2016-08-16 11:04:48');
INSERT INTO `borrower` VALUES ('3', 'fileupload/Tamekah-Cannon-Harding Schneider12.jpg', 'Tamekah', 'Cannon', 'Harding Schneider12', '', '2016-08-11', '34', 'Amet dolorem deserunt non nemo veniam consectetur enim', '4', '6', '4', 'Autem cupidatat sed animi aliquam doloremque libero voluptatem Do repudiandae aut tempor cum', 'common_law', '0990909090', '2016-08-21', '2016-08-24', 'Qui mollitia aut corporis quasi earum est odit vero accusamus nisi consectetur eius dolores quas deleniti quaerat eos veniam', 'Ducimus dicta officiis ex fuga Vel amet molestiae blanditiis ea', 'Consequatur voluptas animi perspiciatis est qui cupidatat esse non at sint provident', 'Ut sequi et nostrum ad mollitia dolorum eos cum inventore', 'Selma Blevins', 'Quidem aut eligendi omnis voluptatum sequi autem accusantium ut laborum adipisicing aut ab in dolor et mollit', '23', '2016-08-15', '12', 'Commodo quia ex autem ea in error impedit, ut id, cillum consequuntur ut minima reprehenderit, aliqua. Nihil.', 'C', '1', null, 'B', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `borrower` VALUES ('4', 'fileupload/Alvin-Mercer-Otto Love.jpg', 'Tamekah', 'Cannon', 'Otto Love', 'Quas ut ea irure quia quis', '2016-08-26', '12', 'Velit consectetur pariatur Minim non officia laborum Ducimus sunt ex reprehenderit neque', '3', '1', '1', 'Laboris deserunt voluptas id modi nulla est esse soluta similique fuga Cumque proident ullam tempore consectetur', 'widowed', 'Ad qui quis laboris corrupti est sit hic harum sit consequuntur eu adipisicing debitis voluptatibus nisi libero aliquid illum', null, null, 'Sed id vel quia cillum nihil magnam non', 'Est eum reprehenderit provident et dicta exercitation ea libero asperiores voluptate et cumque', 'Placeat vel nulla qui ullam doloribus quo perferendis ut magni aliquid', 'Reprehenderit rerum molestiae anim ea qui provident', 'Chase Porter', 'Laudantium nihil est temporibus ut aut facilis aspernatur ut accusantium minima cum cillum cillum omnis', '12', '2016-08-23', null, null, null, null, null, 'C', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of borrower_comaker
-- ----------------------------
INSERT INTO `borrower_comaker` VALUES ('1', '1', '2', 'brothers');
INSERT INTO `borrower_comaker` VALUES ('2', '3', '4', 'love');

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of dependent
-- ----------------------------
INSERT INTO `dependent` VALUES ('1', 'Chaney Roberts', '33', '2016-08-23', '1');
INSERT INTO `dependent` VALUES ('2', 'Avye Noel', '21', '2016-08-23', '1');
INSERT INTO `dependent` VALUES ('3', 'Alice Burris', '34', '2016-08-09', '1');
INSERT INTO `dependent` VALUES ('4', 'Desirae Burke', '12', '2016-08-24', '3');
INSERT INTO `dependent` VALUES ('5', 'Zia Burris', '12', '2016-08-15', '3');
INSERT INTO `dependent` VALUES ('6', 'Teegan Preston', '12', '2016-08-01', '3');

-- ----------------------------
-- Table structure for employee
-- ----------------------------
DROP TABLE IF EXISTS `employee`;
CREATE TABLE `employee` (
  `employee_id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `middlename` varchar(255) DEFAULT NULL,
  `birth_date` date NOT NULL,
  `gender` varchar(255) NOT NULL,
  `civil_status` varchar(255) NOT NULL,
  `home_address` varchar(255) NOT NULL,
  `sss_no` varchar(255) DEFAULT NULL,
  `philhealth_no` varchar(255) DEFAULT NULL,
  `tin_no` varchar(255) DEFAULT NULL,
  `profile_pic` varchar(255) DEFAULT NULL,
  `contact_no` varchar(255) NOT NULL,
  PRIMARY KEY (`employee_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of employee
-- ----------------------------
INSERT INTO `employee` VALUES ('1', 'Russel', 'dinoy', 'wahing', '2016-07-19', 'Male', 'Married', 'Villaflor, Carmen', '8888', '7777', '8888', 'fileupload/Russeldinoy.jpg', '0');
INSERT INTO `employee` VALUES ('2', 'Christian', 'Cullen', '', '2016-07-20', '1', '2', 'North town Cebu city', '', '', '', 'fileupload/ChristianCullen.jpg', '0999999999');
INSERT INTO `employee` VALUES ('3', 'peter', 'cullen', '', '2016-07-20', '1', '2', 'North Town', '', '', '', 'fileupload/petercullen.jpg', '09987665534');
INSERT INTO `employee` VALUES ('4', 'qqq', 'qq', 'qqq', '2016-07-06', 'Male', 'Married', 'nth', '', '', '', 'fileupload/qqqqq.jpg', '8888888');
INSERT INTO `employee` VALUES ('5', 'gandhi', 'gan', '', '2016-07-20', 'Female', 'Single', 'cebu city', '', '', '', 'fileupload/gandhigan.jpg', '55555555');

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
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `log_description` varchar(255) DEFAULT NULL,
  `user` int(11) DEFAULT NULL,
  `log_date` date DEFAULT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of log
-- ----------------------------

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
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `employee` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `user_ibfk_1` (`employee`) USING BTREE,
  UNIQUE KEY `password_reset_token` (`password_reset_token`),
  CONSTRAINT `user_ibfk_1` FOREIGN KEY (`employee`) REFERENCES `employee` (`employee_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('10', 'it', 'Oyi83DzkBkxl3dfgcgG84wceYGFUa9ib', '$2y$13$8GIWbAEEcBdQRnqrYuYBwedoqd3kXVSn59g4QHfhS0vFKHZPe1UkC', null, 'it@gmail.com', '10', '1469146040', '1469597227', '3', '9');
INSERT INTO `user` VALUES ('12', 'admin', '2sC1B7IVxCJKW34nN_F06E3QxpjVaDSH', '$2y$13$w.ITCfDBx5IncMldGXIyk.a/dOzT.xm96OSDqKMTPNrJgRmx1bTTi', null, 'admin@gmail.com', '10', '1469510625', '1469510625', '2', '9');
INSERT INTO `user` VALUES ('13', 'organizer', 'sbYwcsCbsE78arBNVmbpe4FLNnYPlthA', '$2y$13$rK6XqpBfgZzfbe5vqLlqA.qsepbNzY8sDYnivlG3WBr59gdl2kEsG', null, 'organizer@gmail.com', '10', '1469585876', '1469585876', '1', '1');
INSERT INTO `user` VALUES ('14', 'jing', 'SdX7cmfDjj0PhN5lKMPGrkL--af5TYmK', '$2y$13$3y4X3.TqToGV2cxrvpXL8umKiEs4ftzSC5NPhs8ThLCd7wwAM1jxe', null, 'jing@gmail.com', '10', '1469586014', '1469586014', '5', '2');
