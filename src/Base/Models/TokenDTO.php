<?php

namespace App\Base\Models;

class TokenDTO implements \JsonSerializable
{
    /**
     * @var string
     */
    private $token;

    /**
     * @var string
     */
    private $tipo;
    
    public function __construct(string $token, string $tipo)
    {
        $this->token = $token;
        $this->tipo = $tipo;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function setToken(string $token): self
    {
        $this->token = $token;

        return $this;
    }

    public function getTipo(): string
    {
        return $this->tipo;
    }

    public function setTipo(string $tipo): self
    {
        $this->tipo = $tipo;

        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'token' => $this->getToken(),
            'tipo' => $this->getTipo()
        ];
    }
}