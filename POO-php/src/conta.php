<?php
class Conta
{
    private float $saldo = 0.0;

    public function depositar(float $valor): void
    {
        if ($valor <= 0) {
            throw new InvalidArgumentException("Valor inválido");
        }

        $this->saldo += $valor;
    }

    public function sacar(float $valor): void
    {
        if ($valor <= 0) {
            throw new InvalidArgumentException("Valor inválido");
        }

        if (($this->saldo - $valor) < 0) {
            throw new InvalidArgumentException("Saldo insuficiente");
        }

        $this->saldo -= $valor;
    }

    public function getSaldo(): float
    {
        return $this->saldo;
    }
}
