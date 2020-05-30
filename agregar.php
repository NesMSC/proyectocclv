<?php 
	
	include_once "conexion.php";
	include_once "insert_dat.php";

	session_start();

	if ($_POST) {

		$cedula_alumno = $_POST['ced'];

		$query_buscar = "SELECT persona.id_persona, alumno.id_alumno FROM persona INNER JOIN alumno ON persona.id_persona=alumno.id_persona WHERE persona.cedula='$cedula_alumno'";

		$send_q = $conex->prepare($query_buscar);
		$send_q->execute();
		
		$dato = $send_q->fetch();
	
		if (!is_null($dato['id_alumno']) || !is_null($dato['id_persona'])) {
			
			echo "<script> 

					alert('Los datos ingresados ya existen'); 

				</script>";

				if ($_SESSION['nivel']!=2) {
				
					echo "<script>location.href='con_estudent.php'</script>";
				}else{
					echo "<script>location.href='u_profesor.php'</script>";
				};
			
				

		}else{

			$nombre = $_POST['nomb'];
			$apell = $_POST['apel'];
			$ced = $_POST['ced'];
			$fecha = $_POST['fecha_nacimiento'];
			$email = $_POST['email'];
			$status = 1;
			$catedra = $_POST['catedra'];
			$telef = $_POST['telefono'];
			$direc = $_POST['direccion']; 
			$fecha_ini = date('Y-m-d');

			insert_dat($nombre, $apell, $ced, $fecha, $email, $status, $catedra, $telef, $direc, $fecha_ini);


			if ($_SESSION['nivel']!=2) {
				
					echo "<script>location.href='con_estudent.php'</script>";
				}else{
					echo "<script>location.href='u_profesor.php?cat="."$catedra'"."</script>";
				};

		};
		

	};


 ?>