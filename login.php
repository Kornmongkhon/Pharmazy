<?php 
    session_start();
    include('include/head.php');
    include('include/functions.php');  
?>
<head>
<link rel="stylesheet" href="style/login/login.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="style/login/login.js"></script>
</head>
<body>
    <div class="flex-login-form">
        <form class="card login-card-custom" action="include/login_db.php" method="post" id="loginForm">
        <div class="title">Mentos Login</div>
            <?php if(isset($_SESSION['success_login'])):?>
                <?php
                        echo "<script>";
                        echo "const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 5500,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                              toast.addEventListener('mouseenter', Swal.stopTimer)
                              toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                          })
                          Toast.fire({
                            icon: 'success',
                            title: 'Signed in successfully'
                          })";
                        echo "</script>";
                        // echo $_SESSION['success_login'];
                        unset($_SESSION['success_login']); // unset session when refresh
                    ?>
            <?php endif;?>
            <?php if(isset($_SESSION['error_found'])):?>
                    <?php
                        echo "<script>";
                        echo "Swal.fire({
                            icon: 'error',
                            title: 'Sorry :(',
                            text: 'No Results Found',
                            confirmButtonColor: '#3085d6'
                          })";
                        echo "</script>";
                        // echo $_SESSION['error_found'];
                        unset($_SESSION['error_found']); // unset session when refresh
                    ?>
            <?php endif?>  
            <?php if(isset($_SESSION['error_username'])):?>
                    <?php
                        echo "<script>";
                        echo "Swal.fire({
                            icon: 'error',
                            title: 'Sorry :(',
                            text: 'Wrong Username!',
                            confirmButtonColor: '#3085d6'
                          })";
                        echo "</script>";
                        // echo $_SESSION['error_username'];
                        unset($_SESSION['error_username']); // unset session when refresh
                    ?>
            <?php endif?> 
            <?php if(isset($_SESSION['error_password'])):?>
                    <?php
                        echo "<script>";
                        echo "Swal.fire({
                            icon: 'error',
                            title: 'Sorry :(',
                            text: 'Wrong password!',
                            confirmButtonColor: '#3085d6'
                          })";
                        echo "</script>";
                        // echo $_SESSION['error_password'];
                        unset($_SESSION['error_password']); // unset session when refresh
                    ?>
            <?php endif?> 
            <div class="user-details">
                <div class="form-outline mb-3 inputbox">
                    <label for="u_username" class="form-label">Username</label>
                    <input type="text" class="form-control" name="u_username" id="u_username" aria-describedby="u_username" placeholder="Enter your username">
                </div>
                <div class="form-outline mb-3 inputbox">
                    <label for="u_password" class="form-label">Password</label>
                    <div id="showPass">
                        <input type="password" class="form-control" name="u_password" id="u_password" placeholder="Enter your password">
                        <div class="field-icon">
                            <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" name="signin" id="signin" class="btnbg-custom btn-lg mb-3" style="width: 50%;margin-left: auto;margin-right: auto;font-weight: 600;">Login</button>
            <div class="form-label mb-3">Don't have an account? <a href="register.php">Register</a></div>
        </form>  
    </div>
    
</body>
</html>