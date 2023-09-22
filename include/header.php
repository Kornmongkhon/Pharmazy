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
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php"><img class="logo" src="assets/images/mentoslogo.png" style="width: 400px;height:120px;"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Category
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item drop" href="#">Action</a></li>
                    <li><a class="dropdown-item drop" href="#">Another action</a></li>
                    <li><a class="dropdown-item drop" href="#">Another action</a></li>
                </ul>
                </li>
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Promotions</a>
                </li>
            </ul>
            <form class="d-flex p-3 w-50">
                <input class="form-control me-2 wd" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
            <?php if(!isset($_SESSION['user_login'])):?>
                    <a class="btn btn-outline-success" style="margin-right: 15px;" href="login.php">Login</a>
                    <a class="btn btn-outline-success" style="margin-right: 15px;" href="Register.php">Register</a>
            <?php endif;?>
            <?php if(isset($_SESSION['user_login'])):?>
                <?php
                    $showName = $pdo->prepare("SELECT * FROM users");
                    $showName->execute();
                    $row = $showName->fetch(PDO::FETCH_ASSOC);
                ?>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown" style="margin-right: 15px;">
                        <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Welcome, <?=$row['u_username']?>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item drop" href="#">Profile</a></li>
                            <li><a class="dropdown-item drop" href="#">Carts</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item drop" href="logout.php">Logout</a></li>
                        </ul>
                    </li>
                </ul>     
            <?php endif;?>
            </div>
        </div>
    </nav>
</body>