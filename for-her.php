<!-- <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>For Her | Gifting</title>
  <style>
    body {
      margin: 0;
      font-family: 'Georgia', serif;
      background-color: #fff0f5;
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
      color: #c2185b;
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
  <h1>Fragrances For Her</h1>
  <p><a href="gifting.php" style="color:#c2185b; font-weight:bold; text-decoration:none;">&larr; Back to Gifting</a></p>
  <div class="gift-grid">
    <div class="gift-item">
      <img src="https://via.placeholder.com/300x250?text=Floral+Sensation" alt="Floral Sensation">
      <div class="gift-info">
        <h3>Floral Sensation</h3>
        <p>A sweet and elegant scent with notes of rose, jasmine, and vanilla.</p>
      </div>
    </div>

    <div class="gift-item">
      <img src="https://via.placeholder.com/300x250?text=Soft+Elegance" alt="Soft Elegance">
      <div class="gift-info">
        <h3>Soft Elegance</h3>
        <p>Perfect for day and evening wear, this perfume is gentle yet captivating.</p>
      </div>
    </div>

    <div class="gift-item">
      <img src="https://via.placeholder.com/300x250?text=Blush+Romance" alt="Blush Romance">
      <div class="gift-info">
        <h3>Blush Romance</h3>
        <p>A light fragrance inspired by femininity and charm. Ideal for gifts.</p>
      </div>
    </div>
  </div>
</div>

</body>
</html> -->
<?php
include "productforher.php";

$herGifts = [
    new GiftProduct(
        "Floral Sensation",
        "A sweet and elegant scent with notes of rose, jasmine, and vanilla.",
        34.99,
        "Images/parfum4.png"
    ),
    new GiftProduct(
        "Soft Elegance",
        "Perfect for day and evening wear, this perfume is gentle yet captivating.",
        29.99,
        "Images/parfum6.png"
    ),
    new GiftProduct(
        "Blush Romance",
        "A light fragrance inspired by femininity and charm. Ideal for gifts.",
        39.99,
        "Images/parfum7.png"
    ),
];

// Optional sort
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
    body {
      font-family: Georgia, serif;
      background-color: #fff0f5;
      margin: 0;
      padding: 40px 20px;
      color: #333;
    }
    h1 {
      text-align: center;
      color: #c2185b;
      font-size: 36px;
      margin-bottom: 20px;
    }
    .sort-links {
      text-align: center;
      margin-bottom: 20px;
    }
    .sort-links a {
      margin: 0 10px;
      text-decoration: none;
      color: #c2185b;
      font-weight: bold;
    }
    .back-link {
      text-align: center;
      margin-bottom: 30px;
    }
    .back-link a {
      background-color: #c2185b;
      color: white;
      padding: 10px 20px;
      border-radius: 5px;
      text-decoration: none;
      font-weight: bold;
      transition: background-color 0.3s ease;
    }
    .back-link a:hover {
      background-color: #a3154b;
    }
    .grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 30px;
    }
    .item {
      background-color: white;
      border: 1px solid #ddd;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      transition: transform 0.3s ease;
    }
    .item:hover {
      transform: scale(1.03);
    }
    .item img {
      width: 100%;
      height: 400px;
      object-fit: cover;
    }
    .info {
      padding: 20px;
    }
    .info h3 {
      margin-top: 0;
      color: #222;
    }
    .info p {
      font-size: 15px;
      color: #666;
    }
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
<div class="back-link">
  <a href="gifting.php">← Back to Gifting</a>
</div>

</body>
</html>
