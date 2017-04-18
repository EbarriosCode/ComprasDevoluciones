-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-04-2017 a las 08:26:58
-- Versión del servidor: 10.1.16-MariaDB
-- Versión de PHP: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `compras-devoluciones`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `devolucionesdetalle`
--

CREATE TABLE `devolucionesdetalle` (
  `idDevolucionDetalle` int(11) NOT NULL,
  `idDevolucion` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` float NOT NULL,
  `costoTotal` float NOT NULL,
  `idCliente` int(11) NOT NULL,
  `impreso` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `devolucionesdetalle`
--

INSERT INTO `devolucionesdetalle` (`idDevolucionDetalle`, `idDevolucion`, `idProducto`, `cantidad`, `precio`, `costoTotal`, `idCliente`, `impreso`) VALUES
(1, 1, 1, 2, 250, 500, 1, 0),
(2, 2, 1, 2, 250, 500, 1, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `devolucionesdetalle`
--
ALTER TABLE `devolucionesdetalle`
  ADD PRIMARY KEY (`idDevolucionDetalle`),
  ADD KEY `idDevolucion` (`idDevolucion`),
  ADD KEY `idProducto` (`idProducto`),
  ADD KEY `idCliente` (`idCliente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `devolucionesdetalle`
--
ALTER TABLE `devolucionesdetalle`
  MODIFY `idDevolucionDetalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
