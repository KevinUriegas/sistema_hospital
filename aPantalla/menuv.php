
				<div class="sidebar fondo borde fuenteAzul sombra vertical" >
					<h2 class="fondo">Menú</h2>
					<ul class="menuv">
					<?php
						$cadena = mysql_query("SELECT id_area, nombre FROM areas WHERE activo = '1'",$conexion);
						while($row_areas = mysql_fetch_array($cadena)){
					?>
						<li class="list-unstyled icoMedia">
							<a href="#" onclick="llenar_tabla('<?php echo $row_areas[0]?>')"><i class="fas fa-desktop"></i> <label class="modulo">	<?php echo $row_areas[1]?></label></a>
						</li>
					<?php
						}
					?>
						<li class="list-unstyled divisor">
							<hr>
						</li>
						<li class="list-unstyled icoMedia">
							<a href="../inicio/index.php"><i class="fas fa-home"></i> <label class="modulo">	Inicio</label></a>
						</li>
						<li class="list-unstyled icoMedia">
							<a href="../mCarreras/index.php"><i class="fas fa-unlock-alt"></i> <label class="modulo">	Cambiar Contraseña</label></a></a>
						</li>
						<li class="list-unstyled icoMedia modulo">
							<a href="#" onclick="salir();"><i class="fas fa-sign-out-alt"></i> <label class="modulo">	Salir</label></a></a>
						</li>
					</ul>
				</div>