<?php
session_start();

// ── Protección de acceso ──────────────────────────────────────────────────────
// Descomenta estas líneas cuando tengas el login funcionando:
// if (!isset($_SESSION['id_usuario']) || $_SESSION['id_rol'] != 1) {
//     header('Location: login.php');
//     exit;
// }

require_once 'clases/config.php';
require_once 'clases/categoria.php';
require_once 'clases/bloque.php';
require_once 'clases/faq.php';
require_once 'clases/usuaria.php';
require_once 'clases/gestion.php';

$database = new Database();
$db       = $database->getConnection();
$admin    = new GestionAdmin($db);
$cat      = new Categoria($db);

// ── Sección activa (GET o POST) ───────────────────────────────────────────────
$seccion = isset($_GET['seccion']) ? $_GET['seccion'] : 'usuarios';

// ── Helper: subir imagen a /img/ ──────────────────────────────────────────────
function subirIcono($campo, $icono_actual = '') {
    if (!isset($_FILES[$campo]) || $_FILES[$campo]['error'] === UPLOAD_ERR_NO_FILE) {
        return $icono_actual; // No se subió nada → mantener el anterior
    }
    $file = $_FILES[$campo];
    if ($file['error'] !== UPLOAD_ERR_OK) {
        return $icono_actual;
    }
    $permitidos = ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/svg+xml'];
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime  = finfo_file($finfo, $file['tmp_name']);
    finfo_close($finfo);
    if (!in_array($mime, $permitidos)) {
        return $icono_actual;
    }
    $ext      = pathinfo($file['name'], PATHINFO_EXTENSION);
    $nombre   = uniqid('img_', true) . '.' . strtolower($ext);
    $destino  = __DIR__ . '/img/' . $nombre;
    if (!is_dir(__DIR__ . '/img/')) {
        mkdir(__DIR__ . '/img/', 0755, true);
    }
    if (move_uploaded_file($file['tmp_name'], $destino)) {
        return $nombre;
    }
    return $icono_actual;
}

