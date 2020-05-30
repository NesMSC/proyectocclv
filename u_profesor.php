<?php 

	include_once "conexion.php";
	
	session_start();
	

	if ($_SESSION['verificado']) {

		$id_profesor = $_SESSION['id_profesor'];

	$sql_catedra = "SELECT id_catedra, cat_nombre FROM catedra WHERE id_profesor=$id_profesor";

	$send_sql = $conex->prepare($sql_catedra);
	$send_sql->execute();

	$dato_catedra = $send_sql->fetchAll();

	if (isset($_GET['cat'])) {
		
		$id_cat = $_GET['cat'];

		$sql_alumnos = "SELECT nombre, apellido, cedula, telefono, email FROM persona INNER JOIN alumno INNER JOIN alum_cat ON alumno.id_persona=persona.id_persona AND alum_cat.id_alumno=alumno.id_alumno WHERE alum_cat.id_catedra=$id_cat";

			$send_sql_alumnos = $conex->prepare($sql_alumnos);
			$send_sql_alumnos->execute();

			$dato_alumnos = $send_sql_alumnos->fetchAll();

	};
	
	}else{

		echo "<script>location.href='index.php'</script>";
	};


	


	include_once "nav&side.php";
 ?>
				<div class="col m11 s12 l8">

					<div class="row section">
					<?php if(!isset($_GET['agg'])): ?>
						<div class="col s6">
							<div class="input-field">
								<select onchange="location=this.value">
									<option selected disabled>Cátedra</option>

									<?php foreach ($dato_catedra as $catedra): ?>
										<option value="u_profesor.php?cat=<?php echo $catedra['id_catedra']; ?>"><?php echo $catedra['cat_nombre']; ?></option>
									<?php endforeach ?>
									
								</select>
							</div>
						</div>
						
						<div class="col s12">
							<table>
								
						        <thead>
						          	<tr>
						            	<th>Nombre</th>
						            	<th>Apellido</th>
						  				<th>Cédula</th>
						  				<th>Teléfono</th>
						  				<th>Correo electrónico</th>
						        	</tr>
						        </thead>

						        <tbody>
						        <?php if (isset($_GET['cat'])): ?>
						        		
						        	
						        	<?php foreach ($dato_alumnos as $dato_al): ?>
						          	<tr>
						          	
						          		<th><?php echo $dato_al['nombre']; ?></th>
						          		<th><?php echo $dato_al['apellido']; ?></th>
						          		<th><?php echo $dato_al['cedula']; ?></th>
						          		<th><?php echo $dato_al['telefono']; ?></th>
						          		<th><?php echo $dato_al['email']; ?></th>
						          	</tr>
						          <?php endforeach ?>

						    	<?php endif ?>
						        </tbody>
	      					</table>

	      					<a href="?agg" class="waves-effect waves-light btn green darken-4">Agregar</a>
	      				</div>

					</div> 
					<?php endif ?>

					<?php if(isset($_GET['agg'])): ?>
						<form action="agregar.php" method="POST">
							<?php include_once 'formulario_agg.php'; ?>
							<button class="btn green darken-4 waves-effect waves-light center-align">Agregar</button>
						</form>
						
					<?php endif ?>
				
			</div>
	    	<!--Import jQuery before materialize.js-->
	    	<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  			<!-- Compiled and minified JavaScript -->
			<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>

			<script>
	

				$(document).ready(function() {
					$('select').material_select();
					$(".button-collapse").sideNav();
				});




			</script>
				
			
	    </body>
  </html>