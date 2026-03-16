<?php

class Pokemon
{
    private int $idPokemon;
    private string $nombre;
    private string $tipo;
    private string $elemento;
    private string $ataque;
    private int $puntosVida;

    private int $nivel;

    
    private static int $ultimoId = 0;

    public function __construct($nombre, $tipo, $elemento){
        self::$ultimoId++;
        $this->idPokemon= self::$ultimoId;
        $this->nombre = $nombre;
        $this->tipo = $tipo;
        $this->elemento = $elemento;
        $this->nivel = 1;
        switch($tipo){
            case "Tierra":
                $this->puntosVida = 20;
                $this->ataque = "Terremoto";
                break;
            case "Agua":
                $this->puntosVida = 15;
                $this->ataque = "Chorrazo";
                break;
            case "Fuego":
                $this->puntosVida = 15;
                $this->ataque = "Llama";
                break;
            case "Aire":
                $this->puntosVida = 10;
                $this->ataque = "Soplido";
                break;
            case "Eléctrico":
                $this->puntosVida = 10;
                $this->ataque = "Rayo";
                break;
            default:
                $this->puntosVida = 0;
                $this->ataque = "";
                break;
        }
    }

    /**
     * Muestra la información del Pokémon
     * @return string
     */
    public function MostrarInfo():string{
        return "$this->nombre [$this->tipo - $this->elemento - $this->nivel] - Puntos de vida: $this->puntosVida";
    }

    /**
     * El Pokémon realiza su ataque
     * @return string
     */
    public function Atacar():string{
        return "$this->nombre ataca: $this->ataque!!";
    }

    /**
     * El Pokémon Evoluciona, aumenta su nivel en 1 y aumenta 1/3 sus puntos de vida actuales
     * @return string
     */
    public function Evolucionar():string{
        $this->nivel++;
        $aumentoVida = $this->puntosVida/3;
        $this->puntosVida = $this->puntosVida+ $aumentoVida;
        return "$this->nombre evoluciona al nivel $this->nivel y gana $aumentoVida puntos de vida";
    }
}