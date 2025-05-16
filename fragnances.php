<?php
$bg = isset($_COOKIE['background']) ? $_COOKIE['background'] : 'white';
?>

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
      text-align: left;
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
      text-align: left;
    }

    .section-paragraph {
      font-size: 18px;
      line-height: 1.6;
      color: #555;
      text-align: left;
    }

    /* Fotoja dhe paragrafi i ri poshtë */
    .new-content-section {
      display: flex;
      justify-content: space-between;
      padding: 50px 20px;
      gap: 40px;
      text-align: left;
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

   /* Teksti dhe butoni mbi foto */
.six-photo-box .photo-name {
    position: absolute;
    top: 10px;
    left: 20px;
    color: white;
    font-size: 18px; /* Slightly smaller text */
    font-weight: bold;
    visibility: hidden;
}

.six-photo-box:hover .photo-name {
    visibility: visible;
}

.six-photo-box:hover .shop-now-button {
    visibility: visible;
}

    /* Hapësira shtesë pas fotos 11 dhe poshtë fotos 12 dhe 13 */
    .spacer {
      height: 50px;
    }


    #product-modal {
  display: none;
  position: absolute;  
  background-color: rgba(0, 0, 0, 0.8);
  color: white;
  padding: 20px;
  border-radius: 8px;
  z-index: 1000;
  width: 400px; 
}

  </style>
</head>

<body style="background-color: <?= $bg ?>;">
  
<body>

<!-- Navbar -->
<div class="navbar">
  <div class="logo">PERFUME SHOP</div>

  
   <div class="navbar-item">
    WOMEN'S
    <div class="dropdown-menu">
      <a href="https://www.jeanpaulgaultier.com/ww/en/c/gaultier-divine--gaultier-divine">Shop All Women's</a>
      <a href="https://www.jeanpaulgaultier.com/ww/en/c/fragrances-for-women--all-women">Women's Bestsellers</a>
      <a href="https://www.jeanpaulgaultier.com/ww/en/c/classique--classique">Luxury Perfumes</a>
      <a href="https://www.jeanpaulgaultier.com/ww/en/c/gift-sets--coffrets?srsltid=AfmBOoo2z12vcrGGGIxZffnVW8pciuIZkVlLfukzcU5A4Vszkb1rHnlv">Gift Sets</a>
    </div>
  </div>
  
  <div class="navbar-item">
    MEN'S
    <div class="dropdown-menu">
      <a href="https://www.jeanpaulgaultier.com/ww/en/c/fragrances-for-men--all-men">Shop All Men's</a>
      <a href="https://www.jeanpaulgaultier.com/ww/en/c/scandal-pour-homme">Men's Bestsellers</a>
      <a href="https://www.jeanpaulgaultier.com/ww/en/c/le-beau--le-beau">Luxury Perfumes</a>
      <a href="https://www.jeanpaulgaultier.com/uk/en/p/discovery-kits/discovery-kit-for-him-2024-gift-set-000000000065213238?srsltid=AfmBOorx06xMEIEsj2urkGfWXKrJKCh1lTvqPM13lmINVysuZCCLP8zL">Gift Sets</a>
    </div>
  </div>
  
  <div class="navbar-item">
  <a href="offers.php">OFFERS</a> 
    <div class="dropdown-menu">
      <a href="#">Today's Deals</a>
      <a href="#">Weekly Offers</a>
      <a href="#">Clearance</a>
    </div>
  </div>
  
  <div class="navbar-item">
  <a href="gifting.php">GIFTING</a> 
    <div class="dropdown-menu">
        <a href="gift-sets.php">Gift Sets</a>
      <a href="for-her.php">For Her</a>
      <a href="for-him.php">For Him</a>
      <a href="birthday-gifts.php">Birthday Gifts</a>
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


  <a href="searchparfum.php" style="text-decoration: none; color: white;">
  <div style="background-color: red; padding: 10px; text-align: center;">
    <h2 style="margin: 0;">SHOP NOW</h2>
  </div>
</a>



<div class="six-photo-row">
    <div class="six-photo-box">
      <img src="images/photo5.png">
      <div class="photo-name">SCANDAL INTENSE</div>
     
    </div>
    <div class="six-photo-box">
      <img src="images/photo6.jpg">
      <div class="photo-name">SCANDAL ABSOLUT</div>
     
    </div>
    <div class="six-photo-box">
      <img src="images/photo7.jpg">
      <div class="photo-name">SCANDAL LE PARFUM</div>
    
    </div>
  </div>

  <div class="six-photo-row">
    <div class="six-photo-box">
      <img src="images/photo8.jpg">
      <div class="photo-name">SCANDAL</div>
      
    </div>
    <div class="six-photo-box">
      <img src="images/photo9.jpg">
      <div class="photo-name">SO SCANDAL!</div>
      
    </div>
    <div class="six-photo-box">
      <img src="images/photo10.jpg">
      <div class="photo-name">SCANDAL</div>
   
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
    <div class="text-box">
      <div class="section-title">A Bottle Named Desire: Le Male Elixir Absolut</div>
      <br="section-paragraph">
      <br></br>
        A scorching breeze strikes the</br>
         Jean Paul Gaultier ship! </br>
         Turning up the heat, </br>
         Le Male Elixir Absolut </br>
         sets every deck ablaze with its intense aura...
      </p>
    </div>

  <!-- Fotoja -->
  <div class="image-box">
    <img src="images/photo12.jpg" alt="Le Male Elixir Absolu">
  </div>
</div>

<div class="new-content-section">
    <div class="new-text-box">
      <div class="section-title">The Power of Scandal: A Fragrance for the Bold</div>
      <br="section-paragraph">
      <br></br>
        Set the scene for the evening with a </br>
        fragrance that exudes power and confidence...
      </p>
    </div>

  <div class="new-image-box">
    <img src="images/photo13.jpg" alt="Le Male Scandal">
  </div>
</div>


<!-- Seksioni FRAGRANCES -->
<div class="fragrances-section">
  <h2>FRAGRANCES</h2>


  <a href="searchparfum.php" style="text-decoration: none; color: white;">
  <div style="background-color: red; padding: 10px; text-align: center;">
    <h2 style="margin: 0;">SHOP NOW</h2>
  </div>
</a>



  <!-- Seksioni me 3 foto të tjera -->
  <div class="six-photo-row">
    <div class="six-photo-box">
      <img src="images/photo17.jpg">
      <div class="photo-name">SCANDAL NEW</div>
     
    </div>
    <div class="six-photo-box">
      <img src="images/photo18.jpg">
      <div class="photo-name">SCANDAL LUXE</div> 
    
    </div>
    <div class="six-photo-box">
      <img src="images/photo19.jpg">
      <div class="photo-name">SO SCANDAL LUXE</div>
      
    </div>
  </div>

 <!-- Seksioni me 3 foto të tjera -->
 <div class="six-photo-row">
    <div class="six-photo-box">
      <img src="images/photo14.jpg">
      <div class="photo-name">SCANDAL X</div>
     
    </div>
    <div class="six-photo-box">
      <img src="images/photo15.jpg">
      <div class="photo-name">SO SCANDAL INTENSE</div>
     
    </div>
    <div class="six-photo-box">
      <img src="images/photo16.jpg">
      <div class="photo-name">SCANDAL LE PARFUM</div>
    
    </div>
  </div>
</div>



</body>
</html>

