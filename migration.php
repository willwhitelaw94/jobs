<?php
CREATE TABLE `jobs_db`.`job_user_time_slots` ( `id` INT NOT NULL AUTO_INCREMENT , `user_id` INT NOT NULL , `day_id` INT NOT NULL , `start_time` TIME NOT NULL , `end_time` TIME NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
ALTER TABLE `job_user_time_slots` ADD CONSTRAINT `fk_day_id` FOREIGN KEY (`day_id`) REFERENCES `job_user_prefered_days`(`id`) ON DELETE CASCADE ON UPDATE RESTRICT;
ALTER TABLE `job_user_time_slots` CHANGE `user_id` `user_id` INT(11) UNSIGNED NOT NULL;


CREATE TABLE `jobs_db`.`job_preferences` ( `id` INT NOT NULL AUTO_INCREMENT , `question` TEXT NOT NULL , `status` ENUM('active','disabled') NOT NULL , `created_at` TIMESTAMP NOT NULL , `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = MyISAM;
CREATE TABLE `jobs_db`.`job_about_me_options` ( `id` INT NOT NULL AUTO_INCREMENT , `about_me_id` INT NOT NULL , `name` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = MyISAM;

CREATE TABLE `jobs_db`.`job_about_me_options` ( `id` INT NOT NULL AUTO_INCREMENT , `about_me_id` INT NOT NULL , `name` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = MyISAM;

CREATE TABLE `jobs_db`.`job_about_mes` ( `id` INT NOT NULL AUTO_INCREMENT , `name` TEXT NOT NULL , `status` ENUM('active','disabled') NOT NULL , `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = MyISAM;

CREATE TABLE `jobs_db`.`job_preference_options` ( `id` INT NOT NULL AUTO_INCREMENT , `preference_id` INT NOT NULL , `name` VARCHAR(255) NOT NULL , `created_at` TIMESTAMP NULL DEFAULT NULL , `updated_at` TIMESTAMP NULL DEFAULT NULL , PRIMARY KEY (`id`)) ENGINE = MyISAM;