<?php
require_once ('../Models/alldb.php');


function detailsRequest(){

    header("location: ../Views/productPage.php");

}

function resultDetailsRequest(){
    $r=getDetailsProduct($_SESSION['details-btn']);
    return $r;
}




//For flight Page

function detailFlightRequest(){
    header("location: ../Views/flightProductDetails.php");
}

function flightResultDetailsRequest(){
    $r=getFlightDetailsProduct($_SESSION['details-btn']);
    return $r;
}

//For Hotel Page

function detailHotelRequest(){
    header("location: ../Views/hotelProductDetails.php");
}

function hotelResultDetailsRequest(){
    $r=getHotelDetailsProduct($_SESSION['details-btn']);
    return $r;
}







?>