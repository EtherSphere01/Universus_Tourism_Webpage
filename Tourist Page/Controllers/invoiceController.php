<?php

    require_once('../Models/alldb.php');
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    function invoiceRequest(){
        header('Location: ../Views/invoice.php');
    }

    function invoiceRequestToDB(){
        $r=getInvoice($_SESSION['invoice']);
        return $r;
    }

    function get_required_order_details($id){
        $r=get_order_details($id);
        return $r;
    }

    function update_payment($id){
        $r=update_payment_status($id);
        return $r;
    }







?>