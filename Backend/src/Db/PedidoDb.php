<?php

namespace Db;

use Common\ExceptionManager\ApplicationException;
use Common\Util\DbQueryBuilder;
use Common\Mappings\PedidoMapping;
use Db\db;
use Model\Pedido;
use PDO;
use PHPUnit\Framework\Exception;
use Slim\Http\Message;

include_once __DIR__ . '/../Db/db.php';
include_once __DIR__ . '/../Common/Util/DbQueryBuilder.php';

abstract class PedidoDb extends db
{
    private $id;
    private $codigo;
    private $nombreCliente;
    private $foto;
    private $estado;
    private $tiempoEstimado;
    private $mesaId;
    private $mozoId;
    private $puntajeMozo;
    private $puntajeMesa;

    public static function create(Pedido $pedido)
    {
        try {
            $SQL = 'INSERT INTO pedidos (codigo, nombreCliente, foto, estado, tiempoEstimado, mesaId, mozoId, puntajeMesa, puntajeMozo) 
            VALUES (?,?,?,?,?,?,?,?,?)';
            $result = db::connect()->prepare($SQL);
            $result->execute(array(
                $pedido->getCodigo(),
                $pedido->getNombreCliente(),
                null, // $pedido->getFoto(),
                $pedido->getEstado(),
                $pedido->getTiempoEstimado(),
                $pedido->getMesaId(),
                $pedido->getMozoId(),
                null,
                null,
            ));
        } catch (Exception $e) {
            throw new Exception("No se pudo insertar en la base de datos", 1);
        } 
    }

    public static function modifyEstado(Pedido $pedido)
    {
         try {
        $updateFields = DbQueryBuilder::BuildUpdateFields(
            [ 'Estado'],
            [$pedido->getEstado()]
        );

        $SQL = 'UPDATE pedidos SET ' . $updateFields . ' WHERE Id=?';
        $result = db::connect()->prepare($SQL);
        $result->execute(array(
            $pedido->getId()
        ));

        } catch (Exception $e) {
            var_dump($e);
        } 
    }

    public static function modifyPuntajes(Pedido $pedido)
    {
         try {
        $updateFields = DbQueryBuilder::BuildUpdateFields(
            [ 'puntajeMesa', 'puntajeMozo'],
            [$pedido->getpuntajeMesa(), $pedido->getPuntajeMozo()]
        );

        $SQL = 'UPDATE pedidos SET ' . $updateFields . ' WHERE Id=?';
        $result = db::connect()->prepare($SQL);
        $result->execute(array(
            $pedido->getId()
        ));

        } catch (Exception $e) {
            var_dump($e);
        } 
    }


    public static function delete(int $id)
    {
     try {
        $SQL = 'DELETE FROM pedidos WHERE Id=?';
        $result = db::connect()->prepare($SQL);
        $result->execute(array(
            $id
        ));

        } catch (Exception $e) {
            var_dump($e);
        }
    }

    public static function getPedidoById(int $pedidoId)
    {
        $SQL = 'SELECT * FROM pedidos WHERE  Id = ?';
        $result = db::connect()->prepare($SQL);
        $result->execute(array(
            $pedidoId
        ));
        $data = $result->fetch(PDO::FETCH_OBJ);
        if ($data) {
            return PedidoMapping::dbDataToPedido($data);
        } else {
            throw new ApplicationException("No existe la Pedido");
        }
    }

    public static function getPedidoByCode(string $codigo)
    {
        $SQL = 'SELECT * FROM pedidos WHERE  codigo = ?';
        $result = db::connect()->prepare($SQL);
        $result->execute(array(
            $codigo
        ));
        $data = $result->fetch(PDO::FETCH_OBJ);
        if ($data) {
            return PedidoMapping::dbDataToPedido($data);
        } else {
            throw new ApplicationException("No existe el Pedido");
        }
    }
}
