<?php 

	include_once 'conexion.php';

	$status = $_POST['status'];
	$nombre = $_POST['nomb'];
	$apellido = $_POST['apel'];
	$ced = $_POST['ced'];
	$id = $_POST['id'];
	$fecha = $_POST['fecha_nacimiento'];
	$email = $_POST['email'];
	$id_alumno = $_POST['id_alumno'];
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

	$sql_up = "UPDATE persona, alumno, alum_cat SET persona.nombre=?, persona.nombre2=?, persona.apellido=?, persona.apellido2=?, persona.cedula=?, persona.fecha_na=?, persona.email=?, persona.telefono=?, persona.direccion=?, alumno.status=? WHERE persona.id_persona=$id AND alumno.id_persona=$id AND alum_cat.id_alumno=$id_alumno";

	$up = $conex->prepare($sql_up);
	$up->execute(array($nombre1, $nombre2, $apellido1, $apellido2, $ced, $fecha, $email, $telef, $direc, $status));

	echo "<script>location.href='con_estudent.php'</script>";
 