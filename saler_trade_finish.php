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
	<title>訂單管理</title>
	<link rel="stylesheet" type="text/css" href="css/yoyo.css">
</head>
<body>
	<div class="user_wrap">
		<div class="user_header">
			<img src="pic/logo.png">
			<div style="margin-right: 100px;" class="user_header_profile">
				<a href="index.php"><img style="height: auto;" src="pic/marketcar.png"></a>
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
			<a href="#" class="htext2-1">我的訂單</a>
			<a href="#" class="text2-2">已購買的商品</a>
			<div class="seller"></div>
			<div class="text3">我是賣家</div>
			<a href="#" class="htext3-1">訂單管理</a>
			<a href="#" class="text3-2">商品管理</a>
			<a href="#" class="myorder_q"></a>
			<div class="text4">問答</div>
			<div class="myorder_line"></div>
		</div>
		
		<div class="choose">
			<div class="clear"></div>
			<a href="#">處理中</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
			<a href="#" class="finish">已完成</a>
		</div>

		<div class="myorder_content2">
			<div class="clear"></div>
			<table border="1" style="text-align: center; margin-top: 1em;margin-left: 30px;">
			<tr>
				<td><input type="checkbox" name="" value="">&nbsp;</td>
				<td>買家&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
				<td>商品名稱&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
				<td>數量&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
				<td>單價&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
				<td>總金額&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
				<td>處理狀態&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
				<td>評價</td>
			</tr>
			<tr>
				<td><input type="checkbox" name="" value=""></td>
				<td>yoyowen</td>
				<td>1:1700 全楓谷最便宜 可提供擺499w箭矢</td>
				<td>10</td>
				<td>100</td>
				<td>1000</td>
				<td>已完成</td>
				<td><input type="text" name="" value="" size="1"></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="" value=""></td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td><input type="text" name="" value="" size="1"></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="" value=""></td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td><input type="text" name="" value="" size="1"></td>
			</tr>
			</table>
		</div>
		<button class="press"><a href="#">送出評價</a></button>
	</div>
	<div class="footer">
			<p>©copyright by 2017 9487DB&PHP</p>
		</div>
</body>
</html>
