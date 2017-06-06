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
	
	if (isset($_GET['purchase_code'])) {
		$q=$_GET["ratetobuyer"];
		$purchase_code = $_GET['purchase_code'];
		$ratetobuyer = $q;
		echo $q;
		$sql3 = "UPDATE purchase SET RateToBuyer = $ratetobuyer  WHERE Purchase_Code = '$purchase_code'";
		$result3 = mysqli_query($Link,$sql3);
		echo "<script>alert($q);location.href='saler_trade_finish.php';</script>";

	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>訂單管理</title>
	<link rel="stylesheet" type="text/css" href="css/yoyo.css">
	<script type="text/javascript">
		function take(str){
			var xmlhttp;
			xmlhttp = new XMLHttpRequest();
			xmlhttp.open("GET","saler_trade_finish.php?q="+str,true);
			xmlhttp.send();
		}
		function rate(){
			var si = new XMLHttpRequest();
			si.open("get","saler_trade_finish.php");
			si.onload=function(){
				document.gett.action="saler_trade_finish.php";
				document.gett.submit();
			};
			si.send();
		}
	</script>
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
			<a href="saler_trade_ing.php" class="htext3-1">訂單管理</a>
			<a href="onsale.php" class="text3-2">商品管理</a>
			<a href="#" class="myorder_q"></a>
			<a href="ask.php"><div class="text4">問答</div></a>
			<div class="myorder_line"></div>
			<div class="clear"></div>
		</div>
		
		<div class="choose">			
			<div class="menu">
				<ul>
					<li><a href="saler_trade_ing.php">處理中</a></li>
					<li><a href="saler_trade_finish.php">已完成</a></li>
				</ul>
			</div>

			<div class="clear"></div>
		</div>

		<div class="myorder_content2">
			<div class="clear"></div>
			<table border="1" style="text-align: center; margin-top: 1em;margin-left: 50px;">
			<tr>
				<td style="padding: 10px 50px;">買家</td>
				<td style="padding: 10px 180px;">商品名稱</td>
				<td style="padding: 10px 20px;">數量</td>
				<td style="padding: 10px 20px;">單價</td>
				<td style="padding: 10px 20px;">總金額</td>
				<td style="padding: 10px 20px;">處理狀態</td>
				<td>評價</td>
				<td>送出</td>
			</tr>
			<?php
				$sql2 = "SELECT * FROM purchase, product WHERE (product.P_Code = purchase.P_Code AND product.Seller_ID = '$UID' AND purchase.isReceive = 1)";
				$result2 = mysqli_query($Link,$sql2);
				while ($row2 = mysqli_fetch_assoc($result2)) {?>
					<tr>
						<td><?php echo $row2["Buyer_ID"]; ?></td>
						<td><?php echo $row2["P_NAME"]; ?></td>
						<td><?php echo $row2["Amount"]; ?></td>
						<td><?php echo $row2["P_Price"]; ?></td>
						<td><?php echo $row2["P_Price"]*$row2["Amount"]; ?></td>
						<td>已完成</td>
						<?php
							echo "<form action='saler_trade_finish.php' method='get' id='rate'>";
							$purchase_code=$row2["Purchase_Code"];
						 	echo "<input type='hidden' name='purchase_code' value=$purchase_code>"; 
						 	 ?>

						<td style="padding: 10px 10px;"><?php echo "<input type='number' size='1' style='width:30px;' name='ratetobuyer' value='$row2[RateToBuyer]'>/10"; ?></td>
						<?php 
							echo "<td><input type='submit' name='' value='送出評分' style='margin:10px 10px;'></td>";
						?>
						</form>
					</tr>
				<?php }
			?>
			</table>
		<div class="clear"></div>
		</div>
		
	</div>
	<div style="margin-top: 180px;" class="footer">
			<p>©copyright by 2017 9487DB&PHP</p>
		</div>
</body>
</html>
