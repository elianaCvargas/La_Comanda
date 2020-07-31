<?php

namespace Common\Mappings;

use Common\Dto\PedidoDto;
use Model\Pedido;

include_once __DIR__ . '/../../Common/Dto/PedidoDto.php';
include_once __DIR__ . '/../../Model/pedido.php';

class PedidoMapping
{

    public static function ToDto($data, $modificar): PedidoDto
    {
        $obj = json_decode($data);
        $pedidoDto = new PedidoDto();
        if ($modificar) {
            $pedidoDto->id  = $obj->id;
        }

        $pedidoDto->nombreCliente  = $obj->nombreCliente;
        $pedidoDto->foto  = $obj->foto;
        $pedidoDto->estado  = $obj->estado;
        $pedidoDto->tiempoEstimado  = $obj->tiempoEstimado;
        $pedidoDto->mesaId  = $obj->mesaId;
        $pedidoDto->mozoId  = $obj->mozoId;
        $pedidoDto->puntajeMozo  = $obj->puntajeMozo;
        $pedidoDto->puntajeMesa  = $obj->puntajeMesa;

        return $pedidoDto;
    }

    public static function ToPedido(PedidoDto $data, int $id): Pedido
    {
        return new Pedido(
            $id,
            $data->codigo,
            $data->nombreCliente,
            $data->foto,
            $data->estado,
            $data->tiempoEstimado,
            $data->mesaId,
            $data->mozoId,
            $data->puntajeMozo,
            $data->puntajeMesa
        );
    }

    public static function dbDataToPedido($data): Pedido
    {
        return new Pedido(
            intval($data->Id),
            $data->Codigo,
            $data->nombreCliente,
            $data->foto,
            $data->estado,
            $data->tiempoEstimado,
            $data->mesaId,
            $data->mozoId,
            $data->puntajeMozo,
            $data->puntajeMesa
        );
    }
}
