<?php  

	include_once "conexion.php";
	include_once "insert_dat.php";

	$nombre = strtoupper($_POST['nomb']);
	$apellido = strtoupper($_POST['apel']);
	$cedula = $_POST['ced'];
	$fecha = $_POST['fecha_nacimiento']; 
	$email = $_POST['email'];
	$catedra = $_POST['catedra'];
	$status = 0;
	$telef = $_POST['telefono'];
	$direc = $_POST['direccion']; 
	$fecha_ini = date('Y-m-d');
	
	insert_dat($nombre, $apellido, $cedula, $fecha, $email, $status, $catedra, $telef, $direc, $fecha_ini);


	if ($_SESSION) {


		echo "<script>location.href='con_estudent.php'</script>";

	}else{
	 echo "<script>location.href='index.php?exit'</script>";
	};