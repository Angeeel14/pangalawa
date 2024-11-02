<?php
session_start();

// Dummy product prices for demonstration
$product_prices = array(
  1 => 150000.00,  // Price for Product 1
  2 => 100000.00,  // Price for Product 2
  3 => 160000.00,  // Price for Product 3
  4 => 37250.00,   // Price for Product 4
  5 => 35000.00,   // Price for Product 5
  6 => 30000.00,   // Price for Product 6
  7 => 14500.00,   // Price for Product 7
  8 => 6500.00,    // Price for Product 8
  9 => 25000.00,   // Price for Product 9
  10 => 127000.00, // Price for Product 10
  11 => 30000.00,  // Price for Product 11
  12 => 50000.00   // Price for Product 12
);



$product_names = array(
  1  => 'ROG Strix GeForce RTX™ 4090 BTF OC Edition 24GB GDDR6X',           
  2  => 'ROG Strix GeForce RTX™ 4080 SUPER 16GB GDDR6X White OC Edition',      
  3  => 'ROG Strix GeForce RTX™ 4090 24GB GDDR6X OC EVA-02 Edition',       
  4  => 'ROG Crosshair X870E HERO',       
  5  => 'ROG Rampage VI Extreme Encore',      
  6  => 'ROG STRIX X870E-E gaming wifi',     
  7  => 'ROG Carnyx microphone',      
  8  => 'ROG Tessen',     
  9  => 'ROG Chariot',  
  10 => 'ROG Strix XG16AHP',  
  11 => 'ROG Strix XG16AHPE-W',  
  12 => 'ROG Swift OLED PG34WCDM'
      
);

$product_images = array(
  1  => '../PCWEB/IMG/GP1.png',
  2  => '../PCWEB/IMG/GP2.png',
  3  => '../PCWEB/IMG/GP3.png',
  4  => '../PCWEB/IMG/MB1.png',
  5  => '../PCWEB/IMG/MB2.png',
  6  => '../PCWEB/IMG/MB3.png',
  7  => '../PCWEB/IMG/GA1.png',
  8  => '../PCWEB/IMG/GA2.png',
  9  => '../PCWEB/IMG/GA3.png',
  10 => '../PCWEB/IMG/MNT1.png',
  11 => '../PCWEB/IMG/MNT2.png',
  12 => '../PCWEB/IMG/MNT3.png'
);




// Initialize cart total
$cart_total = 0.00;

// Check if cart is set and calculate total
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $product_id => $item) {
        if (isset($product_prices[$product_id])) {
            $item_total = $product_prices[$product_id] * $item['quantity'];
            $cart_total += $item_total;
        }
    }
}

?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="" />
  <link href="PCE.css" rel="stylesheet">
  <link href="CART.css" rel="stylesheet">
  <title>TechCrate</title>
</head>

<body>

<!-- Start Header NEWS -->
<nav class="nsbar">
  <div class="container">
  <p class="newsn">Head to "Best Sellers" Page to view products on discount! </p>
  </div>
</nav>
<!-- END Header NEWS -->

<!-- Start Header/Navigation -->
<nav class="navbar">
  <div class="container">
    <ul class="navbar-nav">
    <li class="nav-item"><a class="nav-link" href="account.php">TechCrate</a></li>
      <li class="nav-item"><a class="nav-link" href="BS.html">Best Sellers</a></li>
      <li class="nav-item"><a class="nav-link" href="CS.html">Components</a></li>
      <li class="nav-item"><a class="nav-link" href="GG.html">Gaming Gears</a></li>
      <li class="nav-item"><a class="nav-link" href="MN.html">Monitors</a></li>

      <ul class="navbar-icons">
      <li class="nav-item"><a class="nav-link" href="Asummary.php"><img src="../PCWEB/IMG/user.png" alt="User"></a></li>
        <li class="nav-item"><a class="nav-link" href="Cart.php"><img src="../PCWEB/IMG/SB.png" alt="Cart"></a></li>
        <li class="nav-item"><a class="nav-link" href="Sp.html"><img src="../PCWEB/IMG/SP.png" alt="Support"></a></li></ul>
    </ul>
   
  </div>
