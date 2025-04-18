
<?php
require_once 'product.php'; // lidhja me klasën Product

$products = [
    new Product("SCANDAL INTENSE", "Images/photo5.png", 174.30),
    new Product("SCANDAL ABSOLUT", "Images/photo6.jpg", 208.00),
    new Product("SCANDAL LE PARFUM", "Images/photo7.jpg", 99.00),
    new Product("SCANDAL", "Images/photo8.jpg", 109.99),
    new Product("SCANDAL INTENSE", "Images/photo9.jpg", 125.50),
    new Product("SCANDAL ABSOLUT", "Images/photo10.jpg", 101.99),
    new Product("SCANDAL LE PARFUM", "Images/photo17.jpg", 116.99),
    new Product("SCANDAL", "Images/photo18.jpg", 106.99),
    new Product("SCANDAL", "Images/photo19.jpg", 153.99),
    new Product("SCANDAL INTENSE", "Images/photo14.jpg", 113.99),
    new Product("SCANDAL ABSOLUT", "Images/photo15.jpg", 170.99),
    new Product("SCANDAL LE PARFUM", "Images/photo16.jpg", 199.99),

];



$query = isset($_GET['query']) ? strtolower($_GET['query']) : '';
$sort = isset($_GET['sort']) ? $_GET['sort'] : '';
$results = [];

foreach ($products as $product) {
    if (strpos(strtolower($product->getName()), $query) !== false) {
        $results[] = $product;
    }
}


// Sortimi
if ($sort === 'price_asc') {
    usort($results, fn($a, $b) => $a->getPrice() <=> $b->getPrice());
} elseif ($sort === 'price_desc') {
    usort($results, fn($a, $b) => $b->getPrice() <=> $a->getPrice());
} elseif ($sort === 'name_asc') {
    usort($results, fn($a, $b) => strcmp($a->getName(), $b->getName()));
} elseif ($sort === 'name_desc') {
    usort($results, fn($a, $b) => strcmp($b->getName(), $a->getName()));
}
?>


?>

<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <title>Choose your fragrance <?php echo htmlspecialchars($query); ?></title>
    <link rel="stylesheet" href="search.css">
</head>
<body>

<h1>Choose your fragrance <?php echo htmlspecialchars($query); ?></h1>

<div class="sort-form">
    <form method="get">
        <input type="hidden" name="query" value="<?php echo htmlspecialchars($query); ?>">
        <label for="sort">Radhit sipas:</label>
        <select name="sort" id="sort" onchange="this.form.submit()">
            <option value="">Zgjedh një</option>
            <option value="price_asc" <?php if ($sort === 'price_asc') echo 'selected'; ?>>Çmimi më i lirë</option>
            <option value="price_desc" <?php if ($sort === 'price_desc') echo 'selected'; ?>>Çmimi më i lartë</option>
            <option value="name_asc" <?php if ($sort === 'name_asc') echo 'selected'; ?>>Emri A-Z</option>
            <option value="name_desc" <?php if ($sort === 'name_desc') echo 'selected'; ?>>Emri Z-A</option>
        </select>
    </form>
</div>

<div class="product-grid">
    <?php if (!empty($results)): ?>
        <?php foreach ($results as $product): ?>
            <div class="product-card" onclick="openModal('<?php echo addslashes($product->getName()); ?>', '<?php echo $product->getImage(); ?>', <?php echo $product->getPrice(); ?>)">
                <img src="<?php echo $product->getImage(); ?>" alt="<?php echo $product->getName(); ?>">
                <div class="product-info">
                    <h3><?php echo $product->getName(); ?></h3>
                    <p class="price">€<?php echo number_format($product->getPrice(), 2); ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No products found.</p>
    <?php endif; ?>
</div>

<!-- MODAL -->
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
        <button onclick="porosit()">Porosit</button>
    </div>
</div>

<script>
    let basePrice = 0;

    function openModal(name, image, price) {
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
