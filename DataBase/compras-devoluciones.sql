-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-04-2017 a las 09:32:42
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

DELIMITER $$
--
-- Procedimientos
--
CREATE PROCEDURE `debug` (IN `existencia` INT, IN `idPro` INT)  BEGIN

DECLARE EXIT HANDLER FOR SQLEXCEPTION
 BEGIN
 SHOW ERRORS LIMIT 1;
 ROLLBACK;
 END; 
 DECLARE EXIT HANDLER FOR SQLWARNING
 BEGIN
 SHOW WARNINGS LIMIT 1;
 ROLLBACK;
 END;

 
START TRANSACTION;
   insert into productos values('transaccion','transaccion',100,100,100,2);
   update productos set existencia=existencia where idProducto=idPro;
COMMIT;
END$$

CREATE PROCEDURE `sp_TransaccionVentas` (IN `Fecha` DATE, IN `IdCliente` INT, IN `IdProducto` INT, IN `Cantidad` INT)  BEGIN
	 DECLARE EXIT HANDLER FOR SQLEXCEPTION
	 BEGIN
	 SHOW ERRORS LIMIT 1;
	 ROLLBACK;
	 END; 
	 
     DECLARE EXIT HANDLER FOR SQLWARNING
	 BEGIN
	 SHOW WARNINGS LIMIT 1;
	 ROLLBACK;
	 END;
		
	START TRANSACTION;    
		/* insertar en la tabla ventas */
		INSERT INTO ventas(fecha,idCliente) VALUES(Fecha,IdCliente);
		SELECT @idVenta := MAX(idVenta) FROM ventas;
		
        SELECT @idProducto := IdProducto;
		SELECT @precio := (SELECT P.precio FROM productos P WHERE P.idProducto = @idProducto);        
		SELECT @cantidad := Cantidad;        
		SELECT @costoTotal := (@cantidad*@precio);   
                
		 /*insertar el detalle en la tabla ventasdetalle */
		INSERT INTO ventasdetalle(idVenta,idProducto,cantidad,precio,costoTotal,impresoPagado)VALUES(@idVenta,@idProducto,@cantidad,@precio,@costoTotal,0);
		
        SELECT @existencia := (SELECT P.existencia FROM productos P WHERE P.idProducto = @idProducto);        
        /*select if(@existencia < @cantidad,'No hay productos','Si seguir con la transaccion');*/
        
        
		/* descontar la existencia de la tabla productos */
		UPDATE productos P SET P.existencia = P.existencia-@cantidad WHERE P.idProducto = @idProducto;
		
    COMMIT; 
END$$

DELIMITER ;

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
(2, 'Mario Castillo', '09872', 'Zona 2', '58655820', 5),
(3, 'Jorge Mendizabal', '5555', 'zona 2 4-32', '43459287', 2),
(4, 'Elmer del Cid ', '567777', 'San luis colonia el rosario', '12343322', 17),
(5, 'Alexander Ramirez', '990033421', '2 avenida zona 1', '54332211', 7),
(7, 'Carlos Herrera Lopez', '6534', 'Finca San Jorge Zona 5', '25432210', 17),
(9, 'Diego Carlos Jimenez', '435422', '4ta calle 8-31', '32453321', 9);

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
(2, 'JanSports'),
(3, 'Puma'),
(4, 'MTV');

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
  `codigoProducto` varchar(100) NOT NULL,
  `nombreProducto` varchar(100) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `precio` float NOT NULL,
  `costo` float NOT NULL,
  `existencia` int(11) NOT NULL,
  `idMarca` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`idProducto`, `codigoProducto`, `nombreProducto`, `descripcion`, `precio`, `costo`, `existencia`, `idMarca`) VALUES
(1, 'M001', 'Mochila ', 'Mochila azul 4 bolsas', 250, 150, 92, 1),
(2, 'M002', 'Maleta', 'Maleta para laptop', 300, 200, 18, 2),
(3, 'C001', 'Cartuchera', 'Juego de cartucheras escolares', 150, 100, 78, 1),
(8, 'M003', 'Maletin ', 'Maletín para Cañonera', 500, 400, 28, 4),
(9, 'C002', 'Cartera pequeña', 'Cartera de mano para dama', 300, 150, 25, 3),
(10, 'N001', 'nuevo', 'nuevo descripcion del producto nuevo', 100, 100, 75, 1),
(11, 'N002', 'nuevo segundo', 'nuevo segundo', 400, 200, 100, 2),
(13, 'P001', 'producto de prueba', 'prueba', 10, 10, 46, 2),
(16, 'K-0123', 'mk', 'reloj', 500, 450, 48, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `idVenta` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `idCliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`idVenta`, `fecha`, `idCliente`) VALUES
(1, '2017-04-15', 1),
(2, '2017-04-15', 3),
(3, '2017-04-15', 4),
(4, '2017-04-16', 7),
(5, '2017-04-16', 3),
(6, '2017-04-16', 4);

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
  `costoTotal` float NOT NULL,
  `impresoPagado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ventasdetalle`
--

INSERT INTO `ventasdetalle` (`idVentasDetalle`, `idVenta`, `idProducto`, `cantidad`, `precio`, `costoTotal`, `impresoPagado`) VALUES
(1, 1, 1, 2, 250, 500, 0),
(2, 2, 3, 2, 150, 300, 0),
(3, 3, 2, 2, 300, 600, 0),
(4, 4, 16, 2, 500, 1000, 1),
(5, 5, 13, 2, 10, 20, 1),
(6, 6, 13, 2, 10, 20, 1);

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
  MODIFY `IdCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `departamento`
--
ALTER TABLE `departamento`
  MODIFY `idDepartamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT de la tabla `marcaproductos`
--
ALTER TABLE `marcaproductos`
  MODIFY `idMarca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
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
  MODIFY `idProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `idVenta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `ventasdetalle`
--
ALTER TABLE `ventasdetalle`
  MODIFY `idVentasDetalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
