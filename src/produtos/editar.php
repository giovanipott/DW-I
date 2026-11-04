<?php
require __DIR__ . '/../autoload.php'; 
use App\Database\Conexao;

$pdo = Conexao::get();
$id = (int)($_GET['id'] ?? 0);
$stmt = $pdo->prepare('SELECT * FROM produtos WHERE id = :id'); 
$stmt->execute([':id' => $id]);
$p = $stmt->fetch();
if (!$p) { 
  http_response_code(404); exit('Não encontrado'); 
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $f = $_FILES['foto'] ?? null;
  if (!$f || $f['error'] !== UPLOAD_ERR_OK) exit('Sem arquivo anexado!');

  if ($f['size'] > 2 * 1024 * 1024) exit('árquivo de no máximo 2 MB');

  $mime = (new finfo(FILEINFO_MIME_TYPE))->file($f['tmp_name']);
  $ext = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/webp' => 'webp'][$mime] ?? null;
  if (!$ext) exit('Formato não permitido');

  $novoNome = bin2hex(random_bytes(8)) . '.' . $ext;     // nome aleatório
  $destino  = __DIR__ . '/uploads/' . $novoNome;
  if (!move_uploaded_file($f['tmp_name'], $destino)) exit('Erro ao salvar');
  // guardar $novoNome na coluna produtos.imagem
  unlink("/uploads/{$p->imagem}");
  
  $pdo->prepare('UPDATE produtos SET nome=:n, preco=:p, estoque=:e, imagem=:i WHERE id=:id')
      ->execute([':n'=>$_POST['nome'], ':p'=>$_POST['preco'], ':e'=>$_POST['estoque'] ':e'=>$novoNome, ':id'=>$id]);
  header('Location: index.php'); exit;
}
?>
<form method="post"  enctype="multipart/form-data">
  Nome <input name="nome" required>
  Preço <input name="preco" type="number" step="0.01" required>
  Estoque <input name="estoque" type="number" required>
  <input type="file" name="foto" accept="image/*" required>
  <button>Salvar</button>
</form>


