<?php 
    session_start();
    include "include/functions.php";
    include('include/head.php');
?>
<head>
    <link href="style/register/registerPage.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.28/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.28/dist/sweetalert2.min.css" rel="stylesheet">
</head>

<body>
<div class="container">
    <div class="title">Mentos Register</div>
        <form action="include/register_db.php" id="registerForm" method="post">
            <div class="user-details">
                <div class="inputbox">
                    <span class="details">Full Name</span>
                    <input type="text" name="u_name" placeholder="Enter your name" required>
                </div>
                <div class="inputbox">
                    <span class="details">Username</span>
                    <input type="text" name="u_username" placeholder="Enter your username" >
                </div>
                <div class="inputbox">
                    <span class="details">Email</span>
                    <input type="text" name="email" placeholder="Enter your email" >
                </div>
                <div class="inputbox">
                    <span class="details">Address</span>
                    <input type="text" name="address" placeholder="Enter your phone number" >
                </div>
                <div class="inputbox">
                    <span class="details">Phone Number</span>
                    <input type="text" name="phone" placeholder="Enter your phone number" >
                </div>
                <div class="inputbox" id="boxvis">
                </div>
                <div class="inputbox">
                    <span class="details">Password</span>
                    <input type="password" name="u_password" id="reg-password" placeholder="Enter your password" required>
                </div>
                <div class="inputbox">
                    <span class="details">Confirm Password</span>
                    <input type="password" id="reg-confirm-password" placeholder="Confirm your password" required>
                </div>
            </div>
            <div class="gender-details">
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
            </div>
            <div class="button">
                <input type="submit" value="Register" name="regBTN" id="regBTN">
            </div>
            <div class="have-account">
                <span>Already have an account?</span>
                <span><a href="login.php">Login</a></span>
            </div>
        </form>
    </div>
</body>
</html>