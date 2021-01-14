-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 14-Jan-2021 às 03:46
-- Versão do servidor: 10.4.14-MariaDB
-- versão do PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `tarefasdiarias`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria_tarefa`
--

CREATE TABLE `categoria_tarefa` (
  `cod` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `categoria_tarefa`
--

INSERT INTO `categoria_tarefa` (`cod`, `nome`) VALUES
(0, 'Baixo'),
(1, 'Medio'),
(2, 'Alto');

-- --------------------------------------------------------

--
-- Estrutura da tabela `perfil_usuario`
--

CREATE TABLE `perfil_usuario` (
  `cod` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `perfil_usuario`
--

INSERT INTO `perfil_usuario` (`cod`, `nome`) VALUES
(1, 'Administrador'),
(2, 'Usuário Padrão');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tarefas`
--

CREATE TABLE `tarefas` (
  `cod` int(11) NOT NULL,
  `titulo` varchar(45) NOT NULL,
  `data_inicial` date NOT NULL,
  `data_final` date NOT NULL,
  `valor` decimal(10,0) NOT NULL,
  `investimento` decimal(10,0) DEFAULT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `usuario_cod` int(11) NOT NULL,
  `categoria_cod` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tarefas`
--

INSERT INTO `tarefas` (`cod`, `titulo`, `data_inicial`, `data_final`, `valor`, `investimento`, `descricao`, `usuario_cod`, `categoria_cod`) VALUES
(36, 'Robocoopr', '1996-10-20', '1993-10-20', '2', '0', '', 6, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `cod` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `senha` varchar(150) NOT NULL,
  `perfil_cod` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`cod`, `nome`, `email`, `senha`, `perfil_cod`) VALUES
(4, 'teste', 'teste@gmail.com', '202cb962ac59075b964b07152d234b70', 2),
(5, 'Administrador', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 1),
(6, 'alberico', 'alberico_oliver@hotmail.com', 'f75898e36002143c0a8cfd18d858ed62', 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `categoria_tarefa`
--
ALTER TABLE `categoria_tarefa`
  ADD PRIMARY KEY (`cod`);

--
-- Índices para tabela `perfil_usuario`
--
ALTER TABLE `perfil_usuario`
  ADD PRIMARY KEY (`cod`);

--
-- Índices para tabela `tarefas`
--
ALTER TABLE `tarefas`
  ADD PRIMARY KEY (`cod`),
  ADD KEY `fk_tarefas_usuario1` (`usuario_cod`),
  ADD KEY `fk_tarefas_categoria1` (`categoria_cod`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`cod`),
  ADD KEY `fk_usuario_perfil1_idx` (`perfil_cod`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `perfil_usuario`
--
ALTER TABLE `perfil_usuario`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `tarefas`
--
ALTER TABLE `tarefas`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `tarefas`
--
ALTER TABLE `tarefas`
  ADD CONSTRAINT `fk_tarefas_categoria1` FOREIGN KEY (`categoria_cod`) REFERENCES `categoria_tarefa` (`cod`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tarefas_usuario1` FOREIGN KEY (`usuario_cod`) REFERENCES `usuario` (`cod`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuario_perfil1` FOREIGN KEY (`perfil_cod`) REFERENCES `perfil_usuario` (`cod`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
