<?php
class Pokemon {
    protected $nombre;
    protected $elemento;
    protected $tipo;
    protected $ataque; // Array de ataques
    protected $nivel;
    protected $vida;
    protected $vida_ataque;

    public function __construct($nombre, $elemento, $tipo, $ataque){
        $this->nombre = $nombre;
        $this->elemento = $elemento;
        $this->tipo = $tipo;
        // CORRECCIÓN: Aseguramos que sea un array desde el inicio
        $this->ataque = is_array($ataque) ? $ataque : [$ataque]; 
        $this->nivel = rand(1, 100);
        $this->vida = rand(100, 255); // Vida base mínima aumentada
        $this->vida_ataque = rand(30, 80); // Daño base equilibrado
    }

    public function getNombre() { return $this->nombre; }
    public function getVida() { return $this->vida; }
    public function getDanio() { return $this->vida_ataque; }

    // Método fundamental para fight.php
    public function restaVida($cantidad) {
        $this->vida -= $cantidad;
        if ($this->vida < 0) $this->vida = 0;
    }

    public function Atacar(){
        $ultimoAtaque = end($this->ataque);
        return $this->nombre . " lanza un ataque con " . $ultimoAtaque . "!";
    }

    public function AñadirAtaque($nuevoAtaque){
        // CORRECCIÓN: Evita el error "operator not supported for strings"
        if (!is_array($this->ataque)) { 
            $this->ataque = [$this->ataque]; 
        }
        $this->ataque[] = $nuevoAtaque;
    }

    public function MostrarInfo(){
        // CORRECCIÓN: Evita el error de implode()
        $lista = is_array($this->ataque) ? implode(", ", $this->ataque) : $this->ataque;
        return "<p>Nombre: $this->nombre</p><p>Elemento: $this->elemento</p><p>Ataques: $lista</p><p>Vida: $this->vida</p>";
    }

    // Polimorfismo: Cada clase hija puede mejorar este cálculo
    public function calcularDanio() {
        return $this->vida_ataque; 
    }
}
?>