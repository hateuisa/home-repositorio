<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salud y Seguridad - Médicos del Mundo</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <?php include 'header.php'?>

    <header class="apple-header">
        <h1 class="apple-header-titulo">Salud y Bienestar Laboral</h1>
        <nav class="apple-nav">
            <a href="#prevencion" class="apple-pildora">Prevención</a>
            <a href="#proteccion" class="apple-pildora">Protección</a>
            <a href="#descanso-mental" class="apple-pildora">Salud Mental</a>
        </nav>
    </header>

    <main class="apple-main">

        <section id="prevencion" class="apple-seccion apple-seccion--normal">
            <figure class="apple-imagen">
                <img src="https://images.pexels.com/photos/3184338/pexels-photo-3184338.jpeg?auto=compress&cs=tinysrgb&w=800" alt="Mujer profesional trabajando con seguridad">
            </figure>
            <article class="apple-texto">
                <h2 class="apple-texto-titulo">Entorno Seguro</h2>
                <div class="apple-texto-subtitulo">
                    <p>Tienes derecho a trabajar en un ambiente que no ponga en riesgo tu integridad física ni mental. La empresa debe evaluar los riesgos de tu puesto.</p>
                    <ul>
                        <li><strong>Formación:</strong> Deben enseñarte a usar las herramientas y a moverte de forma segura.</li>
                        <li><strong>Higiene:</strong> El lugar de trabajo debe cumplir con normas estrictas de limpieza e iluminación.</li>
                    </ul>
                </div>
            </article>
        </section>

        <section id="proteccion" class="apple-seccion apple-seccion--invertida">
            <figure class="apple-imagen">
                <img src="https://images.pexels.com/photos/3184360/pexels-photo-3184360.jpeg?auto=compress&cs=tinysrgb&w=800" alt="Mujer profesional revisando seguridad">
            </figure>
            <article class="apple-texto">
                <h2 class="apple-texto-titulo">Equipos de Protección</h2>
                <div class="apple-texto-subtitulo">
                    <p>Si tu trabajo conlleva riesgos (químicos, físicos o biológicos), la empresa está obligada a darte los Equipos de Protección Individual (EPI) necesarios de forma gratuita.</p>
                    <p>Es tu derecho recibirlos y tu obligación utilizarlos correctamente para cuidar de tu salud y la de tus compañeras.</p>
                </div>
            </article>
        </section>

        <section id="descanso-mental" class="apple-seccion apple-seccion--normal">
            <figure class="apple-imagen">
                <img src="https://images.pexels.com/photos/3184299/pexels-photo-3184299.jpeg?auto=compress&cs=tinysrgb&w=800" alt="Bienestar laboral">
            </figure>
            <article class="apple-texto">
                <h2 class="apple-texto-titulo">Salud Mental y Estrés</h2>
                <div class="apple-texto-subtitulo">
                    <p>La salud no es solo la ausencia de lesiones. Tienes derecho a que el ritmo de trabajo sea razonable y no afecte a tu estabilidad emocional.</p>
                    <p>El derecho al descanso, a las pausas y a la desconexión digital son herramientas fundamentales para evitar el agotamiento y el estrés crónico.</p>
                </div>
            </article>
        </section>

    </main>

    <?php include 'footer.php'?>
</body>
</html>