
<?php 
ob_start();
require_once("../Controllers/SettingsController.php");
  session_start();
  $details = get_details('admin');
  $namedb = $details['name'];
  $emaildb = $details['email'];
  $imagedb = $details['image'];


      $_SESSION['rootusername'] = 'admin';
      $_SESSION['rootname'] = $namedb;
      $_SESSION['rootemail'] = $emaildb;
      $_SESSION['rootimage'] = $imagedb;
      $_SESSION['rootlocation'] = $details['location'];
      header("Location: ./Dashboard.php");


ob_end_flush();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post">

    <button name="set">click me</button>
    </form>

    <script src="http://localhost/Naimur/Views/Template.js"></script>
</body>
</html>