<?php 

	include_once 'conexion.php';

	$alumno_id = $_GET['id_al'];
	$persona_id = $_GET['id'];

	$cat_id = $_GET['cat'];

	$sql_asignar = "INSERT INTO alum_cat(id_alumno, id_catedra) VALUES (?,?)";

	$send_asign = $conex->prepare($sql_asignar);

	$send_asign->execute(array($alumno_id, $cat_id));

	if (isset($_GET['float'])) {

		echo "<script>location.href='con_estudent.php';</script>";

	}else{

		echo "<script>location.href='editar_alumno.php?id=$persona_id&id_al=$alumno_id';</script>";
	};

	

	


 ?>