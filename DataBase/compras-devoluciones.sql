-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-04-2017 a las 00:31:04
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

CREATE PROCEDURE `sp_existeVenta_diferenciaFechas` (IN `documento` INT(11), IN `fechaHoy` DATE, OUT `diferenciaDias` INT(11))  BEGIN
	
    SET @fechaVenta := (SELECT VF.fecha FROM ventas VF WHERE VF.idVenta=documento);
	SET diferenciaDias := DATEDIFF(fechaHoy,@fechaVenta); 
    /*SELECT V.idVenta,V.fecha,diferencia FROM ventas V WHERE V.idVenta=documento;*/
	SELECT V.idVenta,V.fecha,V.idCliente,C.nombreCliente,VD.idProducto,
	   P.codigoProducto,P.nombreProducto,M.nombreMarca,P.descripcion,VD.precio,VD.cantidad,
       VD.costoTotal,VD.impresoPagado,diferenciaDias
	FROM ventas V 
	INNER JOIN clientes C ON V.idCliente = C.idCliente
	INNER JOIN ventasdetalle VD ON V.idVenta = VD.idVenta
	INNER JOIN productos P ON VD.idProducto = P.idProducto
	INNER JOIN marcaproductos M ON P.idMarca = M.idMarca
    /*INNER JOIN devoluciones D ON VD.idVenta = D.idVenta*/
	WHERE V.idVenta=documento;
END$$

CREATE PROCEDURE `sp_TransaccionDevoluciones` (IN `Fecha` DATE, IN `Documento` INT, IN `IdProducto` INT, IN `Cantidad` INT, IN `IdCliente` INT)  BEGIN
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
		/* insertar en la tabla devoluciones */
		INSERT INTO devoluciones(fechaDevolucion,idVenta) VALUES(Fecha,Documento);
		SELECT @idDevolucion := MAX(idDevolucion) FROM devoluciones;
		
        SELECT @idProducto := IdProducto;
		SELECT @precio := (SELECT P.precio FROM productos P WHERE P.idProducto = @idProducto);        
		SELECT @cantidad := Cantidad;        
		SELECT @costoTotal := (@cantidad*@precio);   
                
		 /*insertar el detalle en la tabla devolucionesdetalle */
		INSERT INTO devolucionesdetalle(idDevolucion,idProducto,cantidad,precio,costoTotal,idCliente,impreso)
                                  VALUES(@idDevolucion,@idProducto,@cantidad,@precio,@costoTotal,IdCliente,0);
		
        SELECT @existencia := (SELECT P.existencia FROM productos P WHERE P.idProducto = @idProducto);        
        /*select if(@existencia < @cantidad,'No hay productos','Si seguir con la transaccion');*/
        
        
		/* incrementar la existencia de la tabla productos */
		UPDATE productos P SET P.existencia = P.existencia+@cantidad WHERE P.idProducto = @idProducto;
        
        /* cambiar el estado de impresoPagado en la tabla ventasdetale */
		UPDATE ventasdetalle VD SET VD.impresoPagado = 2 WHERE VD.idVenta = Documento;
    COMMIT; 
END$$

CREATE PROCEDURE `sp_TransaccionVentas` (IN `Fecha` DATE, IN `IdCliente` INT, IN `IdProducto` INT, IN `Cantidad` INT, IN `deDevolucion` BOOLEAN)  BEGIN
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
		INSERT INTO ventasdetalle(idVenta,idProducto,cantidad,precio,costoTotal,impresoPagado,vieneDeDevolucion)VALUES(@idVenta,@idProducto,@cantidad,@precio,@costoTotal,0,deDevolucion);
		
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
(5, 'Alexander Ramirez', '9900', '2 avenida zona 1', '54332211', 7),
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
-- Estructura de tabla para la tabla `devoluciones`
--

