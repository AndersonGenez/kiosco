<?php
require_once 'Usuario.php';
require_once 'consultaProd.php';
require_once 'RepositorioUsuario.php';
require_once 'RepositorioProducto.php';

class ControladorSesion
{
    protected $usuario = null;
    


    public function login($nombre_usuario, $clave)
    {
        $repo = new RepositorioUsuario();
        $usuario = $repo->login($nombre_usuario, $clave);
        //Si falló el login:
        if ($usuario === false) {
            return [false, "Error de credenciales"];
        }
        else {
            session_start();
            $_SESSION['usuario'] = serialize($usuario);
            return [true, "Usuario autenticado correctamente"];
        }
    }

    public function create($nombre_usuario, $nombre, $apellido, $clave)
    {
        $repo = new RepositorioUsuario();
        $usuario = new Usuario($nombre_usuario, $nombre, $apellido);
        $id = $repo->save($usuario, $clave);
        if ($id === false) {
            return [ false, "Error al crear el usuario"];
        }
        else {
            $usuario->setId($id);
            session_start();
            $_SESSION['usuario'] = serialize($usuario);
            return [ true, "Usuario creado correctamente" ];
        }
    }
    public function crearProducto($descripcion, $rubro, $precio, $stock){
        $producto = new Producto($descripcion, $rubro, $precio);
        $repoProducto = new RepositorioProducto();
        $insertar = $repoProducto->producto($producto, $stock);
        if ($insertar === true){
            return true;
        } else {
            return false; 
        }
    }
    public function busqueda($producto){
        $buscar = new RepositorioProducto();
        $queryResult = $buscar->query($producto);
        return $queryResult;
    }
    public function pedirInventario(){
    $repoProducto = new RepositorioProducto();
    $stocks = $repoProducto->inventario();
    return $stocks; 
    }
    public function stock($descripcion){
        $repoProducto = new RepositorioProducto();
        $consulta = $repoProducto->consultaStock($descripcion);
        return $consulta;
    }
    public function nuevoStock($id, $stockActual){
        $repoProducto = new RepositorioProducto();
        $insert = $repoProducto->actualizarStock($id, $stockActual);
        if ($insert){
            return $insert;
        }
        else{
            return false;
        }    
    }
    public function borrarUsuario($borrar){
        $repoProducto = new RepositorioProducto();
        $resultado = $repoProducto->eliminarUnUsuario($borrar);
        return $resultado;
    }
    public function listaUsuarios(){
        $repoUsuario = new RepositorioUsuario();
        $respuesta = $repoUsuario->consultaUsuarios();
        return $respuesta; 
    }
}
