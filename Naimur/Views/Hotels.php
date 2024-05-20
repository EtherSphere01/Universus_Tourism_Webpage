<!DOCTYPE html>

<script>
  let locationset = '';
</script>

<?php

session_start();
require_once('../Controllers/HotelsController.php');
require_once('../Controllers/DashboardController.php');

if (empty($_SESSION['rootusername'])) {
  echo "<script> 
      window.location.href = 'http://localhost/Tourist%20Page/Views/login.php';
    </script>";
}

echo "<script> locationset = '" . $_SESSION['rootlocation'] . "';</script>";


if (isset($_GET['logout'])) {
  // session_destroy();

  echo "<script> 
      window.location.href = 'http://localhost/Tourist%20Page/Views/login.php';
    </script>";

  session_unset();
  session_destroy();
}


if (isset($_POST['tourguidesubmit'])) {

  $name = $_POST['tourguideusername'];
  $price = $_POST['tourguidename'];
  $location = $_POST['tourguidelocation'];
  $details = $_POST['tourguidephone'];
  $image = $_POST['tourguidetempimg'];
  $stock = $_POST['tourguidesalary'];
  $tourguideadd = edit_hotels($name, $price, $location, $details, $image, $stock);
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


<?php

require_once('../../Naimur/Controllers/HistoryController.php');

$r = takehistorydata();

if (isset($_POST['complete'])) {

  $r = update_complete_tour($_POST['complete']);
  if ($r) {
    header("Location: Hotels.php");
  }
}

if (isset($_POST['paid'])) {

  $r = update_paid_tour($_POST['paid']);
  if ($r) {
    header("Location: Hotels.php");
  }
}

if (isset($_POST['cancle'])) {

  $r = update_cancle_tour($_POST['cancle']);
  if ($r) {
    header("Location: Hotels.php");
  }
}



?>



<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="http://localhost/Naimur/Views/Hotels.css" />
  <link rel="stylesheet" href="http://localhost/Naimur/Views/Template.css" />
  <link rel="stylesheet" href="weatherpopup.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Reddit+Mono:wght@200..900&display=swap" />
  <link href="https://fonts.googleapis.com/css2?family=Exo+2:ital,wght@0,100..900;1,100..900&family=Exo:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
  <title>History</title>
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
      <div class="header-services">
        <img src="./Icons/history.png" alt="icon" />
        <p>History</p>
      </div>

      <div class="search">
        <input class="search-box" type="text" placeholder="Search" />
        <img src="./Icons/search.png" alt="search" class="pointer" />
      </div>

      <div class="weather pointer">
        <img src="./Icons/weather-icon.png" alt="Icon" />
        <div class="details">
          <p class="date">Today, 2024-03-26 23:48</p>
          <p class="temp">Temp: 24.3 °C, Bangladesh</p>
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

      <div class="header-profile pointer pointer2">
        <img src=<?php echo $_SESSION['rootimage'] ?> alt="profile" class="headerimg" />
      </div>
    </div>

    <!-- ------------------------------------- Main Body------------------------------------------ -->

    <div class="main item3">
      <div class="order-table">
        <p>Order History</p>
      </div>
      <div class="body">
        <form method="post">
          <div class="table-container">
            <table class="pricing-table">
              <thead>
                <tr>
                  <th>Order ID</th>
                  <th>Package Name</th>
                  <th>Amount</th>
                  <th>Status</th>
                  <th>Payment Status</th>
                  <th>Complete Status</th>
                  <th>Complete Payment</th>
                  <th>Cancel Order</th>
                </tr>
              </thead>
              <tbody>

                <?php
                while ($row = $r->fetch_assoc()) {
                ?>
                  <tr>
                    <td data-label="Order-ID"><?php echo $row['orderid']; ?></td>
                    <td data-label="Product-Name"><?php echo $row['productname']; ?></td>
                    <td data-label="Amount"><?php echo $row['amount']; ?></td>
                    <td data-label="Status"><?php echo $row['status']; ?></td>
                    <td data-label="Payment Status"><?php echo $row['pstatus']; ?></td>
                    <td data-label="Complete-status">
                      <button class="sign-up-btncomplete" name="complete" value="<?php echo $row['orderid']; ?>">Complete</button>
                    </td>
                    <td data-label="Complete-Payment">
                      <button class="sign-up-btnpaid" name="paid" value="<?php echo $row['orderid']; ?>">Paid</button>
                    </td>

                    <td data-label="Cancle Order">
                      <button class="sign-up-btncancle" name="cancle" value="<?php echo $row['orderid']; ?>">Cancel</button>
                    </td>

                  </tr>
                <?php
                }
                ?>

                <!-- <tr>
            <td data-label="Order-ID">56</td>
            <td data-label="Product-Name">Coxs-bazar</td>
            <td data-label="Amount">5600</td>
            <td data-label="Status">Pending</td>
            <td data-label="Payment Status">Paid</td>
            <td data-label="Complete-status">
              <button class="sign-up-btn">Complete</button>
            </td>
            <td data-label="Complete-Payment">
              <button class="sign-up-btn">Paid</button>
            </td>
          </tr> -->

              </tbody>
            </table>
          </div>
        </form>
      </div>


    </div>



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
  <script src="http://localhost/Naimur/Views/Template.js"></script>
  <script src="http://localhost/Naimur/Views/Hotels.js"></script>
</body>

</html>