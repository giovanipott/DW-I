<?php
declare(strict_types=1);

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (!isset($_SESSION['usuario']) || !is_array($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}

$nome = htmlspecialchars((string) ($_SESSION['usuario']['nome'] ?? 'Usuário'), ENT_QUOTES, 'UTF-8');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel</title>
</head>
<body>
    <h1>Olá, <?= $nome ?>!</h1>
    <p>Você entrou na área restrita.</p>
    <a href="sair.php">Sair</a>
</body>
</html>
