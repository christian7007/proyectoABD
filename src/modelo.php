<?php
    function conectar($host, $usuario, $contrasenia=""){
        $db = mysqli_connect($host, $usuario, $contrasenia);
        
        if (!$db) 
            printf("Error %d: %s.<br>", mysqli_connect_errno(), mysqli_connect_error());
        else
            mysqli_select_db($db, "proyectoabd");
            
        return $db;
    }

    function desconectar($conexion){
        if ($conexion){
            $ok = mysqli_close($conexion);
            
            if (!$ok) 
                echo "Fallo en la desconexion.<br>";
          
        }
        else
            echo "Conexion no abierta. <br>";
    }

    function aniadir_usuario($conexion, $nombre, $pass, $f_nacimiento, $admin){
        //hasheamos la contraseña
        $pass = hash("sha512", $pass);
        //preparamos la consulta
        $query = "INSERT INTO usuario VALUES (?, ?, ?, ?)";
        $consulta = mysqli_prepare($conexion, $query);
        //enlazamos con los parametros
        $ok = mysqli_stmt_bind_param($consulta, "ssss", $nombre, $pass, $f_nacimiento, $admin);
        $ok = mysqli_stmt_execute($consulta);
    }

    function iniciar_sesion($conexion, $nombre_usuario, $pass){
        //preparamos la consulta
        $query = "SELECT pass FROM usuario WHERE nombre = ?";
        $consulta = mysqli_prepare($conexion, $query);
        //enlazamos con los parametros
        $ok = mysqli_stmt_bind_param($consulta, "s", $nombre_usuario);
        $ok = mysqli_stmt_execute($consulta);
        $ok = mysqli_stmt_bind_result($consulta, $pass_bd);
        //cogemos el resultado
        mysqli_stmt_fetch($consulta);
        
        if (hash("sha512", $pass) == $pass_bd){
            session_start();
            $_SESSION["name"] = $nombre_usuario;
        }
        else
            echo "<h2>Mal<h2>";
    }

    function cerrar_sesion(){
        session_unset();
        session_destroy();
    }
    
    function a(){
        echo "AAAAAAAAAAAAAAAAAAAA";
    }
?>

<h1>Prueba</h1>
<form method="post" action="a()">
    <input type="text" name="nombre" value="ch"/>
    <input type="submit" value="enviar"/>
</form>
