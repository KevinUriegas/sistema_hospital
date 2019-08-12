<?php 
// Conexion a la base de datos
include'../conexion/conexion.php';
// Codificacion de lenguaje
mysql_query("SET NAMES utf8");
// Consulta a la base de datos
$consulta=mysql_query("SELECT id_paciente, (SELECT CONCAT(nombre,' ',ap_paterno, ' ',ap_materno) FROM personas WHERE personas.id_persona = pacientes.id_persona),numero_seguro,activo FROM pacientes",$conexion) or die (mysql_error());
// $row=mysql_fetch_row($consulta)
 ?>
				            <div class="table-responsive">
				                <table id="example1" class="table table-responsive table-condensed table-bordered table-striped">

				                    <thead align="center">
				                      <tr class="info" >
				                        <th>#</th>
				                        <th>No_Seguro</th>
				                        <th>Nombre</th>
				                        <th>Verificación</th>
				                        <th>Subir/Acualizar</th>
				                      </tr>
				                    </thead>

				                    <tbody align="center">
				                    <?php 
				                    $n=1;
				                    while ($row=mysql_fetch_row($consulta)) {
										$idPaciente      = $row[0];
										$No_Seguro       = $row[2];
										$nomPaciente     = $row[1];
										$activo          = $row[3];
										$checado         = ($activo == 1)?'checked'   : '';		
										$desabilitar     = ($activo == 0)?'disabled'  : '';
										$claseDesabilita = ($activo == 0)?'desabilita': '';

										$foto ='../images_p/'.$idPaciente.'.jpg';
										if (file_exists($foto)){
											$Icono="<i class='fas fa-check-circle fa-lg'></i>";
											$imagen=$foto;
									 }else{
											$Icono="<i class='fas fa-times-circle fa-lg'></i>";
											// if ($sexo=='M') {
												$imagen='../images_p/hombre.png';
											// }else{
											// 	$imagen='../images/mujer.jpg';
											// }
									 }
									?>

				                      <tr>
				                        <td >
				                          <p id="<?php echo "tConsecutivo".$n; ?>" class="<?php echo $claseDesabilita; ?>">
				                          	<?php echo "$n"; ?>
				                          </p>
				                        </td>
				                        <td>
										   <p id="<?php echo "tNoControl".$n; ?>" class="<?php echo $claseDesabilita; ?>">
				                          	<?php echo $No_Seguro; ?>
				                          </p>
				                        </td>
				                        <td>
										   <p id="<?php echo "tnomAlumnoCompleto".$n; ?>" class="<?php echo $claseDesabilita; ?>">
				                          	<?php echo $nomPaciente; ?>
				                          </p>
				                        </td>	
				                        <td>
											<a class="sb btn btn-login btn-sm" href="<?php echo $imagen ?>" title="<?php echo $nomAlumnoCompleto ?>"><?php echo $Icono ?></a>

				                        </td>
				                        <td>
											<button class="btn btn-login btn-sm" onclick="abrirModalSubir('<?php echo $idPaciente ?> ')">
												<i class="fas fa-upload"></i>
											</button>
				                        </td>
				                      </tr>
				                      <?php
				                      $n++;
				                    }
				                     ?>

				                    </tbody>

				                    <tfoot align="center">
				                      <tr class="info">
										<th>#</th>
				                        <th>No_Seguro</th>
				                        <th>Carrera</th>
				                        <th>Verificación</th>
				                        <th>Subir/Acualizar</th>
				                      </tr>
				                    </tfoot>
				                </table>
				            </div>
			
      <script type="text/javascript">
        $(document).ready(function() {
              $('#example1').DataTable( {
                 "language": {
                         // "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
                          "url": "../plugins/datatables/langauge/Spanish.json"
                      },
                 "order": [[ 0, "asc" ]],
                 "paging":   true,
                 "ordering": true,
                 "info":     true,
                 "responsive": true,
                 "searching": true,
                 stateSave: false,
                  dom: 'Bfrtip',
                  lengthMenu: [
                      [ 10, 25, 50, -1 ],
                      [ '10 Registros', '25 Registros', '50 Registros', 'Todos' ],
                  ],
                 columnDefs: [ {
                      // targets: 0,
                      // visible: false
                  }],
                  buttons: [

                  ]
              } );
          } );
      </script>
      <script>
            $(".interruptor").bootstrapToggle('destroy');
            $(".interruptor").bootstrapToggle();
      </script>

<script>

$("#image_modal").fileinput({
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

<script type="text/javascript" src="../plugins/Smoothbox-master/js/smoothbox.min.js"></script>