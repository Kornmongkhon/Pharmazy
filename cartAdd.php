<?php 
include("include/header.php");
include("include/head.php");
include("include/functions.php"); 

$pageWasRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0';
if(!isset($_SESSION['cart'])){
    $_SESSION['cart']=array();
}	
    if($pageWasRefreshed){
       
    }
    else if(isset($_GET["action"]) && $_GET["action"]=='add'){
        
        
        $pid = $_GET["pid"];
        // echo $_GET["pname"];
        $item = array(
            'pid' => $pid,
            'pname' => $_GET['pname'],
            'price' => $_GET['price'],
            'quan' => $_GET['quan']
        );
        if(array_key_exists($pid, $_SESSION['cart'])){
            $_SESSION['cart'][$pid]['quan'] += $_GET['quan'];
        }else{
            $_SESSION['cart'][$pid] = $item;
        }
    }else if (isset($_GET["action"]) && $_GET["action"]=="update") {
        if($_GET["quan"]==0){
            $pid = $_GET['pid'];
            unset($_SESSION['cart'][$pid]);
        }else{
            $pid = $_GET["pid"];     
            $qty = $_GET["quan"];
            $_SESSION['cart'][$pid]['quan'] = $qty;
        }
	

// ลบสินค้า
} else if (isset($_GET["action"]) && $_GET["action"]=="delete") {
	
	$pid = $_GET['pid'];
	unset($_SESSION['cart'][$pid]);

 }?>
    


<head>

    <style>
        table, th, td {
            border: 1px solid;
        }
        table {
            width: 50%;
            border-collapse: collapse;
        }
    </style>
    
</head>
<body>
<form method="post" action="confirmOrder.php" onsubmit="return confirmOrder();">
<table border="1">
    <tr>
        <td>ลำดับที่</td>
        <td>ชื่อสินค้า</td>
        <td>จำนวน</td>
        <td>ราคาชิ้นละ</td>
        <td>ราคาทั้งสิ้น</td>
    </tr>
<?php 
	$sum = 0;
    $count=0;
	foreach ($_SESSION['cart'] as $item) {
        $count+=1;
		$sum += $item["price"] * $item["quan"];
?>
	<tr>
        <td><?=$count?></td>
		<td>
            <a href="product.php?pid=<?=$item["pid"]?>"><?=$item["pname"]?></a>     </td>
		<td>
        <input type="number" id="<?=$item["pid"]?>" value="<?=$item["quan"]?>" min="1" max="9">
        <a href="#" onclick="update(<?=$item["pid"]?>)">แก้ไข</a>
        </td>
        <td><?=$item["price"]?></td>
		<td>			
			<?=$item["price"]*$item["quan"]?>
			
			<a href="?action=delete&pid=<?=$item["pid"]?>">ลบ</a>
		</td>
	</tr>
<?php } ?>
<tr><td colspan="5" align="right">รวม <?=$sum?> บาท</td></tr>
</table>
<input id="sum" type="hidden" value="<?=$sum?>" name="sum">
<div id="addtext"></div>
<input  type="submit" name="submit_button" value="ORDER">
</form>

<a href="store.php"><- เลือกสินค้าต่อ</a>

<!-- <form method="post" action="cartAdd.php?action=orders">
    
</form> -->
</body>
</html>
<script>
        function update(pid) {
		var qty = document.getElementById(pid).value;
		// ส่งรหัสสินค้า และจำนวนไปปรับปรุงใน session
		document.location = "cartAdd.php?action=update&pid=" + pid + "&quan=" + qty; 
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
            }
            else{
                if (confirm("Are you sure you want to place the order?")) {
                return true;  // Continue with form submission
            } else {
                return false; // Cancel form submission
            }
            } 
        }
    </script>