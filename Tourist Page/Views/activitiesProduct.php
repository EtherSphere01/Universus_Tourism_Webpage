<!DOCTYPE html>
<?php
session_start();
require_once('../Controllers/activityController.php');
require_once('../Controllers/detailController.php');
require_once('../Controllers/loginController.php');
require_once('../Controllers/navController.php');
require_once('../Controllers/tourController.php');

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


if (isset($_POST['details-btn'])) {
    $_SESSION['details-btn'] = $_POST['details-btn'];
    detailsRequest();
}

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Universus Travel | Activities</title>
    <link rel="icon" type="image/x-icon" href="favicon.ico">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="swiper-bundle.min.css">
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.2/css/fontawesome.min.css" integrity="sha384-BY+fdrpOd3gfeRvTSMT+VUZmA728cfF9Z2G42xpaRkUGu2i3DyzpTURDo5A6CaLK" crossorigin="anonymous">

    <script src="sortingProduct.js"></script>
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
                    if (!empty($_SESSION['email'])) {
                        echo '<button class="nav-button">' . $_SESSION['name'] . '</button>';
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

    <div class="small-container">
        <div class="row row-2">
            <h2>Activities Page</h2>
            <select onchange="sortActivities(this.value)">
                <option value="" disabled selected hidden>Sorting</option>
                <option value="desc">Price High to Low</option>
                <option value="asc">Price Low to High</option>
            </select>
        </div>
        <h2 class="activities-title">Book Your Activities</h2>
    </div>

    <div class="small-container">
        <div class="row">
            <form method="POST">
                <?php
                $activities = resultActivity();
                while ($activity = mysqli_fetch_assoc($activities)) { ?>
                    <div class="col-4">
                        <img src="<?php echo $activity['imgsource']; ?>" alt="<?php echo $activity['name']; ?>">
                        <h4><?php echo $activity['name']; ?></h4>
                        <p class="price"><?php echo "$" . $activity['price']; ?></p>
                        <button type="submit" class="details-btn-all" name="details-btn" value="<?php echo $activity['name']; ?>">Details</button>
                    </div>
                <?php } ?>
            </form>
        </div>
    </div>


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