<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Médicos del Mundo — Gestión de Contratos</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

    <?php include 'header.php'; ?>

    <main class="contenedor-principal">

        <h1 class="titulo-gestion">¿Tienes un contrato de trabajo?</h1>

        <section class="contenedor-tarjetas">

            <!-- Tarjeta SÍ -->
            <article class="tarjeta">
                <h3 class="tarjeta-titulo-blanco">Sí, tengo contrato.</h3>
                <a href="bloques.php?id=1" class="enlace-imagen">
                    <img src="img/contrato3.jpg" alt="Sí, tengo contrato" class="imagen-boton">
                </a>
            </article>

            <!-- Tarjeta NO -->
            <article class="tarjeta">
                <h3 class="tarjeta-titulo-blanco">No, por el momento.</h3>
                <a href="info_sin_contrato.php" class="enlace-imagen">
                    <img src="img/nocontrato.jpg" alt="No, por el momento no" class="imagen-boton">
                </a>
            </article>

        </section>

    </main>

    <?php include 'footer.php'; ?>

</body>
</html>