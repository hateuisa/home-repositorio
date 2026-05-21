<?php
//Se incia la sesion y se verifica si existe un usuario logueado y si no existe sesion, inicamos una
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<header class="navegacion">
    <a href="index.php">
        <img src="img/logomorado.png" alt="Logo" class="logo">
    </a>

    <nav class="nav-principal">
        <ul class="menu-lista">
            <li class="menu-item">
                <span class="menu-link">Relación Laboral</span>
                <ul class="menu-desplegable">
                    <li><a href="conceptos-basicos.php">Conceptos Básicos</a></li>
                    <li><a href="lugar-trabajador.php">Lugar del trabajador</a></li>
                </ul>
            </li>
            <li class="menu-item">
                <span class="menu-link">Contrato Legal</span>
                <ul class="menu-desplegable">
                    <li><a href="que-es-contrato.php">¿Que es un contrato?</a></li>
                    <li><a href="que-debe-tener.php">¿Qué debe tener?</a></li>
                    <li><a href="firma-copia.php">La firma y copia</a></li>
                </ul>
            </li>
                <li class="menu-item">
    <span class="menu-link">FAQ</span>
    <ul class="menu-desplegable">
        <li><a href="faq.php?id=1">Contratos de Trabajo</a></li>
        <li><a href="faq.php?id=2">Jornada de Trabajo</a></li>
        <li><a href="faq.php?id=3">Contrato Indefinido</a></li>
        <li><a href="faq.php?id=4">Contrato Temporal</a></li>
        <li><a href="faq.php?id=5">Contrato Formativo</a></li>
        <li><a href="faq.php?id=6">Contrato Fijo Discontinuo</a></li>
    </ul>
</li>
            <li class="menu-item">
                <span class="menu-link">Derechos fundamentales</span>
                <ul class="menu-desplegable">
                    <li><a href="igualdad.php">Igualdad</a></li>
                    <li><a href="dignidad-respeto.php">Dignidad y Respeto</a></li>
                    <li><a href="salud.php">Salud</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    
    <div class="contenedor-auth">
        <?php // si existe un usuario logueado le damos la bienvenida y si no existe le mostramos el boton de login
        if (isset($_SESSION['id_usuario'])): ?>
            <span class="txt-bienvenida">
                ¡Bienvenida, <span class="txt-nombre-usuario"><?php echo htmlspecialchars($_SESSION['nombre']); ?></span>!
            </span>

            <?php //si es admin mostramos el boton de gestion y si no existe mostramos el boton de cerrar sesion
            if (isset($_SESSION['id_rol']) && $_SESSION['id_rol'] == 1): ?>
                <a href="gestion_admin.php" title="Panel de Gestión">
                    <img src="img/llave.png" alt="Gestión" class="icono-auth">
                </a>
            <?php endif; ?>

            <a href="logout.php" title="Cerrar Sesión">
                <img src="img/logout-icono.png" alt="Cerrar sesión" class="icono-auth">
            </a>

            <img src="img/usuaria.png" alt="Usuario" class="usuario">

        <?php else: ?>
            <a href="login.php">
                <img src="img/usuaria.png" alt="Usuario" class="usuario">
            </a>
        <?php endif; ?>
    </div>
</header>