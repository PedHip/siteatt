-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 12-Nov-2024 às 05:37
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `fam`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `carrinho`
--

CREATE TABLE `carrinho` (
  `id` int(11) NOT NULL,
  `usuario_pedido` varchar(100) NOT NULL,
  `usuario_contato` varchar(100) NOT NULL,
  `produto` varchar(255) NOT NULL,
  `descricao` text DEFAULT NULL,
  `valor_total` decimal(10,2) NOT NULL,
  `data_criacao` timestamp NOT NULL DEFAULT current_timestamp(),
  `quantidade` int(11) NOT NULL DEFAULT 1,
  `id_prod` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `carrinho`
--

INSERT INTO `carrinho` (`id`, `usuario_pedido`, `usuario_contato`, `produto`, `descricao`, `valor_total`, `data_criacao`, `quantidade`, `id_prod`) VALUES
(113, 'pedro', 'hipolitopedro15@gmail.com 111111111111111', 'Bubble na box presentes', 'caixa de presentes média', '40.46', '2024-11-11 03:10:21', 2, 13),
(114, 'pedro', 'hipolitopedro15@gmail.com 111111111111111', 'Bubble na box aperitivos', 'Uma caixa de aperitivos pequena', '3.00', '2024-11-11 03:10:21', 3, 2883),
(115, 'pedro', 'hipolitopedro15@gmail.com 111111111111111', 'Bubble na box presentes', 'caixa de presentes média', '60.69', '2024-11-11 03:36:43', 3, 13),
(116, 'pedro', 'hipolitopedro15@gmail.com 111111111111111', 'Bubble na box aperitivos', 'Uma caixa de aperitivos pequena', '2.00', '2024-11-11 03:36:44', 2, 2883),
(117, 'pedro', 'hipolitopedro15@gmail.com 111111111111111', '12', '12bubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo um', '2.00', '2024-11-12 03:01:28', 2, 2884),
(118, 'pedro', 'hipolitopedro15@gmail.com 111111111111111', '12', '12bubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo um', '1.00', '2024-11-12 03:01:38', 1, 2884);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `id_pedido` int(11) NOT NULL,
  `usuario_pedido` varchar(255) NOT NULL,
  `usuario_contato` varchar(255) NOT NULL,
  `produtos` text NOT NULL,
  `preco_total` decimal(10,2) NOT NULL,
  `status` enum('pendente','processando','pago','produção','finalizado','cancelado','reembolsado','processando reembolso') NOT NULL DEFAULT 'pendente',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_prod` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `pedidos`
--

INSERT INTO `pedidos` (`id_pedido`, `usuario_pedido`, `usuario_contato`, `produtos`, `preco_total`, `status`, `created_at`, `updated_at`, `id_prod`) VALUES
(424, 'pedro', 'hipolitopedro15@gmail.com 111111111111111', 'Produto: Bubble na box presentes (Descrição: caixa de presentes média, Quantidade: 2) // Produto: Bubble na box aperitivos (Descrição: Uma caixa de aperitivos pequena, Quantidade: 3)', '89.92', 'processando reembolso', '2024-11-11 03:32:23', '2024-11-12 03:21:15', '13 // 2883'),
(425, 'pedro', 'hipolitopedro15@gmail.com 111111111111111', 'Produto: Bubble na box presentes (Descrição: caixa de presentes média, Quantidade: 3) // Produto: Bubble na box aperitivos (Descrição: Uma caixa de aperitivos pequena, Quantidade: 2)', '62.69', 'finalizado', '2024-11-11 03:36:41', '2024-11-12 03:05:56', '13 // 2883'),
(427, 'pedro', 'hipolitopedro15@gmail.com 111111111111111', 'Produto: Bubble na box presentes (Descrição: caixa de presentes média, Quantidade: 2) // Produto: Bubble na box aperitivos (Descrição: Uma caixa de aperitivos pequena, Quantidade: 3) // Produto: Bubble na box presentes (Descrição: caixa de presentes média, Quantidade: 3) // Produto: Bubble na box aperitivos (Descrição: Uma caixa de aperitivos pequena, Quantidade: 2) // Produto: 12 (Descrição: 12bubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo um, Quantidade: 2) // Produto: 12 (Descrição: 12bubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo um, Quantidade: 1)', '280.99', 'pendente', '2024-11-12 03:01:51', '2024-11-12 03:01:51', '13 // 2883 // 13 // 2883 // 2884 // 2884'),
(428, 'emily', 'emily@gmail.com (11)91111-1111', 'Produto: Bubble na box presentes (Descrição: caixa de presentes média, Quantidade: 2) // Produto: Bubble na box aperitivos (Descrição: Uma caixa de aperitivos pequena, Quantidade: 3) // Produto: wwqw (Descrição: 1, Quantidade: 4)', '47.46', 'pendente', '2024-11-12 03:10:58', '2024-11-12 03:10:58', '13 // 2883 // 2889'),
(429, 'emily', 'emily@gmail.com (11)91111-1111', 'Produto: Bubble na box presentes (Descrição: caixa de presentes média, Quantidade: 2) // Produto: Bubble na box aperitivos (Descrição: Uma caixa de aperitivos pequena, Quantidade: 3)', '89.92', 'pendente', '2024-11-12 03:12:28', '2024-11-12 03:12:28', '13 // 2883'),
(430, 'emily', 'emily@gmail.com (11)91111-1111', 'Produto: Bubble na box presentes (Descrição: caixa de presentes média, Quantidade: 2) // Produto: Bubble na box aperitivos (Descrição: Uma caixa de aperitivos pequena, Quantidade: 3) // Produto: wwqw (Descrição: 1, Quantidade: 4)', '105.92', 'pendente', '2024-11-12 03:12:40', '2024-11-12 03:12:40', '13 // 2883 // 2889'),
(431, 'pedro', 'hipolitopedro15@gmail.com 111111111111111', 'Produto: Bubble na box presentes (Descrição: caixa de presentes média, Quantidade: 1)', '20.23', 'pendente', '2024-11-12 03:18:30', '2024-11-12 03:18:30', '13'),
(433, 'pedro', 'hipolitopedro15@gmail.com 111111111111111', 'Produto: Bubble na box presentes (Descrição: caixa de presentes média, Quantidade: 1)', '20.23', 'pago', '2024-11-12 03:18:31', '2024-11-12 03:23:14', '13'),
(434, 'pedro', 'hipolitopedro15@gmail.com 111111111111111', 'Produto: Bubble na box presentes (Descrição: caixa de presentes média, Quantidade: 1)', '20.23', 'pendente', '2024-11-12 03:18:31', '2024-11-12 03:18:31', '13'),
(435, 'pedro', 'hipolitopedro15@gmail.com 111111111111111', 'Produto: Bubble na box presentes (Descrição: caixa de presentes média, Quantidade: 1)', '20.23', 'pendente', '2024-11-12 03:18:31', '2024-11-12 03:18:31', '13'),
(436, 'pedro', 'hipolitopedro15@gmail.com 111111111111111', 'Produto: Bubble na box presentes (Descrição: caixa de presentes média, Quantidade: 1)', '20.23', 'pendente', '2024-11-12 03:18:31', '2024-11-12 03:18:31', '13'),
(437, 'pedro', 'hipolitopedro15@gmail.com 111111111111111', 'Produto: Bubble na box presentes (Descrição: caixa de presentes média, Quantidade: 1)', '20.23', 'pendente', '2024-11-12 03:18:31', '2024-11-12 03:18:31', '13'),
(438, 'pedro', 'hipolitopedro15@gmail.com 111111111111111', 'Produto: Bubble na box presentes (Descrição: caixa de presentes média, Quantidade: 1)', '20.23', 'pendente', '2024-11-12 03:18:31', '2024-11-12 03:18:31', '13'),
(439, 'pedro', 'hipolitopedro15@gmail.com 111111111111111', 'Produto: Bubble na box presentes (Descrição: caixa de presentes média, Quantidade: 1)', '20.23', 'pendente', '2024-11-12 03:18:32', '2024-11-12 03:18:32', '13'),
(440, 'pedro', 'hipolitopedro15@gmail.com 111111111111111', 'Produto: Bubble na box presentes (Descrição: caixa de presentes média, Quantidade: 1)', '20.23', 'pendente', '2024-11-12 03:18:32', '2024-11-12 03:18:32', '13'),
(441, 'pedro', 'hipolitopedro15@gmail.com 111111111111111', 'Produto: Bubble na box presentes (Descrição: caixa de presentes média, Quantidade: 1)', '20.23', 'pendente', '2024-11-12 03:18:32', '2024-11-12 03:18:32', '13'),
(442, 'pedro', 'hipolitopedro15@gmail.com 111111111111111', 'Produto: Bubble na box presentes (Descrição: caixa de presentes média, Quantidade: 1)', '20.23', 'pendente', '2024-11-12 03:18:32', '2024-11-12 03:18:32', '13'),
(443, 'pedro', 'hipolitopedro15@gmail.com 111111111111111', 'Produto: Bubble na box presentes (Descrição: caixa de presentes média, Quantidade: 1)', '20.23', 'pendente', '2024-11-12 03:18:32', '2024-11-12 03:18:32', '13'),
(444, 'pedro', 'hipolitopedro15@gmail.com 111111111111111', 'Produto: Bubble na box presentes (Descrição: caixa de presentes média, Quantidade: 1)', '20.23', 'pendente', '2024-11-12 03:18:32', '2024-11-12 03:18:32', '13'),
(445, 'pedro', 'hipolitopedro15@gmail.com 111111111111111', 'Produto: Bubble na box presentes (Descrição: caixa de presentes média, Quantidade: 1)', '20.23', 'pendente', '2024-11-12 03:18:32', '2024-11-12 03:18:32', '13'),
(446, 'pedro', 'hipolitopedro15@gmail.com 111111111111111', 'Produto: Bubble na box presentes (Descrição: caixa de presentes média, Quantidade: 1)', '20.23', 'pendente', '2024-11-12 03:18:33', '2024-11-12 03:18:33', '13'),
(447, 'pedro', 'hipolitopedro15@gmail.com 111111111111111', 'Produto: Bubble na box presentes (Descrição: caixa de presentes média, Quantidade: 1)', '20.23', 'pendente', '2024-11-12 03:18:33', '2024-11-12 03:18:33', '13'),
(448, 'pedro', 'hipolitopedro15@gmail.com 111111111111111', 'Produto: Bubble na box presentes (Descrição: caixa de presentes média, Quantidade: 1)', '20.23', 'pendente', '2024-11-12 03:18:33', '2024-11-12 03:18:33', '13'),
(449, 'pedro', 'hipolitopedro15@gmail.com 111111111111111', 'Produto: Bubble na box presentes (Descrição: caixa de presentes média, Quantidade: 1)', '20.23', 'pendente', '2024-11-12 03:18:33', '2024-11-12 03:18:33', '13'),
(450, 'pedro', 'hipolitopedro15@gmail.com 111111111111111', 'Produto: Bubble na box presentes (Descrição: caixa de presentes média, Quantidade: 1)', '20.23', 'pendente', '2024-11-12 03:18:33', '2024-11-12 03:18:33', '13'),
(451, 'pedro', 'hipolitopedro15@gmail.com 111111111111111', 'Produto: Bubble na box presentes (Descrição: caixa de presentes média, Quantidade: 1)', '20.23', 'pendente', '2024-11-12 03:18:34', '2024-11-12 03:18:34', '13'),
(452, 'pedro', 'hipolitopedro15@gmail.com 111111111111111', 'Produto: Bubble na box presentes (Descrição: caixa de presentes média, Quantidade: 1)', '20.23', 'pendente', '2024-11-12 03:18:34', '2024-11-12 03:18:34', '13');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `id_prod` int(11) NOT NULL,
  `nome_prod` varchar(100) NOT NULL,
  `desc_prod` text DEFAULT NULL,
  `img_prod` varchar(255) DEFAULT NULL,
  `tipo_prod` varchar(50) DEFAULT NULL,
  `preco_prod` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id_prod`, `nome_prod`, `desc_prod`, `img_prod`, `tipo_prod`, `preco_prod`) VALUES
