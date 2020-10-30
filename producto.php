<?php

class Producto {
    public function __construct($descripcion, $id, $rubro, $precio){
        $this->descripcion = $descripcion;
        $this->id = $id;
        $this->rubro = $rubro;
        $this->precio = $precio;
    }
    public function getDescripcion(){
        return $this->descripcion;
    }
    
    public function getId(){
        return $this->id;
    }
    
    public function getRubro(){
        return $this->rubro;
    }
    
    public function getPrecio(){
        return $this->precio;
    }
}