<?php
    require_once('../Models/alldb.php');


    function getControllerHistory(){
        $r=getHistory($_SESSION['email']);
        return $r;
    }

    function cancelOrder($id){
        $r=cancelOrderModel($id);
        return $r;
    }

    function changePassword($email, $pin_no, $old_pass, $new_pass){
        $r=changePasswordModel($email, $pin_no, $old_pass, $new_pass);
        return $r;
    }

    require_once('../../Naimur/Models/allDB.php');
    function getimagefromtable($email){
        $r=getimagefromtableModel($email);
        return $r;
    }
    function reviewSubmit($invoice_id, $product_name,$name, $comment, $rate,$email,$image){
        
        $r=reviewSubmitModel($invoice_id, $product_name,$name, $comment, $rate);
        updatenaimurreviewtable($invoice_id, $product_name,$name, $comment, $rate,$email,$image);
        return $r;
    }


    function  updateReviewStatus($invoice_id){
        updateReviewStatusModel($invoice_id);
        
    }
?>