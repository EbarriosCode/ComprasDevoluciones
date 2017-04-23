select @@autocommit AS AUTO;
show engines;

-- procedimiento almacenado con transaccion para realizar una venta
DELIMITER $$
CREATE PROCEDURE sp_TransaccionVentas
(IN Fecha date,IN IdCliente int,IN IdProducto int,IN Cantidad int,IN deDevolucion BOOLEAN)
BEGIN
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
END $$
    
DROP PROCEDURE sp_TransaccionVentas;
CALL sp_TransaccionVentas(curdate(),1,1,2,true);

truncate table ventas;
truncate table ventasdetalle;

-- procedimiento que valida si existe una venta y devuelve la diferencia de dias de una devolucion y venta
DELIMITER $$
CREATE PROCEDURE sp_existeVenta_diferenciaFechas
(IN documento INT(11),IN fechaHoy DATE,OUT diferenciaDias INT(11))
BEGIN
	
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
END $$

DROP PROCEDURE sp_existeVenta_diferenciaFechas;
CALL sp_existeVenta_diferenciaFechas(4,curdate(),@diferencia);

-- procedimiento almacenado con transaccion para realizar una devolucion 
DELIMITER $$
CREATE PROCEDURE sp_TransaccionDevoluciones
(IN Fecha date,IN Documento int,IN IdProducto int,IN Cantidad int,IN IdCliente int)
BEGIN
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
        
        /* cambiar el estado de impresoPagado en la tabla ventasdetalle */
		UPDATE ventasdetalle VD SET VD.impresoPagado = 2 WHERE VD.idVenta = Documento;
    COMMIT; 
END $$
    
DROP PROCEDURE sp_TransaccionDevoluciones;
CALL sp_TransaccionDevoluciones(curdate(),1,1,1,1);

truncate table devoluciones;
truncate table devolucionesdetalle;

-- procedimiento con transaccion para generar nota de credito

DELIMITER $$
CREATE PROCEDURE sp_GenerarNotaCredito
(IN documentoDevolver INT)
BEGIN
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
		SELECT @idVentaGeneroNotaCredito := MAX(idVenta) FROM ventas;
        /* insertar en la tabla notas de credito */
		INSERT INTO notasdecredito (idVenta,fechaNotaCredito,idVentaGeneroEsta) 
        VALUES(documentoDevolver,curdate(),@idVentaGeneroNotaCredito);
	COMMIT; 
END $$		

call sp_GenerarNotaCredito(28);
drop procedure sp_GenerarNotaCredito;



-- cliente que mas compra
		    select @clienteMasCompras :=  C.nombreCliente 
			from ventas S 
			inner join clientes C on C.idCliente=S.idCliente
			group by S.idCliente,C.nombreCliente
            order by count(1) desc limit 0,1
            
            select * from ventas where idCliente = 10
            
            
            SELECT sum(idCliente),idCliente from ventas
            
update ventas set fecha='2017-04-22' where idVenta = 63
