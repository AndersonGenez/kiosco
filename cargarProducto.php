<?php
require_once 'clases/ControladorSesion.php';


if (isset($_POST['descripcion']) && isset($_POST['rubro']) && isset($_POST['precio']) && isset($_POST['stock'])) {
    $prod = new ControladorSesion;
    $respuesta = $prod->crearProducto($_POST['descripcion'], $_POST['rubro'], $_POST['precio'], $_POST['stock']);
    if (!$respuesta){
        $msg = "Hubo un problema al cargar el producto";
    } else {
        $msg = "Producto añadido con éxito";
header("Location: agregarProducto.php?mensaje=$msg");
    }
}