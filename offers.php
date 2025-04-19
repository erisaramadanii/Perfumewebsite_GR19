<?php 
class Parfum{
  public $emri;
  public $foto;
  public $cmimi;
  public $gjinia;

 public function __construct($emri, $cmimi, $gjinia) {
  $this->emri = $emri;
  $this->foto = $foto;
  $this->cmimi = $cmimi;
  $this->gjinia = $gjinia;
}
}
$parfumet = [
  new Parfum(emri: "Classique", foto: "F1_Classique.jpg", cmimi: 55, gjinia: "female"),
  new Parfum(emri: "Scandal", foto: "F1_Scandal.jpg", cmimi: 70, gjinia: "female"),
  new Parfum(emri: "La Belle", foto: "F1_La_Belle.webp.jpg", cmimi: 68, gjinia: "female"),
new Parfum(emri: "So Scandal", foto: "F1_So_Scandal.jpg", cmimi: 78, gjinia: "female"),
  new Parfum(emri: "La Male", foto: "M5_La_Male.jpg", cmimi: 60, gjinia: "male"),
  new Parfum(emri: "La Male Le Parfum", foto: "M2_La_Male_Le_Parfum.jpg", cmimi: 75, gjinia: "male"),
   new Parfum("La Beau", "M3_La_Beau.webp", 65, "male"),
    new Parfum("Ultra Male", "M4_Ultra_Male.jpg", 80, "male"),
];

$gjinia = isset($_GET['gjinia']) ? $_GET['gjinia'] : null;
$sort = $_GET['sort'] ?? null;
$gjiniaArray = is_array($gjinia) ? $gjinia : explode(',', $gjinia);

if ($gjinia) {
    $parfumet = array_filter($parfumet, fn($p) => in_array($p->gjinia, $gjiniaArray));
}

if ($sort === "asc") {
    usort($parfumet, fn($a, $b) => $a->cmimi <=> $b->cmimi);
} elseif ($sort === "desc") {
    usort($parfumet, fn($a, $b) => $b->cmimi <=> $a->cmimi);
}
?>
<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <title>Ofertat e Parfumave</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        h1 {
            text-align: center;
            margin-top: 30px;
            margin-bottom: 10px;
            font-size: 32px;
            color: #333;
        }

        .container {
            display: flex;
            width: 100%;
            max-width: 1200px;
            margin: auto;
            padding: 20px;
            box-sizing: border-box;
        }

        .sidebar {
            width: 280px;
            background-color: #fff;
            padding: 20px;
            border-right: 1px solid #ccc;
            box-shadow: 2px 0 5px rgba(0,0,0,0.05);
            box-sizing: border-box;
            height: fit-content;
            font-size: 16px;
            line-height: 1.6;
        }

        .products {
            display: grid;
            grid-template-columns: repeat(2, 1fr); 
            gap: 50px 60px;
            flex-grow: 1;
            padding: 0 40px;
        }

        .perfume {
            background-color: #fff;
            border: 1px solid #ddd;
            padding: 15px;
            text-align: center;
            border-radius: 10px;
            transition: transform 0.2s;
            box-sizing: border-box;
            position: relative;
            height: 350px;
        }

        .perfume:hover {
            transform: scale(1.03);
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .perfume img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            margin-bottom: 10px;
        }

        .perfume h4 {
            margin: 10px 0 5px;
            font-size: 18px;
        }

        .price {
            font-size: 18px;
            margin-top: 10px;
        }

        .old-price {
            text-decoration: line-through;
            color: #ff0000;
            font-weight: bold;
        }

        .new-price {
            font-weight: bold;
            color: #28a745;
        }

        .buttons {
            position: absolute;
            bottom: 10px;
            left: 10px;
            right: 10px;
            display: flex;
            justify-content: space-between;
            gap: 10px;
            display: none; 
        }

        .perfume:hover .buttons {
            display: flex;
        }

        .btn {
            padding: 5px 10px;
            background-color: #111;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-size: 12px;
            transition: background-color 0.2s;
        }

        .btn:hover {
            background-color: #444;
        }

        .discover {
            background-color: #007bff;
        }

        .shop-now {
            background-color: #28a745;
        }

        .filter-group {
            margin-bottom: 20px;
        }

        .btn {
            margin-top: 15px;
            padding: 10px;
            background-color: #111;
            color: white;
            border: none;
            width: 100%;
            cursor: pointer;
            border-radius: 5px;
        }

        .btn:hover {
            background-color: #444;
        }

        .sort-select {
            width: 100%;
            padding: 5px;
            border-radius: 5px;
        }

        /* Modal styling */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 60%;
            max-width: 400px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .modal-img {
            width: 100%;
            max-height: 200px;
            object-fit: contain;
            margin-bottom: 15px;
        }
