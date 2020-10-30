<?php
require_once 'clases/ControladorSesion.php';

if (isset($_GET['borrar'])){
    $borrar = $_GET['borrar'];
    $borrador = new ControladorSesion();
    $respuesta = $borrador->borrarUsuario($borrar);
    
    echo $respuesta;
}
else{
    $msg = "hubo un error al borrar el usuario";
    header("location: dashboardOwner.php?mensaje=$msg");
}

