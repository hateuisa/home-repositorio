<?php
require_once 'clases/config.php';
require_once 'clases/bloque.php';

$database = new Database();
$db = $database->getConnection();

$id_cat = isset($_GET['id']) ? (int)$_GET['id'] : 1;

$bloqueObj = new Bloque($db);
$bloques = $bloqueObj->obtenerBloquesDeCategoria($id_cat); 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Médicos del Mundo - Bloques</title>
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
        
        <div class="contenido-dos-columnas">
            <aside class="menu-lateral">
                <?php if (!empty($bloques)): ?>
                    <?php foreach ($bloques as $b): ?>
                        <a href="#" class="btn-lateral" 
                           data-id="<?php echo htmlspecialchars($b['id_bloque']); ?>"
                           data-titulo="<?php echo htmlspecialchars($b['titulo']); ?>" 
                           data-subtitulo="<?php echo htmlspecialchars($b['subtitulo']); ?>">

                            <?php echo htmlspecialchars($b['titulo']); ?>
                        </a>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p style="color: white;">No hay bloques en esta categoría.</p>
                <?php endif; ?>
            </aside>

            <section class="area-visual">
                <div class="bloque-contratos">
                    <img src="img/contrato2.jpg" alt="" class="imagen-fondo-contrato">
                    <h1 class="titulo-superpuesto">TIPOS DE<br>CONTRATO</h1>

                    <div class="tarjeta-cristal" id="popup-dinamico">
                        <h3 id="txt-titulo">Contrato:</h3>
                        <p id="txt-subtitulo">Pasa el ratón por un contrato...</p>
                        <a href="contenido.php" class="boton-acceder">Acceder a ver más...</a>
                    </div>
                </div>
            </section>
        </div>

    </main>

    <script>
        const botones = document.querySelectorAll('.btn-lateral');
        const popup = document.getElementById('popup-dinamico');
        const h3 = document.getElementById('txt-titulo');
        const p = document.getElementById('txt-subtitulo');
        const btnAcceder = document.querySelector('.boton-acceder');

        botones.forEach(btn => {
            btn.addEventListener('mouseenter', () => {
                h3.textContent = "Contrato " + btn.dataset.titulo + ":";
                p.textContent = btn.dataset.subtitulo;
                
                btnAcceder.href = "contenido.php?id=" + btn.dataset.id;
                
                popup.classList.add('visible'); 
            });

            btn.addEventListener('mouseleave', () => {
                popup.classList.remove('visible'); 
            });
        });
    </script>
</body>
</html>