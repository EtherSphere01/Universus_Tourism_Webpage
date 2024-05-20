<?php
include_once('../Models/alldb.php');

function applyCoupon($coupon){
    $valid = checkCoupon($coupon);
    if ($valid) {
        // Assuming you have a function to fetch the coupon amount from the database
        $couponAmount = checkCoupon($coupon);
        return $couponAmount;
    } else {
        return false; // Coupon is not valid
    }

}
?>