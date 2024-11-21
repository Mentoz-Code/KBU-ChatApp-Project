<?php
    session_start();
    include_once "config.php";

    //ill securely get the email n pass
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    //if both are set...
    if(!empty($email) && !empty($password)) {
        $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}' ");
        //if the email is not found in the db
        if(mysqli_num_rows($sql) > 0) {
            //assign the row with that email to $row
            $row = mysqli_fetch_assoc($sql);
            $user_pass = md5($password);
            //i took the users pass and used the same encryption initially used to signup... if they match its the correct pass
            $encrypted_pass = $row['password'];

            if($user_pass === $encrypted_pass) {
                $status = "Online";
                $sql_2 = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unique_id = {$row['unique_id']} ");

                if($sql_2) {
                    $_SESSION['unique_id'] = $row['unique_id'];
                    echo "Success!";
                } else {
                    echo "Something went wrong please try again";
                }
            } else {
                echo "Incorrect email or password";
            }
        } else {
            echo "$email - does not exist";
        }
    } else {
        echo "All the fields should be filled out";
    }
?>