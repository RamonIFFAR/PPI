-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 09/09/2024 às 04:43
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `abcd`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `aluno`
--

CREATE TABLE `aluno` (
  `matricula` int(11) NOT NULL,
  `telefone` varchar(30) NOT NULL,
  `email` varchar(45) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `genero` varchar(45) NOT NULL,
  `cidade` varchar(45) NOT NULL,
  `dataNasc` varchar(20) NOT NULL,
  `moradia` varchar(45) DEFAULT NULL,
  `cota` varchar(45) DEFAULT NULL,
  `bolsa` varchar(45) DEFAULT NULL,
  `orientador` varchar(45) DEFAULT NULL,
  `reprovacao` varchar(45) DEFAULT NULL,
  `equipTI` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `aluno`
--

INSERT INTO `aluno` (`matricula`, `telefone`, `email`, `nome`, `genero`, `cidade`, `dataNasc`, `moradia`, `cota`, `bolsa`, `orientador`, `reprovacao`, `equipTI`) VALUES
(1, '123', 'teste@gmail.com', 'teste de novo', 'teste', 'teste', 'teste', 'teste', 'teste', 'teste', 'teste', 'teste', 'teste'),
(333, 'teste', 'teste@gmail.com', 'teste', 'teste', 'teste', 'teste', 'teste', 'teste', 'q?', 'teste', 'teste', 'teste');

-- --------------------------------------------------------

--
-- Estrutura para tabela `comentario`
--

CREATE TABLE `comentario` (
  `id_coment` int(11) NOT NULL,
  `matricula` int(11) NOT NULL,
  `id_us` int(11) NOT NULL,
  `descricao` varchar(450) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `comentario`
--

INSERT INTO `comentario` (`id_coment`, `matricula`, `id_us`, `descricao`) VALUES
(23, 333, 28, 'mais um testezinho');

-- --------------------------------------------------------

--
-- Estrutura para tabela `curso`
--

CREATE TABLE `curso` (
  `id_curso` int(11) NOT NULL,
  `duracao` varchar(45) DEFAULT NULL,
  `descricao` varchar(200) DEFAULT NULL,
  `nome` varchar(45) DEFAULT NULL,
  `foto` varchar(455) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `curso`
--

INSERT INTO `curso` (`id_curso`, `duracao`, `descricao`, `nome`, `foto`) VALUES
(2, '100 horas', 'É um curso bem legal assim que eu gosto bastante', 'Técnico em testação', 'fotos/08-09-2024-Mapa inicial.jpeg'),
(4, '200 horas', 'ajudar as pessoas', 'Técnico em gentileza', ''),
(5, 'instantânea', 'É um curso bem legal assim que eu gosto bastante', 'Joao do teste', 'fotos/08-09-2024-8asm99.jpg');

-- --------------------------------------------------------

--
-- Estrutura para tabela `professor`
--

CREATE TABLE `professor` (
  `id_prof` int(11) NOT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `professor`
--

INSERT INTO `professor` (`id_prof`, `foto`) VALUES
(33, NULL),
(34, NULL),
(35, NULL),
(36, NULL),
(37, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `setor`
--

CREATE TABLE `setor` (
  `tipo` varchar(15) NOT NULL,
  `id_set` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `setor`
--

INSERT INTO `setor` (`tipo`, `id_set`) VALUES
('DE', 17),
('CAE', 19),
('DE', 28);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `cpf` char(11) NOT NULL,
  `Siape` varchar(45) NOT NULL,
  `foto` varchar(200) DEFAULT NULL,
  `id_us` int(11) NOT NULL,
  `email` varchar(45) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `senha` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`cpf`, `Siape`, `foto`, `id_us`, `email`, `nome`, `senha`) VALUES
('123123', '4444444', 'nenhum', 17, 'ramon@gmail.com', 'duzentos', 'podre'),
('3242', '5555', NULL, 18, 'Farmaciasassociadas@gmail.com', 'Ramon', 'pou'),
('teste_cpf', 'teste_Siape', NULL, 19, 'teste@gmail.com', 'teste', 'teste'),
('NUNCA', 'SIAPEEEE', NULL, 20, 'fogo@gmail.com', 'Games', 'ruim'),
('admin', 'nenhum', NULL, 28, 'admin@gmail.com', 'admin', 'admin'),
('888888', 'nulo', NULL, 29, 'nulo@gmail.com', 'nulo', 'nulo'),
('777777777', 'podre', NULL, 30, 'junior@gmail.com', 'ligma', '123'),
('036.114.170', '1325467', NULL, 32, 'GalPodre@gmail.com', 'Joao dos games', '1234'),
('NUNCA', '1325467', NULL, 33, 'ramonzcezaro@gmail.com', 'teste top', 'legales'),
(' NUNCA', ' 1325467 ', 'fotos/08-09-2024-Senhor veríssimo Palmitinho.jpg', 34, 'GalPodre@gmail.com', ' Tonhão', 'Maconharia'),
('nada', 'nada', 'fotos/08-09-2024-9c22544c153227b66ac105d6821203c9.jpg', 35, 'nada@gmail.com', 'nada', 'nada'),
('036.114.170', '99', 'fotos/08-09-2024-8asm99.jpg', 36, 'theplaguerofc@gmail.com', 'Ramon', 'Maconharia'),
('sigmaligma', 'teste', 'fotos/08-09-2024-ramsesii.png', 37, 'Thales@gmail.com.br', 'teste', 'pou');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `aluno`
--
ALTER TABLE `aluno`
  ADD PRIMARY KEY (`matricula`);

--
-- Índices de tabela `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`id_coment`),
  ADD KEY `id_us` (`id_us`),
  ADD KEY `matricula` (`matricula`);

--
-- Índices de tabela `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`id_curso`);

--
-- Índices de tabela `professor`
--
ALTER TABLE `professor`
  ADD PRIMARY KEY (`id_prof`);

--
-- Índices de tabela `setor`
--
ALTER TABLE `setor`
  ADD PRIMARY KEY (`id_set`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_us`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `comentario`
--
ALTER TABLE `comentario`
  MODIFY `id_coment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de tabela `curso`
--
ALTER TABLE `curso`
  MODIFY `id_curso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_us` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `comentario_ibfk_1` FOREIGN KEY (`id_us`) REFERENCES `usuario` (`id_us`),
  ADD CONSTRAINT `comentario_ibfk_2` FOREIGN KEY (`matricula`) REFERENCES `aluno` (`matricula`);

--
-- Restrições para tabelas `professor`
--
ALTER TABLE `professor`
  ADD CONSTRAINT `professor_ibfk_1` FOREIGN KEY (`id_prof`) REFERENCES `usuario` (`id_us`);

--
-- Restrições para tabelas `setor`
--
ALTER TABLE `setor`
  ADD CONSTRAINT `setor_ibfk_1` FOREIGN KEY (`id_set`) REFERENCES `usuario` (`id_us`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
