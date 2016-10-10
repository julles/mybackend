/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : mybackend

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2016-10-11 00:11:49
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `actions`
-- ----------------------------
DROP TABLE IF EXISTS `actions`;
CREATE TABLE `actions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `action` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `actions_code_index` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of actions
-- ----------------------------
INSERT INTO actions VALUES ('2', 'index', 'Index', '2016-10-06 16:08:01', '2016-10-06 16:08:01');
INSERT INTO actions VALUES ('3', 'create', 'Create', '2016-10-06 16:08:08', '2016-10-06 16:08:08');
INSERT INTO actions VALUES ('4', 'update', 'Update', '2016-10-06 16:08:15', '2016-10-06 16:08:15');
INSERT INTO actions VALUES ('5', 'delete', 'Delete', '2016-10-06 16:08:22', '2016-10-06 16:08:22');
INSERT INTO actions VALUES ('6', 'view', 'View', '2016-10-06 16:08:27', '2016-10-06 16:08:27');
INSERT INTO actions VALUES ('7', 'publish', 'Publish', '2016-10-06 16:08:35', '2016-10-06 16:08:35');

-- ----------------------------
-- Table structure for `examples`
-- ----------------------------
DROP TABLE IF EXISTS `examples`;
CREATE TABLE `examples` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gender` enum('men','women') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'men',
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of examples
-- ----------------------------
INSERT INTO examples VALUES ('1', 'Tes', 'tes@tes.com', 'men', '8adc3ca27f13539163b4bc8689fe4443.jpg', '2016-10-06 14:44:47', '2016-10-06 14:44:47');

-- ----------------------------
-- Table structure for `menus`
-- ----------------------------
DROP TABLE IF EXISTS `menus`;
CREATE TABLE `menus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned DEFAULT NULL,
  `title` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `controller` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `order` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menus_parent_id_foreign` (`parent_id`),
  KEY `menus_controller_index` (`controller`),
  KEY `menus_slug_index` (`slug`),
  KEY `menus_order_index` (`order`),
  CONSTRAINT `menus_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `menus` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of menus
-- ----------------------------
INSERT INTO menus VALUES ('1', null, 'Development', '#', 'development', '66', null, null);
INSERT INTO menus VALUES ('2', '1', 'Action', 'Admin\\Development\\ActionController', 'development-action', '2', null, null);
INSERT INTO menus VALUES ('3', '1', 'Example', 'Admin\\ExampleController', 'development-example', '2', null, null);
INSERT INTO menus VALUES ('4', null, 'User', '#', 'user', '65', null, null);
INSERT INTO menus VALUES ('5', '4', 'Role', 'Admin\\User\\RoleController', 'user-role', '1', null, null);
INSERT INTO menus VALUES ('6', '4', 'User', 'Admin\\User\\UserController', 'user-user', '2', null, null);
INSERT INTO menus VALUES ('8', null, 'Dashboard', 'Admin\\DashboardController', 'dashboard', '1', null, null);

-- ----------------------------
-- Table structure for `menu_actions`
-- ----------------------------
DROP TABLE IF EXISTS `menu_actions`;
CREATE TABLE `menu_actions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` int(10) unsigned NOT NULL,
  `action_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menu_actions_menu_id_foreign` (`menu_id`),
  KEY `menu_actions_action_id_foreign` (`action_id`),
  CONSTRAINT `menu_actions_action_id_foreign` FOREIGN KEY (`action_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `menu_actions_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of menu_actions
-- ----------------------------

-- ----------------------------
-- Table structure for `migrations`
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO migrations VALUES ('2014_10_12_000000_create_users_table', '1');
INSERT INTO migrations VALUES ('2014_10_12_100000_create_password_resets_table', '1');
INSERT INTO migrations VALUES ('2016_09_24_114646_create_roles_table', '2');
INSERT INTO migrations VALUES ('2016_09_25_174731_create_examples_table', '3');
INSERT INTO migrations VALUES ('2016_10_03_180802_create_menus_table', '4');
INSERT INTO migrations VALUES ('2016_10_06_145127_create_actions_table', '5');
INSERT INTO migrations VALUES ('2016_10_06_164954_add_field_role_id_in_users_table', '6');
INSERT INTO migrations VALUES ('2016_10_10_160256_create_menu_actions_table', '7');

-- ----------------------------
-- Table structure for `password_resets`
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for `roles`
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `roles_code_index` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO roles VALUES ('1', 'super-admin', 'Super Admin', null, null);
INSERT INTO roles VALUES ('2', 'admin', 'Admin', '2016-09-25 17:46:11', '2016-09-25 17:46:11');

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `avatar` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_role_id_foreign` (`role_id`),
  CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO users VALUES ('4', 'Muhamad Reza Abdul Rohim', 'reza.wikrama3@gmail.com', '$2y$10$lKlmPHlwLkmU5W2uKgrOE.EyveOOsJvFwsWwf4sofH8mWlWDk3l2q', 'szOL6aHuP9V0q15sHBVXzXndGlEwrDngL1LTQiKMTVYous6tFG3miFpKYsK2', '2016-10-09 16:55:08', '2016-10-09 18:04:10', '1', '3df7d9404db9637abe9ea7f98e7d76b0.jpg');
