<?php
    require_once('../Models/alldb.php'); // Assuming you have a cart model

    function addToCartController($email, $productName, $productPrice, $productImage) {
        
        $success = addToCart($email, $productName, $productPrice,$productImage);

        return $success;
    }

    // function booknow($email, $productName, $productPrice,$productImage){
    //     addToCart($email, $productName, $productPrice,$productImage);
    //     header("location: ../Views/booknow.php");
    // }

    function getCartDetails(){
        $r=getCart($_SESSION['email']);
        return $r;
    }

    function removeFromCart(){
        if(isset($_POST['cart-remove']) && isset($_POST['product_name'])){
            $productId = $_POST['product_name'];
            $r = removeCart($productId);
            return $r;
        }
    }


    function checkout(){
        header("location: ../Views/checkout.php");
    }

    function getCheckoutDetails(){
        $r=getCartRes($_SESSION['email']);
        return $r;
    }


    function callToOrder($custName, $custEmail, $custPhone, $custAddress, $productName, $orderTotal,$quantity){
        $r = order($custName, $custEmail, $custPhone, $custAddress, $productName, $orderTotal,$quantity);
        if($r){
            header("location: ../Views/myProfile.php");
            return $r;
        }
        else{
            return $r;
        }
    }



?>