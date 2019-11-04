-- MySQL Script generated by MySQL Workbench
-- Mon Nov  4 16:46:19 2019
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema crudClases
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema crudClases
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `crudClases` DEFAULT CHARACTER SET utf8 ;
USE `crudClases` ;

-- -----------------------------------------------------
-- Table `crudClases`.`Usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `crudClases`.`Usuario` (
  `idUsuario` INT NOT NULL AUTO_INCREMENT,
  `nombre_usuario` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL,
  `contrasena` VARCHAR(8) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL,
  PRIMARY KEY (`idUsuario`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `crudClases`.`Modelo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `crudClases`.`Modelo` (
  `idModelo` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(50) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL,
  `idUsuario` INT NOT NULL,
  PRIMARY KEY (`idModelo`, `idUsuario`),
    FOREIGN KEY (`idUsuario`)
    REFERENCES `crudClases`.`Usuario` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `crudClases`.`Clases`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `crudClases`.`Clases` (
  `idClases` VARCHAR(100) NOT NULL,
  `nombre` VARCHAR(50) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL,
  `herencia` VARCHAR(100) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL,
  `idModelo` INT NOT NULL,
  `idUsuario` INT NOT NULL,
  PRIMARY KEY (`idClases`, `idModelo`, `idUsuario`),
    FOREIGN KEY (`idModelo` , `idUsuario`)
    REFERENCES `crudClases`.`Modelo` (`idModelo` , `idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `crudClases`.`Metodos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `crudClases`.`Metodos` (
  `idMetodos` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(50) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL,
  `tipo` VARCHAR(80) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL,
  `idClases` VARCHAR(100) NOT NULL,
  `idModelo` INT NOT NULL,
  `idUsuario` INT NOT NULL,
  PRIMARY KEY (`idMetodos`, `idClases`, `idModelo`, `idUsuario`),
    FOREIGN KEY (`idClases` , `idModelo` , `idUsuario`)
    REFERENCES `crudClases`.`Clases` (`idClases` , `idModelo` , `idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `crudClases`.`Parametros`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `crudClases`.`Parametros` (
  `idParametros` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(50) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL,
  `tipo` VARCHAR(80) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL,
  `idMetodos` INT NOT NULL,
  `idClases` VARCHAR(100) NOT NULL,
  `idModelo` INT NOT NULL,
  `idUsuario` INT NOT NULL,
  PRIMARY KEY (`idParametros`, `idMetodos`, `idClases`, `idModelo`, `idUsuario`),
    FOREIGN KEY (`idMetodos` , `idClases` , `idModelo` , `idUsuario`)
    REFERENCES `crudClases`.`Metodos` (`idMetodos` , `idClases` , `idModelo` , `idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `crudClases`.`Atributos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `crudClases`.`Atributos` (
  `idAtributos` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(50) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL,
  `tipo` VARCHAR(80) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL,
  `idClases` VARCHAR(100) NOT NULL,
  `idModelo` INT NOT NULL,
  `idUsuario` INT NOT NULL,
  PRIMARY KEY (`idAtributos`, `idClases`, `idModelo`, `idUsuario`),
    FOREIGN KEY (`idClases` , `idModelo` , `idUsuario`)
    REFERENCES `crudClases`.`Clases` (`idClases` , `idModelo` , `idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
