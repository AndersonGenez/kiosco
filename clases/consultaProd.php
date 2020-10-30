<?php
function query($prod){

    $mysqli = new mysqli("localhost", "root", "", "kiosco");

    if (mysqli_connect_errno()) {
        printf("Falló la conexión: %s\n", mysqli_connect_error());
        exit();
    }
        if ($_GET['descripcion'] == ""){
            echo '</script><div id="mensaje" class="alert alert-primary text-center">
            <p>por favor ingrese algo</p>
          </div>';
        } else{
    $d = $prod;
    /* sentencia preparada */
    if ($sentencia = $mysqli->prepare("SELECT precio, descripción FROM productos WHERE descripción like '%$d%' ORDER BY precio")) {
        $sentencia->execute();
    
        $sentencia->bind_result($col1, $col2);

        /* obtener valores */
        $item = array();
        $content = array();
        while ($sentencia->fetch()) {
            
            //$item["#"] = "$i";        
            $item["precio"] = $col1;
            $item["descripcion"] = $col2;
            array_push($content, $item); 
        }
    }

    $mysqli->close();
    header('Content-Type: application/json');
    echo json_encode($content);
     }    
}