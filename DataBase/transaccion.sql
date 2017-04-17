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
    

truncate table ventasdetalle;

select @@autocommit AS AUTO;
show engines;




DELIMITER $$
CREATE PROCEDURE sp_TransaccionVentas
(IN Fecha date,IN IdCliente int,IN IdProducto int,IN Cantidad int)
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
		INSERT INTO ventasdetalle(idVenta,idProducto,cantidad,precio,costoTotal,impresoPagado)VALUES(@idVenta,@idProducto,@cantidad,@precio,@costoTotal,0);
		
        SELECT @existencia := (SELECT P.existencia FROM productos P WHERE P.idProducto = @idProducto);        
        /*select if(@existencia < @cantidad,'No hay productos','Si seguir con la transaccion');*/
        
        
		/* descontar la existencia de la tabla productos */
		UPDATE productos P SET P.existencia = P.existencia-@cantidad WHERE P.idProducto = @idProducto;
		
    COMMIT; 
END $$
    
DROP PROCEDURE sp_TransaccionVentas;
CALL sp_TransaccionVentas(curdate(),1,1,2);


truncate table ventas;
truncate table ventasdetalle;

SELECT DATEDIFF('2017-01-15', '2016-01-15');
