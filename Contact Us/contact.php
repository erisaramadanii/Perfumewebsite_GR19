
  <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Na Kontakto</title>
    <link rel="stylesheet" href="style.css"> <!-- opsionale -->
</head>
<body>

<?php
// Variablat
$name = $email = $message = "";
$nameErr = $emailErr = $msgErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validimi i emrit
    if (empty($_POST["name"])) {
        $nameErr = "Emri është i detyrueshëm";
    } else {
        $name = test_input($_POST["name"]);
        if (!preg_match("/^[a-zA-Z\s]+$/", $name)) {
            $nameErr = "Vetëm shkronja dhe hapsira lejohen";
        }
    }

    // Validimi i emailit
    if (empty($_POST["email"])) {
        $emailErr = "Email-i është i detyrueshëm";
    } else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Format i pavlefshëm email-i";
        }
    }

    // Validimi i mesazhit
    if (empty($_POST["message"])) {
        $msgErr = "Mesazhi është i detyrueshëm";
    } else {
        $message = test_input($_POST["message"]);
        // Mund të shtuam edhe ndonjë RegEx tjetër nëse don
    }

    // Nëse s’ka errora, shfaq të dhënat ose ruaj
    if ($nameErr == "" && $emailErr == "" && $msgErr == "") {
        echo "<p class='success'>Faleminderit, $name! Mesazhi juaj u dërgua me sukses. 📬</p>";
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<h2>Na Kontakto</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    Emri: <input type="text" name="name" value="<?= $name ?>">
    <span class="error"><?= $nameErr ?></span><br><br>

    Email: <input type="text" name="email" value="<?= $email ?>">
    <span class="error"><?= $emailErr ?></span><br><br>

    Mesazhi: <textarea name="message"><?= $message ?></textarea>
    <span class="error"><?= $msgErr ?></span><br><br>

    <input type="submit" value="Dërgo">
</form>

</body>
</html>
