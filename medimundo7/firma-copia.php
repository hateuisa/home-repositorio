<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Firma y la Copia - Médicos del Mundo</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <?php include 'header.php'?>

    <header class="apple-header">
        <h1 class="apple-header-titulo">La Firma y tu Copia</h1>
        <nav class="apple-nav">
            <a href="#firma" class="apple-pildora">El momento de firmar</a>
            <a href="#copia" class="apple-pildora">Tu ejemplar</a>
        </nav>
    </header>

    <main class="apple-main">

        <section id="firma" class="apple-seccion apple-seccion--normal">
            <figure class="apple-imagen">
                <img src="https://images.pexels.com/photos/1181622/pexels-photo-1181622.jpeg?auto=compress&cs=tinysrgb&w=800" alt="Mujer profesional leyendo detenidamente antes de firmar">
            </figure>
            <article class="apple-texto">
                <h2 class="apple-texto-titulo">Antes de firmar</h2>
                <div class="apple-texto-subtitulo">
                    <p>La firma es tu compromiso legal. Nunca firmes con prisas ni bajo presión. Recuerda:</p>
                    <ul>
                        <li><strong>Lee todo:</strong> Tienes derecho a leer cada página tranquilamente.</li>
                        <li><strong>No firmes en blanco:</strong> Jamás pongas tu firma en un papel que no esté rellenado.</li>
                        <li><strong>Dudas:</strong> Si algo no te cuadra, no firmes. Puedes llevarte el borrador para que alguien de confianza lo revise.</li>
                    </ul>
                </div>
            </article>
        </section>

        <section id="copia" class="apple-seccion apple-seccion--invertida">
            <figure class="apple-imagen">
                <img src="https://images.pexels.com/photos/3184291/pexels-photo-3184291.jpeg?auto=compress&cs=tinysrgb&w=800" alt="Copia del contrato">
            </figure>
            <article class="apple-texto">
                <h2 class="apple-texto-titulo">Exige tu ejemplar</h2>
                <div class="apple-texto-subtitulo">
                    <p>Es obligatorio que te entreguen una copia original firmada y sellada por la empresa en el mismo momento.</p>
                    <p>Esa copia es tu <strong>única prueba legal</strong> de que estás trabajando allí, de cuánto vas a cobrar y de cuáles son tus horarios. Guárdala siempre en un lugar seguro o hazle una foto con el móvil nada más tenerla.</p>
                </div>
            </article>
        </section>

    </main>

    <?php include 'footer.php'?>
</body>
</html>