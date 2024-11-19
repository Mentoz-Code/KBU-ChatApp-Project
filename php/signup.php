<?php
    include_once "config.php";

    //this function i used here 'sanitizes' the string to prepare it for querrying.
    //it removes special chars to protect from sql inj
    $fname = mysqli_real_escape_string($conn, $_POST['fname']) ;
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    //if any of the fields are empty
    if(!empty($fname) && !empty($lname) && !empty($email) && !empty($password)) {
        //the FILTER_VALIDATE_EMAIL is a built in validation function
        if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
            //if email already exists the query will return more than 0 rows...
            if(mysqli_num_rows($sql) > 0) {
                echo "$email - already exists";
            } else {
                if(isset($_FILES['image'])) {
                    //if the pic is submited ill see if its suitable
                    $img_name = $_FILES['image']['name'];
                    $img_type = $_FILES['image']['type'];
                    $tmp_name = $_FILES['image']['tmp_name'];

                    //for example: imgname= pic.jpg, imgexplode = ["pic","jpg"] and the end function j gives the last in the array
                    $img_explode = explode('.', $img_name);
                    $img_extention = end($img_explode);

                    //the accepted extentions
                    $extention = ["jpeg", "png", "jpg"];

                    if(in_array($img_extention, $extention) === true) {
                        $type = ["image/jpeg", "image/png", "image/jpg"];

                        if(in_array($img_type, $type) === true) {
                            //almost like giving it a unique name...
                            $time = time();
                            $new_img_name = $time.$img_name;

                            if(move_uploaded_file($tmp_name, "images/".$new_img_name)) {
                                $random_id = rand(time(), 100000000); //will be the unique id
                                $status = "Online";
                                $encrypted_pass = md5($password); //taken from config
                                //now ill insert this data to the database.... this is the users info in the db
                                $insert_query = mysqli_query($conn, "INSERT INTO users (unique_id, fname, lname, email, password, img, status) VALUES ({$random_id}, '{$fname}', '{$lname}', '{$email}', '{$encrypted_pass}', '{$new_img_name}', '{$status}')");

                                //if successful
                                if($insert_query) {
                                    //here ill select the email with this query
                                    $select_sql2 = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
                                    //if the email exists... ill put it in a variable then put it as the session's unique id
                                    if(mysqli_num_rows($select_sql2) > 0) {
                                        $result = mysqli_fetch_assoc($select_sql2);
                                        $_SESSION['unique_id'] = $result['unique_id'];
                                        echo "Success!";
                                    } else {
                                        echo "This email does not exist";
                                    }
                                } else {
                                    echo "Something went wrong please try again";
                                }

                            } else {
                                //echo "Something went wrong please try again"; technically it wont come here but its nicer this way hahaha
                            }
                        } else {
                            echo "Profile picture should be a jpg, jpeg, png file";
                        }
                    } else {
                        echo "Profile picture should be a jpg, jpeg, png file";
                    }
                }
            }
        } else {
            echo "$email - is not valid";
        }
    } else {
        echo "All the fields should be filled out";
    }
?>