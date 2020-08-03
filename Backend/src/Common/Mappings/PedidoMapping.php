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
            $pedidoDto->estado  = $obj->estado;
            $pedidoDto->puntajeMozo  = $obj->puntajeMozo;
            $pedidoDto->puntajeMesa  = $obj->puntajeMesa;
        $pedidoDto->tiempoEstimado  = $obj->tiempoEstimado;

        }

        $pedidoDto->nombreCliente  = $obj->nombreCliente;
        $pedidoDto->mesaId  = $obj->mesaId;
        $pedidoDto->mozoId  = $obj->mozoId;
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
            $data->NombreCliente,
            $data->Foto,
            intval($data->Estado),
            intval($data->TiempoEstimado),
            intval($data->MesaId),
            intval($data->MozoId),
            $data->PuntajeMozo,
            $data->PuntajeMesa
        );
    }
}
