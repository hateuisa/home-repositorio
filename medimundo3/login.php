<?php
session_start();

// Si ya tiene la pulsera, pa' dentro
if(isset($_SESSION["id_usuario"])){
    header("Location: omar.php");
    exit;
}

require_once 'clases/config.php';
require_once 'clases/usuaria.php';

$mensaje_error = "";

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["email"]) && isset($_POST["password"])) {
    $email    = $_POST["email"];
    $password = $_POST["password"];

    $database = new Database();
    $db       = $database->getConnection();
    $usuaria  = new Usuaria($db);

    if ($usuaria->login($email, $password)){
        $_SESSION["id_usuario"] = $usuaria->getIdUsuario();
        $_SESSION["nombre"]     = $usuaria->getNombre();
        $_SESSION["id_rol"]     = $usuaria->getIdRol();
        header("Location: omar.php");
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

        <div class="login-vip-tarjeta">

            <div class="login-vip-imagen">
                <img src="img/loginimg.png" alt="Ilustración bienvenida Médicos del Mundo">
            </div>

            <div class="login-vip-formulario">

                <h1 class="login-vip-titulo">¡Hola! ¡Amigo!</h1>

                <?php if($mensaje_error != ""): ?>
                    <p class="login-vip-error"><?php echo htmlspecialchars($mensaje_error); ?></p>
                <?php endif; ?>

                <form action="login.php" method="POST">

                    <div class="login-vip-grupo">
                        <label for="email">Correo Electrónico <span>*</span></label>
                        <input type="text" id="email" name="email" placeholder="Introduce tu correo" required>
                    </div>

                    <div class="login-vip-grupo">
                        <label for="password">Contraseña <span>*</span></label>
                        <input type="password" id="password" name="password" placeholder="Introduce tu contraseña" required>
                    </div>

                    <div class="login-vip-recordar">
                        <input type="checkbox" id="remember" name="remember">
                        <label for="remember">Recordarme</label>
                    </div>

                    <button type="submit" class="login-vip-boton">ACCESO</button>

                </form>

                <div class="login-vip-enlaces">
                    <a href="#">¿Se te olvidó tu contraseña?</a>
                    <a href="#">¿No tienes una cuenta?</a>
                </div>

            </div>
        </div>

    </main>

</body>
</html>