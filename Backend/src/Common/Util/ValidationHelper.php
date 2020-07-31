<?php

namespace Common\Util;

use Common\Dto\UsuarioDto;
use Common\Dto\EmpleadoDto;
use Common\Dto\ProductoDto;
use Common\Dto\MesaDto;
use Common\Dto\PedidoDto;
use Model\Producto;
use PHPUnit\Framework\Constraint\IsEmpty;

include_once __DIR__ . '/../Dto/UsuarioDto.php';
include_once __DIR__ . '/../Dto/EmpleadoDto.php';

abstract class ValidationHelper
{
  //Usuarios
  public static function ValidarCreateEmpleadoRequest(EmpleadoDto $dto)
  {
    $errores = [];

    if ($dto->rolEmpleado === "" || $dto->rolEmpleado === null) {
      array_push($errores, "Debe ingresar un Rol.");
    }

    return $errores;
  }

  public static function ValidarCreateUsuarioRequest($nombre, $apellido, $username)
  {
    $errores = [];
    if ($nombre === "" || $nombre === null) {
      array_push($errores, "Debe ingresar un nombre.");
    }

    if ($apellido === "" || $apellido === null) {
      array_push($errores, "Debe ingresar un apellido.");
    }
    if ($username === "" || $username === null) {
      array_push($errores, "Debe ingresar un email.");
    }


    return $errores;
  }

  public static function ValidarModifyUsuarioRequest($id, $nombre, $apellido, $username)
  {
    $errores = [];
    if ($id === "") {
      array_push($errores, "Debe ingresar un id.");
    }

    if ($nombre === "" && $apellido === "" && $username === "") {
      array_push($errores, "Debe modificar al menos un campo.");
    }

    return $errores;
  }

  public static function ValidarDeleteUsuarioRequest($id)
  {
    $errores = [];
    if ($id === "") {
      array_push($errores, "Debe ingresar un id.");
    }

    return $errores;
  }

  //Productos
  public static function ValidarCreateProductoRequest(ProductoDto $productoDto)
  {
    $errores = [];

    if ($productoDto->nombre === "" || $productoDto->nombre === null) {
      array_push($errores, "Debe ingresar un nombre para el producto.");
    }

    if ($productoDto->tiempoEstimado === "" || $productoDto->tiempoEstimado === null) {
      array_push($errores, "Debe ingresar un tiempo estimado de preparacion.");
    }
    if ($productoDto->tipo === "" || $productoDto->tipo === null) {
      array_push($errores, "Debe asignar el tipo de producto.");
    }

    if ($productoDto->precio === "" || $productoDto->precio === null) {
      array_push($errores, "Debe asignar el precio de producto.");
    }

    return $errores;
  }

  public static function ValidarModifyProductoRequest($id)
  {
    $errores = [];
    if ($id === "") {
      array_push($errores, "Debe ingresar un id.");
    }

    return $errores;
  }

  //Mesa
  public static function ValidarCreateMesaRequest(MesaDto $mesaDto)
  {
    $errores = [];

    // if ($mesaDto->codigo === "" || $mesaDto->codigo === null) {
    //   array_push($errores, "Debe ingresar un codigo para la mesa.");
    // }

    if ($mesaDto->estado === "" || $mesaDto->estado === null) {
      array_push($errores, "Debe ingresar un estado.");
    }

    return $errores;
  }

  public static function ValidarModifyMesaRequest($data)
  {
    $errores = [];
    if ($data->id === "") {
      array_push($data->$errores, "Debe ingresar un id.");
    }

    if ($data->codigo === "" && $data->estado === "") {
      array_push($errores, "Debe modificar al menos un campo.");
    }

    return $errores;
  }

  public static function ValidarDeleteMesaRequest($id)
  {
    $errores = [];
    if ($id === "") {
      array_push($errores, "Debe ingresar un id.");
    }

    return $errores;
  }

  //Pedido
  public static function ValidarCreatePedidoRequest(PedidoDto $pedidoDto)
  {
    $errores = [];
    if ($pedidoDto->nombreCliente === "" || $pedidoDto->nombreCliente === null) {
      array_push($errores, "Debe ingresar un nombre del  cliente.");
    }
    if ($pedidoDto->estado === "" || $pedidoDto->estado === null) {
      array_push($errores, "Debe cambiar el estado.");
    }
    if ($pedidoDto->mesaId === "" || $pedidoDto->mesaId === null) {
      array_push($errores, "Debe ingresar una mesa.");
    }
    if ($pedidoDto->mozoId === "" || $pedidoDto->mozoId === null) {
      array_push($errores, "Debe ingresar un mozo.");
    }

    return $errores;
  }

  // public static function ValidarModifyPedidoRequest($data)
  // {
  //   $errores = [];
  //   if ($data->id === "") {
  //     array_push($data->$errores, "Debe ingresar un id.");
  //   }

  //   if ($data->codigo === "" && $data->estado === "") {
  //     array_push($errores, "Debe modificar al menos un campo.");
  //   }

  //   return $errores;
  // }

  // public static function ValidarDeletePedidoRequest($id)
  // {
  //   $errores = [];
  //   if ($id === "") {
  //     array_push($errores, "Debe ingresar un id.");
  //   }

  //   return $errores;
  // }
}
