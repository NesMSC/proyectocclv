<?php 

	session_start();

	include_once "conexion.php";

	
	if (isset($_SESSION['verificado'])) {

		if ($_GET) {
			
			$bus = $_GET['s_query'];

			$sql = "SELECT persona.id_persona, persona.nombre, persona.apellido, usuario.usuario, usuario.id_nivel FROM persona LEFT JOIN usuario ON persona.id_persona=usuario.id_persona WHERE persona.cedula='$bus' OR persona.nombre='$bus' OR persona.apellido='$bus' OR persona.id_persona='$bus' UNION SELECT persona.id_persona, nombre, apellido, usuario.usuario, usuario.id_nivel FROM persona RIGHT JOIN usuario ON persona.id_persona=usuario.id_persona WHERE persona.cedula='$bus' OR persona.nombre='$bus' OR persona.apellido='$bus' OR persona.id_persona='$bus'";

			$q_dats = $conex->prepare($sql);

			$q_dats->execute(); 

			$dats = $q_dats->fetch();

			if ($dats['nombre']=='admin' && $dats['apellido']=='admin' && $dats['usuario']=='admin_crv') {

				$dats='';
				
			};
		}
		
	}else {

		echo "<script>location.href='index.php'</script>";
	};


	include_once "nav&side.php";
 ?>

 				<div class="col m8 s12">
 					<div class="row section">
 						<div class="col s12 m6">
 							<form method="GET" action="usuarios.php">
		 						<div class="input-field">
		 							<i class="material-icons prefix">search</i><input id="busqueda" type="text" name="s_query">
		 							<label for="busqueda">Buscar</label>
		 						</div>
		 					</form>
 						</div>
 					</div>
 					<?php if (!empty($dats)): ?>
 					<div class="row">
 						<div class="col s12 m6">
 						
 							<ul>
 								<li>
 									<b>Nombre:</b> 
 									<?php echo $dats['nombre']; ?>
 								</li>
 								<li>
 									<b>Apellido:</b> 
 									<?php echo $dats['apellido']; ?>
 								</li>
 								<li>
 									<b>Nivel:</b> 
 									<?php if ($dats['id_nivel']==1) {
 										echo "Administrador";
 									}elseif ($dats['id_nivel']==2) {
 										echo "Profesor";
 									}elseif ($dats['id_nivel']==3) {
 										echo "Alumno";
 									}; ?>
 								</li>
 								<li>
 									<b>Usuario:</b> 
 									<?php echo $dats['usuario']; ?>
 								</li>
 							</ul>
 						</div>
 					</div> 
 					<div class="row">
 						<div class="col m6 s12">
	 						<?php if (is_null($dats['id_nivel'])) {
	 								echo "<button data-target='modal_agg' type='submit' class='btn green darken-4 waves-effect waves-light modal-trigger' name='agg'>Agregar usuario</button>";
	 							}else {
	 								echo "<button data-target='modal_mod' type='submit' class='btn green darken-4 waves-effect waves-light modal-trigger' name='agg'>Modificar usuario</button>";
	 							}; ?>		
	 					</div>
	 					<!--Ventana modal 1, agregar cuenta de usuario-->
	 					<div id="modal_agg" class="modal">
	 						<div class="modal-content">
	 							<form <?php if (is_null($dats['id_nivel'])){echo "name='form'";} ?> method="POST" action="agg_user.php">
	 								<div class="row container">
			 							<div class="input-field col s12" >
			 								<input class="validate" id="user" type="text" name="username" required="required">
			 								<label for="user">Usuario</label>
										</div>
										<div class="input-field col s12">
		 									<input class="pass" onchange="validPass()" id="pass" type="password" name="password" required="required">
		 									<label for="pass">Contraseña</label>
		 								</div>
			 							<div class="input-field col s12">
			 								<input class="pass" onchange="validPass()" id="pass2" type="password" name="password2" required="required">
			 								<label for="pass2">Repetir contraseña</label>
			 							</div>
			 							<div class="input-field col s12">
								           	<select name="nivel" required="required">
								            	<option value="" disabled selected>Nivel</option>
								            	<option value="1">Administrador</option>
								            	<option value="2">Profesor</option>
								            	<!-- <option value="3">Alumno</option> -->
								            </select>
								        </div>
								        <input type="disabled" hidden="hidden" name="id_persona" value="<?php echo $dats['id_persona']; ?>">
			 							<div  class="input-field col s12">
			 								<button name="btn" class="btn green darken-4 waves-effect waves-light center-align">Agregar</button>
			 							</div>
		 							</div>
	 							</form>
	 						</div>
	 					</div>

	 					<!--Ventana modal 2, modificar usuario-->
	 					<div id="modal_mod" class="modal">
	 						<div class="modal-content">
	 							<form <?php if (!is_null($dats['id_nivel'])){echo "name='form'";} ?>  method="POST" action="mod_user.php">
	 								<div class="row container">
			 							<div class="input-field col s12" >
			 								<input  id="user2" type="text" name="username" required="required" value="<?php echo $dats['usuario']; ?>">
			 								<label for="user">Usuario</label>
										</div>
										<div class="input-field col s12">
		 									<input class="pass" onchange="validPass()" id="pass3" type="password" name="password" required="required">
		 									<label for="pass">Nueva contraseña</label>
		 								</div>
			 							<div class="input-field col s12">
			 								<input class="pass" onchange="validPass()" id="pass4" type="password" name="password2" required="required">
			 								<label for="pass">Repetir contraseña</label>
			 							</div>
			 							<div class="input-field col s12">
								           	<select name="nivel" required="required">
								            	<option value="" disabled>Nivel</option>

								            	<option <?php if ($dats['id_nivel']==1) {echo "selected";} ?> value="1">Administrador</option>

								            	<option value="2" <?php if ($dats['id_nivel']==2) {echo "selected";} ?>>Profesor</option>
<!-- 
								            	<option value="3" <?php //if ($dats['id_nivel']==3) {echo "selected";} ?>>Alumno</option> -->
								            </select>
								        </div>
								        <input type="disabled" hidden="hidden" name="id_persona" value="<?php echo $dats['id_persona']; ?>">
			 							<div class="input-field col s6">
			 								<button name="btn" class="btn green darken-4 waves-effect waves-light center-align">Agregar</button>
			 							</div>
		 							</div>
	 							</form>
	 						</div>
	 					</div>	
 					</div>
 					<?php endif ?>
 				</div>

 			</div>
 	    	<!--Import jQuery before materialize.js-->
	    	<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  			<!-- Compiled and minified JavaScript -->
			<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
			<script src="js/validar_contraseñas.js"></script>
			<?php 

				if (empty($dats) && $_GET) {
					
					echo "<script>Materialize.toast('No se encontraron resultados', 2000, 'red accent-4');</script>";
				}
			 ?>

			<script>
				$(document).ready(function(){
					$('.collapsible').collapsible();
				  });

				$(document).ready(function() {
					$('select').material_select();
				});

				 $(document).ready(function(){
 
   					 $('.modal').modal();
  				});
				 $(".button-collapse").sideNav();
			</script>
	    </body>
  </html>