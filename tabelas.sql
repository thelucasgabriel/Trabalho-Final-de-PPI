-- -----------------------------------------------------
-- Table clinica
-- -----------------------------------------------------
CREATE TABLE contato
(
  codigo int PRIMARY KEY AUTO_INCREMENT,
  nome VARCHAR(50),
  email VARCHAR(50) UNIQUE,
  telefone VARCHAR(50),
  mensagem VARCHAR(255),
  datahora DATETIME
) ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table funcionario
-- -----------------------------------------------------
CREATE TABLE funcionario 
(
  codigo INT PRIMARY KEY AUTO_INCREMENT,
  nome VARCHAR(50),
  email VARCHAR(50) UNIQUE,
  senha_hash VARCHAR(255),
  estado_civil VARCHAR(30),
  data_nascimento DATE,
  funcao VARCHAR(40)
) ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table medico
-- -----------------------------------------------------
CREATE TABLE medico 
(
  codigo INT PRIMARY KEY AUTO_INCREMENT,
  nome VARCHAR(50),
  especialidade VARCHAR(50),
  crm VARCHAR(15) UNIQUE
) ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table paciente
-- -----------------------------------------------------
CREATE TABLE paciente 
(
  codigo INT PRIMARY KEY AUTO_INCREMENT,
  nome VARCHAR(50),
  sexo VARCHAR(9),
  email VARCHAR(50) UNIQUE,
  telefone varchar(50)
) ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table agendamento
-- -----------------------------------------------------
CREATE TABLE agendamento
(
  codigo INT PRIMARY KEY AUTO_INCREMENT,
  datahora VARCHAR(45) UNIQUE,
  codigo_medico INT NOT NULL,
  codigo_paciente INT NOT NULL,
  FOREIGN KEY (codigo_medico) REFERENCES medico(codigo) ON DELETE CASCADE,
  FOREIGN KEY (codigo_paciente) REFERENCES paciente(codigo) ON DELETE CASCADE
) ENGINE = InnoDB;