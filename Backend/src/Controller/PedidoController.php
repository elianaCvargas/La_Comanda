<?php
namespace Controller;

use Common\ExceptionManager\ApplicationException;
use Common\Mappings\PedidoMapping;
use Logic\PedidoLogic;
use Controller\BaseController;
use Exception;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

include_once __DIR__ . '/../Controller/BaseController.php';
include_once __DIR__ . '/../Common/Mappings/PedidoMapping.php';
include_once __DIR__ . '/../Logic/PedidoLogic.php';

class PedidoController extends BaseController
{
    public function Crear($request, $response, $args) {
      $datosArray = $request->getParsedBody();
      if($this->ValidateCreateRequest($datosArray, ["estado"]))
      {
        $pedido = json_encode($datosArray);
        $pedidoDto = PedidoMapping::ToDto($pedido, false);
        $pedidoLogic = new PedidoLogic();
        $pedidoLogic->Crear($pedidoDto);
        echo "Pedido generado con exito";
      } 
      else{
        echo "Faltan definir los campos";
      }  
    }

  public function Modificar($request, $response, $args)
  {
    try {
      $datosArray = $request->getParsedBody();
      if (
        $this->ValidateModifyRequest($datosArray, "id", ["codigo", "estado"])
      ) {
        $mesa = json_encode($datosArray);
        $mesaDto = MesaMapping::ToDto($mesa, true);
        $mesaLogic = new MesaLogic();
        $mesaLogic->Modificar($mesaDto);
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

  public function Eliminar($request, $response, $args)
  {
    try {
      $datosArray = $request->getParsedBody();
      if (
        $this->ValidateDeleteRequest($datosArray, "id")
      ) {
        $obj = json_encode($datosArray);
        $mesa = json_decode($obj);

       $mesaLogic = new MesaLogic();
       $mesaLogic->Eliminar($mesa->id);
        echo "Eliminado con exito";
      } else {
        echo "Debe definir al menos un campo para modificar y ingresar un id";
      }
    } catch (ApplicationException $ae) {
      echo $ae->Message();
     }catch (Exception $e) {
      echo "Algun problema no conocido";
    } 
  }
}