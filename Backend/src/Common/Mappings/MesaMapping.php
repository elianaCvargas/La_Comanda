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
        }

        // $mesaDto->codigo  = $obj->codigo;
        $mesaDto->estado  = $obj->estado;
        return $mesaDto;
    }

    public static function ToMesa(MesaDto $data, int $id): Mesa
    {
        // var_dump( $data);
        return new Mesa($id, $data->codigo, intval($data->estado));
    }
    
    public static function dbDataToMesa($data): Mesa
    {
        return new Mesa(intval($data->Id), $data->Codigo, intval($data->Estado));
    }
}
