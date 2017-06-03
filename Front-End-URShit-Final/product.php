<?php
	header('Content-type: text/html; charset=utf-8');
	session_start();

	$P_Code = $_GET["p_code"];

	if(isset($_SESSION["ID"]))
		$UID = $_SESSION["ID"];

	$Link = mysqli_connect('localhost','phpholyshit','tingting123','9487');
	if(!$Link)
		echo "連接失敗";
	mysqli_query($Link, "SET NAMES UTF8");
	$sql = "SELECT * FROM product WHERE P_Code = '$P_Code'";
	$result = mysqli_query($Link,$sql);
	$row = mysqli_fetch_assoc($result);

	$P_Name = $row["P_NAME"];
	$P_Price = $row["P_Price"];
	$P_ImgPath = $row["P_ImgPath"];
	$P_SoldAmount = $row["P_SoldAmount"];
	$P_Inv = $row["P_Inv"];
	$Seller_ID = $row["Seller_ID"];
	$P_Present = $row["P_Present"];
	$P_Server = $row["P_Server"];
	$P_Game = $row["P_Game"];

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
	<div class="lid">
		<img src="pic/eyes.png">
		<p>你是87我是87，9487寶物交易網</p>
		<?php 
			if(isset($_SESSION["ID"]))
			{
				$UID = $_SESSION["ID"];
				$Link = mysqli_connect('localhost','phpholyshit','tingting123','9487');
				$result = mysqli_query($Link,"SELECT U_MONEY FROM user WHERE U_ID = '$UID'");
				$row = mysqli_fetch_assoc($result);

				echo "<a href='user.php' class='lid-member'>".$UID."</a>";
				echo "<a href='post.php' class='lid-member'>我要刊登</a>";
				echo "<a href='index.php?&logout=yes' class='lid-member'>登出</a>";
				echo "<a href='#' class='lid-member'>$".$row["U_MONEY"]."</a>";
			}?>
		<a href="#" id="cart"><i class="fa fa-shopping-cart fa-2x" aria-hidden="true"></i></a>		
	</div>
	<div class="wrap">
		<div class="header">
			<div class="logo">
				<a href="#"><img src="pic/logo.png" alt="9487寶物交易網" title="9487寶物交易網"></a>
			</div>
			<div class="search-selected">
				<select id="selected">
					<option value="null">Play 蝦咪 game?</option>
					<option value="mapelstory">新楓之谷</option>
					<option value="kartrider">跑跑卡丁車</option>
					<option value="bnb">爆爆王</option>
				</select>
			</div>
			<div class="search">
				<input id="search" type="text" placeholder="關鍵字搜尋">		
			</div>
			<div class="search-icon">
				<a href="#"><i class="fa fa-search fa-2x" aria-hidden="true"></i></a>
			</div>
		</div>
		<div class="clear"></div>
		<div class="content">
			<div class="product-info">
				<div class="product-pic">
					<?php echo "<img src='$P_ImgPath'>"; ?>
				</div>
				<form action="purchaseconfirm.php" method="get" id="buy">
				<div class="product-data">
					<h3><?php echo $P_Name; ?></h3>
					<h2>價格：<span><?php echo "$".$P_Price; ?></span></h2>
					<p>伺服器：<?php echo "$".$P_Server; ?></p>
					<?php echo "<input type = 'hidden' name = 'p_code' value = '$P_Code'>"; ?>
					<p>需要數量： <input id="product-amount" type="number" min="0" name="amount"> &nbsp;&nbsp;&nbsp;<span>(庫存：<?php echo $P_Inv; ?>)</span></p>
					<div class="product-btn">
						<div class="btn-buy"><button type="submit" form="buy" id="purchase">立即購買</button></div>
						<div class="btn-cart"><a href="">加入購物車</a></div>
					</div>
					<div class="clear"></div>
					</form>
				</div>
				<div class="seller-info">
					<div class="seller-info-title">
						<h3>賣家資訊</h3>
					</div>
					<div class="seller-info-details">
						<p>會員：<?php echo $Seller_ID; ?></p>
						<p>賣家評價：0則</p>
						<p>正評率：<span>99.99%</span></p>
						<div class="seller-info-more"><a href="">看賣家全部商品</a></div>
					</div>
				</div>
			</div>
			<div class="clear"></div>
			<div class="product-more">
				<div class="product-more-y"><a href="">商品資訊</a></div>
				<div class="product-more-p"><a href="&question=0">問與答</a></div>
			</div>
	<?php
		if(isset($_GET["question"]))	//如果get到question顯示問與答，反之顯示商品資訊
		{
			$sql = "SELECT A1.U_ID U_ID, A2.Content Content, A2.Reply_Content Reply_Content FROM user A1, question A2 WHERE A1.U_ID = A2.Asker_ID AND A2.P_Code = '$P_Code' ORDER BY A2.Post_Time DESC";

			$result = mysqli_query($Link,$sql);
			while($row = mysqli_fetch_assoc($result))
			{
				echo "發問者：".$row['U_ID']."<br/>";
				echo "問題：".$row['Content']."<br/>";
				echo "回覆：".$row['Reply_Content']."<br/>";
			}
		}
		else
		{
			$sql = "SELECT * FROM product WHERE P_Code = '$P_Code'";
			$result = mysqli_query($Link,$sql);
			$row = mysqli_fetch_assoc($result);

			$P_Name = $row["P_NAME"];
			$P_Price = $row["P_Price"];
			$P_ImgPath = $row["P_ImgPath"];
			$P_SoldAmount = $row["P_SoldAmount"];
			$P_Inv = $row["P_Inv"];
			$Seller_ID = $row["Seller_ID"];
			$P_Present = $row["P_Present"];
			echo "<img src='$P_ImgPath' border = 1><br/><br/><br/>";

			echo $P_Present;
			
		}

	?>

		</div>
		<div class="footer">
			<p>Copyright © 2017 9487DB&PHP</p>
		</div>
	</div>
</body>
</html>