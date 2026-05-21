<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informacion sin contrato</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

<header class="navegacion">
    <a href="index.php">
        <img src="img/logomorado.png" alt="Logo" class="logo">
    </a>
    <a href="login.php">
        <img src="img/usuaria.png" alt="Usuario" class="usuario">
    </a>
</header>

<main class="contenedor-principal">
    
    <h1 class="titulo">Información sin contrato</h1>
    
    <section>
        
        <details class="acordeon-item">
            <summary class="acordeon-titulo">Relación Laboral</summary>
            <div class="acordeon-texto">
                <p>Que quieres saber:</p>
                <p><a href="conceptos-basicos.php" class="apple-enlace">Conceptos Básicos &rsaquo;</a></p>
                <p><a href="lugar-trabajador.php" class="apple-enlace">Lugar del trabajador &rsaquo;</a></p>
            </div>
        </details>

        <details class="acordeon-item">
            <summary class="acordeon-titulo">Contrato Legal</summary>
            <div class="acordeon-texto">
                <p>Que quieres saber:</p>
                <p><a href="que-es-contrato.php" class="apple-enlace">¿Que es un contrato? &rsaquo;</a></p>
                <p><a href="que-debe-tener.php" class="apple-enlace">¿Qué debe tener? &rsaquo;</a></p>
                <p><a href="firma-copia.php" class="apple-enlace">La firma y copia &rsaquo;</a></p>
            </div>
        </details>

        <details class="acordeon-item">
            <summary class="acordeon-titulo">Derechos fundamentales</summary>
            <div class="acordeon-texto">
                <p>Que quieres saber:</p>
                <p><a href="igualdad.php" class="apple-enlace">Igualdad &rsaquo;</a></p>
                <p><a href="dignidad-respeto.php" class="apple-enlace">Dignidad y Respeto &rsaquo;</a></p>
                <p><a href="salud.php" class="apple-enlace">Salud &rsaquo;</a></p>
            </div>
        </details>

    </section>

</main>

<?php include 'footer.php'?>

</body>
</html>