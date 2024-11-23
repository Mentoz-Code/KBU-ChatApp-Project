<?php
    session_start();
    if(isset($_SESSION['unique_id'])) {
        include_once "config.php";

        $outgoing_id = $_SESSION['unique_id'];
        //from chat.php line 45
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
        $output = "";
        //take from db where either receiver or sender to each other
        $sql = "SELECT * FROM messages LEFT JOIN users ON 
                users.unique_id = messages.outgoing_msg_id 
                WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id}) 
                OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id}) 
                ORDER BY msg_id";

        $query = mysqli_query($conn, $sql);

        if(mysqli_num_rows($query) > 0) {
            while($row = mysqli_fetch_assoc($query)) {
                //when im the sender
                if($row['outgoing_msg_id'] === $outgoing_id) {
                    $output .= '
                                <div class="chat outgoing">
                                    <div class="details">
                                        <p>'.$row['msg'].'</p>
                                    </div>
                                </div>
                                ';
                } else { //when im the receiver
                    $output .= '<div class="chat incoming">
                                    <img src="php/images/'.$row['img'].'" alt="">
                                    <div class="details">
                                        <p>'.$row['msg'].'</p>
                                    </div>
                                </div>';
                }
            }
        } else { //when there are no messages between us
            $output .= '<div class="text">No messages available</div>';
        }
        echo $output;
    } else { //if no unique_id is set... it means ur not logged in
        header("location: ../login.php");
    }
?>