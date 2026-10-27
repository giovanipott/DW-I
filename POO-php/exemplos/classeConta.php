<?php
declare(strict_types=1);

require_once __DIR__ . '/../src/conta.php';

$conta = new Conta();
$conta->depositar(1000);
$conta->sacar(250);

echo 'Saldo: R$ ' . number_format($conta->getSaldo(), 2, ',', '.') . '<br>';
