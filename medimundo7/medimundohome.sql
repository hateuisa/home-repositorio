-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-05-2026 a las 10:43:35
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `medimundohome`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bloque`
--

CREATE TABLE `bloque` (
  `id_bloque` int(11) NOT NULL,
  `titulo` varchar(150) DEFAULT NULL,
  `subtitulo` varchar(150) DEFAULT NULL,
  `contenido` text DEFAULT NULL,
  `orden` int(11) DEFAULT NULL,
  `fecha_actualizacion` date DEFAULT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  `icono` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `bloque`
--

INSERT INTO `bloque` (`id_bloque`, `titulo`, `subtitulo`, `contenido`, `orden`, `fecha_actualizacion`, `id_categoria`, `icono`) VALUES
(16, '¿Qué es un contrato indefinido?', ' Tu empleo, sin fecha de caducidad', ' Un contrato indefinido es el que no tiene fecha de fin. Eso significa que la empresa te contrata sin un plazo límite, y el trabajo continúa mientras ambas partes lo decidan.\r\n\r\nEs el tipo de contrato que más protección te da. Si la empresa quiere terminar la relación laboral, tiene que dar razones válidas y seguir un proceso legal. No te pueden echar así como así.\r\n', 1, NULL, 3, ''),
(17, '¿Qué debes saber?', '', '-Puede ser a jornada completa (las horas máximas que marca la ley) o a tiempo parcial (menos horas, acordadas con la empresa).\r\n\r\n-Debe hacerse siempre por escrito.\r\n\r\n-Tienes derecho a periodo de prueba, pero con límites: máximo 6 meses si eres titulada técnica, y máximo 2 meses en el resto de casos (3 meses en empresas pequeñas de menos de 25 personas).\r\n\r\n-Si no te entregan contrato escrito, la ley dice que se entiende que tienes un contrato indefinido a jornada completa. ¡Eso también te protege!\r\n', 2, NULL, 3, ''),
(18, 'Lo más importante', '', 'Lo más importante: con un contrato indefinido, tu empresa tiene que cotizarte en la Seguridad Social desde el primer día. Eso significa que tienes acceso a sanidad, a la prestación por desempleo si te despiden, y a tu jubilación futura.\r\n', 3, NULL, 3, ''),
(19, '¿Qué pasa si la empresa me quiere despedir?', 'No cualquier despido es legal!', 'Con un contrato indefinido, la empresa no puede despedirte sin motivo. Si lo hace sin causa o sin seguir el procedimiento correcto, el despido se considera improcedente, y en ese caso tienes derecho a una indemnización de 33 días de salario por cada año trabajado (con un máximo de 24 mensualidades).\r\n\r\nSi te despiden por algo discriminatorio (por ser mujer, por estar embarazada, por denunciar una situación de abuso, etc.), el despido se declara nulo, y la empresa tiene que readmitirte y pagarte los salarios que no hayas cobrado durante el tiempo que estuviste fuera.\r\n\r\n¿Qué debes hacer si te despiden? Tienes 20 días hábiles desde que te entregan la carta de despido para reclamar. Primero debes intentar una conciliación (reunión para llegar a un acuerdo) y, si no funciona, puedes acudir al Juzgado de lo Social. No pagues ninguna tasa por presentar la demanda, el primer paso es gratuito.\r\n', 4, NULL, 3, ''),
(20, '¿Qué es un contrato temporal?', 'Trabajo con fecha de fin, pero con los mismos derechos', 'Un contrato temporal es aquel que tiene una duración determinada desde el principio. Hay una fecha de inicio y una fecha de fin (o una causa que cuando desaparece, termina el contrato).\r\n\r\nDesde la reforma laboral de 2022, en España la temporalidad está muy limitada. Solo se puede contratar de forma temporal en dos casos concretos:\r\n\r\n1. Por sustitución de una trabajadora: Si la empresa necesita cubrir el puesto de alguien que está de baja, de permiso de maternidad, de excedencia, etc. Dura lo que dure esa situación y debe indicarse en el contrato a quién se sustituye y por qué.\r\n\r\n2. Por circunstancias de la producción: Cuando hay un pico de trabajo puntual que la empresa no puede cubrir con su plantilla habitual (por ejemplo, campaña de Navidad, una feria, etc).\r\n   - Duración máxima: 6 meses (puede ampliarse a 1 año si el convenio colectivo del sector lo permite).\r\n\r\n   - También puede usarse para cubrir situaciones ocasionales e imprevisibles, pero entonces solo puede durar 90 días al año.\r\n\r\n', 1, NULL, 4, ''),
(21, '¿Qué derechos tienes con un contrato temporal?', '', ' Los mismos que con uno indefinido: salario según convenio, vacaciones, Seguridad Social, bajas médicas, etc. Tener un contrato temporal no significa tener menos derechos.\r\n\r\nAdemás, si llevas más de 24 meses trabajando en la misma empresa en los últimos 24 meses (con uno o varios contratos), la ley dice que pasas automáticamente a ser trabajadora indefinida.\r\n', 2, NULL, 4, ''),
(22, 'Cuando el contrato temporal termina', 'Finiquito e indemnización', 'Cuando llega la fecha de fin de tu contrato temporal y la empresa no lo renueva, tienes derecho a:\r\n\r\n    - Que te paguen los días trabajados de ese mes que no hayas cobrado todavía.\r\n\r\n    - Que te paguen la parte proporcional de las pagas extra que no hayas recibido.\r\n\r\n    - Que te paguen los días de vacaciones que no hayas podido disfrutar.\r\n\r\n    - Una indemnización de 12 días de salario por cada año trabajado.\r\n\r\nTodo esto junto se llama finiquito. Antes de firmarlo, léelo con calma. Si no estás segura de algo, pide ayuda. Firmarlo significa que aceptas las cantidades y que la relación laboral termina de forma acordada.\r\n', 3, NULL, 4, ''),
(23, 'El contrato de formación', 'Trabajar y aprender al mismo tiempo', ' El contrato formativo es especial: está diseñado para que puedas trabajar mientras te formas o poco después de terminar tus estudios. Hay dos tipos:\r\n\r\n1. Contrato de formación en alternancia: Combina trabajo en la empresa con formación en un centro educativo o de formación profesional.\r\n\r\n    - Duración: entre 3 meses y 2 años.\r\n\r\n    - No puedes hacer horas extra ni trabajar de noche.\r\n\r\n    - Tu salario no puede ser inferior al Salario Mínimo Interprofesional (SMI), que en 2025 es de 1.184€ al mes para jornada completa.\r\n\r\n2. Contrato para la práctica profesional: Es para personas que han terminado recientemente sus estudios (ciclo formativo, grado universitario, máster, etc.) y quieren obtener experiencia en su campo.\r\n\r\n    - Puedes usarlo si no han pasado más de 3 años desde que terminaste los estudios (5 años si tienes alguna discapacidad).\r\n\r\n    - Duración: entre 6 meses y 1 año.\r\n    - El salario lo marca el convenio colectivo de tu sector.\r\n\r\n', 1, NULL, 5, ''),
(24, '¿Qué debes saber?', '', 'Con cualquiera de estos contratos, la empresa tiene que cotizarte en la Seguridad Social. Tienes acceso a sanidad y a protección en caso de accidente laboral desde el primer día.\r\n', 2, NULL, 5, ''),
(25, '¿Qué es el contrato fijo-discontinuo?', 'Estabilidad aunque no trabajes todo el año', ' El contrato fijo-discontinuo es un tipo especial de contrato indefinido. Está pensado para trabajos que no se hacen todos los días del año, sino en temporadas o de forma intermitente (por ejemplo, el turismo en verano, la vendimia, campañas concretas...).\r\n\r\n¿Qué lo hace especial? Que aunque no estés trabajando en los periodos de inactividad, sigues siendo empleada de esa empresa. No te despiden entre temporada y temporada, sino que el contrato se &quot;pausa&quot;.\r\n', 1, NULL, 6, ''),
(26, '¿Qué derechos tienes?', '', 'La empresa está obligada a llamarte (se llama &quot;llamamiento&quot;) cuando empiece la actividad. Ese llamamiento debe hacerse por escrito o de una forma que quede constancia.\r\n\r\nSi no te llaman cuando deben y no hay causa justificada, puedes reclamar como si fuera un despido.\r\n\r\nTu antigüedad cuenta desde el principio, incluyendo los periodos que no estás activa.\r\n\r\nTienes derecho a vacaciones proporcionales al tiempo trabajado cada año.\r\n\r\nDurante los periodos sin actividad, si cumples los requisitos, puedes solicitar la prestación por desempleo (el paro).\r\n', 2, NULL, 6, ''),
(27, '¿Y la Seguridad Social?', '', 'Durante los periodos activos, la empresa cotiza por ti con normalidad. Eso cuenta para tu jubilación, para bajas médicas y para el derecho al paro.\r\n', 3, NULL, 6, ''),
(29, '¿Cuántas horas puedo trabajar?', 'Lo que la ley dice sobre tu jornada', 'En España, la ley establece que no puedes trabajar más de 40 horas semanales de media a lo largo del año (esto lo regula el artículo 34 del Estatuto de los Trabajadores). Eso equivale a unas 8 horas diarias si trabajas 5 días a la semana.\r\n', 1, NULL, 7, ''),
(30, ' Límites', 'Además, hay unos límites que la empresa siempre tiene que respetar:', 'Entre jornada y jornada debe haber al menos 12 horas de descanso. Si terminas a las 10 de la noche, no pueden llamarte hasta las 10 de la mañana del día siguiente como mínimo.\r\n\r\nMáximo diario: 9 horas de trabajo efectivo (salvo que el convenio colectivo diga otra cosa).\r\n\r\nSi trabajas más de 6 horas seguidas, tienes derecho a un descanso de al menos 15 minutos.\r\n\r\nLa empresa está obligada a llevar un registro diario de las horas que trabajas. Tienes derecho a consultarlo.\r\n', 2, NULL, 7, ''),
(31, '¿Puedo trabajar menos horas?', '', ' Sí. Puedes acordar con tu empresa una jornada a tiempo parcial (por ejemplo, 20 horas semanales). En ese caso, tu salario será proporcional. Pero la empresa no puede obligarte a trabajar más horas de las que marque tu contrato sin compensarte.\r\n', 3, NULL, 7, ''),
(32, 'El horario y los turnos', 'Tus horas, organizadas', 'El horario concreto (a qué hora entras y a qué hora sales) lo decide la empresa dentro de los límites legales, pero tiene que estar claro en tu contrato o en el convenio colectivo de tu sector.\r\n', 4, NULL, 3, ''),
(33, 'Trabajo nocturno', '', ' Si trabajas entre las 22:00 y las 6:00, se considera trabajo nocturno. Las trabajadoras nocturnas no pueden superar las 8 horas diarias de media. Además, el convenio suele reconocer un complemento salarial por trabajar de noche, porque implica un esfuerzo extra.\r\n', 5, NULL, 7, ''),
(34, 'Trabajo a turnos', '', 'Si tu empresa funciona en turnos (mañana, tarde y noche que se rotan), la empresa tiene que informarte con suficiente antelación cuándo te tocan cada turno. Cada 2 semanas tienes derecho a disfrutar al menos un domingo completo de descanso.', 6, NULL, 7, ''),
(35, 'Registro horario', '', 'Desde 2019, todas las empresas en España están obligadas a registrar cada día las horas de entrada y salida de todas sus trabajadoras. Ese registro debe guardarse durante 4 años y tú tienes derecho a ver tu propio registro cuando lo pidas. Si la empresa no lo lleva, puede ser sancionada.\r\n', 7, NULL, 7, ''),
(36, '¿Qué son las horas extra?', ' Más allá de tu jornada habitual', 'Las horas extraordinarias (o horas extra) son las horas que trabajas por encima de tu jornada habitual. Si tu contrato es de 8 horas diarias y un día trabajas 10, esas 2 horas de más son horas extra.\r\n', 1, NULL, 8, ''),
(37, 'Lo más importante:', '', 'Las horas extra son voluntarias. La empresa no puede obligarte a hacerlas, salvo que el convenio colectivo o tu contrato lo establezcan expresamente, o que sea una emergencia (accidente, avería urgente, etc.).\r\n\r\nExiste un límite: máximo 80 horas extra al año. No importa cuánto lo necesite la empresa, no puede pedirte más de eso.\r\n\r\nSi eres trabajadora a tiempo parcial, no puedes hacer horas extra (sí puedes hacer &quot;horas complementarias&quot;, que son distintas y deben estar pactadas en tu contrato).\r\n', 2, NULL, 8, ''),
(38, '¿Cómo se compensan?', '', ' Hay dos formas, y lo que se aplica depende de tu convenio colectivo o de lo que hayas acordado con tu empresa:\r\n\r\n    - Te pagan más: La hora extra se paga al menos igual que una hora normal, y en muchos convenios se paga un 25%-75% más.\r\n\r\n     - Te dan descanso: En lugar de dinero, te dan tiempo libre equivalente a las horas extra realizadas. Ese descanso tiene que darse en los 4 meses siguientes a haber hecho las horas extra.\r\n\r\nSi la empresa no te compensa las horas extra (ni con dinero ni con descanso), puedes reclamarlo. Tienes hasta 1 año desde que se hicieron las horas para exigir el pago.\r\n', 3, NULL, 8, ''),
(39, ' ¿Cómo saber cuántas horas extra hice?', 'El registro horario, tu mejor aliada', 'La empresa está obligada a registrar tus horas diariamente. Ese mismo registro sirve para demostrar cuántas horas extra has hecho.\r\n\r\nSi tu empresa no lleva ese registro o te niega el acceso a él, eso ya es una infracción que puedes denunciar en la Inspección de Trabajo.\r\n\r\n     - Consejo práctico: Guarda tú también un registro propio (en papel, en el móvil, como sea) de los días que entras y sales. Si hay una discrepancia entre lo que dice la empresa y lo que dices tú, esa documentación personal puede ayudarte.\r\n', 4, NULL, 8, ''),
(40, '¿Y si la empresa dice que no hice horas extra?', '', 'En caso de conflicto, es la empresa la que tiene que demostrar que no se hicieron esas horas, especialmente si no tiene un registro horario correcto. La ley te protege en este sentido.\r\n', 5, NULL, 8, ''),
(41, 'Tus vacaciones: un derecho, no un favor', 'Lo que te corresponde por ley', 'En España, todas las trabajadoras tienen derecho a al menos 30 días naturales de vacaciones al año (esto equivale a unos 22 días hábiles si trabajas de lunes a viernes). Esto lo establece el artículo 38 del Estatuto de los Trabajadores.', 1, NULL, 9, ''),
(42, 'Reglas clave sobre las vacaciones:', '', '- Las vacaciones no se pueden sustituir por dinero. La empresa no puede decirte &quot;en lugar de darte vacaciones, te pago más&quot;. Tienes que disfrutarlas.\r\n\r\n- Si llevas menos de un año trabajando, las vacaciones son proporcionales al tiempo trabajado.\r\n\r\n- Las fechas se acuerdan entre tú y la empresa, pero si no hay acuerdo, es la empresa quien decide. Eso sí, tiene que avisarte con al menos 2 meses de antelación.\r\n\r\n- Si te pones enferma durante las vacaciones (con baja médica), esos días de baja no cuentan como vacaciones. Puedes recuperarlos después, aunque tengas que pedirlo y puede tener límites.\r\n', 2, NULL, 9, ''),
(43, '¿Y si la empresa no me deja coger vacaciones?', '', 'Si la empresa se niega a darte tus vacaciones sin justificación, puedes reclamarlo. Si no llegas a un acuerdo, puedes acudir al Juzgado de lo Social, y tienes 20 días hábiles desde que la empresa te haya confirmado las fechas con las que no estás de acuerdo para impugnarlas.\r\n', 3, NULL, 9, ''),
(44, ' Descanso semanal y festivos', ' Tienes derecho a parar', 'Además de las vacaciones anuales, la ley te garantiza otros descansos que la empresa también tiene que respetar:\r\n\r\n- Descanso semanal: Tienes derecho a día y medio de descanso a la semana (en total, a lo largo de cada 14 días deben ser 3 días libres). Lo habitual es que incluya el domingo completo más la tarde del sábado o la mañana del lunes, aunque puede variar según el convenio.\r\n\r\n- Festivos: Al año hay 14 días festivos pagados que no puedes trabajar (o que si trabajas, se compensan). Algunos son nacionales (siempre los mismos en toda España) y otros varían según la comunidad autónoma o el municipio.\r\n\r\n- Descanso entre jornadas: Entre que terminas un día y empiezas el siguiente, tienen que pasar al menos 12 horas. Esto es obligatorio y la empresa no puede saltárselo.\r\n\r\n- Permisos retribuidos (días que se pagan aunque no trabajes): La ley también te da derecho a ausentarte con sueldo en estas situaciones:\r\n\r\n    - 15 días si te casas o formalizas una pareja de hecho.\r\n\r\n    - 5 días si un familiar cercano (cónyuge, hijo/a, padre, madre, hermano/a) tiene un accidente grave, está hospitalizado/a o le operan.\r\n\r\n    - El tiempo necesario para ir al médico, a exámenes o a citas relacionadas con tu salud, si están fuera de tu horario laboral.\r\n2 días por mudanza.\r\n\r\n    - El tiempo para cumplir con obligaciones ciudadanas obligatorias (como participar en una mesa electoral).\r\n', 4, NULL, 9, ''),
(45, 'Reducir tu jornada para cuidar', 'Un derecho que nadie te puede quitar', 'Si tienes hijos o hijas menores de 12 años, o si cuidas de un familiar que no puede valerse por sí mismo (por enfermedad, edad avanzada o discapacidad), tienes derecho a reducir tu jornada laboral. Esto se llama reducción de jornada por guarda legal.', 1, NULL, 11, ''),
(46, '¿Cuánto puedes reducirla? ', '', 'Entre un octavo y la mitad de tu jornada habitual. Por ejemplo, si trabajas 8 horas, puedes reducirla a entre 1 y 4 horas menos al día. Tu salario se reduce de forma proporcional.\r\n', 2, NULL, 11, ''),
(47, '¿Cómo pedirla?', '', 'Tienes que comunicarlo a la empresa con 15 días de antelación, indicando qué horas quieres trabajar y a partir de cuándo.\r\n', 3, NULL, 11, ''),
(48, '¿Puede la empresa negarse?', '', 'No puede negarse a concederte la reducción en sí, pero sí puede discutir el horario concreto. Si no llegáis a un acuerdo, puedes acudir al Juzgado de lo Social.\r\n', 4, NULL, 11, ''),
(49, 'El permiso por nacimiento', '16 semanas para estar con tu bebé', 'Cuando nace un hijo o una hija (o cuando adoptas o acudes a un acogimiento), tienes derecho a una suspensión del contrato de 16 semanas.\r\n', 5, NULL, 11, ''),
(50, '¿Cómo se distribuyen esas 16 semanas?', '', 'Las 6 primeras semanas después del parto son obligatorias e ininterrumpidas.\r\n\r\nLas 10 semanas restantes puedes disfrutarlas de forma continua o en periodos semanales, hasta que el bebé cumpla 12 meses. Necesitas avisar a la empresa con 15 días de antelación.\r\n\r\nPuedes pedirlo también a tiempo parcial, de acuerdo con la empresa.\r\n', 6, NULL, 11, ''),
(51, '¿Quién paga esas 16 semanas? ', '', 'No es la empresa, sino la Seguridad Social quien te paga el 100% de tu salario durante ese tiempo (si cumples con los requisitos de cotización mínima).', 7, NULL, 11, ''),
(52, '¿Y el otro progenitor?', '', ' Desde 2021, ambos progenitores tienen derecho a las mismas 16 semanas de forma individual e intransferible. No se comparten: cada una tiene su permiso propio.\r\n', 8, NULL, 11, ''),
(53, '¿Y si el bebé nace prematuro o es hospitalizado? ', '', 'Puedes ampliar el permiso hasta un máximo de 13 semanas más si el bebé ha estado hospitalizado más de 7 días por nacer prematuro o con algún problema de salud.\r\n', 9, NULL, 11, ''),
(54, 'Trabajar de noche o en turnos rotativos', 'Más protección para quien trabaja en horarios difíciles', 'Se considera trabajo nocturno el que se realiza entre las 22:00 y las 6:00. Si más de un tercio de tu jornada cae en ese horario, eres considerada trabajadora nocturna y tienes protecciones especiales.\r\n', 1, NULL, 12, ''),
(55, '¿Qué límites existen?', '', 'Las trabajadoras nocturnas no pueden superar las 8 horas diarias de promedio en un período de 15 días.\r\n\r\nSi el trabajo nocturno implica riesgos para tu salud, el límite es de 8 horas estrictas por día, sin posibilidad de compensar.\r\n\r\nLa empresa tiene que hacerte un reconocimiento médico gratuito antes de que empieces a trabajar de noche y, al menos, una vez al año. Si el médico dice que el trabajo nocturno perjudica tu salud, la empresa tiene que ofrecerte un turno de día.', 2, NULL, 12, ''),
(56, '¿Se paga más?', '', 'La ley no fija un precio mínimo por el trabajo nocturno, pero la mayoría de convenios colectivos reconocen un plus o complemento nocturno (generalmente entre un 20%-25% más sobre el salario base). Revisa el convenio de tu sector.\r\n\r\n', 1, NULL, 12, ''),
(57, 'Trabajo a turnos', '', 'Si tu empresa trabaja en turnos rotativos (mañana, tarde y noche que van cambiando), como mínimo cada 15 días debes tener al menos un domingo completo libre.\r\n', 3, NULL, 12, ''),
(58, ' Días libres con sueldo', 'La ley te permite ausentarte en situaciones importantes', 'Los permisos retribuidos son días en los que tienes derecho a no ir a trabajar y seguir cobrando. No son vacaciones: son días adicionales que la ley te garantiza para situaciones concretas de tu vida personal.\r\n', 1, NULL, 10, ''),
(59, 'Estos son los permisos que reconoce actualmente el Estatuto de los Trabajadores (artículo 37):', '', '', 2, NULL, 10, 'tabla.png'),
(60, '¿Qué es un familiar cercano?', '', 'La ley habla de parientes hasta el segundo grado de consanguinidad o afinidad. Eso incluye: tu cónyuge o pareja, tus hijos e hijas, tus padres, tus hermanos y hermanas, tus abuelos y tus nietos.\r\n', 3, NULL, 10, ''),
(61, '¿Cómo pedirlos?', '', 'Debes avisar a la empresa con la mayor antelación posible y justificarlo después (con un certificado médico, de matrimonio, etc.). Si la empresa se niega a darte estos días, puede ser sancionada.\r\n\r\n', 4, NULL, 10, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `icono` varchar(100) DEFAULT NULL,
  `id_madre` int(11) DEFAULT NULL,
  `fecha_actualizacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `titulo`, `descripcion`, `icono`, `id_madre`, `fecha_actualizacion`) VALUES
