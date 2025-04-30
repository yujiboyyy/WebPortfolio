<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/PHPMailer-master/src/Exception.php';
require __DIR__ . '/PHPMailer-master/src/PHPMailer.php';
require __DIR__ . '/PHPMailer-master/src/SMTP.php';

$mail = new PHPMailer(true);

try {
    // SMTP settings
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'canaverallanceemmanuel@gmail.com'; // Your Gmail
    $mail->Password = 'xuay ohbp nmxw xoqr';   // Use the App Password from Step 1
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Disable debugging (optional)
    $mail->SMTPDebug = 0;

    // Check if email is provided
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        die('Error: Invalid email format.');
    }
    

    // Sender & recipient
    $mail->setFrom('your-email@gmail.com', $_POST['name']); // Keep your Gmail
$mail->addReplyTo($_POST['email'], $_POST['name']); // Reply goes to the sender
$mail->addAddress('canaverallanceemmanuel@gmail.com');

    // Email Content
    $mail->isHTML(true);
    $mail->Subject = 'New Message from ' . $_POST['name'];
    $mail->Body = "
    <strong>Sender Name:</strong> {$_POST['name']} <br>
    <strong>Sender Email:</strong> {$_POST['email']} <br>
    <strong>Message:</strong> " . nl2br(htmlspecialchars($_POST['message']));
    // Send email
    if ($mail->send()) {
        echo 'Message sent successfully!';
    } else {
        echo 'Message failed to send.';
    }

} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

