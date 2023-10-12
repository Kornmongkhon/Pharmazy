<?php
    include("include/functions.php");
?>
<body>
    <header class="mb-5">
        <?php include("include/header.php");?>
    </header>
    <main>
        <?php 
            $stmt = $pdo->prepare("SELECT DATE_FORMAT(orders.order_date + INTERVAL 543 YEAR, '%d/%m/%Y') AS order_date, users.u_username, product.pname, orders.order_quantity ,SUM(orders.order_quantity * product.price) AS sum_price FROM orders JOIN product ON orders.pid = product.pid JOIN users ON orders.uid = users.uid GROUP BY orders.order_date,u_username ORDER BY orders.order_date;");
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
                                <th>ชื่อผู้ใช้</th>
                                <th>ชื่อสินค้า</th>
                                <th>จำนวน</th>
                                <th>ราคารวม</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $stmt->fetch()) : ?>
                                <tr style="align-items: center;text-align: center;">
                                    <td><?= $row['order_date'] ?></td>
                                    <td><?= $row['u_username'] ?></td>
                                    <td><?=$row['pname']?></td>
                                    <td><?=$row['order_quantity']?></td>
                                    <td><?= $row['sum_price'] ?> ฿</td>
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