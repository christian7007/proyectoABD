<?php 
session_start(); 
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    require_once("controlador.php");
    $mensaje = validarEntrada($_POST["mensaje"]);
    $usuario = $_SESSION["nombre"];
    $grupo = "TODOS";
    $fecha = date("y-m-d H:i:s");

    enviarMensajeGrupo($usuario, $grupo, $mensaje, $fecha);
    //para evitar que si usamos f5 se vuelva a insertar el mensaje
    header("Location: ".htmlspecialchars($_SERVER["PHP_SELF"]));
}
?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Todos</title>

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
            $mensajes = getMensajesGrupo("TODOS", date("y-m-d H:i:s"));

            foreach($mensajes as $mensaje){
                echo "<div>\n
                        <div class='comment-content col-md-8 col-md-push-2 col-xs-12'>\n
                            <div class='row'>\n
                                <div class='panel panel-default'>\n
                                    <div class='panel-heading comment-heading'>\n
                                        <div>\n
                                            <h4>".$mensaje["emisor"]."<h4>\n
                                            <h6>".$mensaje["fecha"]."<h6>\n
                                        </div>\n
                                    </div>\n
                                    <div class='panel-body'>\n
                                        <p>".$mensaje["mensaje"]."</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>";
            }
            ?>

            <div class="col-xs-12 col-md-8 col-md-push-2">
                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-heading comment-heading">
                            <div>
                                <h4>Enviar mensaje</h4>
                            </div>
                        </div>
                        <div class="panel-body">
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" id="todos-form">
                                <textarea class="col-md-12 form-control" form="todos-form" name="mensaje"></textarea>
                                <br>
                                <input type="submit" value="Enviar" class="btn btn-primary pull-right">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>