</nav>
<!-- End Header/Navigation -->



  <!-- Start Hero Section -->
  <div class="hero">
    <img src="../PCWEB/IMG/CT.png" alt="Hero Background">
    <div class="container">
      <div class="hero-content">
        <div class="hero-text">
        </div>
      </div>
    </div>
  </div>
  
  <!-- End Hero Section -->

  <div class="coch ">
        <div class="row mb-5">
            <form method="post">
                <div class="site-blocks-table">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="product-thumbnail">Image</th>
                                <th class="product-name">Product</th>
                                <th class="product-price">Price</th>
                                <th class="product-quantity">Quantity</th>
                                <th class="product-total">Total</th>
                                <th class="product-remove">Remove</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php
                            if (isset($_SESSION['cart'])) {
                                foreach ($_SESSION['cart'] as $product_id => $item) {
                                    if (isset($product_prices[$product_id])) {
                                        $product_name = isset($product_names[$product_id]) ? $product_names[$product_id] : "Unknown Product";
                                        $product_image = isset($product_images[$product_id]) ? $product_images[$product_id] : "../IMG/GP1.png"; // Fallback image
                                        $product_price = $product_prices[$product_id];
                                        $quantity = $item['quantity'];
                                        $total = $product_price * $quantity;

                                        // Output the cart item details
                                        echo "<tr>";
                                        echo "<td class='product-thumbnail'><img src='$product_image' alt='$product_name' class='img-fluid'></td>";
                                        echo "<td class='product-name'><h2 class='h5 text-black'>$product_name</h2></td>";
                                        echo "<td>₱" . number_format($product_price, 2) . "</td>";
                                        echo "<td>$quantity</td>";
                                        echo "<td>₱" . number_format($total, 2) . "</td>";
                                        echo "<td><a href='remove-from-cart.php?id=$product_id' class='remove-btn'>X</a></td>";
                                        echo "</tr>";
                                    }
                                }
                            } else {
                                echo "<tr><td colspan='6'>Your cart is empty.</td></tr>";
                            }
                            ?>


                        </tbody>
                    </table>
                </div>
            </form>
        </div>

        <div class="cart-actions">
    <!-- Update Cart Button with Link -->
    <a href="update_cart.php" class="update-cart-btn">Update Cart</a>
    
    <!-- Continue Shopping Button with Link -->
    <a href="account.php" class="continue-shopping-btn">Continue Shopping</a>
</div>

<div class="cart-columns">
    <div class="coupon-section">
        <div class="coupon-container">
            <h1>Coupon</h1>
            <p>Enter coupon here if you have one</p>
            <div class="coupon-row">
                <input type="text" class="coupon-input" placeholder="Coupon Code">
                <button class="apply-coupon-btn">Apply Coupon</button>
            </div>
        </div>
    </div>

    <div class="cart-totals-container">
        <div class="cart-totals">
            <h4>Cart Totals</h4>
            <div class="totals-row">
                <span>Subtotal</span>
                <span>₱<?php echo number_format($cart_total, 2); ?></span>
            </div>
            <div class="totals-row">
                <span>Total</span>
                <span>₱<?php echo number_format($cart_total, 2); ?></span>
            </div>
        </div>
        <!-- Proceed to Checkout Button with Link -->
        <a href="checkout.php" class="checkout-btn">Proceed To Checkout</a>
    </div>
</div>
</div>

   <!-- Start Footer Section -->
  <footer class="footer">
    <div class="footer-container">
      <div class="footer-column">
        <h4>Contact</h4>
        <ul>
          <li><a href="#">Customer Support</a></li>
          <li><a href="#">Submit a Request</a></li>
          <li><a href="#">Support Center</a></li>
        </ul>
      </div>
  
      <div class="footer-column">
        <h4>About</h4>
        <ul>
          <li><a href="#">Company</a></li>
          <li><a href="#">Careers</a></li>
          <li><a href="#">Customer Reviews</a></li>
        </ul>
      </div>
  
      <div class="footer-column">
        <h4>Community</h4>
        <ul>
          <li><a href="#">Our Discord</a></li>
          <li><a href="#">Newsroom & Blog</a></li>
        </ul>
      </div>
  
      <div class="footer-column">
        <h4>Account</h4>
        <ul>
          <li><a href="#">Manage Your Account</a></li>
        </ul>
      </div>
  
      <div class="footer-bottom">
        <p>&copy; 2024 Your Company. All Rights Reserved. <a href="#">Privacy Policy</a></p>
      </div>
    </div>
  </footer>
  
<!-- End Footer Section -->


</body>
</html>