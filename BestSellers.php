<!DOCTYPE html>
<html>
<head>
    <title>Jean Paul Gaultier Best Sellrs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>

<?php
// Array me produktet – të dhënat ruhen këtu
$products = [
    [
        "name" => "Le Male Eau de Toilette",
        "description" => "Iconic fragrance with notes of lavender, mint, and vanilla.",
        "price" => 89.99,
        "image" => "images/le-male.jpg"
    ],
    [
        "name" => "Scandal Pour Homme",
        "description" => "A bold, masculine fragrance with caramel and clary sage.",
        "price" => 102.50,
        "image" => "images/scandal.jpg"
    ],
    [
        "name" => "Le Beau Eau de Parfum",
        "description" => "Sensual blend of coconut wood and tonka bean.",
        "price" => 96.75,
        "image" => "images/le-beau.jpg"
    ]
];
?>

<div class="container my-5">
    <h1 class="text-center mb-4">Jean Paul Gaultier Best Sellers</h1>
    <div class="row">
        <?php foreach ($products as $product): ?>
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    <img src="<?php echo $product['image']; ?>" class="card-img-top" alt="<?php echo $product['name']; ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $product['name']; ?></h5>
                        <p class="card-text"><?php echo $product['description']; ?></p>
                        <p class="card-text"><strong>$<?php echo $product['price']; ?></strong></p>
                        <a href="#" class="btn btn-primary">Buy Now</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

</body>
</html>
<style>
    /* Reset bazik */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    background-color: #f5f5f5;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    color: #333;
}

/* Titulli kryesor */
h1 {
    font-weight: bold;
    font-size: 2.5rem;
    color: #2c2c2c;
}

/* Karta e produktit */
.card {
    border: none;
    border-radius: 20px;
    overflow: hidden;
    transition: all 0.3s ease-in-out;
    background-color: white;
    box-shadow: 0 8px 18px rgba(0, 0, 0, 0.1);
}

.card:hover {
    transform: translateY(-10px);
    box-shadow: 0 12px 22px rgba(0, 0, 0, 0.15);
}

.card-img-top {
    height: 300px;
    object-fit: cover;
    border-bottom: 1px solid #eee;
}

/* Titulli i produktit */
.card-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: #1e1e1e;
}

/* Përshkrimi */
.card-text {
    font-size: 0.95rem;
    color: #555;
}

/* Butoni "Blej Tani" */
.btn-primary {
    background-color: #cc3366;
    border: none;
    border-radius: 50px;
    padding: 10px 20px;
    transition: background-color 0.3s ease;
    font-weight: 600;
}

.btn-primary:hover {
    background-color: #b92c5d;
}

/* Responsive margjina për pajisje të vogla */
@media (max-width: 768px) {
    .card-img-top {
        height: 250px;
    }

    h1 {
        font-size: 2rem;
    }
}

</style>
