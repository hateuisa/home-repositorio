<?php
require_once "Pokemon.php";
require_once "Entrenadora.php";
session_start();

$mensaje = "";

// Lógica para añadir el ataque
if (isset($_POST["entrenar"], $_POST["idx_entrenadora"], $_POST["idx_pokemon"], $_POST["nuevo_ataque"])) {
    $idxE = $_POST["idx_entrenadora"];
    $idxP = $_POST["idx_pokemon"];
    $nuevoAtk = $_POST["nuevo_ataque"];

    if ($idxE !== "" && $idxP !== "" && !empty($nuevoAtk)) {
        $entrenadora = $_SESSION["entrenadoras"][$idxE];
        $equipo = $entrenadora->getPokemons();
        
        if (isset($equipo[$idxP])) {
            $equipo[$idxP]->AñadirAtaque($nuevoAtk);
            $mensaje = "¡Entrenamiento completado! " . $equipo[$idxP]->getNombre() . " aprendió " . $nuevoAtk;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="estilos.css">
    <title>Gimnasio Pokémon</title>
</head>
<body>
    <nav>Harold: Gimnasio de Entrenamiento</nav>

    <section>
        <h1>Gimnasio Pokémon</h1>
        <p><?php echo $mensaje; ?></p>

        <form method="POST" action="">
            <h3>1. Selecciona Entrenadora</h3>
            <select name="idx_entrenadora" required>
                <option value="">-- Seleccionar --</option>
                <?php
                foreach ($_SESSION["entrenadoras"] as $idx => $ent) {
                    $selected = (isset($_POST['idx_entrenadora']) && $_POST['idx_entrenadora'] == $idx) ? "selected" : "";
                    echo "<option value='$idx' $selected>" . $ent->getNombre() . "</option>";
                }
                ?>
            </select>
            <button type="submit" name="ver_equipo">Ver Equipo</button>
        </form>

        <?php if (isset($_POST["idx_entrenadora"]) && $_POST["idx_entrenadora"] !== ""): ?>
            <hr>
            <form method="POST" action="">
                <input type="hidden" name="idx_entrenadora" value="<?php echo $_POST['idx_entrenadora']; ?>">
                
                <h3>2. Selecciona Pokémon de <?php echo $_SESSION["entrenadoras"][$_POST['idx_entrenadora']]->getNombre(); ?></h3>
                <select name="idx_pokemon" required>
                    <?php
                    $entrenadoraActiva = $_SESSION["entrenadoras"][$_POST['idx_entrenadora']];
                    foreach ($entrenadoraActiva->getPokemons() as $idxP => $pk) {
                        echo "<option value='$idxP'>" . $pk->getNombre() . "</option>";
                    }
                    ?>
                </select>

                <h3>3. Nuevo Ataque a enseñar</h3>
                <input type="text" name="nuevo_ataque" placeholder="Ej: Rayo Hielo" required>
                <br><br>
                <button type="submit" name="entrenar">Enseñar nuevo ataque</button>
            </form>
        <?php endif; ?>

        <br>
        <div style="display:flex; gap:20px;">
            <a href="gestion.php">Volver a Gestión</a>
            <a href="crearpokemon.php">Crear Pokemon</a>
        </div>
    </section>
</body>
</html>