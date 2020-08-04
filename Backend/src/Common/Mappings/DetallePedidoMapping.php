<?php

namespace Common\Mappings;

use Common\Dto\DetallePedidoDto;
use Model\DetallePedido;

include_once __DIR__ . '/../../Common/Dto/DetallePedidoDto.php';
include_once __DIR__ . '/../../Model/detallePedido.php';

class DetallePedidoMapping
{

    public static function ToDto($data, $modificar): DetallePedidoDto
    {
        $obj = json_decode($data);
        $detallePedidoDto = new DetallePedidoDto();
        if ($modificar) {
            $detallePedidoDto->id  = $obj->id;
            $detallePedidoDto->estado  = $obj->estado;

        }

        $detallePedidoDto->puntaje  = $obj->puntaje;

        return $detallePedidoDto;
    }

    public static function ToDtoParaModificarEstado($data): DetallePedidoDto
    {
        $obj = json_decode($data);
        $detallePedidoDto = new DetallePedidoDto();
            $detallePedidoDto->id  = $obj->id;
            $detallePedidoDto->estado  = $obj->estado;
        return $detallePedidoDto;
    }

    public static function ToDetallePedido(DetallePedidoDto $data, int $id): DetallePedido
    {
        return new DetallePedido(
            $id,
            $data->pedido,
            $data->responsable,
            $data->estado,
            $data->inicio,
            $data->fin,
            $data->productoId,
            $data->puntaje
        );
    }

    public static function dbDataToDetallePedido($data): DetallePedido
    {
        $pedido = new DetallePedido();          
            $pedido->setId(intval($data->Id));
            $pedido->setPedido(intval($data->Pedido));
            $pedido->setResponsable(intval($data->Responsable));
            $pedido->setEstado(intval($data->Estado));
            $pedido->setInicio($data->Inicio);
            $pedido->setFin($data->Fin);
            $pedido->setProductoId(intval($data->ProductoId));
            $pedido->setPuntaje(intval($data->Puntaje));

        return $pedido;
    }
}
