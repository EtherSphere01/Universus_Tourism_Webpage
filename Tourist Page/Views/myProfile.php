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
require_once('../Controllers/profileController.php');
require_once('../Controllers/invoiceController.php');
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

function getOrderHistory()
{
    $r = getControllerHistory();
    return $r;
}

if (isset($_POST['invoice-btn'])) {
    $_SESSION['invoice'] = $_POST['invoice-btn'];
    invoiceRequest();
}

if (isset($_POST['cancel-btn'])) {
    $r = cancelOrder($_POST['cancel-btn']);
    if ($r) {
        echo '<script>alert("Order Cancelled Successfully")</script>';
    } else {
        echo '<script>alert("Order Cancelled Failed")</script>';
    }
}

if (isset($_POST['change-pass'])) {
    $email = $_POST['email'];
    $pin_no = $_POST['pin_no'];
    $old_pass = $_POST['old-pass'];
    $new_pass = $_POST['new-pass'];
    $r = changePassword($email, $pin_no, $old_pass, $new_pass);
    if ($r) {
        echo '<script>alert("Password Changed Successfully")</script>';
    } else {
        echo '<script>alert("Password Change Failed")</script>';
    }
}

if (isset($_POST['review-submit'])) {
    $invoice_id = $_POST['invoice_id'];
    $product_name = $_POST['product_name'];
    $comment = $_POST['comment'];
    $rate = $_POST['rate-value'];
    $name = $_SESSION['name'];
    $email = $_SESSION['email'];
    $rr = getimagefromtable($email);
    $image = $rr['image'];
    $r = reviewSubmit($invoice_id, $product_name, $name, $comment, $rate, $email, $image);
    if ($r) {
        echo '<script>alert("Review Submitted Successfully")</script>';

        updateReviewStatus($invoice_id);
    } else {
        echo '<script>alert("Review Submission Failed")</script>';
    }
}

