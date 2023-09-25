<?php
    // error_reporting(E_ALL);
    // ini_set('display_errors', 1);
    include('include/functions.php');
    include('include/head.php');
    if (!isset($_GET['uid'])) { //check session user login if don't have redirect to index
        header("location: index.php");
    }
?>

<head>
    <link rel="stylesheet" href="style/user/edituser.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="style/user/edituser.js"></script>
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
        <form class="card login-card-custom" action="include/updateinfo.php" method="post" enctype="multipart/form-data">
            <div class="title">Mentos Info</div>
            <?php if(isset($_SESSION['error_type'])):?>
                    <?php
                        echo "<script>";
                        echo "Swal.fire({
                            icon: 'error',
                            title: 'Sorry :(',
                            text: 'Invalid file type. Please upload a PNG,JPG,JPEG,GIF file.',
                            confirmButtonColor: '#3085d6'
                        })";
                        echo "</script>";
                        // echo $_SESSION['error_type'];
                        unset($_SESSION['error_type']); // unset session when refresh
                    ?>
            <?php endif?>
            <?php if(isset($_SESSION['error_upload'])):?>
                    <?php
                        echo "<script>";
                        echo "Swal.fire({
                            icon: 'error',
                            title: 'Sorry :(',
                            text: 'Failed to upload the avatar.',
                            confirmButtonColor: '#3085d6'
                        })";
                        echo "</script>";
                        
                        // echo $_SESSION['error_upload'];
                        unset($_SESSION['error_upload']); // unset session when refresh
                    ?>
            <?php endif?>
            <?php if(isset($_SESSION['error_updated'])):?>
                    <?php
                        echo "<script>";
                        echo "Swal.fire({
                            icon: 'error',
                            title: 'Sorry :(',
                            text: 'Failed to update user information.',
                            confirmButtonColor: '#3085d6'
                        })";
                        echo "</script>";
                        // echo $_SESSION['error_updated'];
                        unset($_SESSION['error_updated']); // unset session when refresh
                    ?>
            <?php endif?>  
            <?php if(isset($_SESSION['success_updated'])):?>
                    <?php
                        echo "<script>";
                        echo "Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Update Information Successfully!',
                            showConfirmButton: false,
                            timer: 2000
                        })";
                        echo "</script>";
                        // echo $_SESSION['success_updated'];
                        unset($_SESSION['success_updated']); // unset session when refresh
                    ?>
            <?php endif?>
            <div class="img-center">
                    <?php if(isset($_SESSION['updated_path'])):?>
                    <img src="<?=$row['avatar'] ?>" class="rounded-circle" height="100" alt="Avatar" loading="lazy" />
                    <?php else:?>
                        <?php
                        // Remove the '../' part from the stored avatar path
                        $relativeAvatarPath = str_replace('../', '', $row['avatar']);
                        // echo $relativeAvatarPath;
                        // var_dump($relativeAvatarPath); //check path
                        ?>
                        <img src="<?=$relativeAvatarPath ?>" class="rounded-circle" height="130" width="130" alt="Avatar" loading="lazy" />
                    <?php endif;?>
            </div>
            <div class="user-details">
                <div class="form-outline mb-3 inputbox" style="display: none;">
                    <label for="uid" class="form-label">Username ID</label>
                    <input type="text" class="form-control" name="uid" aria-describedby="uid" readonly value="<?= $row['uid'] ?>">
                </div>
                <div class="form-outline mb-3 inputbox">
                    <label for="u_username" class="form-label">Username</label>
                    <input type="text" class="form-control" name="u_username" aria-describedby="u_username" readonly value="<?= $row['u_username'] ?>">
                </div>
                <div class="form-outline mb-3 inputbox">
                    <label for="u_name" class="form-label">Full Name</label>
                    <input type="text" class="form-control" name="u_name" id="u_nameup" aria-describedby="u_name" placeholder="Enter your name" value="<?= $row['u_name'] ?>">
                </div>
                <div class="form-outline mb-3 inputbox">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" name="email" id="emailup" aria-describedby="email" placeholder="Enter your email" value="<?= $row['email'] ?>">
                </div>
                <div class="form-outline mb-3 inputbox">
                    <label for="address" class="form-label">Address</label>
                    <textarea class="form-control" name="address" id="addressup" aria-describedby="address" placeholder="Enter your address"><?= $row['address'] ?></textarea>
                </div>
                <div class="form-outline mb-3 inputbox">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="text" class="form-control" name="phone" id="phoneup" aria-describedby="phone" placeholder="Enter your phone number" value="<?= $row['phone'] ?>">
                </div>
                <div class="form-outline mb-3 inputbox">
                    <label label for="formFile" class="form-label">Avatar</label>
                    <input class="form-control" type="file" id="formFile" name="avatar" accept="images/gif, image/jpeg, image/jpg, image/png">
                </div>
                <!-- <div class="form-outline mb-3 inputbox">
                    <label for="u_password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="u_password" placeholder="Enter your password">
                </div> -->
            </div>
            <button type="submit" name="u_updateinfo" id="updateinfo" class="btn btn-primary btn-lg mb-3" style="width: 80%;margin-left: auto;margin-right: auto;">Confirm</button>
        </form>
    </div>
</body>

</html>