<!DOCTYPE html>

<script>
  let locationset = '';
</script>

<?php
require_once('../Controllers/TourGuideController.php');

session_start();

$tourguideuname = "";
$tourguidefname = "";
$tourguideloc = "";
$tourguideph = "";
$tourguideim = "";
$tourguidesal = "";

$_SESSION['tourguideusername1'] = null;
$_SESSION['tourguidename1'] = null;
$_SESSION['tourguidelocation1'] = null;
$_SESSION['tourguidephone1'] = null;
$_SESSION['tourguideimage1'] = null;
$_SESSION['tourguidesalary1'] = null;

if (isset($_POST['tourguideaddsubmit'])) {
  $send_name = get_validity_tourguide($_POST['tourguideaddusername']);
  if ($send_name->num_rows > 0) {
    $_SESSION['tourguideusername1'] = $_POST['tourguideaddusername'];
    $_SESSION['tourguidename1'] = $_POST['tourguideaddname'];
    $_SESSION['tourguidelocation1'] = $_POST['tourguideaddlocation'];
    $_SESSION['tourguidephone1'] = $_POST['tourguideaddphone'];
    $_SESSION['tourguideimage1'] = $_POST['tourguideaddtempimg'];
    $_SESSION['tourguidesalary1'] = $_POST['tourguideaddsalary'];
    // echo "<script> alert('Username Already Taken');</script>";
  } else {
    $tourguideusername = $_POST['tourguideaddusername'];
    $tourguidename = $_POST['tourguideaddname'];
    $tourguidelocation = $_POST['tourguideaddlocation'];
    $tourguidephone = $_POST['tourguideaddphone'];
    if (empty($_POST['tourguideaddtempimg'])) {
      $tourguideimage = "./UserImage/image-template.png";
    } else {
      $tourguideimage = $_POST['tourguideaddtempimg'];
    }
    $tourguidesalary = $_POST['tourguideaddsalary'];
    $tourguideadd = add_tourguide($tourguideusername, $tourguidename, $tourguidelocation, $tourguidephone, $tourguideimage, $tourguidesalary);
    $_SESSION['tourguideusername1'] = null;
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




if (isset($_POST['tourguidesubmit'])) {

  $tourguideusername = $_POST['tourguideusername'];
  $tourguidename = $_POST['tourguidename'];
  $tourguidelocation = $_POST['tourguidelocation'];
  $tourguidephone = $_POST['tourguidephone'];
  $tourguideimage = $_POST['tourguidetempimg'];
  $tourguidesalary = $_POST['tourguidesalary'];
  $tourguideupdate = update_tourguide($tourguideusername, $tourguidename, $tourguidelocation, $tourguidephone, $tourguideimage, $tourguidesalary);
}

if (isset($_POST['tourguidedelete'])) {

  $tourguideusername = $_POST['tourguidedelete'];
  $check = delete_tourguide($tourguideusername);
}

echo "<script> locationset = '" . $_SESSION['rootlocation'] . "';</script>";

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
  <link rel="stylesheet" href="http://localhost/Naimur/Views/Template.css" />
  <link rel="stylesheet" href="http://localhost/Naimur/Views/weatherpopup.css" />
  <link rel="stylesheet" href="http://localhost/Naimur/Views/TourGuide.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Reddit+Mono:wght@200..900&display=swap" />
  <link href="https://fonts.googleapis.com/css2?family=Exo+2:ital,wght@0,100..900;1,100..900&family=Exo:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
  <title>Tour Guide</title>
</head>

<body>
  <!-- -------------------------Left panel-------------------------------------- -->

  <div class="container">
    <div class="left-panel item1">
      <div class="logo">
        <img src="./Figma/Blue Orange.png" alt="logo" />
      </div>
      <div class="menu">
        <div class="dashboard focus transition">
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
      <div class="header-tourGuide">
        <img src="./Icons/tourist-guide.png" alt="icon" />
        <p>Tour Guide</p>
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
      <main class="table" id="customers_table">
        <section class="table__header">
          <h1>Tour Guides List</h1>
          <div class="input-group">
            <input type="search" placeholder="Search by name" />
            <img src="./Icons/search.png" alt="" />
          </div>
        </section>

        <section class="table__body">
          <form method='post'>
            <table>
              <thead>
                <tr>
                  <th>Username <span class="icon-arrow">&UpArrow;</span></th>
                  <th>Travelers <span class="icon-arrow">&UpArrow;</span></th>
                  <th>Location <span class="icon-arrow">&UpArrow;</span></th>
                  <th>
                    Joining Date <span class="icon-arrow">&UpArrow;</span>
                  </th>
                  <th>Salary <span class="icon-arrow">&UpArrow;</span></th>
                  <th>Phone <span class="icon-arrow">&UpArrow;</span></th>
                  <th>Edit <span class="icon-arrow">&UpArrow;</span></th>
                  <th>Delete <span class="icon-arrow">&UpArrow;</span></th>
                </tr>
              </thead>
              <tbody>
                <?php
                require_once('../Models/allDB.php');
                $tourguideresult = table_element_tourguide();

                while ($row = $tourguideresult->fetch_assoc()) { ?>

                  <tr>
                    <td> <?php echo $row['username'] ?> </td>
                    <td>
                      <img src="<?php echo $row['image'] ?>" alt="" /><?php echo $row['name'] ?>
                    </td>
                    <td><?php echo $row['location'] ?></td>
                    <td><?php echo $row['joiningdate'] ?></td>
                    <td> <?php echo $row['salary'] ?> </td>
                    <td> <?php echo $row['phone'] ?> </td>
                    <td><button name="tourguideedit" class="edit" value=<?php echo $row['username'] ?>>Edit</button></td>
                    <td><button name="tourguidedelete" class="delete" value=<?php echo $row['username'] ?>>Delete</button></td>
                  </tr>

                <?php
                }
                ?>

              </tbody>
            </table>
          </form>
        </section>
      </main>


      <!-- Edit Tour guide -->
      <?php
      function show_edit_table_tourguide($tourguideuname, $tourguidefname, $tourguideloc, $tourguideph, $tourguideim, $tourguidesal)
      {


      ?>
        <div class="edit-form">
          <div class="edit-form-container">
            <div class="edit-form-header">
              <p class="edit-form-title">Edit Tour Guide</p>
              <button class="closee pointer">X</button>
            </div>
            <form class="edit-form-body" method='post'>

              <div class="username">Username</div>
              <input type="text" name="tourguideusername" id="username" class="common-textfield" value="<?php echo $tourguideuname ?>" required />

              <div class="name">Name</div>
              <input type="text" name="tourguidename" id="name" class="common-textfield" value="<?php echo $tourguidefname ?>" required />

              <div class="location">Location</div>
              <input type="text" name="tourguidelocation" id="location" class="common-textfield" value="<?php echo $tourguideloc ?>" required />


              <div class="phone">Phone</div>
              <input type="text" name="tourguidephone" id="phone" class="common-textfield" value="<?php echo $tourguideph ?>" required />

              <div class="salary">Salary</div>
              <input type="text" name="tourguidesalary" id="salary" class="common-textfield" value="<?php echo $tourguidesal ?>" required />


              <div class="image">Image</div>
              <input type="file" name="tourguideimage" id="image" onchange="loadFile(event)">
              <input type="hidden" name="tourguidetempimg" id="tempimg" value="<?php echo $tourguideim ?>" />

              <p class="fillup">Please fillup the form</p>
              <button class="submit pointer" name="tourguidesubmit">Submit</button>

              <div class="edit-image">
                <img src="<?php echo $tourguideim ?>" id="uimage" />
              </div>

              <script>
                var loadFile = function(event) {
                  var image = document.getElementById('uimage');
                  image.src = URL.createObjectURL(event.target.files[0]);
                  var temp = event.target.files[0]['name'];
                  // console.log(event.target.files);
                  const uim = document.getElementById('tempimg');
                  uim.value = "./UserImage/" + temp;

                };
              </script>

            </form>
          </div>
        </div>

      <?php }

      if (isset($_POST['tourguideedit'])) {

        $uuname = $_POST['tourguideedit'];
        $re = get_edit_info_tourguide($uuname);
        $uname = $re['username'];
        $fname = $re['name'];
        $loc = $re['location'];
        $ph = $re['phone'];
        $im = $re['image'];
        $sal = $re['salary'];
        show_edit_table_tourguide($uname, $fname, $loc, $ph, $im, $sal);
      }
      ?>


      <!-- add tour guide -->


      <div class="add-form">
        <div class="add-form-container">
          <div class="add-form-header">
            <p class="add-form-title">Add Tour Guide</p>
            <!-- <button class="close pointer">X</button> -->
          </div>
          <form class="add-form-body" method='post'>

            <div class="addusername">Username</div>
            <input type="text" name="tourguideaddusername" id="addusername" class="common-textfield" />

            <div class="addname">Name</div>
            <input type="text" name="tourguideaddname" id="addname" class="common-textfield" required />

            <div class="addlocation">Location</div>
            <input type="text" name="tourguideaddlocation" id="addlocation" class="common-textfield" required />


            <div class="addphone">Phone</div>
            <input type="text" name="tourguideaddphone" id="addphone" class="common-textfield" required />

            <div class="addsalary">Salary</div>
            <input type="text" name="tourguideaddsalary" id="addsalary" class="common-textfield" required />

            <div class="addimage">Image</div>
            <input type="file" name="tourguideaddimage" id="addimage" onchange="addloadFile(event)">
            <input type="hidden" name="tourguideaddtempimg" id="addtempimg" />

            <p class="addfillup">Please fillup the form</p>
            <button class="addsubmit pointer" name="tourguideaddsubmit">Add</button>

            <div class="add-image">
              <img src="<?php echo $tourguideaddtempimg ?>" id="adduimage" />
            </div>

            <script>
              var addloadFile = function(event) {
                var addimage = document.getElementById('adduimage');
                addimage.src = URL.createObjectURL(event.target.files[0]);
                var addtemp = event.target.files[0]['name'];
                // console.log(event.target.files);
                const adduim = document.getElementById('addtempimg');
                adduim.value = "./UserImage/" + addtemp;

              };

              const getusername = document.querySelector(".sending-uname");
            </script>

            <?php
            if (!empty($_SESSION['tourguideusername1'])) {
              $tourguideaddusername = $_SESSION['tourguideusername1'];
              $tourguideaddname = $_SESSION['tourguidename1'];
              $tourguideaddlocation = $_SESSION['tourguidelocation1'];
              $tourguideaddphone = $_SESSION['tourguidephone1'];
              $tourguideaddimage = $_SESSION['tourguideimage1'];
              $tourguidetaken = 'Username Already Taken';
              echo "<script>document.getElementById('addusername').value = '$tourguideaddusername';</script>";
              echo "<script>document.getElementById('addname').value = '$tourguideaddname';</script>";
              echo "<script>document.getElementById('addlocation').value = '$tourguideaddlocation';</script>";
              echo "<script>document.getElementById('addphone').value = '$tourguideaddphone';</script>";
              echo "<script>document.getElementById('addtempimg').value = '$tourguideaddimage';</script>";
              echo "<script>const addfillup = document.querySelector('.addfillup');
                    addfillup.innerHTML = '$tourguidetaken'
                    ;</script>";
            }

            ?>

          </form>
        </div>
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
  <script src="http://localhost/Naimur/Views/template.js"></script>
  <script src="http://localhost/Naimur/Views/TourGuide.js"></script>
</body>

</html>