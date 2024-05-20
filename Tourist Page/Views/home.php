<!DOCTYPE html>
<?php
session_start();
require_once('../Controllers/navController.php');
require_once('../Controllers/searchController.php');
require_once('../Controllers/loginController.php');

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




$_SESSION['destination'] = NULL;
$_SESSION['deprature'] = NULL;

if (isset($_POST['searchTour'])) {
    $destination = $_POST['location'];
    $_SESSION['destination'] = $destination;
    getTour2();
}

if (isset($_POST['searchFlight'])) {
    $destination = $_POST['destination'];
    $deprature = $_POST['deprature'];
    $_SESSION['destination'] = $destination;
    $_SESSION['deprature'] = $deprature;
    getFlight2();
}

if (isset($_POST['searchHotel'])) {
    $location = $_POST['location'];
    $_SESSION['location'] = $location;
    getHotel2();
}



if (isset($_POST['cart-button'])) {
    cartRequest();
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

    <!-- BODY CONTENT STARTS FROM HERE -->

    <div class="slider-container">

        <img src="arrow.png" class="arrow left">

        <div class="frame">
            <div class="slider">
                <img src="slider1.jpg" class="image">
                <img src="slider2.jpg" class="image">
                <img src="slider3.jpg" class="image">
                <img src="slider4.jpg" class="image">
            </div>
        </div>

        <img src="arrow.png" class="arrow right">

    </div>

    <script src="hero-slider.js"></script>

    <div class="search-header">
        <h1>Search Your Package</h1>
    </div>

    <div class="searchbox">
        <div class="searchbox-container">
            <div class="searchbox-item">
                <div class="searchbox-title">
                    <div class="tab active" id="flightTab">Flights</div>
                    <div class="tab" id="hotelTab">Hotels</div>
                    <div class="tab" id="tourTab">Tours</div>
                </div>
                <div class="searchbox-form" id="flightForm">
                    <!-- Form for flight search -->
                    <form method="POST">
                        <div class="searchbox-form-item">
                            <label for="deprature">Departure</label>
                            <input type="text" id="departure" placeholder="Departure" name="deprature">
                        </div>
                        <div class="searchbox-form-item">
                            <label for="destination">Destination</label>
                            <input type="text" id="destination" placeholder="Destination" name="destination">
                        </div>
                        <div class="searchbox-form-item">
                            <button name="searchFlight">Search Flights</button>
                        </div>
                    </form>
                </div>
                <div class="searchbox-form" id="hotelForm" style="display: none;">
                    <!-- Form for hotel search -->
                    <form method="post">
                        <div class="searchbox-form-item">
                            <label for="location">Location</label>
                            <input type="text" id="location" placeholder="Location" name="location">
                        </div>
                        <div class="searchbox-form-item">
                            <button name="searchHotel">Search Hotels</button>
                        </div>
                    </form>
                </div>
                <div class="searchbox-form" id="tourForm" style="display: none;">
                    <!-- Form for tour search -->
                    <form method="POST">
                        <div class="searchbox-form-item">
                            <label for="location">Location</label>
                            <input type="text" id="location" placeholder="Location" name="location">
                        </div>
                        <div class="searchbox-form-item">
                            <label for="participants">Participants</label>
                            <input type="number" id="participants" min="1">
                        </div>
                        <div class="searchbox-form-item">
                            <button name="searchTour">Search Tours</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="searchbox.js"></script>


    <div class="TopDest-text">
        <h4>TOP DESTINATION</h4>
        <h1>Explore Top Destination</h1>
    </div>


    <div class="TopDest-container swiper">
        <div class="TopDest-content">
            <div class="card-wrapper swiper-wrapper">
                <div class="TopDest swiper-slide">
                    <div class="TopDest-image-content">
                        <span class="TopDest-overlay"> </span>
                        <div class="TopDest-card-image">
                            <img src="slider2.jpg" alt="" class="TopDest-card-img">
                        </div>
                    </div>
                    <div class="TopDest-card-content">
                        <h2 class="product-name">Tulum Mexico</h2>
                        <div class="rating">
                            <span class="star">&#9733;</span> <!-- Example of a filled star -->
                            <span class="star">&#9733;</span> <!-- Example of a filled star -->
                            <span class="star">&#9733;</span> <!-- Example of a filled star -->
                            <span class="star">&#9733;</span> <!-- Example of an empty star -->
                            <span class="star">&#9734;</span> <!-- Example of an empty star -->
                        </div>
                        <p class="price">$200</p>
                        <p class="description"></p>
                        <button class="TopDest-button">Add Cart</button>
                    </div>
                </div>
                <!-- Add more TopDest slides here -->
                <div class="TopDest swiper-slide">
                    <div class="TopDest-image-content">
                        <span class="TopDest-overlay"> </span>
                        <div class="TopDest-card-image">
                            <img src="slider3.jpg" alt="" class="TopDest-card-img">
                        </div>
                    </div>
                    <div class="TopDest-card-content">
                        <h2 class="product-name">Tulum Mexico</h2>
                        <div class="rating">
                            <span class="star">&#9733;</span> <!-- Example of a filled star -->
                            <span class="star">&#9733;</span> <!-- Example of a filled star -->
                            <span class="star">&#9733;</span> <!-- Example of a filled star -->
                            <span class="star">&#9733;</span> <!-- Example of an empty star -->
                            <span class="star">&#9734;</span> <!-- Example of an empty star -->
                        </div>
                        <p class="price">$200</p>
                        <p class="description"></p>
                        <button class="TopDest-button">Add Cart</button>
                    </div>
                </div>

                <div class="TopDest swiper-slide">
                    <div class="TopDest-image-content">
                        <span class="TopDest-overlay"> </span>
                        <div class="TopDest-card-image">
                            <img src="slider2.jpg" alt="" class="TopDest-card-img">
                        </div>
                    </div>
                    <div class="TopDest-card-content">
                        <h2 class="product-name">Tulum Mexico</h2>
                        <div class="rating">
                            <span class="star">&#9733;</span> <!-- Example of a filled star -->
                            <span class="star">&#9733;</span> <!-- Example of a filled star -->
                            <span class="star">&#9733;</span> <!-- Example of a filled star -->
                            <span class="star">&#9733;</span> <!-- Example of an empty star -->
                            <span class="star">&#9734;</span> <!-- Example of an empty star -->
                        </div>
                        <p class="price">$200</p>
                        <p class="description"></p>
                        <button class="TopDest-button">Add Cart</button>
                    </div>
                </div>

                <div class="TopDest swiper-slide">
                    <div class="TopDest-image-content">
                        <span class="TopDest-overlay"> </span>
                        <div class="TopDest-card-image">
                            <img src="slider2.jpg" alt="" class="TopDest-card-img">
                        </div>
                    </div>
                    <div class="TopDest-card-content">
                        <h2 class="product-name">Tulum Mexico</h2>
                        <div class="rating">
                            <span class="star">&#9733;</span> <!-- Example of a filled star -->
                            <span class="star">&#9733;</span> <!-- Example of a filled star -->
                            <span class="star">&#9733;</span> <!-- Example of a filled star -->
                            <span class="star">&#9733;</span> <!-- Example of an empty star -->
                            <span class="star">&#9734;</span> <!-- Example of an empty star -->
                        </div>
                        <p class="price">$200</p>
                        <p class="description"></p>
                        <button class="TopDest-button">Add Cart</button>
                    </div>
                </div>

            </div>

        </div>
        <!-- Arrows outside the TopDest-content div -->
        <div class="swiper-button-next top-dest-next swiper-navBtn"></div>
        <div class="swiper-button-prev top-dest-prev swiper-navBtn"></div>
        <div class="swiper-pagination"></div>
    </div>
    <div class="promotionalBanner">
        <div class="promotionalBanner-content">
            KOLA
            <img src="slider1.jpg" alt="" class="bannerImg">
        </div>
    </div>


    <div class="aboutUS">
        <h4>HOW WE WORK</h4>
        <h1>Our Services</h1>
        <div class="services">
            <div class="service">
                <i class="fa-solid fa-plane-up"></i>
                <h2>Air Ticketing</h2>
                <p align=justify>Universus Tourism simplifies air ticketing, providing efficient services and competitive pricing. With real-time flight information and expert assistance, we ensure seamless travel experiences for our customers. Our commitment to excellence makes every journey hassle-free.
                </p>
            </div>
            <div class="service">
                <i class="fa-solid fa-hotel"></i>
                <h2>Hotels</h2>
                <p align=justify>Universus Tourism offers comprehensive hotel services, ensuring comfortable accommodations for every traveler. From budget-friendly options to luxurious stays, we provide diverse choices tailored to your preferences. With our extensive network of partner hotels and dedicated support, booking with us guarantees a relaxing and enjoyable stay wherever your destination may be.
                </p>
            </div>
            <div class="service">
                <i class="fa-solid fa-person-hiking"></i>
                <h2>Tourism</h2>
                <p align=justify>Universus Tourism is your gateway to unforgettable travel experiences. Our services cater to tourists seeking adventure, culture, and relaxation. Whether you're exploring ancient landmarks, immersing in vibrant cultures, or unwinding on pristine beaches, we offer tailored itineraries and expert guidance to make your journey seamless and memorable. With us, embark on a journey of discovery and create lifelong memories.
                </p>
            </div>


        </div>
    </div>

    <div class="FeedBack-text">
        <h4>FEEDBACK</h4>
        <h1>What Our Traveller Says About Us</h1>
    </div>


    <div class="slide-container swiper">
        <div class="slide-content">
            <div class="card-wrapper swiper-wrapper">


                <?php
                require_once('../../Naimur/Controllers/DashboardController.php');
                $get_rows = get_review2();

                while ($row = mysqli_fetch_assoc($get_rows)) { ?>

                    <div class="card swiper-slide">
                        <div class="image-content">
                            <span class="overlay"> </span>

                            <div class="card-image">
                                <img src="<?php echo $row['image'] ?>" alt="" class="card-img">
                            </div>
                        </div>

                        <div class="card-content">
                            <h2 class="name"><?php echo $row['name'] ?></h2>
                            <p class="description"><?php echo $row['comment'] ?></p>

                        </div>
                    </div>

                <?php } ?>




            </div>
        </div>
        <div class="swiper-button-next review-next swiper-navBtn"></div>
        <div class="swiper-button-prev review-prev swiper-navBtn"></div>
        <div class="swiper-pagination"></div>
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
            <p><a href="https://github.com/Ethersphere01"><b>Made by Naimur Rahman</b></a></p>
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





<script src="swiper-bundle.min.js"></script>
<script src="review_script.js"></script>
<script src="top-destination-slider.js"></script>




</html>