<?php
declare(strict_types=1);

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim((string) ($_POST['email'] ?? ''));
    $senha = (string) ($_POST['senha'] ?? '');

    // Credenciais de demonstração; em produção, use banco de dados e password_verify().
    if ($email === 'admin@loja.com' && $senha === '123456') {
        session_regenerate_id(true);
        $_SESSION['usuario'] = [
            'nome' => 'Admin',
            'email' => $email,
        ];

        header('Location: painel.php');
        exit;
    }

    $erro = 'Credenciais inválidas.';
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Entrar</h1>
    <?php if ($erro !== ''): ?>
        <p role="alert"><?= htmlspecialchars($erro, ENT_QUOTES, 'UTF-8') ?></p>
    <?php endif; ?>
    <form method="post" action="login.php">
        <label for="email">E-mail</label>
        <input id="email" name="email" type="email" required
               value="<?= htmlspecialchars((string) ($_POST['email'] ?? ''), ENT_QUOTES, 'UTF-8') ?>">
        <label for="senha">Senha</label>
        <input id="senha" name="senha" type="password" required>
        <button type="submit">Entrar</button>
    </form>
    <p><a href="index.php">Voltar</a></p>
</body>
</html>
