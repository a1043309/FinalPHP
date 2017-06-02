<?php
	header('Content-type: text/html; charset=utf-8');
	session_start();
	if(!isset($_SESSION["ID"]))
		header("Location:signin.php");

	$UID = $_SESSION["ID"];
	$Link = mysqli_connect('localhost','phpholyshit','tingting123','9487');
	mysqli_query($Link, "SET NAMES UTF8");
	if(!$Link)
		echo "連接失敗";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>9487寶物交易網</title>
	<link rel="stylesheet" type="text/css" href="css/final.css">
	<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
</head>
<body>
	<div class="wrap">
		<div class="header">
			<div class="logo">
				<a href="index.php"><img src="pic/logo.png" alt="9487寶物交易網" title="9487寶物交易網"></a>
			</div>
			<div class="member-set">
				<?php 
					$result = mysqli_query($Link,"SELECT U_MONEY FROM user WHERE U_ID = '$UID'");
					$row = mysqli_fetch_assoc($result);
					echo "<a href='#' class='lid-member'>$".$row["U_MONEY"]."</a>"; ?>
				<?php echo "<a href='index.php?&logout=yes' class='lid-member'>登出</a>"; ?>
				<a href="edit-info.php">修改資料</a>
				<a href="#" id="cart"><i class="fa fa-shopping-cart fa-2x" aria-hidden="true"></i></a>	
			</div>
		</div>
		<div class="clear"></div>
		<div class="content">
			<div class="seller-infomation">
				<div class="seller-infomation-title">
					<h2>賣家資訊</h2>
				</div>
				<div class="seller-infomation-details">
					<p>賣家 : <?php echo "<a href='user.php' class='lid-member'>".$UID."</a>";?></p>
					<?php
					$sql = "SELECT SUM(RateToBuyer) AS RATESUM, COUNT(RateToBuyer) AS RATECOUNT FROM PURCHASE WHERE Buyer_ID='$UID'";

					$result = mysqli_query($Link,$sql);
					$row = mysqli_fetch_assoc($result);
					if($row["RATECOUNT"] == 0)
					{?>
						<p>買家正評率 0<br></p><?php
					}
					else{?>
						<p>買家正評率<br><?php echo $row["RATESUM"]/$row["RATECOUNT"];
					}?>
					<p>正評 (<?php 
					$sql3 = "SELECT RateToBuyer FROM PURCHASE WHERE Buyer_ID='$UID'";
					$result3 = mysqli_query($Link,$sql3);
					$row3 = mysqli_fetch_assoc($result3);
					$g = 0;
					while($row3 = mysqli_fetch_assoc($result3)){ if($row3["RateToBuyer"]>5){$g++;}} echo $g;?>)<br>負評(<?php 
					$b=0;
					while($row3 = mysqli_fetch_assoc($result3)){ if($row3["RateToBuyer"]<5){$b++;}} echo $b;?>)</p>
				</div>
			</div>
			<div class="label-pmarket">
				<div class="label-title">
					<h3>全部商品</h3>
				</div>
				<div class="label-data">
					<ul>
						<li><a href="#">新楓之谷</a></li>
						<li><a href="#">跑跑卡丁車</a></li>
						<li><a href="#">爆爆王</a></li>
					</ul>
				</div>			
				<div class="label-line"></div>
				<div class="pmarket-data">
					<div class="product-details">
						<a href="#"><h4>傳說頂培飾品/87最便宜/只剩一組</h4></a>
						<a href="#"><p>伺服器:菇菇寶貝</p></a>
						<a href="#"><p>物品種類:裝備</p></a>
						<h3>$3,300</h3>
					</div>
					<div class="product-details">
						<a href="#"><h4>傳說頂培飾品/87最便宜/只剩一組</h4></a>
						<a href="#"><p>伺服器:菇菇寶貝</p></a>
						<a href="#"><p>物品種類:裝備</p></a>
						<h3>$3,300</h3>
					</div>
				</div>
			</div>
		</div>
		<div class="clear"></div>
		<div class="page">
			<ul>
				<li><a href=""><< Prev</a></li>
				<li><a href="">1</a></li>
				<li><a href="">2</a></li>
				<li><a href="">3</a></li>
				<li><a href="">4</a></li>
				<li><a href="">5</a></li>
				<li><a href="">Next >></a></li>
			</ul>
		</div>
		<div class="clear"></div>
		<div class="footer">
			<p>Copyright © 2017 9487DB&PHP</p>
		</div>
	</div>
</body>
</html>