$_SESSION['paynow'] = "";
require_once('../Controllers/invoiceController.php');
if (isset($_POST['paynow'])) {
    $_SESSION['paynow'] = $_POST['paynow'];
    $r = get_required_order_details($_POST['paynow']);
    $name = $r['name'];
    $email = $r['email'];
    $phone = $r['phone'];
    $address = $r['address'];
    $productname = $r['productname'];
    $productdetails = $r['quantity'];
    $amount = $r['amount'];
    $pstatus = $r['pstatus'];
    $orderid = $r['orderid'];
    $status = $r['status'];
    $_SESSION['amount'] = $amount;
    $_SESSION['productname'] = $productname;
    showpopup_paynow($orderid, $status, $name, $email, $phone, $address, $productname, $productdetails, $amount, $pstatus);
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



    <style>
        .disabled-button {
            background-color: #ddd;
            color: #aaa;
            cursor: not-allowed;
        }
    </style>

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

    <?php
    $email = $_SESSION['email'];
    $profile = getProfile($email);
    $profile = mysqli_fetch_assoc($profile);
    $image = $profile['image'];

    if (isset($_POST['update'])) {
        $tempimg = $_POST['tempimg'];
        $r = updateProfile($email, $tempimg);
        if ($r) {
            header("location: myProfile.php");
        } else {
            echo '<script>alert("Profile Picture Update Failed")</script>';
        }
    }
    ?>

    <form method="POST">
        <div class="container">
            <div class="left-column">
                <div class="profile-picture">
                    <img src="<?php echo $image ?> " alt="Profile Picture" id="image">
                    <div class="profile-buttons">
                        <input type="file" id="file" class="upper-profile-pic" onchange="loadFile(event)" style="display: none;" />
                        <label for="file" class="upload update">Browse</label>
                        <button class="update" name="update">Update</button>
                        <input type="hidden" name="tempimg" id="tempimg" value="<?php echo $image ?>" />

    </form>
    <script>
        var loadFile = function(event) {
            var image = document.getElementById('image');
            var value = event.target.files[0]['name'];
            var total = "../../Tourist Page/Views/UserImage/" + value;
            image.src = total;
            var tempimg = document.getElementById('tempimg');
            tempimg.value = total;
        };
    </script>

    </div>
    </div>
    <div class="item" id="order-details">Order Details</div>
    <div class="item" id="personal-info">Personal Information</div>
    <div class="item" id="change-password">Change Password</div>
    <div class="item" id="reviews">Reviews</div>

    </div>
    <div class="right-column">
    </div>
    </div>

    <div class="order-container">
        <h1>Order History</h1>
        <div class="order-table">
            <form method="POST">
                <table border="1">
                    <tr>
                        <th>Order ID</th>
                        <th>Product Name</th>
                        <th>Status</th>
                        <th>Amount</th>
                        <th>Payment Status</th>
                        <th colspan="3">Action</th>
                    </tr>
                    <?php
                    $result = getOrderHistory();
                    while ($r = mysqli_fetch_array($result)) {
                    ?>
                        <tr>
                            <td><?php echo $r['orderid']; ?></td>
                            <td><?php echo $r['productname']; ?></td>
                            <td><?php echo $r['status']; ?></td>
                            <td><?php echo $r['amount']; ?></td>
                            <td><?php echo $r['pstatus']; ?></td>
                            <td>
                                <button name="invoice-btn" value="<?php echo $r['orderid']; ?>">Invoice</button>
                            </td>
                            <td><button class="paynow" name="paynow" value="<?php echo $r['orderid']; ?>">Pay Now</button></td>
                            <td><button class="cancel-btn" name="cancel-btn" value="<?php echo $r['orderid']; ?>">Cancel</button></td>
                        </tr>
                    <?php } ?>

                </table>
            </form>
        </div>
    </div>
    <script>
        function disableButtons() {
            var rows = document.querySelectorAll('.order-table tr');
            rows.forEach(function(row, index) {
                if (index === 0) return; // Skip header row

                var status = row.cells[2].innerText.trim();
                var paymentStatus = row.cells[4].innerText.trim();
                var invoiceButton = row.cells[5].querySelector('button[name="invoice-btn"]');
                var payNowButton = row.cells[6].querySelector('button.paynow');
                var cancelButton = row.cells[7].querySelector('button.cancel-btn');

                if (paymentStatus !== 'Paid') {
                    invoiceButton.disabled = true;
                }

                if (paymentStatus !== 'Pending' || status === 'Cancelled' || status === 'Canceled') {
                    payNowButton.classList.add('disabled-button2');
                    payNowButton.disabled = true;
                }


                if (status !== 'Pending') {
                    cancelButton.disabled = true;
                }
            });
        }

        window.onload = disableButtons;
    </script>
    <!-- /////////////////////////////////////////////////////////////////// -->

    <?php
    function showpopup_paynow($orderid, $status, $name, $email, $phone, $address, $productname, $productdetails, $amount, $pstatus)
    {  ?>

        <div class="test">
            <?php
            require_once('config.php');
            ?>
            <button name="cross-button" class="cross-button">X</button>
            <p> Are Your Sure?</p>

            <form method="post" action="submit.php" class="test-form">
                <script src="https://checkout.stripe.com/checkout.js" class="stripe-button" data-key="<?php echo $publishableKey; ?>" data-amount='<?php echo $amount * 100; ?>' data-name="Universus Tourism" data-description='<?php echo 'Order ID: ' . $orderid; ?>' data-image="https://i.ibb.co/WfdSsCY/logo.jpg" data-currency="bdt" data-email="<?php echo $email; ?>">
                </script>
            </form>
        </div>
    <?php
    }
    ?>
    <!-- //////////////////////////////////////////////////////////////////////// -->

    <div class="personalInfo-container">
        <h1>Account Information</h1>
        <div class="personalInfo-form">
            <div class="personalInfo-item">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="John Doe">
            </div>
            <div class="personalInfo-item">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="john.doe@example.com">
            </div>
            <div class="personalInfo-item">
                <label for="id">ID:</label>
                <input type="text" id="id" name="id" value="123456789" disabled>
            </div>
            <div class="personalInfo-item">
                <label for="role">Role:</label>
                <select id="role" name="role">
                    <option value="tourist">Tourist</option>
                    <option value="guide">Tour Guide</option>
                    <option value="hotel">Hotel Service</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <div class="personalInfo-item">
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" value="123 Main Street, City, Country">
            </div>
            <div class="personalInfo-item">
                <label for="date_of_birth">Date of Birth:</label>
                <input type="date" id="date_of_birth" name="date_of_birth" value="1990-01-01">
            </div>
            <div class="personalInfo-item">
                <label for="gender">Gender:</label>
                <select id="gender" name="gender">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
            </div>
            <div class="personalInfo-item">
                <label for="nationality">Nationality:</label>
                <select id="nationality" name="nationality">
                    <option value="Bangladeshi">Bangladeshi</option>
                    <option value="American">American</option>
                    <option value="British">British</option>
                    <!-- Add more options as needed -->
                </select>
            </div>
            <div class="personalInfo-item">
                <label for="passport_no">Passport No:</label>
                <input type="text" id="passport_no" name="passport_no" value="AB123456">
            </div>
            <div class="personalInfo-item">
                <label for="nid">NID:</label>
                <input type="text" id="nid" name="nid" value="1234567890123">
            </div>
            <div class="personalInfo-button">
                <button type="button" onclick="updateAccountInfo()">Update Info</button>
            </div>
        </div>
    </div>


    <div class="changePass-container">
        <h1>Change Password</h1>
        <form method="post" action="" class="change-form">
            <div class="personalInfo-form">

                <div class="personalInfo-item">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="">
                </div>
                <div class="personalInfo-item">
                    <label for="pin_no">PIN No:</label>
                    <input type="text" id="pin_no" name="pin_no" value="">
                </div>
                <div class="personalInfo-item">
                    <label for="old-pass ">Old Password:</label>
                    <input type="text" id="old-pass" name="old-pass" value="">
                </div>
                <div class="personalInfo-item">
                    <label for="new-pass">New Password:</label>
                    <input type="text" id="new-pass" name="new-pass" value="">
                </div>
                <div class="personalInfo-button">
                    <button name="change-pass" type="submit" onclick="updateAccountInfo()">Change Password</button>
                </div>
            </div>

        </form>


    </div>
    <div class="reviewPage-container">
        <h1>Review Page</h1>
        <div class="review-table">
            <table border="1">
                <tr>
                    <th>Invoice ID</th>
                    <th>Product Name</th>
                    <th>Comment</th>
                    <th>Rate</th>
                    <th>Action</th>
                </tr>
                <?php
                $result = getOrderHistory();
                $completedOrdersExist = false;
                while ($r = mysqli_fetch_array($result)) {
                    if ($r['reviewstatus'] == 'No' && $r['pstatus'] == 'Paid') {
                        $completedOrdersExist = true;
                ?>
                        <tr>
                            <form method="POST">
                                <input type="hidden" name="invoice_id" value="<?php echo $r['orderid']; ?>">
                                <input type="hidden" name="product_name" value="<?php echo $r['productname']; ?>">
                                <td><?php echo $r['orderid']; ?></td>
                                <td><?php echo $r['productname']; ?></td>
                                <td><textarea name="comment"></textarea></td>
                                <td>
                                    <select name="rate-value" id="">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </td>
                                <td colspan="2">
                                    <button name="review-submit" type="submit">Submit</button>
                                </td>
                            </form>
                        </tr>
                <?php
                    }
                }
                if (!$completedOrdersExist) {
                    echo '<tr><td colspan="5" style="text-align: center; font-size: larger; color: #39567b;"><b>No Completed Orders</b></td></tr>';
                }
                ?>
            </table>
        </div>
    </div>

    <script src="myProfile.js"></script>
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