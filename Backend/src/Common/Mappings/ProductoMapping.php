<?php

namespace Common\Mappings;

use Common\Dto\ProductoDto;
use Model\Producto;

include_once __DIR__ . '/../../Common/Dto/ProductoDto.php';
include_once __DIR__ . '/../../Model/producto.php';

class ProductoMapping
{
    public static function ToDto($data, $modificar): ProductoDto
    {
        $obj = json_decode($data);
        $productoDto = new ProductoDto();
        if ($modificar) {
            $productoDto->id  = $obj->id;
        }

        $productoDto->nombre  = $obj->nombre;
        $productoDto->tiempoEstimado  = $obj->tiempoEstimado;
        $productoDto->tipo  = $obj->tipo;
        $productoDto->precio  = $obj->precio;
        return $productoDto;
    }

    public static function ToProducto(ProductoDto $data, int $id): Producto
    {
        return new Producto($id, $data->nombre, intval($data->tiempoEstimado), intval($data->tipo), floatval($data->precio));
    }
    
    public static function dbDataToProducto($data): Producto
    {
        return new Producto(intval($data->Id), $data->Nombre, intval($data->TiempoEstimado), intval($data->TipoProductoId), floatval($data->Precio));
    }
}
