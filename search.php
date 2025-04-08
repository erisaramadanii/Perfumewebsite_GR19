<?php 
define('CURRENCY', '€'); // Define the currency symbol

$products = [
    ["name" => "Scandal for her", "image" => "Images/parfum3.png", "price" => "174.30"],
    ["name" => "Scandal Le Parfum Set", "image" => "Images/parfum2.png", "price" => "208.00"],
    ["name" => "Scandal Eau de toilette", "image" => "Images/parfum4.png", "price" => "99.00"],
    ["name" => "So Scandal", "image" => "Images/parfum6.png", "price" => "109.99"],
    ["name" => "Scandal Pour Homme", "image" => "Images/man8.png", "price" => "125.50"],
    ["name" => "Scandal Pour Homme  Le Parfum", "image" => "Images/man9.png", "price" => "101.99"],
    ["name" => "Scandal Floral", "image" => "Images/parfum9.png", "price" => "116.99"],
    ["name" => "Scandal Gold", "image" => "Images/gold.png", "price" => "106.99"],
    ["name" => "La male perfume", "image" => "Images/man2.png", "price" => "153.99"],
    ["name" => "La male extra", "image" => "Images/man3.png", "price" => "113.99"],
    ["name" => "La male eau de parfum", "image" => "Images/man5.png", "price" => "170.99"],
    ["name" => "La male elixir", "image" => "Images/man6.png", "price" => "199.99"],
    ["name" => "La male pour homme", "image" => "Images/man7.png", "price" => "145.99"],
    ["name" => "divine", "image" => "Images/divine.jpg", "price" => "164.99"],
    ["name" => "La belle her", "image" => "Images/parfum7.png", "price" => "153.99"],
    ["name" => "La belle divine", "image" => "Images/divine.jpg", "price" => "180.99"],
    ["name" => "La belle elixir", "image" => "Images/red.png", "price" => "145.99"],
    ["name" => "La belle parfum", "image" => "Images/parfum8.png", "price" => "113.99"],
    ["name" => "La belle eau de parfum", "image" => "Images/parfum10.png", "price" => "170.99"],
    ["name" => "La belle eau de toilette", "image" => "Images/parfum11.png", "price" => "199.99"],
    ["name" => "La belle fresh", "image" => "Images/parfum12.png", "price" => "145.99"],
];

$query = isset($_GET['query']) ? strtolower($_GET['query']) : '';
$sort = isset($_GET['sort']) ? $_GET['sort'] : '';

$results = [];

foreach ($products as $product) {
    if (strpos(strtolower($product['name']), $query) !== false) {
        $results[] = $product;
    }
}

// Sorting based on price or name
if ($sort === 'price_asc') {
    usort($results, fn($a, $b) => $a['price'] <=> $b['price']);
} elseif ($sort === 'price_desc') {
    usort($results, fn($a, $b) => $b['price'] <=> $a['price']);
} elseif ($sort === 'name_asc') {
    usort($results, fn($a, $b) => strcmp($a['name'], $b['name']));
} elseif ($sort === 'name_desc') {
    usort($results, fn($a, $b) => strcmp($b['name'], $a['name']));
} elseif ($sort === 'price_asc_assoc') {
    $prices = array_column($results, 'price');
    asort($prices);
    $sorted = [];
    foreach ($prices as $key => $value) {
        $sorted[] = $results[$key];
    }
    $results = $sorted;
} elseif ($sort === 'price_desc_assoc') {
    $prices = array_column($results, 'price');
    arsort($prices);
    $sorted = [];
    foreach ($prices as $key => $value) {
        $sorted[] = $results[$key];
    }
    $results = $sorted;
} elseif ($sort === 'name_asc_assoc') {
    $names = array_column($results, 'name');
    asort($names);
    $sorted = [];
    foreach ($names as $key => $value) {
        $sorted[] = $results[$key];
    }
    $results = $sorted;
} elseif ($sort === 'name_desc_assoc') {
    $names = array_column($results, 'name');
    arsort($names);
    $sorted = [];
    foreach ($names as $key => $value) {
        $sorted[] = $results[$key];
    }
    $results = $sorted;
} elseif ($sort === 'ksort') {
    ksort($results);
} elseif ($sort === 'krsort') {
    krsort($results);
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
            <option value="Radhit sipas">Radhit sipas</option>
            <option value="price_asc" <?php if ($sort === 'price_asc') echo 'selected'; ?>>Çmimi më i lirë</option>
            <option value="price_desc" <?php if ($sort === 'price_desc') echo 'selected'; ?>>Çmimi më i lartë</option>
            <option value="name_asc" <?php if ($sort === 'name_asc') echo 'selected'; ?>>Emri A-Z</option>
            <option value="name_desc" <?php if ($sort === 'name_desc') echo 'selected'; ?>>Emri Z-A</option>

        </select>
    </form>
</div>

<!-- Produktet -->
<div class="product-grid">
    <?php foreach ($results as $product): ?>
        <div class="product-card">
            <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" width="150">
            <p class="name"><?php echo $product['name']; ?></p>
            <p class="price"><?php echo CURRENCY . " " . $product['price']; ?></p>
        </div>
    <?php endforeach; ?>

    <?php if (empty($results)) echo "<p>No products found.</p>"; ?>
</div>

</body>
</html>
