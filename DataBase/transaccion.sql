create procedure handlerDemo()
begin
/*Handler para error SQL*/ 
DECLARE EXIT HANDLER FOR SQLEXCEPTION 
BEGIN 
SELECT 1 as error; 
ROLLBACK; 
END;

/*Handler para error SQL*/ 
DECLARE EXIT HANDLER FOR SQLWARNING 
BEGIN 
SELECT 1 as error; 
ROLLBACK; 
END;

end

declare error int;
start transaction;
    /* insertar en la tabla ventas */
	insert into ventas(fecha,documento,idCliente) values(curdate(),2,1);
    set @idVenta = (select max(idVenta) as IdUltimaVenta from ventas);
    
    set @idProducto = 1;
    set @PrecioProducto = (select precio from productos where idProducto = @idProducto);
    set @cantidad = 2;
    set @costoTotal = (@cantidad*@PrecioProducto);
    
    /* insertar el detalle en la tabla ventasdetalle */
    insert into ventasdetalle(idVenta,idProducto,cantidad,precio,costoTotal)values(@idVenta,@idProducto,@cantidad,@PrecioProducto,@costoTotal);
    
    /* descontar la existencia de la tabla productos */
    update productos set existencia = (existencia - @cantidad) where idProducto = @idProducto;
    
    set error = @error;
    select error;
    commit;
/*Mandamos 0 si todo salio bien*/ 
SELECT 0 as error; 
    
    



truncate table ventasdetalle;


select * from clientes;
select * from productos;
insert into clientes(nombreCliente,nit,direccion,telefono,idMunicipio)values('Mario Castillo','098765-2','Zona 2','58655820',5);
select * from ventas;
select * from ventasdetalle;

select @@autocommit;
show engines;


