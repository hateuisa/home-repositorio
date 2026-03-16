<?php
require_once "Pokemon.php";
require_once "PokemonFuego.php";
require_once "PokemonAgua.php";
require_once "PokemonRayo.php";
require_once "Entrenadora.php";
session_start();

if (!isset($_SESSION["pokemons"])) $_SESSION["pokemons"] = [];
if (!isset($_SESSION["entrenadoras"])) $_SESSION["entrenadoras"] = [];

$paso_combate = (isset($_POST['entre1'], $_POST['entre2']) && $_POST['entre1'] !== "") ? 2 : 1;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="estilos.css">
    <title>¡Batalla Pokémon!</title>
</head>
<body>
    <h1>¡Batalla Pokémon!</h1>

    <form method="POST" action="">
        <section>
            <h3>Selecciona la Primera Entrenadora</h3>
            <select name="entre1" required>
                <option value="">-- Seleccionar --</option>
                <?php
                foreach ($_SESSION["entrenadoras"] as $id => $entrenadora) {
                    $sel = (isset($_POST['entre1']) && $_POST['entre1'] == $id) ? "selected" : "";
                    echo "<option value='$id' $sel>" . $entrenadora->getNombre() . "</option>";
                }
                ?>
            </select>
        </section>

        <section>
            <h3>Selecciona la Segunda Entrenadora</h3>
            <select name="entre2" required>
                <option value="">-- Seleccionar --</option>
                <?php
                foreach ($_SESSION["entrenadoras"] as $id => $entrenadora) {
                    $sel = (isset($_POST['entre2']) && $_POST['entre2'] == $id) ? "selected" : "";
                    echo "<option value='$id' $sel>" . $entrenadora->getNombre() . "</option>";
                }
                ?>
            </select>
            <p><button type="submit">Confirmar Entrenadoras</button></p>
        </section>
    </form>

    <hr>

    <?php
    // SECCIÓN 2: Selección de Pokémon específicos
    if($paso_combate == 2) {
        $e1 = $_SESSION['entrenadoras'][$_POST['entre1']];
        $e2 = $_SESSION['entrenadoras'][$_POST['entre2']];

        if ($_POST['entre1'] === $_POST['entre2']) {
            echo "<p style='color:red;'>¡No puedes pelear contra ti misma!</p>";
        } else {
            echo "<form method='POST' action=''>
                <input type='hidden' name='entre1' value='".$_POST['entre1']."'>
                <input type='hidden' name='entre2' value='".$_POST['entre2']."'>
                
                <div style='display:flex; justify-content: space-around;'>
                    <section class='pokemon'>
                        <h3>Equipo de ".$e1->getNombre()."</h3>
                        <select name='pokemon1'>";
                        foreach ($e1->getPokemons() as $id => $p) {
                            echo "<option value='$id'>".$p->getNombre()." (HP: ".$p->getVida().")</option>";
                        }
            echo "      </select>
                    </section>

                    <section class='pokemon'>
                        <h3>Equipo de ".$e2->getNombre()."</h3>
                        <select name='pokemon2'>";
                        foreach ($e2->getPokemons() as $id => $p) {
                            echo "<option value='$id'>".$p->getNombre()." (HP: ".$p->getVida().")</option>";
                        }
            echo "      </select>
                    </section>
                </div>
                <p style='text-align:center;'><button type='submit' name='luchar'>¡A LUCHAR!</button></p>
            </form>";
        }
    }

    // SECCIÓN 3: Lógica del Combate
    if(isset($_POST['luchar'])){
        $e1 = $_SESSION['entrenadoras'][$_POST['entre1']];
        $e2 = $_SESSION['entrenadoras'][$_POST['entre2']];
        $p1 = $e1->getPokemons()[$_POST['pokemon1']];
        $p2 = $e2->getPokemons()[$_POST['pokemon2']];

        // Usamos el método polimórfico
        $danio1 = $p1->calcularDanio();
        $danio2 = $p2->calcularDanio();

        if($p1->getVida() > 0 && $p2->getVida() > 0){
            $p1->restaVida($danio2);
            $p2->restaVida($danio1);
            
            echo "<div style='background: white; padding: 20px; border-radius: 10px; margin-top: 20px;'>";
            echo "<h3>Resultado del Turno:</h3>";
            echo "<p>" . $p1->Atacar() . " (Daño: ".round($danio1).")</p>";
            echo "<p>" . $p2->Atacar() . " (Daño: ".round($danio2).")</p>";
            echo "<h4>Estado actual:</h4>";
            echo "<p>".$p1->getNombre().": <b>".$p1->getVida()." HP</b> | ".$p2->getNombre().": <b>".$p2->getVida()." HP</b></p>";
            echo "</div>";
        }

        if($p1->getVida() <= 0 || $p2->getVida() <= 0){
            echo "<h2>¡Combate Terminado!</h2>";
            $ganador = ($p1->getVida() > $p2->getVida()) ? $p1->getNombre() : $p2->getNombre();
            echo "<h3>🏆 Ganador: $ganador</h3>";
        }
    }
    ?>

    <br>
    <div style="text-align:center;">
        <a href="gestion.php">Volver al Centro Pokémon</a>
    </div>
</body>
</html>