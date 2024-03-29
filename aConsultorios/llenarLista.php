<?php 
// Conexion a la base de datos
include('../sesiones/verificar_sesion.php');

$id_usuario =  $_SESSION["idUsuario"];

// Codificacion de lenguaje
mysql_query("SET NAMES utf8");

// Consulta a la base de datos
$consulta=mysql_query("SELECT
							id_consultorio,
							nombre,
							id_area,
							activo,
							(SELECT areas.nombre FROM areas WHERE areas.id_area=consultorios.id_area) AS nArea
						FROM
							consultorios",$conexion) or die (mysql_error());
// $row=mysql_fetch_row($consulta)
 ?>
				            <div class="table-responsive">
				                <table id="example1" class="table table-responsive table-condensed table-bordered table-striped">

				                    <thead align="center">
				                      <tr class="info" >
				                        <th>#</th>
				                        <th>Consultorio</th>
				                        <th>Area</th>
				                        <th>Editar</th>
										<th>Estatus</th>
				                      </tr>
				                    </thead>

				                    <tbody align="center">
				                    <?php 
										$n=1;
										while ($row=mysql_fetch_row($consulta)) {
											$idConsultorio = $row[0];
											$nombre        = $row[1];
											$idArea        = $row[2];
											$activo        = $row[3];
											$Area          = $row[4];

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
																<p id="<?php echo "tnombre".$n; ?>" class="<?php echo $claseDesabilita; ?>">
				                          	<?php echo $nombre; ?>
				                          </p>
				                        </td>
				                        <td>
																<p id="<?php echo "tArea".$n; ?>" class="<?php echo $claseDesabilita; ?>">
				                          	<?php echo $Area; ?>
				                          </p>
				                        </td>
				                        <td>
				                          <button id="<?php echo "boton".$n; ?>" <?php echo $desabilitar ?> type="button" class="btn btn-login btn-sm" 
				                          onclick="abrirModalEditar(
				                          							'<?php echo $idConsultorio  ?>',
				                          							'<?php echo $idArea ?>',
				                          							'<?php echo $nombre ?>'
				                          							);">
				                          	<i class="far fa-edit"></i>
				                          </button>
				                        </td>
				                        <td>
											<input <?php echo $deshabilitar_boton;?> data-size="small" data-style="android" value="<?php echo "$valor"; ?>" type="checkbox" <?php echo "$checado"; ?>  id="<?php echo "interruptor".$n; ?>"  data-toggle="toggle" data-on="Desactivar" data-off="Activar" data-onstyle="danger" data-offstyle="success" class="interruptor" data-width="100" onchange="status(<?php echo $n; ?>,<?php echo $idConsultorio; ?>);">
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
				                        <th>Consultorio</th>
				                        <th>Area</th>
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
                              title:'Bajas-Estaditicas',
                              exportOptions: {
                                  columns: ':visible'
                              }
                          },
                         {
							  text: 'Nuevo Consultorio',
							  className: 'btn btn-login',
                              action: function (  ) {
								ver_alta();
								llenar_area();
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
    
    
