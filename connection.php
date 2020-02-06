<?php
    $Conn = mysqli_connect("localhost","root","");
    if(!$Conn){
        die(mysqli_error());
    }else{
        mysqli_select_db($Conn,"profilingsystem");
    }
?>