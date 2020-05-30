<?php  

include 'conexion.php';

	$username = $_POST['username'];
	$pass = $_POST['password'];
	$nivel = $_POST['nivel'];
	$id_persona = $_POST['id_persona'];

	//hash de contraseña

    $pass = password_hash($pass, PASSWORD_DEFAULT);

    
    	$sql = "INSERT INTO usuario(usuario, contrasena, id_nivel, id_persona) VALUES(?, ?, ?, ?)";

		$sql_agg = $conex->prepare($sql);
		$sql_agg->execute(array($username, $pass, $nivel, $id_persona));

		header("location: usuarios.php?s_query=$id_persona");


	