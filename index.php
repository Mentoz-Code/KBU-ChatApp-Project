<?php
    include_once "header.php";
?>

<body>
    <!-- here i will make the signup page, the data will be POST'ed for security purposes -->
<div class="wrapper">
        <section class="form signup">
            <header>KBU-ChatApp</header>
            <form action="#" method="post" enctype="multipart/form-data" autocomplete="off"> <!-- the multipart cuz its more than one input -->
                <div class="error-text"></div>

                <div class="name-details">
                    <div class="field input">
                        <label>First Name</label>
                        <input type="text" name="fname" placeholder="First Name" required>
                    </div>
                    
                    <div class="field input">
                        <label>Last Name</label>
                        <input type="text" name="lname" placeholder="Last Name" required>
                    </div>
                </div>

                <div class="field input">
                    <label>Email</label>
                    <input type="text" name="email" placeholder="Email" required>
                </div>

                <div class="field input">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Password" required>
                    <i class="fas fa-eye"></i>  <!-- this is the eye icon... needs the cdn in header -->
                </div>

                <div class="field image">
                    <label>Profile Picture</label>
<!--                                                   v this makes it so that it only accepts these extentions-->
                    <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg,image/jpg" required>
                </div>

                <div class="field button">
                    <input type="submit" name="submit" value="Start Chatting!">
                </div>

            </form>
            
            <div class="link">Already a member? <a href="login.php">Login</a></div>
        </section>
    </div>
</body>
</html>