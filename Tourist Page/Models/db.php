<?php

function conn(){

    $serverName='localhost';
    $userName='root';
    $pass='';
    $dbName='universustravel';
    $conn = new mysqli($serverName, $userName, $pass, $dbName);
    return $conn;
}




?>
