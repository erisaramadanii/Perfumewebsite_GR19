<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dropdown Menu</title>
  <style>
    /* Navbar container */
    .navbar {
      display: flex;
      align-items: center;
      background-color: #c00;
      padding: 10px 20px;
    }

    .logo {
      font-size: 24px;
      font-weight: bold;
      color: white;
      margin-right: 40px;
    }

    .navbar-item {
      position: relative;
      margin-right: 20px;
      color: white;
      cursor: pointer;
      padding: 10px;
    }

    .dropdown-menu {
      opacity: 0;
      visibility: hidden;
      position: absolute;
      top: 40px;
      left: 0;
      background-color: white;
      color: black;
      padding: 10px;
      min-width: 200px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.2);
      z-index: 1000;
      transition: opacity 0.3s ease, visibility 0.3s ease;
    }

    .navbar-item:hover .dropdown-menu {
      opacity: 1;
      visibility: visible;
    }

    .dropdown-menu a {
      display: block;
      padding: 5px 0;
      text-decoration: none;
      color: black;
    }

    .dropdown-menu a:hover {
      text-decoration: underline;
    }

    /* Fotoja që mbulon krejt faqen */
    .full-background {
      width: 100%;
      height: 100vh;
      background-image: url('images/photo4.jpg');
      background-size: cover;
      background-position: center;
      position: relative;
      margin-top:0;
    }

    .full-background .scandal-text {
      position: absolute;
      top: 20%;
      left: 50px;
      color: white;
      font-size: 50px;
      font-weight: bold;
      text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.7);
    }

    /* Fotoja që është në mes */
    .center-photo {
      display: block;
      margin-left: auto;
      margin-right: auto;
      width: 40%;
      height: auto;
    }

    /* Seksioni me 4 paragrafa horizontalisht */
    .text-section {
      display: flex;
      justify-content: space-around;
      align-items: flex-start;
      padding: 100px 20px;
      background-color: #f9f9f9;
      gap: 20px;
      flex-wrap: wrap;
    }

    .text-section div {
      flex: 1;
      max-width: 250px;
      font-size: 16px;
      line-height: 1.7;
      color: #333;
      background-color: white;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
      min-height: 200px;
    }

    /* Seksioni FRAGRANCES */
    .fragrances-section {
      padding: 60px 20px;
      text-align: center;
      background-color: #f0f0f0;
    }

    .fragrances-section h2 {
      font-size: 30px;
      color: #333;
    }

    /* Seksioni i fotove */
    .photo-row {
      display: flex;
      justify-content: center;
      gap: 30px;
      padding: 100px 20px;
      background-color: #fff;
      flex-wrap: wrap;
    }

    .photo-box {
      position: relative;
      width: 300px;
      height: 400px;
      overflow: hidden;
      border-radius: 12px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.15);
    }

    .photo-box img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: block;
      transition: transform 0.3s ease;
    }

    .photo-box:hover img {
      transform: scale(1.05); /* Efekti kur kalon mausi mbi foton */
    }

    /* Teksti mbi foto */
    .photo-text {
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
      padding: 15px;
      background: rgba(0,0,0,0.6);
      color: #fff;
      text-align: center;
      font-size: 18px;
      opacity: 0;
      transition: opacity 0.3s ease;
    }

    .photo-box:hover .photo-text {
      opacity: 1;
    }

    /* Fotoja që mbulon krejt background-in */
    .full-background-img {
      width: 100%;
      height: 100vh;
      background-image: url('images/photo11.jpg');
      background-size: cover;
      background-position: center;
      position: relative;
    }

    /* Hapësira shtesë pas fotos 11 dhe poshtë fotos 12 dhe 13 */
    .spacer {
      height: 50px;
    }

    /* Seksioni me tekst dhe foto */
    .content-section {
      display: flex;
      justify-content: space-between;
      padding: 50px 20px;
      gap: 40px;
    }

    .text-box {
      width: 50%;
      font-size: 18px;
      color: #333;
      padding: 20px;
      background-color: #f9f9f9;
      border-radius: 10px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .image-box {
      width: 45%;
      height: auto;
      position: relative;
      border-radius: 10px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .image-box img {
      width: 100%;
      height: auto;
      object-fit: cover;
    }

    .section-title {
      font-size: 30px;
      font-weight: bold;
      color: #333;
      margin-bottom: 20px;
    }

    .section-paragraph {
      font-size: 18px;
      line-height: 1.6;
      color: #555;
    }

    /* Fotoja dhe paragrafi i ri poshtë */
    .new-content-section {
      display: flex;
      justify-content: space-between;
      padding: 50px 20px;
      gap: 40px;
    }

    .new-text-box {
      width: 50%;
      font-size: 18px;
      color: #333;
      padding: 20px;
      background-color: #f9f9f9;
      border-radius: 10px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .new-image-box {
      width: 45%;
      height: auto;
      position: relative;
      border-radius: 10px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .new-image-box img {
      width: 100%;
      height: auto;
      object-fit: cover;
    }

    /* Foto radhazi me 6 imazhe */
    .six-photo-row {
      display: flex;
      justify-content: center;
      gap: 30px;
      padding: 100px 20px;
      background-color: #fff;
      flex-wrap: wrap;
    }

    .six-photo-box {
      position: relative;
      width: 300px;
      height: 400px;
      overflow: hidden;
      border-radius: 12px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.15);
    }

    .six-photo-box img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: block;
      transition: transform 0.3s ease;
    }

    .six-photo-box:hover img {
      transform: scale(1.05); /* Efekti kur kalon mausi mbi foton */
    }

    /* Teksti mbi fotot */
    .six-photo-text {
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
      padding: 15px;
      background: rgba(0,0,0,0.6);
      color: #fff;
      text-align: center;
      font-size: 18px;
      opacity: 0;
      transition: opacity 0.3s ease;
    }

    .six-photo-box:hover .six-photo-text {
      opacity: 1;
    }

    /* Hapësira shtesë pas fotos 11 dhe poshtë fotos 12 dhe 13 */
    .spacer {
      height: 50px;
    }
  </style>
</head>
<body>

<!-- Navbar -->
<div class="navbar">
  <div class="logo">PERFUME SHOP</div>
  <div class="navbar-item">
    WOMEN'S
    <div class="dropdown-menu">
      <a href="#">Shop All Women's</a>
      <a href="#">Women's Bestsellers</a>
      <a href="#">Luxury Perfumes</a>
      <a href="#">Gift Sets</a>
    </div>
  </div>
  <div class="navbar-item">
    MEN'S
    <div class="dropdown-menu">
      <a href="#">Shop All Men's</a>
      <a href="#">Men's Bestsellers</a>
      <a href="#">Luxury Perfumes</a>
      <a href="#">Gift Sets</a>
    </div>
  </div>
  <div class="navbar-item">
    OFFERS
    <div class="dropdown-menu">
      <a href="#">Today's Deals</a>
      <a href="#">Weekly Offers</a>
      <a href="#">Clearance</a>
    </div>
  </div>
  <div class="navbar-item">
    GIFTING
    <div class="dropdown-menu">
      <a href="#">Gift Sets</a>
      <a href="#">For Her</a>
      <a href="#">For Him</a>
      <a href="#">Birthday Gifts</a>
    </div>
  </div>
</div>

<!-- Fotoja që është në mes -->
<img src="images/photo3.jpg" alt="Jean Paul Gaultier" class="center-photo">

<!-- Fotoja e dytë + SCANDAL -->
<div class="full-background">
  <div class="scandal-text">SCANDAL</div>
</div>

<!-- Seksioni FRAGRANCES -->
<div class="fragrances-section">
  <h2>FRAGRANCES</h2>

  <!-- Seksioni me 3 foto dhe tekst mbi to kur vendoset mausi -->
  <div class="photo-row">
    <div class="photo-box">
      <img src="images/photo5.png">
      <div class="photo-text">SCANDAL INTENSE</div>
    </div>
    <div class="photo-box">
      <img src="images/photo6.jpg">
      <div class="photo-text">SCANDAL ABSOLUT</div>
    </div>
    <div class="photo-box">
      <img src="images/photo7.jpg">
      <div class="photo-text">SCANDAL LE PARFUM</div>
    </div>
  </div>

  <!-- Seksioni i dytë me 3 foto -->
  <div class="photo-row">
    <div class="photo-box">
      <img src="images/photo8.jpg" alt="Foto 8">
      <div class="photo-text">SCANDAL</div>
    </div>
    <div class="photo-box">
      <img src="images/photo9.jpg" alt="Foto 9">
      <div class="photo-text">SO SCANDAL!</div>
    </div>
    <div class="photo-box">
      <img src="images/photo10.jpg" alt="Foto 10">
      <div class="photo-text">SCANDAL</div>
    </div>
  </div>
</div>

<!-- Hapësira shtesë pas fotove -->
<div class="spacer"></div>

<!-- Fotoja që mbulon krejt background-in -->
<div class="full-background-img" style="background-image: url('images/photo11.jpg');"></div>

<!-- Hapësira shtesë pas fotos 11 -->
<div class="spacer"></div>

<!-- Seksioni i ri me tekst dhe foto -->
<div class="content-section">
  <!-- Titulli dhe Paragrafi -->
  <div class="text-box">
    <div class="section-title">A Bottle Named Desire: Le Male Elixir Absolu</div>
    <p class="section-paragraph">
      A scorching breeze strikes the Jean Paul Gaultier ship! Turning up the heat, Le Male Elixir Absolu sets every deck ablaze with its intense aura. Amid the steam of the machines, this new sailor sets the pace with his magnificent muscles, taking the lead. Divine, a captain of all destinies and adventurer driven by desire, this Male will become an obsession in no time.
    </p>
  </div>

  <!-- Fotoja -->
  <div class="image-box">
    <img src="images/photo12.jpg" alt="Le Male Elixir Absolu">
  </div>
</div>

<!-- Foto dhe paragraf i ri poshtë -->
<div class="new-content-section">
  <div class="new-text-box">
    <div class="section-title">The Power of Scandal: A Fragrance for the Bold</div>
    <p class="section-paragraph">
      Set the scene for the evening with a fragrance that exudes power and confidence. The fresh, invigorating notes of Le Male Scandal will keep heads turning wherever you go. Don't just walk into a room; command it. Make every moment a scandalous affair.
    </p>
  </div>

  <div class="new-image-box">
    <img src="images/photo13.jpg" alt="Le Male Scandal">
  </div>
</div>

<!-- Seksioni me 6 foto -->
<div class="six-photo-row">
  <div class="six-photo-box">
    <img src="images/photo14.jpg" alt="Foto 14">
    <div class="six-photo-text">PHOTO 14</div>
  </div>
  <div class="six-photo-box">
    <img src="images/photo15.jpg" alt="Foto 15">
    <div class="six-photo-text">PHOTO 15</div>
  </div>
  <div class="six-photo-box">
    <img src="images/photo16.jpg" alt="Foto 16">
    <div class="six-photo-text">PHOTO 16</div>
  </div>
</div>

<div class="six-photo-row">
  <div class="six-photo-box">
    <img src="images/photo17.jpg" alt="Foto 17">
    <div class="six-photo-text">PHOTO 17</div>
  </div>
  <div class="six-photo-box">
    <img src="images/photo18.jpg" alt="Foto 18">
    <div class="six-photo-text">PHOTO 18</div>
  </div>
  <div class="six-photo-box">
    <img src="images/photo19.jpg" alt="Foto 19">
    <div class="six-photo-text">PHOTO 19</div>
  </div>
</div>
</body>
</html>

