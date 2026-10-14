<?php

require_once "/src/cliente.php";

$cliente = new Cliente("Giovani", "giovani@email.com");

echo "Nome: " . $cliente->nome . "<br>";
echo "E-mail: " . $cliente->getEmail() . "<br>";
