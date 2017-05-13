<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    require_once("controlador.php");
    $genero = validarEntrada($_POST["genero"]);
    if ($genero != ""){
        aniadirGenero($genero);
        header("location: miperfil.php");
    }
    
    echo "<link href='../css/bootstrap.min.css' rel='stylesheet'><div class='alert alert-danger text-center'>\n<h4>El genero debe tener al menos una letra</h4>\n</div>";

}

?>