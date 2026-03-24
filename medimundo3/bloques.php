<?php
require_once 'clases/config.php';
require_once 'clases/bloque.php';
require_once 'clases/categoria.php';

$database = new Database();
$db = $database->getConnection();

$id_cat = isset($_GET['id']) ? (int)$_GET['id'] : 1;

$bloqueObj = new Bloque($db);
$bloques = $bloqueObj->obtenerBloquesDeCategoria($id_cat);

$catObj = new Categoria($db);
$catObj->cargarPorId($id_cat);
$tituloCat = $catObj->getTitulo();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Médicos del Mundo - <?php echo htmlspecialchars($tituloCat ?? 'Bloques'); ?></title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

    <?php include 'header.php' ?>

    <?php if ($id_cat == 1): ?>
    <!-- ======================================================
         LAYOUT CONTRATOS (id=1) — igual que siempre
         ====================================================== -->
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
                    <p style="color:white;">No hay bloques en esta categoría.</p>
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
        const botones    = document.querySelectorAll('.btn-lateral');
        const popup      = document.getElementById('popup-dinamico');
        const h3         = document.getElementById('txt-titulo');
        const p          = document.getElementById('txt-subtitulo');
        const btnAcceder = document.querySelector('.boton-acceder');

        botones.forEach(btn => {
            btn.addEventListener('mouseenter', () => {
                h3.textContent  = "Contrato " + btn.dataset.titulo + ":";
                p.textContent   = btn.dataset.subtitulo;
                btnAcceder.href = "contenido.php?id=" + btn.dataset.id;
                popup.classList.add('visible');
            });
            btn.addEventListener('mouseleave', () => popup.classList.remove('visible'));
        });
    </script>

    <?php else: ?>
    <!-- ======================================================
         LAYOUT APPLE — scroll de secciones (resto de categorías)
         ====================================================== -->

    <!-- Cabecera fija de la categoría -->
    <div class="apple-header">
        <h1 class="apple-header-titulo"><?php echo htmlspecialchars($tituloCat ?? ''); ?></h1>

        <!-- Menú de anclas (píldoras) -->
        <nav class="apple-nav">
            <?php foreach ($bloques as $b): ?>
                <a href="#bloque-<?php echo $b['id_bloque']; ?>" class="apple-pildora">
                    <?php echo htmlspecialchars($b['titulo']); ?>
                </a>
            <?php endforeach; ?>
        </nav>
    </div>

    <!-- Secciones scrolleables, alternando imagen izq/der -->
    <main class="apple-main">
        <?php if (!empty($bloques)): ?>
            <?php foreach ($bloques as $i => $b): ?>
                <section class="apple-seccion <?php echo ($i % 2 === 0) ? 'apple-seccion--normal' : 'apple-seccion--invertida'; ?>"
                         id="bloque-<?php echo $b['id_bloque']; ?>">

                    <!-- Lado imagen -->
                    <div class="apple-imagen">
                        <?php if (!empty($b['icono'])): ?>
                            <img src="img/<?php echo htmlspecialchars($b['icono']); ?>"
                                 alt="<?php echo htmlspecialchars($b['titulo']); ?>">
                        <?php else: ?>
                            <!-- Placeholder con color si no hay imagen -->
                            <div class="apple-imagen-placeholder"></div>
                        <?php endif; ?>
                    </div>

                    <!-- Lado texto -->
                    <div class="apple-texto">
                        <h2 class="apple-texto-titulo"><?php echo htmlspecialchars($b['titulo']); ?></h2>
                        <p class="apple-texto-subtitulo"><?php echo htmlspecialchars($b['subtitulo']); ?></p>
                        <a href="contenido.php?id=<?php echo $b['id_bloque']; ?>" class="apple-enlace">
                            Más información &rsaquo;
                        </a>
                    </div>

                </section>
            <?php endforeach; ?>
        <?php else: ?>
            <p style="color:white; padding:60px; text-align:center;">No hay bloques en esta categoría.</p>
        <?php endif; ?>
    </main>

    <?php endif; ?>

    <?php include 'footer.php'; ?>
</body>
</html>