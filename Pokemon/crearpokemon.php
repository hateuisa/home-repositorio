<?php
require_once 'Pokemon.php';
require_once 'Entrenadora.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Pokemon</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <section>
        <h1>Crear Pokemon</h1>
        <form method="POST" action="">
            <label for="nombre"><p>Nombre</p></label>
            <input type="text" name="nombre">
            
            <label for="elemento"><p>Elemento</p></label>
            <input type="text" name="elemento">
            
            <label for="tipo"><p>Tipo</p></label>
            <input type="text" name="tipo">
            
            <label for="ataque"><p>Ataque</p></label>
            <input type="text" name="ataque">

            <label for="id_entrenadora"><p>Asignar a Entrenadora</p></label>
            <select name="id_entrenadora">
                <?php
                if (isset($_SESSION["entrenadoras"]) && count($_SESSION["entrenadoras"]) > 0) {
                    foreach ($_SESSION["entrenadoras"] as $id => $entrenadora) {
                        echo "<option value='$id'>" . $entrenadora->getNombre() . "</option>";
                    }
                } else {
                    echo "<option value=''>No hay entrenadoras</option>";
                }
                ?>
            </select>
            <p></p>
            <input type="submit" value="crear">
        </form>
    </section>

    <section>
    <?php
    if(!isset($_SESSION["pokemons"])){
        $_SESSION["pokemons"]=[];
    }

    if(isset($_POST["nombre"], $_POST["elemento"], $_POST["tipo"], $_POST["ataque"], $_POST["id_entrenadora"])){
        $nombre = $_POST["nombre"];
        $elemento = $_POST["elemento"];
        $tipo = $_POST["tipo"];
        $ataque = $_POST["ataque"];
        $idEntrenadora = $_POST["id_entrenadora"];

        $pokemon = new Pokemon($nombre, $elemento, $tipo, $ataque);
        $_SESSION["pokemons"][] = $pokemon;

        if ($idEntrenadora !== "" && isset($_SESSION["entrenadoras"][$idEntrenadora])) {
            $_SESSION["entrenadoras"][$idEntrenadora]->CazarPokemon($pokemon);
            $mensaje = "Pokemon creado y asignado a " . $_SESSION["entrenadoras"][$idEntrenadora]->getNombre() . " con éxito.";
        } else {
            $mensaje = "Pokemon creado, pero no se pudo asignar (sin entrenadora).";
        }
    }

    if (isset($mensaje)){
        echo "<p>$mensaje</p>";
    }  
    ?>
    </section>

    <section>
        <h2>Pokémon creados</h2>
        <?php
        if (count($_SESSION["pokemons"]) > 0) {
            foreach ($_SESSION["pokemons"] as $pokemon) {
                echo "<p>" . $pokemon->mostrarInfo() . "</p>";
            }
        } else {
            echo "<p>No hay Pokémon creados todavía</p>";
        }
        ?>
    </section>

    <a href="gestion.php">Ir a gestión</a>
    <a href="crearentrenadora.php">Ir a creación de entrenadoras</a>
    <a href="batalla.php">Batalla Pokémon</a>
</body>
</html>