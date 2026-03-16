<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos.css">
    <title>Crear Entrenadora</title>
</head>
<body>
    <nav>
        Harold: Crear Entrenadora
    </nav>
    <section>
        <form action="" method="POST">
            <label for="nombre"><p>Nombre:</p></label>
            <input type="text" id="nombre" name="nombre" required>

            <p><input type="submit" name="crear" value="Crear Entrenadora"></p>
        </form>

        <?php
        require_once "Entrenadora.php";
        session_start();
        
        if(!isset($_SESSION['entrenadoras'])){
            $_SESSION['entrenadoras'] = [];
        }       
        
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['crear'])) {
            $nombre = $_POST['nombre'];

            $nuevaEntrenadora = new Entrenadora($nombre);

            $_SESSION['entrenadoras'][] = $nuevaEntrenadora;

            echo "Entrenador guardado con éxito";
        }
        ?>
    </section>
</body>
</html>