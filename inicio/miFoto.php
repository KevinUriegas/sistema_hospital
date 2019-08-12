
<br>
<?php
	include('../sesiones/verificar_sesion.php');
	$id_persona = $_SESSION["idPersona"];
	 $ruta = '../images/'.$id_persona.'.jpg';
?>
 <div class="row">
 	<div class="col-md-12">
 		<div class="col-md-offset-4 col-md-4">
	 		<a href="#" class="thumbnail">
				<img src="<?php echo $ruta?>" width=200px id='imagen_persona'>
			</a>
	 	</div>
 	</div>
 </div>
<form id="frmImagen">
	<div class="row">
		<div class="container-fluid">
			<div class="form-group">
				<!-- <label for="image">Nueva imagen</label> -->
				<input type="file" class="form-control-file" name="image" id="image">
				<input type="hidden" class="form-control-file" name="idp" id="idp">
			</div>	
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<input type="button" class="btn btn-login  btn-flat  pull-right upload" value="Subir Fotografía" onclick="subir_imagen()">
		</div>
	</div>
</form>
<script src="../plugins/bootstrap-fileinput-master/js/plugins/piexif.js" type="text/javascript"></script>
<script src="../plugins/bootstrap-fileinput-master/js/plugins/sortable.js" type="text/javascript"></script>
<script src="../plugins/bootstrap-fileinput-master/js/fileinput.js" type="text/javascript"></script>
<script src="../plugins/bootstrap-fileinput-master/js/locales/fr.js" type="text/javascript"></script>
<script src="../plugins/bootstrap-fileinput-master/js/locales/es.js" type="text/javascript"></script>
<script src="../plugins/bootstrap-fileinput-master/themes/fas/theme.js" type="text/javascript"></script>
<script src="../plugins/bootstrap-fileinput-master/themes/explorer-fas/theme.js" type="text/javascript"></script>
<script>
	$("#image").fileinput({
		theme: 'fas',
		language: 'es',
		showUpload: false,
		showCaption: true,
		showCancel: false,
		showRemove: true,
		browseClass: "btn btn-login",
		fileType: "jpg",
		allowedFileExtensions: ['jpg'],
		overwriteInitial: false,
		maxFileSize: 1000,
		maxFilesNum: 10
	});
</script>

