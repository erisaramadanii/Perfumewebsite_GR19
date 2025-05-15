<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $to = filter_var($_POST['to'], FILTER_SANITIZE_EMAIL);
    $subject = strip_tags($_POST['subject']);
    $message = strip_tags($_POST['message']);
    $headers = "From: juaji@example.com\r\n";

    if (mail($to, $subject, $message, $headers)) {
        echo "Emaili u dërgua me sukses!";
    } else {
        echo "Dështoi dërgimi i emailit.";
    }
} else {
    echo "Kërkesë jo e vlefshme.";
}
?>

