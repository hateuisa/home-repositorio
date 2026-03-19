<?php
class Faq {

    private $conn;
    private $table_name = "faq"; 

    private $id_faq;
    private $pregunta;
    private $respuesta;
    private $fecha_actualizacion;
    private $id_categoria;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function obtenerFaqsPorCategoria($id_cat) {
        $query = "SELECT * FROM " . $this->table_name . " 
                  WHERE id_categoria = :id_cat 
                  ORDER BY fecha_actualizacion DESC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_cat', $id_cat);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function editarPregunta($id, $p, $r) {
        $query = "UPDATE " . $this->table_name . " 
                  SET pregunta = :p, respuesta = :r 
                  WHERE id_faq = :id";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':p', $p);
        $stmt->bindParam(':r', $r);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }

    public function getPregunta() { return $this->pregunta; }
    public function getRespuesta() { return $this->respuesta; }
}
?>