<!DOCTYPE html>

<?php


require_once('../Controllers/loginController.php');
require_once('../Controllers/navController.php');

if (isset($_POST['registration'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $address = $_POST['address'];
    $password = $_POST['password'];
    $dob = $_POST['date_of_birth'];
    $gender = $_POST['gender'];
    $country = $_POST['nationality'];
    $passno = $_POST['passport_no'];
    $nid = $_POST['nid'];
    $pin = $_POST['pin'];
    $result = registration($name, $email, $role, $address, $password, $dob, $gender, $country, $passno, $nid, $pin);
    if ($result) {
        echo "Registration Successful";
    } else {
        echo "Registration Failed";
    }
}


if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $status = loginUser($email, $password);
    if ($status) {
        echo "<script>alert('Login Successful')</script>";
    } else {
        echo "<script>alert('Login Failed')</script>";
    }
}

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










?>


<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log-In</title>
    <link rel="icon" type="image/x-icon" href="favicon.ico">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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

    <div class="login">
        <div class="login-container">
            <div class="login-title">
                <h1>Sign-In</h1>
            </div>
            <div class="login-form">
                <!-- Add the error message display code here -->
                <!-- Display error message -->
                <?php
                if (isset($_SESSION['loginError'])) {
                    echo '<div class="error-message">' . $_SESSION['loginError'] . '</div>';
                    unset($_SESSION['loginError']); // Clear the error message after displaying
                }
                ?>
                <!-- End of error message display -->
                <!-- End of error message display code -->
                <form method="POST">
                    <div class="login-input">
                        <input type="text" name="email" placeholder="Email Address">
                    </div>
                    <div class="login-input">
                        <input type="password" name="password" placeholder="Password">
                    </div>
                    <div class="forgot-pass">
                        <a href="#">Forgot Password?</a>
                    </div>
                    <div class="google-button">
                        <button type="submit"><i class="fa-brands fa-google"></i>Google</button>
                    </div>
                    <div class="login-button">
                        <button type="submit" name="login">Log-In</button>
                    </div>
                    <div class="register">
                        <a href="#">Don't have an account? Register</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="registration">
        <div class="registration-container">
            <div class="registration-title">
                <h1>Registration</h1>
            </div>
            <div class="registration-form">
                <form method="POST">
                    <div class="registration-input">
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" placeholder="Enter your name">
                    </div>
                    <div class="registration-input">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" placeholder="Enter your email address">
                    </div>

                    <div class="registration-input">
                        <label for="role">Role:</label>
                        <select id="role" name="role">
                            <option value="tourist">Tourist</option>
                            <option value="guide">Tour Guide</option>
                            <option value="hotel">Hotel Service</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>

                    <div class="registration-input">
                        <label for="address">Address:</label>
                        <input type="text" id="address" name="address" placeholder="Enter your address">
                    </div>
                    <div class="registration-input">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" placeholder="Enter your password">
                    </div>
                    <div class="registration-input">
                        <label for="date_of_birth">Date of Birth:</label>
                        <input type="date" id="date_of_birth" name="date_of_birth">
                    </div>
                    <div class="registration-input">
                        <label for="gender">Gender:</label>
                        <select id="gender" name="gender">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="registration-input">
                        <label for="nationality">Country:</label>
                        <select id="nationality" name="nationality">
                            <option value="Bangladesh">Bangladesh</option>
                            <option value="USA">USA</option>
                            <option value="India">India</option>
                            <!-- Add more options as needed -->
                        </select>
                    </div>
                    <div class="registration-input">
                        <label for="passport_no">Passport No:</label>
                        <input type="text" id="passport_no" name="passport_no" placeholder="Enter your passport number">
                    </div>
                    <div class="registration-input">
                        <label for="nid">NID:</label>
                        <input type="text" id="nid" name="nid" placeholder="Enter your NID">
                    </div>
                    <div class="registration-input">
                        <label for="pin">PIN:</label>
                        <input type="password" id="pin" name="pin" placeholder="Enter your PIN">
                    </div>
                    <div class="registration-button">
                        <button type="submit" name="registration">Register</button>
                    </div>
                    <div class="already-login">
                        <a href="login.html">Already have an account? Log-In</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="login.js"></script>
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