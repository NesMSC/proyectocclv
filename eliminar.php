<?php 

	include_once 'conexion.php';

	$id = $_GET['id'];

	$del_sql = "DELETE FROM persona WHERE id_persona=$id";

	$del = $conex->prepare($del_sql);
	$del->execute();

	if (isset($_GET['per'])) {
		
		header('location:trabajadores.php');
		
	}else{

		header('location:con_estudent.php');

	}

	
 ?>