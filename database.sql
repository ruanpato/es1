-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 23, 2019 at 05:14 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `engenharia`
--

-- --------------------------------------------------------

--
-- Table structure for table `Agendamento`
--

CREATE TABLE `Agendamento` (
  `id_agendamento` int(11) NOT NULL,
  `data_agendamento` datetime NOT NULL COMMENT 'Data e hora de agendamento',
  `duracao_agendamento` int(11) NOT NULL COMMENT 'Duração em minutos do agendamento',
  `tipo_agendamento` varchar(50) NOT NULL,
  `status_agendamento` varchar(50) DEFAULT NULL,
  `valor_agendamento` double DEFAULT NULL,
  `fk_id_animal` int(11) NOT NULL,
  `fk_cpf_usuario` varchar(11) NOT NULL,
  `fk_cpf_funcionario` varchar(11) NOT NULL,
  `descricao_atendimento` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Agendamento`
--

INSERT INTO `Agendamento` (`id_agendamento`, `data_agendamento`, `duracao_agendamento`, `tipo_agendamento`, `status_agendamento`, `valor_agendamento`, `fk_id_animal`, `fk_cpf_usuario`, `fk_cpf_funcionario`, `descricao_atendimento`) VALUES
(4, '2019-06-27 11:00:00', 60, 'Consulta', 'Em Aberto', 0, 1, '123', '1', 'ads'),
(5, '2019-06-26 00:00:00', 60, 'Consulta', 'Em débito', NULL, 1, '123', '1', 'teste'),
(6, '2019-06-30 00:00:00', 60, 'Consulta', 'Em Aberto', NULL, 1, '123', '1', '');

-- --------------------------------------------------------

--
-- Table structure for table `Animal`
--

CREATE TABLE `Animal` (
  `id_animal` int(11) NOT NULL,
  `nome_animal` varchar(150) NOT NULL,
  `especie_animal` varchar(150) NOT NULL,
  `raca_animal` varchar(150) NOT NULL,
  `imagem_animal` varchar(200) DEFAULT NULL COMMENT 'Caminho da imagem',
  `fk_cpf_dono` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Animal`
--

INSERT INTO `Animal` (`id_animal`, `nome_animal`, `especie_animal`, `raca_animal`, `imagem_animal`, `fk_cpf_dono`) VALUES
(1, 'animal0', 'especie0', 'raca0', NULL, '123');

-- --------------------------------------------------------

--
-- Table structure for table `Endereco`
--

CREATE TABLE `Endereco` (
  `cep_endereco` varchar(11) NOT NULL,
  `rua_endereco` varchar(150) NOT NULL,
  `numero_endereco` int(11) NOT NULL,
  `complemento_endereco` varchar(45) NOT NULL,
  `informacoes_extras_endereco` varchar(150) NOT NULL,
  `fk_cpf_usuario` varchar(11) NOT NULL,
  `fk_agendamento_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Funcionario`
--

CREATE TABLE `Funcionario` (
  `crmv_funcionario` varchar(50) NOT NULL COMMENT 'crmv se for veterinário',
  `descricao_funcionario` varchar(50) NOT NULL COMMENT 'Descrição da função do funcionário',
  `fk_cpf_funcionario` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Funcionario`
--

INSERT INTO `Funcionario` (`crmv_funcionario`, `descricao_funcionario`, `fk_cpf_funcionario`) VALUES
('99492492', 'a', '1');

-- --------------------------------------------------------

--
-- Table structure for table `Relatorio`
--

CREATE TABLE `Relatorio` (
  `fk_id_agendamento` int(11) NOT NULL,
  `descricao_relatorio` varchar(800) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Relatorio`
--

INSERT INTO `Relatorio` (`fk_id_agendamento`, `descricao_relatorio`) VALUES
(4, 'Somente um teste de uma descricao sobre um possivel relatorio');

-- --------------------------------------------------------

--
-- Table structure for table `Usuario`
--

CREATE TABLE `Usuario` (
  `cpf_usuario` varchar(11) NOT NULL,
  `data_nascimento_usuario` date NOT NULL,
  `email_usuario` varchar(150) NOT NULL,
  `nome_usuario` varchar(150) NOT NULL COMMENT 'Nome completo',
  `senha_usuario` varchar(256) NOT NULL COMMENT 'sha256',
  `tipo_usuario` varchar(45) NOT NULL,
  `telefone_usuario` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Usuario`
--

INSERT INTO `Usuario` (`cpf_usuario`, `data_nascimento_usuario`, `email_usuario`, `nome_usuario`, `senha_usuario`, `tipo_usuario`, `telefone_usuario`) VALUES
('1', '1998-03-30', 'teste', 'Veterinario', '244818ffa98149bdfb0b92bab310888b0a1045d3fd4c83df07e8da18bdb03d00', 'Cliente;Veterinario', '1'),
('123', '2000-06-12', 'cliente', 'cliente0', '244818ffa98149bdfb0b92bab310888b0a1045d3fd4c83df07e8da18bdb03d00', 'Cliente', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Agendamento`
--
ALTER TABLE `Agendamento`
  ADD PRIMARY KEY (`id_agendamento`),
  ADD KEY `fk_id_animal_agendamento` (`fk_id_animal`),
  ADD KEY `fk_cpf_usuario_agendamento` (`fk_cpf_usuario`),
  ADD KEY `fk_cpf_funcionario_agendamento` (`fk_cpf_funcionario`);

--
-- Indexes for table `Animal`
--
ALTER TABLE `Animal`
  ADD PRIMARY KEY (`id_animal`),
  ADD KEY `fk_cpf_dono_animal` (`fk_cpf_dono`);

--
-- Indexes for table `Endereco`
--
ALTER TABLE `Endereco`
  ADD PRIMARY KEY (`fk_cpf_usuario`),
  ADD KEY `fk_agendamento_id` (`fk_agendamento_id`);

--
-- Indexes for table `Funcionario`
--
ALTER TABLE `Funcionario`
  ADD PRIMARY KEY (`fk_cpf_funcionario`);

--
-- Indexes for table `Relatorio`
--
ALTER TABLE `Relatorio`
  ADD KEY `fk_id_agendamento_relatorio` (`fk_id_agendamento`);

--
-- Indexes for table `Usuario`
--
ALTER TABLE `Usuario`
  ADD PRIMARY KEY (`cpf_usuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Agendamento`
--
ALTER TABLE `Agendamento`
  MODIFY `id_agendamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `Animal`
--
ALTER TABLE `Animal`
  MODIFY `id_animal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Agendamento`
--
ALTER TABLE `Agendamento`
  ADD CONSTRAINT `fk_cpf_funcionario_agendamento` FOREIGN KEY (`fk_cpf_funcionario`) REFERENCES `Funcionario` (`fk_cpf_funcionario`),
  ADD CONSTRAINT `fk_cpf_usuario_agendamento` FOREIGN KEY (`fk_cpf_usuario`) REFERENCES `Usuario` (`cpf_usuario`),
  ADD CONSTRAINT `fk_id_animal_agendamento` FOREIGN KEY (`fk_id_animal`) REFERENCES `Animal` (`id_animal`);

--
-- Constraints for table `Animal`
--
ALTER TABLE `Animal`
  ADD CONSTRAINT `fk_cpf_dono_animal` FOREIGN KEY (`fk_cpf_dono`) REFERENCES `Usuario` (`cpf_usuario`);

--
-- Constraints for table `Endereco`
--
ALTER TABLE `Endereco`
  ADD CONSTRAINT `fk_agendamento_id` FOREIGN KEY (`fk_agendamento_id`) REFERENCES `Agendamento` (`id_agendamento`),
  ADD CONSTRAINT `fk_cpf_usuario` FOREIGN KEY (`fk_cpf_usuario`) REFERENCES `Usuario` (`cpf_usuario`);

--
-- Constraints for table `Funcionario`
--
ALTER TABLE `Funcionario`
  ADD CONSTRAINT `fk_cpf_usuario_funcionario` FOREIGN KEY (`fk_cpf_funcionario`) REFERENCES `Usuario` (`cpf_usuario`);

--
-- Constraints for table `Relatorio`
--
ALTER TABLE `Relatorio`
  ADD CONSTRAINT `fk_id_agendamento_relatorio` FOREIGN KEY (`fk_id_agendamento`) REFERENCES `Agendamento` (`id_agendamento`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
