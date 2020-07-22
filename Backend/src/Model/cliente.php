<?php
declare(strict_types=1);

namespace App\Model;

use JsonSerializable;

class Cliente implements Usuario
{

    private $numeroCliente;
    
    public function __construct($numeroCliente)
    {
        $this->numeroCliente = $numeroCliente;

    }

    public function getId(): ?int
    {
        return $this->numeroCliente;
    }

    public function jsonSerialize()
    {
        return  parent::jsonSerialize().array_merge([
            'numeroCliente' => $this->numeroCliente
        ]);
    }
}
