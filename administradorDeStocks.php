<?php
require_once 'clases/ControladorSesion.php';
if (isset($_POST['id']) && isset($_POST['stockActual'])) {
    $prueba = new ControladorSesion();
    $actualizar = $prueba->nuevoStock($_POST['id'], $_POST['stockActual']);
    if ($actualizar){
        $msg = "Stock actualizado con éxito";
    }
    else{
        $msg = "Hubo un problema con el stock, vuelva a intentarlo";
    }
    header("Location: actualizarStock.php?mensaje=$msg");
}
if (isset($_GET['descripcion'])){
    $consulta = new ControladorSesion();
    $respuesta = $consulta->stock($_GET['descripcion']);
    echo $respuesta;
}
?>