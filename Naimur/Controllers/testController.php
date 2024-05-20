<?php
require_once('../Models/alldb.php');

function get_notification()
{
    $notification = get_notification_data();
    return $notification;
}