(13, 'Bubble na box presentes', 'caixa de presentes médiasdaaasdsddsdasda', 'uploads/a gent.png', 'indisponivel', '20.90'),
(2872, '', NULL, 'uploads/1tm86vndle46a1.jpg', NULL, '0.00'),
(2883, 'Bubble na box aperitivos', 'Uma caixa de aperitivos pequena', 'uploads/ab6761610000e5ebf7b952107c126c561c52171e.jpg', 'bubble_bubble', '1.00'),
(2884, '12', '12bubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo umbubble tipo um', 'uploads/1k5z7bfk306a1.jpg', 'natal', '1.00'),
(2885, 'pedro', 'pedro', 'uploads/161jh4vip46a1.jpg', 'dia_das_maes', '1.00'),
(2886, 'wws', 'wssw', 'uploads/1k5z7bfk306a1.jpg', 'caneca', '1.00'),
(2887, 'wwqw', '1', 'uploads/1tm86vndle46a1.jpg', 'bubble_box', '1.00'),
(2888, 'wwqw1', '1', 'uploads/1y2kowwfxl46a1.jpg', 'bubble_acrilico', '1.00'),
(2889, 'wwqw', '1', 'uploads/17so2abt67u0a1.jpg', 'bubble_bubble', '1.00'),
(2890, '111', '11', 'uploads/4lecpafsp46a1.jpg', 'bubble_box', '1.00'),
(2892, 'wwqw', '122', 'uploads/CaixaCartão.jpg', 'bubble_box', '12.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `tipo_usuario` enum('comum','administrador') DEFAULT 'comum',
  `nome` varchar(100) NOT NULL,
  `telefone` varchar(15) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `tipo_usuario`, `nome`, `telefone`, `email`, `senha`, `token`) VALUES
