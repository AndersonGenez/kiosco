<?php
require_once 'clases/ControladorSesion.php';

if (isset($_GET['descripcion'])){
    $contSes = new ControladorSesion();
    $busqueda = $contSes->busqueda($_GET['descripcion']);
    if ($busqueda === false){
        $msg = "hubo un error";
        header("Location: dashboard.php?mensaje= $msg");        
    }
    else{
        echo $busqueda;
    }
}
else{
    header("Location: dashboard.php");
}

/*
echo $busqueda;
*/