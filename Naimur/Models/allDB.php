<!-- Tourist Database -->
<?php

require_once('../../Naimur/Models/Database.php');

function table_element()
{
    $conn = con();
    $sql = "SELECT * FROM travelers";
    $result = $conn->query($sql);
    $conn->close();
    return $result;
}

function edit_info($username)
{
    $conn = con();
    $sql = "SELECT * FROM travelers WHERE username = '$username'";
    $res = $conn->query($sql);
    $edit_result = $res->fetch_assoc();
    $conn->close();
    return $edit_result;
}

function send_update_request($username, $name, $location, $phone, $image)
{
    $conn = con();
    $sql = "UPDATE travelers SET name = '$name', location = '$location', phone = '$phone', image = '$image' WHERE username = '$username'";
    $r = $conn->query($sql);
    $conn->close();
    return $r;
}

function send_delete_request($username)
{
    $conn = con();
    $sql = "DELETE FROM travelers WHERE username = '$username'";
    $r = $conn->query($sql);
    $conn->close();
}

function send_username($username)
{
    $conn = con();
    $sql = "SELECT * FROM travelers WHERE username = '$username'";
    $result = $conn->query($sql);
    $conn->close();
    return $result;
}

function send_add_request($username, $name, $location, $phone, $image)
{
    $currentDate = date('Y-m-d');
    $conn = con();
    $sql = "INSERT INTO travelers (username,password,name,location,phone,image,joiningdate) VALUES ('$username','$username','$name','$location','$phone','$image','$currentDate')";
    $r = $conn->query($sql);
    $conn->close();
    return $r;
}
?>


<!-- Tour Guide Database -->

<?php

require_once('../../Naimur/Models/Database.php');

function table_element_tourguide()
{
    $conn = con();
    $sql = "SELECT * FROM tourguide";
    $result = $conn->query($sql);
    $conn->close();
    return $result;
}

function edit_info_tourguide($username)
{
    $conn = con();
    $sql = "SELECT * FROM tourguide WHERE username = '$username'";
    $res = $conn->query($sql);
    $edit_result = $res->fetch_assoc();
    $conn->close();
    return $edit_result;
}

function send_update_request_tourguide($username, $name, $location, $phone, $image, $salary)
{
    $conn = con();
    $sql = "UPDATE tourguide SET name = '$name', location = '$location', phone = '$phone', image = '$image', salary = '$salary' WHERE username = '$username'";
    $r = $conn->query($sql);
    $conn->close();
    return $r;
}

function send_delete_request_tourguide($username)
{
    $conn = con();
    $sql = "DELETE FROM tourguide WHERE username = '$username'";
    $r = $conn->query($sql);
    $conn->close();
    return $r;
}

function send_username_tourguide($username)
{
    $conn = con();
    $sql = "SELECT * FROM tourguide WHERE username = '$username'";
    $result = $conn->query($sql);
    $conn->close();
    return $result;
}

function send_add_request_tourguide($username, $name, $location, $phone, $image, $salary)
{
    $currentDate = date('Y-m-d');
    $conn = con();
    $sql = "INSERT INTO tourguide (username,password,name,location,phone,image,joiningdate,salary) VALUES ('$username','$username','$name','$location','$phone','$image','$currentDate','$salary')";
    $r = $conn->query($sql);
    $conn->close();
    return $r;
}
?>

<!-- Dashboard Database -->

<?php
require_once('Database.php');
function send_request_review()
{
    $conn = con();
    $sql = "SELECT * FROM ratings";
    $review_result = $conn->query($sql);
    $conn->close();
    return $review_result;
}

function send_request_totaluser()
{
    $conn = con();
    $sql = "SELECT * FROM travelers";
    $result = $conn->query($sql);
    $conn->close();
    return $result->num_rows;
}

function send_request_totalactivetrip()
{
    $conn = con();
    $sql = "SELECT * FROM activetrips";
    $result = $conn->query($sql);
    $conn->close();
    return $result->num_rows;
}

function send_request_booking()
{
    $conn = con();
    $sql = "SELECT * FROM revenuetable";
    $result = $conn->query($sql);
    $conn->close();
    $total = 0;
    while ($row = $result->fetch_assoc()) {
        $total += $row['transactions'];
    }
    return $total;
}

function send_request_totalearning()
{
    $conn = con();
    $sql = "SELECT * FROM revenuetable";
    $result = $conn->query($sql);
    $total = 0;
    while ($row = $result->fetch_assoc()) {
        $total += $row['revenue'];
    }
    $conn->close();
    return $total;
}

