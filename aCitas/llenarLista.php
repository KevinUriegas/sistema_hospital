<?php 
// Conexion a la base de datos
include('../sesiones/verificar_sesion.php');

$id_usuario =  $_SESSION["idUsuario"];

// Codificacion de lenguaje
mysql_query("SET NAMES utf8");

// Consulta a la base de datos
$consulta=mysql_query("SELECT id_cita,citas.id_paciente,
(SELECT CONCAT( personas.nombre, ' ', personas.ap_paterno, ' ', personas.ap_materno ) 
FROM personas 
WHERE personas.id_persona = pacientes.id_persona),id_consultorio,(SELECT nombre FROM consultorios WHERE consultorios.id_consultorio = citas.id_consultorio), fecha_cita,hora_cita,citas.activo
FROM citas 
INNER JOIN pacientes ON pacientes.id_paciente = citas.id_paciente",$conexion) or die (mysql_error());
// $row=mysql_fetch_row($consulta)
 ?>
				            <div class="table-responsive">
				                <table id="example1" class="table table-responsive table-condensed table-bordered table-striped">

				                    <thead align="center">
				                      <tr class="info" >
				                        <th>#</th>
				                        <th>Paciente</th>
										<th>Consultorio</th>
										<th>Fecha</th>
										<th>Hora</th>
				                        <th>Editar</th>
										<th>Estatus</th>
				                      </tr>
				                    </thead>

				                    <tbody align="center">
				                    <?php 
										$n=1;
										while ($row=mysql_fetch_row($consulta)) {
											$idCita            = $row[0];
											$idPaciente        = $row[1];
											$nombrePaciente    = $row[2];
											$idConsultorio     = $row[3];
											$nombreConsultorio = $row[4];
											$fechaCita         = $row[5];
											$horaCita          = substr($row[6],0,5);											
											$activo            = $row[7];

											$checado         = ($activo == 1)?'checked' : '';		
											$desabilitar     = ($activo == 0)?'disabled': '';
											$claseDesabilita = ($activo == 0)?'desabilita':'';
									?>
				                      <tr>
				                        <td >
				                          <p id="<?php echo "tConsecutivo".$n; ?>" class="<?php echo $claseDesabilita; ?>">
				                          	<?php echo "$n"; ?>
				                          </p>
				                        </td>
				                        <td>
											<p id="<?php echo "tpaciente".$n; ?>" class="<?php echo $claseDesabilita; ?>">
				                          	<?php echo $nombrePaciente; ?>
				                          </p>
				                        </td>
										<td>
											<p id="<?php echo "tConsultorio".$n; ?>" class="<?php echo $claseDesabilita; ?>">
												<?php echo $nombreConsultorio; ?>
											</p>
				                        </td>
										<td>
											<p id="<?php echo "tFecha".$n; ?>" class="<?php echo $claseDesabilita; ?>">
												<?php echo $fechaCita; ?>
											</p>
				                        </td>	
										<td>
											<p id="<?php echo "tHora".$n; ?>" class="<?php echo $claseDesabilita; ?>">
												<?php echo $horaCita; ?>
											</p>
				                        </td>
				                        <td>
				                          <button id="<?php echo "boton".$n; ?>" <?php echo $desabilitar ?> type="button" class="btn btn-login btn-sm" 
				                          onclick="abrirModalEditar(
				                          							'<?php echo $idCita  ?>',
																	'<?php echo $idPaciente ?>',
																	'<?php echo $idConsultorio ?>',
																	'<?php echo $fechaCita ?>',
																	'<?php echo $horaCita ?>'
				                          							);">
				                          	<i class="far fa-edit"></i>
				                          </button>
				                        </td>
				                        <td>
											<input data-size="small" data-style="android" value="<?php echo "$valor"; ?>" type="checkbox" <?php echo "$checado"; ?>  id="<?php echo "interruptor".$n; ?>"  data-toggle="toggle" data-on="Desactivar" data-off="Activar" data-onstyle="danger" data-offstyle="success" class="interruptor" data-width="100" onchange="status(<?php echo $n; ?>,<?php echo $idCita; ?>);">
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
				                        <th>Paciente</th>
										<th>Consultorio</th>
										<th>Fecha</th>
										<th>Hora</th>
				                        <th>Editar</th>
										<th>Estatus</th>
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
                          {
                              extend: 'excel',
                              text: 'Exportar a Excel',
                              className: 'btn btn-login',
                              title:'Lista de Citas',
                              exportOptions: {
                                  columns: ':visible'
                              }
                          },
                         {
							  text: 'Nueva Cita',
							  className: 'btn btn-login',
                              action: function (  ) {
								ver_alta();
								combo_pacientes();
								combo_consultorios();
                              },
                              counter: 1
                          },
                  ]
              } );
          } );

      </script>
      <script>
            $(".interruptor").bootstrapToggle('destroy');
            $(".interruptor").bootstrapToggle();
      </script>
    
    
