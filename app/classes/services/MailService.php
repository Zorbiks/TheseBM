<?php

require_once __DIR__ . "/../../../lib/PHPMailer/src/PHPMailer.php";
require_once __DIR__ . "/../../../lib/PHPMailer/src/SMTP.php";
require_once __DIR__ . "/../../../lib/PHPMailer/src/Exception.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


class MailService {
    private $serverEmailAddress;
    private $serverEmailPassword;

    // Thesard info
    private $thesardEmail;
    private $thesardFirstName;
    private $thesardLastName;

    public function __construct($thesardFirstName, $ThesardLastName, $thesardEmail) {
        $this->thesardEmail = $thesardEmail;
        $this->thesardFirstName = $thesardFirstName;
        $this->thesardLastName = $ThesardLastName;

        $this->serverEmailAddress = getenv("EMAIL_ADDRESS");
        $this->serverEmailPassword = getenv("EMAIL_PASSWORD");
    }

    public function sendMail() {
        try {
            // Create a new PHPMailer instance
            $mail = new PHPMailer();

            // Configuration
            $mail->isSMTP();
            $mail->SMTPDebug = SMTP::DEBUG_OFF;
            $mail->Host = "smtp.gmail.com";
            $mail->Port = 465;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->SMTPAuth = true;

            $mail->Username = $this->serverEmailAddress;
            $mail->Password = $this->serverEmailPassword;

            $mail->setFrom($this->serverEmailAddress);

            // Set who the message is to be sent to
            $mail->addAddress($this->thesardEmail);
            
            // Content Configuration
            $mail->CharSet = PHPMailer::CHARSET_UTF8;
            $mail->Subject = "Bienvenue sur ThéseBM";
            $mail->isHTML(true);

            $content = file_get_contents(__DIR__ . "/email.html");

            $content = str_replace("{{firstname}}", $this->thesardFirstName, $content);
            $content = str_replace("{{lastname}}", $this->thesardLastName, $content);

            $mail->addEmbeddedImage(__DIR__ . "/logo.png", "logocid");

            $mail->Body = $content;

            // Send the message, check for errors
            if (!$mail->send()) {
                echo 'Mailer Error:' . $mail->ErrorInfo;
            } else {
                echo 'Message sent!';
            }
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
