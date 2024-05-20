<?php
   require_once ('../Models/alldb.php');

    function loginRequest(){
        header("location: ../Views/login.php");
    }

    function cartRequest(){
        if(!isset($_SESSION['email'])){
            header("location: ../Views/login.php");
            echo "Log in First!";
        }else{
            header("location: ../Views/cart.php");
        }
    }

    function activitiesRequest() {
        header("location: ../Views/activitiesProduct.php");
    }
    
    function hotelsRequest(){
        header("location: ../Views/hotelsProduct.php");
    }



    function flightRequest(){
        header("location: ../Views/flightProducts.php");
        exit();
    }

    




    

?>