-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 21-Out-2024 às 06:37
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
-- Banco de dados: `empresa`
--

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
  `status` enum('pendente','processando','pago','produção','finalizado','cancelado','reembolsado') NOT NULL DEFAULT 'pendente',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `pedidos`
--

INSERT INTO `pedidos` (`id_pedido`, `usuario_pedido`, `usuario_contato`, `produtos`, `preco_total`, `status`, `created_at`, `updated_at`) VALUES
(61, 'pedro', 'hipolitopedro15@gmail.com 1', 'pedro (Descrição: jasakjs)', '178.00', 'pendente', '2024-10-20 04:18:47', '2024-10-20 04:18:47'),
(62, 'pedro', 'hipolitopedro15@gmail.com 1', 'pedro (Descrição: edwhgggggggsdhghadgsgjas)', '20.09', 'pendente', '2024-10-20 04:43:39', '2024-10-20 04:43:39'),
(63, 'pedro', 'hipolitopedro15@gmail.com 1', 'pedro (Descrição: jasakjs)', '178.00', 'pendente', '2024-10-20 04:44:11', '2024-10-20 04:44:11'),
(64, 'pedro', 'hipolitopedro15@gmail.com 1', 'pedro (Descrição: jasakjs)', '178.00', 'pendente', '2024-10-20 04:45:11', '2024-10-20 04:45:11'),
(65, 'pedro', 'hipolitopedro15@gmail.com 1', 'pedro (Descrição: edwhgggggggsdhghadgsgjas)', '20.09', 'pendente', '2024-10-20 04:46:45', '2024-10-20 04:46:45'),
(66, 'Patricia da Silva Hipólito', 'patriciahipolito16@gmail.com 1196912952', 'pedro (Descrição: edwhgggggggsdhghadgsgjas)', '20.09', 'pendente', '2024-10-20 04:49:45', '2024-10-20 04:49:45'),
(67, 'Patricia da Silva Hipólito', 'patriciahipolito16@gmail.com 1196912952', 'wwqw (Descrição: www)', '1212.00', 'pendente', '2024-10-20 04:52:32', '2024-10-20 04:52:32'),
(68, 'pedro', 'hipolitopedro15@gmail.com 1', 'pedro (Descrição: edwhgggggggsdhghadgsgjas, Quantidade: 4)', '80.36', 'pendente', '2024-10-20 05:02:56', '2024-10-20 05:02:56'),
(69, 'pedro', 'hipolitopedro15@gmail.com 1', 'pedro (Descrição: edwhgggggggsdhghadgsgjas, Quantidade: 4), wwqw (Descrição: www, Quantidade: 4)', '4928.36', 'pendente', '2024-10-20 05:03:43', '2024-10-20 05:03:43'),
(70, 'pedro', 'hipolitopedro15@gmail.com 1', 'wwqw (Descrição: www, Quantidade: 1)', '1212.00', 'pendente', '2024-10-20 05:46:06', '2024-10-20 05:46:06'),
(71, 'pedro', 'hipolitopedro15@gmail.com 1', 'ssaasasas (Descrição: adssaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa, Quantidade: 3)', '170.43', 'pendente', '2024-10-20 05:58:59', '2024-10-20 05:58:59'),
(72, 'pedro', 'hipolitopedro15@gmail.com 1', 'wwqw (Descrição: www, Quantidade: 1)', '1212.00', 'pendente', '2024-10-20 05:59:20', '2024-10-20 05:59:20'),
(73, 'pedro', 'hipolitopedro15@gmail.com 1', 'sdfdf (Descrição: sdsads, Quantidade: 3)', '3699.00', 'pendente', '2024-10-20 06:09:19', '2024-10-20 06:09:19'),
(74, 'pedro', 'hipolitopedro15@gmail.com 1', 'pedro (Descrição: edwhgggggggsdhghadgsgjas, Quantidade: 3)', '60.27', 'pendente', '2024-10-20 06:22:18', '2024-10-20 06:22:18'),
(75, 'pedro', 'hipolitopedro15@gmail.com 1', 'wwqw (Descrição: wwww, Quantidade: 3)', '36.00', 'pendente', '2024-10-20 06:22:24', '2024-10-20 06:22:24'),
(76, 'pedro', 'hipolitopedro15@gmail.com 1', 'www (Descrição: qww, Quantidade: 4)', '4.00', 'pendente', '2024-10-20 06:22:28', '2024-10-20 06:22:28'),
(77, 'pedro', 'hipolitopedro15@gmail.com 1', 'pedro (Descrição: edwhgggggggsdhghadgsgjas, Quantidade: 3)', '60.27', 'pendente', '2024-10-20 06:22:38', '2024-10-20 06:22:38'),
(78, 'pedro', 'hipolitopedro15@gmail.com 1', 'pedro (Descrição: edwhgggggggsdhghadgsgjas, Quantidade: 1), ssaasasas (Descrição: adssaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa, Quantidade: 3)', '190.52', 'pendente', '2024-10-20 06:22:45', '2024-10-20 06:22:45'),
(79, 'pedro', 'hipolitopedro15@gmail.com 1', 'sdfdf (Descrição: sdsads, Quantidade: 3)', '3699.00', 'pendente', '2024-10-20 06:23:07', '2024-10-20 06:23:07'),
(80, 'pedro', 'hipolitopedro15@gmail.com 1', 'pedro (Descrição: edwhgggggggsdhghadgsgjas, Quantidade: 5)', '100.45', 'pendente', '2024-10-21 00:39:29', '2024-10-21 00:39:29'),
(81, 'pedro', 'hipolitopedro15@gmail.com 1', 'pedro (Descrição: edwhgggggggsdhghadgsgjas, Quantidade: 5), pedro (Descrição: jasakjs, Quantidade: 3)', '634.45', 'pendente', '2024-10-21 00:39:37', '2024-10-21 00:39:37'),
(82, 'pedro', 'hipolitopedro15@gmail.com 1', 'ssaasasas (Descrição: adssaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa, Quantidade: 1)', '56.81', 'pendente', '2024-10-21 00:40:07', '2024-10-21 00:40:07'),
(83, 'pedro', 'hipolitopedro15@gmail.com 1', 'ssaasasas (Descrição: adssaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa, Quantidade: 1)', '56.81', 'pendente', '2024-10-21 00:40:11', '2024-10-21 00:40:11'),
(84, 'pedro', 'hipolitopedro15@gmail.com 1', 'pedro (Descrição: edwhgggggggsdhghadgsgjas, Quantidade: 3), q (Descrição: q, Quantidade: 3)', '63.27', 'pendente', '2024-10-21 00:48:59', '2024-10-21 00:48:59'),
(85, 'pedro', 'hipolitopedro15@gmail.com 1', 'pedro (Descrição: edwhgggggggsdhghadgsgjas, Quantidade: 3), ssaasasas (Descrição: adssaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa, Quantidade: 3), wwqw (Descrição: www, Quantidade: 3)', '3866.70', 'pendente', '2024-10-21 00:52:51', '2024-10-21 00:52:51'),
(86, 'pedro', 'hipolitopedro15@gmail.com 1', 'pedro (Descrição: edwhgggggggsdhghadgsgjas, Quantidade: 3), pedro (Descrição: jasakjs, Quantidade: 1)', '238.27', 'pendente', '2024-10-21 01:04:06', '2024-10-21 01:04:06'),
(87, 'pedro', 'hipolitopedro15@gmail.com 1', 'pedro (Descrição: edwhgggggggsdhghadgsgjas, Quantidade: 2), pedro (Descrição: jasakjs, Quantidade: 3), 1 (Descrição: 1, Quantidade: 1)', '575.18', 'pendente', '2024-10-21 01:10:18', '2024-10-21 01:10:18'),
(88, 'pedro', 'hipolitopedro15@gmail.com 1', 'sdfdf (Descrição: sdsads, Quantidade: 4)', '4932.00', 'pendente', '2024-10-21 01:11:02', '2024-10-21 01:11:02'),
(89, 'pedro', 'hipolitopedro15@gmail.com 1', 'www (Descrição: qww, Quantidade: 4)', '4.00', 'pendente', '2024-10-21 01:11:11', '2024-10-21 01:11:11'),
(90, 'pedro', 'hipolitopedro15@gmail.com 1', 'pedro (Descrição: edwhgggggggsdhghadgsgjas, Quantidade: 4)', '80.36', 'pendente', '2024-10-21 01:11:18', '2024-10-21 01:11:18'),
(91, 'pedro', 'hipolitopedro15@gmail.com 1', 'pedro2 (Descrição: jshjkasj2, Quantidade: 5)', '5.00', 'pendente', '2024-10-21 01:11:27', '2024-10-21 01:11:27'),
(92, 'pedro', 'hipolitopedro15@gmail.com 1', 'pedro2 (Descrição: jshjkasj2, Quantidade: 3)', '3.00', 'pendente', '2024-10-21 01:12:08', '2024-10-21 01:12:08'),
(93, 'pedro', 'hipolitopedro15@gmail.com 1', 'pedro (Descrição: edwhgggggggsdhghadgsgjas, Quantidade: 3)', '60.27', 'pendente', '2024-10-21 01:12:15', '2024-10-21 01:12:15'),
(94, 'pedro', 'hipolitopedro15@gmail.com 1', 's (Descrição: s, Quantidade: 3), wwqw (Descrição: wwww, Quantidade: 1)', '15.00', 'pendente', '2024-10-21 01:12:23', '2024-10-21 01:12:23'),
(95, 'pedro', 'hipolitopedro15@gmail.com 1', 'wwqw (Descrição: wwww, Quantidade: 1)', '12.00', 'pendente', '2024-10-21 01:12:25', '2024-10-21 01:12:25'),
(96, 'pedro', 'hipolitopedro15@gmail.com 1', 'pedro (Descrição: jasakjs, Quantidade: 3)', '534.00', 'pendente', '2024-10-21 01:29:29', '2024-10-21 01:29:29'),
(97, 'pedro', 'hipolitopedro15@gmail.com 1', 'pedro (Descrição: jasakjs, Quantidade: 1)', '178.00', 'pendente', '2024-10-21 02:14:02', '2024-10-21 02:14:02'),
(98, 'pedro', 'hipolitopedro15@gmail.com 1', 'pedro (Descrição: jasakjs, Quantidade: 1)', '178.00', 'pendente', '2024-10-21 02:17:34', '2024-10-21 02:17:34'),
(99, 'pedro', 'hipolitopedro15@gmail.com 1', 'ssaasasas (Descrição: s, Quantidade: 1)', '1.00', 'pendente', '2024-10-21 02:18:19', '2024-10-21 02:18:19'),
(100, 'pedro', 'hipolitopedro15@gmail.com 1', 's (Descrição: s, Quantidade: 1)', '1.00', 'pendente', '2024-10-21 02:22:33', '2024-10-21 02:22:33'),
(101, 'pedro', 'hipolitopedro15@gmail.com 1', 's (Descrição: s, Quantidade: 3), wwqw (Descrição: wwww, Quantidade: 1)', '15.00', 'pendente', '2024-10-21 02:22:38', '2024-10-21 02:22:38'),
(102, 'pedro', 'hipolitopedro15@gmail.com 1', 'pedrow (Descrição: edwhgggggggsdhwghadgsgjas, Quantidade: 1)', '20.09', 'pendente', '2024-10-21 03:01:07', '2024-10-21 03:01:07'),
(103, 'pedro', 'hipolitopedro15@gmail.com 1', 'pedrow (Descrição: edwhgggggggsdhwghadgsgjas, Quantidade: 1)', '20.09', 'pendente', '2024-10-21 03:08:47', '2024-10-21 03:08:47'),
(104, 'pedro', 'hipolitopedro15@gmail.com 1', 'q (Descrição: q, Quantidade: 1)', '1.00', 'pendente', '2024-10-21 03:19:58', '2024-10-21 03:19:58'),
(105, 'pedro', 'hipolitopedro15@gmail.com 1', 'pedrow (Descrição: edwhgggggggsdhwghadgsgjas, Quantidade: 1)', '20.09', 'pendente', '2024-10-21 03:37:17', '2024-10-21 03:37:17'),
(106, 'pedro', 'hipolitopedro15@gmail.com 1', 'pedrow (Descrição: edwhgggggggsdhwghadgsgjas, Quantidade: 1)', '20.09', 'pendente', '2024-10-21 03:50:43', '2024-10-21 03:50:43'),
(107, 'pedro', 'hipolitopedro15@gmail.com 1', 'pedrow (Descrição: edwhgggggggsdhwghadgsgjas, Quantidade: 1)', '20.09', 'pendente', '2024-10-21 04:16:39', '2024-10-21 04:16:39'),
(108, 'pedro', 'hipolitopedro15@gmail.com 1', 'q (Descrição: q, Quantidade: 1)', '1.00', 'pendente', '2024-10-21 04:17:27', '2024-10-21 04:17:27'),
(109, 'pedro', 'hipolitopedro15@gmail.com 1', 'q (Descrição: q, Quantidade: 1)', '1.00', 'pendente', '2024-10-21 04:19:13', '2024-10-21 04:19:13'),
(110, 'pedro', 'hipolitopedro15@gmail.com 1', 'q (Descrição: q, Quantidade: 1)', '1.00', 'pendente', '2024-10-21 04:19:20', '2024-10-21 04:19:20'),
(111, 'pedro', 'hipolitopedro15@gmail.com 1', 's (Descrição: s, Quantidade: 1), wwqw (Descrição: wwww, Quantidade: 1)', '13.00', 'pendente', '2024-10-21 04:34:44', '2024-10-21 04:34:44');

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
(13, 'pedrow', 'edwhgggggggsdhwghadgsgjas', 'uploads/ahhah.JPG', 'bubble_acrilico', '20.09'),
(14, 's', 's', 'uploads/tortuga.jpg', 'caneca', '1.00'),
(15, 'pedro', 'jasakjs', 'uploads/childe.png', 'bubble', '178.00'),
(17, 'q', 'q', 'uploads/1y2kowwfxl46a1.jpg', 'box_luxo', '1.00'),
(18, '1', '1', 'uploads/1aelhtg46i46a1.jpg', 'bubble', '1.00'),
(202, 'pedro2', 'jshjkasj2', 'uploads/Conservante-Alimentar.jpg', 'natal', '1.00'),
(203, 'www', 'qww', 'uploads/1y2kowwfxl46a1.jpg', 'bubble_box', '1.00'),
(2872, '', NULL, 'uploads/1tm86vndle46a1.jpg', NULL, '0.00'),
(2873, 'wwqw', 'www', 'uploads/2024-01-17_06-00-32.png', 'bubble', '1212.00'),
(2875, 'wwqw', 'wwww', 'uploads/ab6761610000e5ebf7b952107c126c561c52171e.jpg', 'caneca', '12.00'),
(2876, 'wwqw', 'wqdwdw', 'uploads/185utto9yoz91.jpg', 'caneca', '122.00'),
(2878, 'ww', '2www', 'uploads/English.png', 'natal', '12.00');

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
(71, 'administrador', 'pedro', '1', 'hipolitopedro15@gmail.com', '$2y$10$RL/WK/y5aHKvxIIHAPh9ZOTS3817PhyIIuprKnpYLNM8k94VFkdv.', NULL),
(77, 'comum', '1', '1', '1@11', '$2y$10$wLRr/xBc/dnD/Mg2nrZbHe/N67wAp3a0iIo/0HWMFBpRhc5MLzzbm', NULL),
(78, 'comum', '1', '1', '1@111', '$2y$10$NiqSb8IQ4wXGQy2Ce5mp/efQqr5BuDfLuQFTcM/g5AEnBUqEcQDme', NULL),
(79, 'comum', '1@', '1', '1@1111', '$2y$10$AdGn7dFyokJ938NITPn7a.OpJrC2vCIn8iJ6op.QN0gLgf3/xFADO', NULL),
(80, 'comum', '1', '1', '23@2', '$2y$10$hg/PCm5Xh4hb/x2BwujQUudszNEea1uTfpcLHC3RrkNyIUYrMVnQu', NULL),
(81, 'comum', '12', '1', '1@32', '$2y$10$xs/lmr9t3ktjy1IxOzdgi.F1E7ZQPq65i/aZb7jshJz5B4ju.rIby', NULL),
(82, 'comum', '12', '1', '12@121', '$2y$10$XhdkYx5u8mZz6w7yf.pPgOdRWLvpf86g.xs.0.cGOVRNyVB4/Y6RC', NULL),
(83, 'comum', '121', '1', '12@111', '$2y$10$PmzmUWwkdtyVRn.lVMaaVOzdJN8U1omdOOHaAj3.UvFLM3WwDG7Ti', NULL),
(84, 'comum', 'qq', '12', 'qq@12', '$2y$10$GvuCwx4ReI6w0/lcYiOHwulNqmdjNDI9tFi3Sl7KWtrq1LEqRRKIS', NULL),
(85, 'comum', '1', '1', '1!@12', '$2y$10$HCDA6Ee3spdl3QVykjZO7uqoIgMqBxbgQODTIEjGI6Api8/GzKCLG', NULL),
(86, 'comum', '12', '1', '1@111111', '$2y$10$PpA7lFtDiSwiVOmlpAq6feXa.G7UDz1/WZYWNeHgMOuqJkLW0PRAu', NULL),
(87, 'comum', '12', '1', '!!12@12', '$2y$10$zAeoLrzleEJNYjwbhyU19uXiig4zBuftqyRh1VNeT6T8HNGreDi2G', NULL),
(88, 'comum', 'qw', '1', 'qw@112', '$2y$10$6Qk9ye.X8W8dY96kVaNhN.GVsePjmYboSjh5OZzfwBiXxbkzXzuHC', NULL),
(89, 'comum', '12', '12', '12@1222', '$2y$10$Xw1XQwiLLqLSXoFQPmEl4.wouxGj.bIxPaqDb8b6k/m/x7wGY9HNW', NULL),
(90, 'comum', '12', '12', '12@122122', '$2y$10$XJd.eavJWMSHWA5xsBpWrO8FlbHa/gKZ/BxrHQZDQFyQNhV/f5wDm', NULL),
(789, 'comum', '1', '1', 'p@p3', '$2y$10$Ocb8tqWwen9kMx.0RSBlmuWUKo1Jsp7wxhunv9VwWa58SdMTVGwcS', NULL);

--
-- Índices para tabelas despejadas
--

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
-- AUTO_INCREMENT de tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id_prod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2879;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=790;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
