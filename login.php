<?php
    include_once "header.php";
?>

<!-- here i made the login page... it also uses POST for safety -->
<body>
    <div class="wrapper">
        <section class="form login">
            <header>KBU-ChatApp</header>
            <form action="#" method="post" enctype="multipart/form-data" autocomplete="off">
                <div class="error-text"></div>

                <div class="field input">
                    <label>Email</label>
                    <input type="text" name="email" placeholder="Email" required>
                </div>

                <div class="field input">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Password" required>
                    <i class="fas fa-eye" ></i>
                </div>

                <div class="field button">
                    <input type="submit" name="submit" value="Continue Chatting">
                </div>

            </form>
            <div class="link">Not a member yet? <a href="index.php">Register</a></div>
        </section>
    </div>

    <script src="js/pass-show-hide.js" ></script>
    <script src="js/login.js" ></script>


</body>
</html>