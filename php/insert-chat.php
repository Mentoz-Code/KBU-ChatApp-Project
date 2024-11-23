<?php
    session_start();

    if(isset($_SESSION['unique_id'])) {
        include_once "config.php";

        $outgoing_id = $_SESSION['unique_id'];
        //from chat.php line 45
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
        //from chat.php line 46
        $message = mysqli_real_escape_string($conn, $_POST['message']);

        if(!empty($message)) {
            $sql = mysqli_query($conn, "INSERT INTO messages(incoming_msg_id, outgoing_msg_id, msg) 
                                                    VALUES ({$incoming_id}, {$outgoing_id}, '{$message}' ) ") 
                                                    or die();
        }
    } else {
        header("location: ../login.php");
    }
?>