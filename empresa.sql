-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 20-Out-2024 às 08:36
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
(79, 'pedro', 'hipolitopedro15@gmail.com 1', 'sdfdf (Descrição: sdsads, Quantidade: 3)', '3699.00', 'pendente', '2024-10-20 06:23:07', '2024-10-20 06:23:07');

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
(13, 'pedro', 'edwhgggggggsdhghadgsgjas', 'uploads/karalho.jpg', 'bubble_acrilico', '20.09'),
(14, 's', 's', 'uploads/tortuga.jpg', 'eletronico', '1.00'),
(15, 'pedro', 'jasakjs', 'uploads/childe.png', 'bubble', '178.00'),
(16, 'ssaasasas', 's', 'uploads/1y2kowwfxl46a1.jpg', 'bubble', '1.00'),
(17, 'q', 'q', 'uploads/1y2kowwfxl46a1.jpg', 'bubble', '1.00'),
(18, '1', '1', 'uploads/1aelhtg46i46a1.jpg', 'bubble', '1.00'),
(202, 'pedro2', 'jshjkasj2', 'uploads/Conservante-Alimentar.jpg', 'natal', '1.00'),
(203, 'www', 'qww', 'uploads/1y2kowwfxl46a1.jpg', 'bubble_box', '1.00'),
(1232, 'ssaasasas', 'adssaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 'uploads/download20220702002312.png', 'bubble', '56.81'),
(2872, '', NULL, 'uploads/1tm86vndle46a1.jpg', NULL, '0.00'),
(2873, 'wwqw', 'www', 'uploads/2024-01-17_06-00-32.png', 'bubble', '1212.00'),
(2874, 'sdfdf', 'sdsads', 'uploads/Artes-para-noticias-48.jpg', 'box_luxo', '1233.00'),
(2875, 'wwqw', 'wwww', 'uploads/ab6761610000e5ebf7b952107c126c561c52171e.jpg', 'caneca', '12.00');

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
(72, 'comum', 'Patricia s Hipolito', '1', 'hipolitopero15@gmail.com', '$2y$10$rxtNS.Lt5Hq6NeP9mnQUi.SISoXGD5tGE36oI/CJsL01mn5IfNEyC', NULL),
(73, 'comum', 'Patricia da Silva Hipólito', '1196912952', 'patriciahipolito16@gmail.com', '$2y$10$9DNzuhfM.Fod2a1sbmyx/OswSc1ZrSDBRx.jJUwy6dhNbQra.5jP6', NULL);

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
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id_prod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2876;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
