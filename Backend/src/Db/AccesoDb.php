<?php

namespace Db;

use Common\ExceptionManager\ApplicationException;
use Common\Util\DbQueryBuilder;
use Common\Mappings\MesaMapping;
use DateTime;
use Db\db;
use Model\Acceso;
use Model\Mesa;
use PDO;
use PHPUnit\Framework\Exception;
use Slim\Http\Message;

include_once __DIR__ . '/../Db/db.php';
include_once __DIR__ . '/../Common/Util/DbQueryBuilder.php';

abstract class AccesoDb extends db
{

    public static function create(Acceso $acceso)
    {
        try {
            $SQL = 'INSERT INTO accesos (EmpleadoId, Fecha) VALUES (?,?)';
            $result = db::connect()->prepare($SQL);
            $result->execute(array(
                $acceso->getEmpleadoId(),
                date('Y-m-d H:i:s', time()),
            ));
        } catch (Exception $e) {
        }
    }


}
