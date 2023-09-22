<?php 
    include('functions.php');
    session_start();
    if(isset($_GET['logout'])){
        session_destroy();
        unset($_SESSION['user_login']);
        header("location: index.php");
    }
    if(!isset($_SESSION['user_login'])){//check session user login
        echo "Not found";
    }
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/navbar/navbar.css">
</head>
<body>
    <?php 
        $User_login = isset($_GET['u_username']) ? $_GET['u_username'] : "";
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
        <!-- check user login -->
        <?php if(!isset($_SESSION['user_login'])):?>
                <div class='button'>
                    <a href='login.php' >Login</a> / <a href='register.php'>Sign Up</a>
                </div>
        <?php endif?>
        <?php if(isset($_SESSION['user_login'])):?>
            <?php
                $showName = $pdo->prepare("SELECT * FROM users");
                $showName->execute();
                $row = $showName->fetch(PDO::FETCH_ASSOC);
            ?>
            
            <div class='button'>
                <span>welcome, <?=$row['u_username']?></span>
                <a href="logout.php">Logut</a>
            </div>
        <?php endif;?>
    </header>

</body>