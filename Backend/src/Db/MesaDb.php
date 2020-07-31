<?php

namespace Db;

use Common\ExceptionManager\ApplicationException;
use Common\Util\DbQueryBuilder;
use Common\Mappings\MesaMapping;
use Db\db;
use Model\Mesa;
use PDO;
use PHPUnit\Framework\Exception;
use Slim\Http\Message;

include_once __DIR__ . '/../Db/db.php';
include_once __DIR__ . '/../Common/Util/DbQueryBuilder.php';

abstract class MesaDb extends db
{

    public static function create(Mesa $mesa)
    {
        try {
            $SQL = 'INSERT INTO mesas (Codigo, EstadoMesaId) VALUES (?,?)';
            $result = db::connect()->prepare($SQL);
            $result->execute(array(
                $mesa->getCodigo(),
                $mesa->getEstado(),
            ));
        } catch (Exception $e) {
        }
    }

    public static function modify(Mesa $mesa)
    {
        try {
            $updateFields = DbQueryBuilder::BuildUpdateFields(
                ['Codigo', 'Estado'],
                [$mesa->getCodigo(), $mesa->getEstado()]
            );

            $SQL = 'UPDATE mesas SET ' . $updateFields . ' WHERE Id=?';
            $result = db::connect()->prepare($SQL);
            $result->execute(array(
                $mesa->getId()
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

    public static function getMesaById(int $mesaId)
    {
        $SQL = 'SELECT * FROM mesas WHERE  Id = ?';
        $result = db::connect()->prepare($SQL);
        $result->execute(array(
            $mesaId
        ));
        $data = $result->fetch(PDO::FETCH_OBJ);
        if ($data) {
            return MesaMapping::dbDataToMesa($data);
        } else {
            throw new ApplicationException("No existe la Mesa");
        }
    }

    public static function alterarEstadoMesa(int $mesaId, int $estado)
    {
        try {
            $SQL = 'UPDATE mesas SET EstadoMesaId = ?  WHERE  Id = ?';
            $result = db::connect()->prepare($SQL);
            $result->execute(array(
                $estado,
                $mesaId
            ));
        } catch (Exception $e) {
        }
    }
}
