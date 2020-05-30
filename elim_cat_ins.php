<?php 

	include_once 'conexion.php';

	$id_ins = $_GET['id_al'];
	$id_per = $_GET['id'];
	$id_cat = $_GET['id_cat'];

	$sql_elim_ins = "DELETE FROM alum_cat WHERE id_alumno=$id_ins AND id_catedra=$id_cat";

	$sql_elim = $conex->prepare($sql_elim_ins);
	$sql_elim->execute();

	header("location:editar_alumno.php?id=$id_per&id_al=$id_ins");
