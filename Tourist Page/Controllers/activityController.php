<?php

     require_once ('../Models/alldb.php');

     function resultActivity(){
       $r =  getActivities();
       return $r;
     }

     function resultHotel(){
      $h = getHotel();
      return $h;
     }

     function resultFlight(){
      $f = getFlight();
      return $f;
     }


?>
