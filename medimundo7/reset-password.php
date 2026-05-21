<?php
$conn = new mysqli("localhost", "root", "", "medimundohome");

if ($conn->connect_error) {
    die("Error de conexión");
}

$token = $_GET["token"] ?? "";

if (empty($token)) {
    die("Enlace no válido.");
}

// Verifica que el token existe y no ha expirado
$stmt = $conn->prepare(
    "SELECT id_usuario FROM usuarios 
     WHERE reset_token = ? AND reset_expiry > NOW()"
);
$stmt->bind_param("s", $token);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    $token_invalido = true;
}

$mensaje = "";
$error   = "";

if (!isset($token_invalido) && $_SERVER["REQUEST_METHOD"] == "POST") {

    $password        = $_POST["password"] ?? "";
    $password_repeat = $_POST["password_repeat"] ?? "";

    if (empty($password) || strlen($password) < 6) {
        $error = "La contraseña debe tener al menos 6 caracteres.";
    } elseif ($password !== $password_repeat) {
        $error = "Las contraseñas no coinciden.";
    } else {
        $nueva = password_hash($password, PASSWORD_BCRYPT);

        $stmt2 = $conn->prepare(
            "UPDATE usuarios 
             SET password = ?, reset_token = NULL, reset_expiry = NULL 
             WHERE reset_token = ?"
        );
        $stmt2->bind_param("ss", $nueva, $token);
        $stmt2->execute();

        $cambiado = true;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Nueva contraseña — MediMundo</title>
<link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="estilos1.css">

</head>
<body>

<div class="card <?= isset($cambiado) ? 'success' : '' ?>">

<?php if (isset($token_invalido)): ?>

  <!-- Token inválido o expirado -->
  <div class="icon-wrap">
    <svg viewBox="0 0 24 24" fill="none" stroke="var(--red)" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
      <circle cx="12" cy="12" r="10"/>
      <line x1="12" y1="8" x2="12" y2="12"/>
      <line x1="12" y1="16" x2="12.01" y2="16"/>
    </svg>
  </div>
  <h1>Enlace <em>expirado</em></h1>
  <p class="subtitle">Este enlace no es válido o ha caducado. Solicita uno nuevo.</p>
  <div class="alert-invalid">
    Los enlaces de recuperación expiran tras <strong>1 hora</strong> por seguridad.
  </div>
  <a href="recuperar_pass.php" class="back-link">← Solicitar nuevo enlace</a>

<?php elseif (isset($cambiado)): ?>

  <!-- Contraseña cambiada con éxito -->
  <div class="icon-wrap green">
    <svg viewBox="0 0 24 24" fill="none" stroke="var(--green)" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
      <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
      <polyline points="22 4 12 14.01 9 11.01"/>
    </svg>
  </div>
  <h1>¡Contraseña <em class="green">actualizada!</em></h1>
  <p class="subtitle">Tu contraseña se ha cambiado correctamente. Ya puedes iniciar sesión.</p>
  <a href="login.php" class="back-link" style="margin-top:0">
    Ir a <span class="green">iniciar sesión</span> →
  </a>

<?php else: ?>

  <!-- Formulario nueva contraseña -->
  <div class="icon-wrap">
    <svg viewBox="0 0 24 24" fill="none" stroke="var(--red)" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
      <rect x="3" y="11" width="18" height="11" rx="2"/>
      <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
    </svg>
  </div>

  <h1>Nueva <em>contraseña</em></h1>
  <p class="subtitle">Elige una contraseña segura de al menos 6 caracteres.</p>

  <?php if ($error): ?>
    <div class="alert-error"><?= htmlspecialchars($error) ?></div>
  <?php endif; ?>

  <form method="POST">
    <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">

    <div class="field">
      <label for="password">Nueva contraseña</label>
      <div class="input-wrap">
        <input type="password" id="password" name="password" placeholder="Mínimo 6 caracteres" required />
        <button type="button" class="toggle-pass" onclick="toggleVer('password', this)">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
            <circle cx="12" cy="12" r="3"/>
          </svg>
        </button>
      </div>
      <div class="strength-bar" id="strength-bar">
        <span></span><span></span><span></span>
      </div>
      <div class="strength-label" id="strength-label"></div>
    </div>

    <div class="field">
      <label for="password_repeat">Repetir contraseña</label>
      <div class="input-wrap">
        <input type="password" id="password_repeat" name="password_repeat" placeholder="Repite la contraseña" required />
        <button type="button" class="toggle-pass" onclick="toggleVer('password_repeat', this)">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
            <circle cx="12" cy="12" r="3"/>
          </svg>
        </button>
      </div>
      <span class="error-msg" id="match-error">Las contraseñas no coinciden.</span>
    </div>

    <button type="submit" class="btn">Guardar nueva contraseña</button>
  </form>

  <a href="login.php" class="back-link">← Volver a <span>iniciar sesión</span></a>

<?php endif; ?>

</div>

<script>
  function toggleVer(id, btn) {
    const input = document.getElementById(id);
    const esPassword = input.type === 'password';
    input.type = esPassword ? 'text' : 'password';
    btn.style.color = esPassword ? 'var(--ink)' : 'var(--muted)';
  }

  const passInput   = document.getElementById('password');
  const repeatInput = document.getElementById('password_repeat');
  const bar         = document.getElementById('strength-bar');
  const label       = document.getElementById('strength-label');
  const matchError  = document.getElementById('match-error');

  if (passInput) {
    passInput.addEventListener('input', () => {
      const v = passInput.value;
      bar.className = 'strength-bar';
      if (v.length === 0) { label.textContent = ''; return; }

      let score = 0;
      if (v.length >= 6)  score++;
      if (v.length >= 10) score++;
      if (/[A-Z]/.test(v) && /[0-9]/.test(v)) score++;

      if (score === 1) { bar.classList.add('weak');   label.textContent = 'Débil'; }
      if (score === 2) { bar.classList.add('medium'); label.textContent = 'Media'; }
      if (score === 3) { bar.classList.add('strong'); label.textContent = 'Fuerte'; }
    });
  }

  if (repeatInput) {
    repeatInput.addEventListener('input', () => {
      if (repeatInput.value && repeatInput.value !== passInput.value) {
        matchError.classList.add('show');
        repeatInput.style.borderColor = 'var(--red)';
      } else {
        matchError.classList.remove('show');
        repeatInput.style.borderColor = repeatInput.value ? 'var(--green)' : '';
      }
    });
  }
</script>

</body>
</html>