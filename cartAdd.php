<?php
include("include/head.php");
include("include/header.php");
include("include/functions.php");

$pageWasRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0';
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

if ($pageWasRefreshed) {
} else if (isset($_GET["action"]) && $_GET["action"] == 'add') {

    if(isset($_GET['pimg'])){
        $pimg = $_GET['pimg'];
    }
    $pid = $_GET["pid"];
    // echo $_GET["pname"];
    $item = array(
        'pid' => $pid,
        'pname' => $_GET['pname'],
        'price' => $_GET['price'],
        'quan' => $_GET['quan'],
        'pimg' => $pimg
    );
    if (array_key_exists($pid, $_SESSION['cart'])) {
        $_SESSION['cart'][$pid]['quan'] += $_GET['quan'];
    } else {
        $_SESSION['cart'][$pid] = $item;
    }
} else if (isset($_GET["action"]) && $_GET["action"] == "update") {
    if ($_GET["quan"] == 0) {
        $pid = $_GET['pid'];
        unset($_SESSION['cart'][$pid]);
    } else {
        $pid = $_GET["pid"];
        $qty = $_GET["quan"];
        $_SESSION['cart'][$pid]['quan'] = $qty;
    }


    // ลบสินค้า
} else if (isset($_GET["action"]) && $_GET["action"] == "delete") {

    $pid = $_GET['pid'];
    unset($_SESSION['cart'][$pid]);
}
?>



<head>

    
</head>

<body>
    <main class="container" style="margin-top: 2rem;">
        <form method="post" action="confirmOrder.php" onsubmit="return confirmOrder();">
            <table class="table table-bordered">
                <thead class="thead-dark text-center mx-auto">
                    <tr>
                        <th>ลำดับที่</th>
                        <th>รูปสินค้า</th>
                        <th>ชื่อสินค้า</th>
                        <th>จำนวน</th>
                        <th>ราคาชิ้นละ</th>
                        <th>ราคาทั้งสิ้น</th>
                    </tr>
                </thead>
                <?php
                $sum = 0;
                $count = 0;
                foreach ($_SESSION['cart'] as $item) {
                    $count += 1;
                    $sum += $item["price"] * $item["quan"];
                ?>
                    <tbody class="text-center mx-auto">
                        <?php
                        // Remove the '../' part from the stored avatar path
                        $relativePhotoPath = str_replace('../', '', $_GET['pimg']);
                        ?>
                        <tr >
                            <td style="padding: 1rem;"><?= $count ?></td>
                            <td ><img src="<?= $relativePhotoPath?>" width="50" height="50"></td>
                            <td style="padding: 1rem;">
                                <a href="product.php?pid=<?= $item["pid"] ?>"><?= $item["pname"] ?></a>
                            </td>
                            <td style="padding: 1rem;">
                                <input type="number" id="<?= $item["pid"] ?>" value="<?= $item["quan"] ?>" min="1" max="9">
                                <a href="#" onclick="update(<?= $item['pid'] ?>,'<?= $relativePhotoPath ?>')">แก้ไข</a>
                            </td>
                            <td style="padding: 1rem;"><?= number_format($item["price"],2) ?></td>
                            <td style="padding: 1rem;">
                                <?= $item["price"] * $item["quan"] ?>

                                <a href="?action=delete&pid=<?= $item["pid"] ?>">ลบ</a>
                            </td>
                        </tr>
                    </tbody>
                <?php } ?>
                <tfoot>
                    <tr>
                        <td colspan="6" align="right">รวม <?= number_format($sum,2) ?> บาท</td>
                    </tr>
                </tfoot>
            </table>
            <input id="sum" type="hidden" value="<?= $sum ?>" name="sum">
            <div id="addtext"></div>
            <input type="submit" name="submit_button" value="ORDER" class="btn btn-info">
        </form>

        <a href="store.php"><- เลือกสินค้าต่อ</a>

                <!-- <form method="post" action="cartAdd.php?action=orders">
        
    </form> -->
    </main>
</body>

</html>
<script>
    function update(pid,pimg) {
        var qty = document.getElementById(pid).value;
        // ส่งรหัสสินค้า และจำนวนไปปรับปรุงใน session
        document.location = "cartAdd.php?action=update&pid=" + pid + "&quan=" + qty + "&pimg=" + pimg;
    }

    function confirmOrder() {
        let create = document.getElementById("error-message");
        let sum = document.getElementById("sum").value;
        let add = document.getElementById("addtext");

        if (sum <= 0) {
            if (!create) {
                create = document.createElement("h1");
                create.id = "error-message";
                add.appendChild(create);
            }
            create.innerHTML = "กรุณาเพิ่มสินค้าลงตะกร้าก่อน";
            return false;
        } else {
            if (confirm("Are you sure you want to place the order?")) {
                return true; // Continue with form submission
            } else {
                return false; // Cancel form submission
            }
        }
    }
</script>