<script>
  let locationset = '';
</script>


<?php
require_once('../Controllers/TravelersController.php');

session_start();

$uname = "";
$fname = "";
$loc = "";
$ph = "";
$im = "";

$_SESSION['username1'] = null;
$_SESSION['name1'] = null;
$_SESSION['location1'] = null;
$_SESSION['phone1'] = null;
$_SESSION['image1'] = null;

if (isset($_POST['addsubmit'])) {
  $send_name = get_validity($_POST['addusername']);
  if ($send_name->num_rows > 0) {
    $_SESSION['username1'] = $_POST['addusername'];
    $_SESSION['name1'] = $_POST['addname'];
    $_SESSION['location1'] = $_POST['addlocation'];
    $_SESSION['phone1'] = $_POST['addphone'];
    $_SESSION['image1'] = $_POST['addtempimg'];
  } else {
    $username = $_POST['addusername'];
    $name = $_POST['addname'];
    $location = $_POST['addlocation'];
    $phone = $_POST['addphone'];
    if (empty($_POST['addtempimg'])) {
      $image = "./UserImage/image-template.png";
    } else {
      $image = $_POST['addtempimg'];
    }
    $add = add_traveler($username, $name, $location, $phone, $image);
    $_SESSION['username1'] = null;
  }

  // $_SESSION['username1'] = $_POST['addusername'];
  // $_SESSION['name1'] = $_POST['addname'];
  // $_SESSION['location1'] = $_POST['addlocation'];
  // $_SESSION['phone1'] = $_POST['addphone'];
  // $_SESSION['image1'] = $_POST['addtempimg'];

}
echo "<script> locationset = '" . $_SESSION['rootlocation'] . "';</script>";



if (isset($_POST['submit'])) {

  $username = $_POST['username'];
  $name = $_POST['name'];
  $location = $_POST['location'];
  $phone = $_POST['phone'];
  $image = $_POST['tempimg'];
  $update = update_traveler($username, $name, $location, $phone, $image);
}

