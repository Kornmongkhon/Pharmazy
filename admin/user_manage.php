<?php
include('..\include\head.php');
include('include\functions.php');
session_start();
if (!isset($_SESSION['admin_login'])) {
    header("location: ../index.php");
}
?>

<head>
    <link rel="stylesheet" href="style/admin/admin.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link href="https:////cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">
</head>
<body>
    <?php 
        $stmt = $pdo->prepare("SELECT * FROM users WHERE uid = ?");
        $stmt->bindParam(1,$_SESSION['admin_login']);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    ?>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar Starts here -->
        <div class="bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase">
                <i class="fa-solid fa-user-secret"></i> Admin Mentos <!-- Sidebar Header -->
            </div>
            <div class="list-group list-group-flush my-3">
            <ul class="sidebar-nav">
                    <li class="sidebar-item">
                        <a href="admin.php" class="sidebar-link">
                        <i class="fas fa-tachometer-alt me-2"></i>
                            <span style="margin-left: .1rem;">Dashboard</span>
                        </a>
                        <hr>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse" data-bs-target="#pages"
                            aria-expanded="false" aria-controls="pages">
                            <i class="fa-solid fa-store"></i>
                            <span style="margin-left: .5rem;">Store</span>
                        </a>
                        <ul id="pages" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item" style="margin-top: 1.1rem;">
                                <a href="product.php" class="sidebar-link">Products</a>
                            </li>
                        </ul>
                        <hr>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse" data-bs-target="#auth"
                            aria-expanded="false" aria-controls="auth">
                            <i class="fa-regular fa-user pe-2"></i>
                            Users
                        </a>
                        <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item" style="margin-top: 1.1rem;">
                                <a href="user_manage.php" class="sidebar-link">User Management</a>
                            </li>
                            <li class="sidebar-item" style="margin-top: 1.1rem;">
                                <a href="admin_manage.php" class="sidebar-link">Admin Management</a>
                            </li>
                        </ul>
                        <hr>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Sidebar Ends here -->

        <div class="page-content-wrapper" style="width: 100%;">
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <!-- icon bar -->
                    <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
                    <h2 class="fs-2 m-0"><a href="admin.php" style="text-decoration: none;color: #24252A;">Users</a> / User Management</h2>
                </div>
                <!-- button for dropdown admin info -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle second-text fw-bold" href="#" id="navbarDropdown"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user me-2"></i><?=$row['u_name']?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#">Profile</a></li>
                                <li><a class="dropdown-item" href="#">Settings</a></li>
                                <li><a class="dropdown-item" href="include/logout_admin.php">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
            <hr>
            <div class="container-fluid px-4">
                <div class="row my-5">
                    <h3 class="fs-4 mb-3">รายชื่อสมาชิก</h3>
                    <div class="col">
                        <?php
                            $stmt = $pdo->prepare("SELECT * FROM users WHERE users.urole = 'user';");
                            $stmt->execute();
                        ?>
                        <table id="OrderTable" class="table table-responsive-md">
                            <thead class="table-info">
                                <tr>
                                    <th style="text-align: center;">ID</th>
                                    <th style="text-align: center;">โปรไฟล์</th>
                                    <th style="text-align: center;">ชื่อผู้ใช้</th>
                                    <th style="text-align: center;">ชื่อ - นามสกุล</th>
                                    <th style="text-align: center;">อีเมล์</th>
                                    <th style="text-align: center;">ที่อยู่</th>
                                    <th style="text-align: center;">เบอร์โทรศัพท์</th>
                                    <th style="text-align: center;">เพศ</th>
                                    <th style="text-align: center;">วันที่สร้างบัญชี</th>
                                    <th style="text-align: center;">การจัดการ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)):?>
                                    <?php
                                        $relativeAvatarPath = str_replace('../', '', $row['avatar']);
                                    ?>
                                    <tr style="text-align: center;">
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
                                    <td><?= $row['create_at'] ?></td>
                                    <td>
                                        <!-- <a href="#" class="btn btn-warning">แก้ไข</a> <a href="#" class="btn btn-danger">ลบ</a> -->
                                        <div style="display: flex;justify-content: center;align-items: center">
                                            <form style="margin-right: .6rem;" method="post" action=""><button type="submit" class="btn btn-warning">แก้ไข</button></form>
                                            <form style="margin-right: .6rem;" method="post" action=""><button type="submit" class="btn btn-danger">ลบ</button></form>
                                        </div>
                                    </td>
                                    </tr>
                                <?php endwhile;?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /#page-content-wrapper -->
    </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="style/sidebar/sidebar.js"></script>
    <script>
        let table = new DataTable('#OrderTable');
    </script>
</body>

</html>