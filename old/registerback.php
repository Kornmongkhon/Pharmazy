<?php 
    session_start();
    include "include/functions.php";
    include('include/head.php');
?>
<head>
    <link href="style/register/registerPage.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.28/dist/sweetalert2.all.min.js"></script>
</head>

<body>
<div class="container">
    <?php if(isset($_SESSION['warning_name'])):?>
        <?php
            echo "<script>";
            echo "Swal.fire({
                icon: 'warning',
                title: 'Warning',
                text: 'Please enter your Full Name!',
                confirmButtonColor: '#3085d6'
                })";
            echo "</script>";
            // echo $_SESSION['warning_name'];
            unset($_SESSION['warning_name']); // unset session when refresh
        ?>
    <?php endif?>
    <div class="title">Mentos Register</div>
        <form action="include/register_db.php" id="registerForm" method="post">
            <div class="user-details">
                <div class="inputbox">
                    <span class="details">Full Name</span>
                    <input type="text" name="u_name" placeholder="Enter your name" aria-describedby="u_name" >
                </div>
                <div class="inputbox">
                    <span class="details">Username</span>
                    <input type="text" name="u_username" placeholder="Enter your username" aria-describedby="u_username">
                </div>
                <div class="inputbox">
                    <span class="details">Email</span>
                    <input type="email" name="email" placeholder="Enter your email" aria-describedby="email">
                </div>
                <div class="inputbox">
                    <span class="details">Address</span>
                    <input type="text" name="address" placeholder="Enter your address" aria-describedby="address">
                </div>
                <div class="inputbox">
                    <span class="details">Phone Number</span>
                    <input type="text" name="phone" placeholder="Enter your phone number" aria-describedby="phone">
                </div>
                <div class="inputbox" id="boxvis">
                </div>
                <div class="inputbox">
                    <span class="details">Password</span>
                    <input type="password" name="u_password" id="reg-password" placeholder="Enter your password" >
                </div>
                <div class="inputbox">
                    <span class="details">Confirm Password</span>
                    <input type="password" id="reg-confirm-password" placeholder="Confirm your password" >
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
                <input type="submit" value="Register" name="signup" id="regBTN">
            </div>
            <div class="have-account">
                <span>Already have an account?</span>
                <span><a href="login.php">Login</a></span>
            </div>
        </form>
    </div>
</body>
</html>