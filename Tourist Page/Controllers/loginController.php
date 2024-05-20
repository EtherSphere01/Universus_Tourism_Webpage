<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once('../Models/alldb.php');

function registration($name, $email, $role, $address, $password, $dob, $gender, $country, $passno, $nid, $pin)
{
    $result = addUser($name, $email, $role, $address, $password, $dob, $gender, $country, $passno, $nid, $pin);

    // naimur

    require_once('../../Naimur/Controllers/TravelersController.php');
    require_once('../../Naimur/Controllers/TourGuideController.php');
    if ($role == "tourist") {
        $result = add_traveler($email, $name, $country, $passno, '../../Naimur/Views/UserImage/travelers.png');
    } else if ($role == "guide") {
        $result = add_tourguide($email, $name, $country, $passno, '../../Naimur/Views/UserImage/travelers.png', '5000');
    } else if ($role == "admin") {
        $result =  add_admin($email, $name, $email, $country, $passno, $gender, $password, '../../Naimur/Views/UserImage/travelers.png', 'Facebook link', 'Github link', 'Linkedin link');
    }


    return $result;
}


function loginUser($email, $password)
{

    if ($email == "admin" and $password == "admin") {

        header("location: ../../Naimur/Views/session.php");
        return true;
    } else {
        $status = loginAuth($email, $password);

        if ($status) {
            $row = mysqli_fetch_assoc($status);
            $_SESSION['name'] = $row['name'];
            $_SESSION['email'] = $email;
            $_SESSION['country'] = $row['country'];
            header("location: ../Views/home.php");
        } else {
            $_SESSION['loginError'] = "Invalid email or password";
            return false;
        }
    }
}


function logout()
{

    unset($_SESSION['email']);

    session_unset();
    session_destroy();

    header("Location: ../Views/login.php");
    exit();
}



function getProfile($email)
{
    $result = get_information($email);
    return $result;
}

function updateProfile($email, $tempimg)
{
    $result = update_information($email, $tempimg);
    return $result;
}
