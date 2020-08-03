<?php

namespace Controller;

use Common\Enum\Enum_EstadoMesa;
use Common\ExceptionManager\ApplicationException;
use Common\Mappings\PedidoMapping;
use Common\Mappings\DetallePedidoMapping;
use Logic\PedidoLogic;
use Controller\BaseController;
use Exception;
use Logic\MesaLogic;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

include_once __DIR__ . '/../Controller/BaseController.php';
include_once __DIR__ . '/../Common/Mappings/PedidoMapping.php';
include_once __DIR__ . '/../Common/Mappings/DetallePedidoMapping.php';
include_once __DIR__ . '/../Logic/PedidoLogic.php';
include_once __DIR__ . '/../Common/Enum/EstadoMesaEnum.php';

class PedidoController extends BaseController
{

  public function Crear($request, $response, $args)
  {
    try {
      $datosArray = $request->getParsedBody();
      if ($this->ValidateCreateRequest($datosArray, ["nombreCliente", "mesaId", "mozoId", "productos"])) {
        $pedido = json_encode($datosArray);
        $obj = json_decode($pedido);

        $pedidoDto = PedidoMapping::ToDto($pedido, false);
        $mesaLogic = new MesaLogic();

        $mesaLogic->alterarEstadoMesa($pedidoDto->mesaId, Enum_EstadoMesa::EsperandoPedido);

        $pedidoLogic = new PedidoLogic();
        $pedidoLogic->Crear($pedidoDto, $obj->productos);

        $response->getBody()->write("Pedido Creado con exito");
        $ok = 201;
        return $response->withStatus($ok);
      } else {
        $response->getBody()->write("Faltan definir los campos");
        $badrequest = 400;
        return $response->withStatus($badrequest);
      }
    } catch (ApplicationException $ex) {
      $response->getBody()->write($ex->Message());
      $badrequest = 400;
      return $response->withStatus($badrequest);
    } catch (Exception $e) {
      echo "Algun problema no conocido";
    }
  }

  public function ModificarEstado($request, $response, $args)
  {
    try {
      $datosArray = $request->getParsedBody();
      if (
        $this->ValidateModifyRequest($datosArray, "id", ["estado"])
      ) {
        $pedido = json_encode($datosArray);
        $pedidoDto = PedidoMapping::ToDto($pedido, true);
        $pedidoLogic = new PedidoLogic();
        //antes de modificar el estado tengo que cerrar los pedidos
        $pedidoLogic->ModificarEstado($pedidoDto);
        echo "Modificado con exito";
      } else {
        echo "Debe definir al menos un campo para modificar e ingresar un id";
      }
    } catch (ApplicationException $ae) {
      echo $ae->Message();
     }catch (Exception $e) {
      echo "Algun problema no conocido";
    } 
  }

  public function ModificarPuntajes($request, $response, $args)
  {
    try {
      $datosArray = $request->getParsedBody();
      if (
        $this->ValidateModifyRequest($datosArray, "id", ["puntajeMesa", "puntajeMozo"])
      ) {
        $pedido = json_encode($datosArray);
        $pedidoDto = PedidoMapping::ToDto($pedido, true);
        $pedidoLogic = new PedidoLogic();
        $pedidoLogic->ModificarPuntajes($pedidoDto);
        echo "Modificado con exito";
      } else {
        echo "Debe definir al menos un campo para modificar e ingresar un id";
      }
    } catch (ApplicationException $ae) {
      echo $ae->Message();
     }catch (Exception $e) {
      echo "Algun problema no conocido";
    } 
  }

  public function ModificarEstadoDetalle($request, $response, $args)
  {
    try {
      $datosArray = $request->getParsedBody();
      if (
        $this->ValidateModifyRequest($datosArray, "id", ["estado"])
      ) {
        $detallePedido = json_encode($datosArray);
        $detallePedidoDto = DetallePedidoMapping::ToDto($detallePedido, true);
        $pedidoLogic = new PedidoLogic();
        $pedidoLogic->ModificarEstadoDetalle($detallePedidoDto);
        echo "Modificado con exito";
      } else {
        echo "Debe definir al menos un campo para modificar e ingresar un id";
      }
    } catch (ApplicationException $ae) {
      echo $ae->Message();
     }catch (Exception $e) {
      echo "Algun problema no conocido";
    } 
  }

  public function ModificarPuntajeDetalle($request, $response, $args)
  {
    try {
      $datosArray = $request->getParsedBody();
      if (
        $this->ValidateModifyRequest($datosArray, "id", ["puntaje"])
      ) {
        $detallePedido = json_encode($datosArray);
        $detallePedidoDto = DetallePedidoMapping::ToDto($detallePedido, true);
        $pedidoLogic = new PedidoLogic();
        $pedidoLogic->ModificarPuntajeDetalle($detallePedidoDto);
        echo "Modificado con exito";
      } else {
        echo "Debe definir al menos un campo para modificar e ingresar un id";
      }
    } catch (ApplicationException $ae) {
      echo $ae->Message();
     }catch (Exception $e) {
      echo "Algun problema no conocido";
    } 
  }

  // public function Eliminar($request, $response, $args)
  // {
  //   try {
  //     $datosArray = $request->getParsedBody();
  //     if (
  //       $this->ValidateDeleteRequest($datosArray, "id")
  //     ) {
  //       $obj = json_encode($datosArray);
  //       $mesa = json_decode($obj);

  //      $mesaLogic = new MesaLogic();
  //      $mesaLogic->Eliminar($mesa->id);
  //       echo "Eliminado con exito";
  //     } else {
  //       echo "Debe definir al menos un campo para modificar y ingresar un id";
  //     }
  //   } catch (ApplicationException $ae) {
  //     echo $ae->Message();
  //    }catch (Exception $e) {
  //     echo "Algun problema no conocido";
  //   } 
  // }
}
