-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 03/02/2025 às 23:42
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
  `id_turma` int(11) NOT NULL,
  `foto` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `aluno`
--

INSERT INTO `aluno` (`matricula`, `telefone`, `email`, `nome`, `genero`, `cidade`, `dataNasc`, `moradia`, `cota`, `bolsa`, `orientador`, `reprovacao`, `equipTI`, `estagio`, `cpf`, `acompanhamento`, `id_turma`, `foto`) VALUES
(111, '22', 'c@gmail.com', 'esperança', 'g', 'c', '2025-01-28', 'telefone', 'teste', 'd', 'teste', 'd', 'teste', 'teste', '02474728082', 'n', 25, 'fotos/03-02-2025-Olho seco.jpg'),
(222, '4', 'bah@gmail.com', 'ttbrttt', 'tt', 'tt', '2025-02-05', 'nao', '3', 't', 't', '4', 't', 't', '3', 'tem', 25, ''),
(333, '234234', 'wer@gmail.com', 'SuperFly', 'wer', 'wer', 'wer', 'wer', 'wer', 'wer', 'wer', 'wer', 'wer', 'wer', 'wer', 'wer', 25, 'fotos/03-02-2025-deus da frustração.jpg'),
(6354, '888', 'emil@gmail.com', 'nome', 'genero', 'ci', 'nasc', 'mor', 'cot', 'bol', 'or', 'rep', 'equip', 'est', 'cpf', 'acomp', 25, ''),
(787878, '513', 'tomei@gmail.com', 'super aluno', 'masculino', 'palmitinho', '2025-02-18', 'não', 'LI_EP', 'tem', 'Godofredo', 'sim, várias', 'nenhum', '4', '8', 'batata frita', 25, '');

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

--
-- Despejando dados para a tabela `avaliacao`
--

INSERT INTO `avaliacao` (`id`, `id_disc`, `id_aluno`, `PPI`, `AIS`, `AIA`, `NOTA1`, `NOTA2`, `MC`) VALUES
(9, 5, 6354, 6, 6, 6, 4, 6, 6),
(10, 5, 787878, 8, 8, 8, 8, 8, 8),
(13, 2, 6354, 7, 7, 7, 7, 7, 7),
(17, 4, 6354, 8, 8, 8, 8, 8, 8),
(18, 4, 787878, 6, 6, 6, 6, 6, 6),
(19, 4, 111, 9, 9, 9, 9, 9, 9),
(20, 5, 111, 9, 9, 9, 9, 9, 9);

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
(10, 'nada', 'descricao                    ', 'oiee', 'fotos/12-12-2024-mago normal.jpg', 48);

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
(4, 'disciplina de teste para procura ', 'teste de pesquisa de id'),
(5, 'Economia aplicada', 'Aqui, você aprende a usar seu conhecimento de economia no mundo real'),
(6, 'disciplina de teste de select dos cursos', NULL);

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
(19, 5, 25),
(21, 4, 25);

-- --------------------------------------------------------

--
-- Estrutura para tabela `favorita`
--