function send_request_discount()
{
    $conn = con();
    $sql = "SELECT * FROM `discounts` ORDER BY `date` DESC LIMIT 7";
    $result = $conn->query($sql);
    $conn->close();
    return $result;
}

function send_request_country_revenue()
{
    $conn = con();
    $sql = "SELECT * FROM `revenuetable` ORDER BY `revenue` DESC LIMIT 5";
    $result = $conn->query($sql);
    $conn->close();
    return $result;
}
function send_request_total_country()
{
    $conn = con();
    $sql = "SELECT * FROM `revenuetable`";
    $result = $conn->query($sql);
    $conn->close();
    return $result->num_rows;
}


function send_request_update_revenue_table($amount,$country){
    $conn = con();
    $sql = "SELECT * FROM `revenuetable` WHERE country = '$country'";
    $result = $conn->query($sql);
    $total = $amount;
   $result =  $result->fetch_assoc();
    $total += $result['revenue'];
    

    $transactions =$result['transactions']+1;
   $sql = "UPDATE revenuetable SET revenue = '$total', transactions = '$transactions' WHERE country = '$country'";
    $conn->query($sql);
    $conn->close();

}




?>

<!-- report database -->

<?php

function get_totalplan()
{
    $conn = con();
    $sql = "SELECT * FROM `totalplans`";
    $result = $conn->query($sql);
    $conn->close();
    return $result->num_rows;
}

function get_hotels()
{
    $conn = con();
    $sql = "SELECT * FROM `hotels`";
    $result = $conn->query($sql);
    $conn->close();
    return $result->num_rows;
}

function send_request_earning()
{
    $conn = con();
    $sql = "SELECT * FROM `earnings`";
    $result = $conn->query($sql);
    $conn->close();
    return $result;
}

function send_request_expense()
{
    $conn = con();
    $sql = "SELECT * FROM `expenses`";
    $result = $conn->query($sql);
    $conn->close();
    return $result;
}

function send_CountryArray()
{
    $conn = con();
    $sql = "SELECT * FROM `revenuetable`";
    $result = $conn->query($sql);
    $conn->close();
    return $result;
}



// settings database

function send_request_db($username)
{
    $conn = con();
    $sql = "SELECT * FROM admin WHERE username = '$username'";
    $result = $conn->query($sql);
    $result = $result->fetch_assoc();
    $conn->close();
    return $result;
}

function update_request_db($username, $name, $email, $location, $phone, $gender, $facebook, $github, $linkedin, $image, $password)
{
    $conn = con();
    $sql = "UPDATE admin SET name = '$name', email = '$email', location = '$location', phone = '$phone', gender = '$gender', facebook = '$facebook', github = '$github', linkedin = '$linkedin', image = '$image', password = '$password' WHERE username = '$username'";
    $result = $conn->query($sql);
    $conn->close();
    return $result;
}




// tours database


// function get_resultActivity()
// {
//     $conn = con();
//     $sql = "SELECT * FROM service where catagory = 'tour'";
//     $result = $conn->query($sql);
//     $conn->close();
//     return $result;
// }

// function get_detailsRequest($value)
// {
//     $conn = con();
//     $sql = "SELECT * FROM service where name = '$value'";
//     $result = $conn->query($sql);
//     $conn->close();
//     $result = $result->fetch_assoc();
//     return $result;
// }



// function update_tours($name, $price, $location, $image, $details, $stock)
// {
//     $conn = con();
//     $sql = "UPDATE service SET price=?, destination=?, imgsource=?, details=?, stock=? WHERE name=?";
//     $stmt = $conn->prepare($sql);
//     $stmt->bind_param("dsssis", $price, $location, $image, $details, $stock, $name);
//     $stmt->execute();
//     $stmt->close();
//     $conn->close();
//     return true;
// }



// hotels database

function update_hotels($name, $price, $location, $image, $details, $stock)
{
    $conn = con();
    $sql = "UPDATE service SET price=?, destination=?, imgsource=?, details=?, stock=? WHERE name=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("dsssis", $price, $location, $image, $details, $stock, $name);
    $stmt->execute();
    $stmt->close();
    $conn->close();
    return true;
}


function get_resultActivity2()
{
    $conn = con();
    $sql = "SELECT * FROM service where catagory = 'hotel'";
    $result = $conn->query($sql);
    $conn->close();
    return $result;
}

