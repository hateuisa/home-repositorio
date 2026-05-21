<?php
session_start();

if(isset($_SESSION["id_usuario"])){
    header("Location: index.php");
    exit;
}

require_once 'clases/config.php';
require_once 'clases/usuaria.php';

$mensaje_error = "";

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["email"]) && isset($_POST["password"])) {
    $database = new Database();
    $db       = $database->getConnection();
    $usuaria  = new Usuaria($db);

    if ($usuaria->login($_POST["email"], $_POST["password"])){
        $_SESSION["id_usuario"] = $usuaria->getIdUsuario();
        $_SESSION["nombre"]     = $usuaria->getNombre();
        $_SESSION["id_rol"]     = $usuaria->getIdRol();
        
        header("Location: index.php");
        exit;
    } else {
        $mensaje_error = "El email o la contraseña son incorrectos.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Médicos del Mundo — Iniciar Sesión</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body class="login-vip-body">
    <main class="login-vip-pantalla">
        <section class="login-vip-tarjeta">
            <section class="login-vip-imagen">
                <img src="img/loginimg.png" alt="Bienvenida">
            </section>
            <section class="login-vip-formulario">
                <h1 class="login-vip-titulo">¡Hola! ¡Amiga!</h1>
                <?php if($mensaje_error != ""): ?>
                    <p class="login-vip-error"><?php echo htmlspecialchars($mensaje_error); ?></p>
                <?php endif; ?>
                <form action="login.php" method="POST">
                    <section class="login-vip-grupo">
                        <label for="email">Correo Electrónico <span>*</span></label>
                        <input type="text" id="email" name="email" placeholder="Introduce tu correo" required>
                    </section>
                    <section class="login-vip-grupo">
                        <label for="password">Contraseña <span>*</span></label>
                        <input type="password" id="password" name="password" placeholder="Introduce tu contraseña" required>
                    </section>
                    
                    <div class="contenedor-botones-login">
                        <button type="submit" class="login-vip-boton">ACCESO</button>
                        <a href="index.php" class="login-vip-boton-regresar">REGRESAR</a>
                    </div>

                </form>
                <section class="login-vip-enlaces">
                    <a href="recuperar_pass.php">¿Se te olvidó tu contraseña?</a>
                </section>
            </section>
        </section>
    </main>
</body>
</html>