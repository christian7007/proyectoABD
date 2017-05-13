<?php
function navbar(){
    $directoryURI = $_SERVER['REQUEST_URI'];
    $path = parse_url($directoryURI, PHP_URL_PATH);
    $components = explode('/', $path);

    echo "<nav class='navbar navbar-default'>\n";
    echo "<div class='container-fluid'>\n";
    echo "<div class='navbar-header'>\n";  
    echo "<a class='navbar-brand' href='#'>Melómanos</a>\n";    
    echo "</div>\n";

    if (session_status() == PHP_SESSION_ACTIVE){
        echo "<ul class='nav navbar-nav'>\n";
        echo "<li";
        if (in_array("home.php", $components))
            echo  " class='active'";
        echo "><a href='home.php'>Todos</a></li>\n";
        echo "<li";
        if (in_array("grupos.php", $components))
            echo  " class='active'";
        echo "><a href='grupos.php'>Grupos</a></li>\n";
        echo "<li";
        if (in_array("privados.php", $components))
            echo  " class='active'";
        echo "><a href='privados.php'>Privados</a></li>\n"; 
        echo "<li";
        if (in_array("miperfil.php", $components))
            echo  " class='active'";
        echo "><a href='miperfil.php'>Mi perfil</a></li>\n"; 
        echo "<li><a href='cerrarSesion.php'>Cerrar Sesion</a></li>\n";
        echo "</ul>";
    }

    echo "</div>\n";
    echo "</nav>\n";
}
?>