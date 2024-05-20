<?php

require_once('../../Naimur/Models/allDB.php');


function update_coupon_table($coupon,$date){
    $r= update_coupon_request($coupon,$date);
}

?>