<?php
include 'data.php';

$search_results = [];
if (isset($_GET['query'])) {
    $query = strtolower($_GET['query']);
    foreach ($products as $product) {
        if (strpos(strtolower($product['name']), $query) !== false) {
            $search_results[] = $product;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Perfume store</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<script src="script.js"></script>
    <div class="intro-video">
        <video autoplay muted loop playsinline>
            <source src="introvid.mp4" type="video/mp4">
            </video>
            <div class="video-overlay-text">
                <h1>Welcome to Jean Paul Gaultier</h1>
                <p>Where every drop is luxury.</p>
            </div>
        </div>
        <nav class="nav-bar">
        <a id = "logo" href="#">Jean Paul Gaultier</a>
        <div class="nav-bar-links">
            <ul>
            <li><a href="home.php">Home</a></li>
            <li><a href="Products.php">Products</a></li>
            <li><a href="BestSellers.php">Best Sellers</a></li>
            <li><a href="Newarrivals.php">New Arrivals</a></li>
            <li><a href="Contactus.php">Contact Us</a></li>
            <!-- Butoni për kërkim -->
            <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
      
  

            <form action="search.php" method="get" class="search-form">
        <input type="text" name="query" placeholder="Search products..." value="<?= isset($_GET['query']) ? htmlspecialchars($_GET['query']) : '' ?>">
        <button type="submit"></button>
    </form>

    <div class="product-grid">
        <?php if (!empty($search_results)): ?>
            <?php foreach ($search_results as $product): ?>
                <div class="product">
                <img src="<?= htmlspecialchars($result['image']) ?>" alt="<?= htmlspecialchars($result['name']) ?>">
                <h4>
                    <?= htmlspecialchars($product['name']) ?></h4>
                    <p>€ <?= number_format($product['price'], 2) ?></p>
                </div>
            <?php endforeach; ?>
        <?php elseif (isset($_GET['query'])): ?>
            <p style="text-align:center;">S’ka produkte për: <strong><?= htmlspecialchars($_GET['query']) ?></strong></p>
        <?php endif; ?>
    </div>
  

        <button class="button-style">Order Now</button></div>

        </nav>
    <nav class="nav-bar-responsive">
        <a id = "logo" href="#">Jean Paul Gaultier</a>
        <div class="nav-bar-links">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
<!--                <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5"/>
-->              </svg>
        </div>
    </nav>
    
    <div class="container-1">
        <div class="container-text">
            <h1 class="large-text">Your scent is<br> forever remembered.</h1>
            <p>The soft fragrance of her perfume lingered in the air, leaving a trail of sweetness wherever she went.
            </p>
                  </div>
        <div id="image-container-1">
            <!-- <img src="images/first-image.png" alt="image"> -->
        </div>
    </div>

    <div class="container-2">
        <div class="slogan">
            <h1 class="large-text">Jean Paul Gaultier</h1>
            <p>Luxury Defined. One Drop at a Time.</p>
        </div>
        <div>
            <img src="parfum2.png" alt="">
        </div>
        <div class="container-text">
            <h2 class="big-text">Why shop with<br> Jean Paul Gaultier</h2>
            <p> Our team is dedicated to providing outstanding service, answering questions promptly, and ensuring you have a smooth shopping experience.</p>
            <a href="https://www.jeanpaulgaultier.com/ww/en/gaultier-universe/the-designer">
            <button class="button-style">Read more...</button>
        </div>
        </div>
        <section class="video-hero">
  <video autoplay muted loop playsinline class="background-video">
    <source src="divinevideo.mp4" type="video/mp4" />
  </video>
  <div class="overlay-box">
    <h1>LE DIVINE <br> ELIXIR</h1>
    <p>
    Jean Paul Gaultier's Divine perfume is an exquisite blend of floral and oriental notes, creating an intoxicating and luxurious fragrance.<br>
     It embodies sophistication and sensuality, making it a perfect choice for those seeking elegance and allure in every drop.
    </p>
    <a href="https://www.jeanpaulgaultier.com/ww/en/scandal-intense">
  <button>I'M COMING ABOARD</button>
</a>  </div>
</section>
<br><br><br>

<div class="container">
    <div class="left">
      <img src="model.jpg" alt="Scandal Express">
    </div>
    <div class="right">
      <h1>PLAY THE GAME OF<br>SCANDAL EXPRESS</h1>
      <p>
        Ladies and Gentlemen, welcome aboard<br>
        the Scandal Express, Jean Paul<br>
        Gaultier’s private night train where<br>
        nobody ever sleeps. Your one-way<br>
        journey to decadence starts here with<br>
        rowdy passengers and endless fun. So<br>
        open the door to desire and join the<br>
        party.
      </p>
      <p>
        All aboard! It's going to be a long<br>
        night and an eventful ride.
      </p>
      <a href="https://www.jeanpaulgaultier.com/ww/en/scandal-intense-game"><button>I'M GETTING ON</button></a>
    </div>
  </div>




    <div class="container-3">
        <h1 class="large-text">Our Services</h1>
        <div class="container-3-services">
            <div>
                <img src="logos/recommendation.png" alt="">
                <h2>Recommendations</h2>
                <p>Check out the latest gadgets and accessories to complement your purchases.</p>
            </div>
            <div>
                <img src="logos/giftbox.png" alt="">
                <h2>Gifting</h2>
<p>A great option for perfume lovers who love gifts or want to try new scents.</p>            </div>
           
            <div>
                <img src="logos/perfume-spray.png" alt="">
                <h2>Refills</h2>
                <p>Save money and reduce waste with our eco-friendly refillable perfume options.</p>
            </div>
            <div>
                <img src="logos/refund.png" alt="">
                <h2>Returns</h2>
                <p>If you're not completely satisfied, return your product within 30 days for a full refund.</p>
            </div>
        </div>
    </div>

  


  

<br><br><br>

    <footer id="footer">
        <div>
            <h1 class="big-text">Jean Paul Gaultier</h1>
            <p>The irrepressible Jean Paul Gaultier has been creating inclusive fashion since 1976. From growing up in the suburbs, his extraordinary destiny has seen him become one of the greatest couturiers in the world, without attending fashion school. Thanks to his audacity, talent, irreverence and humour, of course!</p>
            <p>&copy; 2024 Jean Paul Gaultier - All rights Reserved</p>
            
        </div>
        <div>
            <h2 class="big-text">Opening Times</h2>
            <p>Monday: Friday: 10.00 - 23.00 
                <br>
                Saturday: 10.00 - 19.00</p>
                
<div id="social-logos">
  <a href="https://www.facebook.com/jean.paul.gaultier/" target="_blank">
    <img src="logos/facebook.png" alt="Facebook">
  </a>
  <a href="https://www.instagram.com/jeanpaulgaultier/" target="_blank">
    <img src="logos/instagram.png" alt="Instagram">
  </a>
  <a href="https://x.com/jpgaultier?lang=en" target="_blank">
    <img src="logos/twitter.png" alt="Twitter">
  </a>
  <a href="https://www.pinterest.com/vlady580/jean-paul-gaultier-fragrances/" target="pinterest">
    <img src="logos/pinterest.png" alt="">
 </a>
</div>

        </div>
        <div>
            <h2 class="big-text">Contact Us </h2>
            <p>Tel: (+12) 345 678 910</p>               
            <p>Email: info@jeanpaulgaultier.com</p>             
            <p>Address: 12345 MalYane Street, NYC, USA</p>
                
        </div>
    </footer>
</body>
</html>
