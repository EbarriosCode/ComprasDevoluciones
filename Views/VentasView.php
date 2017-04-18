<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Análisis de Sistemas </title>
    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    
    <!-- bootstrap-progressbar -->
    <link href="../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="../vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
  
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="#" class="site_title"><i class="fa fa-money"></i> <span>Administración</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="../Views/images/eduardo.jpg" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Bienvenido,</span>
                <h2>Eduardo Barrios</h2>
              </div>
            </div>

            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="../">Dashboard</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-desktop"></i> Transacciones <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="VentasController.php">Ventas</a></li>
                      <li><a href="DevolucionesController.php">Devoluciones</a></li>                      
                    </ul>
                  </li>
                  <li><a><i class="fa fa-edit"></i> Mantenimientos <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">                      
                      <li><a href="ClientesController.php">Clientes</a></li>
                      <li><a href="ProductosController.php">Productos</a></li>
                      <li><a href="MarcasController.php">Marcas Productos</a></li>                      
                    </ul>
                  </li>                                   
                              
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->


            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">            
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="#">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="../Views/images/eduardo.jpg" alt="">Eduardo Barrios
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="javascript:;"> Perfil</a></li>
                    
                    <li><a href="#"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>

              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
  <div class="right_col" role="main">
      <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="text-left col-md-3"><a href="VentaNuevaController.php" class="btn btn-round btn-info"><i class="fa fa-plus"></i> Registrar Nueva Venta</a></div>
            
            <div class="text-right col-md-9"><button data-toggle='modal' data-target='#modal-fecha' class="btn btn-round btn-warning"><i class="fa fa-calendar"></i> Cambiar Fecha</button></div>
            <br> 
              <h3 class="text-center">Ventas del Día</h3>

              <br>          
                <table class="table table-hover">
                  <tr>
                    <th>Fecha</th>
                    <th>Documento</th>
                    <th>Cliente</th>
                    <th>Producto</th>
                    <th>Precio Unitario</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                    <th class="text-center">Factura</th>
                  </tr>

                  <?php foreach($Ventas as $item): ?>
                   <tr <?php if($item['impresoPagado'] == 1) 
                                  echo 'class=success'; 
                             if($item['impresoPagado'] == 2) 
                                  echo 'class=warning'; 
                        ?>>
                     <td><?php echo $item['fecha']; ?></td>
                     <td><?php echo $item['idVenta']; ?></td>
                     <td><?php echo $item['nombreCliente']; ?></td>
                     <td><?php echo $item['nombreProducto']; ?></td>
                     <td><?php echo $item['precio']; ?></td>
                     <td><?php echo $item['cantidad']; ?></td>
                     <td><?php echo $item['costoTotal']; ?></td>                     
                     <td class="text-center"><a target="_blank" href="FacturasController.php?noFactura=<?php echo $item["idVenta"]; ?>" <?php if($item['impresoPagado'] != 0) echo 'disabled'; ?>><button id="imprimir" type="button" class="btn btn-round btn-primary" onclick="setImpresoPagado('<?php echo $item["idVenta"]; ?>')"><i class="fa fa-print"></i> Imprimir</button></a>
                     </td>

                   </tr> 
                  <?php endforeach; ?>
                </table>

                <!--<div class="text-center">
                      <nav aria-label="Page navigation">
                            <ul class="pagination">        
                             <?php                
                                /*for($i=1;$i<=$total_paginas;$i++)
                                  {
                                      if($i == $inicio ){
                                           echo "<li class='active'><a>".$i." </a></li>";
                                      }    
                                      else{
                                           echo "<li><a href='?pagina=".$i."'>".$i." </a></li>";  
                                      }                        
                                  }           
                               ?>
                            </ul>
                      </nav> 
                  </div>    

                  <h5 class="text-left">
                      <strong>
                          <?php 
                              if($inicio == 0) $inicioPag = 1;
                              else $inicioPag = $inicio;
                                  echo "Página ".$inicioPag." de ".$total_paginas;
                                  echo " (Total de registros ".$total_registros.")";  */
                                      
                          ?>
                      </strong>
                  </h5>                 -->
          </div>
      </div>
  </div>  

        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            &copy; UMG ingeniería de Sistemas 2017 - Eduardo Barrios
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>
<!-- MODAL PARA CAMBIAR FECHA -->
<div class="modal fade" id="modal-fecha">
    <div class="modal-dialog">
        <div class="modal-content">
                                        
            <!-- CONTENIDO DEL HEAD - MODAL -->
                                        
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h2 class="text-center "><strong>Cambiar fecha de Ventas <span class="fa fa-calendar"></span></strong></h2>
            </div>
                                        
            <!-- Contenido de la ventana -->
            <div class="modal-body">
                                            
            <form method="POST">


            <div class="form-group">                                            
               <label for="fechaVentas">Desde:</label>
               <input type="date" id="desde" name="desde" class="form-control" value="<?php echo date('Y-m-d');?>" required >
            </div>
            
            <div class="form-group">                                            
               <label for="fechaVentas">Hasta:</label>
               <input type="date" id="hasta" name="hasta" class="form-control" value="<?php echo date('Y-m-d');?>" required >
            </div>

            <div class="modal-footer">
                    <input type="submit" class="btn btn-warning" id="fecha-ventas" name="fecha-ventas"  value="Cambiar Fecha">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            </div>
            </form>
            </div>
        </div>
    </div>
</div>


    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="../vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="../vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="../vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="../vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="../vendors/Flot/jquery.flot.js"></script>
    <script src="../vendors/Flot/jquery.flot.pie.js"></script>
    <script src="../vendors/Flot/jquery.flot.time.js"></script>
    <script src="../vendors/Flot/jquery.flot.stack.js"></script>
    <script src="../vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="../vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="../vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="../vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="../vendors/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="../vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="../vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="../vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="../vendors/moment/min/moment.min.js"></script>
    <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
    <script>
//funcion para cargar datos en el modal de editar
        function CargarDatos(id,nombre,nit,telefono,direccion,idMunicipio)
        {
            $("#idClienteEditar").val(id);
            $("#clienteEditar").val(nombre);
            $("#nitEditar").val(nit);
            $("#telefonoEditar").val(telefono);
            $("#direccionEditar").val(direccion);
           
            $("#municipioEditar option[value="+idMunicipio+"]").attr("selected",true);            
          
        }

        // funcion para confirmar el registro antes de eliminarlo
        function confirmarRegistro(id)
        {
           if (window.confirm("Esta seguro que desea eliminar este registro?") == true)
              {
                 window.location = "ClientesController.php?idCliente="+id+"&accion=borrar";
              }
        }

    </script>

    <script>
        function setImpresoPagado(documento)
        {
          $.ajax({
            type: 'GET',
            url: 'CambiarAimpresoAjax.php?NoDocumento='+documento,            
          }).done(function(resp){
            //alert(resp);
          });
        }
    </script>

    <script>
       $(document).ready(function(){
            $('#imprimir').click(function(){

            });
       });
    </script>
  </body>
</html>
