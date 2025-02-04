-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema apptask
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema apptask
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `apptask` DEFAULT CHARACTER SET utf8 ;
USE `apptask` ;

-- -----------------------------------------------------
-- Table `apptask`.`usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `apptask`.`usuarios` (
  `Usuarios_id` INT(11) NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(255) NULL DEFAULT NULL,
  `password` VARCHAR(255) NULL DEFAULT NULL,
  PRIMARY KEY (`Usuarios_id`),
  UNIQUE INDEX `username_UNIQUE` (`username` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `apptask`.`tareas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `apptask`.`tareas` (
  `tareas_id` INT(11) NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(255) NULL DEFAULT NULL,
  `descripcion` VARCHAR(255) NULL DEFAULT NULL,
  `fecha_creacion` DATE NULL DEFAULT NULL,
  `estado` VARCHAR(45) NULL DEFAULT NULL,
  `tareascol` TINYINT(4) NULL DEFAULT NULL,
  `Usuarios_id` INT(11) NOT NULL,
  PRIMARY KEY (`tareas_id`),
  INDEX `fk_tareas_Usuarios_idx` (`Usuarios_id` ASC) ,
  CONSTRAINT `fk_tareas_Usuarios`
    FOREIGN KEY (`Usuarios_id`)
    REFERENCES `apptask`.`usuarios` (`Usuarios_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;