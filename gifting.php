<?php
// Përdorimi i cookies për ndërrimin e temës
if (isset($_GET['theme'])) {
    setcookie("theme", $_GET['theme'], time() + 3600, "/");
    $_COOKIE['theme'] = $_GET['theme']; // Për përdorim të menjëhershëm
}

$theme = $_COOKIE['theme'] ?? 'light';
$background = $theme === 'dark' ? '#222' : '#fff5f5';
$color = $theme === 'dark' ? '#eee' : '#222';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Gifting</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Georgia', serif;
            background-color: <?= $background ?>;
            color: <?= $color ?>;
        }

        .container {
            text-align: center;
            padding: 60px 20px;
        }

        h1 {
            font-size: 40px;
            margin-bottom: 50px;
            color: #d10000;
            letter-spacing: 2px;
        }

        .gift-options {
            display: flex;
            justify-content: center;
            gap: 40px;
            flex-wrap: wrap;
        }

        .gift-option {
            background-color: white;
            border: 1px solid #ccc;
            border-radius: 12px;
            padding: 30px;
            width: 220px;
            text-decoration: none;
            color: #222;
            font-weight: bold;
            transition: 0.3s;
            box-shadow: 0 6px 10px rgba(0,0,0,0.1);
            cursor: pointer;
        }

        .gift-option:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.15);
            background-color: #f8f8f8;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Choose a Gifting Category</h1>

    <div class="gift-options">
        <a href="gift-sets.php" class="gift-option">🎁 Gift Sets</a>
        <a href="for-her.php" class="gift-option">💐 For Her</a>
        <a href="for-him.php" class="gift-option">🕴️ For Him</a>
        <a href="birthday-gifts.php" class="gift-option">🎂 Birthday Gifts</a>
    </div>

    <br><br>
    <div>
        <a href="?theme=light">Light Theme</a> | <a href="?theme=dark">Dark Theme</a>
    </div>

    <hr><br>

    <?php
    // Klasa për një dhuratë (gift item)
    class GiftItem {
        private $name;
        private $price;

        public function __construct($name, $price) {
            $this->setName($name);
            $this->setPrice($price);
        }

        public function setName($name) {
            if (preg_match("/^[A-Za-z\s]{2,50}$/", $name)) {
                $this->name = $name;
            } else {
                throw new Exception("Emri nuk është valid!");
            }
        }

        public function getName() {
            return $this->name;
        }

        public function setPrice($price) {
            if (preg_match("/^\d+(\.\d{1,2})?$/", $price)) {
                $this->price = $price;
            } else {
                throw new Exception("Çmimi nuk është valid!");
            }
        }

        public function getPrice() {
            return $this->price;
        }

        public function display() {
            return "Emri: " . $this->name . " - Çmimi: €" . $this->price;
        }
    }

    $gifts = [];
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $emri = $_POST['emri'] ?? '';
        $cmimi = $_POST['cmimi'] ?? '';

        try {
            $gift = new GiftItem($emri, $cmimi);
            $gifts[] = $gift;
            echo "<p style='color:green;'>Shtimi u krye me sukses!</p>";

            // Simulim i dërgimit të emailit
            $to = "example@example.com";
            $subject = "Dhuratë e re shtuar";
            $message = "U shtua dhurata: $emri me çmim €$cmimi.";
            $headers = "From: webmaster@example.com";
            @mail($to, $subject, $message, $headers);
        } catch (Exception $e) {
            echo "<p style='color:red;'>Gabim: " . $e->getMessage() . "</p>";
        }
    }
    ?>

    <h2>Shto një dhuratë të re</h2>
    <form method="POST">
        <label>Emri i dhuratës:</label><br>
        <input type="text" name="emri" required><br><br>

        <label>Çmimi (€):</label><br>
        <input type="text" name="cmimi" required><br><br>

        <input type="submit" value="Shto">
    </form>

    <?php
    if (!empty($gifts)) {
        echo "<h3>Lista e dhuratave:</h3><ul>";
        foreach ($gifts as $gift) {
            echo "<li>" . $gift->display() . "</li>";
        }
        echo "</ul>";
    }
    ?>
</div>

</body>
</html>
