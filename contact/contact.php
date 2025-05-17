<!-- kontakt.php -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Na Kontakto</title>
    <link rel="stylesheet" href="contact.css" />
</head>
<body>
    <div class="contact-container">
        <h1>Contact Us</h1>

        <?php
        // === 1. Importimi i funksioneve ose konfigurimeve tjera ===

        // === 2. Error handler personalu ===
        function error_handler($errno, $errstr, $errfile, $errline) {
            echo "<p style='color:red;'>Gabim ($errno): $errstr në rreshtin $errline të fajllit $errfile</p>";
        }
        set_error_handler("error_handler");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'C:/xampp/htdocs/Perfumewebsite_GR19-main/PHPMailer-master/src/Exception.php';
require 'C:/xampp/htdocs/Perfumewebsite_GR19-main/PHPMailer-master/src/PHPMailer.php';
require 'C:/xampp/htdocs/Perfumewebsite_GR19-main/PHPMailer-master/src/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $emri = htmlspecialchars($_POST['emri'], ENT_QUOTES, 'UTF-8');
    $mesazhi = htmlspecialchars($_POST['mesazhi'], ENT_QUOTES, 'UTF-8');  
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Email jo valid!");
    }

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'erisaramadani20@gmail.com';      // Vendos emailin Gmail tënd këtu
        $mail->Password = 'hhed ncxu zvxa cnit';        // Vendos këtu App Password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('yourgmail@gmail.com', 'Faqja Kontakt');
        $mail->addAddress('erisaramadani20@gmail.com');

        $mail->Subject = 'Mesazh nga kontakt forma';
        $mail->Body    = "Emri: $emri\nEmail: $email\n\nMesazhi:\n$mesazhi";

        $mail->send();
        echo "Mesazhi u dërgua me sukses!";
          
// === Ruajtja e mesazhit në fajll mesazhet.txt ===
$log = "Emri: $emri\nEmail: $email\nMesazhi: $mesazhi\n--------------------------\n";
file_put_contents("mesazhet.txt", $log, FILE_APPEND);

    } catch (Exception $e) {
        echo "Gabim në dërgim: {$mail->ErrorInfo}";
    }
}
        ?>

        <!-- Forma -->
        <form method="POST" action="">
            <label for="emri">Emri:</label>
            <input type="text" id="emri" name="emri" required />

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required />

            <label for="mesazhi">Mesazhi:</label>
            <textarea id="mesazhi" name="mesazhi" rows="5" required></textarea>

            <button type="submit" class="button-style">Dërgo</button>

            <a href="javascript:history.back()" class="back-button">← Back</a>

        </form>
    </div>
</body>
</html>
