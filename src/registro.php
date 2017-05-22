<!DOCTYPE html>
<html lang="en">
   <?php require_once("navbar.php"); ?>
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
      <title>Registro</title>

      <!-- Bootstrap -->
      <link href="../css/bootstrap.min.css" rel="stylesheet">
      <link href="../css/melomanos.css" rel="stylesheet">
      <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
      <link href="../css/bootstrap.min.css" rel="stylesheet">
      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <!-- Include all compiled plugins (below), or include individual files as needed -->
      <script src="../js/bootstrap.min.js"></script>
      <script src="../js/registro.js"></script>
   </head>
   <body>
      <?php
      if ($_SERVER["REQUEST_METHOD"] == "POST"){
         require_once("controlador.php");
         $fields = [
            "nombre" => validarEntrada($_POST["usuario"]),
            "pass1" => validarEntrada($_POST["pass"]),
            "pass2" => validarEntrada($_POST["pass2"]),
            "fecha" => validarEntrada($_POST["fecha"]),
            "admin" => false ];
         $tokens = explode("-", $fields["fecha"]);
         if ((strlen($fields["nombre"]) > 1) && (strlen($fields["nombre"]) < 16) && (strlen($fields["pass1"]) > 4) && (strlen($fields["pass1"]) < 16) && (strcmp($fields["pass1"], $fields["pass2"]) === 0) && (checkdate($tokens[1], $tokens[2], $tokens[0]))){
            if (registrarUsuario($fields)){
               header('Location: home.php');
            }
            echo "<div class='alert alert-danger text-center'>\n<h4>El nombre de usuario ya existe.</h4>\n</div>";
         }
         else
            "<div class='alert alert-danger text-center'>\n<h4>Error al registrar</h4>\n</div>";
      }
      ?>

      <div class="container-fluid">
         <!-- Añadimos la barra -->
         <?php navbar(); ?>

         <!-- Formulario de registros en el que se solicita nombre de usuario, contraseña y fecha de nacimiento -->
         <div class="row">
            <div class="col-md-4 col-md-push-4">
               <div class="panel panel-default">
                  <div class="panel-heading">Registro</div>
                  <div class="panel-body">
                     <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" onsubmit="return validarRegistro()">
                        <div class="row">
                           <div class="col-md-10 col-md-push-1">
                              <div class="form-group">
                                 <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span> 
                                    <input class="form-control" placeholder="Nombre de usuario *" id="ID_Usuario" name="usuario" type="text" onchange="validarUsuario()">
                                 </div>
                                 <div class="alert alert-danger alertas-registro" id="ID_Error_Usuario"></div>
                              </div>
                              <div class="form-group">
                                 <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                    <input class="form-control" placeholder="Contraseña *" id="ID_Pass" name="pass" type="password" onchange="validarContrasenya()">
                                 </div>
                                 <div class="alert alert-danger alertas-registro" id="ID_Error_Pass"></div>
                              </div>
                              <div class="form-group">
                                 <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                    <input class="form-control" placeholder="Repite contraseña *" id="ID_Pass2" name="pass2" type="password" onchange="validarContrasenya2()">
                                 </div>
                                 <div class="alert alert-danger alertas-registro" id="ID_Error_Pass2"></div>
                              </div>
                              <div class="form-group">
                                 <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                    <input class="form-control" placeholder="Fecha nacimiento *" id="ID_Fecha" name="fecha" type="date" onchange="validarFecha()">
                                 </div>
                                 <div class="alert alert-danger alertas-registro" id="ID_Error_Fecha"></div>
                              </div>
                              <div class="form-group">
                                 <input type="submit" class="btn btn-primary center-block" value="Registrarse">
                              </div>
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>

   </body>
</html>