<?php 
    include_once 'conexion.php';

    session_start();

    if (isset($_SESSION['verificado'])) {
        
        if ($_SESSION['nivel']==1) {
            
            echo "<script>location.href='u_admin.php'</script>";

        }elseif ($_SESSION['nivel']==2) {

            echo "<script>location.href='u_profesor.php'</script>";
        };

    };

    //Verificar usuario

    if ($_POST) {
        
        $user = $_POST['user'];
        $pass = $_POST['password'];

        $sql = "SELECT usuario, contrasena, id_nivel, id_persona FROM usuario WHERE usuario = '$user'";

        $send_q = $conex->prepare($sql);
        $send_q->execute();
        $dats = $send_q->fetch();

        $nivel = $dats['id_nivel'];
        $pass2 = $dats['contrasena'];

       
        
            if ($nivel == 1 && password_verify($pass, $pass2)) {

                $_SESSION['verificado']=1;
                $_SESSION['nivel']=$nivel;
                $_SESSION['id_persona']=$dats['id_persona'];
                 
                echo "<script>location.href='u_admin.php'</script>";

             }elseif ($nivel==2 && password_verify($pass, $pass2)){

                $_SESSION['verificado']=1;
                $_SESSION['nivel']=$nivel;
                $_SESSION['id_persona']=$dats['id_persona'];

                $id_persona = $_SESSION['id_persona'];

                $sql_prf = "SELECT id_profesor FROM profesor WHERE id_persona = $id_persona";

                $send_qprf = $conex->prepare($sql_prf);
                $send_qprf->execute();
                $dat_prf = $send_qprf->fetch();

                $_SESSION['id_profesor']=$dat_prf['id_profesor'];

                echo "<script>location.href='u_profesor.php'</script>";

            }else{

                $err=true;
             };
    };

 ?>

<!DOCTYPE html>
  <html>
    <head>
        <title>Ingresar</title>
        <meta charset="utf-8">
        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>     <!--Import Google Icon Font-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!-- Compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
        <!--Estilos añadidos-->
        <link rel="stylesheet" type="text/css" href="css/index_estilos.css">
    </head>

    <body>

        <div class="banner">
        <header id="navbar" class="navbar-fixed" style="transition: top 0.5s;">
                <nav class="amber accent-3 " >
                    <div class="nav-wrapper">
                        <ul class="nav-mobile">
                            <li><a href="#inscripcion" class="black-text modal-trigger">Pre-inscripcion</a></li>
                        </ul>
                    </div>
                </nav>
        </header>
        <div class="row">
        
            <div id="inscripcion" class="modal">
                    <div class="modal-content">
                        <form class="col s12" action="preinscripcion.php" method="POST">
                            <?php include_once "formulario_agg.php"; ?>
                            <div class="input-field col s6">
                                <button class="btn green darken-4 waves-effect waves-light center-align">Enviar</button>
                            </div>
                        </form>
                    </div>
                </div>

            <div class="col s12 m6  l5 offset-l7 offset-m6">
                <form class="card" method="POST" action="index.php">
                    
                <div class="card-content">
                    <div class="card-title">     
                        <h1>INGRESAR</h1>
                    </div>       
                    <?php if (isset($err)) {
                        echo "<p class='red-text text-darken-4'>Usuario o contraseña invalida, verifique y vuelva a intentar.</p>";
                    }; ?>
                    <div class="input-field">
                        <label for="username" class="black-text">Usuario</label>     
                        <input type="text" id="username" name="user" required="required" class="validate">
                    </div>
                    <div class="input-field">
                        <label for="password" class="black-text">Contraseña</label>
                        <input type="password" id="password" name="password" required="required" class="validate">
                    </div>

                    <input type="checkbox" id="test5"/>
                    <label for="test5" class="black-text">Recordar</label>
                    
                    <div class="input-field center-align">
                        <button class="btn-large waves-effect waves-light black-text amber accent-3">Iniciar</button>
                    </div>
                </div>
                </form>

            </div>
        </div>

    </div>

        <footer class="page-footer white">
          <div class="container">
            <div class="row">

              <div class="col l4 m4 s12">
                <h5 class="black-text">REDES SOCIALES</h5>

              </div>
              <div class="col l4 m4 s12">
                  <h5 class="black-text">DIRECCIÓN</h5>
                  <P class="black-text">PARROQUIA CATEDRAL CIUDAD BOLIVAR-ESTADO BOLIVAR</P>
              </div>
              <div class="col l4 m4 s12">
                  <h5 class="black-text">CONTÁCTENOS</h5>
                  <p class="black-text">(0285) 6341685</p>
              </div>
            </div>
          </div>
          <div class="footer-copyright">
            <div class="container">
               <p class="grey-text"> Casa de la Cultura "Carlos Raúl Villanueva" © 2019 </p>
            </div>
          </div>
        </footer>

        <!-- Jquery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <!-- Compiled and minified JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
        <!-- Efecto desplazamiento -->
        <script type="text/javascript" src="js/efecto_desplazamiento.js"></script>

        <script>

                $(document).ready(function(){

                $('.scrollspy').scrollSpy({scrollOffset:5});

                $(document).ready(function(){
                    // the "href" attribute of the modal trigger must specify the modal ID that wants to be triggered
                    $('.modal').modal();

                      <?php if (isset($_GET['exit'])){
                   
                        echo "alert('Pre-inscripcion realizada exitosamene. Nos estaremos comunicando via correo electrónico')";
                        };?>
                });

            });

            $(document).ready(function() {
            $('select').material_select();
            });
        </script>
    </body>
  </html>