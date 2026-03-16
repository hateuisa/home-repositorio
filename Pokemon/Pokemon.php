<?php
class Pokemon {
    private $nombre;
    private $elemento;
    private $tipo;
    private $ataque; // Ahora será un array de strings
    private $nivel;
    private $vida;

    public function __construct($nombre, $elemento, $tipo, $ataque){
        $this->nombre = $nombre;
        $this->elemento = $elemento;
        $this->tipo = $tipo;
        $this->ataque = [$ataque]; // Lo guardamos como el primer elemento de un array
        $this->nivel = 1;
        $this->vida = 100;
    }

    public function getNombre() {
        return $this->nombre;
    }

    // Nuevo método para añadir ataques a la lista
   public function AñadirAtaque($nuevoAtaque){
    // Si por culpa de la sesión vieja es un string, lo convertimos a array primero
    if (!is_array($this->ataque)) {
        $this->ataque = [$this->ataque];
    }
    
    // Ahora ya podemos añadirlo sin errores
    $this->ataque[] = $nuevoAtaque;
}

    public function Atacar(){
        // Ataca con el último ataque aprendido (el final del array)
        $ultimoAtaque = end($this->ataque);
        return $this->nombre . " ataca con " . $ultimoAtaque . " y causa daño.";
    }

    public function Evolucionar(){
        $this->nivel++;
        $this->vida += 20;
        return $this->nombre . " ha evolucionado al nivel " . $this->nivel . " y ahora tiene " . $this->vida . " puntos de vida.";
    }

    public function MostrarInfo(){
    // Verificamos si $this->ataque es un array. 
    // Si lo es, lo unimos con comas. Si no, lo mostramos tal cual.
    if (is_array($this->ataque)) {
        $listaAtaques = implode(", ", $this->ataque);
    } else {
        $listaAtaques = $this->ataque;
    }

    return 
        "<p>Nombre: " . $this->nombre . "</p>" .
        "<p>Elemento: " . $this->elemento . "</p>" .
        "<p>Tipo: " . $this->tipo . "</p>" .
        "<p>Ataques: " . $listaAtaques . "</p>" .
        "<p>Nivel: " . $this->nivel . "</p>" .
        "<p>Vida: " . $this->vida . "</p>";
}
}