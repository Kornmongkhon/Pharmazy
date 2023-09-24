<?php
    // error_reporting(E_ALL);
    // ini_set('display_errors', 1);
    include('include/functions.php');
    include('include/head.php');
    if (!isset($_GET['uid'])) { //check session user login
        header("location: index.php");
    }
?>
<head>
    <link rel="stylesheet" href="style/user/changePass.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div>
        <?php
        include('include\header.php');
        ?>
    </div>
    <?php
    $stmt = $pdo->prepare("SELECT * FROM users WHERE uid = :uid");
    $stmt->bindParam(":uid", $_GET['uid']);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $avatarName = $row['avatar'];
    $webAccesspath = 'assets/avatar/'.$avatarName;
    ?>
    <div class="container">
        <form class="card login-card-custom" action="include/updatepassword.php" method="post">
            <div class="title">Mentos Reset Password</div>
            <div class="user-details">
                <div class="form-outline mb-3 inputbox" style="display: none;">
                    <label for="uid" class="form-label">Username ID</label>
                    <input type="text" class="form-control" name="uid" aria-describedby="uid" readonly value="<?= $row['uid'] ?>">
                </div>
                <div class="form-outline mb-3 currentpass">
                    <label for="u_password" class="form-label">Current Password</label>
                    <input type="password" class="form-control" name="u_password" placeholder="Enter your current password">
                </div>
                <div class="form-outline mb-3 inputbox">
                    <label for="n_password" class="form-label">New Password</label>
                    <input type="password" class="form-control" name="n_password" placeholder="Enter your new password">
                </div>
                <div class="form-outline mb-3 inputbox">
                    <label for="cn_password" class="form-label">Confirm New Password</label>
                    <input type="password" class="form-control" name="cn_password" placeholder="Confirm your current password">
                </div>
            </div>
            <button type="submit" name="u_updatepassword" class="btn btn-primary btn-lg mb-3" style="width: 80%;margin-left: auto;margin-right: auto;">Confirm</button>
        </form>
    </div>
</body>

</html>