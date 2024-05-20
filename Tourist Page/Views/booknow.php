<?php
//     $email = $_SESSION['email'];
//     $con = conn();
//     $sql = "SELECT * FROM cart where email = '$email'";
//     $result = mysqli_query($con, $sql);

//     while($resultArray = mysqli_fetch_array($result)){
//         $name = $resultArray['name'];
//         $price = $resultArray['price'];
//         $imgsource = $resultArray['imgsource'];
        
//         echo "<div class='product'>
//         <img src='$imgsource' alt='product image'>
//         <h3>$name</h3>
//         <p>$price</p>
//         </div>";
//     }
//    echo "total price = ".$_SESSION['hidden'];
session_start();

if (empty($_SESSION['email'])) {
    echo "<script> 
    window.location.href = 'http://localhost/Tourist%20Page/Views/login.php';
      </script>";
  }
  
// require_once ('../Controllers/navController.php');
// require_once ('../Controllers/checkoutController.php');
 //require_once ('../Controllers/loginController.php');
 require_once ('../Controllers/cartController.php');
 require_once ('../Controllers/couponController.php');
// require_once('../Models/alldb.php');
$couponAmount = 0;

// $_SESSION['Custnamee'] = "";
//   $_SESSION['Custemaile'] = "";
//   $_SESSION['Custphonee'] = "";
//   $_SESSION['Custaddresse'] = "";
//   $_SESSION['orderTotal'] = "";
//   $_SESSION['productName'] = "";

if(isset($_POST['coupon-btn'])){

  $_SESSION['Custnamee'] = $_POST['Custname'];
  $_SESSION['Custemaile'] = $_POST['Custemail'];
  $_SESSION['Custphonee'] = $_POST['Custphone'];
  $_SESSION['Custaddresse'] = $_POST['Custaddress'];
  // $_SESSION['orderTotal'] = $_POST['orderTotal'];
  $_SESSION['productNamee'] = $_POST['productName'];


  //$productName = $_POST['productName'];
  //$orderTotal = $_POST['orderTotal'];
  $coupon = $_POST['coupon'];
  $couponAmount = applyCoupon($coupon);
  if($couponAmount){
      echo "Coupon Applied";
      $_SESSION['orderTotal'] = $_SESSION['bookproductPrice']*$_SESSION['bookduration'] - $couponAmount;

  }
  else{
      echo "Coupon Failed";
  }
}

if(isset($_POST['final-checkout-btn'])){
  // Retrieve form data
  $custName = $_SESSION['Custnamee'] ;
  $custEmail =  $_SESSION['Custemaile'];
  $custPhone = $_SESSION['Custphonee'];
  $custAddress = $_SESSION['Custaddresse'];
  $productName = $_SESSION['productNamee'];
  $orderTotal = $_SESSION['orderTotal'];

  $result = callToOrder($custName, $custEmail, $custPhone, $custAddress, $productName, $orderTotal, $_SESSION['bookduration']);
  if($result){
      echo "Order Successful";
  }
  else{
      echo "Order Failed";
  }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="icon" type="image/x-icon" href="favicon.ico">

    <link rel="stylesheet" href="checkout.css">
</head>
<body>
<form method="POST" class="container">
    <div class="container">
        <div class="window">
            <div class="order-info">
                <div class="order-info-content">
                    <h2>Order Summary</h2>
                    <div class="line"></div>
        
                    <table class="order-table">
                        <tbody>
                            <tr>
                                <td><img src="<?php echo $_SESSION['bookproductImage']; ?>" class="full-width"></td>
                                <td>
                                    <!-- Product Name -->
                            
                                    <br><?php echo $_SESSION['bookproductname']; ?><br> <span class="thin small">Duration/Person: <?php echo $_SESSION['bookduration']; ?> Day/Person</span>
                                    <input type="hidden" name="productName" value="<?php echo $_SESSION['bookproductname']; ?>">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <!-- Product Price -->
                                    <div class="price">&#2547;<?php echo $_SESSION['bookproductPrice']*$_SESSION['bookduration']; ?></div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="line"></div>
                   
                    <div class="total">
                        <span style="float:left;">
                            <div class="thin dense">Coupon Discount</div>
                            TOTAL
                        </span>
                        <span style="float:right; text-align:right;">
                            <?php 
                            if ($couponAmount) {
                                echo "<div class='thin dense'>$" . $couponAmount . "</div>";
                            } else {
                                echo "<div class='thin dense'>$0</div>";
                            }
                            ?>
                            $
                            <?php 
                            if (isset($_SESSION['bookproductPrice'])) {
                                echo $_SESSION['bookproductPrice']*$_SESSION['bookduration'] - $couponAmount;
                            } else {
                                echo "0";
                            }
                            ?> <!-- Order final price -->
                            <input type="hidden" name="orderTotal" value="<?php echo isset($_SESSION['bookproductprice']) ? ($_SESSION['bookproductPrice']*$_SESSION['bookduration'] - $couponAmount) : '0'; ?>">
                        </span>
                    </div>
                </div>
            </div>
            <div class="credit-info">
                <div class="credit-info-content">
                    <table class="half-input-table">
                        <tr>
                            <td align="center" class="booking-txt"><b>Booking Information</b></td>
                        </tr>
                    </table>
                    <img src="logo.png" class="my-image" height="80" class="credit-card-image" id="credit-card-image"></img>
                    Name:
                    <input class="input-field" name="Custname" value="<?php echo isset($_SESSION['Custnamee']) ? $_SESSION['Custnamee'] : ''; ?>">
                    Email:
                    <input class="input-field" name="Custemail" value="<?php echo isset($_SESSION['Custemaile']) ? $_SESSION['Custemaile'] : ''; ?>">
                    Contact No:
                    <input class="input-field" name="Custphone" value="<?php echo isset($_SESSION['Custphonee']) ? $_SESSION['Custphonee'] : ''; ?>">
                    Address:
                    <input class="input-field" name="Custaddress" value="<?php echo isset($_SESSION['Custaddresse']) ? $_SESSION['Custaddresse'] : ''; ?>">
                    <table class="half-input-table">
                        <tr>
                            <td> Coupon Code
                                <input type="text" name="coupon" class="input-field">
                            </td>
                            <td>
                                <button name="coupon-btn" class="coupon-btn">Apply Coupon</button>
                            </td>
                        </tr>
                    </table>
                    <button class="pay-btn" name="final-checkout-btn">Checkout</button>
                </div>
            </div>
        </div>
    </div>
</form>


</body>
</html>