<?php 
    include('include/functions.php');
    include('include/header.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style\cart\payment.css">
    <style>
        h1{
            text-align: center;
        }
        table, th, td {
    border: 1px solid;
}
    </style>
</head>
<body>
    <h1>ประวัติการสั่งซื้อ</h1>
    <?php
    $uid = $_SESSION["user_login"];
        $stmt=$pdo->prepare("SELECT DISTINCT orders.ordID,orders.ordName,orders.amount FROM orders JOIN order_detail on orders.ordID=order_detail.ordID WHERE uid = ? AND status='wait'");
        $stmt->bindParam(1,$uid);
        $stmt->execute();?>
        <table>
            <tr>
                <td>ลำดับที่</td>
                <td>ชื่อสินค้า</td>
                <td>ราคาที่ต้องชำระ</td>
            </tr>
            <?php $count=1; while($row=$stmt->fetch()): ?>
            <tr>
                <th><?=$count?></th>
                <th><?=$row['ordName']?></th>
                <th><?=number_format($row['amount'],2)?> บาท</th>
            </tr>
            <?php $count++; endwhile;?>
        </table>
    
</body>
</html>