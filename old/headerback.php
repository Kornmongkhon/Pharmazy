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
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
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
            <!-- <div class='button'>
                <span>welcome, <?=$row['u_username']?></span>
                <a href="logout.php">Logut</a>
            </div> -->
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    Welcome, <?=$row['u_username']?>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    <li><a class="dropdown-item" href="#">Cart</a></li>
                    <li><a class="dropdown-item" href="#">Logout</a></li>
                </ul>
            </div>
        <?php endif;?>
    </header>

</body>