SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE TABLE IF NOT EXISTS `starbound_log`.`planets` (
  `planet_id` INT(11) NOT NULL AUTO_INCREMENT,
  `planet_x` INT(11) NOT NULL,
  `planet_y` INT(11) NOT NULL,
  PRIMARY KEY (`planet_id`),
  UNIQUE INDEX `coordinates_unique` (`planet_x` ASC, `planet_y` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE TABLE IF NOT EXISTS `starbound_log`.`users` (
  `user_id` INT(11) NOT NULL AUTO_INCREMENT,
  `user_login` VARCHAR(64) NOT NULL,
  `user_password` VARCHAR(256) NOT NULL,
  `user_mail` VARCHAR(256) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE INDEX `login_unique` (`user_login` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE TABLE IF NOT EXISTS `starbound_log`.`users_characters` (
  `character_id` INT(11) NOT NULL AUTO_INCREMENT,
  `character_user_id` INT(11) NOT NULL,
  `character_name` VARCHAR(64) NOT NULL,
  PRIMARY KEY (`character_id`),
  INDEX `fk_users_characters_users_idx` (`character_user_id` ASC),
  CONSTRAINT `fk_users_characters_users`
    FOREIGN KEY (`character_user_id`)
    REFERENCES `starbound_log`.`users` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE TABLE IF NOT EXISTS `starbound_log`.`planets_visists` (
  `visit_id` INT(11) NOT NULL AUTO_INCREMENT,
  `visit_planet_id` INT(11) NOT NULL,
  `visit_user_id` INT(11) NOT NULL,
  `visit_biome_id` INT(11) NOT NULL,
  `visit_rating` INT(10) UNSIGNED NOT NULL,
  `visit_tier` INT(11) NOT NULL,
  `visit_comment` TEXT NOT NULL,
  `visit_shared` TINYINT(1) NOT NULL,
  `visit_created` DATETIME NOT NULL,
  `visit_updated` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`visit_id`),
  INDEX `fk_planets_visits_users1_idx` (`visit_user_id` ASC),
  INDEX `fk_planets_visits_planets1_idx` (`visit_planet_id` ASC),
  UNIQUE INDEX `planet_user_unique` (`visit_planet_id` ASC, `visit_user_id` ASC),
  INDEX `fk_planets_visits_biomes1_idx` (`visit_biome_id` ASC),
  INDEX `index6` (`visit_rating` DESC),
  CONSTRAINT `fk_planets_visits_users1`
    FOREIGN KEY (`visit_user_id`)
    REFERENCES `starbound_log`.`users` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_planets_visits_planets1`
    FOREIGN KEY (`visit_planet_id`)
    REFERENCES `starbound_log`.`planets` (`planet_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_planets_visits_biomes1`
    FOREIGN KEY (`visit_biome_id`)
    REFERENCES `starbound_log`.`biomes` (`biome_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE TABLE IF NOT EXISTS `starbound_log`.`characters_planets` (
  `chapla_id` INT(11) NOT NULL AUTO_INCREMENT,
  `chapla_planet_id` INT(11) NOT NULL,
  `chapla_character_id` INT(11) NOT NULL,
  `chapla_time` DATETIME NOT NULL,
  `chapla_notes` TEXT NOT NULL,
  PRIMARY KEY (`chapla_id`),
  UNIQUE INDEX `chapla_unique` (`chapla_planet_id` ASC, `chapla_character_id` ASC),
  INDEX `fk_characters_planets_users_characters1_idx` (`chapla_character_id` ASC),
  CONSTRAINT `fk_characters_planets_users_characters1`
    FOREIGN KEY (`chapla_character_id`)
    REFERENCES `starbound_log`.`users_characters` (`character_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_characters_planets_planets1`
    FOREIGN KEY (`chapla_planet_id`)
    REFERENCES `starbound_log`.`planets` (`planet_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE TABLE IF NOT EXISTS `starbound_log`.`biomes` (
  `biome_id` INT(11) NOT NULL AUTO_INCREMENT,
  `biome_name` VARCHAR(64) NOT NULL,
  PRIMARY KEY (`biome_id`),
  UNIQUE INDEX `biome_name_UNIQUE` (`biome_name` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE TABLE IF NOT EXISTS `starbound_log`.`characters_queue` (
  `chaque_id` INT(11) NOT NULL AUTO_INCREMENT,
  `chaque_character_id` INT(11) NOT NULL,
  `chaque_planet_id` INT(11) NOT NULL,
  `chaque_done` TINYINT(1) NOT NULL,
  PRIMARY KEY (`chaque_id`),
  INDEX `fk_characters_queue_users_characters1_idx` (`chaque_character_id` ASC),
  INDEX `fk_characters_queue_planets1_idx` (`chaque_planet_id` ASC),
  CONSTRAINT `fk_characters_queue_users_characters1`
    FOREIGN KEY (`chaque_character_id`)
    REFERENCES `starbound_log`.`users_characters` (`character_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_characters_queue_planets1`
    FOREIGN KEY (`chaque_planet_id`)
    REFERENCES `starbound_log`.`planets` (`planet_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
