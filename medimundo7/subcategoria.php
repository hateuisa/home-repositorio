<?php
require_once 'clases/config.php';
require_once 'clases/categoria.php';
 
$database = new Database();
$db = $database->getConnection();
 
// id de la categoría madre que viene por GET
$id_cat = isset($_GET['id']) ? (int)$_GET['id'] : 0;
 
$catObj = new Categoria($db);
 
// Cargamos el título de la categoría principal (madre)
$catObj->cargarPorId($id_cat);
$tituloCat = $catObj->getTitulo();
 
// Obtenemos las subcategorías cuyo id_madre = $id_cat
$subcategorias = $catObj->listarSubcategorias($id_cat);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Médicos del Mundo - <?php echo htmlspecialchars($tituloCat ?? 'Categoría'); ?></title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
 
    <?php include 'header.php' ?>
 
    <?php if ($id_cat == 1): ?>
    <!-- ======= LAYOUT CONTRATOS ======= -->
    <main class="contenedor-principal">
        <div class="contenido-dos-columnas">
 
            <aside class="menu-lateral">
                <?php if (!empty($subcategorias)): ?>
                    <?php foreach ($subcategorias as $sub): ?>
                        <a href="#" class="btn-lateral"
                           data-id="<?php echo htmlspecialchars($sub['id_categoria']); ?>"
                           data-titulo="<?php echo htmlspecialchars($sub['titulo']); ?>"
                           data-subtitulo="<?php echo htmlspecialchars($sub['descripcion']); ?>">
                            <?php echo htmlspecialchars($sub['titulo']); ?>
                        </a>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p style="color:white;">No hay tipos de contrato.</p>
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
                h3.textContent  = btn.dataset.titulo + ":";
                p.textContent   = btn.dataset.subtitulo;
                // Ahora el id es el id_categoria de la subcategoría
                btnAcceder.href = "contenido.php?id=" + btn.dataset.id;
                popup.classList.add('visible');
            });
            btn.addEventListener('mouseleave', () => popup.classList.remove('visible'));
        });
    </script>
 
    <?php else: ?>
    <!-- ======= LAYOUT APPLE (Jornada y resto) ======= -->
 
    <div class="apple-header">
        <h1 class="apple-header-titulo"><?php echo htmlspecialchars($tituloCat ?? ''); ?></h1>
        <nav class="apple-nav">
            <?php foreach ($subcategorias as $sub): ?>
                <a href="#sub-<?php echo $sub['id_categoria']; ?>" class="apple-pildora">
                    <?php echo htmlspecialchars($sub['titulo']); ?>
                </a>
            <?php endforeach; ?>
        </nav>
    </div>
 
    <main class="apple-main">
        <?php if (!empty($subcategorias)): ?>
            <?php foreach ($subcategorias as $i => $sub): ?>
                <section class="apple-seccion <?php echo ($i % 2 === 0) ? 'apple-seccion--normal' : 'apple-seccion--invertida'; ?>"
                         id="sub-<?php echo $sub['id_categoria']; ?>">
 
                    <div class="apple-imagen">
                        <?php if (!empty($sub['icono'])): ?>
                            <img src="img/<?php echo htmlspecialchars($sub['icono']); ?>"
                                 alt="<?php echo htmlspecialchars($sub['titulo']); ?>">
                        <?php else: ?>
                            <div class="apple-imagen-placeholder"></div>
                        <?php endif; ?>
                    </div>
 
                    <div class="apple-texto">
                        <h2 class="apple-texto-titulo"><?php echo htmlspecialchars($sub['titulo']); ?></h2>
                        <p class="apple-texto-subtitulo"><?php echo htmlspecialchars($sub['descripcion']); ?></p>
                        <a href="contenido.php?id=<?php echo $sub['id_categoria']; ?>" class="apple-enlace">
                            Más información &rsaquo;
                        </a>
                    </div>
 
                </section>
            <?php endforeach; ?>
        <?php else: ?>
            <p style="color:white; padding:60px; text-align:center;">No hay subcategorías en esta categoría.</p>
        <?php endif; ?>
    </main>
 
    <?php endif; ?>
 
    <?php include 'footer.php'; ?>
</body>
</html>
 