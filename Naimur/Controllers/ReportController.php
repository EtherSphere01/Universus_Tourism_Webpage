<?php 
require_once("../Models/allDB.php");
require_once("DashboardController.php");
require_once("TourGuideController.php");

function send_request_getDetailsDashboard(){
    return getDetailsDashboard();
}

function send_request_tourguide(){
    $result = table_element_tourguide();
    return $result;
}

function send_request_totalplan(){
    $result = get_totalplan();
    return $result;
}

function send_request_hotels(){
    $result = get_hotels();
    return $result;
}

function send_earning(){
    $result = send_request_earning();
    return $result->fetch_assoc();
}

function send_expense(){
    $result = send_request_expense();
    return $result->fetch_assoc();
}

function get_CountryArray(){
    $result = send_CountryArray();
    return $result;
}

?>