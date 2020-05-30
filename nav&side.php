<?php 


	$nivel=$_SESSION['nivel'];

 ?>
<!DOCTYPE html>
	<html>
	    <head>
	    	<meta charset="utf-8">
		    <!--Import Google Icon Font-->
		    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
			<!-- Compiled and minified CSS -->
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
		    <!--Let browser know website is optimized for mobile-->
		    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		    <link rel="stylesheet" type="text/css" href="css/side-nav-style.css">
	    </head>

	    <body>




				<nav class="amber accent-3">

					<div class="nav-wrapper row">
					

					    <ul id="nav-mobile" class="left hide-on-med-and-down col s8 m6">

						    <li><a class="black-text" href="<?php if($nivel==1){echo 'u_admin.php';}elseif($nivel==2){echo 'u_profesor.php';} ?>">Inicio</a></li>
					    </ul>

					    <div class="col s4 m6 hide-on-med-and-down">

			                <ul id="nav-mobile" class="right">
			                 	<a href="#" class="dropdown-button black-text" data-beloworigin="true" data-activates="drop-content">&nbsp&nbsp<li><i class="material-icons left black-text">arrow_drop_down</i><?php if ($nivel==1) {
			                 		echo "Administrador";
			                 	}elseif ($nivel==2) {
			                 		echo "Profesor";
			                 	}elseif ($nivel==3) {
			                 		echo "Estudiante";
			                 	} ?></li></a>
			                </ul>
			                <ul id="drop-content" class="dropdown-content">
				             
				                <li><a href="logout.php" class="black-text">Cerrar sesión</a></li>
			                </ul>            
			            </div>

			            <ul id="side" class="side-nav">
							
							<?php if ($nivel==1): ?>
										
								<li><a href="con_estudent.php">Estudiantes</a></li>
								<li><a href="trabajadores.php">Personal</a></li>
								<li><a href="usuarios.php">Usuarios y cuentas</a></li>
								<li><a href="catedra.php">Cátedras</a></li>

							<?php endif ?>
							<?php if ($nivel==2): ?>

								<li><a href="u_profesor.php">Mis alumnos</a></li>
											
							<?php endif ?>
							<li><a href="logout.php" class="black-text">Cerrar sesión</a></li>
					</ul>
					<a href="#" data-activates="side" class="button-collapse"><i class="material-icons">menu</i></a>
						
			        </div>

				</nav>
			

			        
						
				
	

				
			

			<div class="row">
				<div class="col m1 l4 hide-on-small-only">
	                <ul class="side-nav fixed">
						<li class="no-padding">
							<ul>
								<li>
									<ul>
										<?php if ($nivel==1): ?>
										
										<li><a href="con_estudent.php">Estudiantes</a></li>
										<li><a href="trabajadores.php">Personal</a></li>
										<li><a href="usuarios.php">Usuarios y cuentas</a></li>
										<li><a href="catedra.php">Cátedras</a></li>

										<?php endif ?>
										<?php if ($nivel==2): ?>

											<li><a href="u_profesor.php">Mis alumnos</a></li>
											
										<?php endif ?>
							        </ul>
								</li>
							</ul>
						</li>
	                </ul>
				</div>