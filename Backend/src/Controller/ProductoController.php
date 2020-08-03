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
  public function Crear($request, $response, $args)
  {
    try {
      $datosArray = $request->getParsedBody();
      if ($this->ValidateCreateRequest($datosArray, ["nombre", "tiempoEstimado", "tipo", "precio"])) {
        $producto = json_encode($datosArray);
        $productoDto = ProductoMapping::ToDto($producto, false);
        $productoLogic = new ProductoLogic();
        $productoLogic->Crear($productoDto);

        $response->getBody()->write("Producto creado con exito");
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

        $response->getBody()->write("Producto modificado con exito");
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
        
        $response->getBody()->write("Producto eliminado con exito");
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
}
