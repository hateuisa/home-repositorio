<?php
require_once 'Entrenadora.php';
require_once 'Pokemon.php';
session_start();

if (!isset($_SESSION["pokemons"])) {
    $_SESSION["pokemons"] = [];
}
if (!isset($_SESSION["entrenadoras"])) {
    $_SESSION["entrenadoras"] = [];
}

$log = [];
$ganadora = null;
$pokGanador = null;
$resultado = null;
$errores = [];

if (isset($_POST["batallar"])) {
    $idE1 = $_POST["entrenadora1"];
    $idE2 = $_POST["entrenadora2"];
    $idP1 = $_POST["pokemon1"];
    $idP2 = $_POST["pokemon2"];

    if ($idE1 == $idE2) {
        $errores[] = "Las dos entrenadoras deben ser distintas.";
    }
    if ($idP1 == $idP2) {
        $errores[] = "Los dos pokemon deben ser distintos.";
    }

    if (empty($errores)) {
        $e1 = $_SESSION["entrenadoras"][$idE1];
        $e2 = $_SESSION["entrenadoras"][$idE2];
        $p1 = $_SESSION["pokemons"][$idP1];
        $p2 = $_SESSION["pokemons"][$idP2];

        $poder1 = rand(50, 100);
        $poder2 = rand(50, 100);

        $victorias1 = 0;
        $victorias2 = 0;

        for ($r = 1; $r <= 3; $r++) {
            $dmg1 = rand($poder1 - 10, $poder1 + 10);
            $dmg2 = rand($poder2 - 10, $poder2 + 10);

            if ($dmg1 > $dmg2) {
                $victorias1++;
                $log[] = "Ronda $r: " . $p1->getNombre() . " hace $dmg1 de daño y " . $p2->getNombre() . " hace $dmg2. Gana " . $e1->getNombre();
            } elseif ($dmg2 > $dmg1) {
                $victorias2++;
                $log[] = "Ronda $r: " . $p1->getNombre() . " hace $dmg1 de daño y " . $p2->getNombre() . " hace $dmg2. Gana " . $e2->getNombre();
            } else {
                $log[] = "Ronda $r: Empate! Los dos hacen $dmg1 de daño.";
            }
        }

        if ($victorias1 > $victorias2) {
            $ganadora = $e1->getNombre();
            $pokGanador = $p1->getNombre();
        } elseif ($victorias2 > $victorias1) {
            $ganadora = $e2->getNombre();
            $pokGanador = $p2->getNombre();
        }

        $resultado = "batalla";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Batalla Pokemon</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <section>
        <h1>Batalla Pokemon</h1>
    </section>

    <?php if (count($_SESSION["pokemons"]) < 2 || count($_SESSION["entrenadoras"]) < 2) { ?>
        <section>
            <p>Necesitas al menos 2 entrenadoras y 2 pokemon para batallar.</p>
        </section>
    <?php } else { ?>

        <section>
            <form method="POST" action="">
                <h2>Entrenadora 1</h2>
                <label>Entrenadora:</label>
                <select name="entrenadora1">
                    <?php foreach ($_SESSION["entrenadoras"] as $id => $e) { ?>
                        <option value="<?php echo $id; ?>"><?php echo $e->getNombre(); ?></option>
                    <?php } ?>
                </select>
                <p></p>
                <label>Pokemon:</label>
                <select name="pokemon1">
                    <?php foreach ($_SESSION["pokemons"] as $id => $p) { ?>
                        <option value="<?php echo $id; ?>"><?php echo $p->getNombre(); ?></option>
                    <?php } ?>
                </select>

                <h2>Entrenadora 2</h2>
                <label>Entrenadora:</label>
                <select name="entrenadora2">
                    <?php foreach ($_SESSION["entrenadoras"] as $id => $e) { ?>
                        <option value="<?php echo $id; ?>"><?php echo $e->getNombre(); ?></option>
                    <?php } ?>
                </select>
                <p></p>
                <label>Pokemon:</label>
                <select name="pokemon2">
                    <?php foreach ($_SESSION["pokemons"] as $id => $p) { ?>
                        <option value="<?php echo $id; ?>"><?php echo $p->getNombre(); ?></option>
                    <?php } ?>
                </select>
                <p></p>
                <input type="submit" name="batallar" value="Batallar">
            </form>
        </section>

        <?php if (!empty($errores)) { ?>
            <section>
                <?php foreach ($errores as $error) { ?>
                    <p><?php echo $error; ?></p>
                <?php } ?>
            </section>
        <?php } ?>

        <?php if ($resultado == "batalla") { ?>
            <section>
                <h2>Resultado</h2>
                <?php foreach ($log as $linea) { ?>
                    <p><?php echo $linea; ?></p>
                <?php } ?>
                <p>Victorias entrenadora 1: <?php echo $victorias1; ?></p>
                <p>Victorias entrenadora 2: <?php echo $victorias2; ?></p>
                <?php if ($ganadora != null) { ?>
                    <h3>Gana <?php echo $ganadora; ?> con <?php echo $pokGanador; ?>!</h3>
                <?php } else { ?>
                    <h3>Empate!</h3>
                <?php } ?>
            </section>
        <?php } ?>

    <?php } ?>

    <section>
        <a href="crearpokemon.php">Crear Pokemon</a>
        <a href="crearentrenadora.php">Crear Entrenadora</a>
        <a href="gestion.php">Ir a gestion</a>
    </section>

</body>
</html>
