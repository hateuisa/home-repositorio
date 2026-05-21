<?php
class GestionAdmin {

    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function listarUsuarios() {
        $query = "SELECT id_usuario, nombre, email, id_rol FROM usuarios ORDER BY nombre ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function crearUsuario($nombre, $email, $password, $id_rol) {
        $query = "INSERT INTO usuarios (nombre, email, password, id_rol) VALUES (:nombre, :email, :password, :id_rol)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nombre',   $nombre);
        $stmt->bindParam(':email',    $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':id_rol',   $id_rol);
        return $stmt->execute();
    }

    public function editarUsuario($id, $nombre, $email, $id_rol) {
        $query = "UPDATE usuarios SET nombre = :nombre, email = :email, id_rol = :id_rol WHERE id_usuario = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nombre',  $nombre);
        $stmt->bindParam(':email',   $email);
        $stmt->bindParam(':id_rol',  $id_rol);
        $stmt->bindParam(':id',      $id);
        return $stmt->execute();
    }

    public function eliminarUsuario($id) {
        $query = "DELETE FROM usuarios WHERE id_usuario = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function listarCategorias() {
        $query = "SELECT * FROM categoria WHERE id_madre IS NULL ORDER BY titulo ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function crearCategoria($titulo, $descripcion, $icono) {
        $query = "INSERT INTO categoria (titulo, descripcion, icono) VALUES (:titulo, :descripcion, :icono)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':titulo',      $titulo);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':icono',       $icono);
        return $stmt->execute();
    }

    public function editarCategoria($id, $titulo, $descripcion, $icono) {
        $query = "UPDATE categoria SET titulo = :titulo, descripcion = :descripcion, icono = :icono WHERE id_categoria = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':titulo',      $titulo);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':icono',       $icono);
        $stmt->bindParam(':id',          $id);
        return $stmt->execute();
    }

    public function eliminarCategoria($id) {
        $query = "DELETE FROM categoria WHERE id_categoria = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function listarSubcategorias() {
        $query = "SELECT s.*, m.titulo AS titulo_madre
                  FROM categoria s
                  JOIN categoria m ON s.id_madre = m.id_categoria
                  WHERE s.id_madre IS NOT NULL
                  ORDER BY s.titulo ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function crearSubcategoria($titulo, $descripcion, $icono, $id_madre) {
        $query = "INSERT INTO categoria (titulo, descripcion, icono, id_madre) VALUES (:titulo, :descripcion, :icono, :id_madre)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':titulo',      $titulo);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':icono',       $icono);
        $stmt->bindParam(':id_madre',    $id_madre);
        return $stmt->execute();
    }

    public function editarSubcategoria($id, $titulo, $descripcion, $icono, $id_madre) {
        $query = "UPDATE categoria SET titulo = :titulo, descripcion = :descripcion, icono = :icono, id_madre = :id_madre WHERE id_categoria = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':titulo',      $titulo);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':icono',       $icono);
        $stmt->bindParam(':id_madre',    $id_madre);
        $stmt->bindParam(':id',          $id);
        return $stmt->execute();
    }

    public function eliminarSubcategoria($id) {
        return $this->eliminarCategoria($id);
    }

    public function listarBloques() {
        $query = "SELECT b.*, c.titulo AS titulo_categoria
                  FROM bloque b
                  LEFT JOIN categoria c ON b.id_categoria = c.id_categoria
                  ORDER BY b.orden ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function crearBloque($titulo, $subtitulo, $contenido, $orden, $id_categoria, $icono) {
        $query = "INSERT INTO bloque (titulo, subtitulo, contenido, orden, id_categoria, icono)
                  VALUES (:titulo, :subtitulo, :contenido, :orden, :id_categoria, :icono)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':titulo',       $titulo);
        $stmt->bindParam(':subtitulo',    $subtitulo);
        $stmt->bindParam(':contenido',    $contenido);
        $stmt->bindParam(':orden',        $orden);
        $stmt->bindParam(':id_categoria', $id_categoria);
        $stmt->bindParam(':icono',        $icono);
        return $stmt->execute();
    }

    public function editarBloque($id, $titulo, $subtitulo, $contenido, $orden, $id_categoria, $icono) {
        $query = "UPDATE bloque SET titulo = :titulo, subtitulo = :subtitulo, contenido = :contenido,
                  orden = :orden, id_categoria = :id_categoria, icono = :icono WHERE id_bloque = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':titulo',       $titulo);
        $stmt->bindParam(':subtitulo',    $subtitulo);
        $stmt->bindParam(':contenido',    $contenido);
        $stmt->bindParam(':orden',        $orden);
        $stmt->bindParam(':id_categoria', $id_categoria);
        $stmt->bindParam(':icono',        $icono);
        $stmt->bindParam(':id',           $id);
        return $stmt->execute();
    }

    public function eliminarBloque($id) {
        $query = "DELETE FROM bloque WHERE id_bloque = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function listarFaqs() {
        $query = "SELECT f.*, c.titulo AS titulo_categoria
                  FROM faq f
                  LEFT JOIN categoria c ON f.id_categoria = c.id_categoria
                  ORDER BY f.fecha_actualizacion DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function crearFaq($pregunta, $respuesta, $id_categoria) {
        $query = "INSERT INTO faq (pregunta, respuesta, id_categoria, fecha_actualizacion)
                  VALUES (:pregunta, :respuesta, :id_categoria, NOW())";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':pregunta',     $pregunta);
        $stmt->bindParam(':respuesta',    $respuesta);
        $stmt->bindParam(':id_categoria', $id_categoria);
        return $stmt->execute();
    }

    public function editarFaq($id, $pregunta, $respuesta, $id_categoria) {
        $query = "UPDATE faq SET pregunta = :pregunta, respuesta = :respuesta,
                  id_categoria = :id_categoria, fecha_actualizacion = NOW() WHERE id_faq = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':pregunta',     $pregunta);
        $stmt->bindParam(':respuesta',    $respuesta);
        $stmt->bindParam(':id_categoria', $id_categoria);
        $stmt->bindParam(':id',           $id);
        return $stmt->execute();
    }

    public function eliminarFaq($id) {
        $query = "DELETE FROM faq WHERE id_faq = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>