SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `box`;
CREATE TABLE `box` (
                       `id` varchar(128) NOT NULL,
                       `token` varchar(64) NOT NULL,
                       `libelle` varchar(128) NOT NULL,
                       `description` text NOT NULL,
                       `montant` decimal(12,2) NOT NULL DEFAULT 0.00,
                       `kdo` tinyint(4) NOT NULL DEFAULT 0,
                       `message_kdo` text NOT NULL DEFAULT '',
                       `statut` int(11) NOT NULL DEFAULT 1,
                       `url` varchar(256) DEFAULT NULL,
                       `user_email` varchar(128) DEFAULT NULL
);

DROP TABLE IF EXISTS `box2presta`;
CREATE TABLE `box2presta` (
                              `box_id` varchar(128) NOT NULL,
                              `presta_id` varchar(128) NOT NULL,
                              `quantite` int(11) NOT NULL
);

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE `categorie` (
                             `id` int(11) NOT NULL AUTO_INCREMENT,
                             `libelle` varchar(128) NOT NULL,
                             `description` text DEFAULT NULL,
                             PRIMARY KEY (`id`)
);

DROP TABLE IF EXISTS `prestation`;
CREATE TABLE `prestation` (
                              `id` varchar(128) NOT NULL,
                              `libelle` varchar(128) NOT NULL,
                              `description` text NOT NULL,
                              `url` varchar(256) DEFAULT NULL,
                              `unite` varchar(128) DEFAULT NULL,
                              `tarif` decimal(10,2) NOT NULL,
                              `img` varchar(128) DEFAULT NULL,
                              `cat_id` int(11) DEFAULT NULL
);

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
    `email` varchar(128) NOT NULL,
    `password` varchar(128) NOT NULL
);