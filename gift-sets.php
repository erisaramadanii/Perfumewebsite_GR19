<?php
include "productgifts.php";

// Array fillestar me GiftSets
$giftSets = [
    new GiftSet("Luxury Set", "Elegant perfume and lotion set in a luxurious gift box.", 49.99, "images/man1.png", 3),
    new GiftSet("Travel Set", "Compact fragrance set ideal for travel or handbag use.", 29.99, "Images/M2_La_Male_Le_Parfum.jpg", 4),
    new GiftSet("Romantic Set", "Sweet and soft fragrances perfect for romantic moments.", 39.99, "Images/F3_La_Belle.webp", 2),
];

// File ku ruhen dhuratat
$dataFile = "giftsets_data.txt";

// Leximi nga file nëse ekziston
if (file_exists($dataFile)) {
    $lines = file($dataFile, FILE_IGNORE_NEW_LINES);
    foreach ($lines as $line) {
        list($name, $desc, $price) = explode("|", $line);
        // Vlera default për image dhe items
        $giftSets[] = new GiftSet($name, $desc, (float)$price, "images/default.png", 1);
    }
}

// Shto nga forma
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $desc = $_POST['desc'] ?? '';
    $price = $_POST['price'] ?? '';

    if ($name && $desc && $price) {
        $line = "$name|$desc|$price" . PHP_EOL;
        file_put_contents($dataFile, $line, FILE_APPEND);
        header("Location: gift-sets.php");
        exit;
    }
}

// Sortimi
$sortMethod = $_GET['sort'] ?? 'asc';
if ($sortMethod == 'asc') {
    usort($giftSets, fn($a, $b) => $a->getPrice() <=> $b->getPrice());
} elseif ($sortMethod == 'desc') {
    usort($giftSets, fn($a, $b) => $b->getPrice() <=> $a->getPrice());
}

// Variabla globale
$GLOBALS['pageTitle'] = "Gift Sets";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?= $pageTitle ?></title>
  <style>
    body { font-family: Georgia, serif; background: #fff5f0; margin: 0; padding: 40px; }
    .grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 30px; }
    .item { background: white; border-radius: 10px; overflow: hidden; border: 1px solid #ddd; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
    .item img { width: 100%; height: 350px; object-fit: cover; border-top-left-radius: 10px; border-top-right-radius: 10px; }
    .info { padding: 20px; }
    .info h3 { margin: 0; }
    .info p { color: #555; }
    .sort-links { text-align: center; margin-bottom: 20px; }
    .sort-links a { margin: 0 10px; text-decoration: none; color: #c40000; }
    form { max-width: 500px; margin: 40px auto; background:#fff; padding:20px; border-radius:10px; box-shadow:0 2px 10px rgba(0,0,0,0.1); }
    input[type="text"], input[type="number"] { width: 100%; padding: 8px; margin: 5px 0 15px; border: 1px solid #ccc; border-radius: 4px; }
    input[type="submit"] { background-color: #c40000; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; }
    h2 { text-align: center; }
  </style>
</head>
<body>

<h1 style="text-align:center; color:#c40000;"><?= $pageTitle ?></h1>

<div class="sort-links">
  <strong>Sort by Price:</strong>
  <a href="?sort=asc">Low to High</a> |
  <a href="?sort=desc">High to Low</a>
</div>

<div class="grid">
  <?php foreach ($giftSets as $set): ?>
    <div class="item">
      <img src="<?= $set->getImage() ?>" alt="<?= $set->getName() ?>">
      <div class="info">
        <h3><?= $set->getName() ?> - €<?= number_format($set->getPrice(), 2) ?></h3>
        <p><?= $set->getDescription() ?></p>
        <p><small>Includes <?= $set->getItemsIncluded() ?> items</small></p>
      </div>
    </div>
  <?php endforeach; ?>
</div>

<h2>Add a New Gift Set</h2>
<form method="POST">
  <label>Name:</label><br>
  <input type="text" name="name" required><br>

  <label>Description:</label><br>
  <input type="text" name="desc" required><br>

  <label>Price (€):</label><br>
  <input type="text" name="price" required><br>
  
   <label>Image path:</label><br>
  <input type="text" name="image" placeholder="Images/myimage.jpg" required><br><br>

  <input type="submit" value="Add Gift Set">
</form>

<div style="text-align: center; margin-bottom: 30px;">
  <a href="gifting.php" style="background-color: #c40000; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-weight: bold;">
    ← Back to Gifting
  </a>
</div>

</body>
</html>
