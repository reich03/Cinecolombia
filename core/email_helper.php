<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

function enviarCorreo($user, $resumenDetalles)
{
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.example.com'; 
        $mail->SMTPAuth = true;
        $mail->Username = 'your_email@example.com'; 
        $mail->Password = 'your_password'; 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Destinatarios
        $mail->setFrom('your_email@example.com', 'Cine Colombia');
        $mail->addAddress($user['correo'], $user['nombre'] . ' ' . $user['apellido']);

        // Contenido del correo
        $mail->isHTML(true);
        $mail->Subject = 'Resumen de Compra';
        $mail->Body = $resumenDetalles;

        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log("Error al enviar correo: {$mail->ErrorInfo}");
        return false;
    }
}
