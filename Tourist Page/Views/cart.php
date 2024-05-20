<!DOCTYPE html>
<?php
session_start();


if (empty($_SESSION['email'])) {
    echo "<script> 
    window.location.href = 'http://localhost/Tourist%20Page/Views/login.php';
      </script>";
}
require_once('../Controllers/navController.php');
require_once('../Controllers/loginController.php');
require_once('../Controllers/cartController.php');

if (isset($_POST['login-button'])) {
    loginRequest();
}

if (isset($_POST['cart-button'])) {
    cartRequest();
}

if (isset($_POST['activities-button'])) {
    activitiesRequest();
}

if (isset($_POST['hotel-button'])) {
    hotelsRequest();
}

if (isset($_POST['flight-button'])) {
    flightRequest();
}

if (isset($_POST['logout'])) {
    logout();
}

if (isset($_POST['cart-remove'])) {
    removeFromCart();
}

// if(isset($_POST['checkout'])){
//     $_SESSION['hidden'] = $_POST['hidden'];
//     checkout();
// }


if (isset($_POST['checkout'])) {
    $_SESSION['hidden'] = $_POST['hidden'];
    checkout();
}




?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Universus Travel</title>
    <link rel="icon" type="image/x-icon" href="favicon.ico">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="swiper-bundle.min.css">
    <link rel="stylesheet" href="home.css">

</head>

