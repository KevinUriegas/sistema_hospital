<?php 
include('../sesiones/verificar_sesion.php');

$fecha_mas = strtotime ( '+1 day' , strtotime ( $fecha ) ) ;
$fecha_mas = date ( 'Y-m-d' , $fecha_mas );

// Variables de configuración
$titulo="Citas para Hoy";
$opcionMenu="A";

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Sistema Hospital</title>

	<!-- Meta para compatibilidad en dispositivos mobiles -->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap 3.3.5 -->
	<link rel="stylesheet" type="text/css" href="../plugins/bootstrap/css/bootstrap.min.css">

    <!-- fontawesome -->
	<link rel="stylesheet" href="../plugins/fontawesome-free-5.8.1-web/css/all.min.css">


    <!-- DataTables -->
    <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">

    <!-- bootstrap-toggle-master -->
    <link href="../plugins/bootstrap-toggle-master/css/bootstrap-toggle.css" rel="stylesheet">
    <link href="../plugins/bootstrap-toggle-master/stylesheet.css" rel="stylesheet">
	
	<!-- select2 -->
    <link rel="stylesheet" href="../plugins/select2/select2.css">

	<!-- Estilos propios -->
	<link rel="stylesheet" type="text/css" href="../css/estilos.css">

	<!-- Alertify	 -->
	<link rel="stylesheet" type="text/css" href="../plugins/alertifyjs/css/alertify.css">
	<link rel="stylesheet" type="text/css" href="../plugins/alertifyjs/css/themes/bootstrap.css">
</head>

<body>
	<header>
		<?php 
			include('../layout/encabezado.php');
		 ?>
	</header><!-- /header -->	
	<div class="container-fluid" >
	<div class="row" id="cuerpo" style="display:none">
			<div class="col-xs-0 col-sm-3 col-md-2 col-lg-2 vertical">
			<?php 
				include('menuv.php');
			 ?>
			</div>
			<div class="col-xs-12 col-sm-9 col-md-10 col-lg-10 cont">
			   <div class="titulo borde sombra">
			        <h3><?php echo $titulo; ?></h3>
			   </div>	
			   <div class="contenido borde sombra">
				    <div class="container-fluid">
				        <section id="lista">
            
				        </section>
				    </div>
			   </div>	

			</div>			
		</div>
	</div>
	<footer class="fondo">
		<?php 
			include('../layout/pie.php');
		 ?>			

	</footer>
		<!-- Modal -->
	<div id="modalReAgenda" class="modal fade" role="dialog">
		<div class="modal-dialog modal-lg">
	    	<!-- Modal content-->
			<form id="frmReAgenda">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Re Agendar Paciente</h4>
					</div>
					<div class="modal-body">
						<input type="hidden" id="id_paciente_modal">
						<div class="row">
						<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
								<div class="form-group">
									<label for="idPersona">*Paciente:</label>
									<input type="text" id="paciente_modal" class="form-control" readonly>
								</div>
							</div>
							<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
								<div class="form-group">
									<label for="idPersona">*Nueva Fecha:</label>
									<input type="date" id="fecha_cita" class="form-control" required onchange='llenar_lista2(this.value)' min="<?php echo $fecha_mas?>">
								</div>
							</div>
							<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
								<div class="form-group">
									<label for="idPersona">*Nueva Hora:</label>
									<input type="time" id="hora_cita" class="form-control" required>
								</div>
							</div>
							<hr class="linea">
						</div>
						<section id="lista2">
            
				        </section>
					</div>
					<div class="modal-footer">
						<div class="row">
							<div class="col-lg-12">
								<button type="button" id="btnCerrar" class="btn btn-login  btn-flat  pull-left" data-dismiss="modal">Cerrar</button>
								<input type="submit" class="btn btn-login  btn-flat  pull-right" value="Re-Agendar Paciente">	
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
	<!-- Modal -->
	<!-- ENLACE A ARCHIVOS JS -->

	<!-- jquery -->
    <script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>

    <!-- Select2 -->
    <script src="../plugins/select2/select2.full.min.js"></script>

    <!-- Bootstrap 3.3.5 -->
    <script src="../plugins/bootstrap/js/bootstrap.min.js"></script>

    <!-- DataTables -->
    <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>

	<!-- Preloaders -->
    <script src="../plugins/Preloaders/jquery.preloaders.js"></script>

	<!-- bootstrap-toggle-master -->
    <script src="../plugins/bootstrap-toggle-master/doc/script.js"></script>
    <script src="../plugins/bootstrap-toggle-master/js/bootstrap-toggle.js"></script>
	
	<!-- alertify -->
	<script type="text/javascript" src="../plugins/alertifyjs/alertify.js"></script>

    <!-- Funciones propias -->
    <script src="funciones.js"></script>
    <script src="../js/menu.js"></script>
    <script src="../js/precarga.js"></script>
		<script src="../js/salir.js"></script>

    <!-- LLAMADAS A FUNCIONES E INICIALIZACION DE COMPONENTES -->

    <!-- Llamar la funcion para llenar la lista -->
	<script type="text/javascript">
		llenar_lista();
	</script>

    <!-- Inicializador de elemento -->
     <script>
      $(function () {
        $(".select2").select2();
        
      });
    </script> 

	<script>
		var letra ='<?php echo $opcionMenu; ?>';
		$(document).ready(function() { menuActivo(letra); });
	</script>

	<script type="text/javascript" src="../plugins/stacktable/stacktable.js"></script> 
	<script>
		window.onload = function() {
			$("#cuerpo").fadeIn("slow");
		};	
	</script>
</body>
</html>