// ── Procesamiento de formularios (POST) ──────────────────────────────────────
$mensaje = '';
$tipo_mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'] ?? '';

    // ── USUARIOS ─────────────────────────────────────────────────────────────
    if ($accion === 'crear_usuario') {
        $ok = $admin->crearUsuario(
            htmlspecialchars($_POST['nombre']),
            htmlspecialchars($_POST['email']),
            $_POST['password'],
            (int)$_POST['id_rol']
        );
        $mensaje = $ok ? 'Usuario creado correctamente.' : 'Error al crear el usuario.';
        $tipo_mensaje = $ok ? 'exito' : 'error';
        $seccion = 'usuarios';
    }

    if ($accion === 'editar_usuario') {
        $ok = $admin->editarUsuario(
            (int)$_POST['id_usuario'],
            htmlspecialchars($_POST['nombre']),
            htmlspecialchars($_POST['email']),
            (int)$_POST['id_rol']
        );
        $mensaje = $ok ? 'Usuario actualizado.' : 'Error al actualizar.';
        $tipo_mensaje = $ok ? 'exito' : 'error';
        $seccion = 'usuarios';
    }

    if ($accion === 'eliminar_usuario') {
        $ok = $admin->eliminarUsuario((int)$_POST['id_usuario']);
        $mensaje = $ok ? 'Usuario eliminado.' : 'Error al eliminar.';
        $tipo_mensaje = $ok ? 'exito' : 'error';
        $seccion = 'usuarios';
    }

    // ── CATEGORÍAS ───────────────────────────────────────────────────────────
    if ($accion === 'crear_categoria') {
        $icono = subirIcono('icono_archivo');
        $ok = $admin->crearCategoria(
            htmlspecialchars($_POST['titulo']),
            htmlspecialchars($_POST['descripcion']),
            $icono
        );
        $mensaje = $ok ? 'Categoría creada.' : 'Error al crear la categoría.';
        $tipo_mensaje = $ok ? 'exito' : 'error';
        $seccion = 'categorias';
    }

    if ($accion === 'editar_categoria') {
        $icono = subirIcono('icono_archivo', htmlspecialchars($_POST['icono_actual'] ?? ''));
        $ok = $admin->editarCategoria(
            (int)$_POST['id_categoria'],
            htmlspecialchars($_POST['titulo']),
            htmlspecialchars($_POST['descripcion']),
            $icono
        );
        $mensaje = $ok ? 'Categoría actualizada.' : 'Error al actualizar.';
        $tipo_mensaje = $ok ? 'exito' : 'error';
        $seccion = 'categorias';
    }

    if ($accion === 'eliminar_categoria') {
        $ok = $admin->eliminarCategoria((int)$_POST['id_categoria']);
        $mensaje = $ok ? 'Categoría eliminada.' : 'Error al eliminar.';
        $tipo_mensaje = $ok ? 'exito' : 'error';
        $seccion = 'categorias';
    }

    // ── SUBCATEGORÍAS ────────────────────────────────────────────────────────
    if ($accion === 'crear_subcategoria') {
        $icono = subirIcono('icono_archivo');
        $ok = $admin->crearSubcategoria(
            htmlspecialchars($_POST['titulo']),
            htmlspecialchars($_POST['descripcion']),
            $icono,
            (int)$_POST['id_madre']
        );
        $mensaje = $ok ? 'Subcategoría creada.' : 'Error al crear la subcategoría.';
        $tipo_mensaje = $ok ? 'exito' : 'error';
        $seccion = 'subcategorias';
    }

    if ($accion === 'editar_subcategoria') {
        $icono = subirIcono('icono_archivo', htmlspecialchars($_POST['icono_actual'] ?? ''));
        $ok = $admin->editarSubcategoria(
            (int)$_POST['id_subcategoria'],
            htmlspecialchars($_POST['titulo']),
            htmlspecialchars($_POST['descripcion']),
            $icono,
            (int)$_POST['id_madre']
        );
        $mensaje = $ok ? 'Subcategoría actualizada.' : 'Error al actualizar.';
        $tipo_mensaje = $ok ? 'exito' : 'error';
        $seccion = 'subcategorias';
    }

    if ($accion === 'eliminar_subcategoria') {
        $ok = $admin->eliminarSubcategoria((int)$_POST['id_subcategoria']);
        $mensaje = $ok ? 'Subcategoría eliminada.' : 'Error al eliminar.';
        $tipo_mensaje = $ok ? 'exito' : 'error';
        $seccion = 'subcategorias';
    }

    // ── BLOQUES ──────────────────────────────────────────────────────────────
    if ($accion === 'crear_bloque') {
        $icono = subirIcono('icono_archivo');
        $ok = $admin->crearBloque(
            htmlspecialchars($_POST['titulo']),
            htmlspecialchars($_POST['subtitulo']),
            htmlspecialchars($_POST['contenido']),
            (int)$_POST['orden'],
            (int)$_POST['id_categoria'],
            $icono
        );
        $mensaje = $ok ? 'Bloque creado.' : 'Error al crear el bloque.';
        $tipo_mensaje = $ok ? 'exito' : 'error';
        $seccion = 'bloques';
    }

    if ($accion === 'editar_bloque') {
        $icono = subirIcono('icono_archivo', htmlspecialchars($_POST['icono_actual'] ?? ''));
        $ok = $admin->editarBloque(
            (int)$_POST['id_bloque'],
            htmlspecialchars($_POST['titulo']),
            htmlspecialchars($_POST['subtitulo']),
            htmlspecialchars($_POST['contenido']),
            (int)$_POST['orden'],
            (int)$_POST['id_categoria'],
            $icono
        );
        $mensaje = $ok ? 'Bloque actualizado.' : 'Error al actualizar.';
        $tipo_mensaje = $ok ? 'exito' : 'error';
        $seccion = 'bloques';
    }

    if ($accion === 'eliminar_bloque') {
        $ok = $admin->eliminarBloque((int)$_POST['id_bloque']);
        $mensaje = $ok ? 'Bloque eliminado.' : 'Error al eliminar.';
        $tipo_mensaje = $ok ? 'exito' : 'error';
        $seccion = 'bloques';
    }

    // ── FAQs ─────────────────────────────────────────────────────────────────
    if ($accion === 'crear_faq') {
        $ok = $admin->crearFaq(
            htmlspecialchars($_POST['pregunta']),
            htmlspecialchars($_POST['respuesta']),
            (int)$_POST['id_categoria']
        );
        $mensaje = $ok ? 'FAQ creada.' : 'Error al crear la FAQ.';
        $tipo_mensaje = $ok ? 'exito' : 'error';
        $seccion = 'faqs';
    }

    if ($accion === 'editar_faq') {
        $ok = $admin->editarFaq(
            (int)$_POST['id_faq'],
            htmlspecialchars($_POST['pregunta']),
            htmlspecialchars($_POST['respuesta']),
            (int)$_POST['id_categoria']
        );
        $mensaje = $ok ? 'FAQ actualizada.' : 'Error al actualizar.';
        $tipo_mensaje = $ok ? 'exito' : 'error';
        $seccion = 'faqs';
    }

    if ($accion === 'eliminar_faq') {
        $ok = $admin->eliminarFaq((int)$_POST['id_faq']);
        $mensaje = $ok ? 'FAQ eliminada.' : 'Error al eliminar.';
        $tipo_mensaje = $ok ? 'exito' : 'error';
        $seccion = 'faqs';
    }

    // Redirigir para evitar reenvío de formulario (PRG pattern)
    $redir = 'gestion_admin.php?seccion=' . $seccion;
    if ($mensaje) {
        $redir .= '&msg=' . urlencode($mensaje) . '&tipo=' . $tipo_mensaje;
    }
    header('Location: ' . $redir);
    exit;
}

// ── Mensajes desde redirección GET ───────────────────────────────────────────
if (isset($_GET['msg'])) {
    $mensaje = htmlspecialchars($_GET['msg']);
    $tipo_mensaje = $_GET['tipo'] ?? 'exito';
}

// ── Cargar datos según sección activa ────────────────────────────────────────
$usuarios       = ($seccion === 'usuarios')       ? $admin->listarUsuarios()       : [];
$categorias     = ($seccion === 'categorias')     ? $admin->listarCategorias()     : [];
$subcategorias  = ($seccion === 'subcategorias')  ? $admin->listarSubcategorias()  : [];
$bloques        = ($seccion === 'bloques')        ? $admin->listarBloques()        : [];
$faqs           = ($seccion === 'faqs')           ? $admin->listarFaqs()           : [];

// Para selects de categorías madre en subcats y bloques (siempre las necesitamos)
$todas_categorias    = $admin->listarCategorias();
$todas_subcategorias = $admin->listarSubcategorias();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración — Médicos del Mundo</title>
    <link rel="stylesheet" href="estilos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <meta charset="UTF-8">
</head>
<body>

