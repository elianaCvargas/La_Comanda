<?php

namespace Db;

use Common\Enum\Enum_EstadoDetallePedido;
use Common\Enum\Enum_EstadoPedido;
use Common\Enum\Enum_RolesEmpleados;
use Common\Enum\Enum_TipoProducto;
use Common\Enum\TipoProductoEnum;
use Common\ExceptionManager\ApplicationException;
use Common\Util\DbQueryBuilder;
use Common\Mappings\DetallePedidoMapping;
use Db\db;
use Model\DetallePedido;
use PDO;
use PHPUnit\Framework\Exception;
use Slim\Http\Message;
use View\PedidosPendientes;

include_once __DIR__ . '/../Db/db.php';
include_once __DIR__ . '/../Common/Util/DbQueryBuilder.php';
include_once __DIR__ . '/../Common/Enum/TipoProductoEnum.php';
include_once __DIR__ . '/../View/pedidosPendientes.php';

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
            throw new Exception("No se pudo insertar en la base de datos", 1);
        } 
    }

    public static function modifyEstado(DetallePedido $detallePedido)
    {
        try {
        $updateFields = DbQueryBuilder::BuildUpdateFields(
            [ 'estado', 'inicio', 'fin', 'responsable'],
            [$detallePedido->getEstado()
            , $detallePedido->getInicio()
            , $detallePedido->getFin()
            , $detallePedido->getResponsable()]
        );

        $SQL = 'UPDATE detallePedido SET ' . $updateFields . ' WHERE Id=?';
        $result = db::connect()->prepare($SQL);
        $result->execute(array(
            $detallePedido->getId()
        ));

        } catch (Exception $e) {
            return $e;
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

    public static function getDetallePedidoById(int $id):DetallePedido
    {
        $SQL = 'SELECT * FROM detallePedido WHERE  Id = ?';
        $result = db::connect()->prepare($SQL);
        $result->execute(array(
            $id
        ));
        $data = $result->fetch(PDO::FETCH_OBJ);
        if ($data) {
            
            $detallePedido =DetallePedidoMapping::dbDataToDetallePedido($data);
            //  var_dump($data);
            return $detallePedido;

        } else {
            throw new ApplicationException("No existe el detalle pedido");
        }
    }

    public static function GetPedidoDetalleByRol(int $rolEmpleado)
    {
        switch($rolEmpleado)
        {
            case Enum_RolesEmpleados::Cocinero:
                $pedidos = DetallePedidoDb::getPedidosCocina();
                return $pedidos;
            break;
            case Enum_RolesEmpleados::Bartender:
                $pedidos = DetallePedidoDb::getPedidosTragosYVinos();
                return $pedidos;
            break;
            case Enum_RolesEmpleados::Cervecero:
                $pedidos = DetallePedidoDb::getPedidosCerveza();
                return $pedidos;
            break;

        }
        
    } 

    public static function TodosPlatosListos(int $pedidoId): bool
    {
        $SQL = 
        'SELECT COUNT(*)   
        FROM detallePedido dp
        WHERE dp.Pedido = ? && dp.Estado != ? ';
        $result = db::connect()->prepare($SQL);
        $result->execute(array(
           $pedidoId,
           Enum_EstadoDetallePedido::Listo
        ));
        $data = $result->fetch();
  
        if ($data && intval($data) == 0) {
          return true;
        } else 
        {
            return false;
        }
    }

    private static function getPedidosCocina()
    {
        $SQL = 
        'SELECT dp.Pedido, ped.Codigo,  p.Nombre, ep.Estado,  p.TiempoEstimado    
        FROM detallePedido dp
        JOIN productos p ON dp.ProductoId = p.Id
        JOIN estadodetallepedido ep ON dp.Estado = ep.Id
        JOIN pedidos ped ON dp.Pedido = ped.Id
        WHERE ep.Id != ? && p.TipoProductoId = ? || p.TipoProductoId = ?
        ORDER BY ep.Id DESC, dp.Pedido ';
        $result = db::connect()->prepare($SQL);
        $result->execute(array(
            Enum_EstadoDetallePedido::Listo,
            Enum_TipoProducto::Cocina,
            Enum_TipoProducto::CandyBar
        ));
        $data = $result->fetchAll();
        $listaPedidosPendientes = [];

        if ($data) {
          foreach($data as $item)
          {
            $pedidoJson =  json_encode($item);
            $pedidoObj = json_decode( $pedidoJson);
            $pedidoDetalle =  new PedidosPendientes();
            $pedidoDetalle->pedidoId = $pedidoObj->Pedido;
            $pedidoDetalle->codigo = $pedidoObj->Codigo;
            $pedidoDetalle->nombre = $pedidoObj->Nombre;
            $pedidoDetalle->estado = $pedidoObj->Estado;
            $pedidoDetalle->tiempoEstimado = $pedidoObj->TiempoEstimado;
            // array_push($listaPedidosPendientes,  $pedidoDetalle);
            $listaPedidosPendientes [] =  $pedidoDetalle;
          }
          return $listaPedidosPendientes;
        } else {
            throw new ApplicationException("El empleado no tiene pedidos pendientes ni activos");
        }
    }

    private static function getPedidosTragosYVinos()
    {
        $SQL = 
        'SELECT dp.Pedido, ped.Codigo,  p.Nombre, ep.Estado,  p.TiempoEstimado    
        FROM detallePedido dp
        JOIN productos p ON dp.ProductoId = p.Id
        JOIN estadodetallepedido ep ON dp.Estado = ep.Id
        JOIN pedidos ped ON dp.Pedido = ped.Id
        WHERE ep.Id != ? && p.TipoProductoId = ?
        ORDER BY dp.Pedido, ep.Estado';
        $result = db::connect()->prepare($SQL);
        $result->execute(array(
            Enum_EstadoDetallePedido::Listo,
            Enum_TipoProducto::TragosYVinos,
        ));
        $data = $result->fetchAll();
        $listaPedidosPendientes = [];

        if ($data) {
          foreach($data as $item)
          {
            $pedidoJson =  json_encode($item);
            $pedidoObj = json_decode( $pedidoJson);
            $pedidoDetalle =  new PedidosPendientes();
            $pedidoDetalle->pedidoId = $pedidoObj->Pedido;
            $pedidoDetalle->codigo = $pedidoObj->Codigo;
            $pedidoDetalle->nombre = $pedidoObj->Nombre;
            $pedidoDetalle->estado = $pedidoObj->Estado;
            $pedidoDetalle->tiempoEstimado = $pedidoObj->TiempoEstimado;
            // array_push($listaPedidosPendientes,  $pedidoDetalle);
            $listaPedidosPendientes [] =  $pedidoDetalle;
          }
          return $listaPedidosPendientes;
        } else {
            throw new ApplicationException("El empleado no tiene pedidos pendientes ni activos");
        }
    }

    private static function getPedidosCerveza()
    {
        $SQL = 
        'SELECT dp.Pedido, ped.Codigo,  p.Nombre, ep.Estado,  p.TiempoEstimado    
        FROM detallePedido dp
        JOIN productos p ON dp.ProductoId = p.Id
        JOIN estadodetallepedido ep ON dp.Estado = ep.Id
        JOIN pedidos ped ON dp.Pedido = ped.Id
        WHERE ep.Id != ? && p.TipoProductoId = ?
        ORDER BY dp.Pedido, ep.Estado';
        $result = db::connect()->prepare($SQL);
        $result->execute(array(
            Enum_EstadoDetallePedido::Listo,
            Enum_TipoProducto::BarCervezas,
        ));
        $data = $result->fetchAll();
        $listaPedidosPendientes = [];

        if ($data) {
          foreach($data as $item)
          {
            $pedidoJson =  json_encode($item);
            $pedidoObj = json_decode( $pedidoJson);
            $pedidoDetalle =  new PedidosPendientes();
            $pedidoDetalle->pedidoId = $pedidoObj->Pedido;
            $pedidoDetalle->codigo = $pedidoObj->Codigo;
            $pedidoDetalle->nombre = $pedidoObj->Nombre;
            $pedidoDetalle->estado = $pedidoObj->Estado;
            $pedidoDetalle->tiempoEstimado = $pedidoObj->TiempoEstimado;
            // array_push($listaPedidosPendientes,  $pedidoDetalle);
            $listaPedidosPendientes [] =  $pedidoDetalle;
          }
          return $listaPedidosPendientes;
        } else {
            throw new ApplicationException("El empleado no tiene pedidos pendientes ni activos");
        }
    }

    private static function getPedidosMozo()
    {
        $SQL = 
        'SELECT dp.Pedido, ped.Codigo,  p.Nombre, ep.Estado,  p.TiempoEstimado    
        FROM detallePedido dp
        JOIN productos p ON dp.ProductoId = p.Id
        JOIN estadodetallepedido ep ON dp.Estado = ep.Id
        JOIN pedidos ped ON dp.Pedido = ped.Id
        WHERE ep.Id != ? && p.TipoProductoId = ?
        ORDER BY dp.Pedido, ep.Estado';
        $result = db::connect()->prepare($SQL);
        $result->execute(array(
            Enum_EstadoDetallePedido::Listo,
            Enum_TipoProducto::Cerveza,
        ));
        $data = $result->fetchAll();
        $listaPedidosPendientes = [];

        if ($data) {
          foreach($data as $item)
          {
            $pedidoJson =  json_encode($item);
            $pedidoObj = json_decode( $pedidoJson);
            $pedidoDetalle =  new PedidosPendientes();
            $pedidoDetalle->pedidoId = $pedidoObj->Pedido;
            $pedidoDetalle->codigo = $pedidoObj->Codigo;
            $pedidoDetalle->nombre = $pedidoObj->Nombre;
            $pedidoDetalle->estado = $pedidoObj->Estado;
            $pedidoDetalle->tiempoEstimado = $pedidoObj->TiempoEstimado;
            // array_push($listaPedidosPendientes,  $pedidoDetalle);
            $listaPedidosPendientes [] =  $pedidoDetalle;
          }
          return $listaPedidosPendientes;
        } else {
            throw new ApplicationException("El empleado no tiene pedidos pendientes ni activos");
        }
    }
}
