<?php
$products = [
    ["name" => "Scandal", "image" => "parfum3.png", "price" => "174.30"],
    ["name" => "Scandal", "image" => "parfum2.png", "price" => "108.00"],
    ["name" => "Scandal", "image" => "parfum4.png", "price" => "99.00"],
    ["name" => "Scandal", "image" => "parfum6.png", "price" => "109.99"],
    ["name" => "Scandal", "image" => "man8.png", "price" => "125.50"],
    ["name" => "Scandal", "image" => "man9.png", "price" => "101.99"],
    ["name" => "Scandal", "image" => "parfum9.png", "price" => "116.99"],
    ["name" => "Scandal", "image" => "gold.png", "price" => "106.99"],
    ["name" => "La male", "image" => "man2.png", "price" => "153.99"],
    ["name" => "La male", "image" => "man3.png", "price" => "113.99"],
    ["name" => "La male", "image" => "man5.png", "price" => "170.99"],
    ["name" => "La male", "image" => "man6.png", "price" => "199.99"],
    ["name" => "La male", "image" => "man7.png", "price" => "145.99"],
    ["name" => "divine", "image" => "divine.jpg", "price" => "164.99"],
    ["name" => "La belle", "image" => "parfum7.png", "price" => "153.99"],
    ["name" => "La belle", "image" => "red.png", "price" => "145.99"],
    ["name" => "La belle", "image" => "parfum8.png", "price" => "113.99"],
    ["name" => "La belle", "image" => "parfum10.png", "price" => "170.99"],
    ["name" => "La belle", "image" => "parfum11.png", "price" => "199.99"],
    ["name" => "La belle", "image" => "parfum12.png", "price" => "145.99"],
];

$query = isset($_GET['query']) ? strtolower($_GET['query']) : '';
$sort = isset($_GET['sort']) ? $_GET['sort'] : '';

$results = [];

foreach ($products as $product) {
    if (strpos(strtolower($product['name']), $query) !== false) {
        $results[] = $product;
    }
}

// Sortimi në bazë të çmimit
if ($sort === 'price_asc') {
    usort($results, fn($a, $b) => $a['price'] <=> $b['price']);
} elseif ($sort === 'price_desc') {
    usort($results, fn($a, $b) => $b['price'] <=> $a['price']);
}
?>

<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <title>Rezultatet për "<?php echo htmlspecialchars($query); ?>"</title>
    <link rel="stylesheet" href="search.css">
   
</head>
<body>

<h1>Rezultatet për "<?php echo htmlspecialchars($query); ?>"</h1>

<!-- Dropdown për sortim -->
<div class="sort-form">
    <form method="get">
        <input type="hidden" name="query" value="<?php echo htmlspecialchars($query); ?>">
        <label for="sort">Radhit sipas:</label>
        <select name="sort" id="sort" onchange="this.form.submit()">
            <option value="">Radhit sipas</option>
            <option value="price_asc" <?php if ($sort === 'price_asc') echo 'selected'; ?>>Çmimi më i lirë</option>
            <option value="price_desc" <?php if ($sort === 'price_desc') echo 'selected'; ?>>Çmimi më i lartë</option>
        </select>
    </form>
</div>

<!-- Produktet -->
<div class="product-grid">
    <?php foreach ($results as $product): ?>
        <div class="product-card">
            <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" width="150">
            <p class="name"><?php echo $product['name']; ?></p>
            <p class="price">€ <?php echo $product['price']; ?></p>
        </div>
    <?php endforeach; ?>

    <?php if (empty($results)) echo "<p>No products found.</p>"; ?>
</div>

</body>
</html>
