<!DOCTYPE html>
<script>
  let comment_arr = [];
  let username_arr = [];
  let dtime_arr = [];
  let rate_arr = [];
  let imgUrl_arr = [];

  let totalTravelers_php = 43;
  let totalBookings_php = 61;
  let totalActive_php = 0;
  let totalEarnings_php = 0;

  let specialDiscount_php = 0;
  let fixedCard_php = 0;
  let fixedCoupon_php = 0;

  let countrynameArr_php = [];
  let countryuserArr_php = [];
  let countrytransactionArr_php = [];
  let countryrevenueArr_php = [];

  let locationset = 'Dhaka';

  let newnot = 0;
  let prevnot = 0;
</script>

<?php

session_start();

require_once('../../Naimur/Controllers/DashboardController.php');

$reviews = getReviews();

while ($row = $reviews->fetch_assoc()) {
  echo "<script> 
      comment_arr.push('" . $row['comment'] . "');
      username_arr.push('" . $row['name'] . "');
      dtime_arr.push('" . $row['time'] . "');
      rate_arr.push('" . $row['rating'] . "');
      imgUrl_arr.push('" . $row['image'] . "');
    </script>";
}

echo "<script> 
      locationset = '" . $_SESSION['rootlocation'] . "';
    </script>";

// details box db connection

$details_box = getDetailsDashboard();
echo "<script>
    totalTravelers_php += " . $details_box['totaluser'] . ";
    totalBookings_php += " . $details_box['totalbooking'] . ";
    totalActive_php = " . $details_box['totalactivetrip'] . ";
    totalEarnings_php = " . $details_box['totalearning'] . ";
  </script>";


// pie chart db connection

$discounts = get_discount();

while ($row = $discounts->fetch_assoc()) {

  echo "<script> specialDiscount_php += " . $row['specialDiscount'] . "; </script>";
  echo "<script> fixedCard_php += " . $row['fixedCard'] . "; </script>";
  echo "<script> fixedCoupon_php += " . $row['fixedCoupon'] . "; </script>";
}

// bottom table

$countryArr = getCountryRevenue();
$total_country = getTotalCountry();

while ($row = $countryArr->fetch_assoc()) {
  echo "<script> 
      countrynameArr_php.push('" . $row['country'] . "');
      countryuserArr_php.push('" . $row['users'] . "');
      countrytransactionArr_php.push('" . $row['transactions'] . "');
      countryrevenueArr_php.push('" . $row['revenue'] . "');
    </script>";
}



if (empty($_SESSION['rootusername'])) {
  echo "<script> 
      window.location.href = 'http://localhost/Tourist%20Page/Views/login.php';
    </script>";
}


if (isset($_GET['logout'])) {


  echo "<script> 
      window.location.href = 'http://localhost/Tourist%20Page/Views/login.php';
    </script>";

  session_unset();
  session_destroy();
}


$notification_icon = "./Icons/notification-icon.png";

$new_notification = get_new_notification();
$prev_notification = get_prev_notification();

$_SESSION['notification'] = $new_notification;

if ($new_notification != $prev_notification) {
  $notification_icon = "./Icons/activenotification.gif";
}

if (isset($_POST['notification-icon'])) {
  $notification_icon = "./Icons/notification-icon.png";
  request_updateprevious_notification($new_notification);


  show_notificationpopup();
}

?>




<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="http://localhost/Naimur/Views/Template.css" />
  <link rel="stylesheet" href="http://localhost/Naimur/Views/Dashboard.css" />
  <link rel="stylesheet" href="http://localhost/Naimur/Views/weatherpopup.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Reddit+Mono:wght@200..900&display=swap" />
  <link href="https://fonts.googleapis.com/css2?family=Exo+2:ital,wght@0,100..900;1,100..900&family=Exo:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />

  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet" />
  <title>Dashboard</title>
</head>

