<?php 
session_start(); 
if ($_SERVER["REQUEST_METHOD"] == "POST"){
   require_once("controlador.php");
   $mensaje = validarEntrada($_POST["mensaje"]);
   $usuarioDest = validarEntrada($_POST["usuarioDest"]);
   $usuario = $_SESSION["nombre"];
   $fecha = date("y-m-d H:i:s");

   if (($usuarioDest != "") && ($mensaje != "")){
      if(enviarMensajePrivado($usuarioDest, $usuario, $mensaje, $fecha))
         header("Location: ".htmlspecialchars($_SERVER["PHP_SELF"]));//para evitar que si usamos f5 se vuelva a insertar el mensaje
      else
         header("Location: errorMensaje.html");;
   }
   else
      header("Location: errorMensaje.html");
}
?>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
      <title>Privados</title>

      <!-- Bootstrap -->
      <link href="../css/bootstrap.min.css" rel="stylesheet">
      <link href="../css/melomanos.css" rel="stylesheet">
      <script src="../js/registro.js"></script>
      <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <!-- Include all compiled plugins (below), or include individual files as needed -->
      <script src="../js/bootstrap.min.js"></script>

   </head>
   <body>
      <div class="container-fluid">
         <!-- Añadimos la barra -->
         <?php
         require_once("navbar.php");
         require_once("controlador.php");

         navbar();
         $mensajesEnviados = getMensajesPrivadosEnviados($_SESSION["nombre"]);
         $mensajesRecibidos = getMensajesPrivadosRecibidos($_SESSION["nombre"]);
         $arrayMensajes = array($mensajesEnviados, $mensajesRecibidos);
         $tipo = "Enviados";
         $clave = "destinatario";
         foreach ($arrayMensajes as $mensajes){

            echo "<div class='col-xs-12 col-md-8 col-md-push-2'><div class='row'><div class='panel panel-default'>
                            <div class='panel-heading'>
                               <h4 class='panel-title'>
                                   <a data-toggle='collapse' data-parent='#accordion' href='#collapse".$tipo."'>".$tipo."</a>
                                </h4>
                            </div>
                            <div id='collapse".$tipo."' class='panel-collapse collapse'>
                                <div class='panel-body'>";

            foreach($mensajes as $mensaje){
               echo "
                        <div class='comment-content'>
                            <div class='row col-md-12'>
                                <div class='panel panel-default'>
                                    <div class='panel-heading comment-heading col-xs-12'>
                                        <div>
                                            <h4>".$mensaje[$clave]."<h4>
                                            <h6>".$mensaje["fecha"]."<h6>\n
                                        </div>
                                    </div>
                                    <div class='panel-body'>
                                        <p>".$mensaje["mensaje"]."</p>
                                    </div>
                                </div>
                            </div>
                        </div>";
            }

            echo "</div></div></div></div></div>";
            $tipo = "Recibidos";
            $clave = "emisor";
         }
         ?>

         <div class="comment-content col-xs-12 col-md-8 col-md-push-2">
            <div class="row">
               <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" id="privados-form">
                  <div class="panel panel-default">
                     <div class="panel-heading comment-heading">
                        <div class="row">
                           <div class="col-xs-12">
                              <div class="col-xs-3">
                                 <h4>Enviar mensaje</h4>
                              </div>
                              <div class="col-xs-5">
                                 <input class="form-control" placeholder="Destinatario" id="ID_UsuarioDest" name="usuarioDest" type="text">
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="panel-body">
                        <textarea class="col-md-12 form-control" form="privados-form" name="mensaje"></textarea>
                        <br>
                        <input type="submit" id="comment-btn" value="Enviar" class="btn btn-primary pull-right">
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </body>
</html>