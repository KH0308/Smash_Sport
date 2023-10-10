<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'external_lib/PHPMailer-master/src/Exception.php';
require 'external_lib/PHPMailer-master/src/PHPMailer.php';
require 'external_lib/PHPMailer-master/src/SMTP.php';
if ($_SERVER["REQUEST_METHOD"] == "POST" || $_SERVER["REQUEST_METHOD"] == "GET") {

    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $body = $_POST['body'];

    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 465;
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'ssl';
    $mail->Username = 'smashsport312@gmail.com';
    $mail->Password = 'lzjedcyvgxsczlat';
    $mail->setFrom('smashsport312@gmail.com', 'Smash Sport');
    $mail->addAddress($email);
    $mail->Subject = $subject;
    $mail->Body = $body;

    if ($mail->send()) {
        echo 'Email sent successfully!';
    } else {
        echo 'Failed to send email.'. $mail->ErrorInfo;
    }
} else {
    http_response_code(400);
    echo 'Invalid request.';
}
?>
