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
	$seller = $_GET["seller"];
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
				<a href="index.php"><img style="width: 60%;" src="pic/logo.png" alt="9487寶物交易網" title="9487寶物交易網"></a>
			</div>
			<div class="member-set">
				<?php 
					$result = mysqli_query($Link,"SELECT U_MONEY FROM user WHERE U_ID = '$UID'");
					$row = mysqli_fetch_assoc($result);
					echo "<a href='#' class='lid-member'>$".$row["U_MONEY"]."</a>"; ?>
				<?php echo "<a href='index.php?&logout=yes' class='lid-member'>登出</a>"; ?>
				<a href="edit-info.php">修改資料</a>
					
			</div>
		</div>
		<div class="clear"></div>
		<div class="content">
			<div class="seller-infomation">
				<div class="seller-infomation-title">
					<h2>賣家資訊</h2>
				</div>
				<div class="seller-infomation-details">
					<p>賣家 : <?php echo "<a href='' class='lid-member'>".$seller."</a>";?></p>
					<?php
					$sql = "SELECT SUM(RateToSeller) AS RATESUM, COUNT(RateToSeller) AS RATECOUNT FROM purchase WHERE P_Code IN (SELECT P_Code FROM product WHERE Seller_ID = '$seller')";

					$result = mysqli_query($Link,$sql);
					$row = mysqli_fetch_assoc($result);
					if($row["RATECOUNT"] == 0)
					{?>
						<p>賣家正評率 0<br></p><?php
					}
					else{?>
						<p>賣家正評率<?php echo round($row["RATESUM"]/$row["RATECOUNT"],2)."/10";?></p>
					<?php }?>
					<p>正評( <?php 
					$sql2 = "SELECT RateToSeller FROM purchase WHERE P_Code IN (SELECT P_Code FROM product WHERE Seller_ID = '$seller')";
					$result2 = mysqli_query($Link,$sql2);
					$g = 0;
				while($row2 = mysqli_fetch_assoc($result2))
					{
						if($row2["RateToSeller"]>=5)
							{
								$g++;
							}
					}
					echo $g;
					?>
					)
					<br>負評(
						<?php 
				$b=0;
				$result3 = mysqli_query($Link,$sql2);
				while($row3 = mysqli_fetch_assoc($result3))
					{
					 if($row3["RateToSeller"]<5)
					 	{
					 		$b++;
					 	}
					 } 
					 echo $b;
					 ?>
					 )</p>
				</div>
			</div>
			<div class="label-pmarket">
				<div class="label-title">
					<h3>全部商品</h3>
				</div>
				<div class="label-data">
					<ul>
						<li><?php echo"<a href=pmarket.php?&seller=$seller&p_game=新楓之谷>新楓之谷</a>";?></li>
						<li><?php echo"<a href=pmarket.php?&seller=$seller&p_game=跑跑卡丁車>跑跑卡丁車</a>";?></li>
						<li><?php echo"<a href=pmarket.php?&seller=$seller&p_game=爆爆王>爆爆王</a>";?></li>
					</ul>
				</div>			
				<div class="label-line"></div>
				<div class="pmarket-data">
					<?php
					if (empty($_GET["p_game"])) {
						$sql3 = "SELECT * FROM product WHERE P_Code IN (SELECT P_Code FROM product WHERE Seller_ID = '$seller')";
						$result3 = mysqli_query($Link, $sql3);
						$data_nums = mysqli_num_rows($result3);
						$per = 8;
						$pages = ceil($data_nums/$per);
						if (!isset($_GET["page"])) {
							$page = 1;
						}else{
							$page = intval($_GET["page"]);
						}
						$start = ($page-1)*$per;
						$sql3 = $sql3.' LIMIT '.$start.', '.$per;
						$result3 = mysqli_query($Link, $sql3);
					}else{
						$p_game = $_GET["p_game"];
						$sql3 = "SELECT * FROM product WHERE P_Code IN (SELECT P_Code FROM product WHERE Seller_ID = '$seller' AND P_Game = '$p_game')";
						$result3 = mysqli_query($Link, $sql3);
						$data_nums = mysqli_num_rows($result3);
						$per = 5;
						$pages = ceil($data_nums/$per);
						if (!isset($_GET["page"])) {
							$page = 1;
						}else{
							$page = intval($_GET["page"]);
						}
						$start = ($page-1)*$per;
						$sql3 = $sql3.' LIMIT '.$start.', '.$per;
						$result3 = mysqli_query($Link, $sql3);
					}
						while ($row3 = mysqli_fetch_array($result3)) {?>
							<div class="product-details">
							<?php 
							$name = $row3['P_NAME'];
							$game = $row3['P_Game'];
							$server = $row3['P_Server'];
							$classify = $row3['P_Classify'];
							$code = $row3['P_Code'];
							$price = $row3['P_Price'];?>
							<?php echo "<a href=product.php?&p_code=$code><h4>$name</h4></a>";?>
							<a href="#"><p style="font-size: 16px;">遊戲：<?php echo $game;?></p></a>
							<a href="#"><p style="font-size: 16px;">伺服器：<?php echo $server;?></p></a>
							<a href="#"><p style="font-size: 16px;">種類：<?php echo $classify; ?></p></a>
							<h3><?php echo "$".$price;?></h3></div>
						<?php } ?>
				</div>
			</div>
		</div>
		<div class="clear"></div>
		<div class="clear"></div>
		<div class="footer">
			<?php
    //分頁頁碼
   				echo '共 '.$data_nums.' 筆-在 '.$page.' 頁-共 '.$pages.' 頁';
    			echo "<br /><a href=pmarket.php?&seller=$seller&page=1>首頁</a> ";
    			echo "第 ";
    				for( $i=1 ; $i<=$pages ; $i++ ) {
        				if ( $page-3 < $i && $i < $page+3 ) {
           					 echo "<a href=pmarket.php?&seller=$seller&page=".$i.">".$i."</a> ";
        				}
    				} 
    			echo " 頁 <a href=pmarket.php?&seller=$seller&page=".$pages.">末頁</a><br /><br />";
			?>
			<p style="font-size: 14px;">Copyright © 2017 9487DB&PHP</p>
		</div>
	</div>
</body>
</html>

