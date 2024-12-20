<?php
    session_start();
    include_once "php/config.php";

    if(!isset($_SESSION['unique_id'])) {
        header("location: login.php");
    }
?>

<?php
    include_once "header.php";
?>

<body>
    <div class="wrapper">
        <section class="chat-area">
            <header>

                <?php
                    //the id is taken from line 29 in php/data.php
                    $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
                    $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$user_id} ");

                    if(mysqli_num_rows($sql) > 0) {
                        $row = mysqli_fetch_assoc($sql);
                    } else {
                        header("location: users.php");
                    }
                ?>

                <!-- this is the users info -->
                <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
                <img src="php/images/<?php echo $row['img']; ?>" alt="">
                <div class="details">
                    <span><?php echo $row['fname'] . " " . $row['lname']; ?></span>
                    <p><?php echo $row['status']; ?></p>
                </div>
            </header>

            <div class="chat-box">
                <!-- the messages will be shown dynamically by ajax -->
            </div>

            <form action="#" class="typing-area">
                <input type="text" name="incoming_id" class="incoming_id" value="<?php echo $user_id; ?>" hidden>
                <input type="text" name="message" class="input-field" placeholder="Type message here..." autocomplete="off">
                <button><i class="fab fa-telegram-plane"></i></button>
            </form>
        </section>
    </div>

<script src="js/chat.js"></script>

</body>
</html>