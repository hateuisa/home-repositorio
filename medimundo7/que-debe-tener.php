<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>¿Qué debe tener mi contrato? - Médicos del Mundo</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <?php include 'header.php'?>

    <header class="apple-header">
        <h1 class="apple-header-titulo">¿Qué debe tener mi contrato?</h1>
        <nav class="apple-nav">
            <a href="#datos" class="apple-pildora">Datos básicos</a>
            <a href="#puesto" class="apple-pildora">Puesto y Lugar</a>
            <a href="#tiempo" class="apple-pildora">Tiempo y Horario</a>
            <a href="#dinero" class="apple-pildora">Sueldo y Vacaciones</a>
        </nav>
    </header>

    <main class="apple-main">

        <section id="datos" class="apple-seccion apple-seccion--normal">
            <figure class="apple-imagen">
                <img src="https://images.pexels.com/photos/1181533/pexels-photo-1181533.jpeg?auto=compress&cs=tinysrgb&w=800" alt="Mujer profesional revisando contrato">
            </figure>
            <article class="apple-texto">
                <h2 class="apple-texto-titulo">Identificación Clara</h2>
                <div class="apple-texto-subtitulo">
                    <p>Es fundamental que aparezcan correctamente los datos de ambas partes:</p>
                    <ul>
                        <li><strong>La Empresa:</strong> Nombre legal, CIF y domicilio.</li>
                        <li><strong>Tus Datos:</strong> Nombre, apellidos, DNI/NIE y dirección.</li>
                    </ul>
                    <p>Revisa bien que tu número de identificación sea el correcto para que tu alta sea válida.</p>
                </div>
            </article>
        </section>

        <section id="puesto" class="apple-seccion apple-seccion--invertida">
            <figure class="apple-imagen">
                <img src="https://images.pexels.com/photos/3184357/pexels-photo-3184357.jpeg?auto=compress&cs=tinysrgb&w=800" alt="Lugar de trabajo">
            </figure>
            <article class="apple-texto">
                <h2 class="apple-texto-titulo">¿De qué trabajarás?</h2>
                <div class="apple-texto-subtitulo">
                    <p>El contrato debe especificar tu <strong>Categoría Profesional</strong>. Esto define tus funciones y el salario mínimo que te corresponde.</p>
                    <p>También debe indicar el <strong>Centro de Trabajo</strong>: la dirección física donde trabajarás.</p>
                </div>
            </article>
        </section>

        <section id="tiempo" class="apple-seccion apple-seccion--normal">
            <figure class="apple-imagen">
                <img src="https://images.pexels.com/photos/3760069/pexels-photo-3760069.jpeg?auto=compress&cs=tinysrgb&w=800" alt="Reloj">
            </figure>
            <article class="apple-texto">
                <h2 class="apple-texto-titulo">Duración y Horario</h2>
                <div class="apple-texto-subtitulo">
                    <p>Debes revisar tres puntos clave sobre el tiempo:</p>
                    <ul>
                        <li><strong>Tipo de contrato:</strong> ¿Es indefinido o temporal?</li>
                        <li><strong>Jornada:</strong> ¿Es completa o parcial? Indica las horas semanales.</li>
                        <li><strong>Horario:</strong> Tu turno o las horas de entrada y salida.</li>
                    </ul>
                </div>
            </article>
        </section>

        <section id="dinero" class="apple-seccion apple-seccion--invertida">
            <figure class="apple-imagen">
                <img src="https://images.pexels.com/photos/4386370/pexels-photo-4386370.jpeg?auto=compress&cs=tinysrgb&w=800" alt="Dinero y ahorro">
            </figure>
            <article class="apple-texto">
                <h2 class="apple-texto-titulo">Sueldo y Descanso</h2>
                <div class="apple-texto-subtitulo">
                    <p><strong>El Salario:</strong> El contrato debe indicar cuánto cobrarás de forma bruta. Nunca puede ser menos del SMI.</p>
                    <p><strong>Vacaciones:</strong> Tienes derecho a un mínimo de 30 días naturales por año trabajado.</p>
                </div>
            </article>
        </section>

    </main>

    <?php include 'footer.php'?>
</body>
</html>