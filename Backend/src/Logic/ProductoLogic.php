<?php

namespace Logic;

use Common\Dto\ProductoDto;
use Common\ExceptionManager\ApplicationException;
use Common\Mappings\ProductoMapping;
use Common\Util\ValidationHelper;
use Db\ProductoDb;

include_once __DIR__ . '/../Common/Util/ValidationHelper.php';
include_once __DIR__ . '/../Common/ExceptionManager/ApplicationException.php';
include_once __DIR__ . '/../Common/Mappings/ProductoMapping.php';
include_once __DIR__ . '/../Db/ProductoDb.php';

class ProductoLogic
{

  public function Crear(ProductoDto $dto)
 {
    $erroresProducto = ValidationHelper::ValidarCreateProductoRequest($dto);

    if (count($erroresProducto) > 0) {
      foreach($erroresProducto as $error)
      {
         echo $error."\n";
      }
     return  json_encode($erroresProducto);
    }

    $productoNuevo = ProductoMapping::ToProducto($dto, 0);
     ProductoDb::createProduct($productoNuevo);
  }

  public function Modificar(ProductoDto $dto)
  {
    $erroresProducto = ValidationHelper::ValidarModifyProductoRequest($dto->id);
    if (count($erroresProducto) > 0) {
      foreach($erroresProducto as $error)
      {
        echo $error."\n";
      }

      return;
    }

    $productoById = ProductoDb::getProductoById($dto->id);
    if($productoById != null)
    {
      $producto = ProductoMapping::ToProducto($dto, $dto->id);
      ProductoDb::modify($producto);
    }
    else 
    {
      throw new ApplicationException("No se encontro el producto.");
    }
  }

  public function Eliminar(string $id)
  {
    $errores = [];
    $erroresUsuario = ValidationHelper::ValidarDeleteUsuarioRequest($id);

    if (count($erroresUsuario) > 0) {
      foreach($errores as $error)
      {
        echo $error."\n";
      }

      return;
    }

    $producto = ProductoDb::getProductoById(intval($id));
    if($producto != null)
    {
      ProductoDb::delete($producto->getId());
      
    }
    else 
    {
      throw new ApplicationException("No se encontro el empleado.");
    }
  }
}
