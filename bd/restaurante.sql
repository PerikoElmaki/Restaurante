-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-11-2024 a las 17:11:56
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
DROP DATABASE IF EXISTS restaurantePedro;
CREATE DATABASE IF NOT EXISTS `restaurantePedro` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `restaurantePedro`;

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
(3, 'Rosa Melano', 'rosa', '33333333A', 'rosa.jpg', 0, 1),
(6, 'Pedro', 'redy', '48748246E', '48748246E.jpg', 0, 0),
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
(1, 1, 19, 1, ''),
(5, 3, 15, 1, ''),
(6, 3, 16, 1, ''),
(7, 4, 15, 1, ''),
(8, 4, 16, 1, ''),
(9, 5, 9, 1, ''),
(10, 5, 13, 1, ''),
(11, 6, 9, 1, ''),
(12, 6, 13, 1, ''),
(13, 6, 40, 1, ''),
(16, 7, 15, 1, ''),
(17, 7, 16, 1, ''),
(18, 1, 19, 1, ''),
(19, 1, 20, 1, '');

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
('8', 0),
('9', 0);

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
  `hora` time NOT NULL,
  `eliminado` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `mesa`, `total`, `pagado`, `fecha`, `hora`, `eliminado`) VALUES
(1, '1', 36, 0, '2024-11-26', '16:26:24', 1),
(2, '2', 30.2, 0, '2024-11-26', '16:26:41', 1),
(3, '1', 17.5, 0, '2024-11-26', '16:29:14', 0),
(4, '2', 17.5, 0, '2024-11-26', '16:29:48', 0),
(5, '3', 30.2, 0, '2024-11-26', '16:30:39', 1),
(6, '2', 35.2, 0, '2024-11-26', '16:39:38', 0),
(7, '1', 17.5, 0, '2024-11-26', '16:50:28', 0);

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
(1, 'Acqua Naturale', 'bebidas', 1.5, 100),
(2, 'Acqua frizzante', 'bebidas', 1.5, 0),
(3, 'Coca Cola', 'bebidas', 2, 100),
(4, 'Fanta Arancia', 'bebidas', 2, 100),
(5, 'Moretti bottiglia', 'bebidas', 2.5, 100),
(6, 'Piccola birra', 'bebidas', 1.5, 100),
(7, 'Vino Rosso', 'bebidas', 3.5, 50),
(8, ' Vino Bianco', 'bebidas', 3.5, 0),
(9, 'Speck', 'Entrante', 10.2, 100),
(10, 'Tagliere formaggi', 'Entrante', 14.2, 100),
(11, 'Focaccia', 'Entrante', 7, 100),
(12, 'Provolone', 'Entrante', 8.5, 100),
(13, 'Affettati misti', 'Entrante', 20, 100),
(14, 'Pane all aglio', 'Entrante', 3.5, 100),
(15, 'Insalata César', 'Ensalada', 9.5, 100),
(16, 'Insalata Caprese', 'Ensalada', 8, 100),
(17, 'Insalata di burrata', 'Ensalada', 12, 100),
(18, 'Insalata di Rucola', 'Ensalada', 7, 100),
(19, 'Spaghetti Carbonara', 'Pasta', 9.5, 100),
(20, 'Lasagna', 'Pasta', 17, 100),
(21, 'Rigatoni', 'Pasta', 12, 100),
(22, 'Tagliatelle Puttanesca', 'Pasta', 14, 100),
(23, 'Ravioli agli Spinaci', 'Pasta', 9, 100),
(24, 'Fettuccine Alfredo', 'Pasta', 9.5, 100),
(25, 'Paccheri pistacchio', 'Pasta', 16.5, 100),
(26, 'Margherita', 'Pizza', 8, 100),
(27, 'Pepperoni', 'Pizza', 12, 100),
(28, 'Zucca speck', 'Pizza', 17.5, 100),
(29, 'P. Al tartufo', 'Pizza', 14.5, 100),
(30, 'Quattro Formaggi', 'Pizza', 14.5, 100),
(31, 'Carbonara', 'Pizza', 20, 100),
(32, 'Vegetariana', 'Pizza', 10.5, 100),
(33, 'Funghi Porcini', 'Pizza', 17.5, 100),
(34, 'Tiramisù', 'Postre', 5, 100),
(35, 'Panna Cotta', 'Postre', 4.5, 100),
(36, 'Gelato', 'Postre', 4, 100),
(37, 'Cannoli', 'Postre', 4.5, 100),
(38, 'Torta al Limone', 'Postre', 5, 100),
(40, 'Crostini salmón', 'Entrante', 5, 100);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