function get_detailsRequest2($value)
{
    $conn = con();
    $sql = "SELECT * FROM service where name = '$value'";
    $result = $conn->query($sql);
    $conn->close();
    $result = $result->fetch_assoc();
    return $result;
}


?>

<!-- notification -->
<?php

function send_updaterequest_notification($name, $amount, $product_name, $tid, $card, $currentDate)
{
    $conn = con();
    $sql = "INSERT INTO notification (name, amount, orderid, transaction, network, date) VALUES ('$name', '$amount', '$product_name', '$tid', '$card', '$currentDate')";
    $result = $conn->query($sql);
    $conn->close();
    return $result;
}

function send_request_new_notification()
{
    $conn = con();
    $sql = "SELECT * FROM notification";
    $result = $conn->query($sql);
    $conn->close();
    return $result->num_rows;
}

function send_request_prev_notification()
{
    $conn = con();
    $sql = "SELECT * FROM previousnotification where id = 1";
    $result = $conn->query($sql);
    $result = $result->fetch_assoc();
    $conn->close();
    return $result['totalnotification'];
}


function update_previous_notification($number)
{
    // session_start();
    $conn = con();
    $notification = $number;
    $sql = "UPDATE previousnotification SET totalnotification = '$notification' WHERE id = 1";
    $conn->query($sql);
    // $conn->close();
}

function get_notification_data()
{
    $conn = con();
    $sql = "SELECT * FROM notification ORDER BY date DESC";
    $result = $conn->query($sql);
    $conn->close();
    return $result;
}





// admin database
    function  send_admin_add_request($username,$name,$email,$location,$phone,$gender,$password,$image,$facebook,$github,$linkedin){
        $conn = con();
        $sql = "INSERT INTO admin (username,name,email,location,phone,gender,password,image,facebook,github,linkedin) VALUES ('$username','$name','$email','$location','$phone','$gender','$password','$image','$facebook','$github','$linkedin')";
        $result = $conn->query($sql);
        $conn->close();
        return $result;
    }







    // coupon

    function update_coupon_request($coupon,$date){
        if($coupon =='NEWUSER'){
            $coupon = 'specialDiscount';
        }
        $conn = con();
        $sql = "select * from discounts where date = '$date'";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            $total=0;
           $r = $result->fetch_assoc();
              $total = $r[$coupon]+1;

            $sql = "UPDATE discounts SET $coupon = '$total' WHERE date = '$date'";
            $res = $conn->query($sql);
        }else{
            $specialDiscount=0;
            $fixedCard=0;
            $fixedCoupon=0;

            if($coupon == 'specialDiscount'){
                $specialDiscount = 1;
            }else if($coupon == 'fixedCard'){
                $fixedCard = 1;
            }else{
                $fixedCoupon = 1;
            }
            $sql = "INSERT INTO discounts (specialDiscount,fixedCard,fixedCoupon,date) VALUES ('$specialDiscount','$fixedCard','$fixedCoupon','$date')";
            $res = $conn->query($sql);
        }
        $conn->close();
        return $res;
    }


    // update review

    function updatenaimurreviewtable($invoice_id, $product_name,$name, $comment, $rate,$email,$image){
        $conn = con();
        $date = date('Y-m-d');
        $sql = "INSERT INTO ratings (username,name,time,comment,rating,email,image) VALUES ('$invoice_id', '$name', '$date','$comment', '$rate','$email','$image')";
        $result = $conn->query($sql);
        $conn->close();
        return $result;
    }

    function update_in_alldb($email, $tempimg){
        $conn = con();
        $sql = "UPDATE travelers SET image = '$tempimg' WHERE username = '$email'";
        $result = mysqli_query($conn, $sql);
        return $result;
    }


   function send_request_update_rating_profile_picture($email, $tempimg){
        $conn = con();
        $sql = "select * from ratings where email = '$email'";
        $result = mysqli_query($conn, $sql);
        if($result->num_rows > 0){
        while($row = mysqli_fetch_assoc($result)){
            $email2 = $row['username'];
            $sql = "UPDATE ratings SET image = '$tempimg' WHERE username = $email2";
            mysqli_query($conn, $sql);
        }
    }
    $conn->close();

    }

    function getimagefromtableModel($email){
        $conn = con();
        $sql = "SELECT * FROM travelers WHERE username = '$email'";
        $result = $conn->query($sql);
        $result = $result->fetch_assoc();
        $conn->close();
        return $result;
    }

    


?>