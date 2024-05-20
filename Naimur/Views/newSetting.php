<!DOCTYPE html>

<script>
  function showPassword() {
    var x = document.getElementById("pdpassword");
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
  }

  let uname = '';
  let name = '';
  let email = '';
  let locationn = '';
  let phone = '';
  let facebookk = '';
  let github = '';
  let linkedin = '';
  let image = '';
  let password = '';
  let gender = '';
  let locationset = 'Dhaka';
</script>

<?php
require_once('../Controllers/SettingsController.php');
require_once('../Controllers/DashboardController.php');
session_start();

// $_SESSION['rootusername'] = 'admin';


$details = get_details($_SESSION['rootusername']);

$usernamedb = $details['username'];
$namedb = $details['name'];
$emaildb = $details['email'];
$locationdb = $details['location'];
$phonedb = $details['phone'];
$genderdb = $details['gender'];
$facebookdb = $details['facebook'];
$githubdb = $details['github'];
$linkedindb = $details['linkedin'];
$imagedb = $details['image'];
$passworddb = $details['password'];

echo "<script>uname = '$usernamedb';</script>";
echo "<script>name = '$namedb';</script>";
echo "<script>email = '$emaildb';</script>";
echo "<script>locationn = '$locationdb';</script>";
echo "<script>phone = '$phonedb';</script>";
echo "<script>gender = '$genderdb';</script>";
echo "<script>facebookk = '$facebookdb';</script>";
echo "<script>github = '$githubdb';</script>";
echo "<script>linkedin = '$linkedindb';</script>";
echo "<script>image = '$imagedb';</script>";
echo "<script>password = '$passworddb';</script>";
echo "<script> locationset = '" . $_SESSION['rootlocation'] . "';</script>";


if (isset($_POST['pdsubmit'])) {
  $username = $_SESSION['rootusername'];
  $name = $_POST['pdname'];
  $email = $_POST['pdemail'];
  $location = $_POST['pdlocation'];
  $phone = $_POST['pdphone'];
  $gender = $_POST['pdgender'];
  $facebook = $_POST['pdfacebook'];
  $github = $_POST['pdgithub'];
  $linkedin = $_POST['pdlinkedin'];
  $image = $_POST['tourguidetempimg'];
  if (empty($image)) {
    $image = $details['image'];
  }
  $password = $_POST['pdpassword'];

  $result = update_details_admin($username, $name, $email, $location, $phone, $gender, $facebook, $github, $linkedin, $image, $password);
  if ($result) {
    $_SESSION['rootname'] = $name;
    $_SESSION['rootemail'] = $email;
    $_SESSION['rootimage'] = $image;
    $_SESSION['rootlocation'] = $location;
    reloadPage();
  } else {
    echo "<script>alert('Failed to update');</script>";
  }
}

if (empty($_SESSION['rootusername'])) {
  echo "<script> 
  window.location.href = 'http://localhost/Tourist%20Page/Views/login.php';
    </script>";
}


