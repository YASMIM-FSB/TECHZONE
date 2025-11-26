-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 26/11/2025 às 05:45
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `techzone`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(200) NOT NULL,
  `short_name` varchar(120) DEFAULT NULL,
  `slug` varchar(200) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `old_price` decimal(10,2) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `in_stock` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `products`
--

INSERT INTO `products` (`id`, `name`, `short_name`, `slug`, `description`, `price`, `old_price`, `image`, `category`, `in_stock`, `created_at`) VALUES
(1, 'Mando para juegos', 'Mando para juegos', 'mando-para-juegos', 'Mando para juegos ergonómico, ideal para sesiones largas de gaming.', 120.00, 160.00, 'assets/img/GERAL/1.png', 'Gaming', 1, '2025-11-26 03:52:08'),
(2, 'Enfriador de agua', 'Enfriador de agua', 'enfriador-de-agua', 'Sistema de enfriamiento por agua para mantener tu PC a baja temperatura.', 960.00, 1160.00, 'assets/img/GERAL/4.png', 'Componentes', 1, '2025-11-26 03:52:08'),
(3, 'Ratón sencillo CLL25', 'Ratón sencillo CLL25', 'raton-sencillo-cll25', 'Ratón sencillo y cómodo para uso diario y oficina.', 370.00, 400.00, 'assets/img/GERAL/5.png', 'Periféricos', 1, '2025-11-26 03:52:08'),
(4, '63 GB de RAM BEST FURY', '63 GB de RAM BEST FURY', '63-gb-de-ram-best-fury', 'Módulos de memoria RAM de alto rendimiento para tareas exigentes.', 160.00, 180.00, 'assets/img/GERAL/11.png', 'Componentes', 1, '2025-11-26 03:52:08'),
(5, 'Teclado con cable HV-G92', 'Teclado con cable HV-G92', 'teclado-con-cable-hv-g92', 'Teclado con cable con diseño moderno, perfecto para juegos y trabajo.', 120.00, 160.00, 'assets/img/GERAL/8.png', 'Periféricos', 1, '2025-11-26 03:52:08'),
(6, 'Cámara web Logitech 4k', 'Cámara web Logitech 4k', 'camara-web-logitech-4k', 'Cámara web con resolución 4K, ideal para videollamadas profesionales.', 960.00, 1160.00, 'assets/img/GERAL/6.png', 'Cámaras web', 1, '2025-11-26 03:52:08'),
(7, 'Silla de juego XLL0123', 'Silla de juego XLL0123', 'silla-de-juego-xll0123', 'Silla gamer ergonómica con soporte lumbar para largas sesiones.', 370.00, 400.00, 'assets/img/carrossel1/3.png', 'Sillas', 1, '2025-11-26 03:52:08'),
(8, 'Actualización BS', 'Actualización BS', 'actualizacion-bs', 'Kit de actualización para mejorar el rendimiento de tu PC.', 80.00, 160.00, 'assets/img/carrossel1/5.png', 'Componentes', 1, '2025-11-26 03:52:08'),
(9, 'Mando para juegos (carrossel)', 'Mando para juegos', 'mando-para-juegos-carrossel', 'Mando para juegos con diseño moderno y gran precisión.', 120.00, 160.00, 'assets/img/carrossel1/1.png', 'Gaming', 1, '2025-11-26 03:52:08'),
(10, 'Teclado con cable AK-900', 'Teclado con cable AK-900', 'teclado-con-cable-ak-900', 'Teclado mecánico con retroiluminación, perfecto para gamers.', 960.00, 1160.00, 'assets/img/GERAL/3.png', 'Periféricos', 1, '2025-11-26 03:52:08'),
(11, 'Monitor de juegos LCD IPS', 'Monitor de juegos LCD IPS', 'monitor-de-juegos-lcd-ips', 'Monitor gamer con panel IPS y excelente reproducción de colores.', 370.00, 400.00, 'assets/img/carrossel1/2.png', 'Monitores', 1, '2025-11-26 03:52:08'),
(12, 'RGB líquido CPU Cooler', 'RGB líquido CPU Cooler', 'rgb-liquido-cpu-cooler', 'Sistema de refrigeración líquida con iluminación RGB para CPU.', 160.00, 180.00, 'assets/img/carrossel1/4.png', 'Componentes', 1, '2025-11-26 03:52:08'),
(13, 'Actualización BS', 'Actualización BS', 'actualizacion-bs', 'Kit de actualización de alto rendimiento para mejorar tu PC.', 80.00, 160.00, 'assets/img/carrossel1/5.png', 'Componentes', 1, '2025-11-26 04:06:34'),
(14, 'Attack Shark X11 0.1', 'Attack Shark X11', 'attack-shark-x11-01', 'Teclado mecánico gamer de alta precisión con diseño agresivo.', 960.00, 1160.00, 'assets/img/carrossel1/6.png', 'Periféricos', 1, '2025-11-26 04:06:34'),
(15, 'Silla de juego XLL0123', 'Silla gamer XLL0123', 'silla-de-juego-xll0123', 'Silla gamer ergonómica con soporte lumbar y reclinación ajustable.', 370.00, 400.00, 'assets/img/carrossel1/3.png', 'Sillas', 1, '2025-11-26 04:06:34'),
(16, 'Auriculares X1125', 'Auriculares X1125', 'auriculares-x1125', 'Auriculares de alta fidelidad con graves profundos y diseño minimalista.', 80.00, 160.00, 'assets/img/GERAL/9.png', 'Audio', 1, '2025-11-26 04:06:34'),
(17, 'Monitor AOC X06', 'Monitor AOC X06', 'monitor-aoc-x06', 'Monitor AOC X06 con panel de alta definición y excelente calidad de color.', 120.00, 280.00, 'assets/img/GERAL/2.png', 'Monitores', 1, '2025-11-26 04:15:11'),
(18, 'Enfriador de agua', 'Enfriador de agua', 'enfriador-de-agua', 'Sistema de enfriamiento líquido de alto rendimiento para equipos exigentes.', 960.00, 1160.00, 'assets/img/GERAL/4.png', 'Refrigeración', 1, '2025-11-26 04:15:11'),
(19, 'Ratón sencillo CLL25', 'Ratón CLL25', 'raton-sencillo-cll25', 'Ratón óptico de diseño simple, cómodo y de excelente precisión.', 370.00, 400.00, 'assets/img/GERAL/5.png', 'Periféricos', 1, '2025-11-26 04:15:11'),
(20, '63 GB de RAM BEST FURY', 'RAM BEST FURY 63GB', '63-gb-ram-best-fury', 'Módulo de memoria RAM ultrarápida, ideal para tareas pesadas y gaming.', 160.00, 180.00, 'assets/img/GERAL/11.png', 'Memoria RAM', 1, '2025-11-26 04:15:11');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
