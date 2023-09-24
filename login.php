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
<script>
    $(document).ready(function(){//use jquery
        $("#showPass a").on('click',function(e){//ref id $showPass -> a
            e.preventDefault();//stop refresh page
            if($('#showPass input').attr("type")== "text"){//check if input type = text change to password add class,remove class icon
                $('#showPass input').attr('type','password');
                $('#showPass i').addClass(" fa-eye-slash");
                $('#showPass i').removeClass(" fa-e fa-eye");
            }else if($('#showPass input').attr("type")== "password"){//check if input type = pass change to text add class,remove class icon
                $('#showPass input').attr('type','text');
                $('#showPass i').removeClass(" fa-eye-slash");
                $('#showPass i').addClass(" fa-e fa-eye");
            }
        })
        $('#showPass i').hide(); //ref id #showPass -> i hide icon
        $('#u_password').on('input',function () {//show icon when input field not empty
            if($(this).val().trim() !== ''){//check from input id=u_password using method value if !== NULL show icon
                $('#showPass i').show();
            }else{
                $('#showPass i').hide();
            }
        });
    })
</script>
</head>
<body>
    <div class="flex-login-form">
        <form class="card login-card-custom" action="include/login_db.php" method="post" id="loginForm">
        <div class="title">Mentos Login</div>
            <?php if(isset($_SESSION['success_login'])):?>
                <?php
                        echo "<script>";
                        echo "Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Login Successful!',
                            showConfirmButton: false,
                            timer: 2000
                        })";
                        echo "</script>";
                        // echo $_SESSION['error_found'];
                        unset($_SESSION['error_found']); // unset session when refresh
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
                <div class="form-outline mb-3 inputbox">
                    <label for="u_username" class="form-label">Username</label>
                    <input type="text" class="form-control" name="u_username" aria-describedby="u_username" placeholder="Enter your username">
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
            <button type="submit" name="signin" class="btnbg-custom btn-lg mb-3" style="width: 50%;margin-left: auto;margin-right: auto;font-weight: 600;">Login</button>
            <div class="form-label">Don't have an account? <a href="register.php">Register</a></div>
        </form>  
    </div>
    
</body>
</html>