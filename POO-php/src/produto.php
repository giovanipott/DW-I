<?php
declare(strict_types=1);

class Produto
{
    public function __construct(
        private int $id,
        private string $nome,
        private float $preco,
        private int $estoque
    ) {
        if ($id <= 0) {
            throw new InvalidArgumentException('O ID deve ser positivo.');
        }
        if (trim($nome) === '') {
            throw new InvalidArgumentException('O nome do produto não pode ser vazio.');
        }
        if (!is_finite($preco) || $preco < 0) {
            throw new InvalidArgumentException('O preço não pode ser negativo.');
        }
        if ($estoque < 0) {
            throw new InvalidArgumentException('O estoque não pode ser negativo.');
        }
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getPreco(): float
    {
        return $this->preco;
    }

    public function temEstoque(int $qtd): bool
    {
        return $qtd > 0 && $this->estoque >= $qtd;
    }
}
