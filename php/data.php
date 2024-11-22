<?php
    while($row = mysqli_fetch_assoc($query)) {
        //ill take messages id (sender or reciever doesnt matter) and sort it by desc order
        $sql_2 = "SELECT * FROM messages WHERE (incoming_msg_id = {$row['unique_id']} 
        OR outgoing_msg_id = {$row['unique_id']} AND outgoing_msg_id = {$outgoing_id} 
        OR incoming_msg_id = {$outgoing_id}) 
        ORDER BY msg_id DESC LIMIT 1";
        
        //save the query in row2
        $query_2 = mysqli_query($conn, $sql_2);
        $row_2 = mysqli_fetch_assoc($query_2);
        //now for the if statements... ill do them in a shorter way
        (mysqli_num_rows($query_2) > 0) ? $result = $row_2['msg'] : $result = " No messages available";
        (strlen($result) > 28) ? $msg = substr($result, 0, 28) . '...' : $msg = $result;

        if(isset($row_2['outgoing_msg_id'])) {
            //if sent message was from you then itll show You: and then the message (in the html below)
            ($outgoing_id == $row_2['outgoing_msg_id']) ? $you = "You: " : $you = "";
        } else {
            $you = "";
        }

        //this will be used for properly classing the element in html
        ($row['status'] == "Offline") ? $offline = "offline" : $offline = "";
        ($outgoing_id == $row['unique_id']) ? $hide_me = "hide" : $hide_me = "";

        //will make the user as a link that redirects you to the php/chat.php (sneding it the id of the other person)
        $output .= '
        <a href="chat.php?user_id='.$row['unique_id'].' " >
            <div class="content">
                <img src="php/images/'.$row['img'].'" alt="" >
                <div class="details">
                    <span>'.$row['fname'] . " " . $row['lname'].'</span>
                    <p>' . $you . $msg . '</p>
                </div>
            </div>
            <div class="status-dot '.$offline.' "><i class="fas fa-circle"></i></div>
        </a>
        ';

        
    }

?>