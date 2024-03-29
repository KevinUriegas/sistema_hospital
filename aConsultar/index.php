<?php 
include('../sesiones/verificar_sesion.php');

// Variables de configuración
$titulo="Consulta Pacientes";
$opcionMenu="A";
$fecha_mas = strtotime ( '+1 day' , strtotime ( $fecha ) ) ;
$fecha_mas = date ( 'Y-m-d' , $fecha_mas );

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
				        <section id="alta" style="display: none">
				        	<div class="row">
				        		<input type="hidden" id="id_paciente">
				        		<div class="col-xs-12 col-sm-6 col-md-6 col-lg-2">
									<div class="form-group">
										<a href="#" class="thumbnail">
									      <img alt="" id="imagen_paciente">
									    </a>
									</div>
								</div>
				        		<div class="col-xs-12 col-sm-6 col-md-6 col-lg-5">
									<div class="form-group">
										<label for="idMedicamento">*Nombre Paciente:</label>
										<input type="text" readonly id="nombre_paciente" class="form-control">
									</div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
									<div class="form-group">
										<label for="idMedicamento">*No. Seguro:</label>
										<input type="text" readonly id="no_seguro" class="form-control">
									</div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-6 col-lg-2">
									<div class="form-group">
										<br>
										<button class="btn btn-login btn-flat  pull-right" onclick="mas_datos()">Ver mas Datos</button>
									</div>
								</div>
				        	</div>
            				<form id="frmAlta">
								<div class="row">
									<input id="id_cita" class="form-control" type="hidden" value="0">
									<input id="id_receta" class="form-control" type="hidden" value="0">
									<div class="col-xs-12 col-sm-4 col-md-4 col-lg-3">
										<div class="form-group">
											<label for="idMedicamento">Selecciona el medicamento:</label>
											<select  id="id_medicamento" class="select2 form-control " style="width: 100%">
											</select>
										</div>
									</div>
									<div class="col-xs-6 col-sm-4 col-md-4 col-lg-3">
										<div class="form-group">
											<label for="cantidad">Cantidad:</label>
											<input type="text" id="cantidad" class="form-control " required="" placeholder="Escribe la cantidad">
										</div>
									</div>
									<div class="col-xs-6 col-sm-4 col-md-4 col-lg-6">
										<div class="form-group">
											<label for="cantidad">Comentario:</label>
											<input type="text" id="comentario" class="form-control " required="" placeholder="Comentario">
										</div>
									</div>
									<hr class="linea">
								</div>
								<div class="row">
									<div class="col-lg-12">
										<button type="button" id="btnLista" class="btn btn-login  btn-flat  pull-left">Cancelar</button>
										<input type="submit" class="btn btn-login  btn-flat  pull-right" value="Guardar Información" id="guardar">		
										<button type="button" class="btn btn-login  btn-flat  pull-right" onclick="mensaje()">Terminar Consulta</button> 								
									</div>
								</div>
            				</form>
				        </section>
	<br>
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
	<div id="modalDatosPaciente" class="modal fade" role="dialog">
	  <div class="modal-dialog modal-md">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Datos del Paciente / Alergias</h4>
	      </div>
	      <div class="modal-body">
				<input type="hidden" id="idE">
				<div class="row">
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
						<div class="form-group">
							<label for="areaE">*Tipo de Sangre:</label>
							<input type="text" id="tipo_sangre" readonly class="form-control">
						</div>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-4">
						<div class="form-group">
							<label for="areaE">*Estatura:</label>
							<input type="text" id="estatura" readonly class="form-control">
						</div>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-4">
						<div class="form-group">
							<label for="areaE">*Peso:</label>
							<input type="text" id="peso" readonly class="form-control">
						</div>
					</div>
					<hr class="linea">
				</div>
				<section id="lista2"></section>
	      </div>
	      <div class="modal-footer">
				<div class="row">
					<div class="col-lg-12">
						<button type="button" id="btnCerrar" class="btn btn-login  btn-flat  pull-left" data-dismiss="modal">Cerrar</button>
					</div>
				</div>
	      </div>
	    </div>
	  </div>
	</div>
	<!-- Modal -->
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
									<input type="date" id="fecha_cita" class="form-control" required onchange='llenar_lista3(this.value)' min="<?php echo $fecha_mas?>">
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
						<section id="lista3">
            
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
	<script src="../plugins/input-mask/jquery.inputmask.js"></script>
	<script src="../plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
	<script src="../plugins/input-mask/jquery.inputmask.extensions.js"></script>

    <!-- Funciones propias -->
    <script src="funciones.js"></script>
    <script src="../js/menu.js"></script>
    <script src="../js/precarga.js"></script>
	<script src="../js/salir.js"></script>
	
	<script src="../plugins/voice/responsivevoice.js"></script>

    <!-- LLAMADAS A FUNCIONES E INICIALIZACION DE COMPONENTES -->

    <!-- Llamar la funcion para llenar la lista -->
	<script type="text/javascript">
		llenar_lista();
	</script>

    <!-- Inicializador de elemento -->
	<script>
      $(function () {
        $(".select2").select2();
		$('#estatura').inputmask('9.99');
		$('#estaturaE').inputmask('9.99');
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