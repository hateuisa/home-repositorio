<?php
require_once 'clases/config.php';

$database = new Database();
$db = $database->getConnection();

$id_bloque = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$query = "SELECT b.titulo, c.url_externas 
          FROM bloque b 
          LEFT JOIN contenido c ON b.id_bloque = c.id_bloque 
          WHERE b.id_bloque = :id LIMIT 1";

$stmt = $db->prepare($query);
$stmt->bindParam(':id', $id_bloque);
$stmt->execute();
$datos = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$datos) {
    $datos = [
        'titulo' => 'Contrato no encontrado',
        'url_externas' => 'No hay información disponible para este contrato.'
    ];
}

$texto_completo = $datos['url_externas'];
$puntos = $texto_completo ? explode('*', $texto_completo) : [];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Médicos del Mundo - <?php echo htmlspecialchars($datos['titulo']); ?></title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

    <?php include 'header.php'?>

    <main class="contenedor-principal">
        
        <h1 class="titulo"><?php echo htmlspecialchars($datos['titulo']); ?></h1>

        <section class="contenedor-tarjetas">
            <div class="tarjeta" style="width: 100%; text-align: left; padding: 20px;">
                
                <?php if(empty($puntos) || trim($texto_completo) == ""): ?>
                    <p>Aún no hay información detallada para este contrato.</p>
                <?php else: ?>
                    
                    <?php foreach ($puntos as $punto): 
                        $punto = trim($punto);
                        if ($punto == "") continue; 
                        
                        $partes = explode(':', $punto, 2); 
                        $titulo_desplegable = isset($partes[0]) ? trim($partes[0]) : 'Detalle';
                        $contenido_desplegable = isset($partes[1]) ? trim($partes[1]) : $punto;
                    ?>
                        <details class="acordeon-item">
                            <summary class="acordeon-titulo"><?php echo htmlspecialchars($titulo_desplegable); ?></summary>
                            <div class="acordeon-texto">
                                <p><?php echo htmlspecialchars($contenido_desplegable); ?></p>
                            </div>
                        </details>
                    <?php endforeach; ?>

                <?php endif; ?>
                
                <br>
                <a href="javascript:history.back()" class="enlace-imagen" style="color: #6a1b9a; font-weight: bold; text-decoration: none;">← Volver a los contratos</a>
            </div>
        </section>
        
    </main>
<?php include 'footer.php';?>
</body>
</html>