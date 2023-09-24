<?php 
    session_start();
    include('include/functions.php');
    include('include/head.php');
?>
<head>
<link rel="stylesheet" href="style/register/register.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="flex-login-form">
        <form class=" card login-card-custom" action="include/register_db.php" method="post" id="regForm">
        <div class="title">Mentos Register</div>
            <?php if(isset($_SESSION['error'])):?>
                    <?php
                        echo "<script>";
                        echo "Swal.fire({
                            icon: 'error',
                            title: 'Sorry :(',
                            text: 'Something went wrong..',
                            confirmButtonColor: '#3085d6'
                        })";
                        echo "</script>";
                        // echo $_SESSION['error'];
                        unset($_SESSION['error']); // unset session when refresh
                    ?>
            <?php endif?>  
            <?php if(isset($_SESSION['success'])):?>
                <div class="alert alert-success" role="alert">
                    <?php
                        echo "<script>";
                        echo "Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Registered Successfully',
                            showConfirmButton: false,
                            timer: 2000
                        })";
                        echo "</script>";
                        echo $_SESSION['success'];
                        unset($_SESSION['success']); // unset session when refresh
                    ?>
                </div>
            <?php endif?>  
            <?php if(isset($_SESSION['warning_already'])):?>
                    <?php
                        $links = "login.php";
                        echo "<script>";
                        echo "Swal.fire({";
                        echo "  title: 'Warning',";
                        echo "  html: 'Account is already exist! <a href=\"$links\"><strong>Login Here</strong></a>',"; // Use PHP variable inside JavaScript string
                        echo "  icon: 'warning',"; // Set the icon (optional)
                        echo "  confirmButtonColor: '#3085d6'"; // Set the text for the confirmation button (optional)
                        echo "});";
                        echo "</script>";
                        // echo $_SESSION['warning_already'];
                        unset($_SESSION['warning_already']); // unset session when refresh
                    ?>
            <?php endif?>
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
            <?php if(isset($_SESSION['warning_username'])):?>
                    <?php
                        echo "<script>";
                        echo "Swal.fire({
                            icon: 'warning',
                            title: 'Warning',
                            text: 'Please enter your Username!',
                            confirmButtonColor: '#3085d6'
                          })";
                        echo "</script>";
                        // echo $_SESSION['warning_username'];
                        unset($_SESSION['warning_username']); // unset session when refresh
                    ?>
            <?php endif?>  
            <?php if(isset($_SESSION['warning_email'])):?>
                    <?php
                        echo "<script>";
                        echo "Swal.fire({
                            icon: 'warning',
                            title: 'Warning',
                            text: 'Please enter your Email!',
                            confirmButtonColor: '#3085d6'
                          })";
                        echo "</script>";
                        // echo $_SESSION['warning_email'];
                        unset($_SESSION['warning_email']); // unset session when refresh
                    ?>
            <?php endif?> 
            <?php if(isset($_SESSION['warning_address'])):?>
                    <?php
                        echo "<script>";
                        echo "Swal.fire({
                            icon: 'warning',
                            title: 'Warning',
                            text: 'Please enter your Address!',
                            confirmButtonColor: '#3085d6'
                          })";
                        echo "</script>";
                        // echo $_SESSION['warning_address'];
                        unset($_SESSION['warning_address']); // unset session when refresh
                    ?>
            <?php endif?> 
            <?php if(isset($_SESSION['warning_phone'])):?>
                    <?php
                        echo "<script>";
                        echo "Swal.fire({
                            icon: 'warning',
                            title: 'Warning',
                            text: 'Please enter your Phone Number!',
                            confirmButtonColor: '#3085d6'
                          })";
                        echo "</script>";
                        // echo $_SESSION['warning_phone'];
                        unset($_SESSION['warning_phone']); // unset session when refresh
                    ?>
            <?php endif?> 
            <?php if(isset($_SESSION['warning_password'])):?>
                    <?php
                        echo "<script>";
                        echo "Swal.fire({
                            icon: 'warning',
                            title: 'Warning',
                            text: 'Please enter your Password!',
                            confirmButtonColor: '#3085d6'
                          })";
                        echo "</script>";
                        // echo $_SESSION['warning_password'];
                        unset($_SESSION['warning_password']); // unset session when refresh
                    ?>
            <?php endif?>
            <?php if(isset($_SESSION['warning_cpassword'])):?>
                    <?php
                        echo "<script>";
                        echo "Swal.fire({
                            icon: 'warning',
                            title: 'Warning',
                            text: 'Please enter your Confirm Password!',
                            confirmButtonColor: '#3085d6'
                          })";
                        echo "</script>";
                        // echo $_SESSION['warning_cpassword'];
                        unset($_SESSION['warning_cpassword']); // unset session when refresh
                    ?>
            <?php endif?> 
            <?php if(isset($_SESSION['warning_inpass'])):?>
                    <?php
                        echo "<script>";
                        echo "Swal.fire({
                            icon: 'warning',
                            title: 'Warning',
                            text: 'Password not match!',
                            confirmButtonColor: '#3085d6'
                          })";
                        echo "</script>";
                        // echo $_SESSION['warning_inpass'];
                        unset($_SESSION['warning_inpass']); // unset session when refresh
                    ?>
            <?php endif?> 
            <?php if(isset($_SESSION['warning_gender'])):?>
                    <?php
                        echo "<script>";
                        echo "Swal.fire({
                            icon: 'warning',
                            title: 'Warning',
                            text: 'Please enter your Gender!',
                            confirmButtonColor: '#3085d6'
                          })";
                        echo "</script>";
                        // echo $_SESSION['warning_gender'];
                        unset($_SESSION['warning_gender']); // unset session when refresh
                    ?>
            <?php endif?> 
            <?php if(isset($_SESSION['warning_already'])):?>
                    <?php
                        echo "<script>";
                        echo "Swal.fire({
                            icon: 'warning',
                            title: 'Warning',
                            html:
                                'You can use <b>bold text</b>, ' +
                                '<a href='//sweetalert2.github.io'>links</a>',
                            confirmButtonColor: '#3085d6'
                          })";
                        echo "</script>";
                        // echo $_SESSION['warning_gender'];
                        unset($_SESSION['warning_gender']); // unset session when refresh
                    ?>
            <?php endif?> 
            <div class="user-details warp">
                <div class="form-outline mb-3 inputbox">
                    <label for="u_name" class="form-label">Full Name</label>
                    <input type="text" class="form-control" name="u_name" aria-describedby="u_name" placeholder="Enter your name">
                </div>
                <div class="form-outline inputbox">
                    <label for="u_username" class="form-label">Username</label>
                    <input type="text" class="form-control" name="u_username" aria-describedby="u_username" placeholder="Enter your username">
                </div>
                <div class="form-outline inputbox">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" aria-describedby="email" placeholder="Enter your email">
                </div>
                <div class="form-outline inputbox"></div>
                <div class="form-outline inputbox">
                    <label for="address" class="form-label">Address</label>
                    <textarea class="form-control" name="address" aria-describedby="address" placeholder="Enter your address"></textarea>
                </div>
                <div class="form-outline inputbox">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="text" class="form-control" name="phone" aria-describedby="phone" placeholder="Enter your phone number">
                </div>
                <div class="form-outline inputbox">
                    <label for="u_password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="u_password" placeholder="Enter your password">
                </div>
                <div class="form-outline inputbox">
                    <label for="c_password" class="form-label">Confirm password</label>
                    <input type="password" class="form-control" name="c_password" placeholder="Enter your confirm password">
                </div>
                <div class="form-outline radio mb-3 inputgender">
                    <div class="mb-3">
                        <label for="gender">Gender</label>
                    </div>
                    <div>
                        <label>
                            <input type="radio" name="gender" value="male" aria-describedby="gender">
                            Male
                        </label>
                        <label>
                            <input type="radio" name="gender" value="female" aria-describedby="gender">
                            Female
                        </label>
                    </div>
                </div>
            </div>
            <button type="submit" name="signup" class="btn btn-primary btn-lg mb-3" style="width: 80%;margin-left: auto;margin-right: auto;">Register</button>
            <div class="form-label">Already have an account? <a href="login.php">Login</a></div>
        </form>
            
    </div>
</body>
</html>