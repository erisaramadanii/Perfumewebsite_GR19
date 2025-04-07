<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Products</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include('navbar.php'); ?>

<?php include('navbar.php'); ?> <!-- nëse ke menu të përbashkët -->

<h1>Produktet</h1>

<div class="products">
  <!-- Këtu mundesh me shfaq produktet nga databaza -->
  <p>Ky është faqja e produkteve.</p>
</div>

</body>
</html>

///////////////////////////////////////////////////////////////////////////////////////////////////////////////
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  
  <style>
    html, body {
      margin: 0;
      padding: 0;
      height: 100%;
    }

    body {
      background-image: url('images/photo1.jpg');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      font-family: Arial, sans-serif;
      transition: background-size 0.4s ease; /* Përshtatja e madhësisë së fotos */
    }

    .overlay {
      height: 100%;
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
      color: white;
      text-align: center;
      position: relative;
      opacity: 0;
      transition: opacity 0.4s ease;
    }

    .discover-container {
      margin-top: 20px;
      position: relative;
      height: 50px;
    }

    .discover {
      background-color: rgba(0, 0, 0, 0.8);
      color: white;
      padding: 12px 25px;
      border-radius: 6px;
      text-decoration: none;
      opacity: 0;
      transform: translateY(20px);
      transition: all 0.4s ease;
      pointer-events: none;
      position: absolute;
      top: 0;
      left: 50%;
      transform: translate(-50%, 20px);
    }

    /* Kur kalon maus mbi foton, rritet dhe shfaqet animacioni */
    .overlay:hover {
      opacity: 1;
    }

    .overlay:hover .discover {
      opacity: 1;
      transform: translate(-50%, 0);
      pointer-events: auto;
    }

    body:hover {
      background-size: 110%; /* Rritet fotoja kur kalon mausin mbi të */
    }
  </style>
</head>
<body>

  <div class="overlay">
    <div class="discover-container">
      <a href="fragrances.php" class="discover">Discover More</a>
    </div>
  </div>

</body>
</html>
