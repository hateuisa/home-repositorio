<?php
require_once "Pokemon.php";

class PokemonFuego extends Pokemon {
    public function __construct($nombre, $ataque) {
        parent::__construct($nombre, "Fuego", "Especial", $ataque);
        $this->vida_ataque += 20; 
    }

    public function Atacar() {
        // Aseguramos que ataque sea un array para evitar errores de end()
        $lista = is_array($this->ataque) ? $this->ataque : [$this->ataque];
        $ultimo = end($lista);
        return "🔥 " . $this->nombre . " lanza una llamarada de " . $ultimo . "!";
    }

    // ESTA FUNCIÓN DEBE ESTAR DENTRO DE LA CLASE
    public function calcularDanio() {
        return $this->vida_ataque + 25;
    }
} // La llave de cierre de la clase siempre va al final
?>