<script>

    let phpData = "";


</script>


<?php
session_start();
require_once('../Controllers/invoiceController.php');
    require('config.php');

if(isset($_POST['stripeToken'])){

    \Stripe\Stripe::setVerifySslCerts(false);
    $token  = $_POST['stripeToken'];
    
    $data = \Stripe\Charge::create(array(
        'amount' => $_SESSION['amount']*100,
        'currency' => 'bdt',
        'description' => $_SESSION['paynow'],
        'source' => $token,
    ));
    
    $amount = ($data->amount)/100;
    $product_name =  $data->description;
    $tid =  $data->balance_transaction;
    $card =  $data->source->brand;
    $name = $_SESSION['name'];
    $currentDate = date('Y-m-d');

    // Output the JSON data to a JavaScript variable
    // echo "<script> phpData = $jsonData;</script>";

    require_once('../../Naimur/Controllers/DashboardController.php');
    update_notification($name, $amount, $product_name, $tid, $card, $currentDate);
    

    $country = $_SESSION['country'];
    update_revenue_table($amount,$country);


    $status = update_payment( $_SESSION['paynow']);

    if($status){
        header('Location: myProfile.php');
    }

    



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

<script src = "test.js"></script>
</body>
</html>
