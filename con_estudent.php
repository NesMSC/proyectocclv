<?php 

session_start();

if (isset($_SESSION['verificado'])) {

	include_once 'conexion.php';

	if (isset($_GET['float'])) {

		//Buscar alumnos con id_catedra=null
		$sql_float = "SELECT alum_cat.id_catedra, alumno.id_alumno, alumno.id_persona FROM alum_cat RIGHT JOIN alumno ON alum_cat.id_alumno=alumno.id_alumno";

		$float_q = $conex->prepare($sql_float);
		$float_q->execute();

		$datos_float = $float_q->fetchAll();

		

		//Capturar datos de alumnos flotantes

		$floats = array();

		foreach ($datos_float as $dato_float) {

			if (is_null($dato_float['id_catedra'])) {

				$id_float=$dato_float['id_persona'];
				
				$sql_dato_float = "SELECT persona.id_persona, nombre, apellido, cedula, alumno.id_alumno FROM persona INNER JOIN alumno ON alumno.id_persona=persona.id_persona WHERE persona.id_persona=$id_float";


				$dato_float_query = $conex->prepare($sql_dato_float);
				$dato_float_query->execute();

				$datos = $dato_float_query->fetch();

				array_push($floats, $datos);

			};
		};
	};

}else{

	echo "<script>location.href='index.php'</script>";
};



include_once "nav&side.php";
 ?>

				<div class="col m11 s12 l8">

					<div class="row">

						<div class="col s6">
							<div class="input-field">
				 				<i class="material-icons prefix">search</i>
				 				<input id="busqueda" type="text" name="s_query">
				 				<label for="busqueda">Buscar</label>
			 				</div>
						</div>

						<div class="col s6">
							<div class="input-field">
								<select id="al_type">
									<option value="ac" selected>Activos</option>
									<option value="in">Inactivos</option>
									<option <?php if (isset($_GET['float'])){echo "selected";}; ?> value="float">Flotantes</option>
								</select>
							</div>
						</div>

					</div>

					<?php if (!isset($_GET['float'])): ?>

						<div id="estu_tabla" class="row"></div>

					<?php endif ?>

						<!-- Tabla de estudiantes flotantes -->
	      			<?php if (isset($_GET['float'])): ?>
	      				<table>
						    <thead>
						      	<tr>
						            <th>Nombre</th>
						            <th>Apellido</th>
						  			<th>Cédula</th>
						  			<th>Acción</th>
						        </tr>
						    </thead>

						    <tbody>
								<?php foreach ($floats as $dato_float): ?>
						        <tr>
						          	<th><?php echo $dato_float['nombre']; ?></th>
						          	<th><?php echo $dato_float['apellido']; ?></th>
						          	<th><?php echo $dato_float['cedula']; ?></th>
						          		
						          	<th>
						          		<a href="?float&id_al=<?php echo $dato_float['id_alumno']; ?>" class="modal-trigger asig">Asignar</a>

						          		<a href="<?php $id=$dato_float["id_persona"]; echo 'eliminar.php?id='.$id; ?>"><i class="material-icons">delete</i></a>
						          	</th>
						        </tr>
						        <?php endforeach ?>
						    </tbody>
	      				</table>
	      			<?php endif ?>

					<!--Ventana modal de las catedras dispónibles-->
	      			<div class="col s12">
						<?php include_once 'catedra_dis.php' ?>
					</div>
				</div>
				
			</div>
	    	<!--Import jQuery before materialize.js-->
	    	<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  			<!-- Compiled and minified JavaScript -->
			<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>

			
			<script src="js/busqueda.js"></script>

			<script>

				$(".button-collapse").sideNav();


				$(document).ready(function() {
					$('select').material_select();
				});


				<?php if (isset($_GET['id_al'])): ?>

					$('.modal').modal();
					$('#modal_cat').modal('open');

				<?php endif ?>

			</script>
				
			
	    </body>
  </html>
