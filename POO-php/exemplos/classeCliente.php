<?php
declare(strict_types=1);

require_once __DIR__ . '/../src/cliente.php';

$cliente = new Cliente('Giovani', 'giovani@email.com');

echo 'Nome: ' . htmlspecialchars($cliente->nome, ENT_QUOTES, 'UTF-8') . '<br>';
echo 'E-mail: ' . htmlspecialchars($cliente->getEmail(), ENT_QUOTES, 'UTF-8') . '<br>';
