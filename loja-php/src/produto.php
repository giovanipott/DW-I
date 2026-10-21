<?php

abstract class Produto {
    public function __construct(protected string $name, protected float $price) {}

    abstract public function frete():float;

    abstract public function descricao():string;

    
}

class ProdutoFisico extends Produto {
    public function __construct(string $name, float $price, private float $pesoKg){
        parent::__construct($name, $price);
    }    

    public function descricao():string {
        return "O produto {$this->name} Custa R$ {$this->price} "; 
    }

    public function frete():float {
        return $this->pesoKg * 5;

    }
}

class ProdutoDigital extends Produto {
    public function __construct(string $name, float $price, private string $link) {
        parent::__construct($name, $price);
    }

    public function descricao():string {
        return "<br>O produto {$this->name} Custa R$ {$this->price} segue o link the download: {$this->link}"; 
    }

    public function frete():float {
        return 0;
    }
}


class ProdutoComDesconto extends ProdutoFisico{
    public function __construct(
        string $nome,
        float $preco,
        float $pesoKg,
        private float $desconto
    ){
        parent::__construct($nome, $preco, $pesoKg);
    }

    public function total(): float {
        return $this->preco * (1 - $this->desconto) + $this->frete();
    }
}


$items = [
    new ProdutoComDesconto("Jubileo", 69.69, 5, 2),
    new ProdutoFisico("Casa", 2_000_000, 3_000)
];

foreach ($items as $item) {
    echo "Total é {$item->total()} <br>";
}
?>
