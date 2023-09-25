<?php 
    session_start();
    include('include/functions.php');
    include('include/head.php');
?>
<head>
<link rel="stylesheet" href="style/register/register.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="style/register/register.js"></script>
</head>
<body>
    <div class="flex-login-form">
        <form class=" card login-card-custom" action="include/register_db.php" method="post" id="regForm">
        <div class="title">Mentos Register</div>
        <?php if(isset($_SESSION['success'])):?>
                <div class="alert alert-success" role="alert" style="text-align: center;">
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
            <?php if(isset($_SESSION['error_already'])):?>
                    <?php
                        echo "<script>";
                        echo "Swal.fire({
                            icon: 'error',
                            title: 'Sorry :(',
                            test: 'Account is already exist!',
                            confirmButtonColor: '#3085d6'
                        })";
                        echo "</script>";
                        // echo $_SESSION['error_already'];
                        unset($_SESSION['error_already']); // unset session when refresh
                    ?>
            <?php endif?>
            <?php if(isset($_SESSION['error'])):?>
                    <?php
                        echo "<script>";
                        echo "Swal.fire({
                            icon: 'error',
                            title: 'Sorry :(',
                            test: 'Something went wrong!',
                            confirmButtonColor: '#3085d6'
                        })";
                        echo "</script>";
                        // echo $_SESSION['error'];
                        unset($_SESSION['error']); // unset session when refresh
                    ?>
            <?php endif?>
            <div class="user-details warp">
                <div class="form-outline mb-3 inputbox">
                    <label for="u_name" class="form-label">Full Name</label>
                    <input type="text" class="form-control" name="u_name" id="u_name" aria-describedby="u_name" placeholder="Enter your name">
                </div>
                <div class="form-outline inputbox">
                    <label for="u_username" class="form-label">Username</label>
                    <input type="text" class="form-control" name="u_username" id="u_username" aria-describedby="u_username" placeholder="Enter your username">
                </div>
                <div class="form-outline inputbox">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" name="email" id="email" aria-describedby="email" placeholder="Enter your email">
                </div>
                <div class="form-outline inputbox">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="text" class="form-control" name="phone" id="phone" aria-describedby="phone" placeholder="Enter your phone number">
                </div>
                <div class="form-outline inputbox textbox" style="margin-bottom: 30px;">
                    <label for="address" class="form-label">Address</label>
                    <textarea class="form-control" name="address" aria-describedby="address" id="address" placeholder="Enter your address"></textarea>
                </div>
                <div class="form-outline inputbox">
                    <label for="u_password" class="form-label">Password</label>
                    <div id="showPass">
                        <input type="password" class="form-control" name="u_password" id="u_password" placeholder="Enter your password">
                        <div class="field-icon">
                            <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
                <div class="form-outline inputbox">
                    <label for="c_password" class="form-label">Confirm password</label>
                    <div id="showConfirmPass">
                        <input type="password" class="form-control" name="c_password" id="c_password" placeholder="Enter your confirm password">
                        <div class="field-icon">
                            <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
                <div class="form-outline radio mb-3 inputbox inputgender">
                    <div class="mb-2">
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
            <button type="submit" name="signup" id="signup" class="btnbg-custom btn-lg mb-3" style="width: 80%;margin-left: auto;margin-right: auto;">Register</button>
            <div class="form-label mb-3">Already have an account? <a href="login.php">Login</a></div>
        </form>
            
    </div>
</body>
</html>