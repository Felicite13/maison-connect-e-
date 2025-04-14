<?php

// sendMail.php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require realpath(__DIR__ . '/../../vendor/autoload.php');

function envoyerMailVerification($email, $verification_code) {
    $mail = new PHPMailer(true);

    try {
        // Paramètres SMTP de Mailtrap
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';  // Serveur SMTP Mailtrap
        $mail->SMTPAuth = true;
        $mail->Username = 'a1e4d1ccaf0791';  // Ton username Mailtrap
        $mail->Password = '444c60c23715f6';  // Ton mot de passe Mailtrap
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  // Utilise STARTTLS pour sécuriser la connexion
        $mail->Port = 587;  // Port de connexion (587 recommandé pour STARTTLS)

        // Expéditeur et destinataire
        $mail->setFrom('no-reply@myhome.com', 'MyHome');
        $mail->addAddress($email);  // L'email de l'utilisateur

        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';  // Assurez-vous que l'encodage est bien UTF-8
        $mail->Subject = 'Code de vérification';
       $mail->Body    = "Votre code de vérification est : <b>$verification_code</b><br><br>
                  Cliquez <a href='http://localhost:8080/MaisonIntelligente/page%20d%27accueil/php/validate.php?verification_code=$verification_code'>ici</a> pour valider votre compte.";

        // Envoi de l'email
        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

?>
