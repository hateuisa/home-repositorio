<?php
require_once "Pokemon.php";

class PokemonRayo extends Pokemon {
    public function __construct($nombre, $ataque) {
        parent::__construct($nombre, "Rayo", "Especial", $ataque);
    }

    public function Atacar() {
        $lista = is_array($this->ataque) ? $this->ataque : [$this->ataque];
        $ultimo = end($lista);
        return "⚡ " . $this->nombre . " lanza un Trueno de " . $ultimo . "!";
    }

    public function calcularDanio() {
        // Los de rayo tienen un multiplicador crítico
        return $this->vida_ataque * 1.5; 
    }
}
?>