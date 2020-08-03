<?php

namespace Common\Mappings;

use Common\Dto\MesaDto;
use Model\Mesa;

include_once __DIR__ . '/../../Common/Dto/MesaDto.php';
include_once __DIR__ . '/../../Model/mesa.php';

class MesaMapping
{
    public static function ToDto($data, $modificar): MesaDto
    {
        $obj = json_decode($data);
        $mesaDto = new MesaDto();
        if ($modificar) {
            $mesaDto->id  = $obj->id;
            $mesaDto->codigo  = $obj->codigo;
            $mesaDto->puntaje  = $obj->puntaje;
        }

        $mesaDto->estado  = $obj->estado;
        return $mesaDto;
    }

    public static function ToMesa(MesaDto $data, int $id): Mesa
    {
        return new Mesa($id, $data->codigo, intval($data->estado), intval($data->puntaje));
    }

    public static function dbDataToMesa($data): Mesa
    {
        return new Mesa(intval($data->Id), $data->Codigo, intval($data->Estado), intval($data->Puntaje));
    }
}
