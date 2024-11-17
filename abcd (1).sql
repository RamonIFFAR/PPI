-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 17/11/2024 às 23:56
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
  `equipTI` varchar(45) DEFAULT NULL,
  `estagio` varchar(255) DEFAULT NULL,
  `cpf` varchar(11) NOT NULL,
  `acompanhamento` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `aluno`
--

INSERT INTO `aluno` (`matricula`, `telefone`, `email`, `nome`, `genero`, `cidade`, `dataNasc`, `moradia`, `cota`, `bolsa`, `orientador`, `reprovacao`, `equipTI`, `estagio`, `cpf`, `acompanhamento`) VALUES
(0, 'rrrr', 'rrrr@gmail.com', 'rrrr', 'rrrr', 'rrrr', 'rrrr', 'rrrr', 'rrrr', 'rrrr', 'rrrr', 'rrrr', 'rrrr', NULL, '', NULL),
(1, '123', 'teste@gmail.com', 'teste de novo', 'teste', 'teste', 'teste', 'teste', 'teste', 'teste', 'teste', 'teste', 'teste', NULL, '', NULL),
(2, 'tttt', 'tttt@gmail.com', 'tttt', 'tttt', 'tttt', 'tttt', 'tttt', 'tttt', 'tttt', 'tttt', 't', 't', NULL, '', NULL),
(5, 'rr', 'rr@gmail.com', 'rr', 'rr', 'rr', 'rr', 'rr', 'rr', 'rr', 'rr', 'rr', 'rr', NULL, '', NULL),
(6, 'teste', 'teste@gmail.com', 'teste', 'teste', 'teste', 'teste', 'teste', 'teste', 'teste', 'teste', 'teste', 'teste', NULL, '', NULL),
(7, 'teste', 'teste', 'teste', 'teste', 'teste', 'teste', 'teste', 'teste', 'teste', 'teste', 'teste', 'teste', 'teste', 'teste', 'teste'),
(8, 'no', 'no@gmail.com', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', NULL, '', NULL),
(9, 'teste', 'teste@gmail.com', 'teste', 'teste', 'teste', 'teste', 'teste', 'teste', 'teste', 'teste', 'teste', 'teste', NULL, '', NULL),
(10, 'd', 'd@gmail.com', 'd', 'd', 'd', 'd', 'd', 'd', 'd', 'd', 'd', 'd', NULL, '', NULL),
(11, 'd', 'd@gmail.com', 'd', 'd', 'd', 'd', 'd', 'd', 'd', 'd', 'd', 'd', NULL, 'd', NULL),
(12, 'telefone', 'telefone@gmail.com', 'telefone', 'telefone', 'telefone', 'telefone', 'telefone', 'telefone', 'telefone', 'telefone', 'telefone', 'telefone', 'telefone', 'telefone', 'telefone'),
(20, '2323', 'Teste@teste', 'aluno lixo', 'não precisa', 'lugar nenhum', 'dia da morte', 'rua', 'coitado', 'gucci', 'demiurgo', '', '', '', 'bem lixoso', ''),
(333, 'teste', 'teste@gmail.com', 'teste', 'teste', 'teste', 'teste', 'teste', 'teste', 'q?', 'teste', 'teste', 'teste', NULL, '', NULL);

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
  `foto` varchar(455) DEFAULT NULL,
  `id_coord` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `curso`
--

INSERT INTO `curso` (`id_curso`, `duracao`, `descricao`, `nome`, `foto`, `id_coord`) VALUES
(8, '   cena', '   É um curso bem legal assim que eu gosto bastante   ', '   Joao do teste', 'fotos/17-11-2024-d4c67f7ec746482bbd4c6a058640b4c1.jpg', 34);

-- --------------------------------------------------------

--
-- Estrutura para tabela `disciplina`
--

CREATE TABLE `disciplina` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `descricaro` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `favorita`
--

CREATE TABLE `favorita` (
  `id` int(11) NOT NULL,
  `id_us` int(11) DEFAULT NULL,
  `id_turma` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `favorita`
--

INSERT INTO `favorita` (`id`, `id_us`, `id_turma`) VALUES
(6, 28, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `leciona`
--

CREATE TABLE `leciona` (
  `id` int(11) NOT NULL,
  `id_prof` int(11) DEFAULT NULL,
  `id_disc` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `lembrete`
--

CREATE TABLE `lembrete` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `descricao` varchar(200) DEFAULT NULL,
  `dt` date DEFAULT NULL,
  `id_us` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `lembrete`
--

INSERT INTO `lembrete` (`id`, `nome`, `descricao`, `dt`, `id_us`) VALUES
(1, 'Teste Lembrete', 'Festa de comemoração do teste', '2024-11-28', 0),
(2, 'Joao do teste', 'Feliz ano novo', '2024-11-22', 0),
(3, 'Feliz aniversário', 'meus parabéns', '2024-11-29', 28);

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
(34, NULL),
(35, NULL);

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
-- Estrutura para tabela `turma`
--

CREATE TABLE `turma` (
  `id` int(11) NOT NULL,
  `nome` int(11) DEFAULT NULL,
  `sala` int(20) DEFAULT NULL,
  `descricao` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `turma`
--

INSERT INTO `turma` (`id`, `nome`, `sala`, `descricao`) VALUES
(1, 4, 9, 'teste'),
(2, 0, 0, 'teste'),
(3, 0, 0, 'teste');

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
  `senha` varchar(45) NOT NULL,
  `fone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`cpf`, `Siape`, `foto`, `id_us`, `email`, `nome`, `senha`, `fone`) VALUES
('123123', '4444444', 'nenhum', 17, 'ramon@gmail.com', 'duzentos', 'podre', ''),
('3242', '5555', NULL, 18, 'Farmaciasassociadas@gmail.com', 'Ramon', 'pou', ''),
('teste_cpf', 'teste_Siape', NULL, 19, 'teste@gmail.com', 'teste', 'teste', ''),
('NUNCA', 'SIAPEEEE', NULL, 20, 'fogo@gmail.com', 'Games', 'ruim', ''),
('admin', 'nenhum', NULL, 28, 'admin@gmail.com', 'admin', 'admin', '1234678910'),
('888888', 'nulo', NULL, 29, 'nulo@gmail.com', 'nulo', 'nulo', ''),
('777777777', 'podre', NULL, 30, 'junior@gmail.com', 'ligma', '123', ''),
('036.114.170', '1325467', NULL, 32, 'GalPodre@gmail.com', 'Joao dos games', '1234', ''),
('NUNCA', '1325467', NULL, 33, 'ramonzcezaro@gmail.com', 'teste top', 'legales', ''),
('     NUNCA', '     1325467     ', 'fotos/08-09-2024-Senhor veríssimo Palmitinho.jpg', 34, 'GalPodre@gmail.com', '     Tonhão', 'Maconharia', '  8989'),
('nada', 'nada', 'fotos/08-09-2024-9c22544c153227b66ac105d6821203c9.jpg', 35, 'nada@gmail.com', 'nada', 'nada', ''),
('036.114.170', '99', 'fotos/08-09-2024-8asm99.jpg', 36, 'theplaguerofc@gmail.com', 'Ramon', 'Maconharia', ''),
('sigmaligma', 'teste', 'fotos/08-09-2024-ramsesii.png', 37, 'Thales@gmail.com.br', 'teste', 'pou', ''),
('090909', '020202', 'fotos/09-09-2024-ramsesii.png', 38, 'ramonx@gmail.com', 'ramon do teste', 'testeteste', ''),
('yyyyy', 'impssivel', 'fotos/09-09-2024-chapéu papai noel.png', 39, 'muito@gmail.com', 'Soqueira', 'ter', ''),
('036.114.170', 'never', 'fotos/09-09-2024-deus da frustração símbolo.jpg', 40, 'naosei@gmail.com', 'juninho', 'elveis prisles', '69696969696'),
('NUNCA', '99', 'fotos/09-09-2024-Tonho morte.jpg', 41, 'GalPodre@gmail.com', 'Joao do teste', 'Maconharia', 'ter'),
('777.777.777', '4328947', 'fotos/10-09-2024-mem 3.jpg', 42, 'GalPodre@gmail.com', 'Mahavre', 'fim', 'nenhum');

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
  ADD PRIMARY KEY (`id_curso`),
  ADD KEY `id_coord` (`id_coord`);

--
-- Índices de tabela `disciplina`
--
ALTER TABLE `disciplina`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `favorita`
--
ALTER TABLE `favorita`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_us` (`id_us`),
  ADD KEY `id_turma` (`id_turma`);

--
-- Índices de tabela `leciona`
--
ALTER TABLE `leciona`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_prof` (`id_prof`),
  ADD KEY `id_disc` (`id_disc`);

--
-- Índices de tabela `lembrete`
--
ALTER TABLE `lembrete`
  ADD PRIMARY KEY (`id`);

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
-- Índices de tabela `turma`
--
ALTER TABLE `turma`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id_curso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `disciplina`
--
ALTER TABLE `disciplina`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `favorita`
--
ALTER TABLE `favorita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `leciona`
--
ALTER TABLE `leciona`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `lembrete`
--
ALTER TABLE `lembrete`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `turma`
--
ALTER TABLE `turma`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_us` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

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
-- Restrições para tabelas `curso`
--
ALTER TABLE `curso`
  ADD CONSTRAINT `curso_ibfk_1` FOREIGN KEY (`id_coord`) REFERENCES `professor` (`id_prof`);

--
-- Restrições para tabelas `favorita`
--
ALTER TABLE `favorita`
  ADD CONSTRAINT `favorita_ibfk_1` FOREIGN KEY (`id_us`) REFERENCES `usuario` (`id_us`),
  ADD CONSTRAINT `favorita_ibfk_2` FOREIGN KEY (`id_turma`) REFERENCES `turma` (`id`);

--
-- Restrições para tabelas `leciona`
--
ALTER TABLE `leciona`
  ADD CONSTRAINT `leciona_ibfk_1` FOREIGN KEY (`id_prof`) REFERENCES `professor` (`id_prof`),
  ADD CONSTRAINT `leciona_ibfk_2` FOREIGN KEY (`id_disc`) REFERENCES `disciplina` (`id`);

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
