<?php
    require_once ('db.php');

    function addUser($name,$email,$role,$address,$password,$dob,$gender,$country,$passno,$nid,$pin){

        $con = conn();
        $sql = "INSERT INTO userinfo (name, email, password, dob, gender, country, address, role, passport, nid, pin) 
        VALUES ('$name', '$email', '$password', '$dob', '$gender', '$country', '$address', '$role', '$passno', '$nid', '$pin')";
        $res = mysqli_query($con,$sql);
        return $res;
    }
    


    function loginAuth($email,$password){
        $con = conn();
        $sql = "SELECT * FROM userinfo WHERE email='$email' AND password='$password'";
        $res = mysqli_query($con,$sql);
        $row = mysqli_num_rows($res);

        if($row==1) return $res;
        else return false;
    }


    function getActivities() {
        $con = conn();
        $sql = "SELECT * FROM service WHERE catagory = 'tour'"; 
        $result = mysqli_query($con, $sql);
        return $result; 
    }


    function getFlight(){
        $con = conn();
        $sql = "SELECT * FROM flightservice";
        $resultFlight = mysqli_query($con,$sql);
        return $resultFlight;
    }

    function getHotel(){
        $con = conn();
        $sql = "SELECT * FROM service WHERE catagory = 'hotel'";
        $resultHotel = mysqli_query($con,$sql);
        return $resultHotel;
    }


    function getTour($destination){
        $con = conn();
        $sql = "SELECT * FROM service WHERE catagory = 'tour' AND destination = '$destination'"; 
        $result = mysqli_query($con, $sql);
        return $result; 
    }

    function getFlightSearch($destination, $deprature){
        $con = conn();
        $sql = "SELECT * FROM flightservice WHERE deprature = '$deprature' AND destination = '$destination'";
        $result = mysqli_query($con, $sql);
        return $result;
    }


    function getHotelSearch($location){
        $con = conn();
        $sql = "SELECT * FROM service WHERE catagory = 'hotel' AND destination = '$location'";
        $result = mysqli_query($con, $sql);
        return $result;
    }

    function getDetailsProduct($name){
        $con = conn();
        $sql = "SELECT * FROM service WHERE name ='$name'"; 
        $result = mysqli_query($con, $sql);
        if (!$result) {
            echo "Error: " . mysqli_error($con);
        }
        return $result; 
    }
    
    function getFlightDetailsProduct($name){
        $con = conn();
        $sql = "SELECT * FROM flightservice WHERE name ='$name'"; 
        $result = mysqli_query($con, $sql);
        if (!$result) {
            // Query failed, log or handle the error
            echo "Error: " . mysqli_error($con);
        }
        return $result; 
    }

    function getHotelDetailsProduct($name){
        $con = conn();
        $sql = "SELECT * FROM service WHERE name ='$name'"; 
        $result = mysqli_query($con, $sql);
        if (!$result) {
            echo "Error: " . mysqli_error($con);
        }
        return $result; 
    }

    function addToCart($email, $productName, $productPrice,$productImage){
        $con = conn();
        $sql = "INSERT INTO cart (email, name, price,imgsource) VALUES ('$email', '$productName', '$productPrice','$productImage')";
        $result = mysqli_query($con, $sql);
    
        if ($result) {
            return true; // Success
        } else {
            return false;
        }
    }

    function getCart($email){
        $con = conn();
        $sql = "SELECT * FROM cart WHERE email = '$email'";
        $result = mysqli_query($con, $sql);
        return $result;
    }

    function removeCart($productId){
        $con = conn();
        $sql = "DELETE FROM cart WHERE cartID = '$productId'";
        $result = mysqli_query($con, $sql);
        return $result;
    }


    function getCartRes($email){
        $con = conn();
        $sql = "SELECT * FROM cart WHERE email = '$email'";
        $result = mysqli_query($con, $sql);
        return $result;
    }


    function checkCoupon($coupon){
        $con = conn();
        $coupon = mysqli_real_escape_string($con, $coupon);
        $sql = "SELECT amount FROM coupon WHERE couponName = '$coupon'";
        $result = mysqli_query($con, $sql);
        if($result && mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);
            return $row['amount']; // Return the coupon amount
        } else {
            return 0; // Return 0 if coupon not found or query fails
        }
    }


    function order($custName, $custEmail, $custPhone, $custAddress, $productName, $orderTotal,$quantity){
        $con = conn();
        $sql = "INSERT INTO orderdetails (status, name, email, phone, address, productname,amount,pstatus,quantity) 
        VALUES ('Pending','$custName', '$custEmail', '$custPhone', '$custAddress', '$productName','$orderTotal','Pending',$quantity)";
        $result = mysqli_query($con, $sql);
        return $result;
    }

    function getHistory($email){
        $con = conn();
        $sql = "SELECT * FROM orderdetails WHERE email = '$email'";
        $result = mysqli_query($con, $sql);
        return $result;
    }


    function getInvoice($orderID){
        $con = conn();
        $sql = "SELECT * FROM orderdetails WHERE orderid = '$orderID'";
        $result = mysqli_query($con, $sql);
        return $result;
    }

    function cancelOrderModel($id){
        $con = conn();
        $sql = "UPDATE orderdetails SET status = 'Cancelled' WHERE orderid = '$id'";
        $result = mysqli_query($con, $sql);
        return $result;
    }

    function changePasswordModel($email, $pin_no, $old_pass, $new_pass){
        $con = conn();
        $sql = "SELECT * FROM userinfo WHERE email = '$email' AND pin = '$pin_no' AND password = '$old_pass'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_num_rows($result);

        if($row==1){
            $sql = "UPDATE userinfo SET password = '$new_pass' WHERE email = '$email'";
            $result = mysqli_query($con, $sql);
            return $result;
        } else {
            return false;
        }
    }

    function reviewSubmitModel($invoice_id, $product_name,$name, $comment, $rate){
        $con = conn();
        $sql = "INSERT INTO userreview (orderid, productname,name,comment, rate) VALUES ('$invoice_id', '$product_name', '$name', '$comment', '$rate')";
        $result = mysqli_query($con, $sql);
        return $result;
    }


    function get_order_details($id){
        $con = conn();
        $sql = "SELECT * FROM orderdetails WHERE orderid = '$id'";
        $result = mysqli_query($con, $sql);
        return $result->fetch_assoc();
    }

    function update_payment_status($id){
        $con = conn();
        $sql = "UPDATE orderdetails SET pstatus = 'Paid' WHERE orderid = '$id'";
        $result = mysqli_query($con, $sql);
        return $result;
    }


    function updateReviewStatusModel($invoice_id){
        $con = conn();
        $sql = "UPDATE orderdetails SET reviewstatus = 'Yes' WHERE orderid = '$invoice_id'";
        $result = mysqli_query($con, $sql);
        return $result;
    }


    // tanvir review table
    function get_information($email){
        $con = conn();
        $sql = "SELECT * FROM userinfo WHERE email = '$email'";
        $result = mysqli_query($con, $sql);
        return $result;
    }

    function update_information($email, $tempimg){

        require_once('../../Naimur/Controllers/TravelersController.php');
        require_once('../../Naimur/Controllers/DashboardController.php');
        update_profile_picture($email, $tempimg);
        update_rating_profile_picture($email, $tempimg);
        $con = conn();
        $sql = "UPDATE userinfo SET image = '$tempimg' WHERE email = '$email'";
        $result = mysqli_query($con, $sql);
        return $result;
    }





    // naimur order history update
    function takehistory()
{
    $con = conn();
    $sql =
        "SELECT * FROM orderdetails 
        ORDER BY 
  CASE 
    WHEN pstatus = 'Paid' AND status = 'Pending' THEN 0
    WHEN pstatus = 'Paid' AND status = 'Completed' THEN 1 
    WHEN status = 'Pending' THEN 2
    ELSE 3 
  END;";

    $result = $con->query($sql);
    $con->close();
    return $result;
}

