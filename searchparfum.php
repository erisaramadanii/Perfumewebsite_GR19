<?php 
define('CURRENCY', '€');

$products = [
    ["name" => "SCANDAL INTENSE", "image" => "Images/photo5.png", "price" => 174.30],
    ["name" => "SCANDAL ABSOLUT", "image" => "Images/photo6.jpg", "price" => 208.00],
    ["name" => "SCANDAL LE PARFUM", "image" => "Images/photo7.jpg", "price" => 99.00],
    ["name" => "SCANDAL", "image" => "Images/photo8.jpg", "price" => 109.99],
    ["name" => "SO SCANDAL", "image" => "Images/photo9.jpg", "price" => 125.50],
    ["name" => "SCANDAL", "image" => "Images/photo10.jpg", "price" => 101.99],
    ["name" => "SCANDAL NEW", "image" => "Images/photo17.jpg", "price" => 116.99],
    ["name" => "SCANDAL LUXE", "image" => "Images/photo18.jpg", "price" => 106.99],
    ["name" => "SO SCANDAL LUXE", "image" => "Images/photo19.jpg", "price" => 153.99],
    ["name" => "SCANDAL X", "image" => "Images/photo14.jpg", "price" => 113.99],
    ["name" => "SO SCANDAL INTENSE", "image" => "Images/photo15.jpg", "price" => 170.99],
    ["name" => "SCANDAL LE PARFUM", "image" => "Images/photo16.jpg", "price" => 199.99],
  
];

$query = isset($_GET['query']) ? strtolower($_GET['query']) : '';
$sort = isset($_GET['sort']) ? $_GET['sort'] : '';
$results = [];

// Kërkimi në produktet që përputhen me kërkesën
foreach ($products as $product) {
    if (strpos(strtolower($product['name']), $query) !== false) {
        $results[] = $product;
    }
}

// Logjika e radhitjes
if ($sort === 'price_asc') {
    $prices = array_column($results, 'price');
    array_multisort($prices, SORT_ASC, $results);
} elseif ($sort === 'price_desc') {
    $prices = array_column($results, 'price');
    array_multisort($prices, SORT_DESC, $results);
} elseif ($sort === 'name_asc') {
    $names = array_column($results, 'name');
    array_multisort($names, SORT_ASC, $results);
} elseif ($sort === 'name_desc') {
    $names = array_column($results, 'name');
    array_multisort($names, SORT_DESC, $results);
}

?>
<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <title>Choose your fragnance<?php echo htmlspecialchars($query); ?></title>
    <link rel="stylesheet" href="search.css">
</head>
<body>

    <h1>Choose your fragnance<?php echo htmlspecialchars($query); ?></h1>
    
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
        <?php foreach ($results as $product): ?>
            <div class="product-card" onclick="openModal('<?php echo addslashes($product['name']); ?>', '<?php echo $product['image']; ?>', <?php echo $product['price']; ?>)">
                <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" width="150">
                <p class="name"><?php echo $product['name']; ?></p>
                <p class="price"><?php echo CURRENCY . " " . number_format($product['price'], 2); ?></p>
            </div>
        <?php endforeach; ?>
        
       
    
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
            <!-- Butoni Porosit dërgon përdoruesin në ordernow.php me të dhëna -->
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