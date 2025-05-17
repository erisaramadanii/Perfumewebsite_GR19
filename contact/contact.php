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
 
        // === 1. Error handler personalizuar ===
     function error_handler($errno, $errstr, $errfile, $errline) {
    switch ($errno) {
        case E_USER_ERROR:
            $tipi = "Gabim serioz";
            break;
        case E_USER_WARNING:
            $tipi = "Kujdes (Warning)";
            break;
        case E_USER_NOTICE:
            $tipi = "Njoftim (Notice)";
            break;
        default:
            $tipi = "Gabim i panjohur";
    }
    echo "<p style='color:red;'>[$tipi] ($errno): $errstr në rreshtin $errline të fajllit $errfile</p>";
}
set_error_handler("error_handler");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $emri = htmlspecialchars($_POST['emri'], ENT_QUOTES, 'UTF-8');
        $mesazhi = htmlspecialchars($_POST['mesazhi'], ENT_QUOTES, 'UTF-8');
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Email jo valid!");
        }

        $to = "erisaramadani20@gmail.com";
        $subject = "Mesazh nga kontakt forma";
        $body = "Emri: $emri\nEmail: $email\n\nMesazhi:\n$mesazhi";

        $headers = "From: $email\r\n";
        $headers .= "Reply-To: $email\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

        if (!mail($to, $subject, $body, $headers)) {
            throw new Exception("<p style='color:red;'>Dërgimi i mesazhit dështoi.</p>");
        }

        echo "<p style='color:green;'>Mesazhi u dërgua me sukses!</p>";

        // Ruajtja e mesazhit në fajll me fopen, fwrite, fclose
        $logFile = "mesazhet.txt";
        $handle = fopen($logFile, "a");
        if (!$handle) {
            throw new Exception("Nuk mund të hapet fajlli për shkrim.");
        }
        $log = "Emri: $emri\nEmail: $email\nMesazhi: $mesazhi\n--------------------------\n";
        fwrite($handle, $log);
        fclose($handle);

    } catch (Exception $e) {
        echo "<p style='color:red;'>Gabim: " . $e->getMessage() . "</p>";
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

            <a href="index.php" class="back-button">← Back</a>
        </form>
    </div>
</body>
</html>
