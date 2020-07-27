<?php
declare(strict_types=1);

namespace Model;

use JsonSerializable;
use Common\Enum\Enum_RolesUsuarios;
include_once __DIR__ . '/../../src/Model/usuario.php';
include_once __DIR__ . '/../../src/Common/Enum/RolesUsuariosEnum.php';

class Pedido
{
    private $id;
    private $codigo;
    private $nombreCliente;
    private $foto;
    private $estado;
    private $tiempoEstimado;
    private $mesaId;
    private $mozoId;
    private $puntajeMozo;
    private $puntajeMesa;



    public function __construct($id, $codigo, $nombreCliente, $foto, $estado, $tiempoEstimado, $mesaId, $mozoId, $puntajeMozo, $puntajeMesa)
    {
        $this->id = $id;
        $this->codigo = $codigo;
        $this->nombreCliente = $nombreCliente;
        $this->foto = $foto;
        $this->estado = $estado; 
        $this->tiempoEstimado = $tiempoEstimado; 
        $this->mesaId = $mesaId;
        $this->mozoId = $mozoId;
        $this->puntajeMesa = $puntajeMesa;
        $this->puntajeMozo = $puntajeMozo;
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

    public function getNombreCliente() {
        return $this->nombreCliente;
    }

    public function setNombreCliente($nombreCliente) {
        $this->nombreCliente = $nombreCliente;
    }

    public function getFoto() {
        return $this->foto;
    }

    public function setFoto($foto) {
        $this->foto = $foto;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

    public function getTiempoEstimado() {
        return $this->tiempoEstimado;
    }

    public function setTiempoEstimado($tiempoEstimado) {
        $this->tiempoEstimado = $tiempoEstimado;
    }

    public function getMesaId() {
        return $this->mesaId;
    }

    public function setMesaId($mesaId) {
        $this->mesaId = $mesaId;
    }

    public function getMozoId() {
        return $this->mozoId;
    }

    public function setMozoId($mozoId) {
        $this->mozoId = $mozoId;
    }

    public function getpuntajeMesa() {
        return $this->puntajeMesa;
    }

    public function setPuntajeMesa($puntajeMesa) {
        $this->puntajeMesa = $puntajeMesa;
    }

    public function getPuntajeMozo() {
        return $this->puntajeMozo;
    }

    public function setPuntajeMozo($puntajeMozo) {
        $this->puntajeMozo = $puntajeMozo;
    }

    // public function getId(): ?int
    // {
    //     return $this->numeroCliente;
    // }

    // public function jsonSerialize()
    // {
    //     return  parent::jsonSerialize().array_merge([
    //         'numeroCliente' => $this->numeroCliente
    //     ]);
    // }
}
