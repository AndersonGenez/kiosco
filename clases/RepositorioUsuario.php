<?php
require_once '.env.php';
require_once 'Usuario.php';
require_once 'producto.php';

class RepositorioUsuario
{
    private static $conexion = null;

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

    public function login($nombre_usuario, $clave)
    {
        $q = "SELECT id, clave, nombre, apellido FROM usuarios ";
        $q.= "WHERE usuario = ?";
        $query = self::$conexion->prepare($q);
        $query->bind_param("s", $nombre_usuario);
        if ( $query->execute() ) {
            $query->bind_result($id, $clave_encriptada, $nombre, $apellido);
            if ( $query->fetch() ) {
                if( password_verify($clave, $clave_encriptada) === true) {
                    return new Usuario($nombre_usuario, $nombre, $apellido, $id);
                }
            }
        }
        return false;
    }

    public function save(Usuario $u, $clave)
    {
        $q = "INSERT INTO usuarios (usuario, nombre, apellido, clave) ";
        $q.= "VALUES (?, ?, ?, ?)";
        $query = self::$conexion->prepare($q);

        $query->bind_param("ssss", $u->getUsuario(), $u->getNombre(),
            $u->getApellido(), password_hash($clave, PASSWORD_DEFAULT));

        if ( $query->execute() ) {
            // Retornamos el id del usuario recién insertado.
            return self::$conexion->insert_id;
        }
        else {
            return false;
        }
    }
    public function dueno(){
        $consultaD = self::$conexion->prepare("SELECT usuario FROM usuarios WHERE usuarios.id = 9;");
        $consultaD->execute();
        $consultaD->bind_result($dueno);
        $consultaD->fetch();
        return "$dueno";                
        
    }
    public function consultaUsuarios(){

        $sentencia = self::$conexion->prepare("SELECT nombre, usuario, id FROM usuarios WHERE id > 9");
        $sentencia->execute();

/* vincular variables a la sentencia preparada */
$sentencia->bind_result($nombre, $usuario, $id);
//echo "$nombre" . "$usuario";
$item = array();
$content = array();
while ($sentencia->fetch()) {
    $item["nombre"] = $nombre;
    $item["usuario"] = $usuario;
    $item["id"] = $id;
    array_push($content, $item); 
    
}
if (!isset($item)){
    $item['nombre'] = "No hubo resultados o hubo un error";
    $item['usuario'] = "intentelo de nuevo";
    $item["id"] = "";
    array_push($content, $item);
    //if (isset($item['usuario'])){
        self::$conexion->close();
}   
header('Content-Type: application/json');
return json_encode($content);
}
}   

