<!-- <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Gift Sets | Gifting</title>
  <style>
    body {
      margin: 0;
      font-family: 'Georgia', serif;
      background-color: #fef9f6;
      color: #333;
    }

    .container {
      max-width: 1200px;
      margin: auto;
      padding: 40px 20px;
    }

    h1 {
      text-align: center;
      font-size: 36px;
      color: #c40000;
      margin-bottom: 40px;
    }

    .gift-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 30px;
    }

    .gift-item {
      background-color: white;
      border: 1px solid #ddd;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      transition: transform 0.3s ease;
    }

    .gift-item:hover {
      transform: scale(1.03);
    }

    .gift-item img {
      width: 100%;
      height: 250px;
      object-fit: cover;
    }

    .gift-info {
      padding: 20px;
    }

    .gift-info h3 {
      margin-top: 0;
      color: #222;
    }

    .gift-info p {
      font-size: 15px;
      color: #666;
    }
  </style>
</head>
<body>

<div class="container">
  <h1>Gift Sets</h1>
  
  <div class="gift-grid">
    <div class="gift-item">
      <img src="https://via.placeholder.com/300x250?text=Luxury+Set+1" alt="Gift Set 1">
      <div class="gift-info">
        <h3>Luxury Gift Set 1</h3>
        <p>An exclusive collection of elegant fragrances, perfect for special occasions.</p>
      </div>
    </div>

    <div class="gift-item">
      <img src="https://via.placeholder.com/300x250?text=Limited+Edition" alt="Gift Set 2">
      <div class="gift-info">
        <h3>Limited Edition Set</h3>
        <p>Celebrate in style with this limited edition perfume and lotion combination.</p>
      </div>
    </div>

    <div class="gift-item">
      <img src="https://via.placeholder.com/300x250?text=Romantic+Duo" alt="Gift Set 3">
      <div class="gift-info">
        <h3>Romantic Duo</h3>
        <p>A perfect pair: sensual scent and matching accessories for unforgettable moments.</p>
      </div>
    </div>
  </div>
</div>

</body>
</html> -->

<?php
include "productgifts.php";

// Array multidimensional me objekte GiftSet
$giftSets = [
    new GiftSet(
        "Luxury Set",
        "Elegant perfume and lotion set in a luxurious gift box.",
        49.99,
        "images/man1.png",
        3
    ),
    new GiftSet(
        "Travel Set",
        "Compact fragrance set ideal for travel or handbag use.",
        29.99,
        "Images/M2_La_Male_Le_Parfum.jpg",
        4
    ),
    new GiftSet(
        "Romantic Set",
        "Sweet and soft fragrances perfect for romantic moments.",
        39.99,
        "Images/F3_La_Belle.webp",
        2
    ),
];


// Kushtëzim për renditje
$sortMethod = $_GET['sort'] ?? 'asc';

if ($sortMethod == 'asc') {
    usort($giftSets, function($a, $b) {
        return $a->getPrice() <=> $b->getPrice();
    });
} elseif ($sortMethod == 'desc') {
    usort($giftSets, function($a, $b) {
        return $b->getPrice() <=> $a->getPrice();
    });
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
    .item img {
    width: 100%;
    height: 350px;
    object-fit: cover;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
}    .info { padding: 20px; }
    .info h3 { margin: 0; }
    .info p { color: #555; }
    .sort-links { text-align: center; margin-bottom: 20px; }
    .sort-links a { margin: 0 10px; text-decoration: none; color: #c40000; }
   

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
<h1 style="text-align:center; color:#c40000;"><?= $pageTitle ?></h1>

<div style="text-align: center; margin-bottom: 30px;">
  <a href="gifting.php" style="background-color: #c40000; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-weight: bold;">
    ← Back to Gifting
  </a>
</div>

</body>
</html>

