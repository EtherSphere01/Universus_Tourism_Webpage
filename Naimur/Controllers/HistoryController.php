<?php
require_once("../../Tourist Page/Models/alldb.php");

function takehistorydata()
{
    $result = takehistory();
    return $result;
}

function update_complete_tour($id)
{
    $result = update_complete($id);
    return $result;
}

function update_paid_tour($id)
{
    $result = update_paid($id);
    return $result;
}

function update_cancle_tour($id)
{
    $result = update_cancle($id);
    return $result;
}

?>
