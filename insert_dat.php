<?php 

	function insert_dat($nomb, $apell, $ced, $fecha_na, $email, $status, $catedra, $telef, $direc, $fecha_ini){

		global $conex;

		//Inserta datos personales de profesores, administrador y alumnos

		$nombre1 = strtoupper(substr($nomb, 0, strpos($nomb, " ")));
		$nombre2 = strtoupper(substr($nomb, strpos($nomb, " ")));

		$apellido1 = strtoupper(substr($apell, 0, strpos($apell, " ")));
		$apellido2 = strtoupper(substr($apell, strpos($apell, " ")));

		if (empty($nombre1)) {
			
			$nombre1 = $nombre2;
			$nombre2="";

		};

		if(empty($apellido1)){

			$apellido1 = $apellido2;
			$apellido2="";
		};

		$sql = "INSERT INTO persona(nombre, nombre2, apellido, apellido2, cedula, fecha_na, email, telefono, direccion) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

		$send_q = $conex->prepare($sql);
		$send_q->execute(array($nombre1, $nombre2, $apellido1, $apellido2, $ced, $fecha_na, $email, $telef, $direc));

		//Busca la id de la persona registrada

		$buscar = "SELECT id_persona FROM persona WHERE cedula = $ced";

		$buscar_q = $conex->prepare($buscar);
		$buscar_q->execute();

		$dato = $buscar_q->fetch();

		$id_persona = $dato['id_persona'];



		if (isset($_GET['per']) && isset($_GET['prf'])) {

			//Agregar profesor

			$sql_prf = "INSERT INTO profesor(id_persona) VALUES($id_persona)";

			$send_prf = $conex->prepare($sql_prf);
			$send_prf->execute();

		}else{

			//Inserta datos del alumno		

			$alumno_agg = "INSERT INTO alumno(id_persona, status, fecha_ini) VALUES (?,?,?)";

			$send_agg = $conex->prepare($alumno_agg);
			$send_agg->execute(array($id_persona, $status, $fecha_ini));


			//Inserta catedra

			$consulta_sql = "SELECT id_alumno FROM alumno WHERE id_persona=$id_persona";

			$send_sql = $conex->prepare($consulta_sql);
			$send_sql->execute();
			$dat_id = $send_sql->fetch();

			$id_alumno = $dat_id['id_alumno'];

			$catedra_agg = "INSERT INTO alum_cat(id_alumno, id_catedra) VALUES (?,?)";

			$send_agg = $conex->prepare($catedra_agg);
			$send_agg->execute(array($id_alumno, $catedra));
		}; 

	};

?>