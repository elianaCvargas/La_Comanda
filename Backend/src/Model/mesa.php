<?php
namespace Model;
class Mesa{
    private $id;
    private $codigo;
    private $estado;

    public function __construct($id, $codigo, $estado)
    {
        $this->id = $id;
        $this->codigo = $codigo;
        $this->estado = $estado;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getCodigo() {
        return $this->codigo;
    }

    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }
}
?>