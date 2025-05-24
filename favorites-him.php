<?php
$pageTitle = "Favoritët për Meshkuj";
$favoritesFile = "favorites_him.txt";
$favorites = [];

if (file_exists($favoritesFile)) {
    $lines = file($favoritesFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $favorites = array_unique($lines); // heq dublikimet
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?= $pageTitle ?></title>
  <style>
    body {
      font-family: Georgia, serif;
      background-color: #f9f9f9;
      margin: 0;
      padding: 40px 20px;
      color: #333;
    }
    h1 {
      text-align: center;
      color: #212121;
      font-size: 36px;
      margin-bottom: 30px;
    }
    ul {
      list-style-type: none;
      padding: 0;
      max-width: 600px;
      margin: 0 auto;
    }
    li {
      background-color: #fff;
      margin: 10px 0;
      padding: 15px 20px;
      border-radius: 8px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
      font-size: 18px;
    }
    .back-link {
      text-align: center;
      margin-top: 30px;
    }
    .back-link a {
      background-color: #212121;
      color: white;
      padding: 10px 20px;
      border-radius: 5px;
      text-decoration: none;
      font-weight: bold;
      transition: background-color 0.3s ease;
    }
    .back-link a:hover {
      background-color: #000;
    }
  </style>
</head>
<body>

<h1><?= $pageTitle ?></h1>

<?php if (!empty($favorites)): ?>
  <ul>
    <?php foreach ($favorites as $fav): ?>
      <li><?= htmlspecialchars($fav) ?></li>
    <?php endforeach; ?>
  </ul>
<?php else: ?>
  <p style="text-align:center;">Nuk ka asnjë parfum të shtuar në favoritë për meshkuj.</p>
<?php endif; ?>

<div class="back-link">
  <a href="for-him.php">← Kthehu te For Him</a>
</div>

</body>
</html>
