<?php

namespace Logic;

use Common\Dto\PedidoDto;
use Common\ExceptionManager\ApplicationException;
use Common\Mappings\PedidoMapping;
use Common\Util\ValidationHelper;
use Db\MesaDb;
use Db\PedidoDb;
use Model\Mesa;

include_once __DIR__ . '/../Common/Util/ValidationHelper.php';
include_once __DIR__ . '/../Common/ExceptionManager/ApplicationException.php';
include_once __DIR__ . '/../Common/Mappings/PedidoMapping.php';
include_once __DIR__ . '/../Db/PedidoDb.php';

class PedidoLogic
{
  public function Crear(PedidoDto $dto, $produtos)
  {
    $erroresPedido = ValidationHelper::ValidarCreatePedidoRequest($dto);

    if (count($erroresPedido) > 0) {
      foreach ($erroresPedido as $error) {
        echo $error . "\n";
      }

      return  json_encode($erroresPedido);
    }

    if(count($produtos) <= 0)
    {
        throw new ApplicationException("Debe ingresar al menos un producto para realizar el alta del pedido");
    }
    //generar codigo
    $dto->codigo = $this->GenerateAlphanumericCode();
    //obtengo mesa
    MesaDb::getMesaById($dto->mesaId);

    $pedidoNuevo = PedidoMapping::ToPedido($dto, 0);
    PedidoDb::create($pedidoNuevo);
  }

  // public function Modificar(MesaDto $dto)
  // {
  //   $erroresMesa = ValidationHelper::ValidarModifyMesaRequest($dto->id);
  //   if (count($erroresMesa) > 0) {
  //     foreach ($erroresMesa as $error) {
  //       echo $error . "\n";
  //     }

  //     return;
  //   }

  //   $pedidoById = MesaDb::getMesaById($dto->id);
  //   if ($pedidoById != null) {
  //     $pedido = MesaMapping::ToMesa($dto, $dto->id);
  //     MesaDb::modify($pedido);
  //   } else {
  //     throw new ApplicationException("No se encontro el Mesa.");
  //   }
  // }

  // public function Eliminar(string $id)
  // {
  //   $errores = [];
  //   $erroresUsuario = ValidationHelper::ValidarDeleteUsuarioRequest($id);

  //   if (count($erroresUsuario) > 0) {
  //     foreach ($errores as $error) {
  //       echo $error . "\n";
  //     }

  //     return;
  //   }

  //   $pedido = MesaDb::getMesaById(intval($id));
  //   if ($pedido != null) {
  //     MesaDb::delete($pedido->getId());
  //   } else {
  //     throw new ApplicationException("No se encontro el empleado.");
  //   }
  // }

  private function GenerateAlphanumericCode(): string
  {
    $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    return substr(str_shuffle($permitted_chars), 0, 5);
  }
}
