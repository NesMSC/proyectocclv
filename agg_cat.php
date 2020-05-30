<?php  

	include_once 'conexion.php';

	$cat_nomb = strtoupper($_POST['cat_nomb']);
	 
	$profe_id = $_POST['prf'];

	
	$sql = "INSERT INTO catedra(cat_nombre, id_profesor) VALUES (?, ?)";

	$send_cat = $conex->prepare($sql);

	$send_cat->execute(array($cat_nomb, $profe_id));

	echo "<script>location.href='catedra.php'</script>";  
