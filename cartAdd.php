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


    $pid = $_GET["pid"];
    // echo $_GET["pname"];
    $item = array(
        'pid' => $pid,
        'pname' => $_GET['pname'],
        'price' => $_GET['price'],
        'quan' => $_GET['quan'],
        'pimg' => $_GET['pimg']
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
    <link href="style/store/cart.css" rel="stylesheet">
</head>

<body>
    <main class="container" style="margin-top: 2rem;">
        <form method="post" action="confirmOrder.php" onsubmit="return confirmOrder();">
            <table class="table table-bordered text-center">
                <thead class="table-dark text-center mx-auto">
                    <tr>
                        <th>ลำดับที่</th>
                        <th>รูปสินค้า</th>
                        <th>ชื่อสินค้า</th>
                        <th>จำนวน</th>
                        <th>ราคาชิ้นละ</th>
                        <th>ราคาทั้งสิ้น</th>
                    </tr>
                </thead>
                <?php if (!isset($_SESSION['user_login'])) : ?>
                    <script>
                        Swal.fire({
                            title: 'ล้มเหลว',
                            icon: 'error',
                            text: 'กรุณาเข้าสู่ระบบก่อน',
                            timer: 3500,
                            showConfirmButton: false,
                            timerProgressBar: true
                        }).then(function() {
                            location.href = 'login.php';
                        }, 2000)
                    </script>
                <?php else : ?>
                    <?php
                    $sum = 0;
                    $count = 0;
                    foreach ($_SESSION['cart'] as $item) {
                        $count += 1;
                        $sum += $item["price"] * $item["quan"];
                    ?>
                        <tbody>
                            <?php
                            // Remove the '../' part from the stored avatar path
                            $relativePhotoPath = str_replace('../', '', $item['pimg']);
                            ?>
                            <tr>
                                <td style="padding: 1rem;"><?= $count ?></td>
                                <td><img src="<?= $relativePhotoPath ?>" width="50" height="50"></td>
                                <td style="padding: 1rem;">
                                    <a href="product.php?pid=<?= $item["pid"] ?>"><?= $item["pname"] ?></a>
                                </td>
                                <td style="padding: 1rem;">
                                    <input type="number" class="form-control" style="width: 5rem;margin: 0 auto;" id="<?= $item["pid"] ?>" value="<?= $item["quan"] ?>" min="1" onblur="update(<?= $item['pid'] ?>,'<?= $relativePhotoPath ?>')">
                                </td>
                                <td style="padding: 1rem;"><?= number_format($item["price"], 2) ?> บาท</td>
                                <td style="padding: 1rem;">
                                    <?= number_format($item["price"] * $item["quan"], 2) ?> บาท
                                    <a href="?action=delete&pid=<?= $item["pid"] ?>"><i class="fa-solid fa-xmark text-danger"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    <?php } ?>
                    <tfoot>
                        <?php if (isset($item['pid'])) : ?>
                            <tr>
                                <td colspan="6" align="right">
                                    <article class="ship-type">
                                        <aside>
                                            การจัดส่ง : 
                                        </aside>
                                        <section>
                                            <select class="form-control">
                                                <option value="">กรุณาเลือกการจัดส่ง</option>
                                                <option value="flash">Flash Express</option>
                                                <option value="kery">Kery Express</option>
                                            </select>
                                        </section>
                                        
                                    </article>         
                                </td>
                            </tr>
                        <?php endif; ?>
                        <tr>
                            <td colspan="6" align="right">รวม <?= number_format($sum, 2) ?> บาท</td>
                        </tr>
                    </tfoot>
                <?php endif; ?>
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
    function update(pid, pimg) {
        var qty = document.getElementById(pid).value;
        if (qty === '' || qty === 0) {
            qty = 1
            document.location = "cartAdd.php?action=update&pid=" + pid + "&quan=" + qty + "&pimg=" + pimg;
        } else {
            // ส่งรหัสสินค้า และจำนวนไปปรับปรุงใน session
            document.location = "cartAdd.php?action=update&pid=" + pid + "&quan=" + qty + "&pimg=" + pimg;
        }

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