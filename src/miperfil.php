<?php session_start(); ?>
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
            <?php
            require_once("navbar.php");
            navbar();
            ?>
            <div class="nombre-perfil">
                <h2><?php echo $_SESSION["nombre"]; ?></h2>
            </div>
            <div class="row">
                <!--Grupos-->
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">Grupos</div>
                        <div class="panel-body">
                            <ul>
                                <?php 
                                require_once("controlador.php");
                                $grupos = getGrupos($_SESSION["nombre"]);

                                foreach($grupos as $grupo)
                                    echo "<li>", $grupo, "</li>";
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <!--Gustos-->
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">Gustos</div>
                        <div class="panel-body">
                            <ul>
                                <?php
                                $gustos = getGustos($_SESSION["nombre"]);
                                foreach($gustos as $gusto)
                                    echo "<li>", $gusto, "</li>";
                                ?>
                            </ul>
                            <div class="row">
                                <form action="addGusto.php" method="POST" id="addGusto-form">
                                    <div class="col-xs-2 col-xs-push-2">
                                        <select class="form-control" form="addGusto-form" name="genero">
                                            <?php 
                                            $generos =  getGeneros();
                                            foreach($generos as $genero)
                                                echo "<option>", $genero, "</option>\n";
                                            ?>
                                        </select>
                                    </div>
                                    <input type="submit" class="btn btn-default center-block" value="Añadir gusto">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php if($_SESSION["admin"] == 1): ?>
            <div class="row">
                <div class="container-fluid">
                    <div class="panel panel-default">
                        <div class="panel-heading">Opciones</div>
                        <div class="panel-body">
                            <!-- Añadir grupo -->
                            <h4 class="col-xs-10 col-xs-push-2">Añadir grupo:</h4>
                            <div class="row">
                                <div class="col-xs-12">
                                    <form action="" method="GET" id="comment-form">
                                        <div class="col-xs-2 col-xs-push-2">
                                            <input type="number" class="form-control" id="edad" placeholder="Edad">
                                        </div>
                                        <div class="col-xs-2 col-xs-push-2">
                                            <select class="form-control">
                                                <?php 
                                                $generos =  getGeneros();
                                                foreach($generos as $genero)
                                                    echo "<option>", $genero, "</option>\n";
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-xs-3 col-xs-push-2">
                                            <input type="submit" class="btn btn-default center-block" value="ok">
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- Añadir genero -->
                            <h4 class="col-xs-10 col-xs-push-2">Añadir genero:</h4>
                            <div class="row">
                                <div class="col-xs-12">
                                    <form action="nuevoGenero.php" method="POST" id="genero-form">
                                        <div class="col-xs-4 col-xs-push-2">
                                            <input type="text" form="genero-form" class="form-control" id="genero" name="genero" placeholder="Genero">
                                        </div>
                                        <div class="col-xs-3 col-xs-push-2">
                                            <input type="submit" class="btn btn-default center-block" value="ok">
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- Hacer admin -->
                            <h4 class="col-xs-10 col-xs-push-2">Hacer administrador:</h4>
                            <div class="row">
                                <div class="col-xs-12">
                                    <form action="hacerAdmin.php" method="POST" id="admin-form">
                                        <div class="col-xs-4 col-xs-push-2">
                                            <input type="text" form="admin-form" class="form-control" id="usr-premium" name="usuario" placeholder="Nombre usuario">
                                        </div>
                                        <div class="col-xs-3 col-xs-push-2">
                                            <input type="submit" class="btn btn-default center-block" value="ok">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif ?>
        </div>
    </body>
</html>