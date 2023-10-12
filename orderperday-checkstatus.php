<?php
    include("include/functions.php");
?>
<body>
    <header class="mb-5">
        <?php include("include/header.php");?>
    </header>
    <main>
        <?php 
            $stmt = $pdo->prepare("SELECT DATE_FORMAT(orders.order_date + INTERVAL 543 YEAR, '%d/%m/%Y') AS order_date, orders.order_id, users.u_username, orders.order_status FROM users JOIN orders ON users.uid = orders.uid GROUP BY orders.order_date,orders.order_status;");
            $stmt->execute();
        ?>
        <div class="container">
            <form class="card login-card-custom table-responsive-md" method="post">
                <div style="font-size: 30px;font-weight: 800;margin-left: auto;margin-right: auto;padding: 15px;">สรุปรายการ</div>
                <section class="mb-3" style="font-size: 22px;font-weight: 500;margin-left: 2rem;">การสั่งซื้อรายวัน</section>
                <article class="user-details">
                    <table class="table" >
                        <thead class="table-info">
                            <tr style="align-items: center;text-align: center;">
                                <th>วันและเวลา</th>
                                <th>รายการคำสั่งซื้อ</th>
                                <th>ชื่อผู้ใช้</th>
                                <th>สถานะ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $stmt->fetch()) : ?>
                                <tr style="align-items: center;text-align: center;">
                                    <td><?= $row['order_date'] ?></td>
                                    <td><?= $row['order_id'] ?></td>
                                    <td><?=$row['u_username']?></td>
                                    <?php if($row['order_status'] == 'wait'):?>
                                        <td>ยังไม่ได้ชำระเงิน</td>
                                    <?php elseif($row['order_status'] == 'paid'):?>
                                        <td>ชำระเงินแล้ว</td>
                                    <?php endif;?>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </article>
            </form>
        </div>
    </main>
</body>
</html>