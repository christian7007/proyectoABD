<?php
require_once("modelo.php");
require_once("controlador.php");
if (isset($_POST["usuario"])){
   $db = conectar("localhost", "root");
   $existe = existe_usuario($db, validarEntrada($_POST["usuario"]));
   
   echo $existe;
   
   desconectar($db);
}
?>