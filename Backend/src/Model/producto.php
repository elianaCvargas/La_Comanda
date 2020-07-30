<?php

namespace Model;

class Producto
{
    //private $descripcion; no lo agregamos, pero porque no parece pedirlo o parece no ser necesario
    private $id;
    private $nombre;
    private $tiempoEstimado;
    private $tipo;
    private $precio;

    public function __construct($id, $nombre, $tiempoEstimado, $tipo, $precio)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->tiempoEstimado = $tiempoEstimado; 
        $this->tipo = $tipo;
        $this->precio = $precio;
    }
    
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getTiempoEstimado()
    {
        return $this->tiempoEstimado;
    }

    public function setTiempoEstimado($tiempoEstimado)
    {
        $this->tiempoEstimado = $tiempoEstimado;
    }

    public function getTipo()
    {
        return $this->tipo;
    }

    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    public function getPrecio()
    {
        return $this->precio;
    }

    public function setPrecio($precio)
    {
        $this->precio = $precio;
    }
}
