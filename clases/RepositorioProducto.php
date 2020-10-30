<?php
require_once '.env.php';
require_once 'Usuario.php';
require_once 'producto.php';

class RepositorioProducto
{
    private static $conexion = null;
    private STATIC $minimoStock = 10;

    public function __construct()
    {
        if (is_null(self::$conexion)) {
            $credenciales = credenciales();
            self::$conexion = new mysqli(   $credenciales['servidor'],
                                            $credenciales['usuario'],
                                            $credenciales['clave'],
                                            $credenciales['base_de_datos']);
            if(self::$conexion->connect_error) {
                $error = 'Error de conexión: '.self::$conexion->connect_error;
                self::$conexion = null;
                die($error);
            }
            self::$conexion->set_charset('utf8'); 
        }
    }

    public function producto(Producto $producto, $stock)
    {
        $q = "INSERT INTO productos (descripción, idRubro, precio) ";
        $q.= "VALUES (?, ?, ?)";
        $query = self::$conexion->prepare($q);
        $siii = "sii";
        $des = $producto->getDescripcion();
        $rub = (int) $producto->getRubro();
        $pre = (int) $producto->getPrecio();

        $query->bind_param($siii, $des, $rub, $pre);

        if ( $query->execute() ) {
            $id = self::$conexion->insert_id;
//            self::$conexion->close();
            $sentencia = self::$conexion->prepare("INSERT INTO stock (idProducto, `variación`) VALUES ($id, $stock);");
            if ( $sentencia->execute() ) {
            return true;
            }
        }
        else {
            return false;
        }
    }
    
    public function inventario(){
        $minimo = self::$minimoStock;
        $sentencia = self::$conexion->prepare("SELECT descripción, `variación` FROM productos INNER JOIN stock ON productos.id = idProducto WHERE `variación` < $minimo");
                                              
        $sentencia->execute();
        
        /* vincular variables a la sentencia preparada */
        $sentencia->bind_result($nombre, $stock);
        //echo "$nombre" . "$stock";
        $item = array();
        $content = array();
        while ($sentencia->fetch()) {
        $item["nombre"] = $nombre;
        $item["stock"] = $stock;
        array_push($content, $item); 
        }
        if (!isset($item["nombre"]) || !isset($item["stock"])){
            $item['nombre'] = "No hubo resultados o hubo un error";
            $item['stock'] = "intentelo de nuevo";
            array_push($content, $item);
        }
    self::$conexion->close();
    header('Content-Type: application/json');
    return json_encode($content);
    }
    public function actualizarStock($id, $stockActual){
        
    $sentencia = self::$conexion->prepare("UPDATE `stock` SET `variación` = '$stockActual' WHERE idProducto = $id");
    $sentencia->execute();
    if ($sentencia->execute()){
        $respuesta = true;
    }
    else {
        $respuesta = false;
        
    }
    self::$conexion->close();
    return $respuesta;
}
///////////////////////////////////
public function consultaStock($descripcion){


if ($descripcion == ""){
    echo '<div id="mensaje" class="alert alert-primary text-center">
    <p>por favor ingrese algo</p>
    </div>';
} else{
    $sentencia = self::$conexion->prepare("SELECT productos.descripción, stock.variación, productos.id FROM productos 
                                           INNER JOIN stock ON productos.id = stock.idProducto WHERE productos.descripción like '%$descripcion%'");
    $sentencia->execute();
    $sentencia->bind_result($descripcion, $stock, $id);
                           
    $item = array();
    $content = array();
    while ($sentencia->fetch()) {
        
        $item["id"] = $id;
        $item["descripcion"] = $descripcion;
        $item["stock"] = $stock;
        array_push($content, $item); 
    }
    if (!isset($item["id"]) || !isset($item["descripcion"])){
        $item['id'] = "";
        $item['stock'] = "No hubo resultados o hubo un error";
        $item['descripcion'] = "intentelo de nuevo";
        array_push($content, $item);
    }
    self::$conexion->close();
    header('Content-Type: application/json');
    echo json_encode($content);
}
}

public function query($prod){
  
    if ($prod === ""){
        echo '</script><div id="mensaje" class="alert alert-primary text-center">
        <p>por favor ingrese algo</p>
          </div>';
        } else{
            $prod;
            /* sentencia preparada */
            $sentencia = self::$conexion->prepare("SELECT precio, descripción FROM productos WHERE descripción like '%$prod%' ORDER BY precio");
                $sentencia->execute();
                
        $sentencia->bind_result($col1, $col2);
        
        /* obtener valores */
        $item = array();
        $content = array();
        while ($sentencia->fetch()) {
            
            //$item["#"] = "$i";        
            $item["precio"] = "$".$col1;
            $item["descripcion"] = $col2;
            array_push($content, $item); 
        }
    if (!isset($item["precio"])){
        $item['precio'] = 'No hubo resultados';
        $item['descripcion'] = 'intentelo nuevamente'; 
        array_push($content, $item);
    }
    self::$conexion->close();
}    
header('Content-Type: application/json');
echo json_encode($content);
}
public function eliminarUnUsuario($borrar){

    $sentencia = self::$conexion->prepare("DELETE FROM `usuarios` WHERE `usuarios`.`id` = $borrar");
    $sentencia->execute();
    if ($sentencia->execute()){
        $resultado = true;
    }
    else{
        $resultado = false;
    }
    self::$conexion->close();
    return $resultado;
} 
}