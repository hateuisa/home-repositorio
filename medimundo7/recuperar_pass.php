recuperar pass: <?php
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer;
use PHPMailer\Exception;

$conn = new mysqli("localhost", "root", "", "medimundohome");

if ($conn->connect_error) {
    die(json_encode(["ok" => false, "error" => "Error de conexión"]));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim($_POST["email"] ?? "");

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(["ok" => false, "error" => "Email no válido"]);
        exit;
    }

    $stmt = $conn->prepare("SELECT id_usuario FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {

        $token  = bin2hex(random_bytes(32));
        $expiry = date("Y-m-d H:i:s", strtotime("+1 hour"));

        $stmt2 = $conn->prepare(
            "UPDATE usuarios SET reset_token = ?, reset_expiry = ? WHERE email = ?"
        );
        $stmt2->bind_param("sss", $token, $expiry, $email);
        $stmt2->execute();

        $reset_link = "http://localhost/medimundo3/reset-password.php?token=" . $token;

        try {
            $mail = new PHPMailer(true);

            $mail->isSMTP();
            $mail->Host       = "smtp.gmail.com";
            $mail->SMTPAuth   = true;
            $mail->Username   = "oboukhanam@campusdigitalfp.com"; // 👈 tu email
            $mail->Password   = "oatkkfzqnjwktjtq";               // 👈 tu contraseña de app
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;
            $mail->CharSet    = "UTF-8";

            $mail->setFrom("oboukhanam@campusdigitalfp.com", "MediMundo"); // 👈 corregido
            $mail->addAddress($email); // 👈 envía al email del usuario, no al tuyo
            $mail->Subject = "Recuperar contraseña — MediMundo";
            $mail->isHTML(true);
            $mail->Body = "
                <div style='font-family:sans-serif;max-width:480px;margin:auto;padding:32px;'>
                    <h2 style='color:#C0392B;'>Recuperar contraseña</h2>
                    <p>Hemos recibido una solicitud para restablecer tu contraseña.</p>
                    <p>Haz clic en el botón para crear una nueva:</p>
                    <a href='$reset_link'
                       style='display:inline-block;margin:24px 0;padding:12px 28px;
                              background:#C0392B;color:#fff;text-decoration:none;
                              border-radius:8px;font-weight:500;'>
                        Restablecer contraseña
                    </a>
                    <p style='color:#888;font-size:13px;'>
                        El enlace expira en 1 hora.<br>
                        Si no solicitaste este cambio, ignora este correo.
                    </p>
                </div>
            ";
            $mail->AltBody = "Restablece tu contraseña en: $reset_link (expira en 1 hora)";

            $mail->send();

        } catch (Exception $e) {
            echo json_encode(["ok" => false, "error" => $mail->ErrorInfo]);
            exit;
        }
    }

    echo json_encode(["ok" => true]);
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Recuperar contraseña — MediMundo</title>
<link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="estilos1.css">
</head>
<body>

<div class="card">

  <div class="icon-wrap">
    <svg viewBox="0 0 24 24" fill="none" stroke="var(--red)" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
      <rect x="3" y="11" width="18" height="11" rx="2"/>
      <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
    </svg>
  </div>

  <h1>¿Olvidaste tu<br><em>contraseña?</em></h1>
  <p class="subtitle">Introduce tu correo y te enviaremos un enlace para restablecerla.</p>

  <form id="forgot-form" novalidate>
    <div class="field">
      <label for="email">Correo electrónico</label>
      <input type="email" id="email" name="email" placeholder="ejemplo@correo.com" autocomplete="email" />
      <span class="error-msg" id="error-msg">Introduce un correo válido.</span>
    </div>

    <button type="submit" class="btn" id="submit-btn">
      <span class="btn-text">Enviar enlace de recuperación</span>
      <span class="spinner"><span class="spinner-ring"></span></span>
    </button>

    <div class="success-box" id="success-box">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#27AE60" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
        <polyline points="22 4 12 14.01 9 11.01"/>
      </svg>
      <p>Hemos enviado un enlace a <strong id="sent-email"></strong>. Revisa tu bandeja de entrada.</p>
    </div>

    <div class="error-box" id="error-box"></div>
  </form>

  <a href="login.php" class="back-link">← Volver a <span>iniciar sesión</span></a>

</div>

<script>
  const form       = document.getElementById('forgot-form');
  const btn        = document.getElementById('submit-btn');
  const input      = document.getElementById('email');
  const errorMsg   = document.getElementById('error-msg');
  const successBox = document.getElementById('success-box');
  const errorBox   = document.getElementById('error-box');
  const sentEmail  = document.getElementById('sent-email');

  function isValidEmail(v) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v);
  }

  input.addEventListener('input', () => {
    errorMsg.classList.remove('show');
    input.style.borderColor = '';
  });

  form.addEventListener('submit', async (e) => {
    e.preventDefault();

    const email = input.value.trim();

    if (!isValidEmail(email)) {
      errorMsg.classList.add('show');
      input.style.borderColor = 'var(--red)';
      input.focus();
      return;
    }

    btn.classList.add('loading');
    btn.disabled = true;
    errorBox.classList.remove('show');

    try {
      const res  = await fetch('recuperar_pass.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'email=' + encodeURIComponent(email)
      });

      const data = await res.json();

      if (data.ok) {
        sentEmail.textContent = email;
        successBox.classList.add('show');
        form.querySelector('.field').style.opacity = '0.4';
        form.querySelector('.field').style.pointerEvents = 'none';
        btn.style.display = 'none';
      } else {
        // Muestra el error real del servidor
        errorBox.textContent = data.error || "Ha ocurrido un error. Inténtalo de nuevo.";
        errorBox.classList.add('show');
        btn.classList.remove('loading');
        btn.disabled = false;
      }

    } catch (err) {
      errorBox.textContent = "No se pudo conectar con el servidor.";
      errorBox.classList.add('show');
      btn.classList.remove('loading');
      btn.disabled = false;
    }
  });
</script>

</body>
</html>