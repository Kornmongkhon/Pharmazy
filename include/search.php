<?php
include('functions.php');
$search = $_POST['pname'];
$stmt = $pdo->prepare("SELECT * FROM product WHERE pname LIKE '%$search%'");
$stmt->execute();
?>
<article>
    <form action="product.php" method="post">
        <div class="container" style="margin: 3rem auto;">
            <div class="row">
                <?php while ($row = $stmtt->fetch()) : ?>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <!-- Add a hidden input to store the product id -->
                            <input type="hidden" name="pid" value="<?= $row['pid']; ?>">
                            <img class="img-custom" src="<?= $row['pimg']; ?>">
                            <div class="card-body-custom">
                                <p class="card-title-custom"><?= $row['pname']; ?></p>
                            </div>
                            <div class="card-detail-custom">
                                <p class="card-text"><?= number_format($row['price'], 2); ?> ฿</p>
                            </div>
                            <!-- <a href="#" class="card-btn-custom">ดูสินค้าเพิ่มเติม</a> -->
                            <button type="submit" name="product" class="card-btn-custom" value="<?= $row['pid'] ?>">ดูสินค้าเพิ่มเติม</button>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </form>
</article>