<?php

require_once __DIR__ . "/src/produto.php";
require_once __DIR__ . "/src/carrinho.php";

function testar(string $descricao, callable $teste): void
{
    try {
        $resultado = $teste();

        if ($resultado) {
            echo "[PASSOU] " . $descricao . "<br>";
        } else {
            echo "[FALHOU] " . $descricao . "<br>";
        }
    } catch (Throwable $e) {
        echo "[ERRO] " . $descricao
            . " - " . $e->getMessage()
            . "<br>";
    }
}

// Teste 1: criar produto
$produto = new Produto(1, "Camiseta", 59.90, 10);

testar("Criar produto", function () use ($produto) {
    return $produto->getNome() === "Camiseta"
        && $produto->getPreco() === 59.90;
});

// Teste 2: adicionar produto ao carrinho
$carrinho = new Carrinho();
$carrinho->adicionar($produto, 2);

testar("Adicionar produto ao carrinho", function () use ($carrinho) {
    return count($carrinho->listar()) === 1;
});

// Teste 3: calcular total
testar("Calcular total corretamente", function () use ($carrinho) {
    return abs($carrinho->total() - 119.80) < 0.001;
});

// Teste 4: adicionar novamente o mesmo produto
$carrinho->adicionar($produto, 1);

testar("Somar quantidades do mesmo produto", function () use ($carrinho) {
    $itens = $carrinho->listar();

    return count($itens) === 1
        && $itens[0]['qtd'] === 3;
});

// Teste 5: rejeitar quantidade zero
testar("Rejeitar quantidade zero", function () use ($carrinho, $produto) {
    try {
        $carrinho->adicionar($produto, 0);
        return false;
    } catch (InvalidArgumentException $e) {
        return true;
    }
});

// Teste 6: rejeitar quantidade acima do estoque
testar("Rejeitar quantidade acima do estoque", function () use ($carrinho, $produto) {
    try {
        $carrinho->adicionar($produto, 100);
        return false;
    } catch (Exception $e) {
        return true;
    }
});

// Teste 7: finalizar compra
$carrinho->finalizarCompra();

testar("Descontar estoque após compra", function () use ($produto) {
    return $produto->getEstoque() === 7;
});

// Teste 8: esvaziar carrinho após a compra
testar("Esvaziar carrinho após finalizar", function () use ($carrinho) {
    return count($carrinho->listar()) === 0
        && $carrinho->total() === 0.0;
});

// Teste 9: rejeitar preço negativo
testar("Rejeitar produto com preço negativo", function () {
    try {
        new Produto(2, "Teclado", -50.00, 5);
        return false;
    } catch (InvalidArgumentException $e) {
        return true;
    }
});

echo "<br>" . "Testes finalizados." . "<br>";
