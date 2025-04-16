<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Gift Sets | Gifting</title>
  <style>
    body {
      margin: 0;
      font-family: 'Georgia', serif;
      background-color: #fef9f6;
      color: #333;
    }

    .container {
      max-width: 1200px;
      margin: auto;
      padding: 40px 20px;
    }

    h1 {
      text-align: center;
      font-size: 36px;
      color: #c40000;
      margin-bottom: 40px;
    }

    .gift-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 30px;
    }

    .gift-item {
      background-color: white;
      border: 1px solid #ddd;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      transition: transform 0.3s ease;
    }

    .gift-item:hover {
      transform: scale(1.03);
    }

    .gift-item img {
      width: 100%;
      height: 250px;
      object-fit: cover;
    }

    .gift-info {
      padding: 20px;
    }

    .gift-info h3 {
      margin-top: 0;
      color: #222;
    }

    .gift-info p {
      font-size: 15px;
      color: #666;
    }
  </style>
</head>
<body>

<div class="container">
  <h1>Gift Sets</h1>
  
  <div class="gift-grid">
    <div class="gift-item">
      <img src="https://via.placeholder.com/300x250?text=Luxury+Set+1" alt="Gift Set 1">
      <div class="gift-info">
        <h3>Luxury Gift Set 1</h3>
        <p>An exclusive collection of elegant fragrances, perfect for special occasions.</p>
      </div>
    </div>

    <div class="gift-item">
      <img src="https://via.placeholder.com/300x250?text=Limited+Edition" alt="Gift Set 2">
      <div class="gift-info">
        <h3>Limited Edition Set</h3>
        <p>Celebrate in style with this limited edition perfume and lotion combination.</p>
      </div>
    </div>

    <div class="gift-item">
      <img src="https://via.placeholder.com/300x250?text=Romantic+Duo" alt="Gift Set 3">
      <div class="gift-info">
        <h3>Romantic Duo</h3>
        <p>A perfect pair: sensual scent and matching accessories for unforgettable moments.</p>
      </div>
    </div>
  </div>
</div>

</body>
</html>
