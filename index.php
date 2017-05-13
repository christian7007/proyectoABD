<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Log in</title>

        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/melomanos.css" rel="stylesheet">
        <script src="js/login.js"></script>
        <script src="js/registro.js"></script>
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container-fluid">
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST"){
                require_once("src/controlador.php");
                $fields = [
                    "nombre" => validarEntrada($_POST["usuario"]),
                    "pass" => validarEntrada($_POST["pass"])];
                    
                    if (iniciarSesion($fields["nombre"], $fields["pass"]))
                        header('Location: src/home.php');
                    else
                        echo "<div class='alert alert-danger text-center'>\n<h4>El usuario o la contraseña son incorrectos</h4>\n</div>";
            }
            ?>

            <!-- Añadimos la barra -->
            <?php
            require_once("src/navbar.php"); 
            navbar(); 
            ?>

            <!-- Formulario de registros en el que se solicita nombre de usuario, contraseña y fecha de nacimiento -->
            <div class="row">
                <div class="col-md-4 col-md-push-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">Log in</div>
                        <div class="panel-body">
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" onsubmit="return validarLogin()">
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
                                            <input type="submit" class="btn btn-primary center-block" value="IniciarSesion">
                                        </div> 
                                    </div>
                                </div>
                            </form>
                            <p clas="text-center">Si no tienes cuenta registrate pinchado <a href="src/registro.php">aquí</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
