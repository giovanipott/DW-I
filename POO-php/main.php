<?php
declare(strict_types=1);

require_once __DIR__ . '/src/produto.php';
require_once __DIR__ . '/src/carrinho.php';

$produto = new Produto(1, 'Teclado', 120.00, 10);
$carrinho = new Carrinho();
$carrinho->adicionar($produto, 2);

echo 'Total do carrinho: R$ ' . number_format($carrinho->total(), 2, ',', '.') . '<br>';
