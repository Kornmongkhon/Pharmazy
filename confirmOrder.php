<?php
session_start();
include("include/functions.php");
// include("include/head.php");
// echo "TEST";
if (isset($_POST['submit_button'])){
    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])){
        try{
            $sum = $_POST["sum"];
            $status = "ยังไม่จ่าย";
            if (isset($_SESSION['cart']) && is_array($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
                $firstPid = reset($_SESSION['cart'])['pname'];
            }
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
                $insertOrderDetail->execute();
            }
            $_SESSION['cart'] = array(); ?>
          
          <script>
            alert("FIN")
          </script>
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


</body>
</html>