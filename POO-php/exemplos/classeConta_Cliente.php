<?php

require_once "./main.php"

$cliente = new Cliente("Giovani", "giovani@email.com");

echo "Nome: " . $cliente->nome . "<br>";
echo "E-mail: " . $cliente->getEmail() . "<br>";

$conta = new Conta();

$conta->depositar(1000);
$conta->sacar(250);

echo "Saldo: R$ " . number_format(
    $conta->getSaldo(),
    2,",",".") . "<br>";