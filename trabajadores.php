<?php 

include_once "conexion.php";

session_start();

if (isset($_SESSION['verificado'])) {
	

		$sql = (isset($_GET['prf']))? "SELECT persona.id_persona, persona.nombre, persona.apellido, persona.cedula, profesor.id_profesor FROM persona INNER JOIN profesor  ON persona.id_persona=profesor.id_persona":"SELECT persona.id_persona, persona.nombre, persona.apellido, persona.cedula, usuario.id_nivel FROM persona INNER JOIN usuario INNER JOIN nivel ON persona.id_persona=usuario.id_persona AND usuario.id_nivel=nivel.id_nivel WHERE usuario.id_nivel=1";

		$send_q = $conex->prepare($sql);
		$send_q->execute();

		$dats = $send_q->fetchAll();

		if (isset($_GET['per_id'])) {
			
			$id = $_GET['per_id'];

			$dat_sql = "SELECT * FROM persona WHERE id_persona=$id";

			$send_sql = $conex->prepare($dat_sql);
			$send_sql->execute();

			$per_dat = $send_sql->fetch();

		};
	
}else{

	echo "<script>location.href='index.php'</script>";
};


	include_once 'nav&side.php';
 ?>


 		<div class="col s12 m10 l8">
 			<div class="row section">

 				<?php if(!isset($_GET['per_id'])): ?>

 				<div class="col s6">
					<select onchange="location=this.value">
						<option value="trabajadores.php" <?php if (!$_GET) {echo "selected";}?>>Administrativo</option>
						<option value="trabajadores.php?prf" <?php if (isset($_GET['prf'])) {echo "selected";}?>>Profesores</option>
					</select>
				</div>

				<div class="col s12">	
					<table>
					<thead>
						<tr>
			            	<th>Nombre</th>
			            	<th>Apellido</th>
			  				<th>Cédula</th>
			  				<th>Acción</th>
			        	</tr>
			        </thead>
					<tbody>
					<?php foreach ($dats as $dat): ?>

						<?php if($dat['nombre']!='admin' && $dat['apellido']!='admin'): ?>

						<tr>          		
							<th><?php echo $dat['nombre']; ?></th>
							<th><?php echo $dat['apellido']; ?></th>
							<th><?php echo $dat['cedula']; ?></th>
							<th>					          			
							    <a href="?per_id=<?php echo $dat['id_persona'];?>"><i class="material-icons">edit</i></a>
								<a href="<?php $id=$dat["id_persona"]; echo 'eliminar.php?id='.$id; ?>&per"><i class="material-icons">delete</i></a>
								<a href="<?php $id=$dat["id_persona"]; echo 'perfil_al.php?id_per='.$id; ?>"><i class="material-icons">visibility</i></a>
							</th>
						</tr>

						<?php endif ?>

					<?php endforeach ?>
					</tbody>
		      	</table>
		      	<a href="agregar_per.php?per<?php if(isset($_GET['prf'])){echo '&prf';} ?>" class="waves-effect waves-light btn green darken-4">Agregar</a>
		    </div>

		    <?php endif ?>
		        <?php if (isset($_GET["per_id"])): ?>
      				<h2>EDITAR</h2>
      				<form class="col s12" action="editar_per.php" method="POST">
      					<?php include_once "formulario_agg.php" ?>
				        <div class="row">
				            <div class="input-field col s6">
				                <button type="submit" class="btn green darken-4 waves-effect waves-light" name="id" value="<?php echo $per_dat['id_persona']; ?>">GUARDAR<i class="material-icons right">send</i></button>
				            </div>
				        </div>
				    </form>
      			<?php endif ?>

 			</div>
 		</div>

 		
		

		</div>
	    <!--Import jQuery before materialize.js-->
	    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  		<!-- Compiled and minified JavaScript -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>

		<script>
			$(document).ready(function(){
				$('.collapsible').collapsible();
			});

			$(document).ready(function() {
				$('select').material_select();
				$(".button-collapse").sideNav();
			});
		</script>
	</body>
</html>