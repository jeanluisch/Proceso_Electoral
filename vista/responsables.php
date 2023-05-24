<?php
 session_start();
//verifica si la session está activa..
 //** si no hay usuario activo, redicciona al index. 
 if ( isset($_SESSION['usuarioActivo']) != TRUE ) {

  header('Location: ../index.php');
 }

?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	  
    <title>Responsables</title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Iconos -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        
    <!-- Datatables -->
    <link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">

  </head>

  <body class="nav-md">

     <?php
         if ( $_SESSION['tipo_usuario']== 'USUARIO' ) {
         include("rol_usuario/usuario.php");
         
        }else {
         include("rol_usuario/admin.php");
        }
    ?>



        <!-- Contenido de Formulario -->
        <div class="right_col" role="main">
          <div class="">
            
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Electores Responsables de 1x12</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  	<div id="info" >
	                    
                  	</div>
                    <!--
                    <p class="text-muted font-13 m-b-30">
                      <button type="button" id="nuevo_electores" class="btn btn-primary" data-toggle="modal" data-target=".registro_electores_modal">Nuevo</button>
                    </p>
                    -->
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Cédula</th>
                          <th>Nombres</th>
                          <th>Centro V</th>
                          <th>Municipio</th>
                          <th>Parroquia</th>
                          <th>Acción</th>
                        </tr>
                      </thead>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <!-- /page content -->

        <!-- Modal registro -->
          <?php //include 'modals/electores/registro_electores_modal.php';
                //modal Editar Electores
                //include 'modals/electores/editar_electores_modal.php';
          ?>
           
        <!-- Modal Electores -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            <H2>Gloria, Honra y Honor al Espíritu Santo</H2>
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
    
    <!-- Datatables -->
    <script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="../vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="../vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
    <!-- JS script modal -->
    <script src="../js/responsable/responsable_registro.js"></script>
    <!-- JS script
    <script src="../js/function_global.js"></script>
    <script src="../js/electores/electores_buscar_select.js"></script>

    <script src="../js/electores/electores_editar.js"></script>
    <script src="../js/electores/electores_editar_Bd.js"></script>
    <script src="../js/electores/electores_eliminar.js"></script>
    -->

    <link rel="stylesheet" href="../js/alertifyjs/css/alertify.css">
    <link rel="stylesheet" href="../js/alertifyjs/css/themes/default.rtl.css">
    <script src="../js/alertifyjs/alertify.js"></script>
    <script src="../js/alertifyjs/alertify.min.js">  </script>

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>

    <script type="text/javascript">   

	listarDataTable();  
      function listarDataTable(){
      	$(document).ready(function() {
    	var datatable = $('#datatable').DataTable({
        'method':'POST',
        destroy:true,
        ajax: "../controlador/responsables.php",
        columns: [
       
            {data:"cedula"},
            {data:"elector"},
            {data:"centrov"},
            {data:"municipio"},
            {data:"parroquia"},
            {data:"boton"},
        ],
        language: idioma_espanol

		     });
	    	});
      }
      var idioma_espanol=
      	{
		    "sProcessing":     "Procesando...",
		    "sLengthMenu":     "Mostrar _MENU_ registros",
		    "sZeroRecords":    "No se encontraron resultados",
		    "sEmptyTable":     "Ningún dato disponible en esta tabla",
		    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
		    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
		    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
		    "sInfoPostFix":    "",
		    "sSearch":         "Buscar:",
		    "sUrl":            "",
		    "sInfoThousands":  ",",
		    "sLoadingRecords": "Cargando...",
		    "oPaginate": {
		        "sFirst":    "Primero",
		        "sLast":     "Último",
		        "sNext":     "Siguiente",
		        "sPrevious": "Anterior"
		    },
		    "oAria": {
		        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
		        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
		    }
		}

	
</script>

  </body>
</html>
