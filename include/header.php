<?php 
    include('functions.php');
    session_start();
    if(isset($_GET['logout'])){
        session_destroy();
        unset($_SESSION['username']);
        header("location: index.php");
    }
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/navbar/navbar.css">
</head>
<body>
    <?php 
        $username = isset($_GET['u_username']) ? $_GET['u_username'] : "";
    ?>
    <header>
        <img class="logo" src="assets/images/mentoslogo.png" style="width: 400px;height:120px;">
        <!-- <h1 style="color:white">Mentos Pharmazy</h1> -->
        <div>
            
        </div>
        <nav>
            <ul class="nav-links">
                <li><a href="#">Home</a></li>
                <li><a href="#">Promotion</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="#">Info</a></li>
            </ul>
        </nav>
        <!-- check uid -->
        <?php if(!isset($_SESSION['u_username'])):?>
                <div class='button'>
                    <a href='login.php' >Login</a> / <a href='register.php'>Sign Up</a>
                </div>
        <?php endif?>
        <?php if(isset($_SESSION['u_username'])):?>
            <p style="position: absolute;top=0;right: 25;">Welcome, </p><strong><?=$username?></strong>;
            <div class='button'>
                <a href="header.php?logout='1'" >Login</a>
            </div>
        <?php endif;?>
    </header>

</body>