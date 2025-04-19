<!-- <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Birthday Gifts | Gifting</title>
  <style>
    body {
      margin: 0;
      font-family: 'Georgia', serif;
      background-color: #fffde7;
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
      color: #ff6f00;
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
  <h1>Birthday Gift Ideas</h1>
  
  <div class="gift-grid">
    <div class="gift-item">
      <img src="https://via.placeholder.com/300x250?text=Birthday+Box" alt="Birthday Box">
      <div class="gift-info">
        <h3>Birthday Box</h3>
        <p>A colorful collection of fragrances with celebratory packaging.</p>
      </div>
    </div>

    <div class="gift-item">
      <img src="https://via.placeholder.com/300x250?text=Golden+Surprise" alt="Golden Surprise">
      <div class="gift-info">
        <h3>Golden Surprise</h3>
        <p>A premium gift set designed for unforgettable birthday moments.</p>
      </div>
    </div>

    <div class="gift-item">
      <img src="https://via.placeholder.com/300x250?text=Sweet+Celebration" alt="Sweet Celebration">
      <div class="gift-info">
        <h3>Sweet Celebration</h3>
        <p>Sweet-scented, elegant, and joyful — the perfect birthday perfume.</p>
      </div>
    </div>
  </div>
</div>

</body>
</html> -->
<?php
include "productbirthday.php";

$birthdayGifts = [
    new GiftProduct(
        "Birthday Box",
        "A colorful collection of fragrances with celebratory packaging.",
        36.99,
        "Images/F3_La_Belle.webp"
    ),
    new GiftProduct(
        "Golden Surprise",
        "A premium gift set designed for unforgettable birthday moments.",
        44.99,
        "Images/divine.jpg"
    ),
    new GiftProduct(
        "Sweet Celebration",
        "Sweet-scented, elegant, and joyful — the perfect birthday perfume.",
        29.99,
        "Images/freshblue.png"
    ),
];

// Optional sort
$sortMethod = $_GET['sort'] ?? 'asc';

if ($sortMethod == 'asc') {
    usort($birthdayGifts, fn($a, $b) => $a->getPrice() <=> $b->getPrice());
} elseif ($sortMethod == 'desc') {
    usort($birthdayGifts, fn($a, $b) => $b->getPrice() <=> $a->getPrice());
}

$GLOBALS['pageTitle'] = "Birthday Gifts | Gifting";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?= $pageTitle ?></title>
  <style>
    body {
      font-family: Georgia, serif;
      background-color: #fffde7;
      margin: 0;
      padding: 40px 20px;
      color: #333;
    }
    h1 {
      text-align: center;
      color: #ff6f00;
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
      color: #ff6f00;
      font-weight: bold;
    }
    .back-link {
      text-align: center;
      margin-bottom: 30px;
    }
    .back-link a {
      background-color: #ff6f00;
      color: white;
      padding: 10px 20px;
      border-radius: 5px;
      text-decoration: none;
      font-weight: bold;
      transition: background-color 0.3s ease;
    }
    .back-link a:hover {
      background-color: #e65100;
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
      height: 420px;
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
  <?php foreach ($birthdayGifts as $gift): ?>
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

