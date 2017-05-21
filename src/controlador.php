<?php
require_once("modelo.php");

function validarEntrada($data){
   $data = trim($data);
   $data = strip_tags($data);
   $data = htmlspecialchars($data);

   return $data;
}

function registrarUsuario($params){
   $db = conectar("localhost", "root");
   if (!existe_usuario($db, $params["nombre"])){
      aniadir_usuario($db, $params["nombre"], $params["pass1"], $params["fecha"], $params["admin"]);
      aniadir_usuario_grupo($db, $params["nombre"], "TODOS");
      desconectar($db);
      session_start();
      $_SESSION["nombre"] = $params["nombre"];
      $_SESSION["admin"] = false;
      return true;
   }

   return false;
}

function iniciarSesion($usuario, $pass){
   $db = conectar("localhost", "root");
   $ret = iniciar_sesion($db, $usuario, $pass);

   desconectar($db);

   return $ret;
}

function cerarrSesion(){
   cerrar_sesion();
}

function enviarMensajeGrupo($emisor, $grupo, $mensaje, $fecha){
   $db = conectar("localhost", "root");
   if (existe_grupo($db, $grupo)){
      aniadir_mensaje_grupo($db, $emisor, $grupo, $mensaje, $fecha);
      desconectar($db);
      return true;
   }

   desconectar($db);
   return false;
}

function getMensajesGrupo($grupo, $fecha){
   $db = conectar("localhost", "root");
   $ret = get_mensajes_grupo($db, $grupo, $fecha);

   desconectar($db);

   return $ret;
}

function getMensajesPrivadosEnviados($usuario){
   $db = conectar("localhost", "root");
   $ret = get_mensajes_privados_enviados($db, $usuario);

   desconectar($db);

   return $ret;
}

function getMensajesPrivadosRecibidos($usuario){
   $db = conectar("localhost", "root");
   $ret = get_mensajes_privados_recibidos($db, $usuario);

   desconectar($db);

   return $ret;
}

function getGrupos($usuario){
   $db = conectar("localhost", "root");
   $ret = get_grupos($db, $usuario);

   desconectar($db);

   return $ret;
}

function getGeneros(){
   $db = conectar("localhost", "root");
   $ret = get_generos($db);

   desconectar($db);

   return $ret;
}

function enviarMensajePrivado($usuarioReceptor, $usuarioEmisor, $mensaje, $fecha){
   $db = conectar("localhost", "root");
   if (!existe_usuario($db, $usuarioReceptor)){
      desconectar($db);
      return false;
   }

   enviar_mensaje_privado($db, $usuarioReceptor, $usuarioEmisor, $mensaje, $fecha);
   desconectar($db);

   return true;
}

function aniadirGenero($genero){
   $db = conectar("localhost", "root");
   aniadir_genero($db, $genero);
   desconectar($db);
}

function hacerAdmin($usuario){
   $db = conectar("localhost", "root");
   if (existe_usuario($db, $usuario)){  
      hacer_admin($db, $usuario);
      return true;
   }

   return false;
}

function getGustos($usuario){
   $db = conectar("localhost", "root");
   $ret =get_gustos($db, $usuario);
   desconectar($db);

   return $ret;
}

function aniadirGusto($usuario, $genero){
   $db = conectar("localhost", "root");
   aniadir_gusto($db, $usuario, $genero);

   desconectar($db);
}

function aniadirGruposGusto($usuario, $genero){
   $db = conectar("localhost", "root");
   aniadir_grupos_gusto($db, $usuario, $genero);
   desconectar($db);  
}

function crearGrupo($edadmin, $edadmax, $genero, $nombre){

   if ($edadmin <= $edadmax){
      $db = conectar("localhost", "root");
      $fechamin = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d"), date("Y") - $edadmin));
      $fechamax = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d"), date("Y") - $edadmax));

      crear_grupo($db, $fechamin, $fechamax, $genero, $nombre);
      insertar_usuarios_grupo($db, $fechamin, $fechamax, $genero, $nombre);
      desconectar($db);

      return true;
   }

   return false;
}

?>












