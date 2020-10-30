-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-10-2020 a las 00:18:47
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `kiosco`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(5) NOT NULL,
  `descripción` varchar(50) NOT NULL,
  `idRubro` int(2) DEFAULT NULL,
  `precio` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `descripción`, `idRubro`, `precio`) VALUES
(1, 'leche cotar', 2, 60),
(2, 'coca-cola 2L', 3, 110),
(3, 'detergente cif 500 Ml', 4, 85),
(4, 'caramelos Alka 10U', 1, 5),
(5, 'yogurt 1L Manfrey', 2, 90),
(6, 'queso 250 Grs', 2, 100),
(56, 'chipa', 5, 20),
(57, 'alfajor fantoche', 1, 40),
(58, 'agua 500ml', 3, 40),
(59, 'pure de tomate chico', 5, 30);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rubros`
--

CREATE TABLE `rubros` (
  `id` int(2) NOT NULL,
  `rubro` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rubros`
--

INSERT INTO `rubros` (`id`, `rubro`) VALUES
(1, 'golosinas'),
(2, 'lacteos'),
(3, 'bebidas'),
(4, 'articulos de limpieza'),
(5, 'comestibles');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stock`
--

CREATE TABLE `stock` (
  `id` int(4) NOT NULL,
  `idProducto` int(5) NOT NULL,
  `variación` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `stock`
--

INSERT INTO `stock` (`id`, `idProducto`, `variación`) VALUES
(1, 1, 9),
(2, 2, 12),
(3, 3, 5),
(4, 4, 15),
(5, 5, 3),
(6, 6, 8),
(8, 56, 30),
(9, 57, 3),
(10, 58, 5),
(11, 59, 16);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(2) NOT NULL,
  `clave` varchar(250) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) DEFAULT NULL,
  `usuario` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `clave`, `nombre`, `apellido`, `usuario`) VALUES
(9, '$2y$10$hblZ/YwzVZpTUQbs6MKff.v8wN1EuwXKopPgBFCe/NPdI7Px3fNj2', 'Fulano', 'Mengano', 'dueño'),
(12, '$2y$10$oYn/AhvcAAyYz8N/LlsXOOFaUUJWOc7mxge3KBLCJpTybeuIn/oCS', 'Florencia', 'Castello', 'admin2'),
(14, '$2y$10$YVt4o.k88S4as.2rhC8fNuMhFkPrYBQ5yYML9QBbJ9AsbzpmXen1i', 'Anderson', 'Genez', 'admin1'),
(17, '$2y$10$lc6hkx8XCWdSbWM0FNHiXuGPSOhLrkGSuoEgfjhNXgwumS4S33yyK', 'Funado', 'Godinez', 'Borrar');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idRubro` (`idRubro`);

--
-- Indices de la tabla `rubros`
--
ALTER TABLE `rubros`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idProducto` (`idProducto`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de la tabla `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`idRubro`) REFERENCES `rubros` (`id`);

--
-- Filtros para la tabla `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
