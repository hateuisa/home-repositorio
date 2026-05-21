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

                    <a href="<?php echo ($row['id_categoria'] == 1) ? 'gestioncontratos.php' : 'subcategoria.php?id=' . $row['id_categoria']; ?>" class="enlace-imagen">
                        <img src="img/<?php echo $row['icono']; ?>" alt="icono" class="imagen-boton">
                    </a>
                </article>
            <?php endwhile; ?>
        </section>

    </main>

    <style>
    .btn-recursos {
        position: fixed !important;
        bottom: 30px !important;
        right: 30px !important;
        width: 80px !important;
        height: 80px !important;
        z-index: 9999 !important;
        transition: all 0.3s ease; /* Esto hace que el efecto sea suave */
    }

    /* Este es el efecto Hover */
    .btn-recursos:hover {
        transform: scale(1.15); /* Crece un 15% al pasar el mouse */
        filter: drop-shadow(0px 0px 10px rgba(0,0,0,0.3)); /* Añade una sombrita */
    }

    .btn-recursos img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        padding: 10px;
        display: block;
    }
</style>

<a href="recursos.php" class="btn-recursos" aria-label="Recursos">
    <img src="img/idea.png" alt="Recursos">
</a>

    <?php include 'footer.php'; ?>
</body>
</html>