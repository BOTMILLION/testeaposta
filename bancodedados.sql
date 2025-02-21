-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 29/10/2024 às 18:13
-- Versão do servidor: 10.11.9-MariaDB
-- Versão do PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `u458121660_flixvss`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `cliente_perfil`
--

CREATE TABLE `cliente_perfil` (
  `cliente_perfil_id` int(11) NOT NULL,
  `cliente_perfil_apelido` varchar(255) NOT NULL,
  `cliente_perfil_hash` varchar(32) DEFAULT NULL,
  `cliente_perfil_avatar` varchar(36) NOT NULL,
  `cliente_perfil_online` datetime DEFAULT NULL,
  `cliente_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `cliente_premium`
--

CREATE TABLE `cliente_premium` (
  `cliente_premium_id` int(11) NOT NULL,
  `cliente_premium_data` datetime NOT NULL,
  `cliente_premium_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `premium`
--

CREATE TABLE `premium` (
  `premium_id` int(11) NOT NULL,
  `premium_telas` int(11) NOT NULL,
  `premium_dias` int(11) NOT NULL,
  `premium_preco` varchar(255) NOT NULL,
  `premium_revendedor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `servidor_iptv`
--

CREATE TABLE `servidor_iptv` (
  `servidor_iptv_id` int(11) NOT NULL,
  `servidor_iptv_host` text NOT NULL,
  `servidor_iptv_usuario` varchar(255) NOT NULL,
  `servidor_iptv_senha` varchar(255) NOT NULL,
  `servidor_iptv_atualizacao` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `site_perfil`
--

CREATE TABLE `site_perfil` (
  `site_perfil_id` int(11) NOT NULL,
  `site_nome` varchar(255) DEFAULT NULL,
  `site_descricao` text DEFAULT NULL,
  `site_keywords` text DEFAULT NULL,
  `site_logo` varchar(36) DEFAULT NULL,
  `site_favicon` varchar(36) DEFAULT NULL,
  `site_avatar` varchar(36) DEFAULT NULL,
  `site_background_user` varchar(36) DEFAULT NULL,
  `site_background_public` varchar(36) DEFAULT NULL,
  `site_token_mp` varchar(255) DEFAULT NULL,
  `site_whatsapp` varchar(18) DEFAULT NULL,
  `site_telegram` varchar(18) DEFAULT NULL,
  `site_cache` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Despejando dados para a tabela `site_perfil`
--

INSERT INTO `site_perfil` (`site_perfil_id`, `site_nome`, `site_descricao`, `site_keywords`, `site_logo`, `site_favicon`, `site_avatar`, `site_background_user`, `site_background_public`, `site_token_mp`, `site_whatsapp`, `site_telegram`, `site_cache`) VALUES
(1, 'StreamFlix', 'StreamFlix', 'StreamFlix', '35b6ad923578a90b80eb6b460c9592dd.png', 'df7aea0d31e8dea57f38655025221064.png', '791f2f8f961f4d0763d15f1d55070c32.png', '41a58c26f8354040dbc28d41cdad2d8a.png', '6fa0b3bf49f65a72d22e10cbb33ddfa1.png', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `site_smtp`
--

CREATE TABLE `site_smtp` (
  `smtp_user` varchar(255) DEFAULT NULL,
  `smtp_senha` varchar(255) DEFAULT NULL,
  `smtp_porta` varchar(255) DEFAULT NULL,
  `smtp_email` varchar(255) DEFAULT NULL,
  `smtp_host` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `stream_assistindo`
--

CREATE TABLE `stream_assistindo` (
  `stream_assistindo_id` int(11) NOT NULL,
  `stream_assistindo_stream` int(11) NOT NULL,
  `stream_assistindo_type` varchar(10) NOT NULL,
  `stream_assistindo_episodio` int(11) NOT NULL,
  `stream_assistindo_perfil` int(11) NOT NULL,
  `stream_assistindo_user` int(11) NOT NULL,
  `stream_assistindo_time` int(11) NOT NULL,
  `stream_assistindo_data` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `stream_lista`
--

CREATE TABLE `stream_lista` (
  `stream_lista_id` int(11) NOT NULL,
  `stream_lista_stream` int(11) NOT NULL,
  `stream_lista_type` varchar(10) NOT NULL,
  `stream_lista_perfil` int(11) NOT NULL,
  `stream_lista_user` int(11) NOT NULL,
  `stream_lista_data` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_senha` varchar(32) NOT NULL,
  `user_nome` varchar(255) NOT NULL,
  `user_whatsapp` varchar(19) DEFAULT NULL,
  `user_telegram` varchar(19) DEFAULT NULL,
  `user_revendedor` int(11) NOT NULL DEFAULT 0,
  `user_tipo` varchar(255) NOT NULL,
  `user_online` datetime NOT NULL DEFAULT current_timestamp(),
  `user_data` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Despejando dados para a tabela `user`
--

INSERT INTO `user` (`user_id`, `user_email`, `user_senha`, `user_nome`, `user_whatsapp`, `user_telegram`, `user_revendedor`, `user_tipo`, `user_online`, `user_data`) VALUES
(73, 'agencia@midiadigitalvs.com.br', 'db77ed7d0ebcf7b8e5ba5a334891d49d', 'MIDIA DIGITALVS', '+55 (92)99397-0584', NULL, 0, 'admin', '2024-10-29 18:12:03', '2024-10-29 18:12:03');

-- --------------------------------------------------------

--
-- Estrutura para tabela `user_recuperar_senha`
--

CREATE TABLE `user_recuperar_senha` (
  `recuperar_id` int(11) NOT NULL,
  `recuperar_user_id` int(11) NOT NULL,
  `recuperar_email` varchar(255) NOT NULL,
  `recuperar_hash` varchar(32) NOT NULL,
  `recuperar_data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `user_sessao`
--

CREATE TABLE `user_sessao` (
  `sessao_id` int(11) NOT NULL,
  `sessao_hash` varchar(32) NOT NULL,
  `sessao_user_id` int(11) NOT NULL,
  `sessao_user_email` varchar(255) NOT NULL,
  `sessao_tipo` varchar(50) NOT NULL,
  `sessao_data` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Despejando dados para a tabela `user_sessao`
--

INSERT INTO `user_sessao` (`sessao_id`, `sessao_hash`, `sessao_user_id`, `sessao_user_email`, `sessao_tipo`, `sessao_data`) VALUES
(1, 'd916c7304537a5e5ce0074fb8ff8dee2', 18, 'agencia@midiadigitalvs.com.br', 'admin', '2024-10-29 13:16:34'),
(2, '5f3a8e3d167d8c92bfbb06a3c4f51728', 18, 'agencia@midiadigitalvs.com.br', 'admin', '2024-10-29 17:57:48'),
(4, 'a35334519a3fca641553748bb2da5cd2', 72, 'agencia@midiadigitalvss.com.br', 'admin', '2024-10-29 18:10:06'),
(5, '05a28b5901e61ae58367134caf4d07b8', 73, 'agencia@midiadigitalvs.com.br', 'admin', '2024-10-29 18:13:05');

-- --------------------------------------------------------

--
-- Estrutura para tabela `venda`
--

CREATE TABLE `venda` (
  `venda_id` int(11) NOT NULL,
  `venda_item_tipo` varchar(255) NOT NULL,
  `venda_item_titulo` varchar(255) NOT NULL,
  `venda_item_id` int(11) NOT NULL,
  `venda_item_preco` varchar(255) NOT NULL,
  `venda_item_quantidade` int(11) NOT NULL,
  `venda_total` varchar(255) NOT NULL,
  `venda_user_id` int(11) NOT NULL,
  `venda_user_email` varchar(255) NOT NULL,
  `venda_vendedor` int(11) NOT NULL DEFAULT 0,
  `venda_status` varchar(255) NOT NULL,
  `venda_concluida` int(11) DEFAULT 0,
  `venda_numero_transacao` varchar(255) NOT NULL DEFAULT '0',
  `venda_data_criacao` datetime NOT NULL,
  `venda_data_atualizacao` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `cliente_perfil`
--
ALTER TABLE `cliente_perfil`
  ADD PRIMARY KEY (`cliente_perfil_id`);

--
-- Índices de tabela `cliente_premium`
--
ALTER TABLE `cliente_premium`
  ADD PRIMARY KEY (`cliente_premium_id`);

--
-- Índices de tabela `premium`
--
ALTER TABLE `premium`
  ADD PRIMARY KEY (`premium_id`);

--
-- Índices de tabela `servidor_iptv`
--
ALTER TABLE `servidor_iptv`
  ADD PRIMARY KEY (`servidor_iptv_id`);

--
-- Índices de tabela `site_perfil`
--
ALTER TABLE `site_perfil`
  ADD PRIMARY KEY (`site_perfil_id`);

--
-- Índices de tabela `stream_assistindo`
--
ALTER TABLE `stream_assistindo`
  ADD PRIMARY KEY (`stream_assistindo_id`);

--
-- Índices de tabela `stream_lista`
--
ALTER TABLE `stream_lista`
  ADD PRIMARY KEY (`stream_lista_id`);

--
-- Índices de tabela `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Índices de tabela `user_recuperar_senha`
--
ALTER TABLE `user_recuperar_senha`
  ADD PRIMARY KEY (`recuperar_id`);

--
-- Índices de tabela `user_sessao`
--
ALTER TABLE `user_sessao`
  ADD PRIMARY KEY (`sessao_id`);

--
-- Índices de tabela `venda`
--
ALTER TABLE `venda`
  ADD PRIMARY KEY (`venda_id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cliente_perfil`
--
ALTER TABLE `cliente_perfil`
  MODIFY `cliente_perfil_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `cliente_premium`
--
ALTER TABLE `cliente_premium`
  MODIFY `cliente_premium_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `premium`
--
ALTER TABLE `premium`
  MODIFY `premium_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `servidor_iptv`
--
ALTER TABLE `servidor_iptv`
  MODIFY `servidor_iptv_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `site_perfil`
--
ALTER TABLE `site_perfil`
  MODIFY `site_perfil_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `stream_assistindo`
--
ALTER TABLE `stream_assistindo`
  MODIFY `stream_assistindo_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `stream_lista`
--
ALTER TABLE `stream_lista`
  MODIFY `stream_lista_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT de tabela `user_recuperar_senha`
--
ALTER TABLE `user_recuperar_senha`
  MODIFY `recuperar_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `user_sessao`
--
ALTER TABLE `user_sessao`
  MODIFY `sessao_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `venda`
--
ALTER TABLE `venda`
  MODIFY `venda_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
