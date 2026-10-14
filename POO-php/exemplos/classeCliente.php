<?php

require_once "./main.php"

$cliente = new Cliente("Giovani", "giovani@email.com");

echo "Nome: " . $cliente->nome . "<br>";
echo "E-mail: " . $cliente->getEmail() . "<br>";
