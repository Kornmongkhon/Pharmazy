<?php
session_start();
include('..\include\head.php');
include('include\functions.php');
if (!isset($_SESSION['admin_login'])) {
    echo "false";
    header("location: login.php");
}
?>

<head>
    <link rel="stylesheet" href="style/admin/admin.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>

<body>
    <?php include("include/sidebar.php"); ?>
    <?php if (isset($_SESSION['admin_login'])) : ?>
        <?php
        $stmt = $pdo->prepare("SELECT * FROM users WHERE urole = 'user'");
        $stmt->execute();
        ?>
        <div class="container">
            <form class="card login-card-custom  table-responsive-md" method="post">
                <div class="title">Admin Mentos Page</div>
                <section>User information</section>
                <article class="user-details">
                    <table class="table">
                        <thead class="table-info">
                            <tr style="align-items: center;text-align: center;">
                                <th>User ID</th>
                                <th>Profile</th>
                                <th>Username</th>
                                <th class="col-1">Full Name</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Phone</th>
                                <th>Gender</th>
                                <th>Role</th>
                                <th>Create At</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $stmt->fetch()) : ?>
                                <?php
                                $relativeAvatarPath = str_replace('../', '', $row['avatar']);
                                ?>
                                <tr style="align-items: center;text-align: center;">
                                    <td><?= $row['uid'] ?></td>
                                    <td><img src="../<?= $relativeAvatarPath ?>" width="50" height="50" class="rounded-circle"></td>
                                    <td><?= $row['u_username'] ?></td>
                                    <td><?= $row['u_name'] ?></td>
                                    <td><?= $row['email'] ?></td>
                                    <td><?= $row['address'] ?></td>
                                    <td><?= $row['phone'] ?></td>
                                    <td><?php if ($row['gender'] == 'male') : ?>
                                            ชาย
                                        <?php elseif ($row['gender'] == 'female') : ?>
                                            หญิง
                                        <?php endif; ?>
                                    </td>
                                    <td><?= $row['urole'] ?></td>
                                    <td><?= $row['create_at'] ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </article>
                <a href="include/logout_admin.php">Log out</a>
            </form>
        </div>
    <?php endif; ?>
</body>

</html>