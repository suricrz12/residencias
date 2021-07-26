<?php

    $password = $_REQUEST['password'];
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

        $mail->setFrom('pruebaresidenciaitsm@gmail.com', utf8_decode('DATOS DE USUARIO, RESIDENCIAS'));
        $mail->addAddress($email, 'USUARIO');

        $mail->isHTML(true);
        $mail->Subject = 'DATOS DE ACCESO';
        $mail->Body    = utf8_decode('SALUDOS, PARA ACCEDER AL SISTEMA DE SEGUIENTO DE RESIDENCIAS ESTE ES TU USERNAME: "'.$email.'" Y TU CONTRASEÑA ES LA SIGUIENTE: "'.$password.'"</br><a href="localhost/residencias"> ACCEDE DESDE AQUÍ</a>');

        $mail->send();

    } catch (Exception $e) {
    }
?>