<body>

    <header>
        <form method="POST">
            <div class="navbar">
                <div class="nav-logo">
                    <a href="home.php">
                        <img src="logo.png" alt="Logo">
                    </a>
                </div>



                <div class="nav-login">
                    <?php
                    // Check if user is logged in
                    if (!empty($_SESSION['email'])) {
                        // Display user's email in the button
                        echo '<button class="nav-button">' . $_SESSION['name'] . '</button>';
                        // Display the submenu with My Profile and Logout options
                        echo '<ul id="submenu">';
                        echo '<li><a href="myProfile.php" class="submenu-button" ><i class="fa-solid fa-user"></i>My Profile</a></li>';
                        echo '<li><form method="POST"><button type="submit" class="submenu-button" name="logout"><i class="fa-solid fa-arrow-right-from-bracket"></i>Log Out</button></form></li>';
                        echo '</ul>';
                    } else {
                        // Display the Sign In button
                        echo '<button name="login-button" class="nav-button">Sign In</button>';
                    }
                    ?>
                </div>

                <div class="nav-cart">

                    <button name="cart-button" class="nav-button">Cart</a>
                </div>


            </div>
        </form>
        <form method="POST">
            <div class="panel">
                <div class="panel-item">
                    <button name="activities-button"><i class="fa-solid fa-hat-cowboy"></i>Activities</button>
                    <button name="hotel-button"><i class="fa-solid fa-hotel"></i>Hotels</button>
                    <button name="flight-button"><i class="fa-solid fa-plane-up"></i>Flights</button>
                </div>
            </div>
        </form>
    </header>

    <!-- Cart  -->
    <div class="small-container cart-page">
        <?php
        $detailsCart = getCartDetails();
        ?>

        <table>
            <tr>
                <th>Service Name</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
            <?php foreach ($detailsCart as $item) : ?>
                <tr>
                    <td>
                        <div class="cart-info">
                            <img src="<?php echo $item['imgsource']; ?>" alt="<?php echo $item['name']; ?>">
                            <div>
                                <p><?php echo $item['name']; ?></p>
                                <small class="product-price">Price: $<?php echo $item['price'] * $_SESSION['tourduration']; ?></small> <br>
                                <?php
                                $day;
                                if ($_SESSION['tourduration'] == 1) {
                                    $day = "Day";
                                } else {
                                    $day = "Days";
                                }
                                ?>
                                <small class="product-quantity">Duration/Person: <?php echo $_SESSION['tourduration'] . ' ' . $day; ?> </small>

                                <br>
                                <form method="POST">
                                    <input type="hidden" name="product_name" value="<?php echo $item['cartID']; ?>">
                                    <button type="submit" name="cart-remove" class="btn-cart">Remove</button>
                                </form>
                            </div>
                        </div>
                    </td>
                    <td><input type="number" name="<?php echo $item['cartID']; ?>" class="quantity-input" value="1" min="1">
                    </td>
                    <td class="total">$<?php echo $item['price']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>

        <div class="total-price">
            <table>
                <tr>
                    <td>Subtotal</td>
                    <td id="subtotal">$0.00</td> <!-- Updated subtotal display -->
                </tr>
                <tr>
                    <td>Vat</td>
                    <td id="vat">$0.00</td> <!-- Updated VAT display -->
                </tr>
                <tr>
                    <td>Total Amount</td>
                    <td id="total-amount">$0.00</td> <!-- Updated total amount display -->
                </tr>
            </table>
        </div>
    </div>
    <div class="button-add-cart">
        <form method="POST">
            <button type="submit" name="checkout" class="btn-cart-checkout">Checkout</button>
            <input type="hidden" class="hidden" name="hidden" value="">
        </form>
    </div>










    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const quantityInputs = document.querySelectorAll('.quantity-input');
            const priceElements = document.querySelectorAll('.product-price');
            const totalElements = document.querySelectorAll('.total');

            function updateTotalPrice() {
                let subtotal = 0;
                quantityInputs.forEach((input, index) => {
                    const quantity = parseInt(input.value);
                    const price = parseFloat(priceElements[index].textContent.replace('Price: $', ''));
                    const total = quantity * price;
                    totalElements[index].textContent = '$' + total.toFixed(2);
                    subtotal += total;
                });
                const vat = subtotal * 0.1;
                const totalAmount = subtotal + vat;
                document.getElementById('subtotal').textContent = '$' + subtotal.toFixed(2);
                document.getElementById('vat').textContent = '$' + vat.toFixed(2);
                document.getElementById('total-amount').textContent = '$' + totalAmount.toFixed(2);
                document.querySelector('.hidden').value = totalAmount.toFixed(2);


            }
            quantityInputs.forEach(input => {
                input.addEventListener('change', function() {
                    updateTotalPrice();
                });
            });

            updateTotalPrice();
        });
    </script>

    <footer>
        <div class="foot-panel1" onclick="scrollToTop()">
            Back to Top
        </div>

        <script>
            function scrollToTop() {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            }
        </script>



        <div class="foot-panel2">

            <ul>
                <p class="footer-font">
                    <img src="logo.png" alt="Logo" class="footer-img">
                    Universus Tourism <br>
                <p class="footer-email footer-font">universuswebtech@gmail.com</p>
                <p class="footer-email footer-font">+88 092024 20246</p>
                </p>

            </ul>

            <ul>
                <p>Company</p>
                <a href="#">About Us</a>
                <a href="#">Destination</a>
                <a href="#">Packages</a>
                <a href="#">Contact Us</a>
            </ul>

            <ul>
                <p>Help</p>
                <a href="#">FAQ</a>
                <a href="#">Cancel Your Order</a>
                <a href="#">Press</a>
            </ul>

            <ul>
                <p>More</p>
                <a href="#">Domestic Flights</a>
                <a href="#">Partnerships</a>
                <a href="#">Jobs</a>
            </ul>

            <ul>
                <p>Terms</p>
                <a href="#">Privacy Policy</a>
                <a href="#">Discount Policy</a>
                <a href="#">Accessibility</a>
                <a href="#">Terms of Use</a>
            </ul>
        </div>

        <div class="foot-panel3">
            <p>© 2024 Universus Tourism | All rights reserved </p>
            <p><a href="https://github.com/Ethersphere01">Made by Naimur Rahman</a></p>

        </div>

        <!--Start of Tawk.to Script-->
        <script type="text/javascript">
            var Tawk_API = Tawk_API || {},
                Tawk_LoadStart = new Date();
            (function() {
                var s1 = document.createElement("script"),
                    s0 = document.getElementsByTagName("script")[0];
                s1.async = true;
                s1.src = 'https://embed.tawk.to/662e59531ec1082f04e86728/1hsigprko';
                s1.charset = 'UTF-8';
                s1.setAttribute('crossorigin', '*');
                s0.parentNode.insertBefore(s1, s0);
            })();
        </script>
        <!--End of Tawk.to Script-->

    </footer>
</body>

</html>