<body>
  <!-- -------------------------Left panel-------------------------------------- -->

  <div class="container">
    <div class="left-panel item1">
      <div class="logo">
        <img src="./Figma/Blue Orange.png" alt="logo" />
      </div>
      <div class="menu">
        <div class="dashboard focus dashboard-focus transition">
          <img src="./Icons/dashboard.png" alt="icon" />
          <p>Dashboard</p>
        </div>

        <div class="report focus transition">
          <img src="./Icons/report.png" alt="icon" />
          <p>Report</p>
        </div>

        <div class="travelers focus transition">
          <img src="./Icons/travelers.png" alt="icon" />
          <p>Travelers</p>
        </div>

        <div class="tour-guide focus transition">
          <img src="./Icons/tourist-guide.png" alt="icon" />
          <p>Tour Guides</p>
          <!-- <img src="" alt="down-arrow" /> -->
        </div>

        <div class="services focus transition">
          <img src="./Icons/history.png" alt="icon" />
          <p>History</p>
          <!-- <img src="" alt="down-arrow" /> -->
        </div>

        <div class="tours focus transition">
          <img src="./Icons/tours.png" alt="icon" />
          <p>Tours</p>
          <!-- <img src="" alt="down-arrow" /> -->
        </div>

        <div class="messages focus transition" id="clickableDiv" data-url="https://dashboard.tawk.to/#/dashboard" role="button" tabindex="0">
          <img src="./Icons/messages.png" alt="icon" />
          <p>Messages</p>
          <!-- <img src="" alt="down-arrow" /> -->
        </div>

        <div class="settings focus transition">
          <img src="./Icons/settings.png" alt="icon" />
          <p>Settings</p>
          <!-- <img src="" alt="down-arrow" /> -->
        </div>
      </div>

      <div class="logout">
        <img src=<?php echo $_SESSION['rootimage'] ?> alt="profile" class="pointer2" />
        <p class="name"><?php echo $_SESSION['rootname'] ?></p>
        <p class="email"><?php echo $_SESSION['rootemail'] ?></p>
        <div class="log log-out">
          <form>
            <button name="logout" class="logoutbutton">Logout</button>
          </form>
        </div>
      </div>

      <div class="copy-right">
        <p>Universus Tourism</p>
        <p>© 2024 All rights reserved</p>
        <p>Made by Naimur</p>
      </div>
    </div>

    <!-- -----------------------------Header------------------------------------- -->

    <div class="header item2">
      <div class="header-dashboard">
        <img src="./Icons/dashboard.png" alt="icon" />
        <p>Dashboard</p>
      </div>

      <div class="search">
        <input class="search-box" type="text" placeholder="Search" />
        <img src="./Icons/search.png" alt="search" class="pointer" />
      </div>

      <div class="weather pointer">
        <img src="./Icons/weather-icon.png" alt="Icon" class="weather-icon-change" />

        <div class="details">
          <p class="date">Today, 2024-03-26 23:48</p>
          <p class="temp">Temp: 24.3 °C, <?php echo $_SESSION['rootlocation']; ?> </p>
        </div>
      </div>

      <form method="post">
        <button class="notification-icon pointer pointer2" name="notification-icon">
          <img src="<?php echo $notification_icon ?>" alt="notification" />
        </button>
      </form>

      <div class="message-icon pointer pointer2">
        <img src="./Icons/message-icon.png" alt="message" />
      </div>

      <div class="header-profile pointer">
        <img src=<?php echo $_SESSION['rootimage'] ?> alt="profile" class="profile-img pointer2 headerimg" />
      </div>
    </div>


    <!-- ------------------------------------- Main Body------------------------------------------ -->

    <div class="main item3">
      <!-- ----------------------------1st part left------------------------ -->

      <div class="main-details">
        <div class="details-box1 boxs main-details-hover">
          <img src="./Icons/travelers-icon.png" alt="icon" class="box1-icon" />
          <p class="travelers-num">1546</p>
          <p class="total-travelers">Total Travelers</p>
        </div>

        <div class="details-box2 boxs main-details-hover">
          <img src="./Icons/booking-icon.png" alt="icon" class="box2-icon" />
          <p class="bookings-num">1522</p>
          <p class="total-bookings">Total Bookings</p>
        </div>

        <div class="details-box3 boxs main-details-hover">
          <img src="./Icons/activetrip-icon.png" alt="icon" class="box3-icon" />
          <p class="active-num">05</p>
          <p class="total-active">Active Trips</p>
        </div>

        <div class="details-box4 boxs main-details-hover" id="clickableDiv2" data-url="https://dashboard.stripe.com/test/payments" role="button" tabindex="0">
          <img src="./Icons/earning-icon.png" alt="icon" class="box4-icon" />
          <p class="earnings-num">8325 BDT</p>
          <p class="total-earnings">Earnings</p>
        </div>
      </div>

      <!-- ----------------------------------1st part Right---------------------------------------- -->
      <div class="main-right">
        <div class="headings">
          <p class="discount">Top Discounts</p>
          <p class="lastdays">Last 7 Days</p>
        </div>
        <div class="first-discount">
          <div class="first-discount-color"></div>
          <p class="first-discount-name">Special discount</p>
          <p class="first-discount-per">70%</p>
        </div>

        <div class="second-discount">
          <div class="second-discount-color"></div>
          <p class="second-discount-name">Fixed card discount</p>
          <p class="second-discount-per">12%</p>
        </div>

        <div class="third-discount">
          <div class="third-discount-color"></div>
          <p class="third-discount-name">Fixed coupon discount</p>
          <p class="third-discount-per">18%</p>
        </div>

        <div class="pie-chart">
          <div class="pie-chart-container">
            <div class="pie-chart-progress">
              <div class="pie-chart-value">0%</div>
            </div>
          </div>
        </div>
      </div>

      <!-- ----------------------------------2nd part---------------------------------------- -->

      <div class="main-middle">
        <div class="c-review">
          <p>Customer Reviews</p>
        </div>

        <div class="review-container">
          <div class="review-boxes">
            <!-- <div class="review-box1 common-review-box ">
              <p class="paragraph">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis
                repudiandae numquam sapiente porro quidem quisquam ipsa voluptas
                recusandae suscipit minus. Animi eos corporis quasi deserunt
                consequatur. Doloribus rem modi animi.
              </p>
              <div class="review-profile">
                <img src="../Icons/profile.jpg" alt="" class="re-img" />
                <p class="re-name">Naimur Rahman</p>
                <p class="re-time">4m ago</p>
              </div>
              <div class="ratings">
                <img
                  src="../Icons/full-rating2.png"
                  alt=""
                  class="rating-point"
                />
              </div>
            </div>

            <div class="review-box2 common-review-box">
              <p class="paragraph">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis
                repudiandae numquam sapiente porro quidem quisquam ipsa voluptas
                recusandae suscipit minus. Animi eos corporis quasi deserunt
                consequatur. Doloribus rem modi animi.
              </p>
              <div class="review-profile">
                <img src="../Icons/profile.jpg" alt="" class="re-img" />
                <p class="re-name">Naimur Rahman</p>
                <p class="re-time">4m ago</p>
              </div>
              <div class="ratings">
                <img
                  src="../Icons/half-rating2.png"
                  alt=""
                  class="rating-point"
                />
              </div>
            </div> -->
          </div>
        </div>

        <div class="see-more">
          <p>
            <!-- See more -->
          </p>
        </div>

        <div class="button-left button-hover common-button" onclick="goPrev()">
          <img src="./Icons/left-arrow-white.png" alt="" class="left-arrow" />
        </div>

        <div class="button-right button-hover common-button" onclick="goNext()">
          <img src="./Icons/right-arrow-white.png" alt="" class="right-arrow" />
        </div>
      </div>

      <!-- ----------------------------------3rd part---------------------------------------- -->

      <div class="main-bottom">
        <div class="top-country">
          <p class="top-region c-review">Top Regions by Revenue</p>
        </div>

        <div class="revenue-details">
          <div class="revenue-details-heading">
            <p class="revenue-country">Country</p>
            <p class="revenue-user">Users</p>
            <p class="revenue-transaction">Transactions</p>
            <p class="revenue-revenue">Revenue</p>
            <hr class="hr-line" />
            <p class="total-country"><?php echo $total_country ?></p>
            <p class="total-user">1546</p>
            <p class="total-transaction">1522</p>
            <p class="total-revenue">8325 BDT</p>
          </div>

          <div class="revenue-details-body">
            <div class="first-country common-country">
              <p class="country-no">1.</p>
              <img src="" alt="flag" class="country-flag1" />
              <p class="country-name">Bangladesh</p>
              <p class="country-user">1546 (34%)</p>
              <p class="country-transaction">1522 (41%)</p>
              <p class="country-revenue">8325 (35%)</p>
            </div>

            <div class="second-country common-country">
              <p class="country-no">2.</p>
              <img src="" alt="flag" class="country-flag2" />
              <p class="country-name">Bangladesh</p>
              <p class="country-user">1546 (34%)</p>
              <p class="country-transaction">1522 (41%)</p>
              <p class="country-revenue">8325 (35%)</p>
            </div>

            <div class="third-country common-country">
              <p class="country-no">3.</p>
              <img src="" alt="flag" class="country-flag3" />
              <p class="country-name">Bangladesh</p>
              <p class="country-user">1546 (34%)</p>
              <p class="country-transaction">1522 (41%)</p>
              <p class="country-revenue">8325 (35%)</p>
            </div>

            <div class="fourth-country common-country">
              <p class="country-no">4.</p>
              <img src="" alt="flag" class="country-flag4" />
              <p class="country-name">Bangladesh</p>
              <p class="country-user">1546 (34%)</p>
              <p class="country-transaction">1522 (41%)</p>
              <p class="country-revenue">8325 (35%)</p>
            </div>

            <div class="fifth-country common-country">
              <p class="country-no">5.</p>
              <img src="" alt="flag" class="country-flag5" />
              <p class="country-name">Bangladesh</p>
              <p class="country-user">1546 (34%)</p>
              <p class="country-transaction">1522 (41%)</p>
              <p class="country-revenue">8325 (35%)</p>
            </div>
          </div>
        </div>

        <div class="see-more2 see-more">
          <p><!-- See more --></p>
        </div>
      </div>
    </div>

    <!-- -------------------------------------disable background---------------------------- -->
    <div class="background"></div>
  </div>

  <!-- ---------------------------Weather popup------------------------ -->

  <div class="weather-popup">
    <div class="weather-header">
      <p class="weather-details">Weather Details</p>
      <button class="close pointer">X</button>
    </div>
    <div class="weather-container">
      <div class="left">
        <p class="day">MONDAY</p>
        <p class="time">12:34</p>
        <div class="icon-temp">
          <img src="./Icons/temperature-icon.png" alt="icon" class="temperature-icon" />
          <p class="weather-temp">24.3°C</p>
        </div>
        <p class="uv">UV index: 1</p>
        <p class="feelslike">Feels like: 24.3°C</p>
      </div>

      <div class="humidity">
        <p class="humidity-text">Humidity</p>
        <div class="progressbar-container">
          <div class="circular-progress">
            <div class="progress-value">0%</div>
          </div>
        </div>
      </div>

      <div class="wind">
        <p class="wind-text">Wind</p>
        <img src="./Icons/wind-mill.gif" alt="icon" class="wind-imgs" />
        <p class="wind-direction">Direction: NNW</p>
        <p class="wind-value">Speed: 24 km/h</p>
      </div>
    </div>

    <div class="weather-search">
      <div class="search2">
        <input class="search-box2" type="text" placeholder="Search" />
        <img src="./Icons/search.png" alt="search" class="pointer" />
      </div>

      <div class="weather2 pointer">
        <img src="./Icons/weather-icon.png" alt="Icon" />
        <div class="details">
          <p class="country">Bangladesh</p>
        </div>
      </div>
    </div>
  </div>


  <?php
  function show_notificationpopup()
  {
  ?>
    <div class="notification-popup">
      <button class="close-notification pointer">X</button>
      <iframe class="iframe" src="./test.php" width="100%" height="100%" frameborder="0"></iframe>
    </div>
  <?php
  }
  ?>

  <script src="http://localhost/Naimur/Views/WeatherApi.js"></script>
  <script src="http://localhost/Naimur/Views/template.js"></script>
  <script src="http://localhost/Naimur/Views/Dashboard.js"></script>
</body>

</html>