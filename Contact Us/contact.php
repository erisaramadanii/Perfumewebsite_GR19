<?php
// Variablat
$name = $email = $phone = $date = $message = "";
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. Validimi i emrit
    if (!preg_match("/^[A-ZÇËa-zçë ]{2,30}$/", $_POST["name"])) {
        $errors[] = "Emri duhet të përmbajë vetëm shkronja.";
    } else {
        $name = htmlspecialchars($_POST["name"]);
    }

    // 2. Validimi i email-it
    if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email-i nuk është i vlefshëm.";
    } else {
        $email = $_POST["email"];
    }

    // 3. Numri i telefonit (vetëm numra dhe 8-12 shifra)
    if (!preg_match("/^\d{8,12}$/", $_POST["phone"])) {
        $errors[] = "Numri i telefonit nuk është valid.";
    } else {
        $phone = $_POST["phone"];
    }

    // 4. Data (yyyy-mm-dd)
    if (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $_POST["date"])) {
        $errors[] = "Data nuk është në formatin e duhur.";
    } else {
        $date = $_POST["date"];
    }

    // 5. Ndërrim simbolesh në mesazh
    $message = str_replace("!", ".", $_POST["message"]);
}
?>

<h2>Na Kontakto</h2>
<form method="post" action="">
    Emri: <input type="text" name="name" required><br><br>
    Email: <input type="email" name="email" required><br><br>
    Telefoni: <input type="text" name="phone" required><br><br>
    Data: <input type="date" name="date" required><br><br>
    Mesazhi: <textarea name="message" required></textarea><br><br>
    <input type="submit" value="Dergo">
</form>

<?php
if (!empty($errors)) {
    echo "<ul style='color:red;'>";
    foreach ($errors as $e) {
        echo "<li>$e</li>";
    }
    echo "</ul>";
} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "<p style='color:green;'>Faleminderit $name! Mesazhi u pranua me sukses.</p>";
}
?>
<a href="contactus/contact.php">Na Kontakto</a>

