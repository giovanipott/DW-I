<?php


$arq = __DIR__ . '/storage/notas.txt';

/*
file_put_contents($arq, "Primeira linha\n");
file_put_contents($arq, "Segunda linha\n", FILE_APPEND);

echo nl2br(file_get_contents($arq));
echo '<br>Existe? ' . (file_exists($arq) ? 'sim' : 'não');
*/

// $f = fopen($arq, 'r');
// if (!$f) exit('Não foi possível abrir');
// while (($linha = fgets($f)) !== false) {
//   echo trim($linha) . ' | ';
// }
// fclose($f);


require __DIR__ . '/autoload.php';
use App\Model\{Produto, ProdutoFisico, ProdutoDigital};
use App\DAO\ProdutoDAO;
use App\Database\Conexao;


$pdo = Conexao::get();
$dao = new ProdutoDAO($pdo);

$f = fopen('storage/produtos.csv', 'w');
fputcsv($f, ['id', 'nome', 'preco']);   // cabeçalho
foreach ($dao->listar() as $p) {
  fputcsv($f, [$p->getId(), $p->getNome(), $p->getPreco()]);
}
fclose($f);

$f = fopen('storage/produtos.csv', 'r');
if(!$f) exit("Não foi possível abrir");
while(($linha = fgetcsv($f, escape:"")) !== false){
    echo "{$linha[1]} custa R$ {$linha[2]}";
}
fclose($f);