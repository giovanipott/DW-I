<?php
declare(strict_types=1);

require_once __DIR__ . '/autoload.php';

use App\Support\CarrinhoSessao;

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if ($id === false || $id === null || $id <= 0) {
    http_response_code(400);
    exit('ID de produto inválido.');
}

$carrinho = new CarrinhoSessao();
$carrinho->remover($id);

header('Location: carrinho.php');
exit;
