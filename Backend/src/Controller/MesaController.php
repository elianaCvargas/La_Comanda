<?php
namespace Controller;

use Common\Enum\Enum_EstadoMesa;
use Common\ExceptionManager\ApplicationException;
use Common\Mappings\MesaMapping;
use Logic\MesaLogic;
use Controller\BaseController;
use Exception;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

include_once __DIR__ . '/../Controller/BaseController.php';
include_once __DIR__ . '/../Common/Enum/EstadoMesaEnum.php';
include_once __DIR__ . '/../Common/Mappings/MesaMapping.php';
include_once __DIR__ . '/../Logic/MesaLogic.php';

class MesaController extends BaseController
{
    public function Crear($request, $response, $args) {
      $datosArray = $request->getParsedBody();
      if($this->ValidateCreateRequest($datosArray, ["estado"]))
      {
        $mesa = json_encode($datosArray);
        $mesaDto = MesaMapping::ToDto($mesa, false);
        $mesaLogic = new MesaLogic();
        $mesaLogic->Crear($mesaDto);
        echo "Mesa generado con exito";
      } 
      else{
        echo "Faltan definir los campos";
      }  
    }

  public function ModificarEstado($request, $response, $args)
  {
    try {
      $datosArray = $request->getParsedBody();
      if (
        $this->ValidateModifyRequest($datosArray, "id", ["estado"])
      ) {
        $mesa = json_encode($datosArray);
        $mesaDto = MesaMapping::ToDto($mesa, true);
        $mesaLogic = new MesaLogic();
        if($mesaDto->estado == Enum_EstadoMesa::Cerrada){
          $mesaLogic->CerrarMesa($mesaDto);
        } else {
          $mesaLogic->ModificarEstado($mesaDto);
        }
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

  public function ModificarPuntaje($request, $response, $args)
  {
    try {
      $datosArray = $request->getParsedBody();
      if (
        $this->ValidateModifyRequest($datosArray, "id", ["puntaje"])
      ) {
        $mesa = json_encode($datosArray);
        $mesaDto = MesaMapping::ToDto($mesa, true);
        $mesaLogic = new MesaLogic();
        $mesaLogic->ModificarPuntaje($mesaDto);
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