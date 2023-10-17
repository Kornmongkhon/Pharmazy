<?php
include("include/functions.php");
include("include/head.php");
if(isset($_GET['pid'])){
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
        function Check(pid,pname,price){
            let q = document.getElementById("quan").value
            if(q<=0){
                alert("สินค้าที่จะเพิ่มต้องไม่เป็น 0");
            }else{
                location = "cartAdd.php?action=add&pid="+pid+"&pname="+pname+"&price="+price+"&quan="+q
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
                                <span><?=$row['pname']?></span>
                            </article>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <aside>
            <div class="container" style="margin-top: 2rem;">
                <?php
                    // Remove the '../' part from the stored avatar path
                    $relativePhotoPath = str_replace('../', '', $row['pimg']);
                    // echo $relativeAvatarPath;
                    // var_dump($relativeAvatarPath); //check path
                ?>
                <img src="<?=$relativePhotoPath?>" width="100" height="100">
                <p><?=$row['pname']?></p>
                <p>รายละเอียดสินค้า</p>
                <p style="opacity: 0.5;"><?=$row['pdetail']?></p>
                <p><span>ราคา : </span><?=number_format($row['price'],2)?> ฿</p>
                <div style="margin-bottom: 2rem;"><input type="text" name="pquan_stock" value="<?=$row['pquan_stock']?>"></div>
                <input type="number" id="quan" name="quan" value="0">

                <!-- เพิ่มปุ่มชำระเงินเลย -->
                <div><button type="submit" onclick="Check('<?=$pid?>','<?=$row['pname']?>','<?=$row['price']?>')" name="add" value="เพิ่มลงตะกร้า" style="text-decoration: none;background-color: rgba(20,172,204,1);padding: 0.7rem;border-radius: 10px;color:white;">เพิ่มลงตะกร้า</button> 
                <!-- <span><a href="#" style="text-decoration: none;background-color: rgba(20,172,204,1);padding: 0.7rem;border-radius: 10px;color:white;">ชำระเงิน</a></span> 
                <span><a href="#"style="text-decoration: none;background-color: rgba(20,172,204,1);padding: 0.7rem;border-radius: 10px;color:white;">เพิ่มลงตะกร้า</a></span> -->
                <span><i class="fa-regular fa-heart" style="background-color: rgba(20,172,204,1);padding: 0.7rem;border-radius: 10px;"></i></span>
            </div>
        </aside>
    </main>
</body>