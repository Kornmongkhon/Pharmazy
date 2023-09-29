<?php
include('include\functions.php');
include('include\head.php');
$selectType = ''; //set type default to null
if (isset($_GET['ptype'])) {
    $selectType = $_GET['ptype'];//ptype from js
}
if (!empty($selectType) && $selectType !== "all") {//show protype from choosen type
    $stmtt = $pdo->prepare("SELECT * FROM product WHERE ptype = :ptype");
    $stmtt->bindParam(":ptype", $selectType);
} else {//value = all let ramdom product
    $stmtt = $pdo->prepare("SELECT * FROM product ORDER BY RAND()");
}
$stmtt->execute();
$count = 0;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="style/store/store.css">
    <script>
        function filterProduct() {
            let selected = document.getElementById("productTypeDropdown"); //id select
            let selectedType = selected.value; //get value from select attribute
            let filterForm = document.getElementById("filterForm"); // id form
            if(selectedType === 'all'){ //if value = all
                window.location.href = `store.php?ptype=all`;
            }else{
                window.location.href = `store.php?ptype=${selectedType}`;
            }
           
        }
    </script>
</head>

<body>
    <?php

    ?>
    <header>
        <?php include("include/header.php"); ?>
    </header>
    <main>
        <section>
            <div class="bg-light py-3">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 mb-0 color1">
                            <?php
                                //check type
                                // if($selectType=='skin-care'){ 
                                //     echo "true";
                                // }else{
                                //     echo "false";
                                // }
                            ?>
                            <article style="display: flex;justify-content: center;align-items: center;"><a href="index.php" class="changec">หน้าหลัก</a> <span class="mx-2 mb-0">/</span>
                            <?php if($selectType=='skin-care'):?><a href="store.php" class="changec" style="margin-right: 0.5rem;">รายการสินค้า</a>/ สกินแคร์ 
                            <?php elseif($selectType=='supplementary-food'):?><a href="store.php" class="changec" style="margin-right: 0.5rem;">รายการสินค้า</a>/ อาหารเสริม
                            <?php elseif($selectType=='home-medicine'):?><a href="store.php" class="changec" style="margin-right: 0.5rem;">รายการสินค้า</a>/ ยาสามัญประจำบ้าน
                            <?php else:?>
                                <strong>รายการสินค้า</strong>
                            <?php endif;?>
                            </article>
                            <aside>
                                <form id="filterForm">
                                    <select id="productTypeDropdown" class="form-select" name="ptype" onchange="filterProduct()">
                                        <option value="">เลือกประเภทสินค้า</option>
                                        <option value="all">สินค้าทั้งหมด</option>
                                        <option value="home-medicine">ยาสามัญประจำบ้าน</option>
                                        <option value="supplementary-food">อาหารเสริม</option>
                                        <option value="skin-care">สกินแคร์</option>
                                    </select>
                                </form>
                            </aside>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <article>
            <div class="container" style="margin: 3rem auto;">
                <div class="row">
                    <?php while ($row = $stmtt->fetch()) : ?>
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <img class="img-custom" src="<?= $row['pimg']; ?>">
                                <div class="card-body-custom">
                                    <h5 class="card-title"><?= $row['pname']; ?></h5>
                                </div>
                                <div class="card-detail-custom">
                                    <p class="card-text"><?= number_format($row['price'], 2); ?> ฿</p>
                                </div>
                                <a href="#" class="card-btn-custom">ดูสินค้าเพิ่มเติม</a>
                            </div>
                        </div>
                        <?php
                        $count++;
                        if ($count % 3 == 0) { //show 3 items per row
                            // Add a new row after every 3 items
                            echo '<div class="clearfix"></div>'; // Quickly and easily clear floated content within a container by adding a clearfix utility. from bootstrap
                        }
                        ?>

                    <?php endwhile; ?>
                </div>
            </div>

        </article>
    </main>
</body>

</html>