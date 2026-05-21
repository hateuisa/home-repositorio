<?php
// Se incluyen las clases necesarias
require_once 'clases/config.php';
require_once 'clases/faq.php';
require_once 'clases/categoria.php';

// Se crea una nueva instancia de la clase Database
$database = new Database();
// Se obtiene la conexión a la base de datos
$db = $database->getConnection();

// Se obtiene el id de la categoría que viene por GET
$id_categoria = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Se crea una nueva instancia de la clase Categoria
$catObj = new Categoria($db);
// Se carga el título de la categoría
$catObj->cargarPorId($id_categoria);
$tituloCategoria = $catObj->getTitulo();

// Se crea una nueva instancia de la clase Faq
$faqObj = new Faq($db);
// Se obtienen las preguntas frecuentes para esta categoría
$faqs = $faqObj->obtenerFaqsPorCategoria($id_categoria);

// -------------------------------------------------------
// Preguntas de ejemplo por categoría (usadas solo si la BD
// no tiene FAQs todavía para esa categoría)
// -------------------------------------------------------
$faqsEjemplo = [

    // Contratos de Trabajo (id_categoria = 1)
    1 => [
        [
            'pregunta'  => '¿Tengo que firmar el contrato antes de empezar a trabajar?',
            'respuesta' => 'Sí. Lo ideal es que firmes el contrato antes de incorporarte. Si ya estás trabajando y no te han dado nada que firmar, la ley te protege: se entiende que tienes un contrato indefinido y a jornada completa desde el primer día.',
        ],
        [
            'pregunta'  => '¿Qué pasa si firmo algo que no entiendo?',
            'respuesta' => 'Nunca debes firmar nada que no comprendas. Tienes derecho a pedir una copia del contrato y leerlo con calma en casa, o pedir ayuda a alguien de confianza. Si ya firmaste y detectas algo irregular, puedes acudir a un sindicato o a la Inspección de Trabajo.',
        ],
        [
            'pregunta'  => '¿Me pueden bajar el sueldo si lo pone en el contrato?',
            'respuesta' => 'No. Aunque el contrato lo recoja, ninguna empresa puede fijar un salario por debajo del Salario Mínimo Interprofesional (SMI) ni del que marque tu convenio colectivo. En 2026 el SMI es de 1.221 € mensuales en 14 pagas. Esa cantidad es un derecho irrenunciable.',
        ],
        [
            'pregunta'  => '¿Tengo derecho a vacaciones aunque el contrato no las mencione?',
            'respuesta' => 'Sí. Las vacaciones son un derecho legal mínimo de 30 días naturales al año. Aunque el contrato no las mencione, te corresponden igualmente. Ningún acuerdo puede eliminarlas ni sustituirlas por dinero mientras la relación laboral esté activa.',
        ],
    ],

    // Jornada de Trabajo (id_categoria = 2)
    2 => [
        [
            'pregunta'  => '¿Cuántas horas puedo trabajar como máximo a la semana?',
            'respuesta' => 'La jornada ordinaria máxima es de 40 horas semanales de promedio anual. Además, en un solo día no puedes superar las 9 horas de trabajo efectivo como norma general, y entre el final de una jornada y el inicio de la siguiente deben pasar al menos 12 horas.',
        ],
        [
            'pregunta'  => '¿Pueden obligarme a hacer horas extra?',
            'respuesta' => 'No, salvo que el convenio colectivo o tu contrato lo establezcan expresamente, las horas extraordinarias son voluntarias. El número máximo es de 80 horas al año. Deben pagarse o compensarse con descanso, y han de quedar registradas.',
        ],
        [
            'pregunta'  => '¿A cuántos días de vacaciones tengo derecho?',
            'respuesta' => 'Como mínimo a 30 días naturales al año, lo que equivale a 2,5 días por cada mes trabajado. Las vacaciones deben disfrutarse dentro del año y no pueden sustituirse por dinero mientras el contrato esté vigente.',
        ],
        [
            'pregunta'  => '¿Tengo derecho a desconectarme fuera de mi horario?',
            'respuesta' => 'Sí. La Ley te reconoce el derecho a la desconexión digital. Al acabar tu jornada no tienes ninguna obligación de contestar llamadas, correos ni mensajes de trabajo. Tu tiempo libre es tuyo.',
        ],
    ],

    // Contrato Indefinido (id_categoria = 3)
    3 => [
        [
            'pregunta'  => '¿Qué es exactamente un contrato indefinido?',
            'respuesta' => 'Es el contrato "para siempre". No tiene fecha de finalización prevista. Permanecerás vinculada a la empresa de forma estable hasta que decidas marcharte, te jubiles o se produzca una causa legal de despido. Desde 2022 es la modalidad de referencia en España.',
        ],
        [
            'pregunta'  => '¿Cuánto me tienen que pagar si me despiden con contrato indefinido?',
            'respuesta' => 'Depende del tipo de despido. Si es un despido improcedente (sin causa justificada), tienes derecho a 33 días de salario por cada año trabajado. Si es por causas objetivas válidas, la indemnización es de 20 días por año trabajado.',
        ],
        [
            'pregunta'  => '¿Cuántas semanas de baja por maternidad tengo en 2026?',
            'respuesta' => 'En 2026 dispones de 19 semanas totales de permiso por nacimiento. Las 6 primeras semanas tras el parto son obligatorias e ininterrumpidas. Las 13 semanas restantes puedes disfrutarlas de forma flexible antes de que tu bebé cumpla un año.',
        ],
        [
            'pregunta'  => '¿Me pueden reducir las vacaciones con el contrato indefinido?',
            'respuesta' => 'No. Las vacaciones mínimas de 30 días naturales anuales son un derecho irrenunciable. Ningún contrato, aunque sea indefinido, puede reducirlas. Además, no pueden canjearse por dinero mientras la relación laboral esté activa.',
        ],
    ],

    // Contrato Temporal (id_categoria = 4)
    4 => [
        [
            'pregunta'  => '¿En qué casos pueden contratarme de forma temporal?',
            'respuesta' => 'Solo en dos supuestos: por circunstancias de la producción (aumento imprevisto de trabajo, máximo 6 meses ampliables a 1 año según convenio) o para sustituir a otra trabajadora en baja, vacaciones o permiso de maternidad. Fuera de estos casos, el contrato se considera indefinido.',
        ],
        [
            'pregunta'  => '¿Cuándo me convierto en fija aunque tenga contrato temporal?',
            'respuesta' => 'Si en un periodo de 24 meses has estado contratada más de 18 meses mediante dos o más contratos temporales, adquieres automáticamente la condición de trabajadora fija, con todos los derechos que ello conlleva.',
        ],
        [
            'pregunta'  => '¿Tengo las mismas vacaciones que una trabajadora fija?',
            'respuesta' => 'Sí. Como trabajadora temporal tienes exactamente los mismos derechos: mínimo 30 días naturales de vacaciones al año (2,5 días por mes trabajado), jornada máxima de 40 horas semanales y un descanso mínimo de 12 horas entre jornadas.',
        ],
        [
            'pregunta'  => '¿Qué ocurre si mi empresa me contrata temporalmente sin causa real?',
            'respuesta' => 'Se considera fraude de ley. Si la empresa no puede justificar una de las dos causas permitidas, tu contrato se convierte automáticamente en indefinido ordinario desde el primer día, con todos los derechos de estabilidad que eso implica.',
        ],
    ],

    // Contrato Formativo (id_categoria = 5)
    5 => [
        [
            'pregunta'  => '¿Qué tipos de contrato formativo existen en 2026?',
            'respuesta' => 'Hay dos modalidades: el contrato de formación en alternancia (para quienes aún están estudiando y combinan el aula con el trabajo) y el contrato para la obtención de práctica profesional (para quienes ya tienen un título universitario o de FP y buscan su primera experiencia relacionada con su formación).',
        ],
        [
            'pregunta'  => '¿Cuánto debo cobrar con un contrato de prácticas?',
            'respuesta' => 'Con el contrato de práctica profesional cobrarás lo que fije el convenio de tu categoría, pero nunca por debajo del SMI, que en 2026 es de 1.221 € mensuales. En alternancia, el mínimo es el 60% del convenio el primer año y el 75% el segundo.',
        ],
        [
            'pregunta'  => '¿Tengo derecho a paro al terminar un contrato formativo?',
            'respuesta' => 'Sí. Desde la reforma laboral, las trabajadoras con contrato formativo tienen protección completa de la Seguridad Social, incluyendo la prestación por desempleo, siempre que reúnas los requisitos de cotización necesarios.',
        ],
        [
            'pregunta'  => '¿Pueden ponerme un nuevo periodo de prueba al terminar las prácticas si me contratan fija?',
            'respuesta' => 'No. Si al finalizar tu contrato formativo la empresa decide contratarte de forma indefinida, no puede imponerte un nuevo periodo de prueba. Se entiende que durante la etapa formativa ya has demostrado tus capacidades.',
        ],
    ],

    // Contrato Fijo Discontinuo (id_categoria = 6)
    6 => [
        [
            'pregunta'  => '¿El contrato fijo-discontinuo es realmente indefinido?',
            'respuesta' => 'Sí. Aunque trabajes solo en determinadas temporadas, eres una trabajadora fija. La relación laboral no se rompe entre temporadas, simplemente queda en pausa. Esto te da derecho a que te llamen cada vez que se reinicie la actividad.',
        ],
        [
            'pregunta'  => '¿Puedo cobrar el paro entre temporadas?',
            'respuesta' => 'Sí. Durante los periodos de inactividad, aunque tu contrato sigue vigente, puedes solicitar y cobrar la prestación por desempleo si cumples los requisitos de cotización. La empresa no te paga durante ese tiempo, pero la Seguridad Social te cubre.',
        ],
        [
            'pregunta'  => '¿Cómo me tienen que avisar cuando empieza la temporada?',
            'respuesta' => 'Mediante un llamamiento formal, por escrito o por un medio que deje constancia (como un correo electrónico). La empresa debe respetar un orden objetivo (normalmente por antigüedad). Si reinicia la actividad sin avisarte cuando te corresponde, puedes reclamarlo como un despido.',
        ],
        [
            'pregunta'  => '¿Cuánto me pagarían si me despiden de forma definitiva?',
            'respuesta' => 'Si la empresa decide finalizar tu relación laboral de forma definitiva sin causa justificada, tienes derecho a 33 días de salario por cada año trabajado. Eso sí, para calcular esta indemnización solo cuentan los periodos en los que efectivamente prestaste servicios.',
        ],
    ],

    // Jornada Ordinaria (id_categoria = 7)
    7 => [
        [
            'pregunta'  => '¿Está obligada la empresa a registrar mi horario?',
            'respuesta' => 'Sí, es obligatorio. La empresa debe registrar diariamente tu hora de entrada y de salida. Este registro te protege frente a posibles abusos y es la prueba que necesitas si alguna vez tienes que reclamar horas no pagadas.',
        ],
        [
            'pregunta'  => '¿Cuántas horas de descanso tengo entre jornada y jornada?',
            'respuesta' => 'Como mínimo 12 horas entre el final de una jornada y el inicio de la siguiente. Además, tienes derecho a un descanso semanal mínimo de día y medio ininterrumpido.',
        ],
    ],

    // Horas Extraordinarias (id_categoria = 8)
    8 => [
        [
            'pregunta'  => '¿Pueden obligarme a hacer horas extraordinarias?',
            'respuesta' => 'No, salvo que tu convenio o contrato lo contemple expresamente. Las horas extra son voluntarias. El máximo legal es de 80 horas al año y deben quedar registradas.',
        ],
        [
            'pregunta'  => '¿Cómo se compensan las horas extraordinarias?',
            'respuesta' => 'Pueden pagarse económicamente (con un recargo sobre la hora ordinaria según convenio) o compensarse con tiempo de descanso equivalente. Lo habitual es que el convenio de tu sector fije el modo de compensación.',
        ],
    ],

    // Vacaciones y Descansos (id_categoria = 9)
    9 => [
        [
            'pregunta'  => '¿Cuántos días de vacaciones me corresponden?',
            'respuesta' => 'Un mínimo de 30 días naturales al año, equivalente a 2,5 días por cada mes trabajado. Tu convenio colectivo puede mejorar este mínimo. Las vacaciones no pueden sustituirse por dinero mientras el contrato esté vigente.',
        ],
        [
            'pregunta'  => '¿Puede la empresa cambiarme las vacaciones sin avisarme?',
            'respuesta' => 'No. Los periodos de vacaciones se pactan entre empresa y trabajadora. La empresa debe avisarte con suficiente antelación. Si te las cambia de forma unilateral y sin justificación, puedes reclamar ante la Inspección de Trabajo.',
        ],
    ],

    // Permisos Retribuidos (id_categoria = 10)
    10 => [
        [
            'pregunta'  => '¿Qué es un permiso retribuido?',
            'respuesta' => 'Es un permiso en el que puedes ausentarte del trabajo con causa justificada sin perder tu salario. La ley reconoce permisos por matrimonio, nacimiento, fallecimiento de familiar, traslado de domicilio o examen, entre otros.',
        ],
        [
            'pregunta'  => '¿Tengo que justificar siempre los permisos?',
            'respuesta' => 'Sí. Debes comunicarlo a la empresa lo antes posible y aportar el justificante correspondiente (libro de familia, certificado médico, etc.). Si no lo justificas, la empresa puede descontarte los días de tu salario.',
        ],
    ],

    // Conciliación y Reducción de Jornada (id_categoria = 11)
    11 => [
        [
            'pregunta'  => '¿Puedo reducir mi jornada para cuidar a mi hija o hijo?',
            'respuesta' => 'Sí. Tienes derecho a reducir tu jornada entre un octavo y la mitad si tienes a tu cargo hijos o hijas menores de 12 años, familiares dependientes o personas con discapacidad. La reducción lleva aparejada una disminución proporcional del salario.',
        ],
        [
            'pregunta'  => '¿El teletrabajo es siempre voluntario?',
            'respuesta' => 'Sí. El trabajo a distancia debe acordarse siempre por escrito y de forma voluntaria. La empresa no puede imponértelo unilateralmente, y si lo aceptas, tienes los mismos derechos que en la oficina: la empresa debe proporcionarte los equipos necesarios.',
        ],
    ],

    // Trabajo Nocturno y a Turnos (id_categoria = 12)
    12 => [
        [
            'pregunta'  => '¿Qué se considera trabajo nocturno?',
            'respuesta' => 'Se considera trabajo nocturno el realizado entre las 22:00 y las 06:00 horas. Las trabajadoras nocturnas tienen derecho a una retribución específica (plus de nocturnidad) o a una reducción de jornada equivalente, según lo que establezca el convenio colectivo.',
        ],
        [
            'pregunta'  => '¿Puedo negarme a trabajar en turno de noche por razones de salud?',
            'respuesta' => 'Sí. Si tu médica certifica que el trabajo nocturno perjudica tu salud, la empresa está obligada a trasladarte a un puesto diurno que esté disponible, aunque sea de categoría diferente, siempre que no suponga una pérdida salarial.',
        ],
    ],
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preguntas Frecuentes - <?php echo htmlspecialchars($tituloCategoria ?? 'FAQ'); ?></title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

    <!-- Se incluye el header -->
    <?php include 'header.php'; ?>

    <!-- Se define el encabezado de la página con enlace de navegación -->
    <header class="apple-header">
        <h1 class="apple-header-titulo">Preguntas Frecuentes</h1>
        <nav class="apple-nav">
            <?php if (!empty($tituloCategoria)): ?>
                <span class="apple-pildora" style="background: #a354a1; color: white; cursor: default;">
                    <?php echo htmlspecialchars($tituloCategoria); ?>
                </span>
            <?php endif; ?>
            <a href="#faqs" class="apple-pildora">Ver preguntas</a>
        </nav>
    </header>

    <!-- Se inicia el main -->
    <main class="contenedor-principal">

        <!-- Se define el título de la página -->
        <h1 class="titulo">¿Tienes dudas?</h1>

        <?php
        // Se determina qué preguntas mostrar:
        // Si la BD tiene FAQs para esta categoría se usan esas,
        // si no, se usan las preguntas de ejemplo definidas arriba
        $preguntasFinales = !empty($faqs)
            ? $faqs
            : ($faqsEjemplo[$id_categoria] ?? []);
        ?>

        <?php // Si no hay preguntas de ninguna fuente, se muestra un mensaje
        if (empty($preguntasFinales)): ?>
            <p style="color: white; padding: 0 5% 40px;">
                No hay preguntas frecuentes disponibles para esta sección todavía.
            </p>
        <?php else: ?>

            <!-- Se crea la sección de acordeones con las preguntas frecuentes -->
            <section id="faqs" style="padding: 0 5% 60px;">
                <?php // Se recorren las preguntas y se muestran en elementos desplegables
                foreach ($preguntasFinales as $faq): ?>
                    <!-- Se crea el elemento desplegable para cada pregunta -->
                    <details class="acordeon-item">
                        <summary class="acordeon-titulo">
                            <?php echo htmlspecialchars($faq['pregunta']); ?>
                        </summary>
                        <div class="acordeon-texto">
                            <p><?php echo nl2br(htmlspecialchars($faq['respuesta'])); ?></p>

                            <?php // Si existe fecha de actualización, se muestra formateada
                            if (!empty($faq['fecha_actualizacion'])): ?>
                                <p style="margin-top: 12px; font-size: 0.8rem; color: #9e9e9e;">
                                    Actualizado el <?php echo htmlspecialchars(
                                        date('d/m/Y', strtotime($faq['fecha_actualizacion']))
                                    ); ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    </details>
                <?php endforeach; ?>
            </section>

        <?php endif; ?>

        <!-- Se crea el enlace para volver atrás -->
        <div class="volver">
            <a href="javascript:history.back()" class="boton-volver">
                ← Volver
            </a>
        </div>

    </main>

    <!-- Se incluye el footer -->
    <?php include 'footer.php'; ?>
</body>
</html>