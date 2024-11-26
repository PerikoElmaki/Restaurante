-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-11-2024 a las 19:48:24
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `restaurante`
--
DROP DATABASE IF EXISTS restaurante;
CREATE DATABASE IF NOT EXISTS `restaurante` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `restaurante`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `camareros`
--

CREATE TABLE `camareros` (
  `id` int(10) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `contraseña` varchar(50) NOT NULL,
  `dni` varchar(50) NOT NULL,
  `foto` varchar(50) NOT NULL,
  `encargado` int(10) NOT NULL DEFAULT 0,
  `suspendido` int(2) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `camareros`
--

INSERT INTO `camareros` (`id`, `nombre`, `contraseña`, `dni`, `foto`, `encargado`, `suspendido`) VALUES
(1, 'admin', 'admin', '11111111E', '11111111E.jpg', 1, 0),
(3, 'Rosa ', 'rosa', '33333333A', 'rosa.jpg', 0, 1),
(6, 'Pedro', 'redy', '48748246E', '48748246E.jpg', 0, 1),
(8, 'Fernando', 'maker', '46789823F', '46789823F.jpg', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineas_carrito`
--

CREATE TABLE `lineas_carrito` (
  `id` int(11) NOT NULL,
  `producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineas_pedidos`
--

CREATE TABLE `lineas_pedidos` (
  `id` int(11) NOT NULL,
  `pedido` int(11) NOT NULL,
  `producto` int(11) NOT NULL,
  `cant` int(10) NOT NULL,
  `comentario` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `lineas_pedidos`
--

INSERT INTO `lineas_pedidos` (`id`, `pedido`, `producto`, `cant`, `comentario`) VALUES
(3, 2, 20, 1, ''),
(4, 2, 23, 1, ''),
(8, 4, 1, 1, ''),
(9, 4, 6, 1, ''),
(10, 4, 7, 1, ''),
(11, 4, 9, 1, ''),
(12, 4, 10, 1, ''),
(13, 4, 11, 1, ''),
(14, 4, 12, 1, ''),
(15, 4, 19, 1, ''),
(16, 4, 20, 1, ''),
(17, 4, 21, 1, ''),
(18, 4, 24, 1, ''),
(19, 4, 35, 1, ''),
(20, 4, 36, 1, ''),
(21, 5, 9, 1, ''),
(22, 5, 10, 1, ''),
(23, 5, 11, 4, ''),
(24, 5, 15, 1, ''),
(25, 5, 16, 3, ''),
(26, 5, 17, 1, ''),
(27, 5, 35, 4, ''),
(28, 5, 38, 1, ''),
(29, 6, 27, 1, ''),
(30, 6, 28, 3, ''),
(31, 6, 30, 1, ''),
(32, 6, 31, 2, ''),
(33, 7, 20, 1, ''),
(34, 7, 21, 2, ''),
(35, 7, 23, 2, ''),
(36, 7, 24, 2, ''),
(37, 7, 25, 1, ''),
(41, 9, 2, 2, 'si hielo'),
(42, 9, 7, 1, ''),
(43, 9, 10, 1, ''),
(44, 9, 24, 2, ''),
(45, 9, 27, 1, ''),
(46, 9, 31, 1, ''),
(47, 10, 9, 3, ''),
(48, 10, 13, 1, ''),
(49, 11, 19, 2, ''),
(50, 11, 20, 2, ''),
(51, 12, 4, 5, ''),
(54, 13, 5, 1, ''),
(58, 14, 16, 1, ''),
(59, 14, 17, 1, ''),
(60, 14, 34, 1, ''),
(61, 14, 35, 1, ''),
(62, 14, 1, 1, ''),
(63, 14, 6, 1, ''),
(64, 14, 9, 1, ''),
(65, 14, 14, 1, ''),
(66, 14, 26, 1, 'olivas'),
(67, 14, 31, 1, 'extra guanciale');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesas`
--

CREATE TABLE `mesas` (
  `codigo` varchar(10) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mesas`
--

INSERT INTO `mesas` (`codigo`, `estado`) VALUES
('1', 0),
('2', 0),
('3', 0),
('4', 0),
('5', 0),
('6', 0),
('7', 0),
('8', 1),
('9', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `mesa` varchar(10) DEFAULT NULL,
  `total` float NOT NULL,
  `pagado` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `mesa`, `total`, `pagado`, `fecha`, `hora`) VALUES
(2, NULL, 35.5, 1, '2024-11-22', '16:56:02'),
(3, NULL, 26.5, 1, '2024-11-22', '16:57:19'),
(4, NULL, 102.9, 1, '2024-11-22', '17:06:08'),
(5, NULL, 120.9, 1, '2024-11-22', '17:06:19'),
(6, NULL, 119, 1, '2024-11-22', '17:06:28'),
(7, '6', 94.5, 0, '2024-11-22', '17:06:36'),
(8, NULL, 35.5, 1, '2024-11-22', '17:06:42'),
(9, NULL, 71.7, 1, '2024-11-22', '17:07:17'),
(10, NULL, 50.6, 1, '2024-11-23', '11:21:33'),
(11, NULL, 53, 1, '2024-11-23', '11:23:00'),
(12, '5', 10, 0, '2024-11-23', '11:23:16'),
(13, '8', 640, 0, '2024-11-23', '11:39:51'),
(14, '9', 74.2, 0, '2024-11-25', '19:27:36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `categoria` varchar(50) NOT NULL,
  `precio` float NOT NULL,
  `stock` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `categoria`, `precio`, `stock`) VALUES
(1, 'Acqua Naturale', 'bebidas', 1.5, 99),
(2, 'Acqua frizzante', 'bebidas', 1.5, 100),
(3, 'Coca Cola', 'bebidas', 2, 100),
(4, 'Fanta Arancia', 'bebidas', 2, 0),
(5, 'Moretti bottiglia', 'bebidas', 2.5, 7),
(6, 'Piccola birra', 'bebidas', 1.5, 99),
(7, 'Bicchiere di Vino Rosso', 'bebidas', 3.5, 50),
(8, 'Bicchiere di Vino Bianco', 'bebidas', 3.5, 50),
(9, 'Speck', 'Entrante', 10.2, 48),
(10, 'Tagliere di formaggi', 'Entrante', 14.2, 50),
(11, 'Focaccia', 'Entrante', 7, 50),
(12, 'Provolone', 'Entrante', 8.5, 50),
(13, 'Affettati misti', 'Entrante', 20, 49),
(14, 'Pane all aglio', 'Entrante', 3.5, 49),
(15, 'Insalata César', 'Ensalada', 9.5, 49),
(16, 'Insalata Caprese', 'Ensalada', 8, 48),
(17, 'Insalata di burrata', 'Ensalada', 12, 49),
(18, 'Insalata di Rucola', 'Ensalada', 7, 50),
(19, 'Spaghetti Carbonara', 'Pasta', 9.5, 48),
(20, 'Lasagna', 'Pasta', 17, 48),
(21, 'Rigatoni', 'Pasta', 12, 50),
(22, 'Tagliatelle Puttanesca', 'Pasta', 14, 50),
(23, 'Ravioli agli Spinaci', 'Pasta', 9, 50),
(24, 'Fettuccine Alfredo', 'Pasta', 9.5, 50),
(25, 'Paccheri pistacchio', 'Pasta', 16.5, 50),
(26, 'Margherita', 'Pizza', 8, 48),
(27, 'Pepperoni', 'Pizza', 12, 50),
(28, 'Zucca speck', 'Pizza', 17.5, 50),
(29, 'P. Al tartufo', 'Pizza', 14.5, 50),
(30, 'Quattro Formaggi', 'Pizza', 14.5, 9),
(31, 'Carbonara', 'Pizza', 20, 49),
(32, 'Vegetariana', 'Pizza', 10.5, 50),
(33, 'Funghi Porcini', 'Pizza', 17.5, 49),
(34, 'Tiramisù', 'Postre', 5, 49),
(35, 'Panna Cotta', 'Postre', 4.5, 49),
(36, 'Gelato', 'Postre', 4, 50),
(37, 'Cannoli', 'Postre', 4.5, 50),
(38, 'Torta al Limone', 'Postre', 5, 50),
(40, 'Crostini salmón', 'Entrante', 5, 12);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `camareros`
--
ALTER TABLE `camareros`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `lineas_carrito`
--
ALTER TABLE `lineas_carrito`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `lineas_pedidos`
--
ALTER TABLE `lineas_pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pedido` (`pedido`,`producto`),
  ADD KEY `producto` (`producto`);

--
-- Indices de la tabla `mesas`
--
ALTER TABLE `mesas`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mesa` (`mesa`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `camareros`
--
ALTER TABLE `camareros`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `lineas_carrito`
--
ALTER TABLE `lineas_carrito`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `lineas_pedidos`
--
ALTER TABLE `lineas_pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `lineas_pedidos`
--
ALTER TABLE `lineas_pedidos`
  ADD CONSTRAINT `lineas_pedidos_ibfk_2` FOREIGN KEY (`producto`) REFERENCES `productos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lineas_pedidos_ibfk_3` FOREIGN KEY (`pedido`) REFERENCES `pedidos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`mesa`) REFERENCES `mesas` (`codigo`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
