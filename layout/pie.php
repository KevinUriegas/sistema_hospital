<div class="copyright">
	@ 2019 Uriegas Lopez | <a href="">SISTEMAS</a>
</div>
<div class="information">
	Politicas y privacidad | <a href="">SISTEMAS</a>
</div>	
<!-- Modal -->
<font color= "black">
	<div id="MisDatos" class="modal fade" role="dialog">
		<div class="modal-dialog modal-lg">
			<!-- Modal content-->
			<form id="frmMisDatos">
				<div class="modal-content">
					<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Mis Datos</h4>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="container-fluid">
								<div class="col-xs-12 col-sm-4 col-md-4 col-lg-6">
									<div class="form-group">
										<label for="nombre">Nombre de la Persona:</label>
										<input type="text" id="nombre_modal" name="nombre" class="form-control " autofocus="" required="" placeholder="Escribe el nombre">
									</div>
								</div>
								<div class="col-xs-6 col-sm-4 col-md-4 col-lg-3">
									<div class="form-group">
										<label for="paterno">Apellido Paterno:</label>
										<input type="text" id="paterno_modal" name="paterno" class="form-control " required="" placeholder="Escribe el apellido">
									</div>
								</div>
								<div class="col-xs-6 col-sm-4 col-md-4 col-lg-3">
									<div class="form-group">
										<label for="materno">Apellido Materno:</label>
										<input type="text" id="materno_modal" name="materno" class="form-control " required="" placeholder="Escribe el apellido">
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<div class="form-group">
										<label for="direccion">Dirección:</label>
										<input type="text" id="direccion_modal" name="direccion" class="form-control " required="" placeholder="Escribe la dirección completo">
									</div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
									<div class="form-group">
										<label for="sexo">Sexo:</label>
										<select  id="sexo_modal" name="sexo" class="select2 form-control " style="width: 100%">
											<option value="M">Masculino</option>
											<option value="F">Femenino</option>
										</select>
									</div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
									<div class="form-group">
										<label for="Telefono">Teléfono:</label>
										<input type="text" id="telefono_modal" name="telefono" class="form-control " required="" placeholder="Escribe el telefono">
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
									<div class="form-group">
										<label for="fecha_nac">Fecha de Nacimiento:</label>
										<input type="date" id="fecha_nac_modal" name="fecha_nac" class="form-control " required="" placeholder="yyyy-mm-dd" value="<?php echo $fecha;?>">
									</div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-7 col-lg-8">
									<div class="form-group">
										<label for="correo">Correo:</label>
										<input type="text" id="correo_modal" name="correo" class="form-control " required="" placeholder="email">
									</div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-5 col-lg-4">
									<div class="form-group">
										<label for="tipo">Tipo de persona:</label>
										<select  id="tipo_modal" name="tipo" class="select2 form-control " style="width: 100%">
											<option value="estudiante">Estudiante</option>
											<option value="trabajador">Trabajador</option>
										</select>
									</div>
								</div>
								<hr class="linea">
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<div class="row">
							<div class="col-lg-12">
								<button type="button" id="btnCerrar" class="btn btn-login  btn-flat  pull-left" data-dismiss="modal">Cerrar</button>
								<button type="button" class="btn btn-login  btn-flat  pull-right" onclick="actualizar_datos()">Actualizar Información</button>	
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</font>
<!-- Modal -->
<!-- Modal -->
<font color= "black">
	<div id="CambiarPass" class="modal fade" role="dialog">
		<div class="modal-dialog modal-lg">
			<!-- Modal content-->
			<form id="frmContra">
				<div class="modal-content">
					<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Cambiar Contraseña</h4>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-6">
								<div class="form-group">
									<label for="pass">Contraseña Nueva:</label>
									<input onkeyup="verificar_pass()" type="password" id="pass_modal" class="form-control " autofocus="" required="" placeholder="Escribe la contraseña">
								</div>
							</div>
							<div class="col-xs-6 col-sm-4 col-md-4 col-lg-6">
								<div class="form-group">
									<label for="pass1">Confirma Contraseña:</label>
									<input onkeyup="verificar_pass()" type="password" id="pass_modal1" class="form-control " required="" placeholder="Confirma la contraseña">
								</div>
							</div>
							<hr class="linea">
						</div>
					</div>
					<div class="modal-footer">
						<div class="row">
							<div class="col-lg-12">
								<button type="button" id="btnCerrar" class="btn btn-login  btn-flat  pull-left" data-dismiss="modal">Cerrar</button>
								<button disabled type="button" class="btn btn-login  btn-flat  pull-right" onclick="actualizar_pass()" id="btn_actualizar_pass">Actualizar Contraseña</button>	
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</font>
<!-- Modal -->
<!-- Modal -->
<font color= "black">
	<div id="Foto" class="modal fade" role="dialog">
		<div class="modal-dialog modal-lg">
			<!-- Modal content-->
			<form id="frmImagen">
				<div class="modal-content">
					<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Cambiar Fotografía</h4>
					</div>
					<div class="modal-body">
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
						<div class="row">
							<div class="container-fluid">
								<div class="form-group">
									<!-- <label for="image">Nueva imagen</label> -->
									<input type="file" class="form-control-file" name="image" id="image">
									<input type="hidden" class="form-control-file" name="idp" id="idp">
								</div>	
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<div class="row">
							<div class="col-lg-12">
								<button type="button" id="btnCerrar" class="btn btn-login  btn-flat  pull-left" data-dismiss="modal">Cerrar</button>
								<input type="button" class="btn btn-login  btn-flat  pull-right upload" value="Subir Fotografía" onclick="subir_imagen()">
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</font>
<!-- Modal -->
<script>
	function modal(){
		$.ajax({
			url: "../datos/datos_persona.php",
			data: {},
			type: "POST",
			dataType: "html",
			success: function(respuesta) {
				var array = eval(respuesta);
				$('#nombre_modal').val(array[0]);
				$('#paterno_modal').val(array[1]);
				$('#materno_modal').val(array[2]);
				$('#direccion_modal').val(array[3]);
				$('#sexo_modal').val(array[4]).change();
				$('#telefono_modal').val(array[5]);
				$('#fecha_nac_modal').val(array[6]);
				$('#correo_modal').val(array[7]);
				$('#tipo_modal').val(array[8]).change();
			},
			error: function(xhr, status) {
				alert("no se muestra");
			}
		});
		$("#MisDatos").modal("show");
	}
	function actualizar_datos(){
		var correo = $("#correo_modal").val();

		if(correo.includes('@') == true && correo.includes('.com') == true){
			$.ajax({
				url:"../datos/actualizar_datos.php",
				type:"POST",
				dateType:"html",
				data:$('#frmMisDatos').serialize(),
				success:function(respuesta){
				if (respuesta == "ok"){
					alertify.set('notifier','position', 'bottom-right');
					alertify.success('Se han Actualizado los datos' );
					$("#MisDatos").modal("hide");
				}else if(respuesta == "vacio"){
					alertify.set('notifier','position', 'bottom-right');
					alertify.error('Verifica Campos' );
				}else if(respuesta == "telefono"){
					alertify.set('notifier','position', 'bottom-right');
					alertify.error('Verifica Telefono' );
					$("#telefono_modal").focus();
				}else{
					alertify.set('notifier','position', 'bottom-right');
					alertify.error('Ha Ocurrido un Error' );
				}
				},
				error:function(xhr,status){
				alert(xhr);
				},
			});
		}else{
			alertify.error('Verifica Correo');
		}
		return false;
	}
	function cambiarPass(){
		$("#CambiarPass").modal("show");
	}
	function verificar_pass(){
		var pass1 = $('#pass_modal').val();
		var pass2 = $('#pass_modal1').val();

		if(pass1.trim() != "" && pass2.trim() !=""){
			if(pass1 == pass2){
			$('#btn_actualizar_pass').removeAttr('disabled');
			}else{
			$('#btn_actualizar_pass').attr('disabled', 'disabled');
			}
		}else{
			$('#btn_actualizar_pass').attr('disabled', 'disabled');
		}
	}
	function actualizar_pass(){
		var pass   = $("#pass_modal").val();
		$.ajax({
			url:"../sesiones/actualizar_pass.php",
			type:"POST",
			dateType:"html",
			data:{'pass':pass},
			success:function(respuesta){
			if (respuesta == "ok"){
				alertify.set('notifier','position', 'bottom-right');
				alertify.success('Se ha actualizado la contraseña' );
				$("#frmContra")[0].reset();
				$("#CambiarPass").modal("hide");
			}else{
				alertify.set('notifier','position', 'bottom-right');
				alertify.error('La contraseña es igual a la Anterior' );
			}
			},
			error:function(xhr,status){
				alert(xhr);
			},
		});
	}
	function modal_foto(){
		$("#Foto").modal("show");
	}
	function subir_imagen(){
		var formData = new FormData();
		var files    = $('#image')[0].files[0];

		formData.append('file',files);

		$.ajax({
			url: '../datos/upload.php',
			type: 'post',
			data: formData,
			contentType: false,
			processData: false,
			success: function(response) {
			if (response != 0) {     
				d = new Date();
				$("#imagen_persona").removeAttr("src").attr("src", response);
				$('#frmImagen')[0].reset();
				alertify.success('La imagen ha sido cargada con exito.');
			} else {
				alertify.error('Formato de imagen incorrecto.');
			}
			},
			error:function(xhr,status){
			alertify.error('Error en proceso');
			},
		});
		return false;
	}
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