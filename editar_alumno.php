<?php 

session_start();

if (isset($_SESSION['verificado'])) {

	include_once 'conexion.php';

		//Consultar datos de los alumnos para editar

	if (isset($_GET["id"])) {
	
		$id_estud = $_GET['id'];

		$sql_estud = "SELECT * FROM persona INNER JOIN alumno ON persona.id_persona=$id_estud AND alumno.id_persona=$id_estud";

		$send3 = $conex->prepare($sql_estud);
		$send3->execute();

		$estud_dat = $send3->fetch(); 

		$status = $estud_dat['status'];
};

}else{

	echo "<script>location.href='index.php'</script>";
};



include_once "nav&side.php"; 
 ?>

				<div class="col m11 s12 l8">
					<div class="row">
						<!-- Vista del formulario para editar-->
	      				<?php if (isset($_GET["id"])): ?>
	      					<h2>EDITAR ESTUDIANTE</h2>
	      					<form class="col s12" action="editar.php" method="POST">
	      						<div class="row">
					          		<div class="input-field col s6">
					          			
						            	<select name="status" required="required">
						            		<option value="" <?php if (!isset($estud_dat['status'])){echo "selected";} ?> disabled>Estado</option>
						            		<option <?php if(isset($status)){if($status==1){echo "selected";}}?> value="1">Activo</option>
						            		<option <?php if(isset($status)){if($status==0){echo "selected";}}?> value="0">Inactivo</option>
						            	</select>
					            	</div>
					          	</div>
	      						<?php include_once "formulario_agg.php" ?>
					          <div class="row">
					            <div class="input-field col s6">
					                <button type="submit" class="btn green darken-4 waves-effect waves-light" name="id" value="<?php echo $estud_dat['id_persona']; ?>">EDITAR<i class="material-icons right">send</i></button>
					            </div>
					         	<input type="text" hidden="hidden" name="id_alumno" value="<?php echo $estud_dat['id_alumno']; ?>">
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
			<script src="js/busqueda.js"></script>

			<script>
				$(document).ready(function(){
					$('.collapsible').collapsible();
				  });

				$(document).ready(function() {
					$('select').material_select();
				});

				$(document).ready(function(){
				    // the "href" attribute of the modal trigger must specify the modal ID that wants to be triggered
				    $('.modal').modal();
				  });
			</script>
	    </body>
  </html>
