<?php  

	include_once "conexion.php";

	$id_cat = $_GET['id'];

	$sql_del = "DELETE FROM catedra WHERE id_catedra=$id_cat";

	$send_q = $conex->prepare($sql_del);
	$send_q->execute();

	header('location: catedra.php');



