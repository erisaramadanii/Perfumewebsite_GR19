<?php
session_start();

if (isset($_POST['clear_clicks'])) {
    unset($_SESSION['clicks']);
    // Redirect për të shmangur rifreskimin e POST
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
require_once 'product.php';
?>

<!-- Seksioni për statistikat -->
<div style="margin-top: 50px; padding: 20px; background-color: #f7f7f7; border-top: 2px solid #ccc;">
    <h2 style="text-align: center;">📊 Statistikat e Klikimeve për Parfume</h2>
    <ul style="list-style: none; padding: 0; text-align: center; font-size: 18px;">
        <?php
        if (isset($_SESSION['clicks']) && count($_SESSION['clicks']) > 0) {
            arsort($_SESSION['clicks']); // rendit nga më i klikuari
            $topParfum = array_key_first($_SESSION['clicks']);
            $topClicks = $_SESSION['clicks'][$topParfum];
            echo "<p style='text-align:center; font-weight:bold;'>👑 Parfumi më i klikuar: <span style='color:darkblue;'>$topParfum</span> me <span style='color:darkred;'>$topClicks klikime</span>.</p>";
            echo "<ul style='list-style:none; padding:0;'>";
            foreach ($_SESSION['clicks'] as $parfum => $clicks) {
                echo "<li><strong>$parfum</strong> → $clicks klikime</li>";
            }
            echo "</ul>";
        } else {
            echo "<li>Asnjë parfum nuk është klikuar ende.</li>";
        }
        ?>
    </ul>
    <div style="text-align:center; margin-top: 20px;">
    <button onclick="location.reload();" style="padding: 10px 20px; cursor: pointer;">
        🔄 Refresh për të parë klikimet
    </button>
</div>
</div>
<form method="post" style="text-align: center; margin-bottom: 20px;">
    <button type="submit" name="clear_clicks" style="padding: 10px 20px; background-color: #e74c3c; color: white; border: none; cursor: pointer;">
        🗑️ Fshij Klikimet
    </button>
</form>


<?php
// Produktet
$products = [
    new WomenProduct("SCANDAL INTENSE", "Images/photo5.png", 174.30),
    new WomenProduct("SCANDAL ABSOLUT", "Images/photo6.jpg", 208.00),
    new WomenProduct("SCANDAL LE PARFUM", "Images/photo7.jpg", 99.00),
    new WomenProduct("SCANDAL", "Images/photo8.jpg", 109.99),
    new WomenProduct("SCANDAL INTENSE", "Images/photo9.jpg", 125.50),
    new WomenProduct("SCANDAL ABSOLUT", "Images/photo10.jpg", 101.99),
    new MenProduct("SCANDAL LE PARFUM", "Images/photo17.jpg", 116.99),
    new MenProduct("SCANDAL", "Images/photo18.jpg", 106.99),
    new MenProduct("SCANDAL", "Images/photo19.jpg", 153.99),
    new MenProduct("SCANDAL INTENSE", "Images/photo14.jpg", 113.99),
    new MenProduct("SCANDAL ABSOLUT", "Images/photo15.jpg", 170.99),
    new MenProduct("SCANDAL LE PARFUM", "Images/photo16.jpg", 199.99),
];

// Filtrim dhe renditje
$query = isset($_GET['query']) ? strtolower($_GET['query']) : '';
$sort = $_GET['sort'] ?? '';
$results = [];

foreach ($products as $product) {
    if (strpos(strtolower($product->getName()), $query) !== false) {
        $results[] = $product;
    }
}

switch ($sort) {
    case 'price_asc':
        usort($results, fn($a, $b) => $a->getPrice() <=> $b->getPrice());
        break;
    case 'price_desc':
        usort($results, fn($a, $b) => $b->getPrice() <=> $a->getPrice());
        break;
    case 'name_asc':
        usort($results, fn($a, $b) => strcmp($a->getName(), $b->getName()));
        break;
    case 'name_desc':
        usort($results, fn($a, $b) => strcmp($b->getName(), $a->getName()));
        break;
}
?>

<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <title>Kërko parfum - <?php echo htmlspecialchars($query); ?></title>
    <link rel="stylesheet" href="search.css">
</head>
<body>
<h1><?php echo BRAND_NAME; ?> | Choose your fragrance | <?php echo htmlspecialchars($query); ?></h1>

<form method="get">
    <input type="text" name="query" value="<?php echo htmlspecialchars($query); ?>" placeholder="Kërko parfum...">
    <select name="sort">
        <option value="">Rendit</option>
        <option value="price_asc" <?php if ($sort === 'price_asc') echo 'selected'; ?>>Çmimi më i ulët</option>
        <option value="price_desc" <?php if ($sort === 'price_desc') echo 'selected'; ?>>Çmimi më i lartë</option>
        <option value="name_asc" <?php if ($sort === 'name_asc') echo 'selected'; ?>>Emri A-Z</option>
        <option value="name_desc" <?php if ($sort === 'name_desc') echo 'selected'; ?>>Emri Z-A</option>
    </select>
    <button type="submit">Kërko</button>
</form>

<div class="product-grid">
    <?php if (!empty($results)): ?>
        <?php foreach ($results as $product): ?>
            <div class="product-card" onclick="openModal('<?php echo addslashes($product->getName()); ?>', '<?php echo $product->getImage(); ?>', <?php echo $product->getPrice(); ?>)">
                <img src="<?php echo $product->getImage(); ?>" alt="<?php echo $product->getName(); ?>">
                <div class="product-info">
                    <h3><?php echo $product->getName(); ?> (<?php echo $product->getCategory(); ?>)</h3>
                    <p class="price">€<?php echo number_format($product->getPrice(), 2); ?></p>
                    <form method="post" action="cart.php">
                        <input type="hidden" name="name" value="<?php echo htmlspecialchars($product->getName()); ?>">
                        <input type="hidden" name="image" value="<?php echo $product->getImage(); ?>">
                        <input type="hidden" name="price" value="<?php echo $product->getPrice(); ?>">
                        <input type="hidden" name="quantity" value="1">
                        <input type="hidden" name="ml" value="50">
                        <button type="submit">Shto në shportë 🛒</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Nuk u gjet asnjë produkt për "<?php echo htmlspecialchars($query); ?>".</p>
    <?php endif; ?>
</div>
<!-- Modal -->
<div id="productModal" class="modal" style="display:none;">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <img id="modalImage" src="" alt="">
        <h2 id="modalName"></h2>
        <p>Çmimi bazë: €<span id="basePrice">0.00</span></p>
        <label for="quantity">Sasia:</label>
        <input type="number" id="quantity" value="1" min="1" onchange="calculateTotal()">
        <label for="ml">ML:</label>
        <select id="ml" onchange="calculateTotal()">
            <option value="50">50ml</option>
            <option value="100">100ml</option>
        </select>
        <p>Çmimi total: €<span id="totalPrice">0.00</span></p>
        <p>Ky parfum është klikuar: <span id="totalchoose">0</span></p>
        <button onclick="porosit()">Porosit</button>
    </div>
</div>

<script>
    let basePrice = 0;

   function openModal(name, image, price) {
    // Shto kërkesën për të rritur klikimin
    fetch(`track_click.php?name=${encodeURIComponent(name)}&increment=1`)
        .then(response => response.json())
        .then(data => {
            document.getElementById("totalchoose").textContent = data.clicks;
        });

    document.getElementById("productModal").style.display = "flex";
    document.getElementById("modalName").textContent = name;
    document.getElementById("modalImage").src = image;
    document.getElementById("basePrice").textContent = price.toFixed(2);
    basePrice = price;
    document.getElementById("quantity").value = 1;
    document.getElementById("ml").value = 50;
    calculateTotal();
}


    function closeModal() {
        document.getElementById("productModal").style.display = "none";
    }

    function calculateTotal() {
        const quantity = parseInt(document.getElementById("quantity").value);
        const ml = parseInt(document.getElementById("ml").value);
        let total = basePrice * quantity;
        if (ml === 100) total *= 1.5;
        document.getElementById("totalPrice").textContent = total.toFixed(2);
    }

    function porosit() {
        const name = encodeURIComponent(document.getElementById("modalName").textContent);
        const quantity = document.getElementById("quantity").value;
        const ml = document.getElementById("ml").value;
        const totalPrice = document.getElementById("totalPrice").textContent;
        const url = `ordernow.php?name=${name}&quantity=${quantity}&ml=${ml}&total=${totalPrice}`;
        window.location.href = url;
    }
</script>

</body>
</html>
