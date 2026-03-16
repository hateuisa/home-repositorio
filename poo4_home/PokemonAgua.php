<?php
require_once "Pokemon.php";

class PokemonAgua extends Pokemon {
    public function __construct($nombre, $ataque) {
        parent::__construct($nombre, "Agua", "Especial", $ataque);
        // Los de agua tienen más vida inicial
        $this->vida += 30; 
    }

    public function Atacar() {
        // Validación para evitar errores si ataque no es array
        $lista = is_array($this->ataque) ? $this->ataque : [$this->ataque];
        $ultimo = end($lista);
        return "💧 " . $this->nombre . " usa Hidrobomba con " . $ultimo . "!";
    }

    // AHORA DENTRO DE LA CLASE
    public function calcularDanio() {
        return $this->vida_ataque + 10; 
    }
} // Llave de cierre correcta
?>