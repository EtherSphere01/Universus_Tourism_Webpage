<?php
require_once("../../Naimur/Models/allDB.php");
function getReviews()
{
    $review_result = send_request_review();
    return $review_result;
}

function getDetailsDashboard()
{
    $array = array();
    $array['totaluser'] = send_request_totaluser();
    $array['totalactivetrip'] = send_request_totalactivetrip();
    $array['totalbooking'] = send_request_booking();
    $array['totalearning'] = send_request_totalearning();
    return $array;
}

// pie chart db connection
function get_discount()
{
    $result = send_request_discount();
    return $result;
}

// country revenue db connection
function getCountryRevenue()
{
    $result = send_request_country_revenue();
    return $result;
}

function getTotalCountry()
{
    $result = send_request_total_country();
    return $result;
}

function update_notification($name, $amount, $product_name, $tid, $card, $currentDate)
{
    send_updaterequest_notification($name, $amount, $product_name, $tid, $card, $currentDate);
}


?>


<!-- notification -->

<?php

function get_new_notification()
{
    $result = send_request_new_notification();
    return $result;
}

function
get_prev_notification()
{
    $result = send_request_prev_notification();
    return $result;
}

function request_updateprevious_notification($number)
{
    update_previous_notification($number);
}

function update_revenue_table($amount,$country){
    send_request_update_revenue_table($amount,$country);
}


// tavir review table

function get_review2()
{
    $result = send_request_review();
    return $result;
}


function update_rating_profile_picture($email, $tempimg){
    send_request_update_rating_profile_picture($email, $tempimg);
}


?>