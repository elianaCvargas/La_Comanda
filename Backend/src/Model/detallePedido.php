<?php
namespace Model;

//detalle por item del pedido
class DetallePedido
{
    private $id;
    //pedido origen
    private $pedido;
    private $responsable;
    private $estado;
    private $inicio;
    private $fin;
    private $productoId;
    private $puntaje;

    // public function __construct($id, $pedido, $responsable, $estado, $inicio, $fin, $productoId, $puntaje)
    // {
    //     $this->id = $id;
    //     $this->pedido= $pedido;
    //     $this->responsable= $responsable;
    //     $this->estado = $estado;
    //     $this->inicio= $inicio;
    //     $this->fin= $fin;
    //     $this->productoId= $productoId;
    //     $this->puntaje= $puntaje;
    // }


    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getPedido() {
        return $this->pedido;
    }

    public function setPedido($pedido) {
        $this->pedido = $pedido;
    }

    public function getResponsable() {
        return $this->responsable;
    }

    public function setResponsable($responsable) {
        $this->responsable = $responsable;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

    public function getInicio() {
        return $this->inicio;
    }

    public function setInicio($inicio) {
        $this->inicio = $inicio;
    }

    public function getFin() {
        return $this->fin;
    }

    public function setFin($fin) {
        $this->fin = $fin;
    }

    public function getProductoId() {
        return $this->productoId;
    }

    public function setProductoId($productoId) {
        $this->productoId = $productoId;
    }

    public function getPuntaje() {
        return $this->puntaje;
    }

    public function setPuntaje($puntaje) {
        $this->puntaje = $puntaje;
    }
}
?>