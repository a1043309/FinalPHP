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
	<title>問與答－我的問題</title>
	<link rel="stylesheet" type="text/css" href="css/yoyo.css">
</head>
<body>
	<div class="user_wrap">
		<div class="user_header">
			<a href="index.php"><img src="pic/logo.png"></a>
			<div style="margin-right: 100px;" class="user_header_profile">
				<p>
				<?php $result = mysqli_query($Link,"SELECT U_MONEY FROM user WHERE U_ID = '$UID'");
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
			<a href="onsale.php" class="text3-2">商品管理</a>
			<a href="#" class="myorder_q_press"></a>
			<a href="ask.php"><div class="text4">問答</div></a>
			<div class="myorder_line"></div>
			<div class="clear"></div>
		</div>
		
		<div class="choose">			
			<div class="menu">
				<ul>
					<li><a href="ask.php">我的問題</a></li>
					<li><a href="answer.php">我的回覆</a></li>
				</ul>
			</div>
			<div class="clear"></div>
		</div>

		<div class="myorder_content2">
			<div class="clear"></div>
			<table border="1" style="text-align: center; margin-top: 1em;margin-left: 100px;">
			<tr>
				<td style="padding: 10px 180px;">商品名稱</td>
				<td style="padding: 10px 100px;">問題</td>
				<td style="padding: 10px 100px;">回覆</td>
				<td style="padding: 10px 50px;">賣家</td>			
			</tr>
			<?php
				$sql = "SELECT * FROM question, product WHERE Asker_ID = '$UID' AND question.P_Code = product.P_Code";
				$result = mysqli_query($Link, $sql);
				while ($row = mysqli_fetch_assoc($result)) {?>
					<tr>
						<td style="padding: 5px;"><?php $p_code = $row['P_Code'];
						 echo "<a href='product.php?&p_code=$p_code'>".$row['P_NAME']."</a>"; ?></td>
						 <td><?php echo $row['Content']; ?></td>
						 <td><?php echo $row['Reply_Content']; ?></td>
						 <td><?php echo $row['Seller_ID']; ?></td>
					</tr>
			<?php }
			?>
			</table>
		<div class="clear"></div>
		</div>
		
		<div style="margin-top: 180px;" class="footer">
			<p>©copyright by 2017 9487DB&PHP</p>
		</div>
	</div>
</body>
</html>
