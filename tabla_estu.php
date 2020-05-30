<?php 

include_once "conexion.php";

	session_start();



	


		$bus = $_POST['consulta'];


		if(isset($_GET['in'])){

			$sql = "SELECT persona.id_persona, persona.nombre, apellido, cedula, alumno.id_alumno, catedra.cat_nombre FROM persona INNER JOIN alumno INNER JOIN alum_cat INNER JOIN catedra ON persona.id_persona=alumno.id_persona AND alumno.id_alumno=alum_cat.id_alumno AND catedra.id_catedra=alum_cat.id_catedra AND alumno.status=0 WHERE persona.nombre LIKE '%$bus%' OR apellido LIKE '%$bus%' OR cedula LIKE '%$bus%' OR catedra.cat_nombre LIKE '%$bus%'";

		}else{

			$sql = "SELECT persona.id_persona, persona.nombre, apellido, cedula, alumno.id_alumno, catedra.cat_nombre FROM persona INNER JOIN alumno INNER JOIN alum_cat INNER JOIN catedra ON persona.id_persona=alumno.id_persona AND alumno.id_alumno=alum_cat.id_alumno AND catedra.id_catedra=alum_cat.id_catedra AND alumno.status=1 WHERE persona.nombre LIKE '%$bus%' OR apellido LIKE '%$bus%' OR cedula LIKE '%$bus%' OR catedra.cat_nombre LIKE '%$bus%'";
		};

 		

		$send_q = $conex->prepare($sql);
		$send_q->execute();

		$dats = $send_q->fetchAll();
		






 ?>

 			


							
						<div class="col s12">
							<table>
								
						        <thead>
						          	<tr>
						            	<th>Nombre</th>
						            	<th>Apellido</th>
						  				<th>Cédula</th>
						  				<th>Cátedra</th>
						  				<th>Acción</th>
						        	</tr>
						        </thead>

						        <tbody>
						          <?php foreach ($dats as $dat): ?>
						          	<tr>
						          		
						          		<th><?php echo $dat['nombre']; ?></th>
						          		<th><?php echo $dat['apellido']; ?></th>
						          		<th><?php echo $dat['cedula']; ?></th>
						          		<th><?php echo $dat['cat_nombre'] ?></th>
						          		
						          		<th>					          			
						          			<a href="editar_alumno.php?<?php echo 'id='.$dat['id_persona'].'&id_al='.$dat['id_alumno'];?>"><i class="material-icons">edit</i></a>

						          			<a href="<?php $id=$dat["id_persona"]; echo 'eliminar.php?id='.$id; ?>"><i class="material-icons">delete</i></a>

						          			<a href="<?php $id=$dat["id_persona"]; echo 'perfil_al.php?id='.$id; ?>"><i class="material-icons">visibility</i></a>
						          		</th>
						          	</tr>
						          <?php endforeach ?>
						        </tbody>
	      					</table>
	      					
	      				</div>


      				<?php if (!isset($_GET['in'])): ?>
      					<a href="agregar_alumno.php" class="waves-effect waves-light btn green darken-4">Agregar</a>
      					<?php endif ?>




      					

      			