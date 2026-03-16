<?php
// 1. Incluimos todas las clases necesarias. IMPORTANTE: Antes de session_start
require_once 'Pokemon.php';
require_once 'PokemonFuego.php';
require_once 'PokemonAgua.php';
require_once 'PokemonRayo.php';
require_once 'Entrenadora.php';
session_start();

// Inicializamos las sesiones si no existen
if(!isset($_SESSION["pokemons"])) $_SESSION["pokemons"] = [];
if(!isset($_SESSION["entrenadoras"])) $_SESSION["entrenadoras"] = [];

if(isset($_POST["crear"])){
    $nombre = $_POST["nombre"];
    $elemento = $_POST["elemento"];
    // Ahora leemos el tipo del formulario para evitar el Warning
    $tipo = $_POST["tipo"]; 
    $ataque = $_POST["ataque"];
    $idEntrenadora = $_POST["entrenadora_id"]; 

    // 2. Lógica de instanciación según el elemento seleccionado
    switch ($elemento) {
        case "Fuego":
            $pokemon = new PokemonFuego($nombre, $ataque);
            break;
        case "Agua":
            $pokemon = new PokemonAgua($nombre, $ataque);
            break;
        case "Rayo":
            $pokemon = new PokemonRayo($nombre, $ataque);
            break;
        default:
            $pokemon = new Pokemon($nombre, $elemento, $tipo, $ataque);
            break;
    }

    // 3. ASIGNACIÓN: Guardar el Pokémon dentro de la entrenadora
    if ($idEntrenadora !== "") {
        $entrenadora = $_SESSION["entrenadoras"][$idEntrenadora];
        
        if ($entrenadora->CazarPokemon($pokemon)) {
            // Guardamos la entrenadora actualizada de vuelta en la sesión
            $_SESSION["entrenadoras"][$idEntrenadora] = $entrenadora;
            $mensaje = "¡" . $pokemon->getNombre() . " ahora pertenece a " . $entrenadora->getNombre() . "!";
        } else {
            $mensaje = "Error: Esta entrenadora ya tiene el equipo lleno (máximo 3).";
        }
    }

    $_SESSION["pokemons"][] = $pokemon;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Pokemon</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <section>
        <h1>Crear Pokemon</h1>
        <form method="POST" action="">
            <label><p>Nombre</p></label>
            <input type="text" name="nombre" required>

            <label><p>Elemento</p></label>
            <select name="elemento">
                <option value="Fuego">Fuego</option>
                <option value="Agua">Agua</option>
                <option value="Rayo">Rayo</option>
                <option value="Normal">Normal</option>
            </select>

            <label><p>Tipo de Pokémon</p></label>
            <input type="text" name="tipo" placeholder="Ej: Especial, Físico..." required>

            <label><p>Asignar a Entrenadora:</p></label>
            <select name="entrenadora_id" required>
                <option value="">-- Elige quién lo capturará --</option>
                <?php
                foreach ($_SESSION["entrenadoras"] as $id => $e) {
                    echo "<option value='$id'>" . $e->getNombre() . "</option>";
                }
                ?>
            </select>

            <label><p>Ataque Inicial</p></label>
            <input type="text" name="ataque" required>
            
            <p></p>
            <input type="submit" name="crear" value="Crear y Asignar">
        </form>

        <?php if (isset($mensaje)) echo "<p style='color: green;'>$mensaje</p>"; ?>
    </section>

    <section>
        <h2>Pokémon en el sistema</h2>
        <?php
        if (count($_SESSION["pokemons"]) > 0) {
            foreach ($_SESSION["pokemons"] as $p) {
                echo "<div>" . $p->MostrarInfo() . "</div><hr>";
            }
        } else {
            echo "<p>No hay Pokémon creados todavía</p>";
        }
        ?>
    </section>

    <br>
    <div style="display:flex; gap:10px;">
        <a href="gestion.php">Ir a gestión</a>
        <a href="crearentrenadora.php">Crear Entrenadora</a>
        <a href="fight.php" style="color:red; font-weight:bold;">¡IR A BATALLA!</a>
    </div>
</body>
</html>