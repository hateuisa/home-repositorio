<?php
class Usuaria {

    private $conn;
    private $table_name = "usuarios"; 
    private $id_usuario;
    private $nombre; 
    private $email;
    private $password;
    private $id_rol;

    public function __construct($db) {
        $this->conn = $db;
    }

    
    public function login($email, $password) {

        // 1. AÑADIMOS id_usuario y id_rol A LA BÚSQUEDA
        $query = "SELECT id_usuario, nombre, password, id_rol
                  FROM {$this->table_name}  
                  WHERE email = :email";

        $stmt = $this->conn->prepare($query);
        $stmt->bindPARAM(":email", $email);
        $stmt->execute();
   
        if ($stmt->rowCount() === 1) {
             
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            //TODO: cambiar el control de la contraseña para utilizar hash
            //if (password_verify($password, $row['password'])) {
            if($password == $row['password']){    
                
                // 2. GUARDAMOS TODOS LOS DATOS EN LA CLASE
                $this->id_usuario = $row['id_usuario'];
                $this->nombre     = $row['nombre'];
                $this->id_rol     = $row['id_rol'];
                
                return true; 
            }
        }
        return false; 
    }

    public function getIdUsuario() {
        return $this->id_usuario;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getIdRol() {
        return $this->id_rol;
    }

    public function getEmail() {
        return $this->email;
    }

}
?>