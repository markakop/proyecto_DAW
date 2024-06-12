<?php
require 'phpmailer/PHPMailerAutoload.php';
function sendEmail($email, $mensaje)
{
    $mail = new PHPMailer();

    try {
        $url_theme = "../paginas/email.php";
        if (file_exists($url_theme)) {
            $mensajeCliente = file_get_contents($url_theme);
            $mensajeCliente = str_replace("#nombre", $mensaje, $mensajeCliente);
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
        $mail->setFrom($email, 'Entranet');
        $mail->addAddress($email);
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
}

function sendEmailContact($email,$mensaje)
{
    $mail = new PHPMailer();

    try {
        $url_theme = "../paginas/email-contact.php";
        if (file_exists($url_theme)) {
            $mensajeCliente = file_get_contents($url_theme);
            $mensajeCliente = str_replace("#mensaje", $mensaje, $mensajeCliente);
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
        $mail->setFrom($email, 'Entranet');
        $mail->addAddress($email);
        $mail->Subject = 'Gracias por contactar';
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
}
