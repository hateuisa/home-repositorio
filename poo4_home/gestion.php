<?php
require_once "Pokemon.php";
require_once "PokemonFuego.php";
require_once "PokemonAgua.php";
require_once "PokemonRayo.php";
require_once "Entrenadora.php";
session_start();

if (!isset($_SESSION["pokemons"])) {
    $_SESSION["pokemons"] = [];
}

if (!isset($_SESSION["entrenadoras"])) {
    $_SESSION["entrenadoras"] = [];
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="estilos.css">
    <title>Gestión Pokémon</title>
</head>
<body>
    <h1>Gestión de Pokemons y Entrenadoras</h1>

    <form method="POST" action="">
        <section>
            <h3>Selecciona un Pokemon</h3>
            <select name="pokemon">
               <?php
                foreach ($_SESSION["pokemons"] as $idPokemon => $pokemon) {
                    echo "<option value='$idPokemon'>" . $pokemon->getNombre() . "</option>";
                }
                ?>
            </select>
            <button type="submit" name="atacar">Atacar</button>
            <button type="submit" name="evolucionar">Evolucionar</button>
            <button type="submit" name="mostrarPokemon">Info Pokémon</button>
        </section>

        <section>
            <h3>Selecciona una Entrenadora</h3>
            <select name="entrenadora">
                <?php
                foreach ($_SESSION["entrenadoras"] as $idEntrenadora => $entrenadora) {
                    echo "<option value='$idEntrenadora'>" . $entrenadora->getNombre() . "</option>";
                }
                ?>
            </select>
            <button type="submit" name="mostrarEntrenadora">Mostrar Info Entrenadora</button>
            <button type="submit" name="cazar">Cazar Pokémon</button>
            <button type="submit" name="vaciar">Vaciar Sesión</button>
        </section>

    </form>

    <section>
    <?php
    if (isset($_POST["atacar"], $_POST["pokemon"])) {
    $idPokemon = $_POST["pokemon"];

    if (isset($_SESSION["pokemons"][$idPokemon])) {
        $mensaje = $_SESSION["pokemons"][$idPokemon]->atacar();
    }
}

if (isset($_POST["evolucionar"], $_POST["pokemon"])) {
    $idPokemon = $_POST["pokemon"];

    if (isset($_SESSION["pokemons"][$idPokemon])) {
        $mensaje = $_SESSION["pokemons"][$idPokemon]->evolucionar();
    }
}

if (isset($_POST["mostrarPokemon"], $_POST["pokemon"])) {
    $idPokemon = $_POST["pokemon"];

    if (isset($_SESSION["pokemons"][$idPokemon])) {
        $mensaje = $_SESSION["pokemons"][$idPokemon]->MostrarInfo();
    }
}

if (isset($_POST["mostrarEntrenadora"], $_POST["entrenadora"])) {
    $idEntrenadora = $_POST["entrenadora"];

    if (isset($_SESSION["entrenadoras"][$idEntrenadora])) {
        $mensaje = $_SESSION["entrenadoras"][$idEntrenadora]->MostrarDetalle();
    }
}

if (isset($_POST["cazar"], $_POST["entrenadora"], $_POST["pokemon"])) {
    $idEntrenadora = $_POST["entrenadora"];
    $idPokemon = $_POST["pokemon"];

    if (
        isset($_SESSION["entrenadoras"][$idEntrenadora]) &&
        isset($_SESSION["pokemons"][$idPokemon])
    ) {
        $mensaje = $_SESSION["entrenadoras"][$idEntrenadora]
            ->CazarPokemon($_SESSION["pokemons"][$idPokemon]);
    }
}

if (isset($_POST["vaciar"])) {
    $_SESSION["pokemons"] = [];
    $_SESSION["entrenadoras"] = [];
    $mensaje = "Se han borrado los datos de la sesión";
}
    
    if (isset($mensaje)) {
        echo "<p>$mensaje</p>";
    }   
    ?>

    <a href="crearpokemon.php">Crear Pokemon</a>
    <a href="crearentrenadora.php">Crear Entrenadora</a>
</section>
</body>
</html>