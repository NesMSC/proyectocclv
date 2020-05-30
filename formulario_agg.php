<?php 
	
	include_once "conexion.php";

	if (!isset($_SESSION)) {
			echo "<script>location.href='index.php'</script>";

	}

	//Consultar Cátedras

	$cat_sql = "SELECT id_catedra, cat_nombre FROM catedra";

	$cat_query = $conex->prepare($cat_sql);
	$cat_query->execute();

	$cat_dats = $cat_query->fetchAll();

	//Consultar cátedras inscritas

	if (isset($_GET['id_al'])) {
		
		$id_alumno = $_GET['id_al'];

		$sql_catedras = "SELECT alumno.id_alumno, alumno.id_persona, catedra.id_catedra, catedra.cat_nombre, alumno.fecha_ini FROM alumno INNER JOIN alum_cat INNER JOIN catedra ON alumno.id_alumno=alum_cat.id_alumno AND alum_cat.id_catedra=catedra.id_catedra WHERE alumno.id_alumno=$id_alumno";

		$catedras_query = $conex->prepare($sql_catedras);
		$catedras_query->execute();

		$catedras = $catedras_query->fetchAll();

		
	};

 ?>


				          <div class="row">
				          	<div class="input-field col s12 m6">
				              <i class="material-icons prefix">account_circle</i>
				              <input  id="icon_telephone" type="text" class="validate" required="required" name="nomb" value="<?php 
				              if (isset($_GET['id'])){

				              	echo $estud_dat['nombre'].' '.$estud_dat['nombre2'];

				              }elseif(isset($_GET['per_id'])){

				              	echo $per_dat['nombre'].' '.$per_dat['nombre2'];

				              };

				              ?>">
				              <label for="icon_telephone">Nombres</label>
				            </div>          
				            <div class="input-field col s12 m6">
				              <i class="material-icons prefix">account_circle</i>
				              <input  id="icon_prefix" type="text" class="validate" required="required" name="apel" value="<?php 

				              if (isset($_GET['id'])){

				              	echo $estud_dat['apellido'].' '.$estud_dat['apellido2'];

				              }elseif(isset($_GET['per_id'])){

				              	echo $per_dat['apellido'].' '.$per_dat['apellido2'];
				              };

				              ?>">
				              <label for="icon_prefix">Apellidos</label>
				            </div>			            
				            <div class="input-field col s12 m6">
				              <i class="material-icons prefix">account_circle</i>
				              <input id="ced" type="number" class="validate" required="required" name="ced" value="<?php 

				              if (isset($_GET['id'])){

				              	echo $estud_dat['cedula'];

				              }elseif(isset($_GET['per_id'])){

				              	echo $per_dat['cedula'];
				              }

				              ?>">
				              <label for="ced">Cédula</label>
				            </div>
				            <div class="input-field col s12 m6">
				            	<input id="date" type="date" class="validate" required="required" name="fecha_nacimiento" value="<?php 

				            	if (isset($_GET['id'])){

				            		echo $estud_dat['fecha_na'];

				            	}elseif(isset($_GET['per_id'])){

				            		echo $per_dat['fecha_na'];
				            	};

				            	?>">
				            </div>
				            <div class="input-field col s12 m6">
				            	<i class="material-icons prefix">account_circle</i>
				            	<input id="email" type="email" name="email" class="validate" required="required" value="<?php 

				            	if (isset($_GET['id'])){

				            		echo $estud_dat['email'];

				            	}elseif(isset($_GET['per_id'])){

				            		echo $per_dat['email'];
				            	};
				            		?>">
				            	<label for="email">Correo electrónico</label>
				            </div>
				            <div class="input-field col s12 m6">
				            	
				            	<input id="telefono" type="text" name="telefono" class="validate" required="required" value="<?php 

				            	if (isset($_GET['id'])){

				            		echo $estud_dat['telefono'];

				            	}elseif(isset($_GET['per_id'])){

				            		echo $per_dat['telefono'];
				            	};
				            		?>">
				            	<label for="telefono">telefono</label>
				            </div>
				            <div class="input-field col s12 m6">
				            	<i class="material-icons prefix">account_circle</i>
				            	<input id="direccion" type="text" name="direccion" class="validate" required="required" value="<?php 

				            	if (isset($_GET['id'])){

				            		echo $estud_dat['direccion'];

				            	}elseif(isset($_GET['per_id'])){

				            		echo $per_dat['direccion'];
				            	};
				            		?>">
				            	<label for="direccion">direccion</label>
				            </div>

				            <?php if (!isset($_GET['per_id']) && !isset($_GET['per']) && !isset($_GET['id']) && !isset($_GET['id_al'])): ?> 
				             
				            <div class="input-field col s12 m6">
				            	<?php if (!isset($_GET['agg'])): ?>
				            	<select name="catedra" required="required">
				            		<option value="" disabled selected>Cátedra</option>
				            		  
				            		<?php  foreach ($cat_dats as $cat_dat): ?>

				            		<option value="<?php echo $cat_dat['id_catedra']; ?>"><?php echo $cat_dat['cat_nombre']; ?></option>

				            		<?php endforeach ?>
				            	
				            	</select>
				            	<?php endif ?>

				            	<!-- Select cuando esta agregando un profesor -->
				            	<?php if (isset($_GET['agg'])): ?>
				            		<select name="catedra">

									<?php foreach ($dato_catedra as $catedra): ?>
										<option value="<?php echo $catedra['id_catedra']; ?>"><?php echo $catedra['cat_nombre']; ?></option>
									<?php endforeach ?>
									
								</select>
				            	<?php endif ?>

				            </div>
							<?php endif ?>

							<?php if (isset($_GET['id'])): ?>
								<div class="col s12 center-align">
									<h5><i>Cátedras inscritas</i></h5>
								</div>
								<div class="col s12">
									<table>
										<thead>
											<tr>
												<th>Nombre</th>
												<th>Fecha de inscripción</th>
												<th>Acción</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($catedras as $catedra_ins): ?>
												
												<tr>
													<th><?php echo $catedra_ins['cat_nombre']; ?></th>
													<th><?php echo $catedra_ins['fecha_ini']; ?></th>
													<th><a href="elim_cat_ins.php?id=<?php echo $catedra_ins['id_persona'].'&id_al='.$catedra_ins['id_alumno'].'&id_cat='.$catedra_ins['id_catedra']; ?>"><i class="material-icons">delete</i></a></th>
												</tr>

											<?php endforeach ?>
										</tbody>
									</table>
								</div>
								<div class="col s12">
									<a href="#modal_cat" class="modal-trigger">Añadir cátedra<i class="tiny material-icons ">add</i></a>
								</div>
								<!--Ventana modal de las catedras dispónibles-->
	      						<div class="col s12">
									<?php include_once 'catedra_dis.php' ?>
								</div>
							<?php endif ?>
				          </div>