function update_complete($id)
{
    $con = conn();
    $sql = "UPDATE orderdetails SET status = 'Completed' WHERE orderid = '$id'";
    $result = $con->query($sql);
    $con->close();
    return $result;
}

function update_paid($id)
{
    $con = conn();
    $sql = "UPDATE orderdetails SET pstatus = 'Paid' WHERE orderid = '$id'";
    $result = $con->query($sql);
    $con->close();
    return $result;
}

function update_cancle($id)
{
    $con = conn();
    $sql = "UPDATE orderdetails SET status = 'Canceled' WHERE orderid = '$id'";
    $result = $con->query($sql);
    $con->close();
    return $result;
}


// tour page database

function get_resultActivity()
{
    $con = conn();
    $sql = "SELECT * FROM service where catagory = 'tour'";
    $result = $con->query($sql);
    $con->close();
    return $result;
}

function get_detailsRequest($value)
{
    $con = conn();
    $sql = "SELECT * FROM service where name = '$value'";
    $result = $con->query($sql);
    $con->close();
    $result = $result->fetch_assoc();
    return $result;
}


function update_tours($name, $price, $location, $image, $details, $stock)
{
    $con = conn();
    $sql = "UPDATE service SET price=?, destination=?, imgsource=?, details=?, stock=? WHERE name=?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("dsssis", $price, $location, $image, $details, $stock, $name);
    $stmt->execute();
    $stmt->close();
    $con->close();
    return true;
}




?>