<?php
class Entrenadora {
    private $nombre;
    private $pokemons;

    public function __construct($nombre){
        $this->nombre = $nombre;
        $this->pokemons = [];
    }

    public function getNombre() { 
        return $this->nombre; 
    }

    // Método vital para obtener la lista de Pokémon en fight.php
    public function getPokemons() {
        return $this->pokemons;
    }

    public function CazarPokemon(Pokemon $pokemon) { 
        if (count($this->pokemons) < 3) {
            $this->pokemons[] = $pokemon;
            return true;
        }
        return false;
    }

    public function MostrarEquipo(){
        if(empty($this->pokemons)){
            return "<p>" . $this->nombre . " no tiene pokemons en su equipo.</p>";
        }
        $lista ="<h3>Equipo de " . $this->nombre . ":</h3>";
        foreach($this->pokemons as $pokemon){
            $lista .= "<div>" . $pokemon->MostrarInfo() . "</div><hr>";
        }
        return $lista;
    }

    public function MostrarInfo(){
        return $this->nombre;
    }

    public function MostrarDetalle(){
        return "<p>Nombre: " . $this->nombre . "</p>" . 
               "<p>Pokemons en el equipo: " . count($this->pokemons) . "</p>";
    }
}
?>