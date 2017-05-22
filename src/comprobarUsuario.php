<?php
require_once("modelo.php");
require_once("controlador.php");
if (isset($_POST["usuario"])){
   $db = conectar("localhost", "root");
   $a = existe_usuario($db, validarEntrada($_POST["usuario"]));
   
   echo $a;
   
   desconectar($db);
}
else
   echo "mierda";
?>