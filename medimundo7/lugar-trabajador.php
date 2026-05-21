<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lugar de trabajo - Relación Laboral</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <?php include 'header.php'?>

    <header class="apple-header">
        <h1 class="apple-header-titulo">Nuestro Espacio de Trabajo</h1>
        <nav class="apple-nav">
            <a href="#centro" class="apple-pildora">El Centro</a>
            <a href="#movilidad" class="apple-pildora">Cambios</a>
            <a href="#viajes" class="apple-pildora">Viajes</a>
            <a href="#teletrabajo" class="apple-pildora">Teletrabajo</a>
        </nav>
    </header>

    <main class="apple-main">

        <section id="centro" class="apple-seccion apple-seccion--normal">
            <figure class="apple-imagen">
                <img src="https://images.unsplash.com/photo-1497366754035-f200968a6e72?q=80&w=800&auto=format&fit=crop" alt="Espacio de trabajo ordenado">
            </figure>
            <article class="apple-texto">
                <h2 class="apple-texto-titulo">El Centro de Trabajo</h2>
                <div class="apple-texto-subtitulo">
                    <p>Es la ubicación física donde realizamos nuestras funciones a diario. Este lugar debe figurar claramente en nuestro contrato. La empresa tiene la obligación legal absoluta de garantizarnos un espacio que cumpla con todas las normativas de prevención de riesgos. Esto incluye iluminación correcta, higiene, acceso a agua potable, aseos limpios y zonas de descanso dignas.</p>
                </div>
            </article>
        </section>

        <section id="movilidad" class="apple-seccion apple-seccion--invertida">
            <figure class="apple-imagen">
                <img src="https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?q=80&w=800&auto=format&fit=crop" alt="Mujer aprendiendo una tarea nueva">
            </figure>
            <article class="apple-texto">
                <h2 class="apple-texto-titulo">¿Me pueden cambiar de tareas?</h2>
                <div class="apple-texto-subtitulo">
                    <p>A veces, la empresa no nos cambia de centro, sino de funciones (Movilidad Funcional). Esto es legal siempre que se respete nuestra dignidad y formación:</p>
                    <ul>
                        <li>Si nos piden tareas de un <strong>puesto superior</strong>, tenemos derecho a cobrar el salario de ese puesto superior mientras las hagamos.</li>
                        <li>Si nos piden tareas de un <strong>puesto inferior</strong>, solo puede ser por una urgencia justificada, temporalmente, y nunca nos pueden bajar el sueldo.</li>
                    </ul>
                </div>
            </article>
        </section>

        <section id="viajes" class="apple-seccion apple-seccion--normal">
            <figure class="apple-imagen">
                <img src="https://images.unsplash.com/photo-1542296332-2e4473faf563?q=80&w=800&auto=format&fit=crop" alt="Billetes de tren o maleta">
            </figure>
            <article class="apple-texto">
                <h2 class="apple-texto-titulo">Desplazamientos y Traslados</h2>
                <div class="apple-texto-subtitulo">
                    <p>Si la empresa nos pide viajar temporalmente, tenemos derecho a que nos paguen los gastos de transporte, alojamiento y dietas completas. Deben avisarnos con antelación.</p>
                    <p>Si el cambio es definitivo y <strong>nos obliga a mudarnos de ciudad</strong> (Traslado), la empresa debe demostrar causas graves. Si ocurre, la ley nos permite elegir: aceptar (con mudanza pagada), rechazar (cobrando indemnización y paro), o impugnar ante el juzgado.</p>
                </div>
            </article>
        </section>

        <section id="teletrabajo" class="apple-seccion apple-seccion--invertida">
            <figure class="apple-imagen">
                <img src="https://images.unsplash.com/photo-1522204523234-8729aa6e3d5f?q=80&w=800&auto=format&fit=crop" alt="Mujer trabajando desde casa">
            </figure>
            <article class="apple-texto">
                <h2 class="apple-texto-titulo">Trabajo a Distancia y Desconexión Digital</h2>
                <div class="apple-texto-subtitulo">
                    <p>El teletrabajo es una gran herramienta para la conciliación. La regla de oro es que <strong>siempre debe ser voluntario</strong> mediante acuerdo escrito. Tenemos los mismos derechos que en la oficina física, y la empresa debe darnos los equipos necesarios (ordenador, teléfono).</p>
                    <p>Además, recuerda nuestro <strong>Derecho a la Desconexión Digital</strong>: al terminar tu horario laboral, no tienes ninguna obligación de responder correos ni llamadas. Tu tiempo libre es sagrado.</p>
                </div>
            </article>
        </section>

    </main>

    <?php include 'footer.php'?>
</body>
</html>