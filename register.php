<?php 
    session_start();
    include('include/functions.php');
    include('include/head.php');
?>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="title">Mentos Register</div>
        <hr>
        <form action="include/register_db.php" method="post">
            <?php if(isset($_SESSION['error'])):?>
                <div class="alert alert-danger" role="alert">
                    <?php
                        echo $_SESSION['error'];
                        unset($_SESSION['error']); // unset session when refresh
                    ?>
                </div>
            <?php endif?>  
            <?php if(isset($_SESSION['success'])):?>
                <div class="alert alert-success" role="alert">
                    <?php
                        echo $_SESSION['success'];
                        unset($_SESSION['success']); // unset session when refresh
                    ?>
                </div>
            <?php endif?>  
            <?php if(isset($_SESSION['warning'])):?>
                <div class="alert alert-warning" role="alert">
                    <?php
                        echo $_SESSION['warning'];
                        unset($_SESSION['warning']); // unset session when refresh
                    ?>
                </div>
            <?php endif?>  
            <div class="mb-3 col-xs-3">
                <label for="u_name" class="form-label">Full Name</label>
                <input type="text" class="form-control" name="u_name" aria-describedby="u_name" >
            </div>
            <div class="mb-3">
                <label for="u_username" class="form-label">Username</label>
                <input type="text" class="form-control" name="u_username" aria-describedby="u_username">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" aria-describedby="email">
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" name="address" aria-describedby="address">
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone Number</label>
                <input type="text" class="form-control" name="phone" aria-describedby="phone">
            </div>
            <div class="mb-3">
                <label for="u_password" class="form-label">Password</label>
                <input type="password" class="form-control" name="u_password">
            </div>
            <div class="mb-3">
                <label for="c_password" class="form-label">Confirm password</label>
                <input type="password" class="form-control" name="c_password">
            </div>
            <div class="radio mb-3">
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
            <button type="submit" name="signup" class="btn btn-primary btn-lg btn-block">Register</button>
        </form>
            <div class="form-label">Already have an account? <a href="login.php">Login</a></div>
    </div>
</body>
</html>