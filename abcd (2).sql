-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 21/11/2024 às 23:21
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
  `acompanhamento` varchar(255) DEFAULT NULL,
  `id_turma` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `aluno`
--

INSERT INTO `aluno` (`matricula`, `telefone`, `email`, `nome`, `genero`, `cidade`, `dataNasc`, `moradia`, `cota`, `bolsa`, `orientador`, `reprovacao`, `equipTI`, `estagio`, `cpf`, `acompanhamento`, `id_turma`) VALUES
(2, '300', 'teste@gmail.com', 'Teste aluno', 'teste', 'teste', 'teste', 'teste', 'teste', 'teste', 'teste', 'teste', 'teste', 'teste', 'teste', 'teste', 4),
(10, '37446666', 'teste@gmail.com', 'teste', 'teste', 'teste', 'teste', 'teste', 'teste', 'teste', 'teste', 'teste', 'teste', 'teste', 'teste', 'teste', 5);

-- --------------------------------------------------------

--
-- Estrutura para tabela `avaliacao`
--

CREATE TABLE `avaliacao` (
  `id` int(11) NOT NULL,
  `id_disc` int(11) NOT NULL,
  `id_aluno` int(11) NOT NULL,
  `PPI` int(11) DEFAULT NULL,
  `AIS` int(11) DEFAULT NULL,
  `AIA` int(11) DEFAULT NULL,
  `NOTA1` int(11) DEFAULT NULL,
  `NOTA2` int(11) DEFAULT NULL,
  `MC` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(25, 2, 28, 'teste de comentário');

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
  `descricao` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `disciplina`
--

INSERT INTO `disciplina` (`id`, `nome`, `descricao`) VALUES
(2, 'Disciplina teste 2', 'Teste de criação de uma disciplina'),
(3, 'teste disciplina novo', 'disciplina criada para testar uma nova função'),
(4, 'disciplina de teste para procura ', 'teste de pesquisa de id');

-- --------------------------------------------------------

--
-- Estrutura para tabela `disciplina_turma`
--

CREATE TABLE `disciplina_turma` (
  `id` int(11) NOT NULL,
  `id_disc` int(11) NOT NULL,
  `id_turma` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `disciplina_turma`
--

INSERT INTO `disciplina_turma` (`id`, `id_disc`, `id_turma`) VALUES
(1, 3, 4);

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
(13, 47, 4);

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
(35, NULL),
(47, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `professor_disciplina`
--

CREATE TABLE `professor_disciplina` (
  `id` int(11) NOT NULL,
  `id_prof` int(11) DEFAULT NULL,
  `id_disc` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `professor_disciplina`
--

INSERT INTO `professor_disciplina` (`id`, `id_prof`, `id_disc`) VALUES
(8, 47, 4);

-- --------------------------------------------------------

--
-- Estrutura para tabela `professor_turma`
--

CREATE TABLE `professor_turma` (
  `id` int(11) NOT NULL,
  `id_prof` int(11) NOT NULL,
  `id_turma` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `professor_turma`
--

INSERT INTO `professor_turma` (`id`, `id_prof`, `id_turma`) VALUES
(4, 35, 4),
(9, 47, 4);

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
  `descricao` varchar(100) DEFAULT NULL,
  `id_curso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `turma`
--

INSERT INTO `turma` (`id`, `nome`, `sala`, `descricao`, `id_curso`) VALUES
(4, 42, 202, 'Essa é uma turma de teste', 8),
(5, 43, 203, 'segundo teste de turma', 8),
(16, 44, 44, '444444', 8);

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
('teste_cpf', 'teste_Siape', NULL, 19, 'teste@gmail.com', 'teste', 'teste19', ''),
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
('777.777.777', '4328947', 'fotos/10-09-2024-mem 3.jpg', 42, 'GalPodre@gmail.com', 'Mahavre', 'fim', 'nenhum'),
('teste', 'teste', 'fotos/20-11-2024-azevinho.png', 47, 'teste@gmail.com', 'teste professor 3', 'teste', 'teste');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `aluno`
--
ALTER TABLE `aluno`
  ADD PRIMARY KEY (`matricula`),
  ADD KEY `id_turma` (`id_turma`);

--
-- Índices de tabela `avaliacao`
--
ALTER TABLE `avaliacao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_disc` (`id_disc`),
  ADD KEY `id_aluno` (`id_aluno`);

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
-- Índices de tabela `disciplina_turma`
--
ALTER TABLE `disciplina_turma`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_disc` (`id_disc`),
  ADD KEY `id_turma` (`id_turma`);

--
-- Índices de tabela `favorita`
--
ALTER TABLE `favorita`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_us` (`id_us`),
  ADD KEY `id_turma` (`id_turma`);

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
-- Índices de tabela `professor_disciplina`
--
ALTER TABLE `professor_disciplina`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_prof` (`id_prof`),
  ADD KEY `id_disc` (`id_disc`);

--
-- Índices de tabela `professor_turma`
--
ALTER TABLE `professor_turma`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_prof` (`id_prof`),
  ADD KEY `professor_turma_ibfk_1` (`id_turma`);

--
-- Índices de tabela `setor`
--
ALTER TABLE `setor`
  ADD PRIMARY KEY (`id_set`);

--
-- Índices de tabela `turma`
--
ALTER TABLE `turma`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_curso` (`id_curso`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_us`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `avaliacao`
--
ALTER TABLE `avaliacao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `comentario`
--
ALTER TABLE `comentario`
  MODIFY `id_coment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de tabela `curso`
--
ALTER TABLE `curso`
  MODIFY `id_curso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `disciplina`
--
ALTER TABLE `disciplina`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `disciplina_turma`
--
ALTER TABLE `disciplina_turma`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `favorita`
--
ALTER TABLE `favorita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `lembrete`
--
ALTER TABLE `lembrete`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `professor_disciplina`
--
ALTER TABLE `professor_disciplina`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `professor_turma`
--
ALTER TABLE `professor_turma`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `turma`
--
ALTER TABLE `turma`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_us` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `aluno`
--
ALTER TABLE `aluno`
  ADD CONSTRAINT `aluno_ibfk_1` FOREIGN KEY (`id_turma`) REFERENCES `turma` (`id`);

--
-- Restrições para tabelas `avaliacao`
--
ALTER TABLE `avaliacao`
  ADD CONSTRAINT `avaliacao_ibfk_1` FOREIGN KEY (`id_disc`) REFERENCES `disciplina` (`id`),
  ADD CONSTRAINT `avaliacao_ibfk_2` FOREIGN KEY (`id_aluno`) REFERENCES `aluno` (`matricula`);

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
-- Restrições para tabelas `disciplina_turma`
--
ALTER TABLE `disciplina_turma`
  ADD CONSTRAINT `disciplina_turma_ibfk_1` FOREIGN KEY (`id_disc`) REFERENCES `disciplina` (`id`),
  ADD CONSTRAINT `disciplina_turma_ibfk_2` FOREIGN KEY (`id_turma`) REFERENCES `turma` (`id`);

--
-- Restrições para tabelas `favorita`
--
ALTER TABLE `favorita`
  ADD CONSTRAINT `favorita_ibfk_1` FOREIGN KEY (`id_us`) REFERENCES `usuario` (`id_us`),
  ADD CONSTRAINT `favorita_ibfk_2` FOREIGN KEY (`id_turma`) REFERENCES `turma` (`id`);

--
-- Restrições para tabelas `professor`
--
ALTER TABLE `professor`
  ADD CONSTRAINT `professor_ibfk_1` FOREIGN KEY (`id_prof`) REFERENCES `usuario` (`id_us`);

--
-- Restrições para tabelas `professor_disciplina`
--
ALTER TABLE `professor_disciplina`
  ADD CONSTRAINT `professor_disciplina_ibfk_1` FOREIGN KEY (`id_prof`) REFERENCES `professor` (`id_prof`),
  ADD CONSTRAINT `professor_disciplina_ibfk_2` FOREIGN KEY (`id_disc`) REFERENCES `disciplina` (`id`);

--
-- Restrições para tabelas `professor_turma`
--
ALTER TABLE `professor_turma`
  ADD CONSTRAINT `professor_turma_ibfk_1` FOREIGN KEY (`id_turma`) REFERENCES `turma` (`id`),
  ADD CONSTRAINT `professor_turma_ibfk_2` FOREIGN KEY (`id_prof`) REFERENCES `professor` (`id_prof`);

--
-- Restrições para tabelas `setor`
--
ALTER TABLE `setor`
  ADD CONSTRAINT `setor_ibfk_1` FOREIGN KEY (`id_set`) REFERENCES `usuario` (`id_us`);

--
-- Restrições para tabelas `turma`
--
ALTER TABLE `turma`
  ADD CONSTRAINT `turma_ibfk_1` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
