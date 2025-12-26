-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 12/12/2025 às 22:40
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `palpitao_db`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `jogadores`
--

CREATE TABLE `jogadores` (
  `id_jogadores` int(11) NOT NULL,
  `nome` varchar(20) DEFAULT NULL,
  `senha` varchar(200) DEFAULT NULL,
  `foto_perfil` blob DEFAULT NULL,
  `pontos` int(11) DEFAULT 0,
  `colocacao_atual` int(11) DEFAULT 1,
  `pontos_na_rodada` int(11) DEFAULT NULL,
  `reposicionamento` char(1) DEFAULT NULL,
  `adm` tinyint(4) DEFAULT 0,
  `colocacao_anterior` int(11) DEFAULT NULL,
  `titulo_de_posicao` varchar(20) DEFAULT NULL,
  `divida` float DEFAULT 0,
  `cem_porcento` float DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `jogadores`
--

INSERT INTO `jogadores` (`id_jogadores`, `nome`, `senha`, `foto_perfil`, `pontos`, `colocacao_atual`, `pontos_na_rodada`, `reposicionamento`, `adm`, `colocacao_anterior`, `titulo_de_posicao`, `divida`, `cem_porcento`, `status`) VALUES
(1, 'Kauê', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', NULL, 0, 1, 0, NULL, 0, 1, NULL, 0, 0, 1),
(2, 'Luizinho', NULL, NULL, 0, 1, 0, NULL, 1, 1, NULL, 0, 0, 1),
(3, 'Bruno', NULL, NULL, 0, 1, 0, NULL, 0, 1, NULL, 0, 0, 1),
(4, 'Chulapa458', NULL, NULL, 0, 1, 0, NULL, 0, 1, NULL, 0, 0, 1),
(5, 'Daniel 1983', NULL, NULL, 0, 1, 0, NULL, 0, 1, NULL, 0, 0, 1),
(6, 'David', NULL, NULL, 0, 1, 0, NULL, 0, 1, NULL, 0, 0, 1),
(7, 'Derna', NULL, NULL, 0, 1, 0, NULL, 0, 1, NULL, 0, 0, 1),
(8, 'Léo', NULL, NULL, 0, 1, 0, NULL, 0, 1, NULL, 0, 0, 1),
(9, 'Juliano', NULL, NULL, 0, 1, 0, NULL, 0, 1, NULL, 0, 0, 1),
(10, 'Édson Ortiz', NULL, NULL, 0, 1, 0, NULL, 0, 1, NULL, 0, 0, 1),
(11, 'Serginho', NULL, NULL, 0, 1, 0, NULL, 0, 1, NULL, 0, 0, 1),
(12, 'Cláudio', NULL, NULL, 0, 1, 0, NULL, 0, 1, NULL, 0, 0, 1),
(13, 'Felipe Paixão', NULL, NULL, 0, 1, 0, NULL, 0, 1, NULL, 0, 0, 1),
(14, 'Santiago', NULL, NULL, 0, 1, 0, NULL, 0, 1, NULL, 0, 0, 1),
(15, 'Tafarel', NULL, NULL, 0, 1, 0, NULL, 0, 1, NULL, 0, 0, 1),
(16, 'Valdoir', NULL, NULL, 0, 1, 0, NULL, 0, 1, NULL, 0, 0, 1),
(17, 'Perdigão', NULL, NULL, 0, 1, 0, NULL, 0, 1, NULL, 0, 0, 1),
(18, 'Maninho', NULL, NULL, 0, 1, 0, NULL, 0, 1, NULL, 0, 0, 1),
(19, 'André', NULL, NULL, 0, 1, 0, NULL, 0, 1, NULL, 0, 0, 1),
(20, 'Dalvir', NULL, NULL, 0, 1, 0, NULL, 0, 1, NULL, 0, 0, 1),
(21, 'Camilo', NULL, NULL, 0, 1, 0, NULL, 0, 1, NULL, 0, 0, 1),
(22, 'Maurício', NULL, NULL, 0, 1, 0, NULL, 0, 1, NULL, 0, 0, 1),
(23, 'Paulinho', NULL, NULL, 0, 1, 0, NULL, 0, 1, NULL, 0, 0, 1),
(24, 'Diomar', NULL, NULL, 0, 1, 0, NULL, 0, 1, NULL, 0, 0, 1),
(25, 'Zé', NULL, NULL, 0, 1, 0, NULL, 0, 1, NULL, 0, 0, 1),
(26, 'Alemão', NULL, NULL, 0, 1, 0, NULL, 0, 1, NULL, 0, 0, 1),
(27, 'Leco', NULL, NULL, 0, 1, 0, NULL, 0, 1, NULL, 0, 0, 1),
(28, 'Didi', NULL, NULL, 0, 1, 0, NULL, 0, 1, NULL, 0, 0, 1),
(29, 'Xande', NULL, NULL, 0, 1, 0, NULL, 0, 1, NULL, 0, 0, 1),
(30, 'Chiquinho', NULL, NULL, 0, 1, 0, NULL, 0, 1, NULL, 0, 0, 1),
(31, 'Fábio Macedo', NULL, NULL, 0, 1, 0, NULL, 0, 1, NULL, 0, 0, 1),
(32, 'Vinicius', NULL, NULL, 0, 1, 0, NULL, 0, 1, NULL, 0, 0, 1),
(33, 'Fábio', NULL, NULL, 0, 1, 0, NULL, 0, 1, NULL, 0, 0, 1),
(34, 'Mano', NULL, NULL, 0, 1, 0, NULL, 0, 1, NULL, 0, 0, 1),
(35, 'Carlos', NULL, NULL, 0, 1, 0, NULL, 0, 1, NULL, 0, 0, 1),
(36, 'Diorgy', NULL, NULL, 0, 1, 0, NULL, 0, 1, NULL, 0, 0, 1),
(37, 'Pancada', NULL, NULL, 0, 1, 0, NULL, 0, 1, NULL, 0, 0, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `jogos_da_rodada`
--

CREATE TABLE `jogos_da_rodada` (
  `id_jogo` int(11) NOT NULL,
  `quantida_gols_casa` int(11) DEFAULT NULL,
  `quantidade_gols_fora` int(11) DEFAULT NULL,
  `resultado_casa` char(1) DEFAULT NULL,
  `time_casa` varchar(40) DEFAULT NULL,
  `time_fora` varchar(40) DEFAULT NULL,
  `id_rodada` int(11) DEFAULT 1,
  `numero_do_jogo` int(11) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'Em andamento'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `pagamentos`
--

CREATE TABLE `pagamentos` (
  `id_pagamento` int(11) NOT NULL,
  `valor` float NOT NULL,
  `data_pagamento` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `id_jogador` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `palpites`
--

CREATE TABLE `palpites` (
  `id_palpites` int(11) NOT NULL,
  `quantidade_gols_casa` int(11) DEFAULT NULL,
  `quantidade_gols_fora` int(11) DEFAULT NULL,
  `resultado_casa` char(1) DEFAULT NULL,
  `time_casa` varchar(30) DEFAULT NULL,
  `time_fora` varchar(30) DEFAULT NULL,
  `id_jogadores` int(11) DEFAULT NULL,
  `id_jogos` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `jogadores`
--
ALTER TABLE `jogadores`
  ADD PRIMARY KEY (`id_jogadores`);

--
-- Índices de tabela `jogos_da_rodada`
--
ALTER TABLE `jogos_da_rodada`
  ADD PRIMARY KEY (`id_jogo`),
  ADD KEY `fk_jogos_rodada` (`id_rodada`);

--
-- Índices de tabela `pagamentos`
--
ALTER TABLE `pagamentos`
  ADD PRIMARY KEY (`id_pagamento`),
  ADD KEY `fk_pagamentos_jogadores` (`id_jogador`);

--
-- Índices de tabela `palpites`
--
ALTER TABLE `palpites`
  ADD PRIMARY KEY (`id_palpites`),
  ADD KEY `fk_palpites_jogadores` (`id_jogadores`),
  ADD KEY `fk_palpites_jogos` (`id_jogos`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `jogadores`
--
ALTER TABLE `jogadores`
  MODIFY `id_jogadores` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de tabela `jogos_da_rodada`
--
ALTER TABLE `jogos_da_rodada`
  MODIFY `id_jogo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pagamentos`
--
ALTER TABLE `pagamentos`
  MODIFY `id_pagamento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `palpites`
--
ALTER TABLE `palpites`
  MODIFY `id_palpites` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `pagamentos`
--
ALTER TABLE `pagamentos`
  ADD CONSTRAINT `fk_pagamentos_jogadores` FOREIGN KEY (`id_jogador`) REFERENCES `jogadores` (`id_jogadores`);

--
-- Restrições para tabelas `palpites`
--
ALTER TABLE `palpites`
  ADD CONSTRAINT `fk_palpites_jogadores` FOREIGN KEY (`id_jogadores`) REFERENCES `jogadores` (`id_jogadores`),
  ADD CONSTRAINT `fk_palpites_jogos` FOREIGN KEY (`id_jogos`) REFERENCES `jogos_da_rodada` (`id_jogo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
