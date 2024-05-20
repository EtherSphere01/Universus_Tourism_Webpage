<?php

require_once('../../Naimur/Models/allDB.php');

function get_edit_info($username){
    $get_result = edit_info($username);
    return $get_result;
}

function update_traveler($username,$name,$location,$phone,$image){

    if(!empty($username) && !empty($name) && !empty($location) && !empty($phone)){
        $r= send_update_request($username,$name,$location,$phone,$image);
        return $r;
    }
    else{
        return "Fill all the fields";
    }
}


function delete_traveler($username){
    send_delete_request($username);
}


function get_validity($addusername){
   $s = send_username($addusername);
   return $s;
}

function add_traveler($username,$name,$location,$phone,$image){
    if(!empty($username) && !empty($name) && !empty($location) && !empty($phone)){
        $r = send_add_request($username,$name,$location,$phone,$image);
        return $r;
    }
    else{
        return "Fill all the fields";
    }
}

    function update_profile_picture($email, $tempimg){
       update_in_alldb($email, $tempimg);
    }


?>