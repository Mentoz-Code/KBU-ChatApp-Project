<?php
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $dbname= "kbu_chatapp_db";

    //the connection var takes these parameters and returns true or false depending if it succeeded
    $conn = mysqli_connect($hostname, $username, $password, $dbname);
    
    //here im checking if the connection failed ill echo that it did
    if(!$conn) {
        echo "Database connection failed" . mysqli_connect_error();
    }
?>