CREATE DATABASE IF NOT EXISTS `workouts`;
USE `workouts`;

/* TODO Add proper CONSTRAINTs to the tables. */
/* TODO Revisit primary keys. */

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `email` varchar(128) DEFAULT NULL,
    `password` varchar(128) DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `user_id` INT NOT NULL,
    `token` varchar(256) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

/* This table contains exercise definitions. */
DROP TABLE IF EXISTS `exerciseTypes`;
CREATE TABLE `exerciseTypes` (
    `id` INT(10) unsigned NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(128),
    `default_sets` INT(1) unsigned DEFAULT 0,
    `default_reps` INT(1) unsigned DEFAULT 0,
    `wait_time` INT(2) unsigned DEFAULT 0,
    `category` ENUM('warm', 'pull', 'push', 'legs', 'core') DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

/* This table holds workouts started by a user */
DROP TABLE IF EXISTS `workouts`;
CREATE TABLE `workouts` (
    `id` INT(10) unsigned NOT NULL AUTO_INCREMENT,
    `user_id` INT NOT NULL,
    `start` DATETIME NULL,
    `end` DATETIME NULL,
    `notes` VARCHAR(1024),
    `feel` ENUM('weak', 'average', 'strong') DEFAULT 'average',
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

/* This table contains exercises completed during a workout */
DROP TABLE IF EXISTS `exercises`;
CREATE TABLE `exercises` (
    `id` INT(10) unsigned NOT NULL AUTO_INCREMENT,
    `exercises_id` int(10) unsigned NOT NULL,
    `workout_id` int(10) unsigned NOT NULL,
    `user_id` int(10) unsigned NOT NULL,
    `sets` int(1) unsigned DEFAULT 0,
    `feedback` ENUM('up', 'down', 'none') DEFAULT 'none',
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `reps`;
CREATE TABLE `reps` (
    `id` INT(10) unsigned NOT NULL AUTO_INCREMENT,
    `entries_id` int(10) unsigned NOT NULL,
    `amount` varchar(8),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;
