<?php
session_start();

// Inicializo shportën nëse nuk ekziston
if (!isset($_SESSION['shporta'])) {
    $_SESSION['shporta'] = [];
}

// Funksion për të ruajtur parfum në shportë
function ruajNeShporte($item) {
    $_SESSION['shporta'][] = $item;
}

// Hiq parfum nga shporta sipas indexit
if (isset($_POST['remove']) && isset($_POST['index'])) {
    $index = $_POST['index'];
    if (isset($_SESSION['shporta'][$index])) {
        unset($_SESSION['shporta'][$index]);
        $_SESSION['shporta'] = array_values($_SESSION['shporta']);
    }
    header("Location: cart.php");
    exit();
}

// Zbraze krejt shportën
if (isset($_POST['clear'])) {
    $_SESSION['shporta'] = [];
    header("Location: cart.php");
    exit();
}

// Shto parfum nëse nuk ekziston
if (isset($_POST['name'], $_POST['price'], $_POST['image'], $_POST['quantity'], $_POST['ml'])) {
    $newItem = [
        'name' => $_POST['name'],
        'price' => floatval($_POST['price']),
        'image' => $_POST['image'],
        'quantity' => intval($_POST['quantity']),
        'ml' => intval($_POST['ml'])
    ];

    $alreadyExists = false;
    foreach ($_SESSION['shporta'] as $item) {
        if ($item['name'] === $newItem['name'] && $item['ml'] === $newItem['ml']) {
            $alreadyExists = true;
            break;
        }
    }

    if (!$alreadyExists) {
        ruajNeShporte($newItem);
        $_SESSION['alert'] = "✅ Parfumi u shtua me sukses në shportë!";
    } else {
        $_SESSION['alert'] = "⚠️ Ky parfum është tashmë në shportë.";
    }

    header("Location: cart.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <title>Shporta</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to right, #f4d8e4, #fbeff4);
            color: #333;
        }

        h1 {
            text-align: center;
            color: white;
            background-color: #c94fa7;
            padding: 20px;
            border-radius: 0 0 15px 15px;
            animation: fadeInDown 1s ease-in-out;
            margin: 0;
        }

        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .product-card {
            border: 1px solid #ccc;
            margin: 15px;
            padding: 15px;
            width: 230px;
            display: inline-block;
            vertical-align: top;
            text-align: center;
            position: relative;
            background-color: white;
            border-radius: 14px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.1);
        }

        .product-card:hover {
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
            transition: 0.3s;
        }

        img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }

        .remove-btn {
            position: absolute;
            top: 5px;
            right: 5px;
        }

        .actions {
            text-align: center;
            margin: 30px 0;
        }

        .empty-cart {
            text-align: center;
            color: #663399;
            font-size: 1.5em;
            background-color: #f3e6ff;
            padding: 30px;
            border-radius: 12px;
            width: 60%;
            margin: 100px auto;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .order-button {
            display: block;
            margin: 40px auto;
            padding: 12px 25px;
            background-color: #9933cc;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none;
            text-align: center;
        }

        .order-button:hover {
            background-color: #b266ff;
        }

        .product-card p {
            margin: 8px 0;
        }

        button {
            cursor: pointer;
            background-color: transparent;
            border: none;
            font-size: 18px;
        }

        .total-summary {
            text-align: center;
            font-size: 1.4em;
            margin: 20px;
            color: #5a005a;
            background-color: #fff0fb;
            padding: 15px;
            border-radius: 12px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
            box-shadow: 0 3px 12px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>

<h1>🛒 Shporta e parfumave</h1>

<?php
if (isset($_SESSION['alert'])) {
    echo '<div style="background-color: #ffe0e0; color: #b30000; padding: 10px; text-align: center; border-radius: 8px; margin: 10px auto; max-width: 600px;">' . $_SESSION['alert'] . '</div>';
    unset($_SESSION['alert']);
}
?>

<?php if (!empty($_SESSION['shporta'])): ?>
    <?php 
    $total = 0;
    foreach ($_SESSION['shporta'] as $index => $item): 
        $subtotal = $item['price'] * $item['quantity'];
        if ($item['ml'] == 100) {
            $subtotal *= 1.5;
        }
        $total += $subtotal;
    ?>
        <div class="product-card">
            <form method="post" class="remove-btn">
                <input type="hidden" name="index" value="<?php echo $index; ?>">
                <button type="submit" name="remove" title="Hiqe nga shporta">❌</button>
            </form>
            <img src="<?php echo $item['image']; ?>" alt="Foto e parfumit">
            <h3><?php echo htmlspecialchars($item['name']); ?> (<?php echo $item['ml']; ?>ml)</h3>
            <p>Sasia: <?php echo $item['quantity']; ?></p>
            <p>Çmimi për copë: €<?php echo number_format($item['price'], 2); ?></p>
            <p><strong>Çmimi total: €<?php echo number_format($subtotal, 2); ?></strong></p>
        </div>
    <?php endforeach; ?>

    <div class="total-summary">
        💰 Totali i porosisë: <strong>€<?php echo number_format($total, 2); ?></strong>
    </div>
<?php else: ?>
    <div class="empty-cart">
        🧺 Shporta është bosh për momentin. <br> Shto parfume për të vazhduar me porosinë!
    </div>
<?php endif; ?>

<div class="actions">
    <a href="searchparfum.php">🔍 Kthehu te kërkimi</a>

    <?php if (!empty($_SESSION['shporta'])): ?>
        <form method="post">
            <button type="submit" name="clear">🗑️ Zbraze shportën</button>
        </form>
    <?php endif; ?>
</div>

<?php if (!empty($_SESSION['shporta'])): ?>
    <a href="ordernow.php" class="order-button">🛍️ Porosit tani</a>
<?php endif; ?>

</body>
</html>
