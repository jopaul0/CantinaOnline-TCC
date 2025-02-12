-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 10/02/2025 às 21:46
-- Versão do servidor: 10.4.32-MariaDB-log
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `cantinaonline`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `cards`
--

CREATE TABLE `cards` (
  `id` int(11) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `texto` varchar(200) NOT NULL,
  `ancora` varchar(100) NOT NULL,
  `imagem` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cards`
--

INSERT INTO `cards` (`id`, `titulo`, `texto`, `ancora`, `imagem`) VALUES
(1, 'Com cremosidade e elegância!', 'Nova sobremesa de gelatina cremosa adicionada no cardápio!', '/Produtos/exibir/41', '67a5208ca2186.jpg'),
(2, 'Mais que um  simples salgado!', 'Direto da França que te surpreende com um toque brasileiro, conheça o Croissant de Chocolate!', '/Produtos/exibir/5', '67a520c874ae9.jpeg'),
(3, 'O sucesso do verão vem aí!', 'Se refresque com a gente e com o nosso potão de Açaí!', '/Produtos/exibir/13', '67a5209d9157f.jpeg');

-- --------------------------------------------------------

--
-- Estrutura para tabela `carrinho`
--

CREATE TABLE `carrinho` (
  `id_usuario` int(11) NOT NULL,
  `data_criacao` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `carrinho`
--

INSERT INTO `carrinho` (`id_usuario`, `data_criacao`) VALUES
(1, '2024-11-25 14:23:44'),
(2, '2024-11-25 11:53:40'),
(3, '2024-11-25 07:22:13'),
(4, '2024-11-25 14:20:25'),
(5, '2024-11-25 07:45:13'),
(6, '2024-11-25 07:49:21'),
(7, '2024-11-25 07:52:41'),
(8, '2024-11-25 15:18:37'),
(9, '2024-11-25 16:58:20'),
(10, '2024-11-25 18:02:34'),
(11, '2024-11-25 19:50:01'),
(12, '2025-01-16 19:21:47');

-- --------------------------------------------------------

--
-- Estrutura para tabela `carrossel`
--

CREATE TABLE `carrossel` (
  `id` int(11) NOT NULL,
  `imagem` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `carrossel`
--

INSERT INTO `carrossel` (`id`, `imagem`) VALUES
(1, '67a50198b9af9.png'),
(2, '67a5019f24e97.png'),
(3, '67a501bab7470.png');

-- --------------------------------------------------------

--
-- Estrutura para tabela `categorias_produtos`
--

CREATE TABLE `categorias_produtos` (
  `id` int(11) NOT NULL,
  `nome` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `categorias_produtos`
--

INSERT INTO `categorias_produtos` (`id`, `nome`) VALUES
(1, 'Salgados'),
(2, 'Sorvetes'),
(3, 'Bebidas'),
(4, 'Guloseimas'),
(5, 'Sobremesas');

-- --------------------------------------------------------

--
-- Estrutura para tabela `detalhes_pedidos`
--

CREATE TABLE `detalhes_pedidos` (
  `id` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `id_preco` int(11) NOT NULL,
  `quantidade` int(2) NOT NULL,
  `preco_unitario` decimal(5,2) NOT NULL,
  `subtotal` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `detalhes_pedidos`
--

INSERT INTO `detalhes_pedidos` (`id`, `id_pedido`, `id_preco`, `quantidade`, `preco_unitario`, `subtotal`) VALUES
(1, 1, 14, 3, 8.00, 24.00),
(2, 1, 15, 1, 6.00, 6.00),
(4, 2, 53, 1, 10.00, 10.00),
(5, 3, 1, 1, 10.00, 10.00),
(6, 3, 3, 1, 10.00, 10.00),
(7, 3, 7, 1, 10.00, 10.00),
(8, 3, 15, 1, 6.00, 6.00),
(9, 3, 20, 1, 0.20, 0.20),
(10, 3, 26, 1, 1.50, 1.50),
(11, 3, 35, 1, 7.00, 7.00),
(12, 4, 5, 1, 10.00, 10.00),
(13, 5, 1, 1, 10.00, 10.00),
(14, 6, 9, 3, 8.00, 24.00),
(15, 7, 1, 25, 10.00, 250.00),
(16, 8, 4, 1, 10.00, 10.00),
(17, 8, 14, 1, 8.00, 8.00),
(18, 8, 34, 1, 7.00, 7.00),
(19, 8, 44, 1, 10.00, 10.00),
(20, 8, 51, 1, 8.00, 8.00),
(21, 8, 56, 1, 11.00, 11.00),
(22, 8, 60, 1, 12.00, 12.00),
(23, 8, 67, 1, 3.50, 3.50),
(31, 9, 3, 25, 10.00, 250.00),
(32, 10, 2, 1, 10.00, 10.00),
(33, 10, 5, 1, 10.00, 10.00),
(35, 11, 15, 1, 6.00, 6.00),
(36, 11, 20, 25, 0.20, 5.00),
(37, 11, 21, 1, 3.00, 3.00),
(38, 11, 31, 1, 10.00, 10.00),
(39, 11, 32, 1, 8.00, 8.00),
(42, 12, 3, 2, 10.00, 20.00),
(43, 13, 6, 4, 10.00, 40.00),
(44, 14, 1, 1, 10.00, 10.00),
(45, 15, 3, 1, 10.00, 10.00),
(46, 15, 44, 5, 10.00, 50.00),
(48, 16, 25, 7, 2.00, 14.00);

-- --------------------------------------------------------

--
-- Estrutura para tabela `faq`
--

CREATE TABLE `faq` (
  `id` int(11) NOT NULL,
  `pergunta` varchar(100) NOT NULL,
  `resposta` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `faq`
--

INSERT INTO `faq` (`id`, `pergunta`, `resposta`) VALUES
(1, 'Como eu edito meu perfil?', 'Para editar seu perfil, você terá que clicar na sua foto de perfil. Com isso aparecerá 2 opções: Perfil e Sair. Clique em Perfil e, em seguida, clique onde deseja editar, como por exemplo seu nome.'),
(2, 'Como eu faço o cadastro?', 'Para realizar seu cadastro, você terá que clicar no ícone do perfil, que se encontra no canto superior direito de sua tela. Após este feito, você será direcionado a tela de login. Com isso, você clicará no “Faça cadastro” abaixo de sua tela e será direcionado a tela de cadastro, sendo necessário você só colocar suas informações pessoais. Entretanto, a conta só estará disponível para o uso após a validação de algum administrador.'),
(3, 'Como adicionar um produto ao carrinho?', 'Primeiramente, você procurará o produto desejado e entrará na tela dele. Ao chegar lá, haverá um botão escrito \"Adicionar ao carrinho\". Lá você escolherá o sabor e o tamanho e, ao confirmar, será redirecionado ao carrinho, onde poderá editar a quantidade do produto escolhido. O acesso ao carrinho e à tela do produto com todos os detalhes dele só estão disponíveis com o uso de uma conta.'),
(4, 'Como ativar as notificações?', 'Acesse a página do perfil e vá à aba de configurações. Lá terá uma chavezinha de ativar e desativar. Ao ficar amarela estará desativada.'),
(5, 'Como ativar o modo escuro?', 'Acesse a página do perfil e vá à aba de configurações. Lá terá uma chavezinha de ativar e desativar. Ao ficar amarela estará desativada.'),
(6, 'Existem promoções?', 'Em breve...');

-- --------------------------------------------------------

--
-- Estrutura para tabela `favoritos_usuarios`
--

CREATE TABLE `favoritos_usuarios` (
  `id_usuario` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `formas_pagamentos`
--

CREATE TABLE `formas_pagamentos` (
  `id` int(11) NOT NULL,
  `nome` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `formas_pagamentos`
--

INSERT INTO `formas_pagamentos` (`id`, `nome`) VALUES
(1, 'Dinheiro'),
(2, 'Saldo');

-- --------------------------------------------------------

--
-- Estrutura para tabela `imagens_produtos`
--

CREATE TABLE `imagens_produtos` (
  `id` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `imagem` varchar(256) NOT NULL,
  `status` enum('Principal','Secundária') NOT NULL DEFAULT 'Secundária'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `imagens_produtos`
--

INSERT INTO `imagens_produtos` (`id`, `id_produto`, `imagem`, `status`) VALUES
(1, 1, '66ccf45341a0c.jpg', 'Principal'),
(2, 1, '66ccf4fbc616f.jpg', 'Secundária'),
(3, 1, '66ccf5117169a.jpg', 'Secundária'),
(4, 2, '66ccf61992f7d.jpg', 'Principal'),
(5, 2, '66ccf6c83680a.jpg', 'Secundária'),
(6, 2, '66ccf6f3d56dc.jpg', 'Secundária'),
(7, 3, '66ccf775443f5.jpg', 'Principal'),
(8, 4, '66ccf7b60a338.jpg', 'Principal'),
(9, 4, '66ccf81478b30.jpg', 'Secundária'),
(10, 4, '66ccf83f50ced.jpg', 'Secundária'),
(11, 5, '66ccf8eca16da.jpg', 'Principal'),
(12, 6, '66ccf948f0e85.jpg', 'Principal'),
(13, 7, '66ccfb460fe5c.jpg', 'Principal'),
(14, 8, '66ccfbaf72590.jpg', 'Principal'),
(15, 9, '66ccfc228d76c.jpg', 'Principal'),
(16, 10, '66ccfce2c4852.jpg', 'Principal'),
(17, 11, '66ccfeb240462.jpg', 'Principal'),
(18, 12, '66ccff7a74ca5.jpg', 'Principal'),
(19, 13, '66cd009d2fdcf.jpg', 'Principal'),
(20, 14, '66cd00f547480.jpg', 'Principal'),
(21, 15, '66cd018d87ec1.jpg', 'Principal'),
(22, 16, '66cd01e003f4c.jpg', 'Principal'),
(23, 17, '66cd0316be1ed.jpg', 'Principal'),
(24, 18, '66cd03b428a5d.jpg', 'Principal'),
(25, 19, '66cd04e6344e6.jpg', 'Principal'),
(26, 20, '66cd05641d6bd.jpg', 'Principal'),
(27, 21, '66cd05f5a3474.jpg', 'Principal'),
(28, 22, '66cd06311be80.jpg', 'Principal'),
(29, 23, '66cd067b4f61d.jpg', 'Principal'),
(30, 24, '66cd06bd19908.jpg', 'Principal'),
(31, 25, '66cd071eab936.jpg', 'Principal'),
(32, 26, '66cd07ab18c91.jpg', 'Principal'),
(33, 27, '66cd07e7c0bdd.jpg', 'Principal'),
(34, 28, '66cd0873ccf52.jpg', 'Principal'),
(35, 29, '66cd08d893533.jpg', 'Principal'),
(36, 30, '66cd0a43130c9.jpg', 'Principal'),
(37, 31, '66cd0aae67299.jpg', 'Principal'),
(38, 32, '66cd0b1c1665f.jpg', 'Principal'),
(39, 33, '66cd0bcfc0404.jpg', 'Principal'),
(40, 34, '66cd0c43c3e47.jpg', 'Principal'),
(41, 35, '66cd0d5383476.jpg', 'Principal'),
(42, 36, '66cd0de0d2ad6.jpg', 'Principal'),
(43, 37, '66cd0f3f7dfb6.jpg', 'Principal'),
(44, 38, '66cd0fd77f078.jpg', 'Principal'),
(45, 39, '66cd104c94762.jpg', 'Principal'),
(46, 40, '66cd12cdb67a7.jpg', 'Principal'),
(47, 3, '66cd1546ac832.jpg', 'Secundária'),
(48, 3, '66cd15506e528.jpg', 'Secundária'),
(49, 5, '66cd15f666be4.jpg', 'Secundária'),
(51, 5, '66cd16410b6a4.jpg', 'Secundária'),
(52, 6, '66cd16a713a3f.png', 'Secundária'),
(53, 6, '66cd16bf44d02.jpg', 'Secundária'),
(54, 7, '66cd179b0e499.jpg', 'Secundária'),
(55, 7, '66cd17ec4b7bf.jpg', 'Secundária'),
(56, 8, '66cd18b810a0c.jpg', 'Secundária'),
(57, 8, '66cd18f1158c1.jpg', 'Secundária'),
(58, 9, '66cd1a0c22e8b.jpg', 'Secundária'),
(59, 9, '66cd1a956291a.jpg', 'Secundária'),
(60, 13, '66cd1cc8c4126.jpg', 'Secundária'),
(61, 10, '66cd27ac10a5d.jpg', 'Secundária'),
(62, 10, '66cd27c7ae55e.jpg', 'Secundária'),
(63, 13, '66cd280964fba.jpg', 'Secundária'),
(64, 14, '66cd284021879.jpg', 'Secundária'),
(65, 14, '66cd28730342b.jpg', 'Secundária'),
(66, 15, '66cd2981744d6.jpg', 'Secundária'),
(67, 15, '66cd29998ed23.jpg', 'Secundária'),
(68, 16, '66cd2a39cf042.jpg', 'Secundária'),
(69, 16, '66cd2a4969d08.jpg', 'Secundária'),
(70, 17, '66cd2cafd151b.jpg', 'Secundária'),
(71, 17, '66cd2ccc8f826.jpg', 'Secundária'),
(72, 18, '66cd2ce3b6a0d.jpg', 'Secundária'),
(73, 18, '66cd2ee339792.jpg', 'Secundária'),
(74, 19, '66cd31f19e979.jpg', 'Secundária'),
(75, 19, '66cd320262dfa.jpg', 'Secundária'),
(76, 20, '66cd32395b4b0.jpg', 'Secundária'),
(77, 20, '66cd325571f80.jpg', 'Secundária'),
(78, 21, '66cd33609684a.png', 'Secundária'),
(79, 21, '66cd3383780b0.jpg', 'Secundária'),
(80, 23, '66cd33a4c385a.jpg', 'Secundária'),
(81, 23, '66cd33bb3f66d.jpg', 'Secundária'),
(82, 24, '66cd34ca5ee7b.jpg', 'Secundária'),
(83, 24, '66cd34ece7cfc.jpg', 'Secundária'),
(84, 22, '66cd35375622b.jpg', 'Secundária'),
(85, 22, '66cd35958512a.jpg', 'Secundária'),
(86, 27, '66cd373eae061.jpg', 'Secundária'),
(87, 25, '66cd382624614.jpg', 'Secundária'),
(89, 25, '66cd390804440.jpg', 'Secundária'),
(90, 26, '66cd394694c32.jpg', 'Secundária'),
(91, 26, '66cd3981ed405.jpg', 'Secundária'),
(92, 28, '66cd39b5c554c.jpg', 'Secundária'),
(93, 28, '66cd39f4793f8.jpg', 'Secundária'),
(94, 29, '66cd3a2876a85.jpg', 'Secundária'),
(95, 29, '66cd3a6751801.jpg', 'Secundária'),
(96, 31, '66cd3ab41383c.jpg', 'Secundária'),
(97, 31, '66cd3ad161a84.jpg', 'Secundária'),
(98, 32, '66cd3afc4ee6e.jpg', 'Secundária'),
(99, 32, '66cd3b8454120.jpg', 'Secundária'),
(100, 33, '66cd3c93199f7.jpg', 'Secundária'),
(101, 34, '66cd3ebbaa927.jpg', 'Secundária'),
(102, 33, '66cd3ef62ddc2.jpg', 'Secundária'),
(103, 34, '66cd429ba024b.jpg', 'Secundária'),
(104, 35, '66cd42bccc4c3.jpg', 'Secundária'),
(105, 36, '66cd42cbdacfd.jpg', 'Secundária'),
(106, 37, '66cd42fe2df77.jpg', 'Secundária'),
(107, 37, '66cd430fbafab.jpg', 'Secundária'),
(108, 38, '66cd4330557ce.jpg', 'Secundária'),
(109, 38, '66cd43aae447e.jpg', 'Secundária'),
(111, 39, '66cd44ae72e5e.jpg', 'Secundária'),
(112, 39, '66cd44ae95197.jpg', 'Secundária'),
(113, 39, '66cd450722aff.jpg', 'Secundária'),
(114, 40, '66cd45813fd6f.jpg', 'Secundária'),
(115, 40, '66cd458b2decb.jpg', 'Secundária'),
(116, 36, '66cd46375e75e.jpg', 'Secundária'),
(117, 35, '66cd465c5457c.jpg', 'Secundária'),
(118, 41, '66ce410beb841.jpg', 'Secundária'),
(119, 41, '66ce41cc9906f.jpg', 'Secundária'),
(120, 41, '66ce41dd60c52.jpg', 'Principal');

-- --------------------------------------------------------

--
-- Estrutura para tabela `itens_carrinho`
--

CREATE TABLE `itens_carrinho` (
  `id_usuario` int(11) NOT NULL,
  `id_preco` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `parcial` decimal(5,2) NOT NULL,
  `data_adicionado` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `itens_carrinho`
--

INSERT INTO `itens_carrinho` (`id_usuario`, `id_preco`, `quantidade`, `parcial`, `data_adicionado`) VALUES
(4, 33, 1, 8.00, '2025-02-02 18:55:36'),
(12, 4, 1, 10.00, '2025-01-16 19:22:55');

-- --------------------------------------------------------

--
-- Estrutura para tabela `notificacoes`
--

CREATE TABLE `notificacoes` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `data` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `titulo` varchar(60) DEFAULT NULL,
  `texto` varchar(200) NOT NULL,
  `status` enum('Visualizada','Não Vista') NOT NULL DEFAULT 'Não Vista'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `notificacoes`
--

INSERT INTO `notificacoes` (`id`, `id_usuario`, `data`, `titulo`, `texto`, `status`) VALUES
(1, 1, '2024-11-25 15:42:16', 'oioioioiiiii', 'Te amo', 'Visualizada'),
(2, 9, '2025-01-16 19:20:27', 'Seja bem-vindo ao CantinaOnline+', 'Você realizou um cadastro na plataforma CantinaOnline+! Aproveite nossos produtos!', 'Não Vista'),
(3, 9, '2024-11-25 16:44:36', 'Seu perfil foi atualizado.', 'Alguns dados do seu perfil foram alterados. Verifique-os e caso algum equívoco fale conosco!', 'Visualizada'),
(4, 9, '2024-11-25 16:59:02', 'Seu pedido foi atualizado!', 'A situação do seu pedido foi alterado! Verifique-o na aba de pedidos!', 'Visualizada'),
(5, 9, '2024-11-25 16:59:46', 'O pagamento de seu pedido foi atualizado!', 'A situação do pagamento do seu pedido foi alterado! Verifique-o na aba de pedidos!', 'Visualizada'),
(6, 9, '2024-11-25 17:02:19', 'Seu pedido foi atualizado!', 'A situação do seu pedido foi alterado para Entregue! Verifique-o na aba de pedidos!', 'Visualizada'),
(7, 4, '2024-11-25 17:54:09', 'Seu pedido foi atualizado!', 'A situação do seu pedido foi alterado para Pronto! Verifique-o na aba de pedidos!', 'Visualizada'),
(8, 4, '2024-11-25 17:55:21', 'Seu pedido foi atualizado!', 'A situação do seu pedido foi alterado para Pendente! Verifique-o na aba de pedidos!', 'Visualizada'),
(9, 4, '2024-11-25 17:55:28', 'Seu pedido foi atualizado!', 'A situação do seu pedido foi alterado para Entregue! Verifique-o na aba de pedidos!', 'Visualizada'),
(10, 10, '2024-11-25 17:58:42', 'Seja bem-vindo ao CantinaOnline+', 'Você realizou um cadastro na plataforma CantinaOnline+! Aproveite nossos produtos!', 'Visualizada'),
(11, 10, '2024-11-25 18:06:12', 'Seu pedido foi atualizado!', 'A situação do seu pedido foi alterado para Entregue! Verifique-o na aba de pedidos!', 'Visualizada'),
(12, 10, '2024-11-25 18:06:19', 'O pagamento de seu pedido foi atualizado!', 'A situação do pagamento do seu pedido foi alterado para Pago! Verifique-o na aba de pedidos!', 'Visualizada'),
(13, 10, '2024-11-25 18:58:21', 'Seu perfil foi atualizado.', 'Alguns dados do seu perfil foram alterados. Verifique-os e caso algum equívoco fale conosco!', 'Visualizada'),
(14, 11, '2024-11-25 19:26:36', 'Seja bem-vindo ao CantinaOnline+', 'Você realizou um cadastro na plataforma CantinaOnline+! Aproveite nossos produtos!', 'Visualizada'),
(15, 11, '2024-11-25 19:26:43', 'Seu perfil foi atualizado.', 'Alguns dados do seu perfil foram alterados. Verifique-os e caso algum equívoco fale conosco!', 'Visualizada'),
(16, 11, '2024-11-25 19:28:05', 'Seu perfil foi atualizado.', 'Alguns dados do seu perfil foram alterados. Verifique-os e caso algum equívoco fale conosco!', 'Visualizada'),
(17, 11, '2024-11-25 19:33:41', 'Seu perfil foi atualizado.', 'Alguns dados do seu perfil foram alterados. Verifique-os e caso algum equívoco fale conosco!', 'Visualizada'),
(18, 1, '2024-11-25 19:35:21', 'Seu perfil foi atualizado.', 'Alguns dados do seu perfil foram alterados. Verifique-os e caso algum equívoco fale conosco!', 'Não Vista'),
(19, 1, '2024-11-25 19:36:06', 'Seu pedido foi atualizado!', 'A situação do seu pedido foi alterado para Entregue! Verifique-o na aba de pedidos!', 'Não Vista'),
(20, 11, '2024-11-25 19:43:54', 'Seu perfil foi atualizado.', 'Alguns dados do seu perfil foram alterados. Verifique-os e caso algum equívoco fale conosco!', 'Visualizada'),
(21, 11, '2024-11-25 19:50:50', 'Seu pedido foi atualizado!', 'A situação do seu pedido foi alterado para Entregue! Verifique-o na aba de pedidos!', 'Visualizada'),
(22, 12, '2025-01-16 19:22:25', 'Seja bem-vindo ao CantinaOnline+', 'Você realizou um cadastro na plataforma CantinaOnline+! Aproveite nossos produtos!', 'Visualizada'),
(23, 4, '2025-02-02 18:37:36', 'Teste', 'Eu amo comer.', 'Visualizada');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pagamentos`
--

CREATE TABLE `pagamentos` (
  `id_pedido` int(11) NOT NULL,
  `id_forma` int(11) NOT NULL,
  `valor` decimal(5,2) NOT NULL,
  `data` datetime DEFAULT NULL,
  `status` enum('Pago','Não Pago') DEFAULT 'Não Pago'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pagamentos`
--

INSERT INTO `pagamentos` (`id_pedido`, `id_forma`, `valor`, `data`, `status`) VALUES
(1, 2, 30.00, '2024-11-25 04:55:39', 'Pago'),
(2, 2, 10.00, '2024-11-25 08:24:56', 'Pago'),
(3, 2, 44.70, '2024-11-25 08:45:45', 'Pago'),
(4, 1, 10.00, '2024-11-25 09:55:59', 'Pago'),
(5, 2, 10.00, '2024-11-25 08:53:40', 'Pago'),
(6, 1, 24.00, '2024-11-25 10:03:35', 'Pago'),
(7, 2, 250.00, '2024-11-25 08:56:56', 'Pago'),
(8, 2, 69.50, '2024-11-25 11:18:04', 'Pago'),
(9, 1, 250.00, NULL, 'Não Pago'),
(10, 1, 20.00, NULL, 'Não Pago'),
(11, 1, 32.00, NULL, 'Não Pago'),
(12, 1, 20.00, '2024-11-25 13:59:43', 'Pago'),
(13, 1, 40.00, NULL, 'Não Pago'),
(14, 1, 10.00, '2024-11-25 15:05:48', 'Pago'),
(15, 1, 60.00, NULL, 'Não Pago'),
(16, 2, 14.00, '2024-11-25 16:50:01', 'Pago');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `data` datetime NOT NULL,
  `total` decimal(5,2) NOT NULL,
  `status` enum('Pendente','Pronto','Cancelado','Entregue') NOT NULL DEFAULT 'Pendente',
  `id_usuario` int(11) NOT NULL,
  `observacoes` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pedidos`
--

INSERT INTO `pedidos` (`id`, `data`, `total`, `status`, `id_usuario`, `observacoes`) VALUES
(1, '2024-11-25 04:55:39', 30.00, 'Entregue', 1, ''),
(2, '2024-11-25 08:24:56', 10.00, 'Entregue', 4, ''),
(3, '2024-11-25 08:45:44', 44.70, 'Pendente', 2, ''),
(4, '2024-11-25 08:52:36', 10.00, 'Pronto', 1, ''),
(5, '2024-11-25 08:53:40', 10.00, 'Pendente', 2, ''),
(6, '2024-11-25 08:56:29', 24.00, 'Cancelado', 1, ''),
(7, '2024-11-25 08:56:55', 250.00, 'Cancelado', 1, ''),
(8, '2024-11-25 11:18:04', 69.50, 'Pendente', 4, ''),
(9, '2024-11-25 11:18:24', 250.00, 'Pendente', 4, ''),
(10, '2024-11-25 11:20:25', 20.00, 'Pendente', 4, ''),
(11, '2024-11-25 11:23:43', 32.00, 'Pendente', 1, ''),
(12, '2024-11-25 13:58:20', 20.00, 'Entregue', 9, ''),
(13, '2024-11-25 15:02:06', 40.00, 'Cancelado', 10, 'eu quero ele queimado'),
(14, '2024-11-25 15:02:34', 10.00, 'Entregue', 10, ''),
(15, '2024-11-25 16:30:35', 60.00, 'Cancelado', 11, 'Sem cebola'),
(16, '2024-11-25 16:50:00', 14.00, 'Entregue', 11, '');

-- --------------------------------------------------------

--
-- Estrutura para tabela `precos_produtos`
--

CREATE TABLE `precos_produtos` (
  `id` int(11) NOT NULL,
  `id_variedade` int(11) NOT NULL,
  `id_tamanho` int(11) NOT NULL,
  `preco` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `precos_produtos`
--

INSERT INTO `precos_produtos` (`id`, `id_variedade`, `id_tamanho`, `preco`) VALUES
(1, 1, 4, 10.00),
(2, 2, 4, 10.00),
(3, 3, 4, 10.00),
(4, 4, 4, 10.00),
(5, 5, 4, 10.00),
(6, 6, 4, 10.00),
(7, 7, 4, 10.00),
(8, 8, 4, 10.00),
(9, 9, 4, 8.00),
(10, 10, 4, 10.00),
(11, 11, 4, 16.00),
(12, 12, 4, 10.00),
(14, 14, 4, 8.00),
(15, 15, 3, 6.00),
(16, 16, 4, 3.00),
(17, 17, 1, 3.00),
(18, 18, 1, 5.00),
(19, 19, 4, 5.00),
(20, 20, 4, 0.20),
(21, 21, 4, 3.00),
(22, 22, 4, 3.00),
(23, 23, 4, 0.50),
(24, 24, 4, 3.00),
(25, 25, 4, 2.00),
(26, 26, 4, 1.50),
(27, 27, 4, 2.00),
(28, 28, 4, 2.00),
(29, 29, 4, 2.00),
(30, 30, 4, 3.00),
(31, 31, 4, 10.00),
(32, 32, 4, 8.00),
(33, 33, 4, 8.00),
(34, 34, 4, 7.00),
(35, 35, 4, 7.00),
(36, 36, 4, 7.00),
(37, 37, 4, 7.00),
(38, 38, 4, 8.00),
(39, 39, 4, 8.00),
(40, 40, 4, 7.00),
(41, 41, 4, 10.00),
(42, 42, 4, 10.00),
(43, 43, 4, 10.00),
(44, 44, 4, 10.00),
(45, 45, 4, 10.00),
(46, 46, 4, 10.00),
(47, 47, 4, 10.00),
(48, 48, 4, 10.00),
(49, 49, 4, 10.00),
(50, 50, 4, 10.00),
(51, 51, 4, 8.00),
(52, 52, 4, 10.00),
(53, 53, 4, 10.00),
(56, 56, 4, 11.00),
(60, 60, 4, 12.00),
(62, 54, 4, 11.00),
(63, 55, 4, 11.00),
(64, 62, 4, 10.00),
(65, 63, 4, 10.00),
(66, 64, 4, 8.00),
(67, 65, 4, 3.50),
(68, 66, 2, 4.00),
(69, 67, 3, 5.00),
(71, 69, 3, 6.00),
(72, 70, 3, 7.00),
(73, 71, 1, 5.00),
(74, 72, 3, 7.00),
(75, 73, 1, 7.00),
(76, 74, 1, 7.00),
(77, 75, 3, 8.00),
(78, 76, 1, 7.00),
(79, 77, 3, 8.00),
(80, 78, 1, 7.00),
(81, 79, 3, 8.00),
(82, 80, 1, 7.00),
(83, 81, 3, 8.00),
(84, 82, 4, 3.00),
(85, 83, 4, 3.00),
(86, 84, 4, 3.00),
(87, 85, 4, 3.00),
(88, 86, 4, 3.00),
(89, 87, 4, 3.00),
(90, 88, 4, 3.00),
(91, 89, 4, 3.00),
(92, 90, 4, 3.00),
(93, 91, 4, 3.00),
(94, 92, 4, 0.50),
(95, 93, 4, 0.50),
(96, 94, 4, 0.50),
(97, 95, 4, 2.00),
(98, 96, 4, 10.00),
(99, 97, 4, 10.00),
(100, 98, 4, 10.00),
(101, 99, 4, 10.00),
(102, 100, 4, 7.00),
(103, 101, 4, 7.00),
(104, 102, 4, 7.00),
(105, 103, 4, 7.00),
(106, 104, 4, 7.00),
(107, 105, 4, 7.00),
(108, 106, 4, 7.00),
(109, 107, 4, 7.00),
(110, 108, 4, 7.00),
(111, 109, 4, 7.00),
(112, 110, 4, 7.00),
(113, 111, 4, 7.00),
(114, 112, 4, 8.00),
(116, 114, 4, 7.00),
(117, 115, 4, 7.00),
(118, 116, 4, 7.00),
(119, 117, 4, 7.00),
(120, 118, 4, 7.00),
(121, 119, 4, 8.00),
(122, 120, 4, 7.00);

-- --------------------------------------------------------

--
-- Estrutura para tabela `preferencias_usuarios`
--

CREATE TABLE `preferencias_usuarios` (
  `id_usuario` int(11) NOT NULL,
  `tema` enum('Claro','Escuro') NOT NULL DEFAULT 'Claro',
  `notificacoes` enum('Sim','Não') NOT NULL DEFAULT 'Sim',
  `id_forma` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `preferencias_usuarios`
--

INSERT INTO `preferencias_usuarios` (`id_usuario`, `tema`, `notificacoes`, `id_forma`) VALUES
(1, 'Claro', 'Sim', 1),
(2, 'Escuro', 'Sim', 2),
(3, 'Escuro', 'Sim', 2),
(4, 'Claro', 'Sim', 1),
(5, 'Claro', 'Sim', 1),
(6, 'Escuro', 'Sim', 1),
(7, 'Claro', 'Sim', 1),
(8, 'Claro', 'Sim', 1),
(9, 'Claro', 'Sim', 1),
(10, 'Escuro', 'Sim', 2),
(11, 'Claro', 'Sim', 1),
(12, 'Claro', 'Sim', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `nome` varchar(40) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `descricao` text DEFAULT NULL,
  `status` enum('Disponível','Indisponível') NOT NULL DEFAULT 'Disponível'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`id`, `nome`, `id_categoria`, `descricao`, `status`) VALUES
(1, 'Bauru', 1, 'O salgado assado de Bauru é uma massa crocante recheada com queijo derretido e tomate fresco, proporcionando um sabor irresistível. Ideal para um lanche rápido, é uma delícia que reflete a tradição e o sabor da região.', 'Disponível'),
(2, 'Torta', 1, 'A torta assada de frango ou palmito é uma delícia com massa crocante e recheio cremoso. Seja com frango desfiado ou palmito, cada mordida oferece um sabor rico e bem temperado, ideal para um almoço prático ou um lanche saboroso.', 'Disponível'),
(3, 'Esfiha', 1, 'A esfiha assada de frango ou carne é uma pequena delícia com massa leve e crocante, recheada com um saboroso tempero de frango ou carne. Cada mordida revela uma combinação perfeita de suculência e especiarias, ideal para um lanche rápido ou uma refeição saborosa.', 'Disponível'),
(4, 'Coxinha', 1, 'A coxinha assada de frango ou costela é uma opção irresistível com massa dourada e crocante, recheada com um recheio suculento e bem temperado. Leve e saborosa, oferece uma experiência deliciosa sem a fritura tradicional, ideal para um lanche prático e saboroso.', 'Disponível'),
(5, 'Croissant', 1, 'O croissant de presunto e queijo ou chocolate combina uma massa folhada leve e amanteigada com recheios irresistíveis: o primeiro, uma combinação salgada de presunto e queijo derretido; o segundo, um deleite doce com chocolate rico e derretido. Perfeito para um café da manhã sofisticado ou um lanche delicioso.', 'Disponível'),
(6, 'Folhado', 1, 'O folhado de presunto e queijo ou de 4 queijos é uma iguaria com massa leve e crocante, recheada com sabores irresistíveis. O de presunto e queijo oferece uma combinação clássica e deliciosa, enquanto o de 4 queijos proporciona um sabor rico e cremoso com uma mistura de queijos selecionados. Ideal para um lanche saboroso ou uma refeição rápida.', 'Disponível'),
(7, 'Hamburgão', 1, 'O hamburgão assado de cheddar ou de presunto e queijo é um lanche robusto e saboroso com massa macia e crocante. O de cheddar oferece um sabor intenso e cremoso, enquanto o de presunto e queijo combina a riqueza dos queijos derretidos com o toque salgado do presunto. Ideal para uma refeição satisfatória e deliciosa.', 'Disponível'),
(8, 'Lanche Natural', 1, 'O lanche natural de frango, atum ou ricota é uma opção leve e nutritiva, com recheios frescos e saborosos. O de frango oferece uma combinação suculenta e temperada, o de atum é delicado e cheio de sabor, enquanto o de ricota é cremoso e leve. Perfeito para um lanche saudável e refrescante.', 'Disponível'),
(9, 'Pão de Queijo', 1, 'O pão de queijo é um irresistível quitute brasileiro, com uma crosta dourada e crocante e um interior macio e recheado de queijo derretido. Seu sabor rico e textura leve tornam-no perfeito para um lanche ou café da manhã delicioso e reconfortante.', 'Disponível'),
(10, 'Pão de Batata', 1, 'O pão de batata assado é uma opção deliciosa e macia, disponível em dois sabores irresistíveis. O sabor parmesão oferece uma camada extra de riqueza e um toque salgado, com o queijo derretido adicionando profundidade ao pão. O sabor natural é suave e ligeiramente adocicado, destacando a textura macia e o sabor autêntico da batata. Ideal para um lanche reconfortante ou como acompanhamento saboroso em qualquer refeição.', 'Disponível'),
(11, 'Almoço', 1, 'Apenas os verdadeiros sabem sobre isso...', 'Indisponível'),
(12, 'Pizza Enrolada', 1, 'A pizza enrolada grandona de presunto e queijo ou frango é uma deliciosa combinação de massa macia e crocante, recheada com camadas generosas de presunto e queijo derretido ou frango suculento. Enrolada e assada até ficar dourada, oferece uma explosão de sabor a cada fatia, ideal para uma refeição compartilhada ou um lanche especial.', 'Indisponível'),
(13, 'Açaí', 2, 'O açaí é uma iguaria deliciosa e nutritiva, servida em sua forma pura com um sabor intenso e levemente terroso. Para um toque extra de indulgência, pode ser complementado com leite em pó (ninho), que adiciona uma cremosidade rica; leite condensado, para um doce extra e textura aveludada; ou paçoca, que oferece uma crocância e sabor irresistível de amendoim. Cada variação transforma o açaí em uma experiência ainda mais saborosa e personalizada.', 'Disponível'),
(14, 'Geladão', 2, 'O geladão é uma sobremesa irresistível e refrescante, com opções de sabores diversos. O de chocolate oferece um sabor profundo e indulgente, o de coco traz uma textura cremosa e um toque tropical, e o de morango é doce e frutado, com um leve frescor. Cada variedade proporciona uma experiência deliciosa e gelada, perfeita para se refrescar e satisfazer a vontade de um doce.', 'Disponível'),
(15, 'Achocolatado', 3, 'O achocolatado é uma bebida cremosa e doce, feita com cacau de alta qualidade misturado a leite. Com um sabor rico e aveludado, é a escolha perfeita para um café da manhã reconfortante ou um lanche prazeroso.', 'Disponível'),
(16, 'Água', 3, 'Água é uma bebida essencial que pode variar em suas características: a água mineral oferece pureza e leveza , já a água com gás proporciona uma efervescência revitalizante. Cada tipo de água atende a diferentes necessidades e preferências, garantindo hidratação e refrescância', 'Disponível'),
(17, 'Café', 3, 'O café é uma bebida versátil e reconfortante, disponível em diversas variações: o café pequeno é intenso e concentrado, ideal para um impulso rápido; o médio oferece um equilíbrio perfeito entre sabor e intensidade; o grande proporciona uma experiência prolongada de prazer; e o café com leite combina o robusto aroma do café com a suavidade do leite, criando uma mistura cremosa e agradável. Perfeito para qualquer momento do dia.', 'Disponível'),
(18, 'Chá gelado', 3, 'O chá gelado é uma bebida refrescante e saborosa, ideal para qualquer ocasião. O tamanho pequeno é perfeito para um toque de frescor, enquanto o grande oferece uma dose mais generosa. Disponível em limão, com um toque cítrico e revigorante, ou pêssego, com um sabor doce e frutado, cada variante proporciona uma experiência refrescante e deliciosa.', 'Disponível'),
(19, 'Suco', 3, 'O suco é uma bebida vibrante e nutritiva, disponível em diferentes tamanhos para atender ao seu apetite. O pequeno é ideal para um gole rápido de frescor, o grande oferece uma porção generosa de sabor e vitalidade, e o de copinho é perfeito para uma porção compacta e prática. Seja qual for a escolha, cada suco oferece um burst de sabor natural e refrescante.', 'Disponível'),
(20, 'Bala de Hortelã', 4, 'A bala de hortelã é uma pequena explosão de frescor, oferecendo um sabor refrescante e revigorante a cada mordida. Com seu toque mentolado e aromático, proporciona um alívio instantâneo e uma sensação de frescor, ideal para um impulso de energia ou um alívio do hálito.', 'Disponível'),
(21, 'Tortuguita', 4, 'A tortuguita é uma deliciosa pequena iguaria com várias opções de sabor. A versão de chocolate branco oferece uma doçura cremosa e suave, o chocolate ao leite proporciona um sabor rico e clássico, e o brigadeiro é uma explosão de sabor brasileiro com um toque de chocolate e leite condensado. Cada tipo é uma pequena indulgência, perfeita para um momento doce e satisfatório.', 'Disponível'),
(22, 'Mentos', 4, 'A bala Mentos é uma explosão refrescante de sabor e efervescência, com uma textura crocante que se dissolve suavemente na boca. Disponível em diversos sabores, como menta, frutas e outros, proporciona uma experiência revigorante e duradoura, ideal para um refresco instantâneo e um hálito fresco.', 'Disponível'),
(23, 'Chiclete', 4, 'O chiclete é um doce mastigável que combina sabor intenso e uma textura elástica e divertida. Disponível em uma ampla gama de sabores, desde frutados até mentolados, oferece um prazer duradouro e refrescante, perfeito para aliviar o estresse ou simplesmente saborear um momento doce', 'Disponível'),
(24, 'Halls', 4, 'A bala Halls é uma opção potente e refrescante, projetada para proporcionar um alívio imediato e um frescor duradouro. Com uma variedade de sabores, como menta e frutas, cada bala oferece uma explosão de sabor e um efeito revigorante, ideal para limpar o paladar e revitalizar o hálito.', 'Disponível'),
(25, 'Bala de Goma', 4, 'A bala de goma é um doce macio e mastigável, com uma textura gelatinosa e sabor vibrante. Disponível em uma variedade de sabores, como frutas e refrigerantes, oferece uma experiência doce e divertida a cada mordida, perfeita para um lanche rápido ou uma dose de prazer açucarado.', 'Disponível'),
(26, 'Paçoquita', 4, 'A paçoquita é um doce irresistível de amendoim, com uma textura macia e esfarelenta que derrete na boca. Com seu sabor doce e salgado, oferece um equilíbrio perfeito entre a riqueza do amendoim e um toque de doçura, proporcionando uma experiência saborosa e indulgente.', 'Disponível'),
(27, 'Pirulito', 4, 'O pirulito é um doce vibrante e divertido, disponível em sabores irresistíveis como 7Belo e BigBig. O SetBelo traz um toque clássico e refrescante, enquanto o BigBig oferece uma explosão de sabor intenso e duradouro. Cada pirulito combina uma textura crocante com uma experiência saborosa, perfeita para alegrar qualquer momento.', 'Disponível'),
(28, 'Bala Garoto', 4, 'A bala Garoto, ideal para aliviar a garganta, é uma opção saborosa e eficaz. Com uma textura suave e um sabor agradável, proporciona um alívio calmante e refrescante, ajudando a suavizar a garganta irritada. Perfeita para momentos em que você precisa de um conforto doce e um toque de bem-estar.', 'Disponível'),
(29, 'Doce de Leite', 4, 'O doce de leite, servido em pequenas unidades na cantina, é um manjar irresistível com uma textura cremosa e um sabor doce e rico. Cada porção oferece uma explosão de indulgência, perfeita para um lanche rápido ou um momento de prazer doce. Ideal para satisfazer a vontade de um deleite caseiro e aconchegante.', 'Disponível'),
(30, 'Bananinha', 4, 'A bananinha é um docinho industrializado à base de banana, com textura macia e sabor doce, ideal para um lanche prático e saboroso.', 'Indisponível'),
(31, 'Bolo de Pote', 5, 'O bolo de pote é uma sobremesa prática e deliciosa, disponível em sabores irresistíveis. O brigadeiro oferece um toque de chocolate cremoso, o Oreo combina camadas de bolo com pedacinhos do biscoito clássico, o Ninho é suave e levemente adocicado com o sabor do leite em pó, e o Ninho com Nutella adiciona uma indulgência extra com a cremosidade do chocolate hazelnut. Cada sabor proporciona uma experiência doce e satisfatória em porções práticas.', 'Disponível'),
(32, 'Brownie', 5, 'O brownie é um doce rico e irresistível, com uma textura densa e úmida que combina a crocância nas bordas com um centro macio e fudgy. Com seu sabor intenso de chocolate, frequentemente enriquecido com pedaços de nozes ou pedaços de chocolate, o brownie oferece uma experiência indulgente e reconfortante a cada mordida. Perfeito para um lanche doce ou uma sobremesa satisfatória.', 'Disponível'),
(33, 'Palha Italiana', 5, 'A palha italiana é um doce sofisticado e saboroso, que combina pedaços de biscoito crocante com um recheio cremoso e enriquecido com chocolate e leite condensado. Com uma textura macia e uma doçura envolvente, cada mordida oferece uma mistura perfeita de sabores e uma indulgência irresistível. Ideal para quem busca um doce caseiro com um toque gourmet.', 'Disponível'),
(34, 'Pão de Mel', 5, 'O pão de mel vendido em unidades é um doce aconchegante e saboroso, com uma massa macia e ligeiramente especiada, coberta por uma camada generosa de chocolate. Cada unidade é recheada com um toque de doce de leite ou geleia, oferecendo uma combinação irresistível de sabores e texturas. Perfeito para um lanche indulgente ou uma sobremesa reconfortante.', 'Disponível'),
(35, 'Paçocão', 5, 'O Paçocão da cantina é uma sobremesa irresistível que traz toda a riqueza do amendoim em uma apresentação generosa. Com uma textura cremosa e esfarelenta, cada porção oferece um sabor intenso e doce, perfeitamente equilibrado com a crocância do amendoim. Ideal para quem deseja um toque de indulgência e sabor autêntico em um formato prático e saboroso.', 'Disponível'),
(36, 'Cone', 5, 'O cone é uma sobremesa deliciosa e versátil, disponível em uma variedade de sabores indulgentes. O sabor Belga oferece uma experiência rica e sofisticada com chocolate de alta qualidade, o brigadeiro é cremoso e doce, trazendo o sabor tradicional brasileiro, a cereja proporciona um toque frutado e refrescante, o doce de leite é suave e caramelizado, e o coco oferece uma textura tropical e cremosa. Cada cone é uma explosão de sabor em cada mordida, perfeito para um prazer doce e refrescante.', 'Disponível'),
(37, 'Trufa', 5, 'A trufa é um doce sofisticado e indulgente, disponível em uma seleção de sabores irresistíveis. A versão Belga combina chocolate de alta qualidade com uma textura rica e aveludada. O brigadeiro oferece um toque doce e cremoso, enquanto a cereja traz uma nota frutada e vibrante. O doce de leite proporciona uma doçura suave e caramelizada, o coco adiciona um sabor tropical e exótico, e o café oferece um toque aromático e revigorante. Cada trufa é uma pequena explosão de sabor, perfeita para momentos de prazer e indulgência.', 'Disponível'),
(38, 'Mousse', 5, 'O mousse de chocolate é uma sobremesa luxuosa e irresistível, com uma textura leve e aveludada que derrete na boca. Feita com chocolate de alta qualidade, oferece um sabor intenso e profundo, perfeitamente equilibrado com uma suavidade cremosa. Cada colherada proporciona uma experiência indulgente e satisfatória, ideal para finalizar uma refeição com um toque doce e sofisticado.', 'Disponível'),
(39, 'Pavê', 5, 'O pavê de copo vendido em unidades é uma sobremesa individual deliciosa e prática, com camadas alternadas de creme suave e biscoitos embebidos. Cada porção oferece uma combinação de texturas e sabores, variando entre o doce e o crocante, ideal para uma indulgência rápida ou para saborear em momentos especiais. É a escolha perfeita para quem busca um toque sofisticado e saboroso em porções convenientes.', 'Disponível'),
(40, 'Água de coco', 3, 'Água de coco é uma bebida natural e refrescante, rica em eletrólitos e ideal para hidratar e revitalizar. Perfeita para qualquer momento do dia.', 'Disponível'),
(41, 'Gelatina', 5, 'Apresentamos a gelatina cremosa, uma inovação deliciosa que chegou para transformar o seu intervalo. Com uma textura irresistivelmente suave e cremosa, ela combina o sabor doce com um toque de sofisticação, tornando cada mordida uma experiência única. Feita com ingredientes selecionados e preparada com cuidado, nossa gelatina é a escolha perfeita para quem busca um lanche saboroso e nutritivo.', 'Disponível');

-- --------------------------------------------------------

--
-- Estrutura para tabela `sobre`
--

CREATE TABLE `sobre` (
  `id` int(11) NOT NULL,
  `titulo` varchar(30) NOT NULL,
  `texto` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `sobre`
--

INSERT INTO `sobre` (`id`, `titulo`, `texto`) VALUES
(1, 'QUEM NÓS SOMOS?', 'O CantinaOnline+ consiste em uma grande plataforma administradora de pedidos online, responsáveis pelos serviços da cantina do Colégio Técnico Opção. Juntos formamos um lugar onde a nutrição e o bem-estar se encontram unidos diariamente na vida de cada estudante.'),
(2, 'Nosso Dever', 'Nossa missão como fornecedora escolar de alimentos é disponibilizar, para todos os alunos, produtos deliciosos e de boa qualidade no menor tempo possível através do CantinaOnline+. Além disso, permitimos que cada usuário possua uma variedade de opções para complementar sua refeição, contribuindo na alimentação saudável de cada cliente.'),
(3, 'Nossa Origem', 'Desde 2021, temos orgulho de apresentar uma rede com uma ampla variedade de opções para a refeição de cada aluno. Nossa equipe é composta por profissionais que se comprometem com a qualidade e segurança alimentar. Trabalhamos com ingredientes naturais e selecionados para garantir que cada refeição não seja apenas nutritiva, mas também agrade o gosto de cada cliente.');

-- --------------------------------------------------------

--
-- Estrutura para tabela `status_usuarios`
--

CREATE TABLE `status_usuarios` (
  `id_usuario` int(11) NOT NULL,
  `status` enum('Admin','Vendedor','Cliente','Inativo','Suspenso') NOT NULL DEFAULT 'Inativo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `status_usuarios`
--

INSERT INTO `status_usuarios` (`id_usuario`, `status`) VALUES
(1, 'Admin'),
(2, 'Vendedor'),
(3, 'Admin'),
(4, 'Admin'),
(5, 'Cliente'),
(6, 'Cliente'),
(7, 'Cliente'),
(8, 'Cliente'),
(9, 'Cliente'),
(10, 'Cliente'),
(11, 'Admin'),
(12, 'Cliente');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tamanhos_produtos`
--

CREATE TABLE `tamanhos_produtos` (
  `id` int(11) NOT NULL,
  `nome` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tamanhos_produtos`
--

INSERT INTO `tamanhos_produtos` (`id`, `nome`) VALUES
(1, 'Pequeno'),
(2, 'Médio'),
(3, 'Grande'),
(4, 'Único');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `sobrenome` varchar(50) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `telefone` varchar(14) NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(12) NOT NULL,
  `imagem` varchar(256) DEFAULT NULL,
  `data_cadastro` timestamp NOT NULL DEFAULT current_timestamp(),
  `saldo` decimal(6,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `sobrenome`, `cpf`, `telefone`, `email`, `senha`, `imagem`, `data_cadastro`, `saldo`) VALUES
(1, 'Caique', 'Souza Pires de Camargo', '481.653.428-86', '(12)99662-1320', 'caique.spcamargo@gmail.com', 'galinha1305', '6744d17962c07.png', '2024-11-25 06:44:08', 1200.00),
(2, 'João Scamilla', 'Whyte Jardim Gailey', '947.355.793-03', '(18)99999-9999', 'scamilla@gmail.com', 'scamilla232', '674462d68e16b.jpg', '2024-11-25 06:47:45', 4945.30),
(3, 'João', 'Paulo Aparecido Santos', '353.348.482-31', '(12)99219-6356', 'Joao.paulo@gmail.com', 'amarelo1304', '67445e9d6e7de.jpg', '2024-11-25 07:22:12', 7770.00),
(4, 'CantinaOnline+', 'OFC', '000.000.000-00', '(00)00000-0000', 'cantinaonline@gmail.com', 'CJPJS2024', 'default.jpg', '2024-11-25 07:35:57', 9920.49),
(5, 'João', 'Vitor Etep Overas', '966.081.358-90', '(17)38563-5490', 'jvetep@gmail.com', 'Joaoetep', '67445fe7d297f.jpg', '2024-11-25 07:45:13', 100.00),
(6, 'Eduardo', 'Verissimo das Graças Miguel', '181.323.899-56', '(13)39657-5014', 'eduardo.carioca@gmail.com', 'eduardo333', '67445eb5f22c0.jpg', '2024-11-25 07:49:20', 0.10),
(7, 'Marcos', 'Vinicius Miguel Ferreira', '207.858.605-68', '(17)22064-7611', 'marcos.vmf@gmail.com', 'marcos1515', '67445ec304226.jpg', '2024-11-25 07:52:41', 1.51),
(8, 'Felipe', 'Nascimento', '546.835.888-80', '(13)97798-6542', 'felipenas@gmail.com', 'felipenas', '6744a180ae170.png', '2024-11-25 15:18:36', 1.00),
(9, 'kaio da maçã', 'rodrigues', '298.634.110-19', '(99)99999-9999', '3@3', 'kaio11111111', 'default.jpg', '2024-11-25 16:36:10', 0.00),
(10, 'pedro henrique', 'cerolos', '347.856.324-75', '(12)74683-7474', 'ceroloz@gmail.com', '999999999999', '6744baec19169.jpg', '2024-11-25 17:57:19', 0.00),
(11, 'Carlos', 'Alberto', '429.919.458-69', '(12)99176-7084', 'joaoscamilla@gmail.com', '999999999999', 'default.jpg', '2024-11-25 19:25:24', 986.00),
(12, 'João', 'Santos', '444.444.444-44', '(44)44444-4444', 'suprejaoee@gmail.com', '444444444444', 'default.jpg', '2025-01-16 19:21:46', 0.00);

-- --------------------------------------------------------

--
-- Estrutura para tabela `variedades_produtos`
--

CREATE TABLE `variedades_produtos` (
  `id` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `nome` varchar(40) NOT NULL,
  `status` enum('Disponível','Indisponível') NOT NULL DEFAULT 'Disponível'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `variedades_produtos`
--

INSERT INTO `variedades_produtos` (`id`, `id_produto`, `nome`, `status`) VALUES
(1, 1, 'Tradicional', 'Disponível'),
(2, 2, 'Torta de Palmito', 'Disponível'),
(3, 3, 'Esfiha de Carne', 'Disponível'),
(4, 4, 'Coxinha de Catupiry', 'Disponível'),
(5, 5, 'Croissant de Presunto e Queijo', 'Disponível'),
(6, 6, 'Folhado de 4 Queijos', 'Disponível'),
(7, 7, 'Hamburgão de Cheddar', 'Disponível'),
(8, 8, 'Lanche Natural de Atum', 'Disponível'),
(9, 9, 'Pão de Queijo Natural', 'Disponível'),
(10, 10, 'Pão de Batata Natural', 'Disponível'),
(11, 11, 'Tradicional', 'Disponível'),
(12, 12, 'Pizza Enrola de Presunto e Queijo', 'Indisponível'),
(14, 14, 'Geladão de Morango', 'Disponível'),
(15, 15, 'Tradicional', 'Disponível'),
(16, 16, 'Água (Mineral)', 'Disponível'),
(17, 17, 'Café Puro', 'Disponível'),
(18, 18, 'Chá Gelado de Pêssego', 'Disponível'),
(19, 19, 'Refresco no Copo', 'Disponível'),
(20, 20, 'Tradicional', 'Disponível'),
(21, 21, 'Tortuguita Chocolate Branco', 'Disponível'),
(22, 22, 'Mentos Mint', 'Disponível'),
(23, 23, 'Chiclete Hotelã', 'Disponível'),
(24, 24, 'Halls de Menta', 'Disponível'),
(25, 25, 'Tradicional', 'Disponível'),
(26, 26, 'Tradicional', 'Disponível'),
(27, 27, 'Pirulito 7Belo', 'Disponível'),
(28, 28, 'Tradicional', 'Disponível'),
(29, 29, 'Tradicional', 'Disponível'),
(30, 30, 'Tradicional', 'Disponível'),
(31, 31, 'Bolo de Brigadeiro', 'Disponível'),
(32, 32, 'Tradicional', 'Disponível'),
(33, 33, 'Tradicional', 'Disponível'),
(34, 34, 'Tradicional', 'Disponível'),
(35, 35, 'Tradicional', 'Disponível'),
(36, 36, 'Cone Tradicional', 'Disponível'),
(37, 37, 'Trufa Tradicional', 'Disponível'),
(38, 38, 'Musse de Chocolate', 'Disponível'),
(39, 39, 'Pavê Tradicional', 'Disponível'),
(40, 40, 'Tradicional', 'Disponível'),
(41, 2, 'Torta de Frango', 'Disponível'),
(42, 5, 'Croissant de Chocolate', 'Disponível'),
(43, 5, 'Croissant de Frango', 'Indisponível'),
(44, 3, 'Esfiha de Frango', 'Disponível'),
(45, 6, 'Folhado de Presunto e Queijo', 'Disponível'),
(46, 6, 'Folhado de Frango', 'Indisponível'),
(47, 7, 'Hamburgão de Presunto e Queijo', 'Disponível'),
(48, 7, 'Hamburgão de Bacon', 'Indisponível'),
(49, 8, 'Lanche Natural de Ricota', 'Disponível'),
(50, 8, 'Lanche Natural de Frango', 'Disponível'),
(51, 9, 'Pão de Queijo Parmesão', 'Disponível'),
(52, 10, 'Pão de Batata Parmesão', 'Disponível'),
(53, 13, 'Açaí (puro)', 'Disponível'),
(54, 13, 'Açaí (Paçoca)', 'Disponível'),
(55, 13, 'Açaí (Ninho)', 'Disponível'),
(56, 13, 'Açaí (Leite Condensado)', 'Disponível'),
(60, 13, 'Açaí com Sorvete', 'Disponível'),
(62, 4, 'Coxinha de Bacon', 'Disponível'),
(63, 12, 'Pizza Enrola de Frango', 'Indisponível'),
(64, 14, 'Geladão de Chocolate', 'Disponível'),
(65, 16, 'Água com Gás', 'Disponível'),
(66, 17, 'Café Puro', 'Disponível'),
(67, 17, 'Café Puro', 'Disponível'),
(69, 17, 'Café com Leite', 'Disponível'),
(70, 18, 'Chá Gelado de Pêssego', 'Disponível'),
(71, 18, 'Chá Gelado de Limão', 'Disponível'),
(72, 18, 'Chá Gelado de Limão', 'Disponível'),
(73, 19, 'Suco de Caixinha', 'Disponível'),
(74, 19, 'Suco de Uva', 'Disponível'),
(75, 19, 'Suco de Uva', 'Disponível'),
(76, 19, 'Suco de Laranja', 'Disponível'),
(77, 19, 'Suco de Laranja', 'Disponível'),
(78, 19, 'Suco de Laranja com Acerola', 'Disponível'),
(79, 19, 'Suco de Laranja com Acerola', 'Disponível'),
(80, 19, 'Suco de Limão', 'Disponível'),
(81, 19, 'Suco de Limão', 'Disponível'),
(82, 21, 'Tortuguita Chocolate ao Leite', 'Disponível'),
(83, 21, 'Tortuguita de Brigadeiro', 'Disponível'),
(84, 24, 'Halls de Cereja', 'Disponível'),
(85, 24, 'Halls de Morango', 'Disponível'),
(86, 24, 'Halls de Melancia ', 'Disponível'),
(87, 24, 'Halls Mentol', 'Disponível'),
(88, 24, 'Halls Extra Forte Preto', 'Disponível'),
(89, 22, 'Mentos Sour Mix', 'Disponível'),
(90, 22, 'Mentos Rainbow', 'Disponível'),
(91, 22, 'Mentos Fruit', 'Disponível'),
(92, 23, 'Chiclete Morango', 'Disponível'),
(93, 23, 'Chiclete Tutti Frutti', 'Disponível'),
(94, 23, 'Chiclete Uva', 'Disponível'),
(95, 27, 'Pirulito BigBig', 'Disponível'),
(96, 31, 'Bolo de Confete', 'Disponível'),
(97, 31, 'Bolo de Churros', 'Disponível'),
(98, 31, 'Bolo de Ninho com Nutella', 'Disponível'),
(99, 31, 'Bolo de Óreo', 'Disponível'),
(100, 36, 'Cone Belga', 'Disponível'),
(101, 36, 'Cone Brigadeiro', 'Disponível'),
(102, 36, 'Cone Ninho com Nutella', 'Disponível'),
(103, 36, 'Cone Brigadeiro', 'Disponível'),
(104, 36, 'Cone Doce de Leite', 'Disponível'),
(105, 36, 'Cone Maracujá', 'Disponível'),
(106, 36, 'Cone Don Faello', 'Disponível'),
(107, 36, 'Cone de Coco', 'Disponível'),
(108, 37, 'Trufa Cereja', 'Disponível'),
(109, 37, 'Trufa Brigadeiro', 'Disponível'),
(110, 37, 'Trufa Nutellinho', 'Disponível'),
(111, 37, 'Trufa Café Gourmet', 'Disponível'),
(112, 38, 'Musse de Morango', 'Disponível'),
(114, 37, 'Trufa Doce de Leite', 'Disponível'),
(115, 37, 'Trufa Maracujá', 'Disponível'),
(116, 37, 'Trufa de Coco', 'Disponível'),
(117, 37, 'Trufa Don Faello', 'Disponível'),
(118, 37, 'Trufa Reininho', 'Disponível'),
(119, 39, 'Pavê de Maracujá', 'Disponível'),
(120, 41, 'Tradicional', 'Disponível');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `cards`
--
ALTER TABLE `cards`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `carrinho`
--
ALTER TABLE `carrinho`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Índices de tabela `carrossel`
--
ALTER TABLE `carrossel`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `categorias_produtos`
--
ALTER TABLE `categorias_produtos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `detalhes_pedidos`
--
ALTER TABLE `detalhes_pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pedido` (`id_pedido`),
  ADD KEY `id_preco` (`id_preco`);

--
-- Índices de tabela `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `favoritos_usuarios`
--
ALTER TABLE `favoritos_usuarios`
  ADD PRIMARY KEY (`id_usuario`,`id_produto`),
  ADD KEY `id_produto` (`id_produto`);

--
-- Índices de tabela `formas_pagamentos`
--
ALTER TABLE `formas_pagamentos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `imagens_produtos`
--
ALTER TABLE `imagens_produtos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_produto` (`id_produto`);

--
-- Índices de tabela `itens_carrinho`
--
ALTER TABLE `itens_carrinho`
  ADD PRIMARY KEY (`id_usuario`,`id_preco`),
  ADD KEY `id_preco` (`id_preco`);

--
-- Índices de tabela `notificacoes`
--
ALTER TABLE `notificacoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Índices de tabela `pagamentos`
--
ALTER TABLE `pagamentos`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `id_forma` (`id_forma`);

--
-- Índices de tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Índices de tabela `precos_produtos`
--
ALTER TABLE `precos_produtos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_variedade` (`id_variedade`),
  ADD KEY `id_tamanho` (`id_tamanho`);

--
-- Índices de tabela `preferencias_usuarios`
--
ALTER TABLE `preferencias_usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `id_forma` (`id_forma`);

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Índices de tabela `sobre`
--
ALTER TABLE `sobre`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `status_usuarios`
--
ALTER TABLE `status_usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Índices de tabela `tamanhos_produtos`
--
ALTER TABLE `tamanhos_produtos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `variedades_produtos`
--
ALTER TABLE `variedades_produtos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_produto` (`id_produto`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categorias_produtos`
--
ALTER TABLE `categorias_produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `detalhes_pedidos`
--
ALTER TABLE `detalhes_pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT de tabela `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `formas_pagamentos`
--
ALTER TABLE `formas_pagamentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `imagens_produtos`
--
ALTER TABLE `imagens_produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT de tabela `notificacoes`
--
ALTER TABLE `notificacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `precos_produtos`
--
ALTER TABLE `precos_produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de tabela `tamanhos_produtos`
--
ALTER TABLE `tamanhos_produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `variedades_produtos`
--
ALTER TABLE `variedades_produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `carrinho`
--
ALTER TABLE `carrinho`
  ADD CONSTRAINT `carrinho_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `detalhes_pedidos`
--
ALTER TABLE `detalhes_pedidos`
  ADD CONSTRAINT `detalhes_pedidos_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `detalhes_pedidos_ibfk_2` FOREIGN KEY (`id_preco`) REFERENCES `precos_produtos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `favoritos_usuarios`
--
ALTER TABLE `favoritos_usuarios`
  ADD CONSTRAINT `favoritos_usuarios_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `favoritos_usuarios_ibfk_2` FOREIGN KEY (`id_produto`) REFERENCES `produtos` (`id`);

--
-- Restrições para tabelas `imagens_produtos`
--
ALTER TABLE `imagens_produtos`
  ADD CONSTRAINT `imagens_produtos_ibfk_1` FOREIGN KEY (`id_produto`) REFERENCES `produtos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `itens_carrinho`
--
ALTER TABLE `itens_carrinho`
  ADD CONSTRAINT `itens_carrinho_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `carrinho` (`id_usuario`) ON DELETE CASCADE,
  ADD CONSTRAINT `itens_carrinho_ibfk_2` FOREIGN KEY (`id_preco`) REFERENCES `precos_produtos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `notificacoes`
--
ALTER TABLE `notificacoes`
  ADD CONSTRAINT `notificacoes_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `pagamentos`
--
ALTER TABLE `pagamentos`
  ADD CONSTRAINT `pagamentos_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pagamentos_ibfk_2` FOREIGN KEY (`id_forma`) REFERENCES `formas_pagamentos` (`id`);

--
-- Restrições para tabelas `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

--
-- Restrições para tabelas `precos_produtos`
--
ALTER TABLE `precos_produtos`
  ADD CONSTRAINT `precos_produtos_ibfk_1` FOREIGN KEY (`id_variedade`) REFERENCES `variedades_produtos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `precos_produtos_ibfk_2` FOREIGN KEY (`id_tamanho`) REFERENCES `tamanhos_produtos` (`id`) ON UPDATE CASCADE;

--
-- Restrições para tabelas `preferencias_usuarios`
--
ALTER TABLE `preferencias_usuarios`
  ADD CONSTRAINT `preferencias_usuarios_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `preferencias_usuarios_ibfk_2` FOREIGN KEY (`id_forma`) REFERENCES `formas_pagamentos` (`id`);

--
-- Restrições para tabelas `produtos`
--
ALTER TABLE `produtos`
  ADD CONSTRAINT `produtos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias_produtos` (`id`);

--
-- Restrições para tabelas `status_usuarios`
--
ALTER TABLE `status_usuarios`
  ADD CONSTRAINT `status_usuarios_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `variedades_produtos`
--
ALTER TABLE `variedades_produtos`
  ADD CONSTRAINT `variedades_produtos_ibfk_1` FOREIGN KEY (`id_produto`) REFERENCES `produtos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
