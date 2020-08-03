<?php

namespace Db;

use Common\ExceptionManager\ApplicationException;
use Common\Util\DbQueryBuilder;
use Common\Mappings\DetallePedidoMapping;
use Db\db;
use Model\DetallePedido;
use PDO;
use PHPUnit\Framework\Exception;
use Slim\Http\Message;

include_once __DIR__ . '/../Db/db.php';
include_once __DIR__ . '/../Common/Util/DbQueryBuilder.php';

abstract class DetallePedidoDb extends db
{
    public static function create(DetallePedido $detallePedido)
    {
        try {
            $SQL = 'INSERT INTO detallePedido (pedido, responsable, estado, inicio, fin, productoId, puntaje) 
            VALUES (?,?,?,?,?,?,?)';
            $result = db::connect()->prepare($SQL);
            $result->execute(array(
                $detallePedido->getPedido(),
                $detallePedido->getResponsable(),
                $detallePedido->getEstado(),
                $detallePedido->getInicio(),
                $detallePedido->getFin(),
                $detallePedido->getProductoId(),
                $detallePedido->getPuntaje(),
            ));
        } catch (Exception $e) {
            echo "No se pudo insertar en la base de datos";
            var_dump($e);
            throw new Exception("No se pudo insertar en la base de datos", 1);
        } 
    }

    public static function modifyEstado(DetallePedido $detallePedido)
    {
        try {
        $updateFields = DbQueryBuilder::BuildUpdateFields(
            [ 'estado', 'inicio', 'fin'],
            [$detallePedido->getEstado(), $detallePedido->getInicio(), $detallePedido->getFin()]
        );

        $SQL = 'UPDATE detallePedido SET ' . $updateFields . ' WHERE Id=?';
        $result = db::connect()->prepare($SQL);
        $result->execute(array(
            $detallePedido->getId()
        ));

        } catch (Exception $e) {
            var_dump($e);
        } 
    }

    public static function modifyPuntaje(DetallePedido $detallePedido)
    {
        try {
        $updateFields = DbQueryBuilder::BuildUpdateFields(
            [ 'puntaje'],
            [$detallePedido->getPuntaje()]
        );

        $SQL = 'UPDATE detallePedido SET ' . $updateFields . ' WHERE Id=?';
        $result = db::connect()->prepare($SQL);
        $result->execute(array(
            $detallePedido->getId()
        ));

        } catch (Exception $e) {
            var_dump($e);
        } 
    }

    public static function getDetallePedidoById(int $id)
    {
        $SQL = 'SELECT * FROM detallePedido WHERE  Id = ?';
        $result = db::connect()->prepare($SQL);
        $result->execute(array(
            $id
        ));
        $data = $result->fetch(PDO::FETCH_OBJ);
        if ($data) {
            return DetallePedidoMapping::dbDataToDetallePedido($data);
        } else {
            throw new ApplicationException("No existe la Mesa");
        }
    }
}
