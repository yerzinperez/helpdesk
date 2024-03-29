-- MySQL Script generated by MySQL Workbench
-- Sun Nov  7 21:13:32 2021
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Table `tbl_persona`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tbl_persona` ;

CREATE TABLE IF NOT EXISTS `tbl_persona` (
  `id_persona` INT NOT NULL AUTO_INCREMENT,
  `identificacion` VARCHAR(10) NOT NULL,
  `nombres` VARCHAR(45) NOT NULL,
  `apellidos` VARCHAR(45) NOT NULL,
  `fecha_nacimiento` DATETIME NOT NULL,
  `cargo` VARCHAR(45) NOT NULL,
  `celular` VARCHAR(10) NOT NULL,
  `celular_alternativo` VARCHAR(45) NULL,
  `email` VARCHAR(45) NOT NULL,
  `descripcion` TEXT(300) NULL,
  PRIMARY KEY (`id_persona`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tbl_rol`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tbl_rol` ;

CREATE TABLE IF NOT EXISTS `tbl_rol` (
  `id_rol` INT NOT NULL AUTO_INCREMENT,
  `rol` VARCHAR(45) NOT NULL,
  `descripcion` TEXT(300) NOT NULL,
  PRIMARY KEY (`id_rol`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tbl_departamento`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tbl_departamento` ;

CREATE TABLE IF NOT EXISTS `tbl_departamento` (
  `id_departamento` INT NOT NULL AUTO_INCREMENT,
  `departamento` VARCHAR(45) NOT NULL,
  `descripcion` TEXT(300) NOT NULL,
  `fecha_creacion` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_actualizacion` DATETIME NOT NULL,
  `fecha_eliminacion` DATETIME NULL,
  PRIMARY KEY (`id_departamento`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tbl_usuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tbl_usuario` ;

CREATE TABLE IF NOT EXISTS `tbl_usuario` (
  `id_usuario` INT NOT NULL AUTO_INCREMENT,
  `id_persona` INT NOT NULL,
  `usuario` VARCHAR(45) NOT NULL,
  `contrasenia` VARCHAR(100) NOT NULL,
  `id_rol` INT NOT NULL,
  `id_departamento` INT NOT NULL,
  `token` VARCHAR(100) NULL,
  `estado` ENUM('1', '0') NOT NULL,
  `fecha_creacion` DATETIME NOT NULL,
  `fecha_actualizacion` DATETIME NOT NULL,
  `fecha_eliminacion` DATETIME NULL,
  PRIMARY KEY (`id_usuario`),
  CONSTRAINT `fk_usuario_persona`
    FOREIGN KEY (`id_persona`)
    REFERENCES `tbl_persona` (`id_persona`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_usuario_tbl_rol1`
    FOREIGN KEY (`id_rol`)
    REFERENCES `tbl_rol` (`id_rol`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_usuario_tbl_departamento1`
    FOREIGN KEY (`id_departamento`)
    REFERENCES `tbl_departamento` (`id_departamento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_usuario_persona_idx` ON `tbl_usuario` (`id_persona` ASC) VISIBLE;

CREATE INDEX `fk_tbl_usuario_tbl_rol1_idx` ON `tbl_usuario` (`id_rol` ASC) VISIBLE;

CREATE INDEX `fk_tbl_usuario_tbl_departamento1_idx` ON `tbl_usuario` (`id_departamento` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `tbl_categoria`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tbl_categoria` ;

CREATE TABLE IF NOT EXISTS `tbl_categoria` (
  `id_categoria` INT NOT NULL AUTO_INCREMENT,
  `categoria` VARCHAR(45) NOT NULL,
  `fecha_creacion` DATETIME NOT NULL,
  `fecha_eliminacion` DATETIME NULL,
  PRIMARY KEY (`id_categoria`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tbl_ticket`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tbl_ticket` ;

CREATE TABLE IF NOT EXISTS `tbl_ticket` (
  `id_ticket` INT NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(45) NOT NULL,
  `id_categoria` INT NOT NULL,
  `id_departamento` INT NOT NULL,
  `id_usuario` INT NOT NULL,
  `estado` ENUM('Abierto', 'En progreso', 'Cerrado') NOT NULL,
  `usuario_asignado` INT NULL,
  `fecha_creacion` DATETIME NOT NULL,
  `fecha_cerrado` DATETIME NULL,
  `usuario_cerrado` INT NULL,
  PRIMARY KEY (`id_ticket`),
  CONSTRAINT `fk_tbl_ticket_tbl_categoria1`
    FOREIGN KEY (`id_categoria`)
    REFERENCES `tbl_categoria` (`id_categoria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_ticket_tbl_usuario1`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `tbl_usuario` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_ticket_tbl_departamento1`
    FOREIGN KEY (`id_departamento`)
    REFERENCES `tbl_departamento` (`id_departamento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_tbl_ticket_tbl_categoria1_idx` ON `tbl_ticket` (`id_categoria` ASC) VISIBLE;

CREATE INDEX `fk_tbl_ticket_tbl_usuario1_idx` ON `tbl_ticket` (`id_usuario` ASC) VISIBLE;

CREATE INDEX `fk_tbl_ticket_tbl_departamento1_idx` ON `tbl_ticket` (`id_departamento` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `tbl_detalle_ticket`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tbl_detalle_ticket` ;

CREATE TABLE IF NOT EXISTS `tbl_detalle_ticket` (
  `id_detalle_ticket` INT NOT NULL AUTO_INCREMENT,
  `id_ticket` INT NOT NULL,
  `id_usuario` INT NOT NULL,
  `titulo` VARCHAR(45) NOT NULL,
  `descripcion` TEXT(1000) NOT NULL,
  `archivo` VARCHAR(500) NULL,
  `fecha_creacion` DATETIME NOT NULL,
  `tipo` ENUM('Comentario', 'Nota', 'Transferencia') NULL,
  PRIMARY KEY (`id_detalle_ticket`),
  CONSTRAINT `fk_tbl_detalle_ticket_tbl_ticket1`
    FOREIGN KEY (`id_ticket`)
    REFERENCES `tbl_ticket` (`id_ticket`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_tbl_detalle_ticket_tbl_ticket1_idx` ON `tbl_detalle_ticket` (`id_ticket` ASC) VISIBLE;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
