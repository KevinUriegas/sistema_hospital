<?php 
	include('../sesiones/verificar_sesion.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Sistema de Registros de Alumnos</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" type="text/css" href="../plugins/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="../plugins/fontawesome-free-5.8.1-web/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="../css/estilos.css">
	<!-- Alertify	 -->
	<link rel="stylesheet" type="text/css" href="../plugins/alertifyjs/css/alertify.css">
	<link rel="stylesheet" type="text/css" href="../plugins/alertifyjs/css/themes/bootstrap.css">
	<!-- fileinput -->
	<link href="../plugins/bootstrap-fileinput-master/css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
</head>
<body>
	<header>
		<?php 
			include('../layout/encabezado.php');
		 ?>
	</header><!-- /header -->	
	<div class="container-fluid" >
		<div class="row" id="cuerpo" style="display:none">
			<div class="col-xs-0 col-sm-3 col-md-2 col-lg-2">
				<?php 
					include('../layout/menuv.php');
				?>
			</div>

			<div class="col-xs-12 col-sm-9 col-md-10 col-lg-10 cont">
			   <div class="titulo borde sombra">
			        <h3 class="titular">Panel Inicial</h3>
			   </div>	
			   <div class="contenido borde sombra" style="padding-right:18px;">
					<section id="panel">

					</section>
					<section id="misDatos">

					</section>
					<section id="miFoto">

					</section>
					<section id="miPass">

					</section>
				</div>
				<!-- <div>
					<label for="">Municipios</label>(<label id="n_m"></label>)
					<select name="" id="municipios" class="form-control" onchange="verificar()">
						<option value="" selected="true">Selecciona...</option>
						<option value="1">Linares</option>
					</select>

					<label for="">Colonias</label>(<label id="n_c"></label>)
					<select name="" id="colonias" class="form-control" onchange="verificar()">
						<option value="" selected="true">Selecciona...</option>
						<option value="1">Camachito</option>
					</select>

					<label for="">Total de Personas</label>(<label id="n_p"></label>)
					<input name="" id="personas" class="form-control" value="100">
				</div> -->
			</div>			
		</div>
	</div>
	<footer class="fondo">
		<?php 
			include('../layout/pie.php');
		 ?>			

	</footer>
	<script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
	<!-- Preloaders -->
    <script src="../plugins/Preloaders/jquery.preloaders.js"></script>
	
	<script src="../js/menu.js"></script>
	<script src="../js/precarga.js"></script>
	<script src="../js/salir.js"></script>
	<script src="../js/inicio.js"></script>
	<script src="../plugins/bootstrap/js/bootstrap.min.js"></script>

	<!-- alertify -->
	<script type="text/javascript" src="../plugins/alertifyjs/alertify.js"></script>

	<script src="../plugins/bootstrap-fileinput-master/js/plugins/piexif.js" type="text/javascript"></script>
    <script src="../plugins/bootstrap-fileinput-master/js/plugins/sortable.js" type="text/javascript"></script>
    <script src="../plugins/bootstrap-fileinput-master/js/fileinput.js" type="text/javascript"></script>
    <script src="../plugins/bootstrap-fileinput-master/js/locales/fr.js" type="text/javascript"></script>
    <script src="../plugins/bootstrap-fileinput-master/js/locales/es.js" type="text/javascript"></script>
    <script src="../plugins/bootstrap-fileinput-master/themes/fas/theme.js" type="text/javascript"></script>
	<script src="../plugins/bootstrap-fileinput-master/themes/explorer-fas/theme.js" type="text/javascript"></script>
	<!-- <script>
		function verificar(){
			var municipios = $('#municipios').val();
			var colonias   = $('#colonias').val();

			if(municipios == "" && colonias == ""){
				$('#personas').val("100");
			}else if(municipios != "" && colonias == "" ){
				$('#personas').val("50");
			}else if(municipios != "" && colonias != "" ){
				$('#personas').val("25");
			}else if (colonias != "" && municipios == ""){
				$('#personas').val("12");
			}
		}
	</script> -->
	<script>
		window.onload = function() {
			$("#cuerpo").fadeIn("slow");
		};	
		$("#linkPanel").addClass("activo");
		llenarPanel();
	</script>
	<script type="text/javascript" src="../plugins/Smoothbox-master/js/smoothbox.min.js"></script>
</body>
</html>