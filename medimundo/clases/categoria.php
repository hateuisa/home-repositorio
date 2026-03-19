<?php
class Categoria {
    private $conn;
    private $table_name = "categoria";

    private $id_categoria;
    private $titulo;
    private $descripcion;
    private $icono;
    private $id_madre;
    private $fecha_actualizacion;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function listarTodas() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_madre IS NULL ORDER BY titulo ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function cargarPorId($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_categoria = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $this->id_categoria = $row['id_categoria'];
            $this->titulo = $row['titulo'];
            $this->descripcion = $row['descripcion'];
            $this->icono = $row['icono'];
            $this->id_madre = $row['id_madre'];
            return true;
        }
        return false;
    }

    public function getTitulo() { return $this->titulo; }
    public function getIcono() { return $this->icono; }
}
?>