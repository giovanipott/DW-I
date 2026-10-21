<?php
trait Loggable{
    public function log(string $msg):void{
        echo "[" . static::class . "] $msg<br>";
    }
}

class Pedido {use Loggable;}
class Cliente {use Loggable;}

(new Pedido)->log("criado");
(new Cliente)->log("cadastrado");
?>