<?php

session_start();

    if(isset($_SESSION["id_usuario"])){
        header("Location: Omar");
        exit;
    }

require_once 'clases/config.php';
require_once 'clases/usuaria.php';

$mensaje_error = "";

    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["email"]) && isset($_POST["password"])) {
                $email = $_POST["email"];
                $password = $_POST["password"];

                $database = new Database();
                $db = $database->getConnection();

                $usuaria = new Usuaria($db);

                if ($usuaria->login($email, $password)){
                    $_SESSION["id_usuario"] = $usuaria->getIdUsuario();
                    $_SESSION["nombre"] = $usuaria->getNombre();
                    $_SESSION["id_rol"] = $usuaria->getIdRol();
                    echo "<script>alert('Conexion bien')</script>";
                    header("Location: omar.php");
                    exit;
                }

                else{
                    $mensaje_error = "El email o la contraseña son incorrectos.";
                }          
    }           
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Médicos del Mundo Login</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

    <header class="navegacion">
        <img src="img/logomorado.png" alt="Logo" class="logo">
        
        <a href="login.php">
            <img src="img/usuaria.png" alt="Usuario" class="usuario">
        </a>
    </header>

    <main class="contenedor-principal">

            <h1>Iniciar Sesión</h1>

            <?php if($mensaje_error != ""): ?>
            <p class="mensaje-error"><?php echo $mensaje_error; ?></p>
        <?php endif; ?>
            
            <form action="" method="POST" class="formulario-login">
                <label for="email">Correo Electrónico:</label>
                <input type="text" id="email" name="email" required>

                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>

                <button type="submit">Iniciar Sesión</button>
            </form>

            

        
    </main>

    

</body>
</html>