(1, 'Contratos de Trabajo', 'Guía completa sobre la relación legal entre trabajador y empresario.', 'contrato.jpg', NULL, NULL),
(2, 'Jornada de Trabajo', 'Categoría donde puedes obtener información de cómo son las jornadas de trabajo en España.', 'jornada.jpg', NULL, NULL),
(3, 'Indefinido', 'Lee información sobre este tipo de contrato...', NULL, 1, NULL),
(4, 'Temporal', 'Lee información sobre este tipo de contrato...', NULL, 1, NULL),
(5, 'Formativo', 'Lee información sobre este tipo de contrato...', NULL, 1, NULL),
(6, 'Discontinuo', 'Lee información sobre este tipo de contrato...', NULL, 1, NULL),
(7, 'Jornada Ordinaria', 'Lee información sobre: Jornada Ordinaria.', 'jornada1.jpg', 2, NULL),
(8, 'Horas Extraordinarias', 'Lee información sobre: Horas extraordinarias.', 'extra.jpg', 2, NULL),
(9, 'Vacaciones y Descansos', 'Lee información sobre: Vacaciones y Descansos.', 'vacaciones.jpg', 2, NULL),
(10, 'Permisos retribuidos', 'Lee información sobre: Permisos Retribuidos.', 'permisos.jpg', 2, NULL),
(11, 'Conciliación y Reducción de Jornada', 'Lee información sobre: Conciliación y Reducción de Jornada.', 'reduccion.jpg', 2, NULL),
(12, 'Trabajo Nocturno y a Turnos', 'Lee información sobre: Trabajo Nocturno y a Turnos.', 'nocturnidad.jpg', 2, NULL),
(20, 'Nómina', 'ver infomación', 'img_6a02de766b9d92.92757540.jpg', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contenido`
--

CREATE TABLE `contenido` (
  `id_url` int(11) NOT NULL,
  `url_externas` text DEFAULT NULL,
  `id_bloque` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `faq`
--

CREATE TABLE `faq` (
  `id_faq` int(11) NOT NULL,
  `pregunta` varchar(255) NOT NULL,
  `respuesta` text NOT NULL,
  `fecha_actualizacion` date DEFAULT NULL,
  `id_categoria` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `faq`
--

INSERT INTO `faq` (`id_faq`, `pregunta`, `respuesta`, `fecha_actualizacion`, `id_categoria`) VALUES
(1, '¿Tengo que firmar el contrato antes de empezar a trabajar?', 'Sí. Lo ideal es que firmes el contrato antes de incorporarte. Si ya estás trabajando y no te han dado nada que firmar, la ley te protege: se entiende que tienes un contrato indefinido y a jornada completa desde el primer día.', '2026-05-11', 1),
(2, '¿Qué pasa si firmo algo que no entiendo?', 'Nunca debes firmar nada que no comprendas. Tienes derecho a pedir una copia del contrato y leerlo con calma en casa, o pedir ayuda a alguien de confianza. Si ya firmaste y detectas algo irregular, puedes acudir a un sindicato o a la Inspección de Trabajo.', '2026-05-11', 1),
(3, '¿Me pueden bajar el sueldo si lo pone en el contrato?', 'No. Aunque el contrato lo recoja, ninguna empresa puede fijar un salario por debajo del Salario Mínimo Interprofesional (SMI) ni del que marque tu convenio colectivo. En 2026 el SMI es de 1.221 € mensuales en 14 pagas. Esa cantidad es un derecho irrenunciable.', '2026-05-11', 1),
(4, '¿Tengo derecho a vacaciones aunque el contrato no las mencione?', 'Sí. Las vacaciones son un derecho legal mínimo de 30 días naturales al año. Aunque el contrato no las mencione, te corresponden igualmente. Ningún acuerdo puede eliminarlas ni sustituirlas por dinero mientras la relación laboral esté activa.', '2026-05-11', 1),
(5, '¿Cuántas horas puedo trabajar como máximo a la semana?', 'La jornada ordinaria máxima es de 40 horas semanales de promedio anual. Además, en un solo día no puedes superar las 9 horas de trabajo efectivo como norma general, y entre el final de una jornada y el inicio de la siguiente deben pasar al menos 12 horas.', '2026-05-11', 2),
(6, '¿Pueden obligarme a hacer horas extra?', 'No, salvo que el convenio colectivo o tu contrato lo establezcan expresamente, las horas extraordinarias son voluntarias. El número máximo es de 80 horas al año. Deben pagarse o compensarse con descanso, y han de quedar registradas.', '2026-05-11', 2),
(7, '¿A cuántos días de vacaciones tengo derecho?', 'Como mínimo a 30 días naturales al año, lo que equivale a 2,5 días por cada mes trabajado. Las vacaciones deben disfrutarse dentro del año y no pueden sustituirse por dinero mientras el contrato esté vigente.', '2026-05-11', 2),
(8, '¿Tengo derecho a desconectarme fuera de mi horario?', 'Sí. La Ley te reconoce el derecho a la desconexión digital. Al acabar tu jornada no tienes ninguna obligación de contestar llamadas, correos ni mensajes de trabajo. Tu tiempo libre es tuyo.', '2026-05-11', 2),
(9, '¿Qué es exactamente un contrato indefinido?', 'Es el contrato \"para siempre\". No tiene fecha de finalización prevista. Permanecerás vinculada a la empresa de forma estable hasta que decidas marcharte, te jubiles o se produzca una causa legal de despido. Desde 2022 es la modalidad de referencia en España.', '2026-05-11', 3),
(10, '¿Cuánto me tienen que pagar si me despiden con contrato indefinido?', 'Depende del tipo de despido. Si es un despido improcedente (sin causa justificada), tienes derecho a 33 días de salario por cada año trabajado. Si es por causas objetivas válidas, la indemnización es de 20 días por año trabajado.', '2026-05-11', 3),
(11, '¿Cuántas semanas de baja por maternidad tengo en 2026?', 'En 2026 dispones de 19 semanas totales de permiso por nacimiento. Las 6 primeras semanas tras el parto son obligatorias e ininterrumpidas. Las 13 semanas restantes puedes disfrutarlas de forma flexible antes de que tu bebé cumpla un año.', '2026-05-11', 3),
(12, '¿Me pueden reducir las vacaciones con el contrato indefinido?', 'No. Las vacaciones mínimas de 30 días naturales anuales son un derecho irrenunciable. Ningún contrato, aunque sea indefinido, puede reducirlas. Además, no pueden canjearse por dinero mientras la relación laboral esté activa.', '2026-05-11', 3),
(13, '¿En qué casos pueden contratarme de forma temporal?', 'Solo en dos supuestos: por circunstancias de la producción (aumento imprevisto de trabajo, máximo 6 meses ampliables a 1 año según convenio) o para sustituir a otra trabajadora en baja, vacaciones o permiso de maternidad. Fuera de estos casos, el contrato se considera indefinido.', '2026-05-11', 4),
(14, '¿Cuándo me convierto en fija aunque tenga contrato temporal?', 'Si en un periodo de 24 meses has estado contratada más de 18 meses mediante dos o más contratos temporales, adquieres automáticamente la condición de trabajadora fija, con todos los derechos que ello conlleva.', '2026-05-11', 4),
(15, '¿Tengo las mismas vacaciones que una trabajadora fija?', 'Sí. Como trabajadora temporal tienes exactamente los mismos derechos: mínimo 30 días naturales de vacaciones al año (2,5 días por mes trabajado), jornada máxima de 40 horas semanales y un descanso mínimo de 12 horas entre jornadas.', '2026-05-11', 4),
(16, '¿Qué ocurre si mi empresa me contrata temporalmente sin causa real?', 'Se considera fraude de ley. Si la empresa no puede justificar una de las dos causas permitidas, tu contrato se convierte automáticamente en indefinido ordinario desde el primer día, con todos los derechos de estabilidad que eso implica.', '2026-05-11', 4),
(17, '¿Qué tipos de contrato formativo existen en 2026?', 'Hay dos modalidades: el contrato de formación en alternancia (para quienes aún están estudiando y combinan el aula con el trabajo) y el contrato para la obtención de práctica profesional (para quienes ya tienen un título universitario o de FP y buscan su primera experiencia relacionada con su formación).', '2026-05-11', 5),
(18, '¿Cuánto debo cobrar con un contrato de prácticas?', 'Con el contrato de práctica profesional cobrarás lo que fije el convenio de tu categoría, pero nunca por debajo del SMI, que en 2026 es de 1.221 € mensuales. En alternancia, el mínimo es el 60% del convenio el primer año y el 75% el segundo.', '2026-05-11', 5),
(19, '¿Tengo derecho a paro al terminar un contrato formativo?', 'Sí. Desde la reforma laboral, las trabajadoras con contrato formativo tienen protección completa de la Seguridad Social, incluyendo la prestación por desempleo, siempre que reúnas los requisitos de cotización necesarios.', '2026-05-11', 5),
(20, '¿Pueden ponerme un nuevo periodo de prueba al terminar las prácticas si me contratan fija?', 'No. Si al finalizar tu contrato formativo la empresa decide contratarte de forma indefinida, no puede imponerte un nuevo periodo de prueba. Se entiende que durante la etapa formativa ya has demostrado tus capacidades.', '2026-05-11', 5),
(21, '¿El contrato fijo-discontinuo es realmente indefinido?', 'Sí. Aunque trabajes solo en determinadas temporadas, eres una trabajadora fija. La relación laboral no se rompe entre temporadas, simplemente queda en pausa. Esto te da derecho a que te llamen cada vez que se reinicie la actividad.', '2026-05-11', 6),
(22, '¿Puedo cobrar el paro entre temporadas?', 'Sí. Durante los periodos de inactividad, aunque tu contrato sigue vigente, puedes solicitar y cobrar la prestación por desempleo si cumples los requisitos de cotización. La empresa no te paga durante ese tiempo, pero la Seguridad Social te cubre.', '2026-05-11', 6),
(23, '¿Cómo me tienen que avisar cuando empieza la temporada?', 'Mediante un llamamiento formal, por escrito o por un medio que deje constancia (como un correo electrónico). La empresa debe respetar un orden objetivo (normalmente por antigüedad). Si reinicia la actividad sin avisarte cuando te corresponde, puedes reclamarlo como un despido.', '2026-05-11', 6),
(24, '¿Cuánto me pagarían si me despiden de forma definitiva?', 'Si la empresa decide finalizar tu relación laboral de forma definitiva sin causa justificada, tienes derecho a 33 días de salario por cada año trabajado. Eso sí, para calcular esta indemnización solo cuentan los periodos en los que efectivamente prestaste servicios.', '2026-05-11', 6),
(25, '¿Está obligada la empresa a registrar mi horario?', 'Sí, es obligatorio. La empresa debe registrar diariamente tu hora de entrada y de salida. Este registro te protege frente a posibles abusos y es la prueba que necesitas si alguna vez tienes que reclamar horas no pagadas.', '2026-05-11', 7),
(26, '¿Cuántas horas de descanso tengo entre jornada y jornada?', 'Como mínimo 12 horas entre el final de una jornada y el inicio de la siguiente. Además, tienes derecho a un descanso semanal mínimo de día y medio ininterrumpido.', '2026-05-11', 7),
(27, '¿Pueden obligarme a hacer horas extraordinarias?', 'No, salvo que tu convenio o contrato lo contemple expresamente. Las horas extra son voluntarias. El máximo legal es de 80 horas al año y deben quedar registradas.', '2026-05-11', 8),
(28, '¿Cómo se compensan las horas extraordinarias?', 'Pueden pagarse económicamente (con un recargo sobre la hora ordinaria según convenio) o compensarse con tiempo de descanso equivalente. Lo habitual es que el convenio de tu sector fije el modo de compensación.', '2026-05-11', 8),
(29, '¿Cuántos días de vacaciones me corresponden?', 'Un mínimo de 30 días naturales al año, equivalente a 2,5 días por cada mes trabajado. Tu convenio colectivo puede mejorar este mínimo. Las vacaciones no pueden sustituirse por dinero mientras el contrato esté vigente.', '2026-05-11', 9),
(30, '¿Puede la empresa cambiarme las vacaciones sin avisarme?', 'No. Los periodos de vacaciones se pactan entre empresa y trabajadora. La empresa debe avisarte con suficiente antelación. Si te las cambia de forma unilateral y sin justificación, puedes reclamar ante la Inspección de Trabajo.', '2026-05-11', 9),
(31, '¿Qué es un permiso retribuido?', 'Es un permiso en el que puedes ausentarte del trabajo con causa justificada sin perder tu salario. La ley reconoce permisos por matrimonio, nacimiento, fallecimiento de familiar, traslado de domicilio o examen, entre otros.', '2026-05-11', 10),
(32, '¿Tengo que justificar siempre los permisos?', 'Sí. Debes comunicarlo a la empresa lo antes posible y aportar el justificante correspondiente (libro de familia, certificado médico, etc.). Si no lo justificas, la empresa puede descontarte los días de tu salario.', '2026-05-11', 10),
(33, '¿Puedo reducir mi jornada para cuidar a mi hija o hijo?', 'Sí. Tienes derecho a reducir tu jornada entre un octavo y la mitad si tienes a tu cargo hijos o hijas menores de 12 años, familiares dependientes o personas con discapacidad. La reducción lleva aparejada una disminución proporcional del salario.', '2026-05-11', 11),
(34, '¿El teletrabajo es siempre voluntario?', 'Sí. El trabajo a distancia debe acordarse siempre por escrito y de forma voluntaria. La empresa no puede imponértelo unilateralmente, y si lo aceptas, tienes los mismos derechos que en la oficina: la empresa debe proporcionarte los equipos necesarios.', '2026-05-11', 11),
(35, '¿Qué se considera trabajo nocturno?', 'Se considera trabajo nocturno el realizado entre las 22:00 y las 06:00 horas. Las trabajadoras nocturnas tienen derecho a una retribución específica (plus de nocturnidad) o a una reducción de jornada equivalente, según lo que establezca el convenio colectivo.', '2026-05-11', 12),
(36, '¿Puedo negarme a trabajar en turno de noche por razones de salud?', 'Sí. Si tu médica certifica que el trabajo nocturno perjudica tu salud, la empresa está obligada a trasladarte a un puesto diurno que esté disponible, aunque sea de categoría diferente, siempre que no suponga una pérdida salarial.', '2026-05-11', 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id_rol` int(11) NOT NULL,
  `nombre_rol` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_rol`, `nombre_rol`) VALUES
(1, 'admin'),
(2, 'usuaria');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `id_rol` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `email`, `password`, `nombre`, `id_rol`) VALUES
(1, 'admin', '123', 'admin', 1),
(2, 'hardsand11@gmail.com', 'haroldyn138', 'Harold', 1),
(11, 'erikamedimundo@gmail.com', '123', 'Erika', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bloque`
--
ALTER TABLE `bloque`
  ADD PRIMARY KEY (`id_bloque`),
  ADD KEY `fk_bloque_categoria` (`id_categoria`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`),
  ADD KEY `fk_categoria_madre` (`id_madre`);

--
-- Indices de la tabla `contenido`
--
ALTER TABLE `contenido`
  ADD PRIMARY KEY (`id_url`),
  ADD KEY `fk_contenido_bloque` (`id_bloque`);

--
-- Indices de la tabla `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id_faq`),
  ADD KEY `fk_faq_categoria` (`id_categoria`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_usuario_rol` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bloque`
--
ALTER TABLE `bloque`
  MODIFY `id_bloque` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `contenido`
--
ALTER TABLE `contenido`
  MODIFY `id_url` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `faq`
--
ALTER TABLE `faq`
  MODIFY `id_faq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `bloque`
--
ALTER TABLE `bloque`
  ADD CONSTRAINT `fk_bloque_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`) ON DELETE CASCADE;

--
-- Filtros para la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD CONSTRAINT `fk_categoria_madre` FOREIGN KEY (`id_madre`) REFERENCES `categoria` (`id_categoria`) ON DELETE CASCADE;

--
-- Filtros para la tabla `contenido`
--
ALTER TABLE `contenido`
  ADD CONSTRAINT `fk_contenido_bloque` FOREIGN KEY (`id_bloque`) REFERENCES `bloque` (`id_bloque`) ON DELETE CASCADE;

--
-- Filtros para la tabla `faq`
--
ALTER TABLE `faq`
  ADD CONSTRAINT `fk_faq_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`) ON DELETE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_usuario_rol` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
