<?php
    session_start();
    include('include\head.php');
?>

<head>
    <link href="style/login/login.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="title">Mentos Login</div>
            <form action="include/function.php" method="post">
                <div class="user-details">
                    <div class="inputbox">
                        <span class="details">Username</span>
                        <input type="text" name="u_username" placeholder="Enter your username" required>
                    </div>
                    <div class="inputbox">
                        <span class="details">Password</span>
                        <input type="text" name="u_password" placeholder="Enter your password" required>
                    </div>
                </div>
                <!-- <div class="gender-details">
                    <input type="radio" name="gender" id="dot-1" value="male">
                    <input type="radio" name="gender" id="dot-2" value="female">
                    <span class="gender-title">Gender</span>
                    <div class="category">
                        <label for="dot-1">
                            <span class="dot one"></span>
                            <span class="gender">Male</span>
                        </label>
                        <label for="dot-2">
                            <span class="dot two"></span>
                            <span class="gender">Female</span>
                        </label>
                    </div>
                </div> -->
                <div class="button">
                    <input type="submit" value="Login">
                </div>
                <div class="not-have-account">
                    <span>Don't have an account?</span>
                    <span><a href="register.php">Register</a></span>
                </div>
            </form>
    </div>
</body>
</html>