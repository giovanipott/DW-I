<?php
declare(strict_types=1);

trait Loggable
{
    public function log(string $msg): void
    {
        $mensagem = htmlspecialchars($msg, ENT_QUOTES, 'UTF-8');
        echo '[' . static::class . '] ' . $mensagem . '<br>';
    }
}

class Pedido
{
    use Loggable;
}

class Cliente
{
    use Loggable;
}

(new Pedido())->log('criado');
(new Cliente())->log('cadastrado');
