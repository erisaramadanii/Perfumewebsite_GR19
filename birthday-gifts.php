<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Birthday Gifts | Gifting</title>
  <style>
    body {
      margin: 0;
      font-family: 'Georgia', serif;
      background-color: #fffde7;
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
      color: #ff6f00;
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
  <h1>Birthday Gift Ideas</h1>
  
  <div class="gift-grid">
    <div class="gift-item">
      <img src="https://via.placeholder.com/300x250?text=Birthday+Box" alt="Birthday Box">
      <div class="gift-info">
        <h3>Birthday Box</h3>
        <p>A colorful collection of fragrances with celebratory packaging.</p>
      </div>
    </div>

    <div class="gift-item">
      <img src="https://via.placeholder.com/300x250?text=Golden+Surprise" alt="Golden Surprise">
      <div class="gift-info">
        <h3>Golden Surprise</h3>
        <p>A premium gift set designed for unforgettable birthday moments.</p>
      </div>
    </div>

    <div class="gift-item">
      <img src="https://via.placeholder.com/300x250?text=Sweet+Celebration" alt="Sweet Celebration">
      <div class="gift-info">
        <h3>Sweet Celebration</h3>
        <p>Sweet-scented, elegant, and joyful — the perfect birthday perfume.</p>
      </div>
    </div>
  </div>
</div>

</body>
</html>
