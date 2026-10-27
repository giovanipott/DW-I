<?php
declare(strict_types=1);

require_once __DIR__ . '/produto.php';

class Carrinho
{
    /** @var array<int, array{produto: Produto, qtd: int}> */
    private array $itens = [];

    public function adicionar(Produto $produto, int $qtd = 1): void
    {
        if ($qtd <= 0) {
            throw new InvalidArgumentException('A quantidade deve ser maior que zero.');
        }

        if (!$produto->temEstoque($qtd)) {
            throw new RuntimeException('Estoque insuficiente para o produto ' . $produto->getNome() . '.');
        }

        $this->itens[] = ['produto' => $produto, 'qtd' => $qtd];
    }

    public function total(): float
    {
        $total = 0.0;

        foreach ($this->itens as $item) {
            $total += $item['produto']->getPreco() * $item['qtd'];
        }

        return $total;
    }

    public function itens(): array
    {
        return $this->itens;
    }
}