(1, 'administrador', 'pedro', '111111111111111', 'hipolitopedro15@gmail.com', '$2y$10$8QeoxIyFE2LdRnbciKPK0evW2o6vuPtVYxA8nUYpYdW9SunbgHPZy', NULL),
(85, 'comum', '1', '1', '1!@12', '$2y$10$HCDA6Ee3spdl3QVykjZO7uqoIgMqBxbgQODTIEjGI6Api8/GzKCLG', NULL),
(86, 'comum', '12', '1', '1@111111', '$2y$10$PpA7lFtDiSwiVOmlpAq6feXa.G7UDz1/WZYWNeHgMOuqJkLW0PRAu', NULL),
(87, 'comum', '12', '1', '!!12@12', '$2y$10$zAeoLrzleEJNYjwbhyU19uXiig4zBuftqyRh1VNeT6T8HNGreDi2G', NULL),
(88, 'comum', 'qw', '1', 'qw@112', '$2y$10$6Qk9ye.X8W8dY96kVaNhN.GVsePjmYboSjh5OZzfwBiXxbkzXzuHC', NULL),
(89, 'comum', '12', '12', '12@1222', '$2y$10$Xw1XQwiLLqLSXoFQPmEl4.wouxGj.bIxPaqDb8b6k/m/x7wGY9HNW', NULL),
(90, 'comum', '12', '12', '12@122122', '$2y$10$XJd.eavJWMSHWA5xsBpWrO8FlbHa/gKZ/BxrHQZDQFyQNhV/f5wDm', NULL),
(789, 'comum', '1', '1', 'p@p3', '$2y$10$Ocb8tqWwen9kMx.0RSBlmuWUKo1Jsp7wxhunv9VwWa58SdMTVGwcS', NULL),
(791, 'comum', 'w', '1', 'w@w', '$2y$10$xcJf9MflWf7RwlDLEE5N2u4YX/17HARV49Iado.PIDLj.M1XFvlAC', NULL),
(792, 'comum', 'q', '12', 'w@q', '$2y$10$BXamFCKQJQXAoMSpqD3FPu02V1nXefciRhyWfD0pQKjKZV/ATq8nG', NULL),
(795, 'comum', '1', '123', '1@23', '$2y$10$Pa/.WNyOHRQFQPydzMxdFOfJIRApPshvkDqa7efOltydWsz/Q1g8q', NULL),
(798, 'comum', '123', '121', '123@123', '$2y$10$g7GU4ODLQJ4EfyyndCf6ZuY/UipFeVXh57Wtp.bGLSWD3aziTW06i', NULL),
(805, 'comum', 'manu', '1', 'manu@gmail.com', '$2y$10$PPU/3L3KG.TFbhfVHeMnpeJ6QIp4ajfkc4uXJDuUfNYlMV.w4c3JG', NULL),
(809, 'comum', 'Patricia da Silva Hipólito', '1196912952', 'patriciahipolito16@gmail.com', '$2y$10$gzkyOcWVMb3MkyLMdFiwq.pe.WME4FceyukzekXORLACP49WC9qli', NULL),
(821, 'comum', '121', '1', '12@1211', '$2y$10$PmzmUWwkdtyVRn.lVMaaVOzdJN8U1omdOOHaAj3.UvFLM3WwDG7Ti', NULL),
(822, 'comum', 'emily', '(11)91111-1111', 'emily@gmail.com', '$2y$10$RWcHAlnCN//uqe8Plp5mq.VytfHhXAPK.WoEiUeO7vQg41dAPe9R6', NULL),
(2147483647, 'comum', '12', '1', '12@121', '$2y$10$GJiEXIeMKjydKGJwOsi3o.ufbh4NYutzYccBt.TnHsjCaDEbFAwhu', NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `carrinho`
--
ALTER TABLE `carrinho`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id_pedido`);

--
-- Índices para tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id_prod`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `carrinho`
--
ALTER TABLE `carrinho`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT de tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=453;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id_prod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2893;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483648;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
