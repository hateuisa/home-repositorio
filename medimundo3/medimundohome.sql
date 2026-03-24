-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 07-03-2026 a las 22:25:35
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

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
  `id_categoria` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `bloque`
--

INSERT INTO `bloque` (`id_bloque`, `titulo`, `subtitulo`, `contenido`, `orden`, `fecha_actualizacion`, `id_categoria`) VALUES
(4, 'Indefinido', 'Lee información sobre este tipo de contrato.', NULL, 4, NULL, 1),
(5, 'Temporal', 'Lee información sobre este tipo de contrato.', NULL, 5, NULL, 1),
(6, 'Formativo', 'Lee información sobre este tipo de contrato.', NULL, 6, NULL, 1),
(7, 'Discontinuo', 'Lee información sobre este tipo de contrato.', NULL, 7, NULL, 1);

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
(1, 'Contratos de Trabajo', 'Guía completa sobre la relación legal entre trabajador y empresario.', 'contrato.jpg', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contenido`
--

CREATE TABLE `contenido` (
  `id_url` int(11) NOT NULL,
  `url_externas` text DEFAULT NULL,
  `id_bloque` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `contenido`
--

INSERT INTO `contenido` (`id_url`, `url_externas`, `id_bloque`) VALUES
(12, 'Descripción: El contrato estándar de 2026 que garantiza estabilidad indefinida.*\r\nDuración: No tiene fecha de fin; se presume que la relación laboral es permanente.*\r\nSalario: Según convenio en Zaragoza, nunca inferior al SMI vigente (aprox. 1.300€ en 2026).*\r\nJornada: Completa (40h) o parcial, con registro obligatorio de jornada digital.*\r\nIndemnización: 33 días por año trabajado en caso de despido improcedente.*\r\nVacaciones: Mínimo 30 días naturales por año trabajado.', 4),
(13, 'Descripción: Solo por circunstancias de producción muy específicas o sustituciones.*\r\nDuración: Máximo 6 meses (ampliable a 12 por convenio). Si se supera, pasas a ser fijo.*\r\nSalario: Idéntico al de un trabajador indefinido en el mismo puesto; sin discriminación.*\r\nJornada: Puede ser jornada completa o parcial, detallando la causa de la temporalidad.*\r\nIndemnización: 12 días por cada año trabajado al finalizar el contrato.*\r\nVacaciones: Proporcionales al tiempo trabajado; se pagan en el finiquito si no se disfrutan.', 5),
(14, 'Descripción: Para obtener práctica profesional tras titularte o durante los estudios.*\r\nDuración: Mínimo 6 meses y máximo 1 año para prácticas profesionales.*\r\nSalario: No inferior al SMI proporcional; suele ser el 60% el primer año según convenio.*\r\nJornada: Limitada para permitir la formación; prohibidas las horas extras y nocturnidad.*\r\nIndemnización: No conlleva indemnización por fin de contrato, pero sí cotiza para paro.*\r\nVacaciones: Tienes los mismos derechos de descanso que cualquier otro trabajador.', 6),
(15, 'Descripción: Para trabajos de temporada (logística en PLAZA o hostelería) pero con contrato fijo.*\r\nDuración: Indefinida, pero con periodos de inactividad intermitentes.*\r\nSalario: Cobras por el tiempo de actividad efectiva; generas derecho a paro en la inactividad.*\r\nJornada: Se garantiza un número mínimo de horas al año según el acuerdo de llamamiento.*\r\nIndemnización: En caso de despido, se calcula sobre los años de antigüedad (años naturales).*\r\nVacaciones: Se disfrutan durante el periodo de actividad o se liquidan al final de la misma.', 7);

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id_rol` int(11) NOT NULL,
  `nombre_rol` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  MODIFY `id_bloque` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `contenido`
--
ALTER TABLE `contenido`
  MODIFY `id_url` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `faq`
--
ALTER TABLE `faq`
  MODIFY `id_faq` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT;

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
