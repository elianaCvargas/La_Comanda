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
            $SQL = 'INSERT INTO pedidos (Codigo, NombreCliente, Foto, Estado,  MesaId, MozoId, PuntajeMozo, PuntajeMesa) 
            VALUES (?,?,?,?,?,?,?)';
            $result = db::connect()->prepare($SQL);
            $result->execute(array(
                $pedido->getCodigo(),
                $pedido->getNombreCliente(),
                $pedido->getFoto(),
                $pedido->getEstado(),
                $pedido->getMesaId(),
                $pedido->getMozoId(),
                $pedido->getpuntajeMozo(),
                $pedido->getpuntajeMesa()
            ));
        } catch (Exception $e) {
            
        } 
    }

    public static function modify(Mesa $pedido)
    {
         try {
        $updateFields = DbQueryBuilder::BuildUpdateFields(
            [ 'Codigo', 'Estado'],
            [$pedido->getCodigo(), $pedido->getEstado()]
        );

        $SQL = 'UPDATE mesas SET ' . $updateFields . ' WHERE Id=?';
        $result = db::connect()->prepare($SQL);
        $result->execute(array(
            $pedido->getId()
        ));

        } catch (Exception $e) {
        } 
    }


    public static function delete(int $id)
    {
     try {
        $SQL = 'DELETE FROM mesas WHERE Id=?';
        $result = db::connect()->prepare($SQL);
        $result->execute(array(
            $id
        ));

        } catch (Exception $e) {
        }
    }

    public static function getMesaById(int $pedidoId)
    {
        $SQL = 'SELECT * FROM mesas WHERE  Id = ?';
        $result = db::connect()->prepare($SQL);
        $result->execute(array(
            $pedidoId
        ));
        $data = $result->fetch(PDO::FETCH_OBJ);
        if ($data) {
            return MesaMapping::dbDataToMesa($data);
        } else {
            throw new ApplicationException("No existe la Mesa");
        }
    }
}
