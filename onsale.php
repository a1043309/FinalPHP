<?php
	header('Content-type: text/html; charset=utf-8');
	session_start();
	if(!isset($_SESSION["ID"]))
		header("Location:signin.php");

	$UID = $_SESSION["ID"];
	$Link = mysqli_connect('localhost','phpholyshit','tingting123','9487');
	
	if(!$Link)
		echo "連接失敗";
	mysqli_query($Link, "SET NAMES UTF8");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>商品管理</title>
	<link rel="stylesheet" type="text/css" href="css/yoyo.css">
</head>
<body>
	<div class="user_wrap">
		<div class="user_header">
			<a href="index.php"><img src="pic/logo.png"></a>
			<div  style="margin-right:50px;" class="user_header_profile">
				<p>
				<?php 
					$result = mysqli_query($Link,"SELECT U_MONEY FROM user WHERE U_ID = '$UID'");
					$row = mysqli_fetch_assoc($result);
					echo "<a style='padding:10px;' href='#' class='lid-member'>$".$row["U_MONEY"]."</a>"; ?>
				<?php echo "<a style='padding:10px;' href='index.php?&logout=yes' class='lid-member'>登出</a>"; ?>
				<a style='padding:10px;' href="edit-info.php">修改資料</a>
				</p>
			</div>
		</div>
		<div class="myorder_content1">
			<div class="clear"></div>
			<div class="sell"></div>
			<div class="text1">我的拍賣</div>
			<div class="buyer"></div>
			<div class="text2">我是買家</div>
			<a href="myorder.php" class="htext2-1">我的訂單</a>
			<a href="order_history.php" class="text2-2">已購買的商品</a>
			<div class="seller"></div>
			<div class="text3">我是賣家</div>
			<a href="saler_trade_ing.php" class="text3-1">訂單管理</a>
			<a href="onsale.php" class="htext3-2">商品管理</a>
			<a href="#" class="myorder_q"></a>
			<a href="ask.php"><div class="text4">問答</div></a>
			<div class="myorder_line"></div>
		</div>

		<div class="myorder_content2">
			<div class="clear"></div>
			<table border="1" style="text-align: center; margin-top: 1em; margin-left: 200px;">
			<tr>
				<td>商品名稱&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
				<td>庫存&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
				<td>單價&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
				<td>操作&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
				
			</tr>
			<?php
				$sql2 = "SELECT * FROM product WHERE Seller_ID = '$UID'";
				$result2 = mysqli_query($Link,$sql2);
				while ($row2 = mysqli_fetch_assoc($result2)) {
					$code = $row2['P_Code'];
					$name = $row2['P_NAME'];?>
					<tr>
					<td><?php echo "<a href=product.php?&p_code=$code>$name</a>"; ?></td>
					<td><?php echo $row2['P_Inv']; ?></td>
					<td><?php echo $row2['P_Price']; ?></td>
					<td>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo "<a href=editproduct.php?&p_code=$code>修改商品</a>"; ?> &nbsp;&nbsp;&nbsp;<?php echo "<a href=delproduct.php?&p_code=$code>刪除商品</a>";?>&nbsp;&nbsp;&nbsp;&nbsp;</td>
					</tr>
				<?php }
			?>
			</table>
		</div>
		
		<div style="margin-top: 180px;" class="footer">
			<p>©copyright by 2017 9487DB&PHP</p>
		</div>
	</div>
</body>
</html>
