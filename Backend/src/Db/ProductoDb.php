<?php

namespace Db;

use Common\ExceptionManager\ApplicationException;
use Common\Util\DbQueryBuilder;
use Common\Mappings\ProductoMapping;
use Db\db;
use Model\Producto;
use PDO;
use PHPUnit\Framework\Exception;
use Slim\Http\Message;

include_once __DIR__ . '/../Db/db.php';
include_once __DIR__ . '/../Common/Util/DbQueryBuilder.php';

abstract class ProductoDb extends db
{
    public static function createProduct(Producto $producto)
    {
        try {
            $SQL = 'INSERT INTO productos (Nombre, TiempoEstimado, TipoProductoId, Precio) VALUES (?,?,?,?)';
            $result = db::connect()->prepare($SQL);
            $result->execute(array(
                $producto->getNombre(),
                $producto->getTiempoEstimado(),
                $producto->getTipo(),
                $producto->getPrecio()
            ));
        } catch (Exception $e) {
            
        } 
    }

    public static function modify(Producto $producto)
    {
         try {
        $updateFields = DbQueryBuilder::BuildUpdateFields(
            [ 'Nombre', 'TiempoEstimado', 'TipoProductoId', 'Precio'],
            [$producto->getNombre(), $producto->getTiempoEstimado(), $producto->getTipo(), $producto->getPrecio()]
        );

        $SQL = 'UPDATE productos SET ' . $updateFields . ' WHERE Id=?';
        $result = db::connect()->prepare($SQL);
        $result->execute(array(
            $producto->getId()
        ));

        } catch (Exception $e) {
        } 
    }


    public static function delete(int $id)
    {
     try {
        $SQL = 'DELETE FROM productos WHERE Id=?';
        $result = db::connect()->prepare($SQL);
        $result->execute(array(
            $id
        ));

        } catch (Exception $e) {
        }
    }

    public static function getProductoById(int $productoId)
    {
        $SQL = 'SELECT * FROM productos WHERE  Id = ?';
        $result = db::connect()->prepare($SQL);
        $result->execute(array(
            $productoId
        ));
        $data = $result->fetch(PDO::FETCH_OBJ);
        if ($data) {
            return ProductoMapping::dbDataToProducto($data);
        } else {
            throw new ApplicationException("No existe el producto");
        }
    }
}
