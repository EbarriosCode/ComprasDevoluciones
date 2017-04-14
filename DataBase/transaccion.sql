DROP PROCEDURE sp_TransaccionVentas;
CALL sp_TransaccionVentas(curdate(),'0001',1,1,2);


DELIMITER $$
CREATE PROCEDURE sp_TransaccionVentas
(in Fecha date,in Documento varchar(50),in IdCliente int,in IdProducto int,in Cantidad int)
BEGIN
	 /*DECLARE EXIT HANDLER FOR SQLEXCEPTION
	 BEGIN
	 SHOW ERRORS LIMIT 1;
	 ROLLBACK;
	 END; 
	 
     DECLARE EXIT HANDLER FOR SQLWARNING
	 BEGIN
	 SHOW WARNINGS LIMIT 1;
	 ROLLBACK;
	 END;
		
	*/
	START TRANSACTION;    
		/* insertar en la tabla ventas 
		INSERT INTO ventas(fecha,documento,idCliente) VALUES(Fecha,Documento,IdCliente);*/
		SET @idVenta = (SELECT MAX(idVenta) FROM ventas);/*LAST_INSERT_ID();*/
		select @idVenta as idVenta;
        
		SET @idProducto = IdProducto;
        select @idProducto as idProducto;
        
		SET @PrecioProducto = (SELECT precio FROM productos WHERE idProducto = @idProducto);
        select @PrecioProducto as precioProducto;
        
		SET @cantidad = Cantidad;
        select @cantidad as cantidad;
        
		SET @costoTotal = (@cantidad*@PrecioProducto);
		select @costoTotal as costoTotal;
        
        
        
        
		/* insertar el detalle en la tabla ventasdetalle 
		INSERT INTO ventasdetalle(idVenta,idProducto,cantidad,precio,costoTotal)VALUES(@idVenta,@idProducto,@cantidad,@PrecioProducto,@costoTotal);
		
		/* descontar la existencia de la tabla productos 
		UPDATE productos SET existencia = (existencia - @cantidad) WHERE idProducto = @idProducto;
	
    COMMIT; */
END $$
    

truncate table ventas;

select @@autocommit AS AUTO;
show engines;




DELIMITER $$
CREATE PROCEDURE sp_TransaccionVentasTEST
(Fecha date,Documento varchar(50),IdCliente int,IdProducto int,Cantidad int)
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
		INSERT INTO ventas(fecha,documento,idCliente) VALUES(Fecha,Documento,IdCliente);
		SELECT @idVenta := MAX(idVenta) FROM ventas;
		
        SELECT @idProducto := IdProducto;
		SELECT @precio := (SELECT precio FROM productos WHERE idProducto = @idProducto LIMIT 0,1);        
		SELECT @cantidad := Cantidad;        
		SELECT @costoTotal := (@cantidad*@precio);   
               
		 /*insertar el detalle en la tabla ventasdetalle */
		INSERT INTO ventasdetalle(idVenta,idProducto,cantidad,precio,costoTotal)VALUES(@idVenta,@idProducto,@cantidad,@precio,@costoTotal);
		
		/* descontar la existencia de la tabla productos */
		UPDATE productos SET existencia = existencia-@cantidad WHERE idProducto = @idProducto;
		
    COMMIT; 
END $$
    
DROP PROCEDURE sp_TransaccionVentasTEST;
CALL sp_TransaccionVentasTEST(curdate(),'0001',1,1,1);
