<?php

namespace Logic;

use Common\Dto\PedidoDto;
use Common\Dto\DetallePedidoDto;
use Common\Enum\Enum_EstadoPedido;
use Common\Enum\Enum_EstadoDetallePedido;
use Common\ExceptionManager\ApplicationException;
use Common\Mappings\PedidoMapping;
use Common\Mappings\DetallePedidoMapping;
use Common\Util\ValidationHelper;
use Db\MesaDb;
use Db\PedidoDb;
use Db\ProductoDb;
use Db\DetallePedidoDb;
use Model\Mesa;
use Model\Producto;
use Model\DetallePedido;

include_once __DIR__ . '/../Common/Util/ValidationHelper.php';
include_once __DIR__ . '/../Common/ExceptionManager/ApplicationException.php';
include_once __DIR__ . '/../Common/Mappings/PedidoMapping.php';
include_once __DIR__ . '/../Db/PedidoDb.php';
include_once __DIR__ . '/../Db/ProductoDb.php';
include_once __DIR__ . '/../Db/DetallePedidoDb.php';
include_once __DIR__ . '/../Common/Enum/EstadoPedidoEnum.php';
include_once __DIR__ . '/../Common/Enum/EstadoDetallePedidoEnum.php';
include_once __DIR__ . '/../Model/detallePedido.php';

class PedidoLogic
{
  public function Crear(PedidoDto $dto, $produtos)
  {
    $erroresPedido = ValidationHelper::ValidarCreatePedidoRequest($dto);

    if (count($erroresPedido) > 0) {
      throw new ApplicationException(json_encode($erroresPedido));
    }

    if(count($produtos) <= 0)
    {
        throw new ApplicationException("Debe ingresar al menos un producto para realizar el alta del pedido");
    }

    //setea estado pedido
    $dto->estado = Enum_EstadoPedido::EnPreparacion;
    //generar codigo
    $dto->codigo = $this->GenerateAlphanumericCode();

    // obtener lista de productos
    $detallesPedido = [];
    foreach($produtos as $productoId){
      $producto = ProductoDb::getProductoById($productoId);
      // acumula tiempo estimado 
      $dto->tiempoEstimado += $producto->getTiempoEstimado();
      // nuevo detalle pedido
      $detalle = new DetallePedido();
      $detalle->setResponsable($dto->mozoId);
      $detalle->setProductoId($producto->getId());
      $detalle->setInicio(null);
      $detalle->setEstado(Enum_EstadoDetallePedido::EnEspera);
      $detalle->setFin(null);
      $detalle->setPuntaje(null);
      // guardando detalle pedido a la lista
      $detallesPedido [] = $detalle;
    }

    $pedidoNuevo = PedidoMapping::ToPedido($dto, 0);
    PedidoDb::create($pedidoNuevo);
    $pedidoNuevo = PedidoDb::GetPedidoByCode($pedidoNuevo->getCodigo());

    // 2º foreach, actualiza pedidoId y crea detallePedido
    foreach($detallesPedido as $detalle){
      $detalle->setPedido($pedidoNuevo->getId());
      DetallePedidoDb::create($detalle);
    }
  }

  public function ModificarEstado(PedidoDto $dto)
  {
    // $erroresMesa = ValidationHelper::ValidarModifyMesaRequest($dto->id);
    // if (count($erroresMesa) > 0) {
    //   foreach ($erroresMesa as $error) {
    //     echo $error . "\n";
    //   }

    //   return;
    // }

    $pedido = PedidoDb::getPedidoById($dto->id);
    if ($pedido != null) {
      // $detallePedido = DetallePedidoMapping::ToDetallePedido($dto, $dto->id);
      $pedido->setEstado($dto->estado);
      PedidoDb::modifyEstado($pedido);
    } else {
      throw new ApplicationException("No se encontro el pedido.");
    }
  }

  public function ModificarPuntajes(PedidoDto $dto)
  {
    // $erroresMesa = ValidationHelper::ValidarModifyMesaRequest($dto->id);
    // if (count($erroresMesa) > 0) {
    //   foreach ($erroresMesa as $error) {
    //     echo $error . "\n";
    //   }

    //   return;
    // }

    $pedido = PedidoDb::getPedidoById($dto->id);
    if ($pedido != null) {
      // $detallePedido = DetallePedidoMapping::ToDetallePedido($dto, $dto->id);
      $pedido->setPuntajeMesa($dto->puntajeMesa);
      $pedido->setPuntajeMozo($dto->puntajeMozo);
      PedidoDb::modifyPuntajes($pedido);
    } else {
      throw new ApplicationException("No se encontro el pedido.");
    }
  }


  public function ModificarEstadoDetalle(DetallePedidoDto $dto)
  {
    // $erroresMesa = ValidationHelper::ValidarModifyMesaRequest($dto->id);
    // if (count($erroresMesa) > 0) {
    //   foreach ($erroresMesa as $error) {
    //     echo $error . "\n";
    //   }

    //   return;
    // }

    $detallePedido = DetallePedidoDb::getDetallePedidoById($dto->id);
    if ($detallePedido != null) {
      // $detallePedido = DetallePedidoMapping::ToDetallePedido($dto, $dto->id);
      $detallePedido->setEstado($dto->estado);
      //según estado se llama al método de modificación
      if($dto->estado == Enum_EstadoDetallePedido::EnPreparacion){
        $detallePedido->setInicio(date('Y-m-d H:i:s', time()));
      } else if($dto->estado == Enum_EstadoDetallePedido::Listo){
        $detallePedido->setFin(date('Y-m-d H:i:s', time()));
      }
      DetallePedidoDb::modifyEstado($detallePedido);
    } else {
      throw new ApplicationException("No se encontro el detalle pedido.");
    }
  }

  public function ModificarPuntajeDetalle(DetallePedidoDto $dto)
  {
    // $erroresMesa = ValidationHelper::ValidarModifyMesaRequest($dto->id);
    // if (count($erroresMesa) > 0) {
    //   foreach ($erroresMesa as $error) {
    //     echo $error . "\n";
    //   }

    //   return;
    // }

    $detallePedido = DetallePedidoDb::getDetallePedidoById($dto->id);
    if ($detallePedido != null) {
      // $detallePedido = DetallePedidoMapping::ToDetallePedido($dto, $dto->id);
      $detallePedido->setPuntaje($dto->puntaje);
      DetallePedidoDb::modifyPuntaje($detallePedido);
    } else {
      throw new ApplicationException("No se encontro el detalle pedido.");
    }
  }

  private function GenerateAlphanumericCode(): string
  {
    $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    return substr(str_shuffle($permitted_chars), 0, 5);
  }
}
