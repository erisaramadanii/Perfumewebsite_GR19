<?php
include "productforher.php";

function error_handler($errno, $errstr, $errfile, $errline)
{
    echo "<b>Gabim i personalizuar [$errno]</b>: $errstr<br>";
    echo "Gabimi ndodhi në linjën $errline të fajllit $errfile<br>";
}
set_error_handler("error_handler");

$herGifts = [
    new GiftProduct("Floral Sensation", "A sweet and elegant scent with notes of rose, jasmine, and vanilla.", 34.99, "Images/parfum4.png"),
    new GiftProduct("Soft Elegance", "Perfect for day and evening wear, this perfume is gentle yet captivating.", 29.99, "Images/parfum6.png"),
    new GiftProduct("Blush Romance", "A light fragrance inspired by femininity and charm. Ideal for gifts.", 39.99, "Images/parfum7.png"),
];

$dataFile = "forher_data.txt";
if (file_exists($dataFile)) {
    $lines = file($dataFile, FILE_IGNORE_NEW_LINES);
    foreach ($lines as $line) {
        list($name, $desc, $price) = explode("|", $line);
        $herGifts[] = new GiftProduct($name, $desc, (float)$price, "Images/parfum_default.png");
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        $name = $_POST['name'] ?? '';
        $desc = $_POST['desc'] ?? '';
        $price = $_POST['price'] ?? '';

        if (!$name || !$desc || !$price) {
            throw new Exception("Të gjitha fushat duhet të plotësohen!");
        }

        if (!is_numeric($price)) {
            throw new Exception("Çmimi duhet të jetë numër!");
        }

        $line = "$name|$desc|$price\n";
        $fp = fopen($dataFile, "a");
        if (!$fp) {
            throw new Exception("Nuk u hap fajlli për shkrim!");
        }
        fwrite($fp, $line);
        fclose($fp);

        header("Location: for-her.php");
        exit;

    } catch (Exception $e) {
        echo "<div style='color:red; font-weight:bold; text-align:center; margin-bottom:20px;'>Gabim: " . $e->getMessage() . "</div>";
    }
}

$sortMethod = $_GET['sort'] ?? 'asc';
if ($sortMethod == 'asc') {
    usort($herGifts, fn($a, $b) => $a->getPrice() <=> $b->getPrice());
} elseif ($sortMethod == 'desc') {
    usort($herGifts, fn($a, $b) => $b->getPrice() <=> $a->getPrice());
}

$GLOBALS['pageTitle'] = "For Her | Gifting";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?= $pageTitle ?></title>
  <style>
    body { font-family: Georgia, serif; background-color: #fff0f5; margin: 0; padding: 40px 20px; color: #333; }
    h1 { text-align: center; color: #c2185b; font-size: 36px; margin-bottom: 20px; }
    .sort-links { text-align: center; margin-bottom: 20px; }
    .sort-links a { margin: 0 10px; text-decoration: none; color: #c2185b; font-weight: bold; }
    .back-link { text-align: center; margin: 30px; }
    .back-link a { background-color: #c2185b; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none; font-weight: bold; }
    .back-link a:hover { background-color: #a3154b; }
    .grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 30px; }
    .item { background-color: white; border: 1px solid #ddd; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 10px rgba(0,0,0,0.1); transition: transform 0.3s ease; }
    .item:hover { transform: scale(1.03); }
    .item img { width: 100%; height: 400px; object-fit: cover; }
    .info { padding: 20px; }
    .info h3 { margin-top: 0; color: #222; }
    .info p { font-size: 15px; color: #666; }
    form { max-width: 500px; margin: 50px auto; background:#fff; padding: 20px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
    input[type="text"], input[type="number"] { width: 100%; padding: 10px; margin: 10px 0 20px; border: 1px solid #ccc; border-radius: 4px; }
    input[type="submit"] { background-color: #c2185b; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; }
    input[type="submit"]:hover { background-color: #a3154b; }
  </style>
</head>
<body>

<h1><?= $pageTitle ?></h1>

<div class="sort-links">
  <strong>Sort by Price:</strong>
  <a href="?sort=asc">Low to High</a> |
  <a href="?sort=desc">High to Low</a>
</div>

<div class="grid">
  <?php foreach ($herGifts as $gift): ?>
    <div class="item">
      <img src="<?= $gift->getImage() ?>" alt="<?= $gift->getName() ?>">
      <div class="info">
        <h3><?= $gift->getName() ?> - €<?= number_format($gift->getPrice(), 2) ?></h3>
        <p><?= $gift->getDescription() ?></p>
      </div>
    </div>
  <?php endforeach; ?>
</div>

<!-- Forma për shtim dhurate të re -->
<h2 style="text-align:center; color:#c2185b;">Shto një dhuratë të re</h2>
<form method="POST">
  <label>Emri i produktit:</label>
  <input type="text" name="name" required>

  <label>Përshkrimi:</label>
  <input type="text" name="desc" required>

  <label>Çmimi (€):</label>
  <input type="text" name="price" required>
 <label>Image path:</label><br>
 
  <input type="text" name="image" placeholder="Images/myimage.jpg" required><br><br>
  <input type="submit" value="Shto Produktin">
 
</form>

<div class="back-link">
  <a href="gifting.php">← Back to Gifting</a>
</div>

</body>
</html>
