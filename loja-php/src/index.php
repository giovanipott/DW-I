<?php
declare(strict_types=1);

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loja PHP</title>
</head>
<body>
    <h1>Loja PHP</h1>
    <ul>
        <li><a href="login.php">Entrar</a></li>
        <li><a href="painel.php">Painel (restrito)</a></li>
        <li><a href="carrinho.php">Carrinho</a></li>
        <li><a href="produtos/">Produtos</a></li>
    </ul>
</body>
</html>
