<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    session_start(); 
    require_once("controlador.php");
    $usuario = $_SESSION["nombre"];
    $genero = validarEntrada($_POST["genero"]);
    aniadirGusto($usuario, $genero);
    header("location: miperfil.php");
}
?>