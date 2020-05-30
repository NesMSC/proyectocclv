<?php 
	include_once 'conexion.php';

	session_start();


	if (!isset($_SESSION['verificado'])) {


		echo "<script>location.href='index.php'</script>";



	}else{


		$sql = "SELECT id_catedra, cat_nombre, persona.nombre, persona.apellido FROM catedra INNER JOIN profesor ON catedra.id_profesor=profesor.id_profesor INNER JOIN persona ON profesor.id_persona=persona.id_persona";

		$send_q = $conex->prepare($sql);

		$send_q->execute();

		$dats = $send_q->fetchAll();

			//datos de profesores
		$sql_prf = "SELECT id_profesor, persona.nombre, persona.apellido, persona.cedula FROM profesor INNER JOIN persona ON profesor.id_persona=persona.id_persona";

		$q_prf = $conex->prepare($sql_prf);

		$q_prf->execute();

		$dats_prf = $q_prf->fetchAll();

		if(isset($_GET['id_cat'])){

			$id_catedra = $_GET['id_cat'];

			$sql_catedra = "SELECT cat_nombre FROM catedra WHERE id_catedra=$id_catedra";

			$send_sql = $conex->prepare($sql_catedra);
			$send_sql->execute();

			$catedra_dato = $send_sql->fetch();



		}
		
	};

	include_once "nav&side.php";



 ?>



 			<div class="col m11 s12 l8">
 				
 				<div class="row">
 					<?php if(!$_GET): ?>
 					<div class="col s12">
 						<table>
							
					        <thead>
					          	<tr>
					            	<th>Nombre</th>
					            	<th>Profesor</th>
					            	<th>Acción</th>
					        	</tr>
					        </thead>

					        <tbody>
					          <?php foreach ($dats as $dat): ?>
					          	<tr>
					          		
					          		<th><?php echo $dat['cat_nombre']; ?></th>
					          		<th><?php echo $dat['nombre']." ".$dat['apellido']; ?></th>
					          		<th>					          			
					          			<a href="?id_cat=<?php echo $dat['id_catedra'];?>"><i class="material-icons">edit</i></a>
					          			<a href="<?php $id_cat=$dat["id_catedra"]; echo 'eliminar_cat.php?id='.$id_cat; ?>"><i class="material-icons">delete</i></a>
					          		</th>
					          	</tr>
					          <?php endforeach ?>
					        </tbody>
      					</table>
      					<a href="catedra.php?agg" class="waves-effect waves-light btn green darken-4">Agregar</a>

 					</div>
 					<?php endif ?>
 					<?php if (isset($_GET['agg'])): ?>
 					<div class="col s12">	
 						<form name="form" action="agg_cat.php" method="POST">
 							<div class="row">	
	 							<div class="input-field col s6">
	 								<input id="cat_nomb" type="text" name="cat_nomb" class="validate" required>
	 								<label for="cat_nomb">Nombre de la Catedra</label>
	 							</div>
	 							<div class="input-field col s6">
	 								<select name="prf" required="required">
					            		<option value="" selected disabled>Profesor</option>
					            		<?php foreach ($dats_prf as $dat_prf):?>
					            		<option value="<?php echo $dat_prf['id_profesor']; ?>"><?php echo $dat_prf['nombre'].' '.$dat_prf['apellido'].' V-'.$dat_prf['cedula']; ?></option>
					            		<?php endforeach ?>
					            	</select>
	 							</div>
	 							<div class="input-field col s6">
					                <button type="submit" class="btn green darken-4 waves-effect waves-light">AGREGAR</button>
					            </div>
					        </div>
 						</form>
 					</div>
 					<?php endif ?>
 					<?php if (isset($_GET['id_cat'])): ?>
 						<form name="form" action="edit_cat.php" method="POST">
 							<div class="row">	
	 							<div class="input-field col s6">
	 								<input id="cat_nomb" value="<?php echo $catedra_dato['cat_nombre']; ?>" type="text" name="cat_nomb" class="validate" required>
	 								<label for="cat_nomb">Nombre de la Catedra</label>
	 							</div>
	 							<div class="input-field col s6">
	 								<select name="prf" required="required">
					            		<option value="" selected disabled>Profesor</option>
					            		<?php foreach ($dats_prf as $dat_prf):?>
					            		<option value="<?php echo $dat_prf['id_profesor']; ?>"><?php echo $dat_prf['nombre'].' '.$dat_prf['apellido'].' V-'.$dat_prf['cedula']; ?></option>
					            		<?php endforeach ?>
					            	</select>
	 							</div>
	 							<div class="input-field col s6">
					                <button name="id_cat" value="<?php echo $_GET['id_cat'] ?>" type="submit" class="btn green darken-4 waves-effect waves-light">EDITAR</button>
					            </div>
					        </div>
 						</form>
 					<?php endif ?>
 				</div>

 			</div>


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