<?php

    require_once ('../../Naimur/Models/allDB.php');

    function get_details($username){
        $result = send_request_db($username);
        return $result;
    }

    function update_details_admin($username, $name, $email, $location, $phone, $gender, $facebook, $github, $linkedin, $image, $password)
    {
        $result = update_request_db($username, $name, $email, $location, $phone, $gender, $facebook, $github, $linkedin, $image, $password);
        return $result;
    }

    function reloadPage(){
        ob_start();
        header("Location: ../Views/newSetting.php");
        exit();
        ob_end_flush();
    }

 


?>