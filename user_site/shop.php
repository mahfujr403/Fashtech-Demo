<?php
session_start();
$conn = new  mysqli('localhost', 'root', '', 'product');

$userLoggedIn = isset($_SESSION['user_id']);

$sql_featured = "SELECT * FROM all_products";
$item  = $conn->query($sql_featured);

$sql_cart = "SELECT * FROM cart";
$cartItem  = $conn->query($sql_cart);

require_once("get_cart.php")

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Fashtech</title>
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.4.2/css/all.css" />
</head>

<body>
  <section id="header">
    <a href="index.php"><img src="../img/logo.png" class="logo" alt /></a>

    <div>
      <ul id="navbar">
        <li><a href="index.php"> Home</a></li>
        <li><a class="active" href="shop.php"> Shop</a></li>
        <li><a href="blog.php"> Blog</a></li>
        <li><a href="about.php"> About</a></li>
        <li><a href="contact.php"> Contact</a></li>
        <li>
          <a href="cart.php">
            <i class="fa-solid fa-bag-shopping"></i>
            <?php
            if ($cartItemCount > 0 && $userLoggedIn) {
              echo '<span class="count">' . $cartItemCount . '</span>';
            }
            ?>
          </a>
        </li>
        <li class="admin-panel-container">
          <a href="user_authorize/user_login.php">
            <img src="../img/people/1.png" width="35px">
          </a>
          <div class="admin-dropdown">
            <?php
            if ($userLoggedIn) {
              echo  '<a href="../admin_site/logout.php">Log Out</a>';
            } elseif (!$userLoggedIn) {
              echo  '<a href="/user_site/user_authorize/user_login.php">Log In</a>';
            }
            ?>
            <a href="../admin_site/login_page.php">Continue as Admin</a>
          </div>
        </li>
      </ul>
    </div>
  </section>


  <section id="page-header">
    <h2>#Purchase from Home</h2>
    <p>Save more with coupons & up to 70% off!</p>
  </section>

  <section id="product1" class="section-p1">
    <div class="pro-container">

      <?php
      while ($row = mysqli_fetch_assoc($item)) {
      ?>
        <div class="pro">
          <img onclick="window.location.href='sproduct.php?id=<?php echo $row["id"] ?>'" src="../img/products/<?php echo $row["image"] ?>" alt="" />
          <div onclick="window.location.href='sproduct.php'" class="des">
            <span><?php echo $row["brand"] ?></span>
            <h5><?php echo $row["name"] ?></h5>
            <div class="star">
              <?php
              $rating =  $row["rating"];
              for ($x = 1; $x <= $rating; $x++) {
              ?>
                <i class="fa-solid fa-star"></i>
              <?php
              }
              ?>
              <?php
              $rating =  $row["rating"];
              for ($x = $rating + 1; $x <= 5; $x++) {
              ?>
                <i class="fa-regular fa-star"></i>
              <?php
              }
              ?>
            </div>
            <h4>৳<?php echo $row["price"] ?></h4>
          </div>
          <?php
          if (!$userLoggedIn) {
            echo '<a href="user_authorize/user_login.php"> <button class="add normal" data-id="' . $row["id"] . '" data-name="' . $row["name"] . '" data-brand="' . $row["brand"] . '" data-image="' . $row["image"] . '" data-price="' . $row["price"] . '" data-rating="' . $row["rating"] . '">Add to Cart</button></a>';
          } else {
            echo '<button class="add normal" data-id="' . $row["id"] . '" data-name="' . $row["name"] . '" data-brand="' . $row["brand"] . '" data-image="' . $row["image"] . '" data-price="' . $row["price"] . '" data-rating="' . $row["rating"] . '">Add to Cart</button>';
          }
          ?>


        </div>

      <?php
      }
      ?>



    </div>
  </section>

  <section id="travers" class="section-p1">
    <a href="#">1</a>
    <a href="#">2</a>
    <a href="#"><i class="fa-solid fa-angle-right"></i></a>
  </section>

  <section id="newsletter" class="section-p1">
    <div class="newstext">
      <h4>Sign Up For Newsletters</h4>
      <p>
        Get e-mail updates about our leatest shop and
        <span>special offers.</span>
      </p>
    </div>
    <div class="form">
      <input type="email" placeholder="Your e-mail address" />
      <button class="normal">Sign Up</button>
    </div>
  </section>

  <footer class="section-p1">
    <div class="col">
      <img src="../img/logo.png" class="logo" />
      <h4>Contact</h4>
      <p><strong>Address: </strong>Shaheb Bazar, Rajshahi</p>
      <p><strong>Phone: </strong>01771431724, 01521768694</p>
      <p><strong>Open: </strong>10am-10pm, Sat-Thu</p>

      <div class="follow">
        <h4>Follow us</h4>
        <div class="icon">
          <i class="fa-brands fa-facebook"></i>
          <i class="fa-brands fa-x-twitter"></i>
          <i class="fa-brands fa-instagram"></i>
          <i class="fa-brands fa-youtube"></i>
        </div>
      </div>
    </div>

    <div class="col">
      <h4>About</h4>
      <a href="about.php">About us</a>
      <a href="#">Delivary Information</a>
      <a href="#">Privacy ploicy</a>
      <a href="#">Trams & contidions</a>
      <a href="contact.php">Contact us</a>
    </div>

    <div class="col">
      <h4>My Account</h4>
      <a href="#">Sign In</a>
      <a href="cart.php">View Cart</a>
      <a href="#">My Wishlist</a>
      <a href="#">Track my order</a>
      <a href="#">Help</a>
    </div>

    <div class="col install">
      <h4>Install app</h4>
      <p>From App Store or Google Play</p>
      <div class="row">
        <img src="../img/pay/app.jpg" />
        <img src="../img/pay/play.jpg" />
      </div>
      <div>
        <p>Secured payment gateway</p>
        <img src="../img/pay/pay.png" />
      </div>
    </div>
  </footer>

  <script src="sendtoserver.js"></script>
  <script src="get_cart.js"></script>

</body>

</html>