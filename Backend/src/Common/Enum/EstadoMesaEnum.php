<?php
declare(strict_types=1);
namespace Common\Enum;

abstract class Enum_EstadoMesa{
    const Abierta = 1;
    const Comiendo = 3;
    const Pagando = 4;
    const EsperandoPedido = 2;
    const Cerrada = 5;
}
?>