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
include "Product.php";

// Array multidimensional me objekte GiftSet
$giftSets = [
    new GiftSet(
        "Luxury Set",
        "Elegant perfume and lotion set in a luxurious box.",
        49.99,
        "https://images.unsplash.com/photo-1600180758890-6a6b30f2dfb3?fit=crop&w=500&q=80", // Elegant perfume box
        3
    ),
    new GiftSet(
        "Travel Set",
        "Mini perfumes and essentials for travel lovers.",
        29.99,
        "https://images.unsplash.com/photo-1611078489935-bd3abfe45b88?fit=crop&w=500&q=80", // Travel size products
        4
    ),
    new GiftSet(
        "Romantic Set",
        "A romantic combination of scents perfect for couples.",
        39.99,
        "https://images.unsplash.com/photo-1600181952428-6bd5efad7845?fit=crop&w=500&q=80", // Romantic themed set
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
    .item img { width: 100%; height: 250px; object-fit: cover; }
    .info { padding: 20px; }
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

</body>
</html>

