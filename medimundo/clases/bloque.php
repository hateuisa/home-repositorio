<?php
class Bloque {
    private $conn;
    private $table_name = "bloque";

    private $id_bloque;
    private $titulo;
    private $subtitulo;
    private $contenido; 
    private $orden;
    private $id_categoria;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function obtenerBloquesDeCategoria($id_cat) {
        $query = "SELECT * FROM " . $this->table_name . " 
                  WHERE id_categoria = :id_cat 
                  ORDER BY orden ASC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_cat', $id_cat);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getContenido() {
        return $this->contenido;
    }
}
?>