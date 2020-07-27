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

    public function getId() {
        return $this->Id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getPedido() {
        return $this->Pedido;
    }

    public function setPedido($pedido) {
        $this->pedido = $pedido;
    }

    public function getResponsable() {
        return $this->Responsable;
    }

    public function setResponsable($responsable) {
        $this->responsable = $responsable;
    }

    public function getEstado() {
        return $this->Estado;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

    public function getInicio() {
        return $this->Inicio;
    }

    public function setInicio($inicio) {
        $this->inicio = $inicio;
    }

    public function getFin() {
        return $this->Fin;
    }

    public function setFin($fin) {
        $this->fin = $fin;
    }

    public function getProductoId() {
        return $this->ProductoId;
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