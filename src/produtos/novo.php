<form method="post" enctype="multipart/form-data">
  Nome <input name="nome" required>
  Tipo <select name="tipo">
    <option value="fisico">Físico</option>
    <option value="digital">Digital</option>
  </select>
  Peso <input name="peso" type="number">
  Link <input name="link" type="text">
  Preço <input name="preco" type="number" step="0.01" required>
  Estoque <input name="estoque" type="number" required>
  <input type="file" name="foto" accept="image/*">
  <?php 
    require __DIR__ . '/../autoload.php'; 
    use App\DAO\ProdutoDAO; use App\Model\{ProdutoFisico, ProdutoDigital}; use App\Database\Conexao;
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $n = trim($_POST['nome']); 
      $pr = (float)$_POST['preco']; $e = (int)$_POST['estoque'];
      
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

      $p = $_POST['tipo'] === 'digital' ? new ProdutoDigital(null, $n, $pr, $e, $novoNome, trim($_POST['link']))
                                        : new ProdutoFisico(null, $n, $pr, $e, $novoNome, (float)$_POST['peso']);
      (new ProdutoDAO(Conexao::get()))->inserir($p); header('Location: index.php'); exit;
    }
  ?>
  <button>Salvar</button>
</form>
