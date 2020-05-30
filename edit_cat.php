<?php 
	
	include_once "conexion.php";

	$cat_nombre = $_POST['cat_nomb'];
	$id_prf = $_POST['prf'];
	$id_catedra = $_POST['id_cat'];


	$sql_actualizar = "UPDATE catedra SET cat_nombre=?, id_profesor=?WHERE id_catedra=$id_catedra;";

	$send_sql=$conex->prepare($sql_actualizar);
	$send_sql->execute(array($cat_nombre, $id_prf));

	echo "<script>location.href='catedra.php'</script>";

 ?>