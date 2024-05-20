<?php
    
    // require_once('../Models/allDB.php');
    require_once('../../Tourist Page/Models/alldb.php');

    function resultActivity(){
        $result = get_resultActivity();
        return $result;
    }

    function detailsRequest($value){
        $result = get_detailsRequest($value);
        return $result;
    }

    function edit_tours($name,$price,$location,$details,$image,$stock){
        $result = update_tours($name,$price,$location,$image,$details,$stock);
        return $result;
    }


?>