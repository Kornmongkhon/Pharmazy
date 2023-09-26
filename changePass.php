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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="style/user/changePass.js"></script>
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
            <div class="title">Mentos Change Password</div>
            <?php if(isset($_SESSION['success_updated_pass'])):?>
                    <?php
                        echo "<script>";
                        echo "Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Update Password Successfully!',
                            showConfirmButton: false,
                            timer: 2000
                        })";
                        echo "</script>";
                        // echo $_SESSION['success_updated_pass'];
                        unset($_SESSION['success_updated_pass']); // unset session when refresh
                    ?>
            <?php endif?> 
            <?php if(isset($_SESSION['error_updated_pass'])):?>
                    <?php
                        echo "<script>";
                        echo "Swal.fire({
                            icon: 'error',
                            title: 'Sorry :(',
                            text: 'Failed to update password!',
                            confirmButtonColor: '#3085d6'
                          })";
                        echo "</script>";
                        // echo $_SESSION['error_updated_pass'];
                        unset($_SESSION['error_updated_pass']); // unset session when refresh
                    ?>
            <?php endif?> 
            <?php if(isset($_SESSION['error_currentpass'])):?>
                    <?php
                        echo "<script>";
                        echo "Swal.fire({
                            icon: 'error',
                            title: 'Sorry :(',
                            text: 'Current password not match in data!',
                            confirmButtonColor: '#3085d6'
                          })";
                        echo "</script>";
                        // echo $_SESSION['error_currentpass'];
                        unset($_SESSION['error_currentpass']); // unset session when refresh
                    ?>
            <?php endif?> 
            <div class="user-details">
                <div class="form-outline mb-3 inputbox" style="display: none;">
                    <label for="uid" class="form-label">Username ID</label>
                    <input type="text" class="form-control" name="uid" aria-describedby="uid" readonly value="<?= $row['uid'] ?>">
                </div>
                <div class="form-outline mb-3 currentpass">
                    <label for="u_password" class="form-label">Current Password</label>
                    <div id="showPass">
                        <input type="password" class="form-control" name="u_password" id="u_password" placeholder="Enter your current password">
                        <div class="field-icon">
                            <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
                <div class="form-outline mb-3 inputbox">
                    <label for="n_password" class="form-label">New Password</label>
                    <div id="showNewPass">
                        <input type="password" class="form-control" name="n_password" id="n_password" placeholder="Enter your new password">
                        <div class="field-icon">
                            <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
                <div class="form-outline mb-3 inputbox">
                    <label for="c_password" class="form-label">Confirm New Password</label>
                    <div id="showNewCPass">
                        <input type="password" class="form-control" name="n_password" id="c_password" placeholder="Enter your confirm new password">
                        <div class="field-icon">
                            <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" name="u_updatepassword" id="updatepass" class="btn btn-primary btn-lg mb-3" style="width: 80%;margin-left: auto;margin-right: auto;">Confirm</button>
        </form>
    </div>
</body>

</html>