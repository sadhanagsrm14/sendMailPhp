<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'rkumargupta798@gmail.com';                     // SMTP username
    $mail->Password   = 'Gupta@1234#';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('rkumargupta798@gmail.com', 'Mailer');
    $mail->addAddress('rkumargupta798@gmail.com', 'Joe User');     // Add a recipient
    $mail->addAddress('rkumargupta798@gmail.com');               // Name is optional
    $mail->addReplyTo('rkumargupta798@gmail.com', 'Information');
    $mail->addCC('rkumargupta798@gmail.com');
    $mail->addBCC('rkumargupta798@gmail.com');

    // Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mail->isHTML(true);  
    $base_url = 'http://localhost/projects/phpprojects/sendMailPhp/'; //

$message = '';

                                    // Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $track_code = md5(rand());
    $message_body = 'This is the HTML message body <b>in bold!</b>';

    $message_body .= '<img src="'.$base_url.'email_track.php?code='.$track_code.'" width="1" height="1" />';
    $mail->Body    = $message_body;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
