<?php
session_start();

// Inicializo shportën nëse nuk ekziston
if (!isset($_SESSION['shporta'])) {
    $_SESSION['shporta'] = [];
}

// Hiq parfum nga shporta sipas indexit
if (isset($_POST['remove']) && isset($_POST['index'])) {
    $index = $_POST['index'];
    if (isset($_SESSION['shporta'][$index])) {
        unset($_SESSION['shporta'][$index]);
        $_SESSION['shporta'] = array_values($_SESSION['shporta']); // Rindekso array-n
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

    // Kontrollo nëse ekziston i njëjti parfum me të njëjtin ml
    $alreadyExists = false;
    foreach ($_SESSION['shporta'] as $item) {
        if ($item['name'] === $newItem['name'] && $item['ml'] === $newItem['ml']) {
            $alreadyExists = true;
            break;
        }
    }

    if (!$alreadyExists) {
        $_SESSION['shporta'][] = $newItem;
    } else {
        $_SESSION['alert'] = "Ky parfum është tashmë në shportë.";
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
            background: linear-gradient(to right,rgb(227, 138, 191), #f0e6e6);
            color: #333;
        }

        h1 {
            text-align: center;
            color: white;
            background-color:rgb(204, 51, 158);
            padding: 20px;
            border-radius: 0 0 15px 15px;
            animation: fadeInDown 1s ease-in-out;
            margin: 0;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .product-card {
            border: 1px solid #ccc;
            margin: 10px;
            padding: 10px;
            width: 230px;
            display: inline-block;
            vertical-align: top;
            text-align: center;
            position: relative;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }

        .product-card:hover {
            box-shadow: 0 8px 12px rgba(0,0,0,0.15);
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

        .actions form,
        .actions a {
            display: inline-block;
            margin: 5px;
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
            width: fit-content;
        }

        .order-button:hover {
            background-color: #b266ff;
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
    <?php foreach ($_SESSION['shporta'] as $index => $item): ?>
        <div class="product-card">
            <form method="post" class="remove-btn">
                <input type="hidden" name="index" value="<?php echo $index; ?>">
                <button type="submit" name="remove">❌</button>
            </form>
            <img src="<?php echo $item['image']; ?>" alt="Foto e parfumit">
            <h3><?php echo htmlspecialchars($item['name']); ?> (<?php echo $item['ml']; ?>ml)</h3>
            <p>Sasia: <?php echo $item['quantity']; ?></p>
            <p>Çmimi për copë: €<?php echo number_format($item['price'], 2); ?></p>
            <?php
                $cmimiTotal = $item['price'] * $item['quantity'];
                if ($item['ml'] == 100) {
                    $cmimiTotal *= 1.5;
                }
            ?>
            <p><strong>Çmimi total: €<?php echo number_format($cmimiTotal, 2); ?></strong></p>
        </div>
    <?php endforeach; ?>
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
