<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    require 'vendor/autoload.php';
    require '../protected/connessione.php';
    $mail = new PHPMailer(true);
    try
    {
        //Server settings
        $mail->CharSet = 'UTF-8';
        $mail->SMTPAutoTLS = false;
        $mail->SMTPSecure = false;
        $mail->isSMTP();                              //Send using SMTP
        $mail->Host = 'authsmtp.register.it';     //Set the SMTP server to send through
        $mail->SMTPAuth = true;                       //Enable SMTP authentication
        $mail->Username = 'no-reply@alessiolustri.it';  //SMTP username
        $mail->Password = '19022002aL!';            //SMTP password
        $mail->Port = 25;                             //TCP port to connect to

        $mailFrom  = $_POST["email"];
        $Nome      = $_POST["name"];
        $Subject   = $_POST["subject"]." "."DA PARTE DI ". $Nome;
        $Messaggio = $Nome. " ha scritto: \n\n". $_POST["Messaggio"];

        //Recipients
        $mail->setFrom($mailFrom, $Nome);
        $mail->addAddress('no-reply@alessiolustri.it', "Support MedBase");     //Add a recipient

        //Content
        $mail->Subject = $Subject;
        $mail->Body = $Messaggio;

        $mail->send();
        alert("Mail inviata con successo. Provvederemo a risponderti entro 48 ore", "../index.php");
    } catch (Exception $e)
    {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        alert("errore", "../index.php");
    }
