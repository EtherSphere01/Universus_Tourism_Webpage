<!DOCTYPE html>
<script>
  let totalTravelers_php = 43;
  let totalBookings_php = 61;
  let totalActive_php = 0;
  let totalHotel_php = 0;
  let totalTourguide_php = 0;
  let totalPlan_php = 0;

  let totalEarnings_php = 0;
  let totalExpense_php = 0;

  let touistEarning_php = 0;
  let hotelEarning_php = 0;
  let addEarning_php = 0;

  let tourguideSalary_php = 0;
  let officeStuff_php = 0;
  let other_php = 0;

  let countryArray_php = [];
  let countryTransaction_php = [];

  let locationset = 'Dhaka';
</script>

<?php
session_start();

require_once("../Controllers/ReportController.php");

$details = send_request_getDetailsDashboard();
echo "<script>
    totalTravelers_php += " . $details['totaluser'] . ";
    totalActive_php = " . $details['totalactivetrip'] . ";
    totalEarnings_php = " . $details['totalearning'] . ";
  </script>";

$tourguide_details = send_request_tourguide();
echo "<script>
    totalTourguide_php = " . $tourguide_details->num_rows . ";
  </script>";

$totalplan = send_request_totalplan();
echo "<script>
    totalPlan_php = " . $totalplan . ";
  </script>";

$totalhotels = send_request_hotels();
echo "<script>
    totalHotel_php = " . $totalhotels . ";
  </script>";


$earning = send_earning();

echo "<script>
    touistEarning_php = " . $earning['travelers'] . ";
    hotelEarning_php = " . $earning['hotels'] . ";
    addEarning_php = " . $earning['advertisement'] . ";
    totalEarnings_php = " . $earning['travelers'] + $earning['hotels'] + $earning['advertisement'] . ";
  </script>";

$expense = send_expense();
echo "<script>
    tourguideSalary_php = " . $expense['tourguides'] . ";
    officeStuff_php = " . $expense['officestuff'] . ";
    other_php = " . $expense['others'] . ";
    totalExpense_php = " . $expense['tourguides'] + $expense['officestuff'] + $expense['others'] . ";
  </script>";

$countryArray = get_CountryArray();

while ($row = $countryArray->fetch_assoc()) {
  echo "<script>
      countryArray_php.push('" . $row['country'] . "');
      countryTransaction_php.push('" . $row['transactions'] . "');
    </script>";
}


echo "<script> 
      locationset = '" . $_SESSION['rootlocation'] . "';
    </script>";


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

  require_once('../Controllers/DashboardController.php');
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
  <link rel="stylesheet" href="http://localhost/Naimur/Views/Report.css" />
  <link rel="stylesheet" href="http://localhost/Naimur/Views/Template.css" />
  <link rel="stylesheet" href="http://localhost/Naimur/Views/weatherpopup.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Reddit+Mono:wght@200..900&display=swap" />
  <link href="https://fonts.googleapis.com/css2?family=Exo+2:ital,wght@0,100..900;1,100..900&family=Exo:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
  <title>Report</title>
</head>

<body>
  <!-- -------------------------Left panel-------------------------------------- -->

  <div class="container">
    <div class="left-panel item1">
      <div class="logo">
        <img src="./Figma/Blue Orange.png" alt="logo" />
      </div>
      <div class="menu">
        <div class="dashboard focus report-focus transition">
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
      <div class="header-report">
        <img src="./Icons/report.png" alt="icon" />
        <p>Report</p>
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
      <div class="site-summary">
        <div class="s-box1 s-common-flex">
          <p class="s-travelers s-common-heading">Travelers</p>
          <p class="s-travelers-num s-common-total">1546</p>
        </div>

        <div class="s-box2 s-common-flex">
          <p class="s-tour-guide s-common-heading">Tour Guides</p>
          <p class="s-tour-guide-num s-common-total">50</p>
        </div>

        <div class="s-box3 s-common-flex">
          <p class="s-plan s-common-heading">Total Plans</p>
          <p class="s-plan-num s-common-total">15</p>
        </div>

        <div class="s-box4 s-common-flex">
          <p class="s-active-plan s-common-heading">Active Plans</p>
          <p class="s-active-num s-common-total">10</p>
        </div>

        <div class="s-box5 s-common-flex">
          <p class="s-hotels s-common-heading">Hotels</p>
          <p class="s-hotel-num s-common-total">150</p>
        </div>
      </div>

      <!-- -----------------------------Report Details------------------------------------ -->
      <div class="report-details">
        <div class="earning-details">
          <div class="earning-heading">Earning Details</div>

          <p class="from-tourist">From Tourists</p>
          <div class="from-tour-graph">
            <p>20%</p>
          </div>

          <p class="from-hotel">From Hotels</p>
          <div class="from-hotel-graph">
            <p>20%</p>
          </div>

          <p class="from-add">From Advertisement</p>
          <div class="from-add-graph">
            <p>20%</p>
          </div>

          <div class="total-earning-sum">
            <p class="total-earning">Total Earning: 10000 BDT</p>
          </div>
        </div>

        <div class="expense-details">
          <div class="expense-heading">Expense Details</div>

          <p class="from-tourguide">Tour Guide Salary</p>
          <div class="from-tourguide-graph">
            <p>20%</p>
          </div>

          <p class="from-office">Office Stuff</p>
          <div class="from-office-graph">
            <p>20%</p>
          </div>

          <p class="from-other">Others</p>
          <div class="from-other-graph">
            <p>20%</p>
          </div>

          <div class="total-expense-sum">
            <p class="total-expense">Total Earning: 10000 BDT</p>
          </div>
        </div>
      </div>

      <div class="chartjs">
        <div class="title1">Earning VS Expense</div>
        <canvas id="earningVSexpense"></canvas>
        <div class="title2">Joining Details</div>
        <canvas id="joiningDetails"></canvas>
      </div>

      <div class="top-p">
        <p class="top-places">Top Places</p>
        <canvas id="topPlaces"></canvas>
      </div>

      <!-- <div class="download-button">Download Report</div> -->
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


  <script src="https://unpkg.com/jspdf-invoice-template@1.4.0/dist/index.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="http://localhost/Naimur/Views/WeatherApi.js"></script>
  <script src="http://localhost/Naimur/Views/template.js"></script>
  <script src="http://localhost/Naimur/Views/Report.js"></script>
</body>

</html>