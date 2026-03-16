<?php

class Entrenadora
{
    private string $nombre;
    private array $equipo;

    public function __construct(string $nombre){
        $this->nombre = $nombre;
        $this->equipo = [];
    }

    /**
     * La entrenadora captura un Pokémon y lo añade a su equipo
     * @param Pokemon $pokemon
     * @return string muestra al usuario la información pertinente sobre la captura del Pokémon
     */
    public function CapturarPokemon(Pokemon $pokemon):string{
        $this->equipo[] = $pokemon;
        return "$this->nombre ha capturado a {$pokemon->MostrarInfo()}";
    }

    /**
     * Devuelve el array de Pokémon de la entrenadora
     * @return array
     */
    public function MostrarEquipo():array{
        return $this->equipo;
    }

    public function getNombre(): string {
    return $this->nombre;
}
}