<div class="layout">

    <!-- ═══════════════════════════════════════════════════════
         SIDEBAR IZQUIERDO
    ═══════════════════════════════════════════════════════ -->
    <aside class="sidebar">
    <div class="sidebar-logo">
        <img src="img/logomorado.png" alt="Logo" class="sidebar-logo-img" onerror="this.style.display='none'">
        <span class="sidebar-logo-texto">Gestión Admin</span>
    </div>

    <nav class="sidebar-nav">
        <a href="?seccion=usuarios"
           class="nav-item <?php echo ($seccion === 'usuarios') ? 'activo' : ''; ?>">
            <i class="fa-solid fa-users nav-icono"></i>
            <span>Usuarios</span>
        </a>
        <a href="?seccion=categorias"
           class="nav-item <?php echo ($seccion === 'categorias') ? 'activo' : ''; ?>">
            <i class="fa-solid fa-layer-group nav-icono"></i>
            <span>Categorías</span>
        </a>
        <a href="?seccion=subcategorias"
           class="nav-item <?php echo ($seccion === 'subcategorias') ? 'activo' : ''; ?>">
            <i class="fa-solid fa-tags nav-icono"></i>
            <span>Subcategorías</span>
        </a>
        <a href="?seccion=bloques"
           class="nav-item <?php echo ($seccion === 'bloques') ? 'activo' : ''; ?>">
            <i class="fa-solid fa-cubes nav-icono"></i>
            <span>Bloques</span>
        </a>
        <a href="?seccion=faqs"
           class="nav-item <?php echo ($seccion === 'faqs') ? 'activo' : ''; ?>">
            <i class="fa-solid fa-circle-question nav-icono"></i>
            <span>FAQs</span>
        </a>
    </nav>

    <div class="sidebar-footer">
        <a href="index.php" class="nav-item">
            <i class="fa-solid fa-house nav-icono"></i>
            <span>Volver al inicio</span>
        </a>
    </div>
