<?php
require 'phpmailer/PHPMailerAutoload.php';

$mail = new PHPMailer();

try {
    $url_theme = "../paginas/email.php";
    if (file_exists($url_theme)) {
        $mensajeCliente = file_get_contents($url_theme);
        $mensajeCliente = str_replace("#nombre", "evento 2", $mensajeCliente);
    } else {
        throw new Exception("No se encontró la plantilla de email.");
    }

    // Configuración del servidor SMTP
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';
    $mail->Username = 'eentranet@gmail.com';
    $mail->Password = 'rczdzngtljrssuid';

    // Configuración del correo
    $mail->setFrom('david_8romero@hotmail.com', 'Entranet');
    $mail->addAddress('david_8romero@hotmail.com');
    $mail->Subject = 'Evento enviado';
    $mail->msgHTML($mensajeCliente);
    $mail->AltBody = strip_tags($mensajeCliente);

    // Envío del correo
    if ($mail->send()) {
        echo "Correo enviado exitosamente.";
    } else {
        throw new Exception("El correo no pudo ser enviado.");
    }
} catch (Exception $e) {
    echo "Error al enviar el correo: {$mail->ErrorInfo}";
}
