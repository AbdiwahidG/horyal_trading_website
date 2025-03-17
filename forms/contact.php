<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load PHPMailer
require __DIR__ . '/../vendor/autoload.php'; // Adjust path if needed

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mail = new PHPMailer(true);

    try {
        // SMTP Configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Change for your SMTP provider
        $mail->SMTPAuth = true;
        $mail->Username = 'cosmas11360@gmail.com'; // Your email
        $mail->Password = 'cika kaln tnmx ngki'; // Use an App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Sender and Recipient
        $mail->setFrom($_POST['email'], $_POST['name']);
        $mail->addAddress('cosmas11360@gmail.com'); // Your receiving email

        // Email Content
        $mail->isHTML(true);
        $mail->Subject = $_POST['subject'];
        $mail->Body = "
            <h3>New Inquiry</h3>
            <p><strong>Name:</strong> {$_POST['name']}</p>
            <p><strong>Email:</strong> {$_POST['email']}</p>
            <p><strong>Phone:</strong> {$_POST['phone']}</p>
            <p><strong>Inquiry Type:</strong> {$_POST['inquiry_type']}</p>
            <p><strong>Message:</strong></p>
            <p>{$_POST['message']}</p>
        ";

        // Send the email
        if ($mail->send()) {
            echo "Your message has been sent successfully!";
        } else {
            echo "Error: Unable to send email.";
        }
    } catch (Exception $e) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    }
} else {
    echo "Unauthorized access.";
}
?>
