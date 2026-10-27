<?php
declare(strict_types=1);

require_once __DIR__ . '/autoload.php';

use App\Support\CarrinhoSessao;

$carrinho = new CarrinhoSessao();
$carrinho->limpar();

header('Location: carrinho.php');
exit;
