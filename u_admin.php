<?php 
	include_once 'conexion.php';

	session_start();


	if (isset($_SESSION['verificado'])) {


		if (!$_SESSION['nivel']==1) {

			echo "<script>location.href='index.php'</script>";
	
		};

	}else{

		echo "<script>location.href='index.php'</script>";
	};
		
		

	include_once "nav&side.php";



 ?>



 			<div class="col m8 14">
 				<div align="center" class="row section">
 					<div class="col s12 m8 l10">
 						<img  src="img/Logo.png">
 					</div>
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