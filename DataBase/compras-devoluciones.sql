-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-04-2017 a las 23:32:36
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
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `IdCliente` int(11) NOT NULL,
  `nombreCliente` varchar(100) NOT NULL,
  `nit` varchar(20) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `telefono` varchar(10) NOT NULL,
  `idMunicipio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`IdCliente`, `nombreCliente`, `nit`, `direccion`, `telefono`, `idMunicipio`) VALUES
(1, 'Eduardo Barrios', '12345', '5ta calle 9-42', '54441004', 1),
(2, 'Mario Castillo', '098765-2', 'Zona 2', '58655820', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE `departamento` (
  `idDepartamento` int(11) NOT NULL,
  `nombreDepartamento` varchar(100) NOT NULL,
  `idPais` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`idDepartamento`, `nombreDepartamento`, `idPais`) VALUES
(1, 'Petén', 1),
(2, 'Huehuetenango', 1),
(3, 'Quiche', 1),
(4, 'Alta Verapaz', 1),
(5, 'Izabal', 1),
(6, 'San Marcos', 1),
(7, 'Quetzaltenango', 1),
(8, 'Totonicapán', 1),
(9, 'Sololá', 1),
(10, 'Chimaltenango', 1),
(11, 'Sacatepéquez', 1),
(12, 'Guatemala', 1),
(13, 'Baja Verapaz', 1),
(14, 'El Progreso', 1),
(15, 'Jalapa', 1),
(16, 'Zacapa', 1),
(17, 'Chiquimula', 1),
(18, 'Retalhuleu', 1),
(19, 'Suchitepéquez', 1),
(20, 'Escuintla', 1),
(21, 'Santa Rosa', 1),
(22, 'Jutiapa', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcaproductos`
--

