<?php 

//Editar personal

include_once 'conexion.php';

	$nombre = $_POST['nomb'];
	$apellido = $_POST['apel'];
	$ced = $_POST['ced'];
	$id = $_POST['id'];
	$fecha = $_POST['fecha_nacimiento'];
	$email = $_POST['email'];
	$telef = $_POST['telefono'];
	$direc = $_POST['direccion'];

	$nombre1 = strtoupper(substr($nombre, 0, strpos($nombre, " ")));
	$nombre2 = strtoupper(substr($nombre, strpos($nombre, " ")));

	$apellido1 = strtoupper(substr($apellido, 0, strpos($apellido, " ")));
	$apellido2 = strtoupper(substr($apellido, strpos($apellido, " ")));

	if (empty($nombre1)) {
			
		$nombre1 = $nombre2;
		$nombre2="";
	};

	if(empty($apellido1)){

		$apellido1 = $apellido2;
		$apellido2="";
	};

	$sql_up = "UPDATE persona SET nombre=?, nombre2=?, apellido=?, apellido2=?, cedula=?, fecha_na=?, email=?, telefono=?, direccion=? WHERE id_persona=$id";

	$up = $conex->prepare($sql_up);
	$up->execute(array($nombre1, $nombre2, $apellido1, $apellido2, $ced, $fecha, $email, $telef, $direc));

	echo "<script>location.href='trabajadores.php'</script>";