<?php
    session_start();
    include_once "config.php";

    $outgoing_id = $_SESSION['unique_id'];
    //cleans the input to prevent injections
    $searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']);
    //ill prevent the user from searching themselvs... but if the search term = fname or lname of others... display it
    $sql = "SELECT * FROM users WHERE NOT unique_id = {$outgoing_id} AND (fname LIKE '%{$searchTerm}%' OR lname LIKE '%{$searchTerm}%') ";
    $output = "";

    $query = mysqli_query($conn, $sql);
    //if found then load in data.php
    if(mysqli_num_rows($query) > 0) {
        include_once "data.php"; //depending on its output itll send it to users.js to display
    } else {
        $output .= 'No users found';
    }

    echo $output;
?>