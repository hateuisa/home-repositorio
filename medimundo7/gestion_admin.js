// ════════════════════════════════════════════════════════════
//  gestion_admin.js — Modales, edición y confirmación eliminar
// ════════════════════════════════════════════════════════════

// ── Abrir modal genérico ─────────────────────────────────────
function abrirModal(id) {
    var modal = document.getElementById(id);
    if (modal) modal.classList.add('abierto');
}

// ── Cerrar modal genérico ────────────────────────────────────
function cerrarModal(id) {
    var modal = document.getElementById(id);
    if (modal) modal.classList.remove('abierto');
}

// ── Cerrar al hacer clic en el fondo ────────────────────────
document.addEventListener('click', function (e) {
    if (e.target.classList.contains('modal-fondo')) {
        e.target.classList.remove('abierto');
    }
});

// ── Cerrar con ESC ───────────────────────────────────────────
document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') {
        document.querySelectorAll('.modal-fondo.abierto').forEach(function (m) {
            m.classList.remove('abierto');
        });
    }
});

// ── Previsualizar imagen seleccionada ────────────────────────
function previsualizarImagen(input, imgId) {
    var img = document.getElementById(imgId);
    if (!img) return;
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            img.src = e.target.result;
            img.style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
    }
}

// ── Mostrar imagen actual en modal editar ────────────────────
function mostrarImagenActual(imgId, nombreArchivo) {
    var img = document.getElementById(imgId);
    if (!img) return;
    if (nombreArchivo) {
        img.src = 'img/' + nombreArchivo;
        img.style.display = 'block';
        img.onerror = function () { img.style.display = 'none'; };
    } else {
        img.style.display = 'none';
    }
}

// ── Abrir modal de edición y rellenar campos ─────────────────
function abrirEditar(idModal, datos) {
    var modal = document.getElementById(idModal);
    if (!modal) return;

    var mapas = {
        'modal-editar-usuario': {
            'eu-id':     'id_usuario',
            'eu-nombre': 'nombre',
            'eu-email':  'email',
            'eu-rol':    'id_rol'
        },
        'modal-editar-cat': {
            'ec-id':           'id_categoria',
            'ec-titulo':       'titulo',
            'ec-desc':         'descripcion',
            'ec-icono-actual': 'icono'
        },
        'modal-editar-subcat': {
            'es-id':           'id_subcategoria',
            'es-titulo':       'titulo',
            'es-desc':         'descripcion',
            'es-icono-actual': 'icono',
            'es-madre':        'id_madre'
        },
        'modal-editar-faq': {
            'ef-id':   'id_faq',
            'ef-preg': 'pregunta',
            'ef-resp': 'respuesta',
            'ef-cat':  'id_categoria'
        }
    };

    var mapa = mapas[idModal];
    if (mapa) {
        Object.keys(mapa).forEach(function (campoId) {
            var el = document.getElementById(campoId);
            if (el && datos[mapa[campoId]] !== undefined) {
                el.value = datos[mapa[campoId]];
            }
        });
    }

    // Mostrar imagen actual según el modal
    if (idModal === 'modal-editar-cat') {
        mostrarImagenActual('prev-ec-icono', datos.icono || '');
    } else if (idModal === 'modal-editar-subcat') {
        mostrarImagenActual('prev-es-icono', datos.icono || '');
    }

    modal.classList.add('abierto');
}

// ── Confirmar eliminación ────────────────────────────────────
function confirmarEliminar(formId, idValor, nombre) {
    var form = document.getElementById(formId);
    if (!form) return;

    var inputs = form.querySelectorAll('input[type="hidden"]');
    inputs.forEach(function (input) {
        if (input.name !== 'accion') input.value = idValor;
    });

    var label = document.getElementById('del-nombre-label');
    if (label) label.textContent = nombre;

    var btnConfirmar = document.getElementById('btn-confirmar-del');
    if (btnConfirmar) {
        var nuevo = btnConfirmar.cloneNode(true);
        btnConfirmar.parentNode.replaceChild(nuevo, btnConfirmar);
        nuevo.addEventListener('click', function () { form.submit(); });
    }

    abrirModal('modal-confirmar-eliminar');
}

// ── Auto-cerrar alertas tras 4s ──────────────────────────────
document.addEventListener('DOMContentLoaded', function () {
    var alerta = document.querySelector('.alerta');
    if (alerta) {
        setTimeout(function () {
            alerta.style.transition = 'opacity 0.5s';
            alerta.style.opacity = '0';
            setTimeout(function () { alerta.remove(); }, 500);
        }, 4000);
    }
});

// ── Abrir modal editar bloque (vía data-* para evitar rotura por saltos de línea) ──
function abrirEditarBloque(btn) {
    document.getElementById('eb-id').value           = btn.dataset.id;
    document.getElementById('eb-titulo').value       = btn.dataset.titulo;
    document.getElementById('eb-sub').value          = btn.dataset.subtitulo;
    document.getElementById('eb-cont').value         = btn.dataset.contenido;
    document.getElementById('eb-orden').value        = btn.dataset.orden;
    document.getElementById('eb-icono-actual').value = btn.dataset.icono;
    document.getElementById('eb-cat').value          = btn.dataset.categoria;

    // Mostrar imagen actual del bloque
    mostrarImagenActual('prev-eb-icono', btn.dataset.icono || '');

    abrirModal('modal-editar-bloque');
}