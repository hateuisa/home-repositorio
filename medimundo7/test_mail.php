<?php
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

try {
    $mail->SMTPDebug  = 2;
    $mail->isSMTP();
    $mail->Host       = "smtp.gmail.com";
    $mail->SMTPAuth   = true;
    $mail->Username   = "hhernandezs@campusdigitalfp.com";  //  tu Gmail real
    $mail->Password   = "oatkkfzqnjwktjtq";    //  tu contraseña de app
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    $mail->setFrom("tuemail@gmail.com", "MediMundo");
    $mail->addAddress("tuemail@gmail.com");
    $mail->Subject = "Test";
    $mail->Body    = "Funciona!";

    $mail->send();
    echo "✅ CORREO ENVIADO";

} catch (Exception $e) {
    echo " ERROR: " . $mail->ErrorInfo;
}
?>