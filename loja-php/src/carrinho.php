<?php
declare(strict_types=1);

require_once __DIR__ . '/autoload.php';

use App\Support\CarrinhoSessao;

$carrinho = new CarrinhoSessao();
$itens = $carrinho->itens();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho</title>
</head>
<body>
    <h1>Meu carrinho</h1>
    <?php if ($itens === []): ?>
        <p>Seu carrinho está vazio.</p>
    <?php else: ?>
        <ul>
            <?php foreach ($itens as $id => $qtd): ?>
                <li>
                    Produto #<?= (int) $id ?> — quantidade: <?= (int) $qtd ?>
                    <a href="remover.php?id=<?= (int) $id ?>">Remover</a>
                </li>
            <?php endforeach; ?>
        </ul>
        <p><a href="limpar-carrinho.php">Limpar carrinho</a></p>
    <?php endif; ?>
    <p><a href="index.php">Voltar à loja</a></p>
</body>
</html>