CREATE TABLE `marcaproductos` (
  `idMarca` int(11) NOT NULL,
  `nombreMarca` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `marcaproductos`
--

INSERT INTO `marcaproductos` (`idMarca`, `nombreMarca`) VALUES
(1, 'Chenson'),
(2, 'JanSports');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipio`
--

CREATE TABLE `municipio` (
  `idMunicipio` int(11) NOT NULL,
  `nombreMunicipio` varchar(100) NOT NULL,
  `idDepartamento` int(11) NOT NULL,
  `idPais` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `municipio`
--

INSERT INTO `municipio` (`idMunicipio`, `nombreMunicipio`, `idDepartamento`, `idPais`) VALUES
(1, 'Flores', 1, 1),
(2, 'Dolores', 1, 1),
(3, 'El chal', 1, 1),
(4, 'la Libertad', 1, 1),
(5, 'Las Cruces', 1, 1),
(6, 'Melchor de Mencos', 1, 1),
(7, 'Poptún', 1, 1),
(8, 'San Andres', 1, 1),
(9, 'San Benito', 1, 1),
(10, 'San Francisco', 1, 1),
(11, 'San José', 1, 1),
(12, 'San Luis', 1, 1),
(13, 'Santa Ana', 1, 1),
(14, 'Sayaxché', 1, 1),
(15, 'Huehuetenango', 2, 1),
(16, 'Aguacatán', 2, 1),
(17, 'Chiantla', 2, 1),
(18, 'Colotenango', 2, 1),
(19, 'Concepción Huista', 2, 1),
(20, 'Cuilco', 2, 1),
(21, 'Jacaltenango', 2, 1),
(22, 'La libertad', 2, 1),
(23, 'La democracia', 2, 1),
(24, 'Malacantancito', 2, 1),
(25, 'Nentón', 2, 1),
(26, 'San Antonio Huista', 2, 1),
(27, 'San Gaspar Ixchil', 2, 1),
(28, 'San Juan Ixcoy', 2, 1),
(29, 'San Pedro Necta', 2, 1),
(30, 'Santa Cruz del Quiché', 3, 1),
(31, 'Canillá', 3, 1),
(32, 'Chajul', 3, 1),
(33, 'Chicamán', 3, 1),
(34, 'Chiché', 3, 1),
(35, 'Chichicastenango', 3, 1),
(36, 'Chinique', 3, 1),
(37, 'cunén', 3, 1),
(38, 'Ixcán', 3, 1),
(39, 'Joyabaj', 3, 1),
(40, 'Cobán', 4, 1),
(41, 'Cahál', 4, 1),
(42, 'Chisec', 4, 1),
(43, 'Fray Bartolomé de las casas', 4, 1),
(44, 'Lanquín', 4, 1),
(45, 'Panzós', 4, 1),
(46, 'Raxruhá', 4, 1),
(47, 'San Cristobál Verapaz', 4, 1),
(48, 'San Juan Chamelco', 4, 1),
(49, 'San Pedro Carchá', 4, 1),
(50, 'Puerto Barrios', 5, 1),
(51, 'El Estór', 5, 1),
(52, 'Livinstong', 5, 1),
(53, 'Los amates', 5, 1),
(54, 'Morales', 5, 1),
(55, 'Quetzaltenango', 7, 1),
(56, 'Almolonga', 7, 1),
(57, 'Cabricán', 7, 1),
(58, 'Cajolá', 7, 1),
(59, 'Cantel', 7, 1),
(60, 'coatepeque', 7, 1),
(61, 'Colomba Costa Cuca', 7, 1),
(62, 'Concepción Chiquirichapa', 7, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pais`
--

CREATE TABLE `pais` (
  `idPais` int(11) NOT NULL,
  `nombrePais` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pais`
--

INSERT INTO `pais` (`idPais`, `nombrePais`) VALUES
(1, 'Guatemala'),
(2, 'México'),
(3, 'USA'),
(4, 'Argentina'),
(5, 'Brasil');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `idProducto` int(11) NOT NULL,
  `nombreProducto` varchar(100) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `precio` float NOT NULL,
  `costo` float NOT NULL,
  `existencia` int(11) UNSIGNED NOT NULL,
  `idMarca` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`idProducto`, `nombreProducto`, `descripcion`, `precio`, `costo`, `existencia`, `idMarca`) VALUES
(1, 'Mochila ', 'Mochila azul 4 bolsas', 250, 150, 10, 1),
(2, 'Maleta', 'Maleta para laptop', 300, 200, 20, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `idVenta` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `documento` varchar(50) NOT NULL,
  `idCliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventasdetalle`
--

CREATE TABLE `ventasdetalle` (
  `idVentasDetalle` int(11) NOT NULL,
  `idVenta` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` float NOT NULL,
  `costoTotal` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`IdCliente`),
  ADD KEY `idMunicipio` (`idMunicipio`);

--
-- Indices de la tabla `departamento`
--
ALTER TABLE `departamento`
  ADD PRIMARY KEY (`idDepartamento`),
  ADD KEY `idPais` (`idPais`);

--
-- Indices de la tabla `marcaproductos`
--
ALTER TABLE `marcaproductos`
  ADD PRIMARY KEY (`idMarca`);

--
-- Indices de la tabla `municipio`
--
ALTER TABLE `municipio`
  ADD PRIMARY KEY (`idMunicipio`),
  ADD KEY `idDepartamento` (`idDepartamento`),
  ADD KEY `idPais` (`idPais`);

--
-- Indices de la tabla `pais`
--
ALTER TABLE `pais`
  ADD PRIMARY KEY (`idPais`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`idProducto`),
  ADD KEY `idMarca` (`idMarca`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`idVenta`);

--
-- Indices de la tabla `ventasdetalle`
--
ALTER TABLE `ventasdetalle`
  ADD PRIMARY KEY (`idVentasDetalle`),
  ADD KEY `idVenta` (`idVenta`),
  ADD KEY `idProducto` (`idProducto`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `IdCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `departamento`
--
ALTER TABLE `departamento`
  MODIFY `idDepartamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT de la tabla `marcaproductos`
--
ALTER TABLE `marcaproductos`
  MODIFY `idMarca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `municipio`
--
ALTER TABLE `municipio`
  MODIFY `idMunicipio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
--
-- AUTO_INCREMENT de la tabla `pais`
--
ALTER TABLE `pais`
  MODIFY `idPais` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `idProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `idVenta` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `ventasdetalle`
--
ALTER TABLE `ventasdetalle`
  MODIFY `idVentasDetalle` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
