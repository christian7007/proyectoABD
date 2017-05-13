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

function aniadir_mensaje_grupo($conexion, $emisor, $grupo, $mensaje, $fecha){
    $stmt = $conexion->prepare("INSERT INTO mensajes (emisor, grupoDestinatario, mensaje, fecha) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $emisor, $grupo, $mensaje, $fecha);
    $stmt->execute();
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

    return $ok;
}

function aniadir_usuario_grupo($conexion, $usuario, $grupo){
    $stmt = $conexion->prepare("INSERT INTO grupos VALUES (?, ?)");
    $stmt->bind_param("ss", $grupo, $usuario);
    $stmt->execute();
    $stmt->close();
}

function existe_usuario($conexion, $usuario){
    //creamos el prepare statement
    $stmt = $conexion->prepare("SELECT nombre FROM usuario WHERE nombre = ?");
    //ligamos los parametros
    $stmt->bind_param("s", $usuario);
    //ejecutamos la consulta
    $stmt->execute();
    //ligamos variables de resultado
    $stmt->store_result();

    if ($stmt->num_rows > 0){
        $stmt->close();
        return true;
    }

    $stmt->close();
    return false;
}

function get_mensajes_grupo($conexion, $grupo, $fecha){
    $stmt = $conexion->prepare("SELECT emisor, mensaje, fecha, grupoDestinatario FROM mensajes WHERE grupoDestinatario = ? AND fecha <= ? ORDER BY 3 DESC");
    $stmt->bind_param("ss", $grupo, $fecha);
    $stmt->execute();
    $stmt->bind_result($col1, $col2, $col3, $col4);
    $array = array();

    while ($stmt->fetch()){
        $row = array("emisor" => $col1,
                     "mensaje" => $col2,
                     "fecha" => $col3,
                     "grupo" => $col4);
        array_push($array, $row);
    }

    $stmt->close();
    return $array;
}

function get_mensajes_privados_enviados($conexion, $usuario){
    $stmt = $conexion->prepare("SELECT mensaje, usuarioDestinatario, fecha FROM mensajes WHERE emisor = ? and usuarioDestinatario IS NOT NULL");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $stmt->bind_result($col1, $col2, $col3);
    $array = array();

    while ($stmt->fetch()){
        $row = array("mensaje" => $col1,
                     "destinatario" => $col2,
                     "fecha" => $col3);
        array_push($array, $row);
    }

    $stmt->close();

    return $array;
}

function get_mensajes_privados_recibidos($conexion, $usuario){
    $stmt = $conexion->prepare("SELECT mensaje, emisor, fecha FROM mensajes WHERE usuarioDestinatario = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $stmt->bind_result($col1, $col2, $col3);
    $array = array();

    while ($stmt->fetch()){
        $row = array("mensaje" => $col1,
                     "emisor" => $col2,
                     "fecha" => $col3);
        array_push($array, $row);
    }

    $stmt->close();

    return $array;
}

function enviar_mensaje_privado($conexion, $usuarioReceptor, $usuarioEmisor, $mensaje, $fecha){
    $stmt = $conexion->prepare("INSERT INTO mensajes (emisor, usuarioDestinatario, mensaje, fecha) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $usuarioEmisor, $usuarioReceptor, $mensaje, $fecha);
    $stmt->execute();
    $stmt->close();
}

function get_grupos($conexion, $usuario){
    $stmt = $conexion->prepare("SELECT nombre FROM grupos WHERE usuario = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $stmt->bind_result($grupo);
    $array = array();

    while($stmt->fetch())
        array_push($array, $grupo);

    $stmt->close();

    return $array;
}

function iniciar_sesion($conexion, $nombre_usuario, $pass){
    //preparamos la consulta
    $query = "SELECT pass, admin FROM usuario WHERE nombre = ?";
    $consulta = mysqli_prepare($conexion, $query);
    //enlazamos con los parametros
    $ok = mysqli_stmt_bind_param($consulta, "s", $nombre_usuario);
    $ok = mysqli_stmt_execute($consulta);
    $ok = mysqli_stmt_bind_result($consulta, $pass_bd, $admin);
    //cogemos el resultado
    mysqli_stmt_fetch($consulta);

    if (hash("sha512", $pass) == $pass_bd){
        session_start();
        $_SESSION["nombre"] = $nombre_usuario;
        $_SESSION["admin"] = $admin;

        return true;
    }

    return false;
}

function get_generos($conexion){
    $stmt = $conexion->prepare("SELECT * FROM generos");
    $stmt->execute();
    $stmt->bind_result($gusto);
    $array = array();

    while($stmt->fetch())
        array_push($array, $gusto);

    $stmt->close();

    return $array;
}

function aniadir_genero($conexion, $genero){
    $stmt = $conexion->prepare("INSERT INTO generos VALUES (?)");
    $stmt->bind_param("s", $genero);
    $stmt->execute();
    $stmt->close();
}

function hacer_admin($conexion, $usuario){
    $stmt = $conexion->prepare("UPDATE usuario SET admin = 1 WHERE nombre = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $stmt->close();
}

function get_gustos($conexion, $usuario){
    $stmt = $conexion->prepare("SELECT genero FROM gustos WHERE usuario = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $stmt->bind_result($genero);
    $array = array();

    while($stmt->fetch())
        array_push($array, $genero);

    $stmt->close();

    return $array;
}

function aniadir_gusto($conexion, $usuario, $genero){
    $stmt = $conexion->prepare("INSERT INTO gustos VALUES (?, ?)");
    $stmt->bind_param("ss", $usuario, $genero);
    $stmt->execute();
    $stmt->close();
}

function cerrar_sesion(){
    session_start();
    session_unset();
    session_destroy();
}

?>

