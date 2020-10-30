<?php

require_once 'clases/ControladorSesion.php';
if (isset($_GET['prueba'])){
    $conSes = new ControladorSesion();
    $consulta = $conSes->pedirInventario();
    echo $consulta;
}
