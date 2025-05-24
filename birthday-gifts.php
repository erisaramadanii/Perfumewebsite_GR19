<?php
session_start();
include "productbirthday.php";

// Produktet
$birthdayGifts = [
    new GiftProduct("Birthday Box", "A colorful collection of fragrances.", 36.99, "Images/F3_La_Belle.webp"),
    new GiftProduct("Golden Surprise", "A premium gift set.", 44.99, "Images/divine.jpg"),
    new GiftProduct("Sweet Celebration", "Sweet-scented, joyful perfume.", 29.99, "Images/freshblue.png")
];

// Sorted
$sortMethod = $_GET['sort'] ?? 'asc';
if ($sortMethod == 'asc') {
    usort($birthdayGifts, fn($a, $b) => $a->getPrice() <=> $b->getPrice());
} elseif ($sortMethod == 'desc') {
    usort($birthdayGifts, fn($a, $b) => $b->getPrice() <=> $a->getPrice());
}

// Add to cart (Session)
if (isset($_GET['add_to_cart'])) {
    $index = (int)$_GET['add_to_cart'];
    $_SESSION['cart'][] = $birthdayGifts[$index]->getName();
    $viewed = $_COOKIE['recently_viewed'] ?? '';
    $viewed .= $birthdayGifts[$index]->getName() . '|';
    setcookie('recently_viewed', $viewed, time() + 3600);
    header("Location: birthday-gifts.php");
    exit;
}

// Send email (popular product)
// if (isset($_GET['send_email'])) {
//     $to = "recipient@example.com";
//     $subject = "Popular Birthday Perfume";
//     $message = "Hello,\n\nYou may like our top birthday product: Golden Surprise - €44.99.";
//     $headers = "From: admin@perfume.com";

//     if (mail($to, $subject, $message, $headers)) {
//         $emailMsg = "Email sent!";
//     } else {
//         $emailMsg = "Failed to send email.";
//     }
// }

$GLOBALS['pageTitle'] = "Birthday Gifts | Gifting";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?= $pageTitle ?></title>
  <style>
    body { font-family: Georgia, serif; background-color: #fffde7; padding: 40px 20px; color: #333; }
    h1 { text-align: center; color: #ff6f00; font-size: 36px; }
    .sort-links, .back-link, .actions, .comments-section { text-align: center; margin: 20px; }
    .grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 30px; }
    .item { background: white; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); overflow: hidden; }
    .item img { width: 100%; height: 420px; object-fit: cover; }
    .info { padding: 20px; }
    .info h3 { margin: 0; color: #222; }
    .info p { font-size: 15px; color: #666; }
    button, a.btn { background-color: #ff6f00; color: white; padding: 8px 16px; border: none; border-radius: 5px; margin: 5px; cursor: pointer; text-decoration: none; display: inline-block; }
    button:hover, a.btn:hover { background-color: #e65100; }
  </style>
</head>
<body>

<h1><?= $pageTitle ?></h1>

<div class="sort-links">
  <strong>Sort by Price:</strong>
  <a href="?sort=asc" class="btn">Low to High</a>
  <a href="?sort=desc" class="btn">High to Low</a>
</div>

<?php if (isset($emailMsg)): ?>
  <p style="text-align:center; color: green;"><strong><?= $emailMsg ?></strong></p>
<?php endif; ?>

<div class="grid">
  <?php foreach ($birthdayGifts as $index => $gift): ?>
    <div class="item">
      <img src="<?= $gift->getImage() ?>" alt="<?= $gift->getName() ?>">
      <div class="info">
        <h3><?= $gift->getName() ?> - €<?= number_format($gift->getPrice(), 2) ?></h3>
        <p><?= $gift->getDescription() ?></p>
        <a href="?add_to_cart=<?= $index ?>" class="btn">Add to Cart</a>
      </div>
    </div>
  <?php endforeach; ?>
</div>


<div class="comments-section">
  <h2>Comments</h2>
  <button onclick="loadComments()">Shiko komentet</button>
  <div id="comments" style="margin-top: 20px;"></div>
</div>

<div class="back-link">
  <a href="gifting.php" class="btn">← Back to Gifting</a>
</div>

<?php
if (isset($_COOKIE['recently_viewed'])) {
    $recent = explode('|', trim($_COOKIE['recently_viewed'], '|'));
    echo "<div style='text-align:center; margin-top:30px;'><h3>Recently Viewed:</h3><ul>";
    foreach (array_unique($recent) as $item) {
        echo "<li>$item</li>";
    }
    echo "</ul></div>";
}
?>

<script>
function loadComments() {
  fetch('comments.php')
    .then(response => response.json())
    .then(data => {
      const commentsDiv = document.getElementById("comments");
      commentsDiv.innerHTML = "";
      data.forEach(c => {
        commentsDiv.innerHTML += `<p><strong>${c.author}</strong> (${c.date}): ${c.comment}</p>`;
      });
    });
}
</script>

</body>
</html>
