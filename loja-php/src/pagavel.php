<?php
declare(strict_types=1);

interface Pagavel
{
    public function pagar(float $valor): bool;
}

class Pix implements Pagavel
{
    public function pagar(float $valor): bool
    {
        if ($valor <= 0) {
            return false;
        }

        echo 'Pagamento via Pix: R$ ' . number_format($valor, 2, ',', '.') . '<br>';
        return true;
    }
}

class Cartao implements Pagavel
{
    public function pagar(float $valor): bool
    {
        if ($valor <= 0) {
            return false;
        }

        echo 'Pagamento via cartão: R$ ' . number_format($valor, 2, ',', '.') . '<br>';
        return true;
    }
}

class Boleto implements Pagavel
{
    public function pagar(float $valor): bool
    {
        if ($valor <= 0) {
            return false;
        }

        $valorFormatado = number_format($valor, 2, ',', '.');
        echo "Pagamento via boleto: R$ {$valorFormatado}<br>";
        echo 'Código demonstrativo: ' . str_pad((string) round($valor * 123456), 12, '0', STR_PAD_LEFT) . '<br>';
        return true;
    }
}

$pix = new Pix();
$cartao = new Cartao();
$boleto = new Boleto();

$pix->pagar(25.00);
$cartao->pagar(25.00);
$boleto->pagar(25.00);
$boleto->pagar(60.00);
