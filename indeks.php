<?php
include 'db.php';

$result = $conn->query("SELECT * FROM parfume");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Parfume Jean Paul Gaultier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container my-5">
    <h2 class="mb-4 text-center">Jean Paul Gaultier - Best Sellers</h2>
    <div class="row">
        <?php while($row = $result->fetch_assoc()): ?>
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row['emri']; ?></h5>
                        <p class="card-text"><?php echo $row['pershkrimi']; ?></p>
                        <p><strong>Çmimi:</strong> $<?php echo $row['cmimi']; ?></p>
                        <a href="#" class="btn btn-primary">Buy Now</a>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>
</body>
</html>
