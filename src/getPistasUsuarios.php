<?php
require_once("modelo.php");
require_once("controlador.php");
if (isset($_POST["usuario"])){
   $db = conectar("localhost", "root");
   $usuarios = get_pistas_usuarios($db, validarEntrada($_POST["usuario"]));
   desconectar($db);
   
   foreach ($usuarios as $usuario)
      echo "<option value='".$usuario."'>";
}
?>