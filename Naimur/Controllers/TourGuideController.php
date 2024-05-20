<?php

require_once('../../Naimur/Models/allDB.php');

function get_edit_info_tourguide($username){
    $get_result = edit_info_tourguide($username);
    return $get_result;
}

function update_tourguide($username,$name,$location,$phone,$image,$salary){

    if(!empty($username) && !empty($name) && !empty($location) && !empty($phone) && !empty($salary)){
        $r= send_update_request_tourguide($username,$name,$location,$phone,$image,$salary);
        return $r;
    }
    else{
        return "Fill all the fields";
    }
}


function delete_tourguide($username){
    return send_delete_request_tourguide($username);
}


function get_validity_tourguide($addusername){
   $s = send_username_tourguide($addusername);
   return $s;
}

function add_tourguide($username,$name,$location,$phone,$image,$salary){
    if(!empty($username) && !empty($name) && !empty($location) && !empty($phone) && !empty($salary)){
        $r = send_add_request_tourguide($username,$name,$location,$phone,$image,$salary);
        return $r;
    }
    else{
        return "Fill all the fields";
    }
}


function add_admin($username,$name,$email,$location,$phone,$gender,$password,$image,$facebook,$github,$linkedin){
        $r = send_admin_add_request($username,$name,$email,$location,$phone,$gender,$password,$image,$facebook,$github,$linkedin);
        return $r; 

}


?>