if (isset($_POST['delete'])) {

  $username = $_POST['delete'];
  delete_traveler($username);
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

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="http://localhost/Naimur/Views/Template.css" />
  <link rel="stylesheet" href="http://localhost/Naimur/Views/weatherpopup.css" />
  <link rel="stylesheet" href="http://localhost/Naimur/Views/Travelers.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Reddit+Mono:wght@200..900&display=swap" />
  <link href="https://fonts.googleapis.com/css2?family=Exo+2:ital,wght@0,100..900;1,100..900&family=Exo:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
  <title>Travelers</title>
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
      <div class="header-travelers">
        <img src="./Icons/travelers.png" alt="icon" />
        <p>Travelers</p>
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
          <h1>Travelers List</h1>
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
                  <th>Phone <span class="icon-arrow">&UpArrow;</span></th>
                  <th>Edit <span class="icon-arrow">&UpArrow;</span></th>
                  <th>Delete <span class="icon-arrow">&UpArrow;</span></th>
                </tr>
              </thead>
              <tbody>
                <?php
                require_once('../Models/allDB.php');
                $result = table_element();

                while ($row = $result->fetch_assoc()) { ?>

                  <tr>
                    <td> <?php echo $row['username'] ?> </td>
                    <td>
                      <img src="<?php echo $row['image'] ?>" alt="" /><?php echo $row['name'] ?>
                    </td>
                    <td><?php echo $row['location'] ?></td>
                    <td><?php echo $row['joiningdate'] ?></td>
                    <td> <?php echo $row['phone'] ?> </td>
                    <td><button name="edit" class="edit" value=<?php echo $row['username'] ?>>Edit</button></td>
                    <td><button name="delete" class="delete" value=<?php echo $row['username'] ?>>Delete</button></td>
                  </tr>

                <?php
                }
                ?>

                <!--  
                <tr>
                  <td>9</td>
                  <td><img src="./Icons/travelers.png" alt="" /> Alson GC</td>
                  <td>Dhaka</td>
                  <td>22 Dec, 2023</td>
                  <td><strong>$249.99</strong></td>
                </tr>
                 -->
              </tbody>
            </table>
          </form>
        </section>
      </main>


      <!--------- edit firm---------->
      <?php
      function show_edit_table($uname, $fname, $loc, $ph, $im)
      {


      ?>
        <div class="edit-form">
          <div class="edit-form-container">
            <div class="edit-form-header">
              <p class="edit-form-title">Edit Traveler</p>
              <button class="closee pointer">X</button>
            </div>
            <form class="edit-form-body" method='post'>

              <div class="username">Username</div>
              <input type="text" name="username" id="username" class="common-textfield" value="<?php echo $uname ?>" required />

              <div class="name">Name</div>
              <input type="text" name="name" id="name" class="common-textfield" value="<?php echo $fname ?>" required />

              <div class="location">Location</div>
              <input type="text" name="location" id="location" class="common-textfield" value="<?php echo $loc ?>" required />


              <div class="phone">Phone</div>
              <input type="text" name="phone" id="phone" class="common-textfield" value="<?php echo $ph ?>" required />

              <div class="image">Image</div>
              <input type="file" name="image" id="image" onchange="loadFile(event)">
              <input type="hidden" name="tempimg" id="tempimg" value="<?php echo $im ?>" />

              <p class="fillup">Please fillup the form</p>
              <button class="submit pointer" name="submit">Submit</button>

              <div class="edit-image">
                <img src="<?php echo $im ?>" id="uimage" />
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

      if (isset($_POST['edit'])) {

        $uuname = $_POST['edit'];
        $re = get_edit_info($uuname);
        $uname = $re['username'];
        $fname = $re['name'];
        $loc = $re['location'];
        $ph = $re['phone'];
        $im = $re['image'];
        show_edit_table($uname, $fname, $loc, $ph, $im);
      }
      ?>



      <!-- ------------------------Add Travelers---------------------- -->

      <div class="add-form">
        <div class="add-form-container">
          <div class="add-form-header">
            <p class="add-form-title">Add Traveler</p>
            <!-- <button class="close pointer">X</button> -->
          </div>
          <form class="add-form-body" method='post'>

            <div class="addusername">Username</div>
            <input type="text" name="addusername" id="addusername" class="common-textfield" required />

            <div class="addname">Name</div>
            <input type="text" name="addname" id="addname" class="common-textfield" required />

            <div class="addlocation">Location</div>
            <input type="text" name="addlocation" id="addlocation" class="common-textfield" required />


            <div class="addphone">Phone</div>
            <input type="text" name="addphone" id="addphone" class="common-textfield" required />

            <div class="addimage">Image</div>
            <input type="file" name="addimage" id="addimage" onchange="addloadFile(event)">
            <input type="hidden" name="addtempimg" id="addtempimg" />

            <p class="addfillup">Please fillup the form</p>
            <button class="addsubmit pointer" name="addsubmit">Add</button>

            <div class="add-image">
              <img src="<?php echo $addtempimg ?>" id="adduimage" />
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
            if (!empty($_SESSION['username1'])) {
              $addusername = $_SESSION['username1'];
              $addname = $_SESSION['name1'];
              $addlocation = $_SESSION['location1'];
              $addphone = $_SESSION['phone1'];
              $addimage = $_SESSION['image1'];
              $taken = 'Username Already Taken';
              echo "<script>document.getElementById('addusername').value = '$addusername';</script>";
              echo "<script>document.getElementById('addname').value = '$addname';</script>";
              echo "<script>document.getElementById('addlocation').value = '$addlocation';</script>";
              echo "<script>document.getElementById('addphone').value = '$addphone';</script>";
              echo "<script>document.getElementById('addtempimg').value = '$addimage';</script>";
              echo "<script>const addfillup = document.querySelector('.addfillup');
                    addfillup.innerHTML = '$taken'
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
  <script src="http://localhost/Naimur/Views/Travelers.js"></script>
</body>

</html>