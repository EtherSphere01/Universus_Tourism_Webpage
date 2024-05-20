<script>
    let phpData = "";
</script>


<?php
require('config.php');

if (isset($_POST['stripeToken'])) {

    \Stripe\Stripe::setVerifySslCerts(false);
    $token  = $_POST['stripeToken'];

    $data = \Stripe\Charge::create(array(
        'amount' => "5000",
        'currency' => 'usd',
        'description' => 'Booking Payment',
        'source' => $token,
    ));
    // echo "<pre>";
    // print_r($data);

    // $jsonData = json_encode($data);
    $amount =  $data->amount;
    $product_name =  $data->description;
    $tid =  $data->balance_transaction;
    $card =  $data->source->brand;
    $name = $data->billing_details->name;
    $currentDate = date('Y-m-d');

    // Output the JSON data to a JavaScript variable
    // echo "<script> phpData = $jsonData;</script>";

    require_once('../Controllers/DashboardController.php');
    update_notification($name, $amount, $product_name, $tid, $card, $currentDate);

    // $status = update_payment( $_SESSION['paynow']);

    // if($status){
    //     header('Location: myProfile.php');
    // }





}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <!-- <script>
        // Now we can use phpData in JavaScript
        console.log(phpData); // Prints the data to the console
       
    </script> -->

    <script src="Template.js"></script>
</body>

</html>