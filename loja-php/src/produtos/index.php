<?php require __DIR__ . '/../autoload.php';
use App\DAO\ProdutoDAO; 
use App\Database\Conexao;
$produtos = (new ProdutoDAO(Conexao::get()))->listar();   // objetos Produto
?> 

<a href="novo.php">+ Novo produto</a>
<table border="1">
  <tr>
<th>ID</th><th>Nome</th><th>Preço</th><th>Estoque</th><th></th>
  </tr>
  <?php foreach ($produtos as $p): ?>
  <tr>
    <td><?= $p->getId() ?></td><td><?= htmlspecialchars($p->getNome()) ?></td>
    <td>R$ <?= number_format($p->getPreco(), 2, ',', '.') ?></td>
    <td><?= $p->getEstoque() ?></td>
    <td><img src="/uploads/<?= $p->getImagem() ?>"></td>
    <td>
      <a href="editar.php?id=<?= $p->getId() ?>">Editar</a>
      <a href="excluir.php?id=<?= $p->getId() ?>" onclick="return confirm('Excluir?')"> Excluir</a>
    </td>
  </tr>
  <?php endforeach; ?>
</table>
