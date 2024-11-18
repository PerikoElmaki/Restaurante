-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-11-2024 a las 00:31:18
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
  `encargado` int(10) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `camareros`
--

INSERT INTO `camareros` (`id`, `nombre`, `contraseña`, `dni`, `foto`, `encargado`) VALUES
(1, 'admin', 'admin', '11111111E', '11111111E.jpg', 1),
(2, 'maricon', 'gay', '2222222G', '2222222G.jpg', 0),
(3, 'Rosa Melano', 'rosa', '33333333A', 'rosa.jpg', 0),
(6, 'Pedro', 'redy', '48748246E', '48748246E.jpg', 0);

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
(1, 1, 1, 1, ''),
(2, 1, 16, 1, ''),
(3, 1, 22, 1, 'as'),
(4, 1, 27, 2, ''),
(5, 2, 14, 1, ''),
(6, 2, 15, 1, ''),
(7, 2, 30, 1, ''),
(8, 2, 14, 1, ''),
(9, 2, 15, 1, ''),
(10, 2, 30, 1, ''),
(11, 2, 14, 1, ''),
(12, 2, 15, 1, ''),
(13, 2, 30, 1, ''),
(14, 2, 14, 1, ''),
(15, 2, 15, 1, ''),
(16, 2, 30, 1, ''),
(17, 2, 14, 1, ''),
(18, 2, 15, 1, ''),
(19, 2, 30, 1, ''),
(20, 3, 24, 1, ''),
(21, 3, 25, 1, ''),
(22, 4, 6, 1, ''),
(23, 4, 13, 1, 'extra queso'),
(24, 4, 22, 1, ''),
(25, 5, 9, 1, ''),
(26, 5, 13, 1, ''),
(27, 6, 2, 1, ''),
(28, 6, 9, 1, ''),
(29, 7, 30, 1, ''),
(30, 7, 30, 1, ''),
(31, 7, 31, 1, ''),
(32, 13, 1, 1, ''),
(33, 14, 9, 1, ''),
(34, 14, 15, 1, ''),
(35, 14, 17, 1, ''),
(36, 15, 5, 1, ''),
(37, 15, 13, 1, ''),
(38, 16, 2, 1, ''),
(39, 16, 9, 1, ''),
(40, 17, 4, 1, ''),
(41, 17, 11, 1, ''),
(42, 18, 9, 1, ''),
(43, 19, 9, 1, ''),
(44, 20, 2, 1, ''),
(45, 20, 9, 1, ''),
(46, 21, 11, 1, ''),
(47, 22, 2, 1, ''),
(48, 22, 4, 1, ''),
(49, 22, 9, 1, ''),
(50, 23, 2, 1, ''),
(51, 23, 9, 1, ''),
(52, 24, 9, 1, ''),
(53, 24, 10, 1, ''),
(54, 25, 4, 1, ''),
(55, 25, 6, 1, ''),
(56, 25, 9, 1, ''),
(57, 26, 2, 1, ''),
(58, 26, 9, 1, ''),
(59, 27, 25, 1, ''),
(60, 27, 30, 1, ''),
(61, 27, 31, 1, ''),
(62, 28, 6, 1, ''),
(63, 28, 11, 1, ''),
(64, 41, 2, 1, ''),
(65, 41, 11, 1, ''),
(66, 41, 30, 1, ''),
(67, 41, 11, 1, ''),
(68, 41, 12, 1, ''),
(69, 42, 2, 1, ''),
(70, 43, 2, 1, '');

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
('1', 1),
('2', 1),
('3', 1),
('4', 1),
('5', 0),
('6', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `mesa` varchar(10) DEFAULT NULL,
  `total` float NOT NULL,
  `pagado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `mesa`, `total`, `pagado`) VALUES
(1, '4', 58, 0),
(2, NULL, 102.5, 1),
(3, NULL, 20, 1),
(4, NULL, 14.5, 1),
(5, NULL, 13.7, 1),
(6, NULL, 12.2, 1),
(7, NULL, 14.5, 1),
(13, NULL, 1.5, 1),
(14, NULL, 27.7, 1),
(15, NULL, 6, 1),
(16, NULL, 12.2, 1),
(17, NULL, 10.5, 1),
(18, NULL, 10.2, 1),
(19, NULL, 10.2, 1),
(20, NULL, 12.2, 1),
(21, NULL, 8.5, 1),
(22, NULL, 14.2, 1),
(23, NULL, 12.2, 1),
(24, NULL, 17.2, 1),
(25, NULL, 13.7, 1),
(26, NULL, 12.2, 1),
(27, NULL, 21.5, 1),
(28, NULL, 10, 1),
(41, '6', 44, 0),
(42, NULL, 2, 1),
(43, NULL, 2, 1);

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
(1, 'Agua Grande', 'bebidas', 1.5, 100),
(2, 'Coca Cola', 'bebidas', 2, 100),
(3, 'Fanta Naranja', 'bebidas', 2, 100),
(4, 'Fanta Limón', 'bebidas', 2, 100),
(5, 'Alhambra 1925', 'bebidas', 2.5, 100),
(6, 'Quinto E.levante', 'bebidas', 1.5, 100),
(7, 'Copa Tinto', 'bebidas', 3.5, 50),
(8, 'Copa Blanco', 'bebidas', 3.5, 50),
(9, 'Speck', 'Entrante', 10.2, 50),
(10, 'Focaccia', 'Entrante', 7, 50),
(11, 'Provolone', 'Entrante', 8.5, 50),
(12, 'Embutidos variados', 'Entrante', 20, 50),
(13, 'Pan de Ajo', 'Entrante', 3.5, 50),
(14, 'Ensalada César', 'Ensalada', 7.5, 50),
(15, 'Ensalada Caprese', 'Ensalada', 8, 50),
(16, 'Ensalada de Rúcula', 'Ensalada', 7, 50),
(17, 'Espaguetis a la Carbonara', 'Pasta', 9.5, 50),
(18, 'Lasaña', 'Pasta', 17, 50),
(19, 'Riggatoni', 'Pasta', 12, 50),
(20, 'Tagliatelle putanesca', 'Pasta', 14, 50),
(21, 'Raviolis de Espinaca', 'Pasta', 9, 50),
(22, 'Fettuccine Alfredo', 'Pasta', 9.5, 50),
(23, 'Penne Arrabbiata', 'Pasta', 8.5, 50),
(24, 'Margherita', 'Pizza', 8, 50),
(25, 'Pepperoni', 'Pizza', 12, 50),
(26, 'Cuatro Quesos', 'Pizza', 14.5, 50),
(27, 'Carbonara', 'Pizza', 20, 50),
(28, 'Vegetariana', 'Pizza', 10.5, 50),
(29, 'Funchi Porcini', 'Pizza', 17.5, 50),
(30, 'Tiramisú', 'Postre', 5, 50),
(31, 'Panna Cotta', 'Postre', 4.5, 50),
(32, 'Gelato', 'Postre', 4, 50),
(33, 'Cannoli', 'Postre', 4.5, 50),
(34, 'Pastel de Limón', 'Postre', 5, 50);

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
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `lineas_carrito`
--
ALTER TABLE `lineas_carrito`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `lineas_pedidos`
--
ALTER TABLE `lineas_pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

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
