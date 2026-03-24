<?php
session_start();

require_once 'clases/config.php';
require_once 'clases/categoria.php';

$database = new Database();
$db       = $database->getConnection();

$cat  = new Categoria($db);
$stmt = $cat->listarTodas();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Médicos del Mundo</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

    <?php include 'header.php'; ?>

    <main class="contenedor-principal">

        <h1 class="titulo">¿Qué quieres hacer hoy?</h1>

        <section class="contenedor-tarjetas">
            <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                <article class="tarjeta">
                    <h3 class="tarjeta-titulo-blanco"><?php echo $row['titulo']; ?></h3>

                    <a href="<?php echo ($row['id_categoria'] == 1) ? 'gestioncontratos.php' : 'bloques.php?id=' . $row['id_categoria']; ?>" class="enlace-imagen">
                        <img src="img/<?php echo $row['icono']; ?>" alt="icono" class="imagen-boton">
                    </a>
                </article>
            <?php endwhile; ?>
        </section>

    </main>

    <?php include 'footer.php'; ?>

</body>
</html>