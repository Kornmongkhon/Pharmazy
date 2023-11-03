<?php
    include('functions.php');
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $stmt = $pdo->prepare("SELECT * FROM orders WHERE ordID = ?");
        $stmt->bindParam(1,$_POST['ordID']);
        if($stmt->execute()){
            $showOrder = $pdo->prepare("SELECT orders.ordName, order_detail.ordDeID,product.pimg,product.pname,product.price,order_detail.qty,SUM(order_detail.qty*product.price) AS total_price FROM orders JOIN order_detail ON orders.ordID = order_detail.ordID JOIN product ON order_detail.pid = product.pid JOIN users ON users.uid = order_detail.uid WHERE order_detail.ordID = ? GROUP BY order_detail.ordDeID;");
            $showOrder->bindParam(1,$_POST['ordID']);
            $showOrder->execute();
        }
    }
?>
<div class="container">
        <?php 
            $row = $stmt->fetch();
        ?>
    <article style="display: flex;justify-content: space-between;margin: 2rem 0;">
        <aside style="">คำสั่งซื้อ <?=$row['ordName']?></aside>
        <button class="btn btn-danger btn-sm" id="closeOrder"><i class="fa-solid fa-xmark" id="closeOrder"></i></button>
    </article>
    <table class="table">
        <thead>
            <tr>
                <th>ลำดับที่</th>
                <th>รูปสินค้า</th>
                <th>ชื่อสินค้า</th>
                <th>ราคาสินค้า</th>
                <th>จำนวนที่ซื้อ</th>
                <th>ราคาทั้งสิ้น</th>
            </tr>
        </thead>
        <tbody>
            <?php $count = 1; while($orderList = $showOrder->fetch()):?>
            <?php
                $relativePhotoPath = str_replace('../', '', $orderList['pimg']);
            ?>
            <tr>
                <td><?=$count?></td>
                <td><img src="<?=$relativePhotoPath?>" width="70" height="70"></td>
                <td><?=$orderList['pname']?></td>
                <td><?=number_format($orderList['price'],2)?> บาท</td>
                <td><?=$orderList['qty']?></td>
                <td><?=number_format($orderList['total_price'],2)?> บาท</td>
            </tr>
            <?php $count++; endwhile;?>
        </tbody>
        <tfoot>
            
            <tr>
                <td colspan="6" align="right" style="padding-right: 2rem;">ยอดรวม : <?=number_format($row['amount'],2)?> บาท 
                    <span style="margin-left: 2rem;">สถานะ :
                        <?php if($row['status'] === 'wait'):?>
                            <span class="text-danger">ยังไม่ได้ชำระเงิน</span>
                        <?php elseif($row['status'] === 'paid'):?>
                            <span class="text-success">ชำระเงินแล้ว</span>
                        <?php endif;?>
                    </span>
                </td>
            </tr>
        </tfoot>
    </table>
</div>
