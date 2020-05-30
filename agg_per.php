<?php  
	
	include 'conexion.php';
	include 'insert_dat.php';

	if ($_POST) {

		$cedula_per = $_POST['ced'];

		$query_buscar = "SELECT id_persona FROM persona WHERE cedula='$cedula_per'";

		$send_q = $conex->prepare($query_buscar);
		$send_q->execute();
		
		$dato = $send_q->fetch();
	
		if (!is_null($dato['id_persona'])) {
			
			echo "<script> 

					alert('Los datos ingresados ya existen'); 

					window.location='trabajadores.php';
				</script>";
			

		}else{

			$nombre = $_POST['nomb'];
			$apell = $_POST['apel'];
			$ced = $_POST['ced'];
			$fecha = $_POST['fecha_nacimiento'];
			$email = $_POST['email'];
			$status = null;
			$catedra = null;
			$telef = $_POST['telefono'];
			$direc = $_POST['direccion']; 
			$fecha_ini = null;

			$pos_nm = strpos($nombre, " ");

			

			insert_dat($nombre, $apell, $ced, $fecha, $email, $status, $catedra, $telef, $direc, $fecha_ini);

			echo "<script>location.href='trabajadores.php'</script>";

		};
		

	};