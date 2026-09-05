-- SimMed database schema.
-- No dump was found in the project; this was reconstructed from the queries
-- in application/models/*.php and the form fields in application/views/.

CREATE DATABASE IF NOT EXISTS `simmed` CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `simmed`;

CREATE TABLE `usuario` (
  `usuario_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `login` VARCHAR(100) NOT NULL,
  `senha` VARCHAR(255) NOT NULL,
  `ativo` TINYINT(1) NOT NULL DEFAULT 1,
  `administrador` TINYINT(1) NOT NULL DEFAULT 0,
  `data_cadastro` DATETIME NOT NULL,
  PRIMARY KEY (`usuario_id`),
  UNIQUE KEY `uq_usuario_login` (`login`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `especialidade_medica` (
  `especialidade_medica_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(150) NOT NULL,
  PRIMARY KEY (`especialidade_medica_id`),
  UNIQUE KEY `uq_especialidade_nome` (`nome`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `caso_clinico` (
  `caso_clinico_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(200) NOT NULL,
  `numero` VARCHAR(50) NOT NULL,
  `cid` VARCHAR(20) NOT NULL,
  `diagnostico` TEXT NULL,
  `prescricao` TEXT NULL,
  `alta` TINYINT(1) NOT NULL DEFAULT 0,
  `internacao` TINYINT(1) NOT NULL DEFAULT 0,
  `area_principal_id` INT UNSIGNED NOT NULL,
  `data_cadastro` DATETIME NOT NULL,
  PRIMARY KEY (`caso_clinico_id`),
  UNIQUE KEY `uq_caso_clinico_nome` (`nome`),
  UNIQUE KEY `uq_caso_clinico_numero` (`numero`),
  KEY `fk_caso_clinico_area_principal` (`area_principal_id`),
  CONSTRAINT `fk_caso_clinico_area_principal` FOREIGN KEY (`area_principal_id`) REFERENCES `especialidade_medica` (`especialidade_medica_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `area_secundaria` (
  `area_secundaria_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `caso_clinico_id` INT UNSIGNED NOT NULL,
  `especialidade_medica_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`area_secundaria_id`),
  KEY `fk_area_secundaria_caso_clinico` (`caso_clinico_id`),
  KEY `fk_area_secundaria_especialidade` (`especialidade_medica_id`),
  CONSTRAINT `fk_area_secundaria_caso_clinico` FOREIGN KEY (`caso_clinico_id`) REFERENCES `caso_clinico` (`caso_clinico_id`) ON DELETE CASCADE,
  CONSTRAINT `fk_area_secundaria_especialidade` FOREIGN KEY (`especialidade_medica_id`) REFERENCES `especialidade_medica` (`especialidade_medica_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `variavel_clinica` (
  `variavel_clinica_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(200) NOT NULL,
  `comando` VARCHAR(100) NULL,
  `custo` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
  `data_cadastro` DATETIME NOT NULL,
  PRIMARY KEY (`variavel_clinica_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `variavel_clinica_caso_clinico` (
  `variavel_clinica_caso_clinico_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `variavel_clinica_id` INT UNSIGNED NOT NULL,
  `caso_clinico_id` INT UNSIGNED NOT NULL,
  `texto` TEXT NULL,
  `foto` VARCHAR(255) NULL,
  `obrigatorio` TINYINT(1) NOT NULL DEFAULT 0,
  `data_cadastro` DATETIME NOT NULL,
  PRIMARY KEY (`variavel_clinica_caso_clinico_id`),
  KEY `fk_vccc_variavel_clinica` (`variavel_clinica_id`),
  KEY `fk_vccc_caso_clinico` (`caso_clinico_id`),
  CONSTRAINT `fk_vccc_variavel_clinica` FOREIGN KEY (`variavel_clinica_id`) REFERENCES `variavel_clinica` (`variavel_clinica_id`) ON DELETE CASCADE,
  CONSTRAINT `fk_vccc_caso_clinico` FOREIGN KEY (`caso_clinico_id`) REFERENCES `caso_clinico` (`caso_clinico_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `usuario_caso_clinico` (
  `usuario_caso_clinico_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `usuario_id` INT UNSIGNED NOT NULL,
  `caso_clinico_id` INT UNSIGNED NOT NULL,
  `ordem` INT UNSIGNED NOT NULL DEFAULT 1,
  `iniciado` TINYINT(1) NOT NULL DEFAULT 0,
  `concluido` TINYINT(1) NOT NULL DEFAULT 0,
  `ativo` TINYINT(1) NOT NULL DEFAULT 1,
  `internacao` TINYINT(1) NULL,
  `alta` TINYINT(1) NULL,
  `diagnostico` TEXT NULL,
  `prescricao` TEXT NULL,
  `cid` VARCHAR(20) NULL,
  `data_cadastro` DATETIME NOT NULL,
  `data_inicio` DATETIME NULL,
  `data_fim` DATETIME NULL,
  PRIMARY KEY (`usuario_caso_clinico_id`),
  KEY `fk_ucc_usuario` (`usuario_id`),
  KEY `fk_ucc_caso_clinico` (`caso_clinico_id`),
  CONSTRAINT `fk_ucc_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usuario_id`) ON DELETE CASCADE,
  CONSTRAINT `fk_ucc_caso_clinico` FOREIGN KEY (`caso_clinico_id`) REFERENCES `caso_clinico` (`caso_clinico_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `usuario_caso_clinico_variavel_clinica` (
  `usuario_caso_clinico_variavel_clinica_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `usuario_id` INT UNSIGNED NOT NULL,
  `caso_clinico_id` INT UNSIGNED NOT NULL,
  `variavel_clinica_id` INT UNSIGNED NOT NULL,
  `data_cadastro` DATETIME NOT NULL,
  PRIMARY KEY (`usuario_caso_clinico_variavel_clinica_id`),
  KEY `fk_uccvc_usuario` (`usuario_id`),
  KEY `fk_uccvc_caso_clinico` (`caso_clinico_id`),
  KEY `fk_uccvc_variavel_clinica` (`variavel_clinica_id`),
  CONSTRAINT `fk_uccvc_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usuario_id`) ON DELETE CASCADE,
  CONSTRAINT `fk_uccvc_caso_clinico` FOREIGN KEY (`caso_clinico_id`) REFERENCES `caso_clinico` (`caso_clinico_id`) ON DELETE CASCADE,
  CONSTRAINT `fk_uccvc_variavel_clinica` FOREIGN KEY (`variavel_clinica_id`) REFERENCES `variavel_clinica` (`variavel_clinica_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