if (isset($_GET['logout'])) {
  // session_destroy();

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
  <link rel="stylesheet" href="http://localhost/Naimur/Views/newSetting.css" />
  <link rel="stylesheet" href="http://localhost/Naimur/Views/Template.css" />
  <link rel="stylesheet" href="weatherpopup.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Reddit+Mono:wght@200..900&display=swap" />
  <link href="https://fonts.googleapis.com/css2?family=Exo+2:ital,wght@0,100..900;1,100..900&family=Exo:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
  <title>Settings</title>
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
      <div class="header-settings">
        <img src="./Icons/settings.png" alt="icon" />
        <p>Settings</p>
      </div>

      <div class="search">
        <input class="search-box" type="text" placeholder="Search" />
        <img src="./Icons/search.png" alt="search" class="pointer" />
      </div>

      <div class="weather pointer">
        <img src="./Icons/weather-icon.png" alt="Icon" />
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

      <div class="header-profile pointer pointer2">
        <img src=<?php echo $_SESSION['rootimage'] ?> alt="profile" class="headerimg" />
      </div>
    </div>

    <!-- ------------------------------------- Main Body------------------------------------------ -->

    <div class="main item3">

      <div class="short-profile">
        <div class="upper-profile">
          <img src="<?php echo $imagedb; ?>" alt="profile" class="upper-profile-pic" />
          <p class="name uproname">Naimur Rahman</p>
          <p class="email uproemail">naimurrahman471@gmail.com</p>
          <p class="role">Admin</p>
          <p class="location uprolocation">Dhaka, Bangladesh</p>
        </div>

        <div class="lower-profile">
          <div class="facebook">
            <img src="./Icons/facebook.png" alt="facebook" class="facebook-icon" />
            <p class="facebook-text">Facebook</p>
            <a href="" class="facebook-link">Facebook.com</a>
          </div>
          <div class="github">
            <img src="./Icons/github.png" alt="github" class="github-icon" />
            <p class="github-text">Github</p>
            <a href="" class="github-link">Github.com</a>
          </div>
          <div class="linkedin">
            <img src="./Icons/linkedin.png" alt="linkedin" class="linkedin-icon" />
            <p class="linkedin-text">LinkedIn</p>
            <a href="#" class="linkedin-link">Linkedin.com</a>
          </div>
        </div>
      </div>



      <div class="profile-details">
        <div class="profile-txt">Profile Details</div>

        <form class="edit-form-body" method='post'>

          <div class="pdusername">Username</div>
          <input type="text" name="pdusername" id="pdusername" class="common-textfield" value="<?php echo $usernamedb ?>" disabled />

          <div class="pdname">Name</div>
          <input type="text" name="pdname" id="pdname" class="common-textfield" value="<?php echo $namedb ?>" required />

          <div class="pdemail">Email</div>
          <input type="text" name="pdemail" id="pdemail" class="common-textfield" value="<?php echo $emaildb ?>" required />


          <div class="pdlocation">Location</div>
          <input type="text" name="pdlocation" id="pdlocation" class="common-textfield" value="<?php echo $locationdb ?>" required />


          <div class="pdphone">Phone</div>
          <input type="text" name="pdphone" id="pdphone" class="common-textfield" value="<?php echo $phonedb ?>" required />

          <div class="pdgender">Gender</div>
          <input type="text" name="pdgender" id="pdgender" class="common-textfield" value="<?php echo $genderdb ?>" required />

          <div class="pdfacebook">Facebook</div>
          <input type="text" name="pdfacebook" id="pdfacebook" class="common-textfield" value="<?php echo $facebookdb ?>" required />

          <div class="pdgithub">Github</div>
          <input type="text" name="pdgithub" id="pdgithub" class="common-textfield" value="<?php echo $githubdb ?>" required />

          <div class="pdlinkedin">LinkedIn</div>
          <input type="text" name="pdlinkedin" id="pdlinkedin" class="common-textfield" value="<?php echo $linkedindb ?>" required />

          <div class="pdimage">Image</div>
          <input type="file" name="pdimage" id="pdimage" onchange="loadFile(event)">
          <input type="hidden" name="tourguidetempimg" id="tempimg" value="<?php echo $imagedb ?>" />

          <div class="pdpassword">Password</div>
          <input type="password" name="pdpassword" id="pdpassword" class="common-textfield" value="<?php echo $passworddb ?>" required />

          <div class="show-hide">
            <input type="checkbox" id="show-hide" class="show-hide-checkbox" onclick="showPassword()" />
            <label for="show-hide" class="show-hide-label">Show</label>
          </div>
          <button class="pdsubmit pointer" name="pdsubmit">Save Changes</button>


          <script>
            var loadFile = function(event) {

              var imagee = document.getElementsByClassName('upper-profile-pic');
              var value = event.target.files[0]['name'];
              var total = "./UserImage/" + value;
              imagee[0].src = total;

              var tempimg = document.getElementById('tempimg');
              tempimg.value = total;
              image = total;
            };
          </script>

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
  <script src="http://localhost/Naimur/Views/newSetting.js"></script>

</body>

</html>