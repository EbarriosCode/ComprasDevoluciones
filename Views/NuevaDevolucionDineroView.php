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
    <style>
      #alerta{
        display: none;
        margin-top: 10px;
        text-align: center;
        margin-left: 25%;
      }
      #alerta-existencia-menor
      {
        display: none;
        margin-top: 10px;
        text-align: center;
        margin-left: 25%;
      }
      #alerta-factura-ya-devuelta{
        display: none;
        margin-top: 10px;
        text-align: center;
        margin-left: 25%;
      }
      #alerta-exceso-dias{
        display: none;
        margin-top: 10px;
        text-align: center;
        margin-left: 25%;
      }

      .campo:invalid{
        border: 1px solid red;  
      }

      .campo:valid{
        border: 1px solid green;    
      }


      .campo:invalid + span::after {
        content : url('images/fail.png');
        padding: 5px;
        border-radius: 5px;
        color: red;
        font-weight : bold;
      }

      .campo:valid + span::after {
        content : url('images/check.png');
        padding: 5px;
        border-radius: 5px;
        color: red;
        font-weight : bold;
      }
    </style>
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
              <h3 class="text-center">Devolucion Efectivo por Producto  <i class="fa fa-exchange"></i></h3>

              <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Completa el siguiente Formulario </h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>                      
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form id="demo-form2" method="post" data-parsley-validate class="form-horizontal form-label-left">
                      <div class="form-group">                        
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="documento-devolver">No. documento-devolver-Factura <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="documento-devolver" name="documento-devolver" required="required" class="form-control col-md-7 col-xs-12"  onblur="this.className ='form-control campo';" onchange="ajax(this.value)" placeholder="Ingrese el número de su factura" autofocus 
                          onkeypress="return validateInput(event)" onpaste="return false"><span></span>
                        </div>
                      </div>
                      <div class="form-group text-center" id="hintFactura">
                        
                      </div>
                      
                      
                        <br>
                        
                        <div id="alerta" class="alert alert-danger col-md-6" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                  <strong>Error :</strong> Los elementos del formulario se han desabilitado debido a que el número de documento-factura no existe. Porfavor revise y vuelva a intentarlo 
                        </div>
                        <div id="alerta-existencia-menor" class="alert alert-danger col-md-6" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                  <strong>Error :</strong> Esta queriendo enviar más productos de los que hay en existencia. El botón para realizar la venta se ha bloqueado hasta que corrija el error.
                        </div>
                        <div id="alerta-factura-ya-devuelta" class="alert alert-warning col-md-6" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                  <strong>Error :</strong> No puede realizar esta devolución debido a que ya existe una devolución con este número de documento.
                        </div>
                        <div id="alerta-exceso-dias" class="alert alert-warning col-md-6" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                  <strong>Error :</strong> No se puede realizar la devolución porque han pasado mas de 2 días.
                        </div>
                        
                      </div> 

                      <!--<div class="form-group">
                        <label for="costoTotal" class="control-label col-md-3 col-sm-3 col-xs-12">Total</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input disabled id="costoTotal" class="form-control col-md-7 col-xs-12" type="number" name="costoTotal">
                        </div>
                      </div> -->
                      
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">                          
                          <button class="btn btn-primary" type="reset">Limpiar</button>
                          <button type="submit" class="btn btn-success" id="devolver" name="devolver-producto-por-dinero">Realizar Devolucion</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
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
        $(document).ready(function(){

          $("#alerta").hide();      
          // alerta por si lo despachado es mayor que la existencia en formulario de nuevo desactivada
          $("#cantidadProductoNuevo").blur(function(){
            var cantidadInput = parseInt($("#cantidadProductoNuevo").val());
            var existencia = parseInt($("#existenciaDB").val());
            //alert("Cantidad en el input: "+cantidadInput +" existencia: "+existencia);
            if(cantidadInput > existencia)
            {
              $("#alerta-existencia-menor").show();
              $('#devolver').attr("disabled", true);
              return false;
            }
            if(!(cantidadInput > existencia))
            {
              $("#alerta-existencia-menor").hide();
              $('#devolver').attr("disabled", false);
              return false;
            } 
          });      
        });
    </script>
   
    <script>
        function ajax(str)
        {
          if(str == "")
          {
              /*$("#documento").css('border','2px solid red');
              $("#documento").css('color','#FF0040');
              $("#documento").val('Ha dejado vacío este campo');
              $("#documento").animate({letterSpacing:"8px"},3000);*/
          }
          else{
            var entero = parseInt(str);
            
              $.ajax
              ({
                    type: 'GET',
                    url: 'ValidaDocumento.php?Documento='+entero                  
              }).done(function(data){
                $('#hintFactura').html(data);
            });
          }  
        }
    </script>
    <script>
        function ajaxProductoVender(codigoProductoVender)
        {       
            $.ajax
            ({
                  type: 'GET',
                  url: 'RecuperarProductoController.php?codigoProductoVender='+codigoProductoVender
            }).done(function(data){
              $('#hintProductoVender').html(data);
          });
        }
    </script>
    <script type="text/javascript">
     // funcion para validar que solo ingresen numeros en el nit
        function validateInput(e)
        {
            key = e.keyCode || e.which;
            teclado = String.fromCharCode(key);
            caracteres = "0123456789";
            especiales = "8-37-38-46-164";
            teclado_especial = false;

                for(var i in especiales)
                {
                    if(key==especiales[i])
                    {
                        teclado_especial = true;
                        break;
                    }
                }

                if(caracteres.indexOf(teclado) == -1 && !teclado_especial)
                {
                    return false;
                }
        }
  </script>
	
  </body>
</html>
