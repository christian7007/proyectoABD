<?php
    require_once("controlador.php");
    cerarrSesion();
    echo "sesion cerrad";
    header('Location: ../index.php');
?>