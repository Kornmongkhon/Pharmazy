<?php
include('functions.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("UPDATE `product` SET `pname`=?,`pdetail`=?,`price`=?,`ptype`=?,`plike`=?,`pquan_stock`=? WHERE pid = ?");
    $stmt->bindParam(1,$_POST['pname']);
    $stmt->bindParam(2,$_POST['pdetail']);
    $stmt->bindParam(3,$_POST['price']);
    $stmt->bindParam(4,$_POST['ptype']);
    $stmt->bindParam(5,$_POST['plike']);
    $stmt->bindParam(6,$_POST['pquan_stock']);
    $stmt->bindParam(7,$_POST['pid']);
    $stmt->execute();

    //responseText for update product
    echo "Updated.";
}
?>