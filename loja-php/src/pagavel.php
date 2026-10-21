<?php

interface Pagavel {
    public function pagar(float $valor): bool;
}

class Pix implements Pagavel{
    public function pagar(float $valor): bool {
        echo "Pix de valor $valor";
        return true;
    }
}

class Cartao implements Pagavel{
    public function pagar(float $valor): bool {
        echo "Cartão de valor $valor";
        return true;
    }
}

class Boleto implements Pagavel{
    public function pagar(float $valor): bool {
        echo "Boleto: $valor <br>";
        echo "| || ||| |||| | || <br>" . $valor*123 . $valor + 5162 . "<br>";
        return true;
    }
}

$pix = new Pix();
$cartao = new Cartao();
$boleto = new Boleto();

echo $pix->pagar(25) . "<br>";
echo $cartao->pagar(25). "<br>";
echo $boleto->pagar(25). "<br>";
echo $boleto->pagar(60). "<br>";

?>