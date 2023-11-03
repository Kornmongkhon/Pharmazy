<?php
include("include/functions.php");
include("include/head.php");
if (isset($_GET['pid'])) {
    $pid = $_GET['pid'];
}
if (!isset($_POST['product']) || !isset($_POST['pid'])) {
    header("location: store.php");
} else {
    $pid = $_POST['product']; //get value from button name product (value is pid)
}
?>

<head>
    <link href="style/store/product.css" rel="stylesheet">
    <script>
        function Check(pid, pname, price, pimg) {
            let create = document.getElementById("error-message");
            let q = parseInt(document.getElementById("quan").value);
            let qrecent = parseInt(document.getElementById("quanrecent").value);
            let add = document.getElementById("addtext");


            if (q <= 0) {
                if (!create) {
                    create = document.createElement("h6");
                    create.id = "error-message";
                    add.appendChild(create);
                }
                create.innerHTML = "สินค้าต้องมีค่าเป็น 1 ขึ้นไป";

            } else {
                if (create) {
                    // Remove the error message if it exists
                    create.remove();
                }
                if (q > qrecent) {
                    Swal.fire({
                        icon: 'error',
                        title: 'ล้มเหลว',
                        text: 'สินค้าที่เลือกจำนวนเกินกับสินค้าที่มีอยู่',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'ตกลง'
                    })
                    console.log(q,qrecent)
                } else {
                    location = "cartAdd.php?action=add&pid=" + pid + "&pname=" + pname + "&price=" + price + "&quan=" + q + "&pimg=" + pimg;
                }
            }
        }

        function like() {
            let likeIcon = document.getElementById('like-icon');
            let plike = document.getElementById('plike').value;
            let pid = document.getElementById('pid').value;
            if (likeIcon.classList.contains('fa-regular')) { //method .contains to check class in <i></i> if have fa-regular is true
                likeIcon.classList.remove('fa-regular');
                likeIcon.classList.add("fa-solid");
                likeIcon.classList.add("fa-heart");
                let url = 'include/addlike.php?pid=' + pid + '&plike=' + plike;
                request = new XMLHttpRequest();
                request.open('GET', url);
                request.send();
            } else {
                likeIcon.classList.remove("fa-solid");
                likeIcon.classList.remove("fa-heart");
                likeIcon.classList.add("fa-regular");
                likeIcon.classList.add("fa-heart");
                let url = 'include/addlike.php?pid=' + pid + '&plikeminus=' + plike;
                request = new XMLHttpRequest();
                request.open('GET', url);
                request.send();

            }
            request.onreadystatechange = function() {
                if (request.readyState == 4 && request.status == 200) {
                    document.getElementById('notification').innerHTML = request.responseText;
                }
            }
        }
    </script>
</head>

<body>
    <header>
        <?php include("include/header.php"); ?>
    </header>
    <main>
        <?php
        $show_product = $pdo->prepare("SELECT * FROM product WHERE pid = :pid");
        $show_product->bindParam(":pid", $pid);
        $show_product->execute();
        $row = $show_product->fetch(PDO::FETCH_ASSOC);
        ?>
        <section>
            <div class="bg-light py-3">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 mb-0 color1">
                            <article style="display: flex;justify-content: center;align-items: center;">
                                <a href="index.php" class="changec">หน้าหลัก</a> <span class="mx-2 mb-0">/</span>
                                <a href="store.php" class="changec">รายการสินค้า</a> <span class="mx-2 mb-0">/</span>
                                <span><?= $row['pname'] ?></span>
                            </article>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <aside>
            <section class="hero ">
                <div class="container1 card">
                    <div class="hero-con">
                        <div class="hero-info">
                            <h3><?= $row['pname'] ?></h3>
                            <h4>รายละเอียดสินค้า</h4>
                            <h6>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $row['pdetail'] ?></h6>
                            <p><span>ราคา : </span><?= number_format($row['price'], 2) ?> ฿</p>
                            <p><span>จำนวนในสต๊อก : </span><?= $row['pquan_stock'] ?> </p>
                            <input type="hidden" id="quanrecent" value="<?= $row['pquan_stock'] ?>">
                            <input type="number" class="form-control" id="quan" name="quan" value="0">

                            <div id="addtext"></div>
                            <div id="notification" style="display: none;"></div>
                            <br>
                            <span>
                                <button type="submit" class="btn" onclick="Check('<?= $pid ?>','<?= $row['pname'] ?>','<?= $row['price'] ?>','<?= $row['pimg'] ?>')" name="add" style="text-decoration: none;background-color: rgba(20,172,204,1);padding: 0.7rem;border-radius: 10px;color:white;width:7rem">ชำระเงิน</button>
                                <button type="submit" class="btn" onclick="Check('<?= $pid ?>','<?= $row['pname'] ?>','<?= $row['price'] ?>','<?= $row['pimg'] ?>')" name="add" style="text-decoration: none;background-color: rgba(20,172,204,1);padding: 0.7rem;border-radius: 10px;color:white;">เพิ่มลงตะกร้า</button>
                                <input type="hidden" name="plike" id="plike" value="<?= $row['plike'] ?>">
                                <input type="hidden" name="pid" id="pid" value="<?= $pid ?>">
                                <button class="btn" style="background-color: rgba(20,172,204,1);padding: 0.7rem 2.5rem;border-radius: 10px;" onclick="like()"><i id="like-icon" class="fa-regular fa-heart"></i></button>
                            </span>
                        </div>
                        <div class="hero-img">
                            <?php
                                $relativePhotoPath = str_replace('../', '', $row['pimg']);
                            ?>
                            <img src="<?= $relativePhotoPath?>" width="350" height="400">
                        </div>
                    </div>
                </div>
            </section>
        </aside>
    </main>
</body>