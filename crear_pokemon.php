<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos.css">
    <title>Crear Pokémon</title>
</head>
<body>
    <nav>
        Harold: Crear Pokémon
    </nav>
    <section>
        <form action="" method="POST">
            <label for="nombre"><p>Nombre del Pokémon:</p></label>
            <input type="text" id="nombre" name="nombre" required>

            <p>Tipo:</p>
            <input type="radio" id="tierra" name="tipo" value="Tierra" required>
            <label for="tierra">Tierra</label><br>
            <input type="radio" id="agua" name="tipo" value="Agua">
            <label for="agua">Agua</label><br>
            <input type="radio" id="fuego" name="tipo" value="Fuego">
            <label for="fuego">Fuego</label><br>
            <input type="radio" id="aire" name="tipo" value="Aire">
            <label for="aire">Aire</label><br>
            <input type="radio" id="electrico" name="tipo" value="Eléctrico">
            <label for="electrico">Eléctrico</label>

            <label for="elemento"><p>Elemento del Pokémon:</p></label>
            <input type="text" id="elemento" name="elemento" required>

            <p><input type="submit" name="crear" value="Crear Pokémon"></p>
        </form>

        <?php
        require_once "Pokemon.php";
        session_start();

        if(!isset($_SESSION['pokemons'])){
            $_SESSION['pokemons'] = [];
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['crear'])) {
            $nombre = $_POST['nombre'];
            $tipo = $_POST['tipo'];
            $elemento = $_POST['elemento'];

            // Se crea el objeto basándose en tu constructor: __construct($nombre, $tipo, $elemento)
            $nuevoPokemon = new Pokemon($nombre, $tipo, $elemento);

            $_SESSION['pokemons'][] = $nuevoPokemon;

            echo "Pokémon guardado con éxito: " . $nuevoPokemon->MostrarInfo();
        }
        ?>
    </section>
</body>
</html>