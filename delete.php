<?php
require_once 'clases/ControladorSesion.php';
if (isset($_GET['bandera'])){
    $controlador = new ControladorSesion();
    $usuarios = $controlador->listaUsuarios();
    echo $usuarios;
}
