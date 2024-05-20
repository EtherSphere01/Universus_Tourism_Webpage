<?php
    require_once ('../Models/alldb.php');
    function getTour2(){
       header("location: ../Views/searchResult.php");
       
    }

    function resultActivity(){
        if(!empty($_SESSION['destination'])){
            $r = getTour($_SESSION['destination']);
            return $r;
        }
    }

    
    //For Flight

    function getFlight2(){
        header("Location: ../Views/searchResultFlight.php");
        exit; // Ensure script execution stops after redirection
    }
    
 
    function resultActivityFlight(){
        // Check if destination and departure are set in session
        if(isset($_SESSION['destination']) && isset($_SESSION['deprature'])){
            $destination = $_SESSION['destination'];
            $deprature = $_SESSION['deprature'];
            
            // Call getFlightSearch function with destination and departure
            return getFlightSearch($destination, $deprature);
        } else {
            // Handle case where destination or departure is not set
            return false;
        }
    }


    //For Hotel
    function getHotel2(){
        header("Location: ../Views/searchResultHotel.php");
        exit; // Ensure script execution stops after redirection
    }

    function resultActivityHotel(){
        if(isset($_SESSION['location'])){
            $location = $_SESSION['location'];
            return getHotelSearch($location);
        } else {
            return false;
        }
    }





?>