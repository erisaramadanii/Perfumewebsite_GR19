<?php
$products = [
    ["name" => "Scandal for her", "image" => "Images/parfum3.png", "price" => 174.30],
    ["name" => "Scandal Le Parfum Set", "image" => "Images/parfum2.png", "price" => 208.00],
    ["name" => "Scandal Eau de toilette", "image" => "Images/parfum4.png", "price" => 99.00],
    ["name" => "So Scandal", "image" => "Images/parfum6.png", "price" => 109.99],
    ["name" => "Scandal Pour Homme", "image" => "Images/man8.png", "price" => 125.50],
    ["name" => "Scandal Pour Homme Le Parfum", "image" => "Images/man9.png", "price" => 101.99],
    ["name" => "Scandal Floral", "image" => "Images/parfum9.png", "price" => 116.99],
    ["name" => "Scandal Gold", "image" => "Images/gold.png", "price" => 106.99],
];

// I ndajmë në dy seksione
$section1 = array_slice($products, 0, 3);
$section2 = array_slice($products, 3, 3);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Produktet Scandal</title>
<style>
    body {
    font-family: Arial, sans-serif;
    padding: 20px;
    background-color: #fafafa;
  }

  h1 {
    text-align: center;
  }

  .section-title {
    text-align: center;
    margin-top: 40px;
    margin-bottom: 10px;
    font-size: 20px;
    color: #444;
  }

  .product-row {
    display: flex;
    justify-content: center;
    gap: 20px;
    margin-bottom: 20px;
    flex-wrap: wrap;
  }

  .product-card {
    width: 200px;
    padding: 10px;
    background: white;
    box-shadow: 0 0 10px rgba(0,0,0,0.2);
    text-align: center;
    cursor: pointer;
    border-radius: 10px;
    transition: transform 0.2s;
  }

  .product-card:hover {
    transform: scale(1.05);
  }

  .product-card img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    border-radius: 10px;
  }

  .modal {
    display: none;
    position: fixed;
    z-index: 100;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0,0,0,0.6);
  }

  .modal-content {
    background-color: #fff;
    margin: 5% auto;
    padding: 30px;
    border-radius: 10px;
    width: 400px;
    text-align: center;
    position: relative;
  }

  .modal-content img {
    width: 100%;
    height: 250px;
    object-fit: cover;
    border-radius: 10px;
  }

  .close {
    position: absolute;
    top: 10px;
    right: 20px;
    font-size: 25px;
    cursor: pointer;
  }

  input[type="number"], select {
    margin: 10px;
    padding: 5px;
    width: 80px;
  }

  button {
    margin-top: 15px;
    padding: 10px 20px;
    background-color: #333;
    color: white;
    border: none;
    cursor: pointer;
    border-radius: 5px;
  }

  button:hover {
    background-color: #555;
  }
</style>
</head>
<body>

<h1>Produktet Scandal</h1>

<div class="section-title">Top Produktet</div>
<div class="product-row">
  <?php foreach ($section1 as $index => $product): ?>
    <div class="product-card" onclick="openModal(<?php echo $index; ?>)">
      <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
      <p class="name"><?php echo $product['name']; ?></p>
      <p class="price">€ <?php echo number_format($product['price'], 2); ?></p>
    </div>
  <?php endforeach; ?>
</div>

<div class="section-title">Të rekomanduara</div>
<div class="product-row">
  <?php foreach ($section2 as $index => $product): ?>
    <div class="product-card" onclick="openModal(<?php echo $index + 3; ?>)">
      <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
      <p class="name"><?php echo $product['name']; ?></p>
      <p class="price">€ <?php echo number_format($product['price'], 2); ?></p>
    </div>
  <?php endforeach; ?>
</div>

<!-- Modal -->
<div id="productModal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeModal()">&times;</span>
    <img id="modalImage" src="" alt="">
    <h2 id="modalName"></h2>
    <p id="modalBasePrice"></p>

    <label for="quantity">Sasia:</label>
    <input type="number" id="quantity" value="1" min="1" onchange="updateTotal()">

    <label for="ml">ML:</label>
    <select id="ml" onchange="updateTotal()">
      <option value="30">30ml</option>
      <option value="50" selected>50ml</option>
      <option value="100">100ml</option>
    </select>

    <p>Çmimi total: <span id="totalPrice"></span></p>
    <button onclick="window.location.href='ordernow.php';">Porosit</button>  
    </div> // qeta perdore per link me niten
</div>

<script>
  const products = <?php echo json_encode($products); ?>;

  function openModal(index) {
    const product = products[index];
    document.getElementById('modalImage').src = product.image;
    document.getElementById('modalName').innerText = product.name;
    document.getElementById('modalBasePrice').innerText = "Çmimi bazë: € " + product.price.toFixed(2);
    document.getElementById('quantity').value = 1;
    document.getElementById('ml').value = 50;
    document.getElementById('productModal').style.display = "block";

    document.getElementById('totalPrice').dataset.base = product.price;
    updateTotal();
  }

  function closeModal() {
    document.getElementById('productModal').style.display = "none";
  }

  function updateTotal() {
    let quantity = parseInt(document.getElementById('quantity').value);
    let ml = parseInt(document.getElementById('ml').value);
    let basePrice = parseFloat(document.getElementById('totalPrice').dataset.base);

    let factor = ml / 50;
    let total = basePrice * factor * quantity;

    document.getElementById('totalPrice').innerText = "€ " + total.toFixed(2);
  }
</script>

</body>
</html>
