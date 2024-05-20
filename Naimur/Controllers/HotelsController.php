<?php
    
    require_once('../Models/allDB.php');

    function resultActivity(){
        $result = get_resultActivity2();
        return $result;
    }

    function detailsRequest($value){
        $result = get_detailsRequest2($value);
        return $result;
    }

    function edit_hotels($name,$price,$location,$details,$image,$stock){
        $result = update_hotels($name,$price,$location,$image,$details,$stock);
        return $result;
    }


?>