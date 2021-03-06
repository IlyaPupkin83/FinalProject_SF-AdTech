DROP TABLE IF EXISTS `Offers`;
CREATE TABLE `Offers` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `author_id` int unsigned NOT NULL,
  `title` varchar(100) NOT NULL,
  `cost` decimal(10, 2) NOT NULL,
  `link` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `image` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `author_id` (`author_id`),
  CONSTRAINT `offers_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `Users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 10 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;
DROP TABLE IF EXISTS `Offers_Subs`;
CREATE TABLE `Offers_Subs` (
  `user_id` int unsigned NOT NULL,
  `offer_id` bigint NOT NULL,
  `date` date NOT NULL,
  UNIQUE KEY `offer_sub` (`user_id`, `offer_id`),
  KEY `user_id` (`user_id`),
  KEY `offers_subs_ibfk_1` (`offer_id`),
  CONSTRAINT `offers_subs_ibfk_1` FOREIGN KEY (`offer_id`) REFERENCES `Offers` (`id`),
  CONSTRAINT `offers_subs_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `Users` (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;
DROP TABLE IF EXISTS `Offers_Tematic`;
CREATE TABLE `Offers_Tematic` (
  `offer_id` bigint NOT NULL,
  `tematic_id` int unsigned NOT NULL,
  KEY `offer_tematic` (`offer_id`, `tematic_id`),
  KEY `Offers_Tematic_FK_1` (`tematic_id`),
  CONSTRAINT `Offers_Tematic_FK` FOREIGN KEY (`offer_id`) REFERENCES `Offers` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `Offers_Tematic_FK_1` FOREIGN KEY (`tematic_id`) REFERENCES `Tematic` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;
DROP TABLE IF EXISTS `Redirects`;
CREATE TABLE `Redirects` (
  `date` date NOT NULL,
  `offer_id` bigint NOT NULL,
  `count` int unsigned DEFAULT '1',
  UNIQUE KEY `offer_day` (`date`, `offer_id`),
  KEY `offer_id` (`offer_id`),
  CONSTRAINT `redirects_ibfk_1` FOREIGN KEY (`offer_id`) REFERENCES `Offers` (`id`) ON UPDATE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;
DROP TABLE IF EXISTS `Rejections`;
CREATE TABLE `Rejections` (
  `date` date NOT NULL,
  `offer_id` bigint NOT NULL,
  `count` int unsigned DEFAULT '1',
  UNIQUE KEY `offer_day` (`date`, `offer_id`),
  KEY `offer_id` (`offer_id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;
DROP TABLE IF EXISTS `Tematic`;
CREATE TABLE `Tematic` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Tematic_name_IDX` (`name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 64 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;
DROP TABLE IF EXISTS `Users`;
CREATE TABLE `Users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`)
) ENGINE = InnoDB AUTO_INCREMENT = 23 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;
DELIMITER;
CREATE DEFINER = `root` @`%` TRIGGER `disable_offers`
AFTER
UPDATE
  ON `users` FOR EACH ROW BEGIN IF NEW.`status` = 0 THEN
UPDATE
  `Offers`
SET
  `Offers`.active = 0
WHERE
  `Offers`.author_id = NEW.`id`;
END IF;
END;