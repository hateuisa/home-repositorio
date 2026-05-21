<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recursos — Médicos del Mundo</title>
    <link rel="stylesheet" href="estilos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>

    <?php include 'header.php'; ?>

    <main class="contenido-main">

        <div class="contenido-cabecera">
            <h1 class="contenido-titulo">Recursos</h1>
            <p class="contenido-subtitulo">Normativa, enlaces y herramientas de referencia para trabajadores y voluntarios</p>
        </div>

        <!--  BLOQUE 1: Médicos del Mundo  -->
        <section class="recursos-seccion">
            <h2 class="recursos-seccion-titulo">
                Médicos del Mundo
            </h2>
            <div class="contenido-grid">

                <a href="https://www.medicosdelmundo.org" target="_blank" rel="noopener" class="info-tarjeta recurso-enlace">
                    <div class="info-tarjeta-cuerpo">
                        <p class="info-tarjeta-titulo">Página oficial</p>
                        <p class="info-tarjeta-texto">Web principal de Médicos del Mundo España con proyectos, noticias y memoria anual.</p>
                        <span class="recurso-tag">medicosdelmundo.org</span>
                    </div>
                </a>

                <a href="https://www.medicosdelmundo.org/quienes-somos/estatutos" target="_blank" rel="noopener" class="info-tarjeta recurso-enlace">
                    <div class="info-tarjeta-cuerpo">
                        <p class="info-tarjeta-titulo">Estatutos de la organización</p>
                        <p class="info-tarjeta-texto">Documento fundacional de Médicos del Mundo: estructura, órganos de gobierno y misión.</p>
                        <span class="recurso-tag">Documentación interna</span>
                    </div>
                </a>

                <a href="https://www.medicosdelmundo.org/codigo-conducta" target="_blank" rel="noopener" class="info-tarjeta recurso-enlace">
                    <div class="info-tarjeta-cuerpo">
                        <p class="info-tarjeta-titulo">Código de conducta</p>
                        <p class="info-tarjeta-texto">Principios éticos y normas de comportamiento para personal y voluntariado de la organización.</p>
                        <span class="recurso-tag">Ética y valores</span>
                    </div>
                </a>

                <a href="https://www.medicosdelmundo.org/voluntariado" target="_blank" rel="noopener" class="info-tarjeta recurso-enlace">
                    <div class="info-tarjeta-cuerpo">
                        <p class="info-tarjeta-titulo">Voluntariado</p>
                        <p class="info-tarjeta-texto">Información sobre cómo unirte como voluntario/a, convocatorias abiertas y requisitos.</p>
                        <span class="recurso-tag">Participación</span>
                    </div>
                </a>

            </div>
        </section>

        <!--  BLOQUE 2: Legislación laboral  -->
        <section class="recursos-seccion">
            <h2 class="recursos-seccion-titulo">
                Legislación laboral
            </h2>
            <div class="contenido-grid">

                <a href="https://www.boe.es/buscar/act.php?id=BOE-A-2015-11430" target="_blank" rel="noopener" class="info-tarjeta recurso-enlace">
                    <div class="info-tarjeta-cuerpo">
                        <p class="info-tarjeta-titulo">Estatuto de los Trabajadores</p>
                        <p class="info-tarjeta-texto">Texto refundido vigente. Derechos, deberes, contratos, jornada, salario y extinción de la relación laboral.</p>
                        <span class="recurso-tag">BOE — Real Decreto Legislativo 2/2015</span>
                    </div>
                </a>

                <a href="https://www.boe.es/buscar/act.php?id=BOE-A-1995-24292" target="_blank" rel="noopener" class="info-tarjeta recurso-enlace">
                    <div class="info-tarjeta-cuerpo">
                        <p class="info-tarjeta-titulo">Ley de Prevención de Riesgos Laborales</p>
                        <p class="info-tarjeta-texto">Normativa de seguridad en el trabajo, obligaciones del empresario y derechos de los trabajadores en materia de salud laboral.</p>
                        <span class="recurso-tag">BOE — Ley 31/1995</span>
                    </div>
                </a>

                <a href="https://www.boe.es/buscar/act.php?id=BOE-A-2007-6115" target="_blank" rel="noopener" class="info-tarjeta recurso-enlace">
                    <div class="info-tarjeta-cuerpo">
                        <p class="info-tarjeta-titulo">Ley de Igualdad</p>
                        <p class="info-tarjeta-texto">Ley Orgánica para la igualdad efectiva de mujeres y hombres. Incluye regulación de permisos, conciliación y planes de igualdad.</p>
                        <span class="recurso-tag">BOE — LO 3/2007</span>
                    </div>
                </a>

                <a href="https://www.boe.es/buscar/act.php?id=BOE-A-1999-21568" target="_blank" rel="noopener" class="info-tarjeta recurso-enlace">
                    <div class="info-tarjeta-cuerpo">
                        <p class="info-tarjeta-titulo">Ley de Conciliación Familiar</p>
                        <p class="info-tarjeta-texto">Regulación de permisos por maternidad, paternidad, lactancia y reducción de jornada por cuidado de hijos o familiares.</p>
                        <span class="recurso-tag">BOE — Ley 39/1999</span>
                    </div>
                </a>

                <a href="https://www.boe.es/diario_boe/txt.php?id=BOE-A-2021-9613" target="_blank" rel="noopener" class="info-tarjeta recurso-enlace">
                    <div class="info-tarjeta-cuerpo">
                        <p class="info-tarjeta-titulo">Reforma Laboral 2021</p>
                        <p class="info-tarjeta-texto">Real Decreto-ley 32/2021: nueva regulación de contratos temporales, fijos discontinuos y negociación colectiva.</p>
                        <span class="recurso-tag">BOE — RDL 32/2021</span>
                    </div>
                </a>

                <a href="https://www.boe.es/buscar/act.php?id=BOE-A-2011-15936" target="_blank" rel="noopener" class="info-tarjeta recurso-enlace">
                    <div class="info-tarjeta-cuerpo">
                        <p class="info-tarjeta-titulo">Ley de Empleo</p>
                        <p class="info-tarjeta-texto">Regula el Sistema Nacional de Empleo, los servicios públicos de empleo, colocación y bonificaciones.</p>
                        <span class="recurso-tag">BOE — Ley 3/2023</span>
                    </div>
                </a>

            </div>
        </section>

        <!--  BLOQUE 3: Organismos de referencia  -->
        <section class="recursos-seccion">
            <h2 class="recursos-seccion-titulo">
                Organismos oficiales
            </h2>
            <div class="contenido-grid">

                <a href="https://www.mites.gob.es" target="_blank" rel="noopener" class="info-tarjeta recurso-enlace">
                    <div class="info-tarjeta-cuerpo">
                        <p class="info-tarjeta-titulo">Ministerio de Trabajo</p>
                        <p class="info-tarjeta-texto">Legislación laboral actualizada, normativa de empleo, relaciones laborales y condiciones de trabajo.</p>
                        <span class="recurso-tag">mites.gob.es</span>
                    </div>
                </a>

                <a href="https://www.sepe.es" target="_blank" rel="noopener" class="info-tarjeta recurso-enlace">
                    <div class="info-tarjeta-cuerpo">
                        <p class="info-tarjeta-titulo">SEPE</p>
                        <p class="info-tarjeta-texto">Servicio Público de Empleo Estatal. Prestaciones por desempleo, ERTEs, ERTE por fuerza mayor y certificados.</p>
                        <span class="recurso-tag">sepe.es</span>
                    </div>
                </a>

                <a href="https://www.seg-social.es" target="_blank" rel="noopener" class="info-tarjeta recurso-enlace">
                    <div class="info-tarjeta-cuerpo">
                        <p class="info-tarjeta-titulo">Seguridad Social</p>
                        <p class="info-tarjeta-texto">Consulta de altas, bajas, cotizaciones, vida laboral, pensiones y prestaciones de la Seguridad Social.</p>
                        <span class="recurso-tag">seg-social.es</span>
                    </div>
                </a>

                <a href="https://www.itss.es" target="_blank" rel="noopener" class="info-tarjeta recurso-enlace">
                    <div class="info-tarjeta-cuerpo">
                        <p class="info-tarjeta-titulo">Inspección de Trabajo</p>
                        <p class="info-tarjeta-texto">Denuncia de irregularidades laborales, consulta de infracciones y guías de actuación para trabajadores.</p>
                        <span class="recurso-tag">itss.es</span>
                    </div>
                </a>

                <a href="https://www.boe.es" target="_blank" rel="noopener" class="info-tarjeta recurso-enlace">
                    <div class="info-tarjeta-cuerpo">
                        <p class="info-tarjeta-titulo">BOE — Boletín Oficial del Estado</p>
                        <p class="info-tarjeta-texto">Buscador de normativa vigente, leyes, decretos y resoluciones publicadas en el boletín oficial.</p>
                        <span class="recurso-tag">boe.es</span>
                    </div>
                </a>

                <a href="https://www.fundae.es" target="_blank" rel="noopener" class="info-tarjeta recurso-enlace">
                    <div class="info-tarjeta-cuerpo">
                        <p class="info-tarjeta-titulo">FUNDAE — Formación bonificada</p>
                        <p class="info-tarjeta-texto">Gestión de la formación profesional para el empleo y bonificaciones disponibles para empresas y trabajadores.</p>
                        <span class="recurso-tag">fundae.es</span>
                    </div>
                </a>

            </div>
        </section>

        <!--  BLOQUE 4: Herramientas prácticas  -->
        <section class="recursos-seccion">
            <h2 class="recursos-seccion-titulo">
                Herramientas prácticas
            </h2>
            <div class="contenido-grid">

                <a href="https://www.seg-social.es/wps/portal/wss/internet/Trabajadores/Cotizacion/36537" target="_blank" rel="noopener" class="info-tarjeta recurso-enlace">
                    <div class="info-tarjeta-cuerpo">
                        <p class="info-tarjeta-titulo">Vida laboral</p>
                        <p class="info-tarjeta-texto">Consulta y descarga de tu informe de vida laboral directamente desde la Seguridad Social.</p>
                        <span class="recurso-tag">Seguridad Social</span>
                    </div>
                </a>

                <a href="https://www.boe.es/diario_boe/" target="_blank" rel="noopener" class="info-tarjeta recurso-enlace">
                    <div class="info-tarjeta-cuerpo">
                        <p class="info-tarjeta-titulo">Calendario laboral oficial</p>
                        <p class="info-tarjeta-titulo-sub">BOE diario</p>
                        <p class="info-tarjeta-texto">Consulta el calendario laboral estatal y autonómico publicado anualmente en el BOE.</p>
                        <span class="recurso-tag">BOE</span>
                    </div>
                </a>

                <a href="https://www.ccoo.es/calculadora-finiquito/" target="_blank" rel="noopener" class="info-tarjeta recurso-enlace">
                    <div class="info-tarjeta-cuerpo">
                        <p class="info-tarjeta-titulo">Calculadora de finiquito</p>
                        <p class="info-tarjeta-texto">Estima el importe de tu finiquito en función del tipo de contrato, salario y motivo de extinción.</p>
                        <span class="recurso-tag">CCOO</span>
                    </div>
                </a>

                <a href="https://sede.sepe.gob.es/contenidosSede/generico.do?pagina=aplicaciones/ba/ba010" target="_blank" rel="noopener" class="info-tarjeta recurso-enlace">
                    <div class="info-tarjeta-cuerpo">
                        <p class="info-tarjeta-titulo">Solicitud de prestación por desempleo</p>
                        <p class="info-tarjeta-texto">Trámite online para solicitar el paro, consultar el estado de tu prestación y gestionar citas con el SEPE.</p>
                        <span class="recurso-tag">SEPE — Sede electrónica</span>
                    </div>
                </a>

            </div>
        </section>

        <a href="index.php" class="contenido-volver">← Volver al inicio</a>

    </main>
    <?php include 'footer.php'; ?>

</body>
</html>