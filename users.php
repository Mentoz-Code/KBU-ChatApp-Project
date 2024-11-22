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
        <section class="users">
            <header>
                <div class="content">
                    <?php
                        //ill get the uinque id of the user from the db
                        $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']} ");
                        if(mysqli_num_rows($sql) > 0) {
                            //im putting the row of the table in a $row variable... now i have his data
                            $row = mysqli_fetch_assoc($sql);
                        }
                    ?>


                    <!-- ill display the users pfp n name -->
                    <img src="php/images/<?php echo $row['img']; ?>" alt="">
                    <div class="details">
                        <span><?php echo $row['fname'] . " " . $row['lname']; ?></span>
                        <p><?php echo $row['status']; ?></p>
                    </div>
                </div>
                
                <!-- this will be the logout link.. ill send logout_id = unique_id to log out this user -->
                <a href="php/logout.php?logout_id=<?php echo $row['unique_id']; ?>" class="logout">Logout</a>
            </header>

            <!-- this will be the search bar -->
            <div class="search">
                <span class="text">Search for user</span>
                <input type="text" placeholder="Enter name to search...">
                <button><i class="fas fa-search"></i></button>
            </div>

            <div class="users-list">
                <!-- ill display the users in this list in js -->
            </div>
        </section>
    </div>
    <!-- this script will add functionality to the search bar and make the list of users -->
    <script src="js/users.js"></script>
</body>
</html>