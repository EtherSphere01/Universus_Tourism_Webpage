<?php
require_once ('../Controllers/invoiceController.php');
require_once 'C:\xampp\htdocs\Tourist Page\Views\TCPDF\tcpdf.php'; // Include TCPDF library

require 'C:\xampp\htdocs\Tourist Page\Views\PHPMailer\src\PHPMailer.php'; // Include PHPMailer library
require 'C:\xampp\htdocs\Tourist Page\Views\PHPMailer\src\SMTP.php'; // Include PHPMailer library

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

function getInvoiceDetails(){
    $r = invoiceRequestToDB();
    return $r;
}

if(isset($_POST['email'])){
    $email = $_POST['email'];
    $r = getInvoiceDetails();
    while ($row = mysqli_fetch_assoc($r)) {
        $orderid = $row['orderid'];
        $name = $row['name'];
        $address = $row['address'];
        $email = $row['email'];
        $phone = $row['phone'];
        $productname = $row['productname'];
        $amount = $row['amount'];
    }

    // Generate PDF
    $pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $pdf->SetCreator(PDF_CREATOR);  
    $pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
    $pdf->SetDefaultMonospacedFont('helvetica');  
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
    $pdf->SetMargins(PDF_MARGIN_LEFT, '5', PDF_MARGIN_RIGHT);  
    $pdf->setPrintHeader(false);  
    $pdf->setPrintFooter(false);  
    $pdf->SetAutoPageBreak(TRUE, 10);  
    $pdf->SetFont('helvetica', '', 12);  
    $pdf->AddPage(); //default A4
// Define form field attributes
$fieldWidth = 100;
$fieldHeight = ['height' => 10]; // Height should be passed as an array
$fieldX = 50;
$fieldY = 50;
$fieldName = 'email'; // Set the name of the form field
$actionPath = ''; // Set the action attribute path to an empty string

// Create a text field with the empty action attribute path
$pdf->TextField($fieldX, $fieldY, $fieldWidth, $fieldHeight, ['name' => $fieldName, 'action' => $actionPath]);


    // Write PDF content
    $pdf->writeHTML("<!DOCTYPE html>
<html lang='en'>
<head>
<meta charset='utf-8'>
<title>invoice card - Bootdey.com</title>
<meta name='viewport' content='width=device-width, initial-scale=1'>
<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css' rel='stylesheet'>
<style type='text/css'>
body{margin-top:20px;background-color:#eee;}
.card {box-shadow: 0 20px 27px 0 rgb(0 0 0 / 5%);}
.card {position: relative;display: flex;flex-direction: column;min-width: 0;word-wrap: break-word;background-color: #fff;background-clip: border-box;border: 0 solid rgba(0,0,0,.125);border-radius: 1rem;}
.inv-logo {height: 100px;width: 100px;margin-left : 10px;align-items: right;}
.__cf_email__{text-decoration: none;color: inherit;}
.add{margin-left: 5.5px;}
.email-btn{margin-left: 5px;}
</style>
</head>
<body>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css' integrity='sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=' crossorigin='anonymous' />
<div class='container'>
<div class='row'>
<div class='col-lg-12'>
<div class='card'>
<div class='card-body'>
<div class='invoice-title'>
<img src='logo.png'  class = 'inv-logo' alt=''>
<div class='mb-4'>
<h2 class='mb-1 text-muted'>universus.com</h2>
</div>
<div class='text-muted'>
<p class='mb-1 add'>Kuratoli,Dhaka</p>
<p class='mb-1'><i class='uil uil-envelope-alt me-1'></i> <a href='/cdn-cgi/l/email-protection' class='__cf_email__' data-cfemail='324a4b48720b0a051c515d5f'>universuswebtech@gmail.com</a></p>
<p><i class='uil uil-phone me-1'></i> 02-841-4046-9</p>
</div>
</div>
<hr class='my-4'>
<div class='row'>
<div class='col-sm-6'>
<div class='text-muted'>
<h5 class='font-size-16 mb-3'>Billed To:</h5>
<h5 class='font-size-15 mb-2'>$name</h5>
<p class='mb-1'>$address</p>
<p class='mb-1'><a href='/cdn-cgi/l/email-protection' class='__cf_email__' data-cfemail='5a0a283f292e3534173336363f281a3b283723292a2374393537'>$email</a></p>
<p>$phone</p>
</div>
</div>
<div class='text-muted text-sm-end'>
<div class='mt-4'>
<h5 class='font-size-15 mb-1'>Order No:</h5>
<p>$orderid</p>
</div>
</div>
</div>
<div class='py-2'>
<h5 class='font-size-15'>Order Summary</h5>
<div class='table-responsive'>
<table class='table align-middle table-nowrap table-centered mb-0'>
<thead>
<tr>
<th style='width: 70px;'>No.</th>
<th>Item</th>
<th>Price</th>
<th>Quantity</th>
<th class='text-end' style='width: 120px;'>Total</th>
</tr>
</thead>
<tbody>
<tr>
<th scope='row'>01</th>
<td>
<div>
<h5 class='text-truncate font-size-14 mb-1'>$productname</h5>
</div>
</td>
<td>$$amount</td>
<td>1</td>
<td class='text-end'>$$amount</td>
</tr>
<tr>
<th scope='row' colspan='4' class='border-0 text-end'>Total</th>
<td class='border-0 text-end'><h4 class='m-0 fw-semibold'>$$amount</h4></td>
</tr>
</tbody>
</table>
</div>
</div>
<script data-cfasync='false' src='/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js'></script>
<script src='https://code.jquery.com/jquery-1.10.2.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js'></script>
<script type='text/javascript'></script>
</body>
</html>");

    // Save PDF to a temporary file
    $tempFileName = tempnam(sys_get_temp_dir(), 'invoice');
    $pdf->Output($tempFileName, 'F');

    // Create a PHPMailer instance
    $mail = new PHPMailer;

    // Set PHPMailer to use SMTP
    $mail->isSMTP();

    // Specify SMTP settings
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'universuswebtech@gmail.com';
    $mail->Password = 'wdvk ozxb asux jpib';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    // Set email parameters
    $mail->setFrom('universuswebtech@gmail.com', 'Universus');
    $mail->addAddress($email);
    $mail->addAttachment($tempFileName, 'invoice.pdf'); // Add PDF attachment
    $mail->Subject = 'Invoice';
    $mail->isHTML(true);

    // Set HTML content
    $html = "<!DOCTYPE html>
    <html lang='en'>
    <head>
    <meta charset='utf-8'>
    <title>invoice card - Bootdey.com</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css' rel='stylesheet'>
    <style type='text/css'>
    body{margin-top:20px;background-color:#eee;}
    .card {box-shadow: 0 20px 27px 0 rgb(0 0 0 / 5%);}
    .card {position: relative;display: flex;flex-direction: column;min-width: 0;word-wrap: break-word;background-color: #fff;background-clip: border-box;border: 0 solid rgba(0,0,0,.125);border-radius: 1rem;}
    .inv-logo {height: 100px;width: 100px;margin-left : 10px;align-items: right;}
    .__cf_email__{text-decoration: none;color: inherit;}
    .add{margin-left: 5.5px;}
    .email-btn{margin-left: 5px;}
    </style>
    </head>
    <body>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css' integrity='sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=' crossorigin='anonymous' />
    <div class='container'>
    <div class='row'>
    <div class='col-lg-12'>
    <div class='card'>
    <div class='card-body'>
    <div class='invoice-title'>
    <img src='logo.png'  class = 'inv-logo' alt=''>
    <div class='mb-4'>
    <h2 class='mb-1 text-muted'>universus.com</h2>
    </div>
    <div class='text-muted'>
    <p class='mb-1 add'>Kuratoli,Dhaka</p>
    <p class='mb-1'><i class='uil uil-envelope-alt me-1'></i> <a href='/cdn-cgi/l/email-protection' class='__cf_email__' data-cfemail='324a4b48720b0a051c515d5f'>universuswebtech@gmail.com</a></p>
    <p><i class='uil uil-phone me-1'></i> 02-841-4046-9</p>
    </div>
    </div>
    <hr class='my-4'>
    <div class='row'>
    <div class='col-sm-6'>
    <div class='text-muted'>
    <h5 class='font-size-16 mb-3'>Billed To:</h5>
    <h5 class='font-size-15 mb-2'>$name</h5>
    <p class='mb-1'>$address</p>
    <p class='mb-1'><a href='/cdn-cgi/l/email-protection' class='__cf_email__' data-cfemail='5a0a283f292e3534173336363f281a3b283723292a2374393537'>$email</a></p>
    <p>$phone</p>
    </div>
    </div>
    <div class='text-muted text-sm-end'>
    <div class='mt-4'>
    <h5 class='font-size-15 mb-1'>Order No:</h5>
    <p>$orderid</p>
    </div>
    </div>
    </div>
    <div class='py-2'>
    <h5 class='font-size-15'>Order Summary</h5>
    <div class='table-responsive'>
    <table class='table align-middle table-nowrap table-centered mb-0'>
    <thead>
    <tr>
    <th style='width: 70px;'>No.</th>
    <th>Item</th>
    <th>Price</th>
    <th>Quantity</th>
    <th class='text-end' style='width: 120px;'>Total</th>
    </tr>
    </thead>
    <tbody>
    <tr>
    <th scope='row'>01</th>
    <td>
    <div>
    <h5 class='text-truncate font-size-14 mb-1'>$productname</h5>
    </div>
    </td>
    <td>$$amount</td>
    <td>1</td>
    <td class='text-end'>$$amount</td>
    </tr>
    <tr>
    <th scope='row' colspan='4' class='border-0 text-end'>Total</th>
    <td class='border-0 text-end'><h4 class='m-0 fw-semibold'>$$amount</h4></td>
    </tr>
    </tbody>
    </table>
    </div>
    </div>
    <script data-cfasync='false' src='/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js'></script>
    <script src='https://code.jquery.com/jquery-1.10.2.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js'></script>
    <script type='text/javascript'></script>
    </body>
    </html>";

    $mail->Body = $html; // Set HTML body content

    // Send email
    if(!$mail->send()) {
        echo '<script>alert("Email could not be sent.")</script>';
    } else {
        echo '<script>alert("Email sent successfully.")</script>';
    }

    // Delete temporary file
    unlink($tempFileName);
}
?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
    <meta charset="utf-8">
    <title>Invoice</title>
    <link rel="icon" type="image/x-icon" href="favicon.ico">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
        body{margin-top:20px;
    background-color:#eee;
    }

    .card {
        box-shadow: 0 20px 27px 0 rgb(0 0 0 / 5%);
    }
    .card {
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 0 solid rgba(0,0,0,.125);
        border-radius: 1rem;
    }

    .inv-logo {
        height: 100px;
        width: 100px;
        margin-left : 10px;
        align-items: right;
    }
    .__cf_email__{
        text-decoration: none;
        color: inherit;
    }
    .add{
        
        margin-left: 5.5px;
    }

    .email-btn{
        margin-left: 5px;
    }
    .btn,
     .btn-success, 
     .me-1, 
     .inv-btn{
        background-color: #365486;
    }


.inv-btn:hover {
    background-color: #7fc7d9;
}

        </style>
    </head>
    <body>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous" />
    <div class="container">
    <div class="row">
    <div class="col-lg-12">
    <div class="card">
    <div class="card-body">
    <div class="invoice-title">
        <img src="logo.png"  class = "inv-logo" alt="">
    <div class="mb-4">
    <h2 class="mb-1 text-muted">universus.com</h2>
    </div>
    <div class="text-muted">
    <p class="mb-1 add">Kuratoli,Dhaka</p>
    <p class="mb-1"><i class="uil uil-envelope-alt me-1"></i> <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="324a4b48720b0a051c515d5f">universuswebtech@gmail.com</a></p>
    <p><i class="uil uil-phone me-1"></i> 02-841-4046-9</p>
    </div>
    </div>
    <hr class="my-4">
    <div class="row">
    <div class="col-sm-6">
    <div class="text-muted">
        <?php
        $r = getInvoiceDetails();
        while ($row = mysqli_fetch_assoc($r)) {
            ?>
            <h5 class="font-size-16 mb-3">Billed To:</h5>
            <h5 class="font-size-15 mb-2"><?php echo $row['name']; ?></h5>
            <p class="mb-1"><?php echo $row['address']; ?></p>
            <p class="mb-1"><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="5a0a283f292e3534173336363f281a3b283723292a2374393537"><?php echo $row['email']; ?></a></p>
            <p><?php echo $row['phone']; ?></p>
        </div>
    </div>

    <div class="text-muted text-sm-end">
        <div class="mt-4">
            <h5 class="font-size-15 mb-1">Order No:</h5>
            <p><?php echo $row['orderid']; ?></p>
        </div>
    </div>
    </div>

    <div class="py-2">
        <h5 class="font-size-15">Order Summary</h5>
        <div class="table-responsive">
            <table class="table align-middle table-nowrap table-centered mb-0">
                <thead>
                <tr>
                    <th style="width: 70px;">No.</th>
                    <th>Item</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th class="text-end" style="width: 120px;">Total</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">01</th>
                    <td>
                        <div>
                            <h5 class="text-truncate font-size-14 mb-1"><?php echo $row['productname']; ?></h5>
                        </div>
                    </td>
                    <td>$<?php echo $row['amount']; ?></td>
                    <td>1</td>
                    <td class="text-end">$<?php echo $row['amount']; ?></td>
                </tr>
                <tr>
                    <th scope="row" colspan="4" class="border-0 text-end">Total</th>
                    <td class="border-0 text-end"><h4 class="m-0 fw-semibold">$<?php echo $row['amount']; ?></h4></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <?php
    }
    ?>
    <div class="d-print-none mt-4">
        <div class="float-end">
            <a href="javascript:window.print()" class="btn btn-success me-1 inv-btn"><i class="fa fa-print"></i> Print</a>
            <form  method="POST" class="d-inline">
        <button class="btn btn-success me-1 inv-btn" type="submit" name="email" value="<?php echo $row['email']; ?>">Email Invoice</button>
    </form>
        </div>
    </div>


    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">
        
    </script>
    </body>
    </html>
