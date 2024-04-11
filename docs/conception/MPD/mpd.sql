DROP DATABASE IF EXISTS `porteFolio`;
DROP USER IF EXISTS 'adminPorteFolio'@'localhost';

CREATE DATABASE IF NOT EXISTS porteFolio CHARACTER SET UTF8;
USE porteFolio;

DROP TABLE IF EXISTS `organizations`;
DROP TABLE IF EXISTS `projects`;
DROP TABLE IF EXISTS `users`;
DROP TABLE IF EXISTS `roles`;
DROP TABLE IF EXISTS `registers`;
DROP TABLE IF EXISTS `organizations_languages`;
DROP TABLE IF EXISTS `projects_languages`;
DROP TABLE IF EXISTS `languages`;

CREATE USER IF NOT EXISTS 'adminPorteFolio'@'localhost' IDENTIFIED BY 'porteFolio9854$ThibaultPeronno';
GRANT ALL PRIVILEGES ON porteFolio.* TO 'adminPorteFolio'@'localhost';

CREATE TABLE `languages`(
`id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
`label` VARCHAR(100) NOT NULL,
`picture` VARCHAR(255) NOT NULL
);

CREATE TABLE `organizations` (
`id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
`title` VARCHAR(100) NOT NULL,
`description` VARCHAR(100) NOT NULL,
`picture` VARCHAR(100) NOT NULL
);

CREATE TABLE `roles`(
`id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
`label` VARCHAR(100) NOT NULL
);

CREATE TABLE `projects` (
`id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
`title` VARCHAR(100) NOT NULL,
`description` VARCHAR(255) NOT NULL,
`url` VARCHAR(255) NOT NULL,
`picture` VARCHAR(100) NOT NULL,
`organization_id` INT  NOT NULL,
FOREIGN KEY (`organization_id`)
    REFERENCES `organizations`(`id`)
    ON DELETE NO ACTION
);

CREATE TABLE `users`(
`id` INT KEY NOT NULL PRIMARY KEY AUTO_INCREMENT,
`firstname` VARCHAR(100) NOT NULL,
`lastname` VARCHAR(100) NOT NULL,
`role_id` INT  NOT NULL,
FOREIGN KEY (`role_id`)
    REFERENCES `roles`(`id`)
    ON DELETE NO ACTION
);


CREATE TABLE `registers`(
`id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
`mail` VARCHAR(100) NOT NULL,
`password` VARCHAR(100) NOT NULL,
`user_id` INT NOT NULL,
FOREIGN KEY (`user_id`)
    REFERENCES `users`(`id`)
    ON DELETE NO ACTION
);

CREATE TABLE `organizations_languages`(
`id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
`organization_id` INT NOT NULL,
FOREIGN KEY (`organization_id`)
    REFERENCES `organizations`(`id`)
    ON DELETE NO ACTION,
`language_id` INT NOT NULL,
FOREIGN KEY (`language_id`)
    REFERENCES `languages`(`id`)
    ON DELETE NO ACTION
);

CREATE TABLE `projects_languages`(
`id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
`project_id` INT NOT NULL,
FOREIGN KEY (`project_id`)
    REFERENCES `projects`(`id`)
    ON DELETE NO ACTION,
`language_id` INT NOT NULL,
FOREIGN KEY (`language_id`)
    REFERENCES `languages`(`id`)
    ON DELETE NO ACTION
);