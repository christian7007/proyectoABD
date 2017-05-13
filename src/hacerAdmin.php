<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    require_once("controlador.php");
    $usuario = validarEntrada($_POST["usuario"]);
    if ($usuario != ""){
        if(hacerAdmin($usuario))
            header("location: miperfil.php");
        else
            echo "<link href='../css/bootstrap.min.css' rel='stylesheet'><div class='alert alert-danger text-center'>\n<h4>El usuario dado no existe</h4>\n</div>";
    }
    else
        echo "<link href='../css/bootstrap.min.css' rel='stylesheet'><div class='alert alert-danger text-center'>\n<h4>El nombre de usuario debe tener al menos una letra</h4>\n</div>";
}
?>