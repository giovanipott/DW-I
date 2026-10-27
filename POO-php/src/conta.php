<?php
declare(strict_types=1);

class Conta
{
    private float $saldo = 0.0;

    public function depositar(float $valor): void
    {
        if (!is_finite($valor) || $valor <= 0) {
            throw new InvalidArgumentException('O valor do depósito deve ser positivo.');
        }

        $this->saldo += $valor;
    }

    public function sacar(float $valor): void
    {
        if (!is_finite($valor) || $valor <= 0) {
            throw new InvalidArgumentException('O valor do saque deve ser positivo.');
        }

        if ($valor > $this->saldo) {
            throw new InvalidArgumentException('Saldo insuficiente.');
        }

        $this->saldo -= $valor;
    }

    public function getSaldo(): float
    {
        return $this->saldo;
    }
}