CREATE TABLE `favorita` (
  `id` int(11) NOT NULL,
  `id_us` int(11) DEFAULT NULL,
  `id_turma` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `frequencia`
--

CREATE TABLE `frequencia` (
  `id` int(11) NOT NULL,
  `disciplina` int(11) NOT NULL,
  `matricula` int(11) NOT NULL,
  `faltas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `frequencia`
--

INSERT INTO `frequencia` (`id`, `disciplina`, `matricula`, `faltas`) VALUES
(5, 5, 6354, 1),
(6, 4, 6354, 3),
(7, 4, 787878, 8),
(8, 5, 111, 2),
(9, 5, 787878, 5);

-- --------------------------------------------------------

--
-- Estrutura para tabela `historico`
--

CREATE TABLE `historico` (
  `id` int(11) NOT NULL,
  `id_us` int(11) NOT NULL,
  `descricao` varchar(200) NOT NULL,
  `dat` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `historico`
--

INSERT INTO `historico` (`id`, `id_us`, `descricao`, `dat`) VALUES
(1, 28, '0', NULL),
(2, 28, '0', NULL),
(3, 28, '0', NULL),
(4, 28, '0', NULL),
(5, 28, 'Usuário realizou a exclusão do curso de nome \'', NULL),
(6, 28, 'Usuário realizou a exclusão do curso de nome t', NULL),
(7, 28, 'Usuário realizou uma alteração no curso de nome ', NULL),
(8, 28, 'Usuário realizou uma alteração no curso de nome ', NULL),
(9, 28, 'Usuário realizou uma alteração no curso de nome ', NULL),
(10, 28, 'Usuário realizou uma alteração no curso de nome      nada4', NULL),
(11, 28, 'Usuário realizou uma alteração no curso de nome      nada6', NULL),
(12, 28, 'Usuário realizou uma alteração no curso de nome       nada7', NULL),
(13, 28, 'Usuário realizou uma alteração no curso de nome       nada8', NULL),
(14, 28, 'Usuário realizou uma alteração no curso de nome nada9', NULL),
(15, 28, 'Usuário realizou uma alteração no curso de nome          nada10', NULL),
(16, 28, 'Usuário realizou uma alteração no curso de nome   nada11', NULL),
(17, 28, 'Usuário realizou uma alteração no curso de nome   nada11', NULL),
(18, 28, 'Usuário realizou uma alteração no curso de nome   nada11', NULL),
(19, 28, 'Usuário realizou uma alteração no curso de nome X', NULL),
(20, 28, 'Usuário realizou uma alteração no curso de nome    XXXX', NULL),
(21, 28, 'Usuário realizou uma alteração no curso de nome hhhhh', NULL),
(22, 28, 'Usuário realizou uma alteração no curso de nome hhhhh', NULL),
(23, 28, 'Usuário realizou uma alteração no curso de nome hhhhh', NULL),
(24, 28, 'Usuário realizou uma alteração no curso de nome aaaaaaaaaaaaaaaaaaaaaa', NULL),
(25, 28, 'Usuário realizou uma alteração no curso de nome oi', NULL),
(26, 28, 'Usuário realizou uma alteração no professor de nome ramon do teste', NULL),
(27, 28, 'Usuário realizou uma alteração no professor de nome  ramon do teste2', NULL),
(28, 28, 'Usuário realizou uma alteração no professor de nome   ramon do teste9', NULL),
(29, 28, 'Usuário realizou uma alteração no professor de nome   ramon do teste9', NULL),
(30, 28, 'Usuário realizou uma alteração no professor de nome    ramon do teste93', NULL),
(31, 28, 'Usuário realizou uma alteração no professor de nome    ramon do teste93', NULL),
(32, 28, 'Usuário realizou uma alteração no professor de nome     ramon do teste933', NULL),
(33, 28, 'Usuário realizou uma alteração no professor de nome ramon do tete9933', NULL),
(34, 28, 'Usuário realizou uma alteração no professor de nome x', NULL),
(35, 28, 'Usuário realizou uma alteração no professor de nome Joao do teste', NULL),
(36, 28, 'Usuário realizou uma alteração no professor de nome Joao do teste9', NULL),
(37, 28, 'Usuário excluiu o professor de nome pp', '0000-00-00'),
(38, 28, 'Usuário excluiu o professor de nome pp', '0000-00-00'),
(39, 28, 'teste', '0000-00-00'),
(40, 28, 'Usuário excluiu o professor de nome pp', '0000-00-00'),
(41, 28, 'teste', '2025-01-31'),
(42, 28, 'Usuário excluiu o professor de nome pp', '2025-01-31'),
(43, 28, 'Usuário realizou uma alteração na disciplina de nome Disciplina teste 2', '2025-02-02'),
(44, 28, 'Usuário realizou uma alteração na disciplina de nome disciplina de teste para procura ', '2025-02-02'),
(45, 28, 'Usuário realizou uma alteração na disciplina de nome Disciplina teste 2', '2025-02-02'),
(46, 28, 'Usuário realizou uma alteração na disciplina de nome disciplina de teste para procura ', '2025-02-02'),
(47, 28, 'Usuário realizou uma alteração na disciplina de nome Disciplina teste 2', '2025-02-02'),
(48, 28, 'Usuário realizou uma alteração na disciplina de nome disciplina de teste para procura ', '2025-02-02'),
(49, 28, 'Usuário realizou uma alteração na disciplina de nome Disciplina teste 2', '2025-02-02'),
(50, 28, 'Usuário realizou uma alteração na disciplina de nome disciplina de teste para procura ', '2025-02-02'),
(51, 28, 'Usuário realizou uma alteração na disciplina de nome Disciplina teste 2', '2025-02-02'),
(52, 28, 'Usuário realizou uma alteração na disciplina de nome disciplina de teste para procura ', '2025-02-02'),
(53, 28, 'Usuário realizou uma alteração na disciplina de nome teste disciplina novo', '2025-02-02'),
(54, 28, 'Usuário realizou uma alteração na disciplina de nome Disciplina teste 2', '2025-02-02'),
(55, 28, 'Usuário realizou uma alteração na disciplina de nome disciplina de teste para procura ', '2025-02-02'),
(56, 28, 'Usuário realizou uma alteração na disciplina de nome teste disciplina novo', '2025-02-02'),
(57, 28, 'Usuário realizou uma alteração na disciplina de nome Disciplina teste 2', '2025-02-02'),
(58, 28, 'Usuário realizou uma alteração na disciplina de nome disciplina de teste para procura ', '2025-02-02'),
(59, 28, 'Usuário realizou uma alteração na disciplina de nome teste disciplina novo', '2025-02-02'),
(60, 28, 'Usuário realizou uma alteração na disciplina de nome Disciplina teste 2', '2025-02-02'),
(61, 28, 'Usuário realizou uma alteração na disciplina de nome disciplina de teste para procura ', '2025-02-02'),
(62, 28, 'Usuário realizou uma alteração na disciplina de nome teste disciplina novo', '2025-02-02'),
(63, 28, 'Usuário realizou uma alteração na disciplina de nome Disciplina teste 2', '2025-02-02'),
(64, 28, 'Usuário realizou uma alteração na disciplina de nome teste disciplina novo', '2025-02-02'),
(65, 28, 'Usuário realizou uma alteração na disciplina de nome disciplina de teste para procura ', '2025-02-02'),
(66, 28, 'Usuário realizou uma alteração na disciplina de nome Economia aplicada', '2025-02-02'),
(67, 28, 'Usuário realizou uma alteração na disciplina de nome Disciplina teste 2', '2025-02-02'),
(68, 28, 'Usuário realizou uma alteração na disciplina de nome teste disciplina novo', '2025-02-02'),
(69, 28, 'Usuário realizou uma alteração na disciplina de nome disciplina de teste para procura ', '2025-02-02'),
(70, 28, 'Usuário realizou uma alteração na disciplina de nome Economia aplicada', '2025-02-02'),
(71, 28, 'Usuário realizou uma alteração na disciplina de nome Disciplina teste 2', '2025-02-02'),
(72, 28, 'Usuário realizou uma alteração na disciplina de nome disciplina de teste para procura ', '2025-02-02'),
(73, 28, 'Usuário realizou uma alteração na disciplina de nome teste disciplina novo', '2025-02-02'),
(74, 28, 'Usuário realizou uma alteração na disciplina de nome Economia aplicada', '2025-02-02'),
(75, 28, 'Usuário realizou uma alteração na disciplina de nome Disciplina teste 2', '2025-02-02'),
(76, 28, 'Usuário realizou uma alteração na disciplina de nome disciplina de teste para procura ', '2025-02-02'),
(77, 28, 'Usuário realizou uma alteração na disciplina de nome teste disciplina novo', '2025-02-02'),
(78, 28, 'Usuário realizou uma alteração na disciplina de nome Economia aplicada', '2025-02-02'),
(79, 28, 'Usuário realizou uma alteração na disciplina de nome ', '2025-02-02'),
(80, 28, 'Usuário realizou uma alteração na disciplina de nome Disciplina teste 2', '2025-02-02'),
(81, 28, 'Usuário realizou uma alteração na disciplina de nome disciplina de teste para procura ', '2025-02-02'),
(82, 28, 'Usuário realizou uma alteração na disciplina de nome teste disciplina novo', '2025-02-02'),
(83, 28, 'Usuário realizou uma alteração na disciplina de nome Economia aplicada', '2025-02-02'),
(84, 28, 'Usuário realizou a remoção de uma disciplina do professor de nome ', '2025-02-02'),
(85, 28, 'Usuário realizou a remoção de uma disciplina do professor de nome  Vinícius P Polastri', '2025-02-02'),
(86, 28, 'Usuário realizou uma alteração na disciplina de nome disciplina de teste para procura ', '2025-02-02'),
(87, 28, 'Usuário realizou a remoção de uma disciplina do professor de nome  Vinícius P Polastri', '2025-02-02'),
(88, 28, 'Usuário realizou uma alteração na disciplina de nome Economia aplicada', '2025-02-02'),
(89, 28, 'Usuário realizou a remoção de uma disciplina do professor de nome ', '2025-02-02'),
(90, 28, 'Usuário realizou uma alteração na disciplina de nome disciplina de teste para procura ', '2025-02-02'),
(91, 28, 'Usuário realizou a remoção de uma disciplina do professor de nome ', '2025-02-02'),
(92, 28, 'Usuário realizou uma alteração na disciplina de nome Economia aplicada', '2025-02-02'),
(93, 28, 'Usuário realizou a remoção de uma disciplina do professor de nome ', '2025-02-02'),
(94, 28, 'Usuário realizou uma alteração na disciplina de nome disciplina de teste para procura ', '2025-02-02'),
(95, 28, 'Usuário realizou a remoção de uma disciplina do professor de nome ', '2025-02-02'),
(96, 28, 'Usuário realizou uma alteração na disciplina de nome Economia aplicada', '2025-02-02'),
(97, 28, 'Usuário realizou a remoção de uma disciplina do professor de nome ', '2025-02-02'),
(98, 28, 'Usuário realizou uma alteração na disciplina de nome disciplina de teste para procura ', '2025-02-02'),
(99, 28, 'Usuário realizou a remoção de uma disciplina do professor de nome ', '2025-02-02'),
(100, 28, 'Usuário realizou uma alteração na disciplina de nome Economia aplicada', '2025-02-02'),
(101, 28, 'Usuário realizou uma alteração na disciplina de nome disciplina de teste para procura ', '2025-02-02'),
(102, 28, 'Usuário realizou uma alteração na disciplina de nome Economia aplicada', '2025-02-02'),
(103, 28, 'Usuário realizou uma alteração na disciplina de nome disciplina de teste para procura ', '2025-02-02'),
(104, 28, 'Usuário realizou uma alteração na disciplina de nome Economia aplicada', '2025-02-02'),
(105, 28, 'Usuário realizou uma alteração na disciplina de nome disciplina de teste para procura ', '2025-02-02'),
(106, 28, 'Usuário realizou a remoção de uma disciplina do professor de nome  Vinícius P Polastri', '2025-02-02'),
(107, 28, 'Usuário realizou uma alteração na disciplina de nome Economia aplicada', '2025-02-02'),
(108, 28, 'Usuário realizou uma alteração na disciplina de nome Economia aplicada', '2025-02-02'),
(109, 28, 'Usuário realizou uma alteração na disciplina de nome Economia aplicada', '2025-02-02'),
(110, 28, 'Usuário realizou uma alteração na disciplina de nome disciplina de teste para procura ', '2025-02-02'),
(111, 28, 'Usuário realizou uma alteração na disciplina de nome Economia aplicada', '2025-02-02'),
(112, 28, 'Usuário realizou uma alteração na disciplina de nome disciplina de teste para procura ', '2025-02-02'),
(113, 28, 'Usuário realizou a remoção de uma disciplina do professor de nome  Vinícius P Polastri', '2025-02-02'),
(114, 28, 'Usuário realizou uma alteração na disciplina de nome disciplina de teste para procura ', '2025-02-02'),
(115, 28, 'Usuário realizou uma alteração na disciplina de nome Economia aplicada', '2025-02-02'),
(116, 28, 'Usuário realizou uma alteração no aluno de nome rew', '2025-02-03'),
(117, 28, 'Usuário realizou uma alteração no aluno de nome rew', '2025-02-03'),
(118, 28, 'Usuário realizou uma alteração no aluno de nome rew', '2025-02-03'),
(119, 28, 'Usuário realizou uma alteração no aluno de nome esperança', '2025-02-03'),
(120, 28, 'Usuário realizou uma alteração no aluno de nome t', '2025-02-03'),
(121, 28, 'Usuário realizou uma alteração no aluno de nome t', '2025-02-03');

-- --------------------------------------------------------

--
-- Estrutura para tabela `lembrete`
--

CREATE TABLE `lembrete` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `descricao` varchar(200) DEFAULT NULL,
  `dt` date DEFAULT NULL,
  `id_us` int(11) NOT NULL,
  `limite_relatorio` tinyint(1) NOT NULL,
  `limite_plano` tinyint(1) NOT NULL,
  `limite_recuperacao` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `lembrete`
--

INSERT INTO `lembrete` (`id`, `nome`, `descricao`, `dt`, `id_us`, `limite_relatorio`, `limite_plano`, `limite_recuperacao`) VALUES
(6, 'mais um lembrete', 'outro lembrete', '2024-11-28', 28, 0, 1, 0),
(7, 'Limite teste1', 'teste de limites', '2025-02-11', 28, 1, 0, 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `plano`
--

CREATE TABLE `plano` (
  `id` int(11) NOT NULL,
  `prof` int(11) NOT NULL,
  `disc` int(11) NOT NULL,
  `turma` int(11) NOT NULL,
  `arquivo` varchar(200) NOT NULL,
  `dat` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `plano`
--

INSERT INTO `plano` (`id`, `prof`, `disc`, `turma`, `arquivo`, `dat`) VALUES
(1, 48, 4, 25, 'planos/2025-02-03_11-1-document.pdf', '2025-02-03');

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
(38, 'nenhuma'),
(41, 'nada'),
(48, NULL);

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
(34, 48, 4),
(52, 48, 5);

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
(16, 48, 25);

-- --------------------------------------------------------

--
-- Estrutura para tabela `recuperacao`
--

CREATE TABLE `recuperacao` (
  `id` int(11) NOT NULL,
  `arquivo` varchar(250) NOT NULL,
  `professor` int(11) NOT NULL,
  `disciplina` int(11) NOT NULL,
  `turma` int(11) NOT NULL,
  `dat` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `recuperacao`
--

INSERT INTO `recuperacao` (`id`, `arquivo`, `professor`, `disciplina`, `turma`, `dat`) VALUES
(3, 'recuperacoes/2025-02-03_10-1-document.pdf', 48, 4, 25, '2025-02-03');

-- --------------------------------------------------------

--
-- Estrutura para tabela `relatorio`
--

CREATE TABLE `relatorio` (
  `id` int(11) NOT NULL,
  `prof` int(11) NOT NULL,
  `disc` int(11) NOT NULL,
  `turma` int(11) NOT NULL,
  `arquivo` varchar(200) NOT NULL,
  `dat` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `relatorio`
--

INSERT INTO `relatorio` (`id`, `prof`, `disc`, `turma`, `arquivo`, `dat`) VALUES
(4, 48, 4, 25, 'relatorios/2025-02-03_11-1-document.pdf', '2025-02-03');

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
(25, 78, 204, 'essa é uma turma de teste para garantir que o add aluno está funcionando', 10);

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
('036.114.170', '99', 'fotos/08-09-2024-8asm99.jpg', 36, 'theplaguerofc@gmail.com', 'Ramon', 'Maconharia', ''),
('sigmaligma', 'teste', 'fotos/08-09-2024-ramsesii.png', 37, 'Thales@gmail.com.br', 'teste', 'pou', ''),
('    090909', '    020202    ', 'fotos/09-09-2024-ramsesii.png', 38, 'ramonx@gmail.com', '    ramon do teste933', 'testeteste', '        '),
('yyyyy', 'impssivel', 'fotos/09-09-2024-chapéu papai noel.png', 39, 'muito@gmail.com', 'Soqueira', 'ter', ''),
('036.114.170', 'never', 'fotos/09-09-2024-deus da frustração símbolo.jpg', 40, 'naosei@gmail.com', 'juninho', 'elveis prisles', '69696969696'),
('NUNCA', '99   ', 'fotos/09-09-2024-Tonho morte.jpg', 41, 'GalPodre@gmail.com', 'Joao do teste97', 'Maconharia', 'ter   '),
('777.777.777', '4328947', 'fotos/10-09-2024-mem 3.jpg', 42, 'GalPodre@gmail.com', 'Mahavre', 'fim', 'nenhum'),
(' sigma', ' 122 ', 'fotos/23-11-2024-Vinícius conhecimento.jpg', 48, 'canoafurada@gmail.com', ' Vinícius P Polastri', 'troll2', ' 0800 ');

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
-- Índices de tabela `frequencia`
--
ALTER TABLE `frequencia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `matricula` (`matricula`),
  ADD KEY `disciplina` (`disciplina`);

--
-- Índices de tabela `historico`
--
ALTER TABLE `historico`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_us` (`id_us`);

--
-- Índices de tabela `lembrete`
--
ALTER TABLE `lembrete`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_us` (`id_us`);

--
-- Índices de tabela `plano`
--
ALTER TABLE `plano`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prof` (`prof`),
  ADD KEY `disc` (`disc`),
  ADD KEY `turma` (`turma`);

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
-- Índices de tabela `recuperacao`
--
ALTER TABLE `recuperacao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `disciplina` (`disciplina`),
  ADD KEY `professor` (`professor`),
  ADD KEY `turma` (`turma`);

--
-- Índices de tabela `relatorio`
--
ALTER TABLE `relatorio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `relatorio_ibfk_1` (`disc`),
  ADD KEY `relatorio_ibfk_2` (`prof`),
  ADD KEY `relatorio_ibfk_3` (`turma`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `comentario`
--
ALTER TABLE `comentario`
  MODIFY `id_coment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de tabela `curso`
--
ALTER TABLE `curso`
  MODIFY `id_curso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de tabela `disciplina`
--
ALTER TABLE `disciplina`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `disciplina_turma`
--
ALTER TABLE `disciplina_turma`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de tabela `favorita`
--
ALTER TABLE `favorita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `frequencia`
--
ALTER TABLE `frequencia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `historico`
--
ALTER TABLE `historico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT de tabela `lembrete`
--
ALTER TABLE `lembrete`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `plano`
--
ALTER TABLE `plano`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `professor_disciplina`
--
ALTER TABLE `professor_disciplina`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de tabela `professor_turma`
--
ALTER TABLE `professor_turma`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `recuperacao`
--
ALTER TABLE `recuperacao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `relatorio`
--
ALTER TABLE `relatorio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `turma`
--
ALTER TABLE `turma`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_us` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

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
-- Restrições para tabelas `frequencia`
--
ALTER TABLE `frequencia`
  ADD CONSTRAINT `frequencia_ibfk_1` FOREIGN KEY (`matricula`) REFERENCES `aluno` (`matricula`),
  ADD CONSTRAINT `frequencia_ibfk_2` FOREIGN KEY (`disciplina`) REFERENCES `disciplina` (`id`);

--
-- Restrições para tabelas `historico`
--
ALTER TABLE `historico`
  ADD CONSTRAINT `historico_ibfk_1` FOREIGN KEY (`id_us`) REFERENCES `usuario` (`id_us`);

--
-- Restrições para tabelas `lembrete`
--
ALTER TABLE `lembrete`
  ADD CONSTRAINT `lembrete_ibfk_1` FOREIGN KEY (`id_us`) REFERENCES `setor` (`id_set`);

--
-- Restrições para tabelas `plano`
--
ALTER TABLE `plano`
  ADD CONSTRAINT `plano_ibfk_1` FOREIGN KEY (`prof`) REFERENCES `professor` (`id_prof`),
  ADD CONSTRAINT `plano_ibfk_2` FOREIGN KEY (`disc`) REFERENCES `disciplina` (`id`),
  ADD CONSTRAINT `plano_ibfk_3` FOREIGN KEY (`turma`) REFERENCES `turma` (`id`);

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
-- Restrições para tabelas `recuperacao`
--
ALTER TABLE `recuperacao`
  ADD CONSTRAINT `recuperacao_ibfk_1` FOREIGN KEY (`disciplina`) REFERENCES `disciplina` (`id`),
  ADD CONSTRAINT `recuperacao_ibfk_2` FOREIGN KEY (`professor`) REFERENCES `professor` (`id_prof`),
  ADD CONSTRAINT `recuperacao_ibfk_3` FOREIGN KEY (`turma`) REFERENCES `turma` (`id`);

--
-- Restrições para tabelas `relatorio`
--
ALTER TABLE `relatorio`
  ADD CONSTRAINT `relatorio_ibfk_1` FOREIGN KEY (`disc`) REFERENCES `disciplina` (`id`),
  ADD CONSTRAINT `relatorio_ibfk_2` FOREIGN KEY (`prof`) REFERENCES `professor` (`id_prof`),
  ADD CONSTRAINT `relatorio_ibfk_3` FOREIGN KEY (`turma`) REFERENCES `turma` (`id`);

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
