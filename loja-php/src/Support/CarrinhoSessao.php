<?php
declare(strict_types=1);

namespace App\Support;

class CarrinhoSessao
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['carrinho']) || !is_array($_SESSION['carrinho'])) {
            $_SESSION['carrinho'] = [];
        }
    }

    public function adicionar(int $id, int $qtd = 1): void
    {
        if ($id <= 0 || $qtd <= 0) {
            throw new \InvalidArgumentException('Produto e quantidade devem ser positivos.');
        }

        $_SESSION['carrinho'][$id] = (int) ($_SESSION['carrinho'][$id] ?? 0) + $qtd;
    }

    public function remover(int $id): void
    {
        unset($_SESSION['carrinho'][$id]);
    }

    public function itens(): array
    {
        return $_SESSION['carrinho'];
    }

    public function limpar(): void
    {
        $_SESSION['carrinho'] = [];
    }
}
