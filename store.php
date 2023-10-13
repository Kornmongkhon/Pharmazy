<?php
include('include\functions.php');
include('include\head.php');
$selectType = ''; //set type default to null
$itemPerPage = 15; // set item per 1 page
if (isset($_GET['ptype'])) {
    $selectType = $_GET['ptype']; //ptype from js
}

// Calculate the offset based on the current page
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $itemPerPage;

if (!empty($selectType) && $selectType !== "all") { //show protype from choosen type
    $stmtt = $pdo->prepare("SELECT * FROM product WHERE ptype = :ptype ORDER BY pname ASC LIMIT $offset, $itemPerPage");
    $stmtt->bindParam(":ptype", $selectType);
} else { //value = all let ramdom product
    $stmtt = $pdo->prepare("SELECT * FROM product ORDER BY RAND() LIMIT $offset, $itemPerPage");
}
$stmtt->execute();
$totalProducts = $pdo->query("SELECT COUNT(*) FROM product")->fetchColumn();
$totalPages = ceil($totalProducts / $itemPerPage);
?>

<head>
    <link rel="stylesheet" href="style/store/store.css">
    <script>
        function filterProduct() {
            let selected = document.getElementById("productTypeDropdown"); //id select
            let selectedType = selected.value; //get value from select attribute
            let filterForm = document.getElementById("filterForm"); // id form
            if (selectedType === 'all') { //if value = all
                window.location.href = `store.php?ptype=all`;
            } else {
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
                            <article style="display: flex;justify-content: center;align-items: center;"><a href="index.php" class="changec">หน้าหลัก</a> <span class="mx-2 mb-0">/</span>
                                <?php if ($selectType == 'skin-care') : ?><a href="store.php" class="changec" style="margin-right: 0.5rem;">รายการสินค้า</a>/ สกินแคร์
                                <?php elseif ($selectType == 'supplementary-food') : ?><a href="store.php" class="changec" style="margin-right: 0.5rem;">รายการสินค้า</a>/ อาหารเสริม
                                <?php elseif ($selectType == 'home-medicine') : ?><a href="store.php" class="changec" style="margin-right: 0.5rem;">รายการสินค้า</a>/ ยาสามัญประจำบ้าน
                                <?php else : ?>
                                    <strong>รายการสินค้า</strong>
                                <?php endif; ?>
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
            <form action="product.php" method="post">
                <div class="container" style="margin: 3rem auto;">
                    <div class="row">
                        <?php while ($row = $stmtt->fetch()) : ?>
                            <div class="col-md-4 mb-4">
                                <div class="card">
                                    <!-- Add a hidden input to store the product id -->
                                    <input type="hidden" name="pid" value="<?= $row['pid']; ?>">
                                    <?php
                                    // Remove the '../' part from the stored avatar path
                                    $relativePhotoPath = str_replace('../', '', $row['pimg']);
                                    // echo $relativeAvatarPath;
                                    // var_dump($relativeAvatarPath); //check path
                                    ?>
                                    <img class="img-custom" src="<?=$relativePhotoPath?>">
                                    <div class="card-body-custom">
                                        <p class="card-title-custom"><?= $row['pname']; ?></p>
                                    </div>
                                    <div class="card-detail-custom">
                                        <p class="card-text"><?= number_format($row['price'], 2); ?> ฿</p>
                                    </div>
                                    <!-- <a href="#" class="card-btn-custom">ดูสินค้าเพิ่มเติม</a> -->
                                    <button type="submit" name="product" class="card-btn-custom" value="<?=$row['pid']?>">ดูสินค้าเพิ่มเติม</button>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            </form>
        </article>
        <section class="page-custom">
            <?php if ($page == 1) : ?> <!-- if in first page show btn prev but can't go prev page -->
                <a class="btn btn-secondary">Previous</a>
            <?php endif; ?>
            <?php if ($page > 1) : ?> <!-- if not in first page show btn prev can go prev page -->
                <a href="store.php?ptype=<?= $selectType ?>&page=<?= $page - 1 ?>" class="btn btn-primary">Previous</a>
            <?php endif; ?>
            <?php for ($i = 1; $i <= $totalPages; $i++) : ?> <!-- loop number of page to button -->
                <a href="store.php?ptype=<?= $selectType ?>&page=<?= $i ?>" class="btn btn-primary <?= ($i == $page) ? 'active' : ''; ?>" style="margin-left: 20px;"><?= $i ?></a>
            <?php endfor; ?>
            <?php if ($page < $totalPages)  : ?> <!-- if in first page show btn next can go to next page -->
                <a href="store.php?ptype=<?= $selectType ?>&page=<?= $page + 1 ?>" class="btn btn-primary" style="margin-left: 20px;">Next</a>
            <?php else: ?>
                <a class="btn btn-secondary" style="margin-left: 20px;">Next</a>
            <?php endif; ?>
            </section>
    </main>
</body>

</html>