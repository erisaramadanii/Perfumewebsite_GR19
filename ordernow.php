<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Porosit Tani</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 40px;
        }
        .order-form {
            max-width: 500px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        label {
            display: block;
            margin-top: 15px;
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        input[type="submit"] {
            background-color: #5cb85c;
            color: white;
            border: none;
            margin-top: 20px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #4cae4c;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 5px;
            margin-top: 20px;
            border: 1px solid #c3e6cb;
        }
    </style>
</head>
<body>

<div class="order-form">
    <h2>Porosit Tani</h2>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $product = htmlspecialchars($_POST['product']);
        $quantity = htmlspecialchars($_POST['quantity']);

        echo "<div class='success'>
                Faleminderit <strong>$name</strong>, porosia për <strong>$quantity x $product</strong> është pranuar. 
                Ne do të kontaktojmë në <strong>$email</strong>.
              </div>";
    } else {
    ?>
    
    <form method="POST" action="ordernow.php">
        <label for="name">Emri:</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="product">Produkti:</label>
        <select id="product" name="product" required>
            <option value="Parfumi Elegance">Parfumi Elegance</option>
            <option value="Parfumi Fresh">Parfumi Fresh</option>
            <option value="Parfumi Lux">Parfumi Lux</option>
        </select>

        <label for="quantity">Sasia:</label>
        <input type="number" id="quantity" name="quantity" min="1" required>

        <input type="submit" value="Dërgo Porosinë">
    </form>

    <?php } ?>
</div>

</body>
</html>