/* Input for Quantity and ML */
        .quantity-group {
            display: flex;
            justify-content: space-between;
            margin: 10px 0;
        }

        .quantity-group select, .quantity-group input {
            padding: 5px;
            font-size: 14px;
            border-radius: 5px;
            width: 48%;
        }

        .total-price {
            font-weight: bold;
            color: #28a745;
            margin-top: 10px;
        }

        .order-btn {
            background-color: #007bff;
            color: white;
            padding: 10px;
            border: none;
            width: 100%;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 15px;
        }
        .order-btn:hover {
            background-color: #0056b3;
        }

    </style>
</head>
<body>
<h1>Ofertat e kësaj jave</h1>

<div class="container">
    <!-- Sidebar Filter -->
    <form method="get" class="sidebar">
        <h3>Filtro</h3>

        <div class="filter-group">
            <strong>GJINIA</strong><br>
            <label><input type="checkbox" name="gjinia[]" value="female" <?= in_array('female', $gjiniaArray) ? "checked" : "" ?>> Femra</label><br>
            <label><input type="checkbox" name="gjinia[]" value="male" <?= in_array('male', $gjiniaArray) ? "checked" : "" ?>> Meshkuj</label>
        </div>

        <div class="filter-group">
            <strong>Radhit sipas cmimit</strong><br>
            <select name="sort" class="sort-select">
                <option value="">Zgjedh</option>
                <option value="asc" <?= $sort == "asc" ? "selected" : "" ?>>Çmimi më i lirë</option>
                <option value="desc" <?= $sort == "desc" ? "selected" : "" ?>>Çmimi më i lartë</option>
            </select>
        </div>

        <button type="submit" class="btn">Apliko</button>
    </form>
<!-- Produktet -->
    <div class="products">
        <?php foreach ($parfumet as $p): ?>
            <div class="perfume">
                <img src="images/<?= $p->foto ?>" alt="<?= $p->emri ?>">
                <h4><?= $p->emri ?></h4>
                <div class="price">
                    <span class="old-price"><?= $p->cmimi ?>€</span> <!-- Çmimi i vjetër -->
                    <span class="new-price"><?= round($p->cmimi * 0.9, 2) ?>€</span> <!-- Çmimi i ri me 10% ulje -->
                </div>
                <div class="buttons">
                    <button class="btn discover">Discover</button>
                    <button class="btn shop-now" onclick="showModal('<?= $p->foto ?>', <?= $p->cmimi ?>)">Shop Now</button>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Modal -->
<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <img id="modal-img" class="modal-img" src="" alt="">
        <div class="quantity-group">
            <select id="quantity">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
            </select>

            <select id="ml">
                <option value="50">50 ml</option>
                <option value="100">100 ml</option>
            </select>
        </div>
        <div class="total-price" id="total-price"></div>
        <button class="order-btn" onclick="window.location.href='ordernow.php'">Place Order</button>
    </div>
</div>
<form id="orderForm" action="ordernow.php" method="POST" style="display: none;">
    <input type="hidden" name="foto" id="orderFoto">
    <input type="hidden" name="cmimi" id="orderCmimi">
    <input type="hidden" name="quantity" id="orderQuantity">
    <input type="hidden" name="ml" id="orderML">
    <input type="hidden" name="total" id="orderTotal">
</form>


<script>
    let currentPrice = 0;

    function showModal(image, price) {
        currentPrice = price * 0.9; // Çmimi me 10% ulje
        document.getElementById("myModal").style.display = "block";
        document.getElementById("modal-img").src = "images/" + image;
        document.getElementById("quantity").value = 1;
        document.getElementById("ml").value = 50;
        updateTotal();
    }

    function closeModal() {
        document.getElementById("myModal").style.display = "none";
    }

    function updateTotal() {
        const quantity = document.getElementById("quantity").value;
        const ml = document.getElementById("ml").value;
        const total = (currentPrice * quantity * ml) / 50;
        document.getElementById("total-price").textContent = "Total: " + total.toFixed(2) + "€";
    }

    function placeOrder() {
    // Merr të dhënat nga modal
    const quantity = document.getElementById("quantity").value;
    const ml = document.getElementById("ml").value;
    const total = (currentPrice * quantity * ml) / 50;

    // Plotëso formularin me të dhënat
    document.getElementById("orderFoto").value = document.getElementById("modal-img").src;
    document.getElementById("orderCmimi").value = currentPrice;
    document.getElementById("orderQuantity").value = quantity;
    document.getElementById("orderML").value = ml;
    document.getElementById("orderTotal").value = total.toFixed(2);

    // Dërgo formularin
    document.getElementById("orderForm").submit();
}


    document.getElementById("quantity").addEventListener("change", updateTotal);
    document.getElementById("ml").addEventListener("change", updateTotal);
</script>


</body>
</html>