CREATE TABLE `devoluciones` (
  `idDevolucion` int(11) NOT NULL,
  `fechaDevolucion` date NOT NULL,
  `idVenta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `devoluciones`
--

INSERT INTO `devoluciones` (`idDevolucion`, `fechaDevolucion`, `idVenta`) VALUES
(1, '2017-04-17', 1),
(2, '2017-04-18', 9),
(3, '2017-04-18', 8),
(4, '2017-04-18', 10),
(5, '2017-04-18', 13),
(6, '2017-04-18', 14),
(7, '2017-04-18', 17),
(8, '2017-04-18', 18);

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
(2, 2, 3, 2, 150, 300, 5, 0),
(3, 3, 2, 1, 300, 300, 7, 0),
(4, 4, 3, 8, 150, 1200, 1, 0),
(5, 5, 1, 2, 250, 500, 1, 0),
(6, 6, 13, 5, 10, 50, 1, 0),
(7, 7, 9, 1, 300, 300, 3, 0),
(8, 8, 13, 5, 10, 50, 3, 0);

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
(1, 'M001', 'Mochila ', 'Mochila azul 4 bolsas', 250, 150, 98, 1),
(2, 'M002', 'Maleta', 'Maleta para laptop', 300, 200, 18, 2),
(3, 'C001', 'Cartuchera', 'Juego de cartucheras escolares', 150, 100, 80, 1),
(8, 'M003', 'Maletin ', 'Maletín para Cañonera', 500, 400, 28, 4),
(9, 'C002', 'Cartera pequeña', 'Cartera de mano para dama', 300, 150, 25, 3),
(10, 'N001', 'nuevo', 'nuevo descripcion del producto nuevo', 100, 100, 75, 1),
(11, 'N002', 'nuevo segundo', 'nuevo segundo', 400, 200, 100, 2),
(13, 'P001', 'producto de prueba', 'prueba', 10, 10, 32, 2);

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
(4, '2017-04-15', 9),
(5, '2017-04-16', 3),
(6, '2017-04-16', 4),
(7, '2017-04-18', 4),
(8, '2017-04-18', 7),
(9, '2017-04-18', 5),
(10, '2017-04-18', 1),
(11, '2017-04-18', 5),
(12, '2017-04-18', 7),
(13, '2017-04-18', 1),
(14, '2017-04-18', 1),
(15, '2017-04-18', 1),
(16, '2017-04-18', 1),
(17, '2017-04-18', 3),
(18, '2017-04-18', 3),
(19, '2017-04-18', 3);

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
  `impresoPagado` int(1) NOT NULL,
  `vieneDeDevolucion` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ventasdetalle`
--

INSERT INTO `ventasdetalle` (`idVentasDetalle`, `idVenta`, `idProducto`, `cantidad`, `precio`, `costoTotal`, `impresoPagado`, `vieneDeDevolucion`) VALUES
(1, 1, 1, 2, 250, 500, 2, 0),
(2, 2, 3, 2, 150, 300, 1, 0),
(3, 3, 2, 2, 300, 600, 0, 0),
(4, 4, 13, 2, 500, 1000, 0, 0),
(5, 5, 13, 2, 10, 20, 1, 0),
(6, 6, 13, 2, 10, 20, 1, 0),
(7, 7, 1, 2, 250, 500, 0, 0),
(8, 8, 2, 1, 300, 300, 2, 0),
(9, 9, 3, 2, 150, 300, 1, 0),
(10, 10, 3, 8, 150, 1200, 2, 0),
(11, 11, 1, 200, 250, 50000, 1, 0),
(12, 12, 13, 6, 10, 60, 1, 0),
(13, 13, 1, 2, 250, 500, 2, 0),
(14, 14, 13, 5, 10, 50, 2, 0),
(15, 15, 13, 5, 10, 50, 1, 0),
(16, 16, 1, 2, 250, 500, 1, 1),
(17, 17, 9, 1, 300, 300, 1, 0),
(18, 18, 13, 5, 10, 50, 2, 1),
(19, 19, 13, 3, 10, 30, 1, 1);

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
-- Indices de la tabla `devoluciones`
--
ALTER TABLE `devoluciones`
  ADD PRIMARY KEY (`idDevolucion`),
  ADD KEY `idCliente` (`idVenta`);

--
-- Indices de la tabla `devolucionesdetalle`
--
ALTER TABLE `devolucionesdetalle`
  ADD PRIMARY KEY (`idDevolucionDetalle`),
  ADD KEY `idDevolucion` (`idDevolucion`),
  ADD KEY `idProducto` (`idProducto`),
  ADD KEY `idCliente` (`idCliente`);

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
-- AUTO_INCREMENT de la tabla `devoluciones`
--
ALTER TABLE `devoluciones`
  MODIFY `idDevolucion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `devolucionesdetalle`
--
ALTER TABLE `devolucionesdetalle`
  MODIFY `idDevolucionDetalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
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
  MODIFY `idProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `idVenta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT de la tabla `ventasdetalle`
--
ALTER TABLE `ventasdetalle`
  MODIFY `idVentasDetalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
