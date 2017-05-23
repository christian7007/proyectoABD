<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
   require_once("controlador.php");
   $edadmax = validarEntrada($_POST["edadmax"]);
   $edadmin = validarEntrada($_POST["edadmin"]);
   $genero = validarEntrada($_POST["genero"]);

   if ($edadmax != "" && $edadmin != "" && $genero != ""){
      $nombre = "".$edadmin."-".$edadmax.$genero;
      if (crearGrupo($edadmin, $edadmax, $genero, $nombre))
         header("location: miperfil.php");
      else
         echo "<link href='../css/bootstrap.min.css' rel='stylesheet'><div class='alert alert-danger text-center'>\n<h4>No se pudo crear el grupo</h4>\n</div>";

   }
   else
       echo "<link href='../css/bootstrap.min.css' rel='stylesheet'><div class='alert alert-danger text-center'>\n<h4>No se pueden dejar campos en blanco</h4>\n</div>";

}
?>