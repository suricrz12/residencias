<?php
    $email = $_REQUEST['email'];

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

    $mail = new PHPMailer(true);

    try {
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'pruebaresidenciaitsm@gmail.com';
        $mail->Password   = '4242dagr';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->setFrom('pruebaresidenciaitsm@gmail.com', utf8_decode('NOTIFICACIÓN RESIDENCIAS'));
        $mail->addAddress($email, 'USUARIO');

        $mail->isHTML(true);
        $mail->Subject = 'PROCESO DE RESIDENCIAS FINALIZADO';
        $mail->Body    = utf8_decode('SALUDOS, LE INFORMAMOS QUE SU PROCESO DE RESIDENCIAS PROFESIONALES A FINALIZADO');

        $mail->send();

    } catch (Exception $e) {
    }
?>