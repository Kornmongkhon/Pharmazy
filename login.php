<?php 
    session_start();
    include('include/functions.php');
    include('include/head.php');
?>
<head>
<link rel="stylesheet" href="style/login/login.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="flex-login-form">
        <form class="card login-card-custom" action="include/login_db.php" method="post">
        <div class="title">Mentos Login</div>
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
            <div class="user-details">
                <div class="form-outline mb-3">
                    <label for="u_username" class="form-label">Username</label>
                    <input type="text" class="form-control" name="u_username" aria-describedby="u_username" placeholder="Enter your username">
                </div>
                <div class="form-outline mb-3">
                    <label for="u_password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="u_password" placeholder="Enter your password">
                </div>
            </div>
            <button type="submit" name="signin" class="btn btn-primary btn-lg mb-3" style="width: 80%;margin-left: auto;margin-right: auto;">Login</button>
            <div class="form-label">Don't have an account? <a href="register.php">Register</a></div>
        </form>  
    </div>
</body>
</html>