<?php
namespace Common\Mappings;

use Common\Dto;
use Model\Acceso;

include_once __DIR__ . '/../../Model/acceso.php';

class AccesoMapping{

	public static function ToAcceso($empleadoId, $fecha): Acceso{
        $acceso = new Acceso();
        $acceso->setEmpleadoId($empleadoId);
        $acceso->setFecha($fecha);
        return $acceso;
        }
        
}
