<?php
    session_start();
    if(isset($_SESSION['unique_id'])) {
        include_once "config.php";
        //ill get the logout id thats passed from the users.php
        $logout_id = mysqli_real_escape_string($conn, $_GET['logout_id']);
        if(isset($logout_id)) {
            //now make status offline and update the db
            $status = "Offline";
            $sql = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unique_id = {$_GET['logout_id']} ");

            //if sql is executed... free and end the session and go to the login page
            if($sql) {
                session_unset();
                session_destroy();
                header("location: ../login.php");
            }
        } else {
            //if the logout was faulty id stay
            header("location: ../users.php");
        }
    } else {
        header("location: ../login.php");
    }
?>