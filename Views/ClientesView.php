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
                      <li><a href="index.html">Dashboard</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-desktop"></i> Transacciones <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="general_elements.html">Ventas</a></li>
                      <li><a href="media_gallery.html">Devoluciones</a></li>                      
                    </ul>
                  </li>
                  <li><a><i class="fa fa-edit"></i> Mantenimientos <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="../Controllers/ProductosController.php">Productos</a></li>
                      <li><a href="form_advanced.html">Clientes</a></li>
                      <li><a href="form_validation.html">Usuarios</a></li>                      
                    </ul>
                  </li>                                   
                              
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">            
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
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
                    
                    <li><a href="login.html"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
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
            <a href="ClienteNuevoController.php" class="btn btn-round btn-info"><i class="fa fa-plus"></i></a>
              <h3 class="text-center">Listado de Clientes</h3>
              <br>          
                <table class="table table-hover">
                  <tr>
                    <th>Cliente</th>
                    <th>Nit</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                    <th>Municipio</th>
                    <th>Departamento</th>
                    <th colspan="2" class="text-center">Opciones</th>
                  </tr>

                  <?php foreach($Clientes as $item): ?>
                   <tr>
                     <td><?php echo $item['nombreCliente']; ?></td>
                     <td><?php echo $item['nit']; ?></td>
                     <td><?php echo $item['telefono']; ?></td>
                     <td><?php echo $item['direccion']; ?></td>
                     <td><?php echo $item['nombreMunicipio']; ?></td>
                     <td><?php echo $item['nombreDepartamento']; ?></td>
                     <td class="text-right"><button type="button" class="btn btn-round btn-success" data-toggle='modal' data-target='#modal-editar' onclick="CargarDatos('<?php echo $item['idCliente'];?>','<?php echo $item['nombreCliente'];?>','<?php echo $item['nit']; ?>','<?php echo $item['telefono'];?>','<?php echo $item['direccion'];?>','<?php echo $item['idMunicipio'];?>');"><i class="fa fa-edit"></i> Editar</button>
                     </td>
                     <td class="text-left"><button  type="button" class="btn btn-round btn-danger" onclick="confirmarRegistro('<?php echo $item['idCliente'];?>');"><i class="fa fa-trash"></i> Borrar</button>
                     </td>

                   </tr> 
                  <?php endforeach; ?>
                </table>

                <div class="text-center">
                      <nav aria-label="Page navigation">
                            <ul class="pagination">        
                             <?php                
                                  for($i=1;$i<=$total_paginas;$i++)
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
                                  echo " (Total de registros ".$total_registros.")"; 
                                      
                          ?>
                      </strong>
                  </h5>                 
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
<!-- MODAL PARA EDITAR -->
<div class="modal fade" id="modal-editar">
    <div class="modal-dialog">
        <div class="modal-content">
                                        
            <!-- CONTENIDO DEL HEAD - MODAL -->
                                        
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h2 class="text-center "><strong>Editar Información del Cliente <span class="fa fa-pencil"></span></strong></h2>
            </div>
                                        
            <!-- Contenido de la ventana -->
            <div class="modal-body">
                                            
            <form method="POST">
            <div class="form-group">                                            
               <label for="clienteEditar">Nombre:</label>
                <input  type="hidden" id="idClienteEditar" name="idClienteEditar"/>
               <input type="text" id="clienteEditar" name="clienteEditar" class="form-control" required autofocus onkeypress="return validateInput(event)" onpaste="return false">
            </div> 

            <div class="form-group">                                            
               <label for="nitEditar">Nit:</label>
               <input type="text" id="nitEditar" name="nitEditar" class="form-control" required >
            </div>

            <div class="form-group">
            <label for="telefonoEditar">Teléfono:</label>
            <input type="number" id="telefonoEditar" name="telefonoEditar" class="form-control" required>
            </div>

            <div class="form-group">
            <label for="direccionEditar">Dirección:</label>
            <textarea type="number" id="direccionEditar" name="direccionEditar" class="form-control" required></textarea>
            </div>                    

            <div class="form-group">
                <label for="municipioEditar">Municipio:</label>
                <select name="municipioEditar" id="municipioEditar" class="form-control">
                  <option value="0">Selecciona</option>                            
                    <?php
                      foreach($Municipios as $item){
                        echo "<option value='$item[idMunicipio]'>".$item['nombreMunicipio']."</option>";
                      }
                    ?>
                </select>
            </div>

            <div class="modal-footer">
                    <input type="submit" class="btn btn-success" id="editar-cliente" name="editar-cliente"  value="Actualizar">
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
  </body>
</html>
