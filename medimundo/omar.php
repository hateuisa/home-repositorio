<?php
session_start();

require_once 'clases/config.php';
require_once 'clases/categoria.php'; 


$database = new Database();
$db = $database->getConnection();

$cat = new Categoria($db);
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

    <header class="navegacion">
        <img src="img/logomorado.png" alt="Logo" class="logo">
        
        <a href="login.php">
            <img src="img/usuaria.png" alt="Usuario" class="usuario">
        </a>
    </header>

    <main class="contenedor-principal">
        <h1 class="titulo">¿Qué quieres hacer hoy?</h1>
        
        <section class="contenedor-tarjetas">
            <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                <article class="tarjeta">
                    <h3 class="tarjeta-titulo-blanco"><?php echo $row['titulo']; ?></h3>
                    
                    <a href="bloques.php?id=<?php echo $row['id_categoria']; ?>" class="enlace-imagen">
                        <img src="img/<?php echo $row['icono']; ?>" alt="icono" class="imagen-boton">
                    </a>
                </article>
            <?php endwhile; ?>
        </section>
    </main>

</body>
</html>