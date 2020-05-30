<?php 
	include_once 'conexion.php';

	session_start();


	if (!isset($_SESSION['verificado'])) {

		echo "<script>location.href='index.php'</script>";

	}else{

		if (isset($_GET['id'])) {

			$id_al=$_GET['id'];

			$sql = "SELECT nombre, nombre2, apellido, apellido2, cedula, fecha_na, email, telefono, direccion, alumno.fecha_ini, catedra.cat_nombre  FROM persona INNER JOIN alumno INNER JOIN alum_cat INNER JOIN catedra ON persona.id_persona=alumno.id_persona AND alumno.id_alumno=alum_cat.id_alumno AND catedra.id_catedra=alum_cat.id_catedra WHERE persona.id_persona=$id_al";

			$send_q = $conex->prepare($sql);

			$send_q->execute();

			$dat_alumno = $send_q->fetch();

		}elseif (isset($_GET['id_per'])) {
			
			$id_per=$_GET['id_per'];

			$sql = "SELECT * FROM persona WHERE id_persona=$id_per";

			$send_q = $conex->prepare($sql);

			$send_q->execute();

			$dat_per = $send_q->fetch();
		};

		
	};

	include_once "nav&side.php";



 ?>

 			<div class="col s12 m8 14" id="imp">
 				<div class="row section">
 					<div align="center" class="col s12">
 						<i><p>

 							<?php echo (!isset($dat_alumno))? 'DATOS DEL TRABAJADOR':'DATOS DEL ALUMNO'; ?>

 						</p></i>
 					</div>
 					<div class="col s12 m6 l6">
 						<p><b>Nombres:</b> <?php 

 							if (!isset($dat_alumno)) {
 								
 								echo $dat_per['nombre'].' '.$dat_per['nombre2']; 

 							}else{

 								echo $dat_alumno['nombre'].' '.$dat_alumno['nombre2'];
 							};		 

 						?> </p>
 					</div>
 					<div class="col s12 m6 l6">
 						<p><b>Apellidos:</b> <?php 

 							if (!isset($dat_alumno)) {
 								
 								echo $dat_per['apellido'].' '.$dat_per['apellido2']; 

 							}else{

 								echo $dat_alumno['apellido'].' '.$dat_alumno['apellido2'];
 							};		 
 

 							?> 

 						</p>
 					</div>
 					<div class="col s12 m6 l4">
 						<p><b>C.I.N°:</b> <?php 

 							if (!isset($dat_alumno)) {
 								
 								echo $dat_per['cedula']; 

 							}else{

 								echo $dat_alumno['cedula'];
 							};		 


 						?></p>
 					</div>
 					<div class="col s12 m6 l6">	
 						<p><b>Nacimiento:</b> <?php 

 							if (!isset($dat_alumno)) {
 								
 								echo $dat_per['fecha_na']; 

 							}else{

 								echo $dat_alumno['fecha_na'];
 							};		 
 

 						?></p>
 					</div>
 					<div class="col s12 m6 l6">	
 						<p><b>Correo electrónico:</b><?php 

 							if (!isset($dat_alumno)) {
 								
 								echo $dat_per['email']; 

 							}else{

 								echo $dat_alumno['email'];
 							};		 
 

 						?></p>
 					</div>
 					<div class="col s12 m6 l6">	
 						<p><b>Teléfono:</b> <?php 

 							if (!isset($dat_alumno)) {
 								
 								echo $dat_per['telefono']; 

 							}else{

 								echo $dat_alumno['telefono'];
 							};	 

 						?></p>
 					</div>
 					<div class="col s12 m6 l12">	
 						<p><b>Dirección:</b> <?php 

 							if (!isset($dat_alumno)) {
 								
 								echo $dat_per['direccion']; 

 							}else{

 								echo $dat_alumno['direccion'];
 							};	 

 						?></p>
 					</div>

 					<?php if (isset($_GET['id'])): ?>
	 					<div class="col s12 m6 l6">	
	 						<p><b>Fecha de ingreso:</b> <?php echo $dat_alumno['fecha_ini']; ?></p>
	 					</div>
	 					<div class="col s12 m6 l6">	
	 						<p><b>Cátedra:</b> <?php echo $dat_alumno['cat_nombre']; ?> </p>
	 					</div>
 					<?php endif ?>

 				</div>
 			</div>
 			<div class="row">
 				<div align="center" class="col s12">
 					<a target="_blank" href="report_al.php<?php echo (isset($dat_alumno))?'?id='.$id_al:'?id_per='.$id_per;?>" class="waves-effect waves-light btn green darken-4">IMPRIMIR</a>
 				</div>
 			</div>

			</div>
	    	<!--Import jQuery before materialize.js-->
	    	<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  			<!-- Compiled and minified JavaScript -->
			<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
			<!-- Función para imprimir div -->
			<script src="js/imp.js"></script>

			<script>
				$(document).ready(function() {

					$('select').material_select();
 
				});
			</script>
	    </body>
  </html>