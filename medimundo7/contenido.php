<?php
require_once 'clases/config.php';
require_once 'clases/bloque.php';
require_once 'clases/categoria.php';

$database = new Database();
$db = $database->getConnection();

$id_subcat = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$catObj = new Categoria($db);
$catObj->cargarPorId($id_subcat);
$tituloSubcat = $catObj->getTitulo();

$bloqueObj = new Bloque($db);
$bloques = $bloqueObj->obtenerBloquesPorCategoria($id_subcat);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Médicos del Mundo - <?php echo htmlspecialchars($tituloSubcat ?? 'Contenido'); ?></title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

    <?php include 'header.php' ?>

    <main class="contenido-main">

        <div class="contenido-cabecera">
            <h1 class="contenido-titulo"><?php echo htmlspecialchars($tituloSubcat ?? ''); ?></h1>
            <p class="contenido-subtitulo">Información sobre tu contrato</p>
        </div>

        <?php if (empty($bloques)): ?>
            <p class="sin-datos">No hay contenido disponible todavía.</p>
        <?php else: ?>
            <div class="contenido-grid">
                <?php foreach ($bloques as $b): ?>
                    <div class="info-tarjeta">

                        <?php if (!empty($b['icono'])): ?>
                            <div class="info-tarjeta-icono">
                                <img src="img/<?php echo htmlspecialchars($b['icono']); ?>"
                                     alt=""
                                     style="width:40px; height:40px; object-fit:contain;">
                            </div>
                        <?php else: ?>
                            <div class="info-tarjeta-icono"></div>
                        <?php endif; ?>

                        <div class="info-tarjeta-cuerpo">
                            <div class="info-tarjeta-titulo">
                                <?php echo htmlspecialchars($b['titulo']); ?>
                            </div>
                            <?php if (!empty($b['subtitulo'])): ?>
                                <div style="font-weight:600; margin-bottom:6px; color:#5a007a; font-size:0.95rem;">
                                    <?php echo htmlspecialchars($b['subtitulo']); ?>
                                </div>
                            <?php endif; ?>
                            <div class="info-tarjeta-texto">
                        <?php echo nl2br(htmlspecialchars(htmlspecialchars_decode($b['contenido'] ?? ''))); ?>                            </div>
                        </div>

                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <a href="javascript:history.back()" class="contenido-volver">← Volver</a>

    </main>

    <?php include 'footer.php'; ?>
</body>
</html>