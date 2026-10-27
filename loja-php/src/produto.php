<?php
declare(strict_types=1);

abstract class Produto
{
    public function __construct(
        protected string $nome,
        protected float $preco
    ) {
        if ($preco < 0) {
            throw new InvalidArgumentException('O preço não pode ser negativo.');
        }
    }

    abstract public function frete(): float;

    abstract public function descricao(): string;

    public function total(): float
    {
        return $this->preco + $this->frete();
    }
}

class ProdutoFisico extends Produto
{
    public function __construct(string $nome, float $preco, private float $pesoKg)
    {
        if ($pesoKg < 0) {
            throw new InvalidArgumentException('O peso não pode ser negativo.');
        }

        parent::__construct($nome, $preco);
    }

    public function descricao(): string
    {
        return "O produto {$this->nome} custa R$ " .
            number_format($this->preco, 2, ',', '.') . '.';
    }

    public function frete(): float
    {
        return $this->pesoKg * 5;
    }
}

class ProdutoDigital extends Produto
{
    public function __construct(string $nome, float $preco, private string $link)
    {
        parent::__construct($nome, $preco);
    }

    public function descricao(): string
    {
        $linkSeguro = htmlspecialchars($this->link, ENT_QUOTES, 'UTF-8');

        return "O produto {$this->nome} custa R$ " .
            number_format($this->preco, 2, ',', '.') .
            ". Link para download: {$linkSeguro}";
    }

    public function frete(): float
    {
        return 0.0;
    }
}

class ProdutoComDesconto extends ProdutoFisico
{
    public function __construct(
        string $nome,
        float $preco,
        float $pesoKg,
        private float $descontoPercentual
    ) {
        if ($descontoPercentual < 0 || $descontoPercentual > 100) {
            throw new InvalidArgumentException('O desconto deve estar entre 0 e 100%.');
        }

        parent::__construct($nome, $preco, $pesoKg);
    }

    public function total(): float
    {
        // Aplica o desconto ao preço e soma o frete ao final.
        $precoComDesconto = $this->preco * (1 - $this->descontoPercentual / 100);
        return $precoComDesconto + $this->frete();
    }
}

$items = [
    new ProdutoComDesconto('Jubileu', 69.69, 5, 20),
    new ProdutoFisico('Casa', 2000000, 3000),
    new ProdutoDigital('E-book', 29.90, 'https://exemplo.com/download'),
];

foreach ($items as $item) {
    echo htmlspecialchars($item->descricao(), ENT_QUOTES, 'UTF-8') .
        '<br>Frete: R$ ' . number_format($item->frete(), 2, ',', '.') .
        '<br>Total: R$ ' . number_format($item->total(), 2, ',', '.') . '<hr>';
}
