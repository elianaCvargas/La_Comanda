<?php
namespace Controller;

use Common\ExceptionManager\ApplicationException;
use Common\Mappings\ProductoMapping;
use Logic\ProductoLogic;
use Controller\BaseController;
use Exception;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

include_once __DIR__ . '/../Controller/BaseController.php';
include_once __DIR__ . '/../Common/Mappings/ProductoMapping.php';
include_once __DIR__ . '/../Logic/ProductoLogic.php';

class ProductoController extends BaseController
{
    public function Crear($request, $response, $args) {
      $datosArray = $request->getParsedBody();
      if($this->ValidateCreateRequest($datosArray, ["nombre", "tiempoEstimado", "tipo", "precio"]))
      {
        $producto = json_encode($datosArray);
        $productoDto = ProductoMapping::ToDto($producto, false);
        $productoLogic = new ProductoLogic();
        $productoLogic->Crear($productoDto);
        echo "Producto generado con exito";
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
        $this->ValidateModifyRequest($datosArray, "id", ["nombre", "tiempoEstimado", "tipo", "precio"])
      ) {
        $producto = json_encode($datosArray);
        $productoDto = ProductoMapping::ToDto($producto, true);
        $productoLogic = new productoLogic();
        $productoLogic->Modificar($productoDto);
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
        $producto = json_decode($obj);

       $productoLogic = new ProductoLogic();
       $productoLogic->Eliminar($producto->id);
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