<?php  
include 'conexion.php';

	$username = $_POST['username'];
	$pass = $_POST['password'];
	$nivel = $_POST['nivel'];
	$id_persona = $_POST['id_persona'];

	$pass = password_hash($pass, PASSWORD_DEFAULT);

	$sql = "UPDATE usuario SET usuario=?, contrasena=?, id_nivel=? WHERE id_persona=$id_persona";

	$sql_agg = $conex->prepare($sql);
	$sql_agg->execute(array($username, $pass, $nivel));

	header("location: usuarios.php?s_query=$id_persona");

