<?php
require __DIR__ . '/../autoload.php'; 
use App\Database\Conexao;

$pdo = Conexao::get();
$id = (int)($_GET['id'] ?? 0);
$stmt = $pdo->prepare('SELECT * FROM produtos WHERE id = :id'); 
$stmt->execute([':id' => $id]);
$p = $stmt->fetch(); if (!$p) { 
    http_response_code(404); exit('Não encontrado'); 
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $pdo->prepare('UPDATE produtos SET nome=:n, preco=:p, estoque=:e WHERE id=:id')
      ->execute([':n'=>$_POST['nome'], ':p'=>$_POST['preco'], ':e'=>$_POST['estoque'], ':id'=>$id]);
  header('Location: index.php'); exit;
}
?>
<form method="post">
  Nome <input name="nome" required>
  Preço <input name="preco" type="number" step="0.01" required>
  Estoque <input name="estoque" type="number" required>
  <button>Salvar</button>
</form>