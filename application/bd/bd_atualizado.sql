-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 29-Out-2019 às 23:09
-- Versão do servidor: 10.1.26-MariaDB
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ps`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `questao`
--

CREATE TABLE `questao` (
  `id_questao` tinyint(8) NOT NULL,
  `titulo` varchar(30) NOT NULL,
  `descricao` varchar(150) NOT NULL,
  `tipo` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `questao`
--

INSERT INTO `questao` (`id_questao`, `titulo`, `descricao`, `tipo`) VALUES
(1, 'Assdfv', 'Dfsfdsd', 'Tl');

-- --------------------------------------------------------

--
-- Estrutura da tabela `questionario`
--

CREATE TABLE `questionario` (
  `id_questionario` tinyint(4) NOT NULL,
  `titulo` varchar(10) NOT NULL,
  `descricao` varchar(100) NOT NULL,
  `data_ini` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `data_fim` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `questionario_demografico`
--

CREATE TABLE `questionario_demografico` (
  `id_questionario_demografico` tinyint(4) NOT NULL,
  `id_usuario` tinyint(4) NOT NULL,
  `data_resp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `nome_respondente` varchar(100) NOT NULL,
  `idade_respondente` varchar(3) NOT NULL,
  `ec_respondente` varchar(100) NOT NULL,
  `cidade_respondente` varchar(100) NOT NULL,
  `qtd_automoveis` varchar(100) NOT NULL,
  `qtd_empregados` varchar(100) NOT NULL,
  `qtd_maquina_lavar` varchar(100) NOT NULL,
  `qtd_banheiro` varchar(100) NOT NULL,
  `qtd_dvd` varchar(100) NOT NULL,
  `qtd_geladeira` varchar(100) NOT NULL,
  `qtd_freezer` varchar(100) NOT NULL,
  `qtd_pc` varchar(100) NOT NULL,
  `qtd_lava` varchar(100) NOT NULL,
  `qtd_micro` varchar(100) NOT NULL,
  `qtd_moto` varchar(100) NOT NULL,
  `qtd_secadora` varchar(100) NOT NULL,
  `origem_agua` varchar(100) NOT NULL,
  `tipo_rua` varchar(100) NOT NULL,
  `renda` varchar(100) NOT NULL,
  `escolaridade_chefe` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `questionario_demografico`
--

INSERT INTO `questionario_demografico` (`id_questionario_demografico`, `id_usuario`, `data_resp`, `nome_respondente`, `idade_respondente`, `ec_respondente`, `cidade_respondente`, `qtd_automoveis`, `qtd_empregados`, `qtd_maquina_lavar`, `qtd_banheiro`, `qtd_dvd`, `qtd_geladeira`, `qtd_freezer`, `qtd_pc`, `qtd_lava`, `qtd_micro`, `qtd_moto`, `qtd_secadora`, `origem_agua`, `tipo_rua`, `renda`, `escolaridade_chefe`) VALUES
(4, 6, '2019-10-29 21:24:45', 'Felipe', '25', '1', '123456', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1'),
(5, 7, '2019-10-29 21:41:56', 'Felipe Miranda De Lima', '35', '3', 'caxias', '2', '3', '5', '2', '2', '3', '3', '3', '3', '3', '3', '2', '1', '2', '3', '6');

-- --------------------------------------------------------

--
-- Estrutura da tabela `questionario_questao`
--

CREATE TABLE `questionario_questao` (
  `id_questionario_questao` tinyint(4) NOT NULL,
  `id_questao` tinyint(4) NOT NULL,
  `id_questionario` tinyint(4) NOT NULL,
  `peso` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `respostas`
--

CREATE TABLE `respostas` (
  `id_resposta` tinyint(4) NOT NULL,
  `id_usuario` tinyint(4) NOT NULL,
  `id_questionario` tinyint(4) NOT NULL,
  `id_questao` tinyint(4) NOT NULL,
  `resposta` varchar(500) DEFAULT NULL,
  `data_fim` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id_usuario` tinyint(6) NOT NULL,
  `nome_usuario` varchar(10) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email_usuario` varchar(100) NOT NULL,
  `tipo_usuario` varchar(100) NOT NULL,
  `data_cadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `idade` varchar(100) NOT NULL,
  `sexo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id_usuario`, `nome_usuario`, `password`, `email_usuario`, `tipo_usuario`, `data_cadastro`, `idade`, `sexo`) VALUES
(6, 'Felipe Mir', '2355', 'fmlima4@outlook.com', '1', '2019-10-29 21:08:06', '23', '2'),
(7, 'Teste', '123456', 'Teste', '1', '2019-10-29 22:07:22', '28', '2'),
(8, 'Teste_prof', '123456', 'teste2', '2', '2019-10-29 21:43:06', '50', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `questao`
--
ALTER TABLE `questao`
  ADD PRIMARY KEY (`id_questao`);

--
-- Indexes for table `questionario`
--
ALTER TABLE `questionario`
  ADD PRIMARY KEY (`id_questionario`);

--
-- Indexes for table `questionario_demografico`
--
ALTER TABLE `questionario_demografico`
  ADD PRIMARY KEY (`id_questionario_demografico`),
  ADD KEY `fk_questionario_demografico1` (`id_usuario`);

--
-- Indexes for table `questionario_questao`
--
ALTER TABLE `questionario_questao`
  ADD PRIMARY KEY (`id_questionario_questao`),
  ADD KEY `fk_questionario_questao1` (`id_questao`),
  ADD KEY `fk_questionario_questao2` (`id_questionario`);

--
-- Indexes for table `respostas`
--
ALTER TABLE `respostas`
  ADD PRIMARY KEY (`id_resposta`),
  ADD KEY `fk_respostas1` (`id_questao`),
  ADD KEY `fk_respostas2` (`id_questionario`),
  ADD KEY `fk_respostas3` (`id_usuario`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `questao`
--
ALTER TABLE `questao`
  MODIFY `id_questao` tinyint(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `questionario`
--
ALTER TABLE `questionario`
  MODIFY `id_questionario` tinyint(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `questionario_demografico`
--
ALTER TABLE `questionario_demografico`
  MODIFY `id_questionario_demografico` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `questionario_questao`
--
ALTER TABLE `questionario_questao`
  MODIFY `id_questionario_questao` tinyint(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `respostas`
--
ALTER TABLE `respostas`
  MODIFY `id_resposta` tinyint(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_usuario` tinyint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `questionario_demografico`
--
ALTER TABLE `questionario_demografico`
  ADD CONSTRAINT `fk_questionario_demografico1` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id_usuario`);

--
-- Limitadores para a tabela `questionario_questao`
--
ALTER TABLE `questionario_questao`
  ADD CONSTRAINT `fk_questionario_questao1` FOREIGN KEY (`id_questao`) REFERENCES `questao` (`id_questao`),
  ADD CONSTRAINT `fk_questionario_questao2` FOREIGN KEY (`id_questionario`) REFERENCES `questionario` (`id_questionario`);

--
-- Limitadores para a tabela `respostas`
--
ALTER TABLE `respostas`
  ADD CONSTRAINT `fk_respostas1` FOREIGN KEY (`id_questao`) REFERENCES `questao` (`id_questao`),
  ADD CONSTRAINT `fk_respostas2` FOREIGN KEY (`id_questionario`) REFERENCES `questionario` (`id_questionario`),
  ADD CONSTRAINT `fk_respostas3` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
