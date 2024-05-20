<?php
//     $email = $_SESSION['email'];
//     $con = conn();
//     $sql = "SELECT * FROM cart where email = '$email'";
//     $result = mysqli_query($con, $sql);

//     while($resultArray = mysqli_fetch_array($result)){
//         $name = $resultArray['name'];
//         $price = $resultArray['price'];
//         $imgsource = $resultArray['imgsource'];

//         echo "<div class='product'>
//         <img src='$imgsource' alt='product image'>
//         <h3>$name</h3>
//         <p>$price</p>
//         </div>";
//     }
//    echo "total price = ".$_SESSION['hidden'];
session_start();

if (empty($_SESSION['email'])) {
    echo "<script> 
    window.location.href = 'http://localhost/Tourist%20Page/Views/login.php';
      </script>";
}
// require_once ('../Controllers/navController.php');
// require_once ('../Controllers/checkoutController.php');
//require_once ('../Controllers/loginController.php');
require_once('../Controllers/cartController.php');
require_once('../Controllers/couponController.php');
// require_once('../Models/alldb.php');
$couponAmount = 0;

// $_SESSION['Custnamee'] = "";
//   $_SESSION['Custemaile'] = "";
//   $_SESSION['Custphonee'] = "";
//   $_SESSION['Custaddresse'] = "";
//   $_SESSION['orderTotal'] = "";
//   $_SESSION['productName'] = "";

if (isset($_POST['coupon-btn'])) {

    $_SESSION['Custnamee'] = $_POST['Custname'];
    $_SESSION['Custemaile'] = $_POST['Custemail'];
    $_SESSION['Custphonee'] = $_POST['Custphone'];
    $_SESSION['Custaddresse'] = $_POST['Custaddress'];
    // $_SESSION['orderTotal'] = $_POST['orderTotal'];
    $_SESSION['productNamee'] = $_POST['productName'];


    //$productName = $_POST['productName'];
    //$orderTotal = $_POST['orderTotal'];
    $coupon = $_POST['coupon'];
    $_SESSION['coupon'] = $coupon;
    $couponAmount = applyCoupon($coupon);
    if ($couponAmount) {
        echo "Coupon Applied";
        $_SESSION['orderTotal'] = $_SESSION['hidden'] - $couponAmount;
    } else {
        echo "Coupon Failed";
    }



    require_once('../../Naimur/Controllers/CouponController.php');
    $date = date('Y-m-d');
    update_coupon_table($coupon, $date);
}

if (isset($_POST['final-checkout-btn'])) {
    // Retrieve form data
    $custName = $_SESSION['Custnamee'];
    $custEmail =  $_SESSION['Custemaile'];
    $custPhone = $_SESSION['Custphonee'];
    $custAddress = $_SESSION['Custaddresse'];
    $productName = $_SESSION['productNamee'];
    $orderTotal = $_SESSION['orderTotal'];

    $custName = $_POST['Custname'];
    $custEmail = $_POST['Custemail'];
    $custPhone = $_POST['Custphone'];
    $custAddress = $_POST['Custaddress'];
    // $_SESSION['orderTotal'] = $_POST['orderTotal'];
    $productName = $_POST['productName'];
    $orderTotal = $_POST['orderTotal'];

    $result = callToOrder($custName, $custEmail, $custPhone, $custAddress, $productName, $orderTotal, $_SESSION['tourduration']);
    if ($result) {
        echo "Order Successful";
    } else {
        echo "Order Failed";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="icon" type="image/x-icon" href="favicon.ico">

    <link rel="stylesheet" href="checkout.css">
</head>

<body>
    <form method="POST" class="container">
        <div class="container">
            <div class="window">
                <div class="order-info">
                    <div class="order-info-content">
                        <h2>Order Summary</h2>
                        <div class="line"></div>
                        <?php
                        $result = getCheckoutDetails();
                        while ($r = mysqli_fetch_array($result)) {
                            $productNames[] = $r['name'];
                            $_SESSION['productNamee'] = $r['name'];
                        ?>
                            <table class="order-table">
                                <tbody>
                                    <tr>
                                        <td><img src="<?php echo $r['imgsource']; ?>" class="full-width"></td>
                                        <td>
                                            <!-- Product Name -->
                                            <br><?php echo $r['name']; ?><br> <span class="thin small">Duration/Person: <?php echo $_SESSION['tourduration']; ?> Day/Person</span>
                                            <input type="hidden" name="productName" value="<?php echo $r['name']; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <!-- Product Price -->
                                            <div class="price">$<?php echo $r['price'] * $_SESSION['tourduration']; ?></div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="line"></div>
                        <?php } ?>
                        <div class="total">
                            <span style="float:left;">
                                <div class="thin dense">Coupon Discount</div>
                                TOTAL
                            </span>
                            <span style="float:right; text-align:right;">
                                <?php
                                if ($couponAmount) {
                                    echo "<div class='thin dense'>$" . $couponAmount . "</div>";
                                } else {
                                    echo "<div class='thin dense'>$0</div>";
                                }
                                ?>
                                $
                                <?php
                                if (isset($_SESSION['hidden'])) {
                                    echo $_SESSION['hidden'] - $couponAmount;
                                } else {
                                    echo "0";
                                }
                                ?> <!-- Order final price -->
                                <input type="hidden" name="orderTotal" value="<?php echo isset($_SESSION['hidden']) ? ($_SESSION['hidden'] - $couponAmount) : $_SESSION['hidden']; ?>">
                            </span>
                        </div>
                    </div>
                </div>
                <div class="credit-info">
                    <div class="credit-info-content">
                        <table class="half-input-table">
                            <tr>
                                <td align="center" class="booking-txt"><b>Booking Information</b></td>
                            </tr>
                        </table>
                        <img src="logo.png" class="my-image" height="80" class="credit-card-image" id="credit-card-image"></img>
                        Name:
                        <input class="input-field" name="Custname" value="<?php echo isset($_SESSION['Custnamee']) ? $_SESSION['Custnamee'] : ''; ?>">
                        Email:
                        <input class="input-field" name="Custemail" value="<?php echo isset($_SESSION['Custemaile']) ? $_SESSION['Custemaile'] : ''; ?>">
                        Contact No:
                        <input class="input-field" name="Custphone" value="<?php echo isset($_SESSION['Custphonee']) ? $_SESSION['Custphonee'] : ''; ?>">
                        Address:
                        <input class="input-field" name="Custaddress" value="<?php echo isset($_SESSION['Custaddresse']) ? $_SESSION['Custaddresse'] : ''; ?>">
                        <table class="half-input-table">
                            <tr>
                                <td> Coupon Code
                                    <input type="text" name="coupon" class="input-field">
                                </td>
                                <td>
                                    <button name="coupon-btn" class="coupon-btn">Apply Coupon</button>
                                </td>
                            </tr>
                        </table>
                        <button class="pay-btn" name="final-checkout-btn">Checkout</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

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