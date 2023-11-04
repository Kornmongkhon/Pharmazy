<?php
session_start();
include('include/head.php');
include("include/functions.php");
// include("include/head.php");
// echo "TEST";
if (isset($_POST['submit_button'])){
    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])){
        try{
            $sum = $_POST["total_sum"];
            $status = "wait";
            $ship = 'wait for payment';
            
            
            $countOrders = $pdo->prepare("SELECT COUNT(*) as order_count FROM orders");
            $countOrders->execute();
            $orderCount = $countOrders->fetchColumn();
            $orderNo = $orderCount + 1; // Increment the last order number
            $firstPid = 'Order#'.$orderNo;
            $addOrder = $pdo->prepare("INSERT INTO orders (ordName,status,amount) VALUES (?,?,?)");
            $addOrder->bindParam(1,$firstPid);
            $addOrder->bindParam(2,$status);
            $addOrder->bindParam(3,$sum);
            $addOrder->execute();
            $orderId = $pdo->lastInsertId();
            foreach ($_SESSION['cart'] as $item) {
                $uid = $_SESSION["user_login"];
                $qty = $item['quan'];
                $pid = $item['pid'];

                $insertOrderDetail = $pdo->prepare("INSERT INTO order_detail (uid, qty, ordID, pid) VALUES (?, ?, ?, ?)");
                $insertOrderDetail->bindParam(1,$uid);
                $insertOrderDetail->bindParam(2,$qty);
                $insertOrderDetail->bindParam(3,$orderId);
                $insertOrderDetail->bindParam(4,$pid);
                if($insertOrderDetail->execute()){
                    $stmt = $pdo->prepare("SELECT pquan_stock FROM product WHERE pid = ?");
                    $stmt->bindParam(1,$pid);
                    $stmt->execute();
                    $stock = $stmt->fetch(PDO::FETCH_ASSOC);
                    $update_stock = $stock['pquan_stock'] - $qty;
                    $new_stock = $pdo->prepare("UPDATE product SET pquan_stock = ? WHERE pid = ?");
                    $new_stock->bindParam(1,$update_stock);
                    $new_stock->bindParam(2,$pid);
                    $new_stock->execute();
                    $insertDelivery = $pdo->prepare("INSERT INTO delivery (uid, ordID, delivery_type, delivery_price, delivery_status) VALUES(?, ?, ?, ?, ?)");
                }
            }
            $_SESSION['cart'] = array(); ?>
            <?php
            header("Location: cartAdd.php");
        }catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    else{
        header("Location: cartAdd.php");
    }
}
else{
    header("Location: cartAdd.php");
}
?>


<head>
    
</head>
<body>


</body>
</html>