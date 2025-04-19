<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Gifting | CarMarketplace</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Georgia', serif;
            background-color: #fff5f5;
            color: #222;
        }

        .container {
            text-align: center;
            padding: 60px 20px;
        }

        h1 {
            font-size: 40px;
            margin-bottom: 50px;
            color: #d10000;
            letter-spacing: 2px;
        }

        .gift-options {
            display: flex;
            justify-content: center;
            gap: 40px;
            flex-wrap: wrap;
        }

        .gift-option {
            background-color: white;
            border: 1px solid #ccc;
            border-radius: 12px;
            padding: 30px;
            width: 220px;
            text-decoration: none;
            color: #222;
            font-weight: bold;
            transition: 0.3s;
            box-shadow: 0 6px 10px rgba(0,0,0,0.1);
            cursor: pointer;
        }

        .gift-option:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.15);
            background-color: #f8f8f8;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Choose a Gifting Category</h1>

    <div class="gift-options">
        <a href="gift-sets.php" class="gift-option">🎁 Gift Sets</a>
        <a href="for-her.php" class="gift-option">💐 For Her</a>
        <a href="for-him.php" class="gift-option">🕴️ For Him</a>
        <a href="birthday-gifts.php" class="gift-option">🎂 Birthday Gifts</a>
    </div>
</div>

</body>
</html>

