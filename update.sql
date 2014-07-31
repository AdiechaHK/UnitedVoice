CREATE SCHEMA IF NOT EXISTS `united_voice` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
USE `united_voice` ;

-- -----------------------------------------------------
-- Table `united_voice`.`songs`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `united_voice`.`songs` ;

CREATE  TABLE IF NOT EXISTS `united_voice`.`songs` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `user_id` INT NOT NULL ,
  `name` VARCHAR(45) NOT NULL ,
  `path` VARCHAR(45) NOT NULL ,
  `actual_name` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_songs_users1` (`user_id` ASC) ,
  CONSTRAINT `fk_songs_users1`
    FOREIGN KEY (`user_id` )
    REFERENCES `united_voice`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;
