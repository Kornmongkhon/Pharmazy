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
        <div class="title">Mentos Login</div>
        <hr>
        <form action="include/login_db.php" method="post">
            <?php if(isset($_SESSION['error'])):?>
                <div class="alert alert-danger" role="alert">
                    <?php
                        echo $_SESSION['error'];
                        unset($_SESSION['error']); // unset session when refresh
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
            <div class="mb-3">
                <label for="u_username" class="form-label">Username</label>
                <input type="text" class="form-control" name="u_username" aria-describedby="Username">
            </div>
            <div class="mb-3">
                <label for="u_password" class="form-label">Password</label>
                <input type="password" class="form-control" name="u_password" aria-describedby="Password">
            </div>
            <button type="submit" name="signin" class="btn btn-primary btn-lg btn-block">Login</button>
        </form>
            <div class="form-label">Don't have an account? <a href="register.php">Register</a></div>
    </div>
</body>
</html>