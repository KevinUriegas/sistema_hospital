<?php 
// Conexion a la base de datos
include('../sesiones/verificar_sesion.php');

$id_usuario =  $_SESSION["idUsuario"];

// Codificacion de lenguaje
mysql_query("SET NAMES utf8");

$id_area = $_POST['id_area'];

// Setcookie("id_area", $id_area);
// $area = $_COOKIE["id_area"];
// echo $area;

$consulta = mysql_query("SELECT citas.id_cita, (SELECT CONCAT(personas.nombre,' ',personas.ap_paterno,' ',personas.ap_materno) FROM pacientes INNER JOIN personas ON personas.id_persona = pacientes.id_persona WHERE pacientes.id_paciente = citas.id_paciente) AS Paciente,
	consultorios.nombre, (SELECT CONCAT(personas.nombre,' ',personas.ap_paterno,' ',personas.ap_materno) FROM doctores INNER JOIN personas ON personas.id_persona = doctores.id_persona WHERE doctores.id_consultorio = consultorios.id_consultorio) AS Doctor, citas.hora_cita
    FROM citas
	INNER JOIN consultorios ON consultorios.id_consultorio = citas.id_consultorio
	INNER JOIN areas ON areas.id_area = consultorios.id_area
    WHERE areas.id_area = '$id_area'",$conexion);
// $row=mysql_fetch_row($consulta)
 ?>
				            <div class="table-responsive">
				                <table id="example1" class="table table-responsive table-condensed table-bordered table-striped">

				                    <thead align="center">
				                      <tr class="info" >
				                        <th>#</th>
				                        <th>Paciente</th>
										<th>Consultorio</th>
										<th>Doctor Encargado</th>
										<th>Hora</th>
				                      </tr>
				                    </thead>

				                    <tbody align="center">
				                    <?php 
										$n=1;
										while ($row=mysql_fetch_row($consulta)) {
											$idCita      = $row[0];
											$Paciente    = $row[1];
											$Consultorio = $row[2];
											$Doctor      = $row[3];
											$horaConsulta = substr($row[4],0,5);
									?>
				                      <tr>
				                        <td >
				                          <p id="<?php echo "tConsecutivo".$n; ?>" class="<?php echo $claseDesabilita; ?>">
				                          	<?php echo "$n"; ?>
				                          </p>
				                        </td>
				                        <td>
											<p id="<?php echo "tpaciente".$n; ?>" class="<?php echo $claseDesabilita; ?>">
				                          	<?php echo $Paciente; ?>
				                          </p>
				                        </td>
										<td>
											<p id="<?php echo "tConsultorio".$n; ?>" class="<?php echo $claseDesabilita; ?>">
												<?php echo $Consultorio; ?>
											</p>
				                        </td>
										<td>
											<p id="<?php echo "tFecha".$n; ?>" class="<?php echo $claseDesabilita; ?>">
												<?php echo $Doctor; ?>
											</p>
				                        </td>	
										<td>
											<p id="<?php echo "tHora".$n; ?>" class="<?php echo $claseDesabilita; ?>">
												<?php echo $horaConsulta; ?>
											</p>
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
										<th>Doctor Encargado</th>
										<th>Hora</th>
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
                 "info":     false,
                 "responsive": true,
                 "searching": false,
                 stateSave: false,
                  dom: 'Bfrtip',
                  lengthMenu: [
                    [ 10, 25, 50, -1 ],
                    [ '10 Registros', '25 Registros', '50 Registros', 'Todos' ],
                  ],
                 columnDefs: [ {
                      // targets: 0,
                      // visible: false
                  }]
              } );
          } );

      </script>
      <script>
            $(".interruptor").bootstrapToggle('destroy');
            $(".interruptor").bootstrapToggle();
      </script>
    
    