</aside>
    <!-- ═══════════════════════════════════════════════════════
         CONTENIDO PRINCIPAL
    ═══════════════════════════════════════════════════════ -->
    <main class="main">

        <!-- Mensaje de feedback -->
        <?php if ($mensaje): ?>
            <div class="alerta alerta-<?php echo $tipo_mensaje; ?>">
                <?php echo $mensaje; ?>
            </div>
        <?php endif; ?>


        <!-- ══════════════════════════════════════════
             SECCIÓN: USUARIOS
        ══════════════════════════════════════════ -->
        <?php if ($seccion === 'usuarios'): ?>

        <div class="seccion-cabecera">
            <div>
                <h1 class="seccion-titulo">Usuarios</h1>
                <p class="seccion-sub">Gestión de cuentas registradas</p>
            </div>
            <button class="btn-primario" onclick="abrirModal('modal-crear-usuario')">+ Nuevo usuario</button>
        </div>

        <div class="tabla-contenedor">
            <table class="tabla">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($usuarios)): ?>
                        <tr><td colspan="5" class="tabla-vacia">No hay usuarios registrados.</td></tr>
                    <?php else: ?>
                        <?php foreach ($usuarios as $u): ?>
                        <tr>
                            <td><?php echo (int)$u['id_usuario']; ?></td>
                            <td>
                                <span class="avatar"><?php echo strtoupper(substr($u['nombre'], 0, 2)); ?></span>
                                <?php echo htmlspecialchars($u['nombre']); ?>
                            </td>
                            <td><?php echo htmlspecialchars($u['email']); ?></td>
                            <td>
                                <span class="badge <?php echo ((int)$u['id_rol'] === 1) ? 'badge-lila' : 'badge-gris'; ?>">
                                    <?php echo ((int)$u['id_rol'] === 1) ? 'Admin' : 'Usuario'; ?>
                                </span>
                            </td>
                            <td class="acciones">
                                <button class="btn-icono btn-editar"
                                    onclick="abrirEditar('modal-editar-usuario', {
                                        id_usuario: '<?php echo (int)$u['id_usuario']; ?>',
                                        nombre:     '<?php echo htmlspecialchars($u['nombre'], ENT_QUOTES); ?>',
                                        email:      '<?php echo htmlspecialchars($u['email'], ENT_QUOTES); ?>',
                                        id_rol:     '<?php echo (int)$u['id_rol']; ?>'
                                    })">Editar</button>
                                <button class="btn-icono btn-eliminar"
                                    onclick="confirmarEliminar('form-del-usuario', '<?php echo (int)$u['id_usuario']; ?>', '<?php echo htmlspecialchars($u['nombre'], ENT_QUOTES); ?>')">
                                    Eliminar</button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Modal crear usuario -->
        <div class="modal-fondo" id="modal-crear-usuario">
            <div class="modal">
                <div class="modal-cabecera">
                    <h2>Nuevo usuario</h2>
                    <button class="modal-cerrar" onclick="cerrarModal('modal-crear-usuario')">✕</button>
                </div>
                <form method="POST" action="gestion_admin.php">
                    <input type="hidden" name="accion" value="crear_usuario">
                    <div class="campo">
                        <label for="cu-nombre">Nombre</label>
                        <input type="text" id="cu-nombre" name="nombre" required>
                    </div>
                    <div class="campo">
                        <label for="cu-email">Email</label>
                        <input type="email" id="cu-email" name="email" required>
                    </div>
                    <div class="campo">
                        <label for="cu-pass">Contraseña</label>
                        <input type="password" id="cu-pass" name="password" required>
                    </div>
                    <div class="campo">
                        <label for="cu-rol">Rol</label>
                        <select id="cu-rol" name="id_rol">
                            <option value="1">Admin</option>
                            <option value="2" selected>Usuario</option>
                        </select>
                    </div>
                    <div class="modal-botones">
                        <button type="button" class="btn-secundario" onclick="cerrarModal('modal-crear-usuario')">Cancelar</button>
                        <button type="submit" class="btn-primario">Guardar</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal editar usuario -->
        <div class="modal-fondo" id="modal-editar-usuario">
            <div class="modal">
                <div class="modal-cabecera">
                    <h2>Editar usuario</h2>
                    <button class="modal-cerrar" onclick="cerrarModal('modal-editar-usuario')">✕</button>
                </div>
                <form method="POST" action="gestion_admin.php">
                    <input type="hidden" name="accion" value="editar_usuario">
                    <input type="hidden" name="id_usuario" id="eu-id">
                    <div class="campo">
                        <label for="eu-nombre">Nombre</label>
                        <input type="text" id="eu-nombre" name="nombre" required>
                    </div>
                    <div class="campo">
                        <label for="eu-email">Email</label>
                        <input type="email" id="eu-email" name="email" required>
                    </div>
                    <div class="campo">
                        <label for="eu-rol">Rol</label>
                        <select id="eu-rol" name="id_rol">
                            <option value="1">Admin</option>
                            <option value="2">Usuario</option>
                        </select>
                    </div>
                    <div class="modal-botones">
                        <button type="button" class="btn-secundario" onclick="cerrarModal('modal-editar-usuario')">Cancelar</button>
                        <button type="submit" class="btn-primario">Guardar cambios</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Form oculto eliminar usuario -->
        <form method="POST" action="gestion_admin.php" id="form-del-usuario" style="display:none">
            <input type="hidden" name="accion" value="eliminar_usuario">
            <input type="hidden" name="id_usuario" id="del-usuario-id">
        </form>


        <!-- ══════════════════════════════════════════
             SECCIÓN: CATEGORÍAS
        ══════════════════════════════════════════ -->
        <?php elseif ($seccion === 'categorias'): ?>

        <div class="seccion-cabecera">
            <div>
                <h1 class="seccion-titulo">Categorías</h1>
                <p class="seccion-sub">Organización principal del catálogo</p>
            </div>
            <button class="btn-primario" onclick="abrirModal('modal-crear-cat')">+ Nueva categoría</button>
        </div>

        <div class="tabla-contenedor">
            <table class="tabla">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Título</th>
                        <th>Descripción</th>
                        <th>Icono</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($categorias)): ?>
                        <tr><td colspan="5" class="tabla-vacia">No hay categorías.</td></tr>
                    <?php else: ?>
                        <?php foreach ($categorias as $c): ?>
                        <tr>
                            <td><?php echo (int)$c['id_categoria']; ?></td>
                            <td><?php echo htmlspecialchars($c['titulo']); ?></td>
                            <td class="celda-descripcion"><?php echo htmlspecialchars($c['descripcion'] ?? '—'); ?></td>
                            <td><?php echo htmlspecialchars($c['icono'] ?? '—'); ?></td>
                            <td class="acciones">
                                <button class="btn-icono btn-editar"
                                    onclick="abrirEditar('modal-editar-cat', {
                                        id_categoria: '<?php echo (int)$c['id_categoria']; ?>',
                                        titulo:       '<?php echo htmlspecialchars($c['titulo'], ENT_QUOTES); ?>',
                                        descripcion:  '<?php echo htmlspecialchars($c['descripcion'] ?? '', ENT_QUOTES); ?>',
                                        icono:        '<?php echo htmlspecialchars($c['icono'] ?? '', ENT_QUOTES); ?>'
                                    })">Editar</button>
                                <button class="btn-icono btn-eliminar"
                                    onclick="confirmarEliminar('form-del-cat', '<?php echo (int)$c['id_categoria']; ?>', '<?php echo htmlspecialchars($c['titulo'], ENT_QUOTES); ?>')">
                                    Eliminar</button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Modal crear categoría -->
        <div class="modal-fondo" id="modal-crear-cat">
            <div class="modal">
                <div class="modal-cabecera">
                    <h2>Nueva categoría</h2>
                    <button class="modal-cerrar" onclick="cerrarModal('modal-crear-cat')">✕</button>
                </div>
                <form method="POST" action="gestion_admin.php" enctype="multipart/form-data">
                    <input type="hidden" name="accion" value="crear_categoria">
                    <div class="campo">
                        <label for="cc-titulo">Título</label>
                        <input type="text" id="cc-titulo" name="titulo" required>
                    </div>
                    <div class="campo">
                        <label for="cc-desc">Descripción</label>
                        <textarea id="cc-desc" name="descripcion" rows="3"></textarea>
                    </div>
                    <div class="campo">
                        <label>Imagen / Icono</label>
                        <input type="file" name="icono_archivo" accept="image/png,image/jpeg,image/gif,image/webp,image/svg+xml" onchange="previsualizarImagen(this,'prev-cc-icono')">
                        <img id="prev-cc-icono" src="" alt="" style="display:none;margin-top:8px;max-height:80px;border-radius:6px;">
                    </div>
                    <div class="modal-botones">
                        <button type="button" class="btn-secundario" onclick="cerrarModal('modal-crear-cat')">Cancelar</button>
                        <button type="submit" class="btn-primario">Guardar</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal editar categoría -->
        <div class="modal-fondo" id="modal-editar-cat">
            <div class="modal">
                <div class="modal-cabecera">
                    <h2>Editar categoría</h2>
                    <button class="modal-cerrar" onclick="cerrarModal('modal-editar-cat')">✕</button>
                </div>
                <form method="POST" action="gestion_admin.php" enctype="multipart/form-data">
                    <input type="hidden" name="accion" value="editar_categoria">
                    <input type="hidden" name="id_categoria" id="ec-id">
                    <input type="hidden" name="icono_actual" id="ec-icono-actual">
                    <div class="campo">
                        <label for="ec-titulo">Título</label>
                        <input type="text" id="ec-titulo" name="titulo" required>
                    </div>
                    <div class="campo">
                        <label for="ec-desc">Descripción</label>
                        <textarea id="ec-desc" name="descripcion" rows="3"></textarea>
                    </div>
                    <div class="campo">
                        <label>Imagen / Icono actual</label>
                        <img id="prev-ec-icono" src="" alt="" style="display:none;max-height:80px;border-radius:6px;margin-bottom:6px;">
                        <input type="file" name="icono_archivo" accept="image/png,image/jpeg,image/gif,image/webp,image/svg+xml" onchange="previsualizarImagen(this,'prev-ec-icono')">
                        <small style="color:#888">Deja vacío para mantener la imagen actual</small>
                    </div>
                    <div class="modal-botones">
                        <button type="button" class="btn-secundario" onclick="cerrarModal('modal-editar-cat')">Cancelar</button>
                        <button type="submit" class="btn-primario">Guardar cambios</button>
                    </div>
                </form>
            </div>
        </div>

        <form method="POST" action="gestion_admin.php" id="form-del-cat" style="display:none">
            <input type="hidden" name="accion" value="eliminar_categoria">
            <input type="hidden" name="id_categoria" id="del-cat-id">
        </form>


        <!-- ══════════════════════════════════════════
             SECCIÓN: SUBCATEGORÍAS
        ══════════════════════════════════════════ -->
        <?php elseif ($seccion === 'subcategorias'): ?>

        <div class="seccion-cabecera">
            <div>
                <h1 class="seccion-titulo">Subcategorías</h1>
                <p class="seccion-sub">Subdivisiones dentro de cada categoría</p>
            </div>
            <button class="btn-primario" onclick="abrirModal('modal-crear-subcat')">+ Nueva subcategoría</button>
        </div>

        <div class="tabla-contenedor">
            <table class="tabla">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Título</th>
                        <th>Categoría madre</th>
                        <th>Icono</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($subcategorias)): ?>
                        <tr><td colspan="5" class="tabla-vacia">No hay subcategorías.</td></tr>
                    <?php else: ?>
                        <?php foreach ($subcategorias as $s): ?>
                        <tr>
                            <td><?php echo (int)$s['id_categoria']; ?></td>
                            <td><?php echo htmlspecialchars($s['titulo']); ?></td>
                            <td><span class="badge badge-lila"><?php echo htmlspecialchars($s['titulo_madre'] ?? '—'); ?></span></td>
                            <td><?php echo htmlspecialchars($s['icono'] ?? '—'); ?></td>
                            <td class="acciones">
                                <button class="btn-icono btn-editar"
                                    onclick="abrirEditar('modal-editar-subcat', {
                                        id_subcategoria: '<?php echo (int)$s['id_categoria']; ?>',
                                        titulo:          '<?php echo htmlspecialchars($s['titulo'], ENT_QUOTES); ?>',
                                        descripcion:     '<?php echo htmlspecialchars($s['descripcion'] ?? '', ENT_QUOTES); ?>',
                                        icono:           '<?php echo htmlspecialchars($s['icono'] ?? '', ENT_QUOTES); ?>',
                                        id_madre:        '<?php echo (int)$s['id_madre']; ?>'
                                    })">Editar</button>
                                <button class="btn-icono btn-eliminar"
                                    onclick="confirmarEliminar('form-del-subcat', '<?php echo (int)$s['id_categoria']; ?>', '<?php echo htmlspecialchars($s['titulo'], ENT_QUOTES); ?>')">
                                    Eliminar</button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Modal crear subcategoría -->
        <div class="modal-fondo" id="modal-crear-subcat">
            <div class="modal">
                <div class="modal-cabecera">
                    <h2>Nueva subcategoría</h2>
                    <button class="modal-cerrar" onclick="cerrarModal('modal-crear-subcat')">✕</button>
                </div>
                <form method="POST" action="gestion_admin.php" enctype="multipart/form-data">
                    <input type="hidden" name="accion" value="crear_subcategoria">
                    <div class="campo">
                        <label for="cs-titulo">Título</label>
                        <input type="text" id="cs-titulo" name="titulo" required>
                    </div>
                    <div class="campo">
                        <label for="cs-desc">Descripción</label>
                        <textarea id="cs-desc" name="descripcion" rows="3"></textarea>
                    </div>
                    <div class="campo">
                        <label>Imagen / Icono</label>
                        <input type="file" name="icono_archivo" accept="image/png,image/jpeg,image/gif,image/webp,image/svg+xml" onchange="previsualizarImagen(this,'prev-cs-icono')">
                        <img id="prev-cs-icono" src="" alt="" style="display:none;margin-top:8px;max-height:80px;border-radius:6px;">
                    </div>
                    <div class="campo">
                        <label for="cs-madre">Categoría madre</label>
                        <select id="cs-madre" name="id_madre" required>
                            <option value="">-- Selecciona --</option>
                            <?php foreach ($todas_categorias as $tc): ?>
                                <option value="<?php echo (int)$tc['id_categoria']; ?>">
                                    <?php echo htmlspecialchars($tc['titulo']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="modal-botones">
                        <button type="button" class="btn-secundario" onclick="cerrarModal('modal-crear-subcat')">Cancelar</button>
                        <button type="submit" class="btn-primario">Guardar</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal editar subcategoría -->
        <div class="modal-fondo" id="modal-editar-subcat">
            <div class="modal">
                <div class="modal-cabecera">
                    <h2>Editar subcategoría</h2>
                    <button class="modal-cerrar" onclick="cerrarModal('modal-editar-subcat')">✕</button>
                </div>
                <form method="POST" action="gestion_admin.php" enctype="multipart/form-data">
                    <input type="hidden" name="accion" value="editar_subcategoria">
                    <input type="hidden" name="id_subcategoria" id="es-id">
                    <input type="hidden" name="icono_actual" id="es-icono-actual">
                    <div class="campo">
                        <label for="es-titulo">Título</label>
                        <input type="text" id="es-titulo" name="titulo" required>
                    </div>
                    <div class="campo">
                        <label for="es-desc">Descripción</label>
                        <textarea id="es-desc" name="descripcion" rows="3"></textarea>
                    </div>
                    <div class="campo">
                        <label>Imagen / Icono actual</label>
                        <img id="prev-es-icono" src="" alt="" style="display:none;max-height:80px;border-radius:6px;margin-bottom:6px;">
                        <input type="file" name="icono_archivo" accept="image/png,image/jpeg,image/gif,image/webp,image/svg+xml" onchange="previsualizarImagen(this,'prev-es-icono')">
                        <small style="color:#888">Deja vacío para mantener la imagen actual</small>
                    </div>
                    <div class="campo">
                        <label for="es-madre">Categoría madre</label>
                        <select id="es-madre" name="id_madre" required>
                            <option value="">-- Selecciona --</option>
                            <?php foreach ($todas_categorias as $tc): ?>
                                <option value="<?php echo (int)$tc['id_categoria']; ?>">
                                    <?php echo htmlspecialchars($tc['titulo']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="modal-botones">
                        <button type="button" class="btn-secundario" onclick="cerrarModal('modal-editar-subcat')">Cancelar</button>
                        <button type="submit" class="btn-primario">Guardar cambios</button>
                    </div>
                </form>
            </div>
        </div>

        <form method="POST" action="gestion_admin.php" id="form-del-subcat" style="display:none">
            <input type="hidden" name="accion" value="eliminar_subcategoria">
            <input type="hidden" name="id_subcategoria" id="del-subcat-id">
        </form>


        <!-- ══════════════════════════════════════════
             SECCIÓN: BLOQUES
        ══════════════════════════════════════════ -->
        <?php elseif ($seccion === 'bloques'): ?>

        <div class="seccion-cabecera">
            <div>
                <h1 class="seccion-titulo">Bloques</h1>
                <p class="seccion-sub">Secciones de contenido asociadas a categorías</p>
            </div>
            <button class="btn-primario" onclick="abrirModal('modal-crear-bloque')">+ Nuevo bloque</button>
        </div>

        <div class="tabla-contenedor">
            <table class="tabla">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Título</th>
                        <th>Subtítulo</th>
                        <th>Orden</th>
                        <th>Categoría</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($bloques)): ?>
                        <tr><td colspan="6" class="tabla-vacia">No hay bloques.</td></tr>
                    <?php else: ?>
                        <?php foreach ($bloques as $b): ?>
                        <tr>
                            <td><?php echo (int)$b['id_bloque']; ?></td>
                            <td><?php echo htmlspecialchars($b['titulo']); ?></td>
                            <td class="celda-descripcion"><?php echo htmlspecialchars($b['subtitulo'] ?? '—'); ?></td>
                            <td><?php echo (int)$b['orden']; ?></td>
                            <td><span class="badge badge-lila"><?php echo htmlspecialchars($b['titulo_categoria'] ?? '—'); ?></span></td>
                            <td class="acciones">
                                <button class="btn-icono btn-editar"
                                    data-id="<?php echo (int)$b['id_bloque']; ?>"
                                    data-titulo="<?php echo htmlspecialchars($b['titulo'], ENT_QUOTES); ?>"
                                    data-subtitulo="<?php echo htmlspecialchars($b['subtitulo'] ?? '', ENT_QUOTES); ?>"
                                    data-contenido="<?php echo htmlspecialchars($b['contenido'] ?? '', ENT_QUOTES); ?>"
                                    data-orden="<?php echo (int)$b['orden']; ?>"
                                    data-categoria="<?php echo (int)$b['id_categoria']; ?>"
                                    data-icono="<?php echo htmlspecialchars($b['icono'] ?? '', ENT_QUOTES); ?>"
                                    onclick="abrirEditarBloque(this)">Editar</button>
                                <button class="btn-icono btn-eliminar"
                                    onclick="confirmarEliminar('form-del-bloque', '<?php echo (int)$b['id_bloque']; ?>', '<?php echo htmlspecialchars($b['titulo'], ENT_QUOTES); ?>')">
                                    Eliminar</button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Modal crear bloque -->
        <div class="modal-fondo" id="modal-crear-bloque">
            <div class="modal modal-ancho">
                <div class="modal-cabecera">
                    <h2>Nuevo bloque</h2>
                    <button class="modal-cerrar" onclick="cerrarModal('modal-crear-bloque')">✕</button>
                </div>
                <form method="POST" action="gestion_admin.php" enctype="multipart/form-data">
                    <input type="hidden" name="accion" value="crear_bloque">
                    <div class="campo-fila">
                        <div class="campo">
                            <label for="cb-titulo">Título</label>
                            <input type="text" id="cb-titulo" name="titulo" required>
                        </div>
                        <div class="campo">
                            <label for="cb-sub">Subtítulo</label>
                            <input type="text" id="cb-sub" name="subtitulo">
                        </div>
                    </div>
                    <div class="campo">
                        <label for="cb-cont">Contenido</label>
                        <textarea id="cb-cont" name="contenido" rows="4"></textarea>
                    </div>
                    <div class="campo-fila">
                        <div class="campo">
                            <label for="cb-orden">Orden</label>
                            <input type="number" id="cb-orden" name="orden" min="1" value="1">
                        </div>
                        <div class="campo">
                            <label>Imagen / Icono</label>
                            <input type="file" name="icono_archivo" accept="image/png,image/jpeg,image/gif,image/webp,image/svg+xml" onchange="previsualizarImagen(this,'prev-cb-icono')">
                            <img id="prev-cb-icono" src="" alt="" style="display:none;margin-top:6px;max-height:60px;border-radius:6px;">
                        </div>
                    </div>
                    <div class="campo">
                        <label for="cb-cat">Categoría / Subcategoría</label>
                        <select id="cb-cat" name="id_categoria" required>
                            <option value="">-- Selecciona --</option>
                            <?php if (!empty($todas_categorias)): ?>
                                <optgroup label="── Categorías ──">
                                <?php foreach ($todas_categorias as $tc): ?>
                                    <option value="<?php echo (int)$tc['id_categoria']; ?>">
                                        <?php echo htmlspecialchars($tc['titulo']); ?>
                                    </option>
                                <?php endforeach; ?>
                                </optgroup>
                            <?php endif; ?>
                            <?php if (!empty($todas_subcategorias)): ?>
                                <optgroup label="── Subcategorías ──">
                                <?php foreach ($todas_subcategorias as $ts): ?>
                                    <option value="<?php echo (int)$ts['id_categoria']; ?>">
                                        <?php echo htmlspecialchars($ts['titulo']); ?>
                                    </option>
                                <?php endforeach; ?>
                                </optgroup>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div class="modal-botones">
                        <button type="button" class="btn-secundario" onclick="cerrarModal('modal-crear-bloque')">Cancelar</button>
                        <button type="submit" class="btn-primario">Guardar</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal editar bloque -->
        <div class="modal-fondo" id="modal-editar-bloque">
            <div class="modal modal-ancho">
                <div class="modal-cabecera">
                    <h2>Editar bloque</h2>
                    <button class="modal-cerrar" onclick="cerrarModal('modal-editar-bloque')">✕</button>
                </div>
                <form method="POST" action="gestion_admin.php" enctype="multipart/form-data">
                    <input type="hidden" name="accion" value="editar_bloque">
                    <input type="hidden" name="id_bloque" id="eb-id">
                    <input type="hidden" name="icono_actual" id="eb-icono-actual">
                    <div class="campo-fila">
                        <div class="campo">
                            <label for="eb-titulo">Título</label>
                            <input type="text" id="eb-titulo" name="titulo" required>
                        </div>
                        <div class="campo">
                            <label for="eb-sub">Subtítulo</label>
                            <input type="text" id="eb-sub" name="subtitulo">
                        </div>
                    </div>
                    <div class="campo">
                        <label for="eb-cont">Contenido</label>
                        <textarea id="eb-cont" name="contenido" rows="4"></textarea>
                    </div>
                    <div class="campo-fila">
                        <div class="campo">
                            <label for="eb-orden">Orden</label>
                            <input type="number" id="eb-orden" name="orden" min="1">
                        </div>
                        <div class="campo">
                            <label>Imagen / Icono actual</label>
                            <img id="prev-eb-icono" src="" alt="" style="display:none;max-height:60px;border-radius:6px;margin-bottom:4px;">
                            <input type="file" name="icono_archivo" accept="image/png,image/jpeg,image/gif,image/webp,image/svg+xml" onchange="previsualizarImagen(this,'prev-eb-icono')">
                            <small style="color:#888">Deja vacío para mantener la actual</small>
                        </div>
                    </div>
                    <div class="campo">
                        <label for="eb-cat">Categoría / Subcategoría</label>
                        <select id="eb-cat" name="id_categoria" required>
                            <option value="">-- Selecciona --</option>
                            <?php if (!empty($todas_categorias)): ?>
                                <optgroup label="── Categorías ──">
                                <?php foreach ($todas_categorias as $tc): ?>
                                    <option value="<?php echo (int)$tc['id_categoria']; ?>">
                                        <?php echo htmlspecialchars($tc['titulo']); ?>
                                    </option>
                                <?php endforeach; ?>
                                </optgroup>
                            <?php endif; ?>
                            <?php if (!empty($todas_subcategorias)): ?>
                                <optgroup label="── Subcategorías ──">
                                <?php foreach ($todas_subcategorias as $ts): ?>
                                    <option value="<?php echo (int)$ts['id_categoria']; ?>">
                                        <?php echo htmlspecialchars($ts['titulo']); ?>
                                    </option>
                                <?php endforeach; ?>
                                </optgroup>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div class="modal-botones">
                        <button type="button" class="btn-secundario" onclick="cerrarModal('modal-editar-bloque')">Cancelar</button>
                        <button type="submit" class="btn-primario">Guardar cambios</button>
                    </div>
                </form>
            </div>
        </div>

        <form method="POST" action="gestion_admin.php" id="form-del-bloque" style="display:none">
            <input type="hidden" name="accion" value="eliminar_bloque">
            <input type="hidden" name="id_bloque" id="del-bloque-id">
        </form>


        <!-- ══════════════════════════════════════════
             SECCIÓN: FAQs
        ══════════════════════════════════════════ -->
        <?php elseif ($seccion === 'faqs'): ?>

        <div class="seccion-cabecera">
            <div>
                <h1 class="seccion-titulo">FAQs</h1>
                <p class="seccion-sub">Preguntas frecuentes del sitio</p>
            </div>
            <button class="btn-primario" onclick="abrirModal('modal-crear-faq')">+ Nueva FAQ</button>
        </div>

        <div class="tabla-contenedor">
            <table class="tabla">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Pregunta</th>
                        <th>Respuesta</th>
                        <th>Categoría</th>
                        <th>Actualización</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($faqs)): ?>
                        <tr><td colspan="6" class="tabla-vacia">No hay FAQs.</td></tr>
                    <?php else: ?>
                        <?php foreach ($faqs as $f): ?>
                        <tr>
                            <td><?php echo (int)$f['id_faq']; ?></td>
                            <td class="celda-descripcion"><?php echo htmlspecialchars($f['pregunta']); ?></td>
                            <td class="celda-descripcion"><?php echo htmlspecialchars($f['respuesta']); ?></td>
                            <td><span class="badge badge-lila"><?php echo htmlspecialchars($f['titulo_categoria'] ?? '—'); ?></span></td>
                            <td><?php echo htmlspecialchars($f['fecha_actualizacion'] ?? '—'); ?></td>
                            <td class="acciones">
                                <button class="btn-icono btn-editar"
                                    onclick="abrirEditar('modal-editar-faq', {
                                        id_faq:       '<?php echo (int)$f['id_faq']; ?>',
                                        pregunta:     '<?php echo htmlspecialchars($f['pregunta'], ENT_QUOTES); ?>',
                                        respuesta:    '<?php echo htmlspecialchars($f['respuesta'], ENT_QUOTES); ?>',
                                        id_categoria: '<?php echo (int)$f['id_categoria']; ?>'
                                    })">Editar</button>
                                <button class="btn-icono btn-eliminar"
                                    onclick="confirmarEliminar('form-del-faq', '<?php echo (int)$f['id_faq']; ?>', 'esta FAQ')">
                                    Eliminar</button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Modal crear FAQ -->
        <div class="modal-fondo" id="modal-crear-faq">
            <div class="modal modal-ancho">
                <div class="modal-cabecera">
                    <h2>Nueva FAQ</h2>
                    <button class="modal-cerrar" onclick="cerrarModal('modal-crear-faq')">✕</button>
                </div>
                <form method="POST" action="gestion_admin.php">
                    <input type="hidden" name="accion" value="crear_faq">
                    <div class="campo">
                        <label for="cf-preg">Pregunta</label>
                        <input type="text" id="cf-preg" name="pregunta" required>
                    </div>
                    <div class="campo">
                        <label for="cf-resp">Respuesta</label>
                        <textarea id="cf-resp" name="respuesta" rows="4" required></textarea>
                    </div>
                    <div class="campo">
                        <label for="cf-cat">Categoría</label>
                        <select id="cf-cat" name="id_categoria" required>
                            <option value="">-- Selecciona --</option>
                            <?php foreach ($todas_categorias as $tc): ?>
                                <option value="<?php echo (int)$tc['id_categoria']; ?>">
                                    <?php echo htmlspecialchars($tc['titulo']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="modal-botones">
                        <button type="button" class="btn-secundario" onclick="cerrarModal('modal-crear-faq')">Cancelar</button>
                        <button type="submit" class="btn-primario">Guardar</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal editar FAQ -->
        <div class="modal-fondo" id="modal-editar-faq">
            <div class="modal modal-ancho">
                <div class="modal-cabecera">
                    <h2>Editar FAQ</h2>
                    <button class="modal-cerrar" onclick="cerrarModal('modal-editar-faq')">✕</button>
                </div>
                <form method="POST" action="gestion_admin.php">
                    <input type="hidden" name="accion" value="editar_faq">
                    <input type="hidden" name="id_faq" id="ef-id">
                    <div class="campo">
                        <label for="ef-preg">Pregunta</label>
                        <input type="text" id="ef-preg" name="pregunta" required>
                    </div>
                    <div class="campo">
                        <label for="ef-resp">Respuesta</label>
                        <textarea id="ef-resp" name="respuesta" rows="4" required></textarea>
                    </div>
                    <div class="campo">
                        <label for="ef-cat">Categoría</label>
                        <select id="ef-cat" name="id_categoria" required>
                            <option value="">-- Selecciona --</option>
                            <?php foreach ($todas_categorias as $tc): ?>
                                <option value="<?php echo (int)$tc['id_categoria']; ?>">
                                    <?php echo htmlspecialchars($tc['titulo']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="modal-botones">
                        <button type="button" class="btn-secundario" onclick="cerrarModal('modal-editar-faq')">Cancelar</button>
                        <button type="submit" class="btn-primario">Guardar cambios</button>
                    </div>
                </form>
            </div>
        </div>

        <form method="POST" action="gestion_admin.php" id="form-del-faq" style="display:none">
            <input type="hidden" name="accion" value="eliminar_faq">
            <input type="hidden" name="id_faq" id="del-faq-id">
        </form>

        <?php endif; ?>

    </main>

</div>

<!-- ══════════════════════════════════════════
     MODAL DE CONFIRMACIÓN DE ELIMINACIÓN (global)
══════════════════════════════════════════ -->
<div class="modal-fondo" id="modal-confirmar-eliminar">
    <div class="modal modal-pequeño">
        <div class="modal-cabecera">
            <h2>Confirmar eliminación</h2>
            <button class="modal-cerrar" onclick="cerrarModal('modal-confirmar-eliminar')">✕</button>
        </div>
        <p class="modal-aviso">¿Seguro que quieres eliminar <strong id="del-nombre-label"></strong>? Esta acción no se puede deshacer.</p>
        <div class="modal-botones">
            <button type="button" class="btn-secundario" onclick="cerrarModal('modal-confirmar-eliminar')">Cancelar</button>
            <button type="button" class="btn-peligro" id="btn-confirmar-del">Eliminar</button>
        </div>
    </div>
</div>

<script src="gestion_admin.js"></script>
</body>
</html>