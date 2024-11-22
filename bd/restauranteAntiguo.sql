-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-11-2024 a las 20:01:11
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
(17, 4, 2, 1, ''),
(18, 4, 4, 1, ''),
(19, 4, 7, 2, ''),
(20, 5, 2, 1, 'hielo'),
(21, 5, 4, 1, 'vaso frio'),
(22, 5, 5, 1, ''),
(23, 5, 7, 1, '');

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
('2', 1),
('3', 0),
('4', 0),
('5', 0),
('6', 0);

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
(4, NULL, 8.5, 1),
(5, '2', 9, 0);

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
(2, 'agua grande', 'bebidas', 2, 10),
(3, 'coca normal', 'bebidas', 2.5, 10),
(4, 'alhambra verde', 'bebidas', 2.5, 10),
(5, 'heiniqueen', 'bebidas', 2.5, 10),
(6, 'patatas rancheras', 'entrantes', 6, 8),
(7, 'coqretas', 'entrantes', 2, 10);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `camareros`
--
ALTER TABLE `camareros`
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
-- AUTO_INCREMENT de la tabla `lineas_pedidos`
--
ALTER TABLE `lineas_pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
