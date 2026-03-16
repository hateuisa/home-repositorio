<?php
require_once 'Pokemon.php';
require_once 'Entrenadora.php';

session_start();

$mensaje = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    if (isset($_POST['atacar_btn'])) {
        $idx = $_POST['pokemon_idx'];
        if ($idx !== "") {
            $mensaje = $_SESSION['pokemons'][$idx]->Atacar();
        }
    }

   
    if (isset($_POST['evolucionar_btn'])) {
        $idx = $_POST['pokemon_idx'];
        if ($idx !== "") {
            $mensaje = $_SESSION['pokemons'][$idx]->Evolucionar();
        }
    }

   
    if (isset($_POST['info_pk_btn'])) {
        $idx = $_POST['pokemon_idx'];
        if ($idx !== "") {
            $mensaje = $_SESSION['pokemons'][$idx]->MostrarInfo();
        }
    }

   
    if (isset($_POST['info_ent_btn'])) {
        $idx = $_POST['entrenadora_idx'];
        if ($idx !== "") {
            $ent = $_SESSION['entrenadoras'][$idx];
            $equipo = $ent->MostrarEquipo();
            $mensaje = "Equipo de la entrenadora: <br>";
            foreach ($equipo as $pk) {
                $mensaje .= "- " . $pk->MostrarInfo() . "<br>";
            }
        }
    }

    if (isset($_POST['cazar_btn'])) {
        $idx_ent = $_POST['entrenadora_idx'];
        $idx_pk = $_POST['pokemon_idx'];
        
        if ($idx_ent !== "" && $idx_pk !== "") {
            $mensaje = $_SESSION['entrenadoras'][$idx_ent]->CapturarPokemon($_SESSION['pokemons'][$idx_pk]);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="estilos.css">
    <title>Harold: Gestión Pokémon</title>
</head>
<body>
    <nav>
        Harold: Panel de Gestión Pokémon
    </nav>
    
    <section>
        <p><?php echo $mensaje; ?></p>

        <form method="POST">
            <p>Seleccionar Pokémon</p>
            <select name="pokemon_idx" required>
                <option value="">-- Mis Pokémon --</option>
                <?php 
                if(isset($_SESSION['pokemons'])){
                    foreach ($_SESSION['pokemons'] as $i => $p){
                        echo "<option value='$i'>" . $p->MostrarInfo() . "</option>";
                    }
                }
                ?>
            </select>

           <h3>Seleccionar Entrenadora</h3>
                <select name="entrenadora_idx" required>
                <option value="">-- Entrenadoras --</option>
            <?php 
                if(isset($_SESSION['entrenadoras'])){
                    foreach ($_SESSION['entrenadoras'] as $i => $e){
        
                echo "<option value='$i'>" . $e->getNombre() . "</option>";
        }
    }
    ?>
</select>

            <br><br>
            <input type="submit" name="atacar_btn" value="Pokémon ataca">
            <input type="submit" name="evolucionar_btn" value="Evolucionar Pokémon">
            <input type="submit" name="info_pk_btn" value="Info Pokémon">
            <input type="submit" name="info_ent_btn" value="Ver Equipo Entrenadora">
            <input type="submit" name="cazar_btn" value="Cazar Pokémon">
        </form>
    </section>

    <footer>
        <a href="crear_pokemon.php">Crear Pokémon</a>&nbsp;|&nbsp;
        <a href="crear_entrenadora.php">Crear Entrenadora</a>
    </footer>
</body>
</html>