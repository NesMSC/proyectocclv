<?php 
	include_once 'conexion.php';

	if (isset($_SESSION['verificado'])) {


		$sql_cat = "SELECT catedra.id_catedra, catedra.cat_nombre, persona.id_persona, persona.nombre, persona.apellido FROM catedra INNER JOIN profesor INNER JOIN persona ON catedra.id_profesor=profesor.id_profesor AND profesor.id_persona=persona.id_persona";

		$send_q = $conex->prepare($sql_cat);

		$send_q->execute();

		$dats = $send_q->fetchAll();

	}else{

		echo "<script>location.href='index.php'</script>";
	};



 ?>

<div id="modal_cat" class="modal">
	 <div class="modal-content">
 		<div class="col s12">
 			<div class="row">
 				<div class="col s12">
      				<h3><i>Catedras disponibles</i></h3>
 				</div>
 				<div class="col s12">
 					<table class=" highlight">
				    	<thead>
					       	<tr>
					            <th>Nombre</th>
					            <th>Profesor</th>
					            <th>Acción</th>
					        </tr>
					    </thead>
					    <tbody>
					    <?php foreach ($dats as $dat): ?>
					        <tr>
								<th><?php echo $dat['cat_nombre']; ?></th>
						        <th><?php echo $dat['nombre']." ".$dat['apellido']; ?></th>
						        <th><a href="asignar.php?id_al=<?php echo $_GET['id_al'].'&cat='.$dat['id_catedra']; 
						        	if(isset($_GET['float'])){
						        		echo '&float=1';

						        	}elseif(isset($_GET['id'])){

						        		echo "&id=".$_GET['id'];

						        	};?>">Inscribir</a></th>
						          	
					        </tr>
					    <?php endforeach ?>
					    </tbody>
      				</table>
 				</div>	
 			</div>
 		</div>
	</div>
</div>