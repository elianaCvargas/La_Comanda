<?php
namespace Model;

class Acceso
{
    private $id;
    private $empleadoId;
    private $fecha;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getEmpleadoId() {
        return $this->empleadoId;
    }

    public function setEmpleadoId($empleadoId) {
        $this->empleadoId = $empleadoId;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }
}
?>