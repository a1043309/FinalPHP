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
	<title>會員專區</title>
	<link rel="stylesheet" type="text/css" href="css/yoyo.css">
</head>
<body>
	<div class="user_wrap">
		<div class="user_header">
			<a href="index.php"><img src="pic/logo.png"></a>
			<div class="user_header_profile">
				<a href="#"><img id="m" src="pic/marketcar.png"></a>
				<p>
				<a href="edit-info.php">修改資料</a>&nbsp;&nbsp;
				<?php echo "<a href='index.php?&logout=yes' class='lid-member'>登出</a>"; ?>&nbsp;&nbsp;
				<?php 
					$result = mysqli_query($Link,"SELECT U_MONEY FROM user WHERE U_ID = '$UID'");
					$row = mysqli_fetch_assoc($result);
					echo "<a href='#' class='lid-member'>$".$row["U_MONEY"]."</a>"; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</p>
			</div>
		</div>
		<div class="user_content">
			<div class="clear"></div>
			<div class="user_leftbox">
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
				<p>正評(<?php 
					$sql3 = "SELECT RateToBuyer FROM PURCHASE WHERE Buyer_ID='$UID'";
					$result3 = mysqli_query($Link,$sql3);
					$row3 = mysqli_fetch_assoc($result3);
					$g = 0;
					while($row3 = mysqli_fetch_assoc($result3)){ if($row3["RateToBuyer"]>5){$g++;}} echo $g;?>)<br>負評(<?php 
					$b=0;
					while($row3 = mysqli_fetch_assoc($result3)){ if($row3["RateToBuyer"]<5){$b++;}} echo $b;?>)</p>
				<?php
					$sql2 = "SELECT SUM(RateToSeller) AS RATESUM, COUNT(RateToSeller) AS RATECOUNT FROM purchase WHERE P_Code IN (SELECT P_Code FROM product WHERE Seller_ID = '$UID')";

					$result2 = mysqli_query($Link,$sql2);
					$row2 = mysqli_fetch_assoc($result2);
				?>
				<?php if($row2["RATECOUNT"] == 0)
					{?>
						<p>賣家正評率 0<br></p><?php
					}
					else{?>
						<p>賣家正評率<br><?php echo $row2["RATESUM"]/$row2["RATECOUNT"];
					}?></p>
				<p>正評(<?php 
					$sql4 = "SELECT RateToSeller FROM purchase WHERE P_Code IN (SELECT P_Code FROM product WHERE Seller_ID = '$UID')";
					$result4 = mysqli_query($Link,$sql4);
					$g = 0;
				while($row4 = mysqli_fetch_assoc($result4)){if($row4["RateToSeller"]>5){$g++;}} echo $g;?>)<br>負評(<?php 
				$b=0;
				while($row4 = mysqli_fetch_assoc($result4)){ if($row4["RateToSeller"]<5){$b++;}} echo $b;?>)</p>
			</div>
			<img src="pic/title.png" class="imbuyer">
			<div class="u_text1">我是買家</div>
			<div class="user_line"></div>
			<div class="buyerbox"></div>
			<div class="u_text2">我的訂單</div>
			<div class="u_text3"><a href="myorder.php">>>更多</a></div>
			<div class="buyerbox"></div>
			<div class="u_text2">已購買的商品</div>
			<div class="u_text3"><a href="#">>>更多</a></div>
			<div class="contentbox">
				<?php
				$sql = "SELECT A1.P_Code P_Code, A1.P_NAME P_NAME, A2.Purchase_Code Purchase_Code
					FROM product A1, purchase A2 
					WHERE A1.P_Code = A2.P_Code AND A2.Buyer_ID = '$UID' AND A2.isReceive=0
					GROUP BY A2.Purchase_Code
					ORDER BY A2.Post_Time DESC";
				$result = mysqli_query($Link,$sql);
				for ($i=0; $i < 3; $i++) { 
					if ($row = mysqli_fetch_assoc($result)) {
						echo "<a href=product.php?&p_code=$row[P_Code]>$row[P_NAME]</a><br/>";
					}
				}
			?>
			</div>
			<div class="contentbox">
				<?php
					$sql = "SELECT A1.P_Code P_Code, A1.P_NAME P_NAME, A2.Purchase_Code Purchase_Code
						FROM product A1, purchase A2 
						WHERE A1.P_Code = A2.P_Code AND A2.Buyer_ID = '$UID' AND A2.isReceive!=0
						GROUP BY A2.Purchase_Code
						ORDER BY A2.Post_Time DESC";
					$result = mysqli_query($Link,$sql);
					for ($i=0; $i < 3 ; $i++) { 
							if($row = mysqli_fetch_assoc($result)){
							echo "<a href=product.php?&p_code=$row[P_Code]>$row[P_NAME]</a><br/>";
						}
					}						
				?>
			</div>
			<div class="buyerbox"></div>
			<div class="u_text2">賣家回答</div>
			<div class="u_text3"><a href="#">>>更多</a></div>
			<div class="buyerbox"></div>
			<div class="u_text2">賣家評價</div>
			<div class="u_text3"><a href="#">>>更多</a></div>
			<div class="contentbox">
				<?php
					$sql = "SELECT P_NAME,P_Code FROM product WHERE P_Code IN (SELECT P_Code FROM question WHERE Asker_ID = '$UID')";

					$result = mysqli_query($Link,$sql);
					for ($i=0; $i < 3; $i++) { 
						if($row = mysqli_fetch_assoc($result))
						{
							echo "<a href=product.php?&p_code=$row[P_Code]>$row[P_NAME]</a><br/>";
						}
					}
					
				?>
			</div>
			<div class="contentbox"></div>
			<?php
				$sql = "SELECT A1.P_Code P_Code, A1.P_NAME P_NAME, A2.Purchase_Code Purchase_Code
					FROM product A1, purchase A2 
					WHERE A1.P_Code = A2.P_Code AND A2.Buyer_ID = '$UID' AND A2.isReceive!=0 AND A2.RateToBuyer IS NOT NULL
					GROUP BY A2.Purchase_Code
					ORDER BY A2.Post_Time DESC";

				$result = mysqli_query($Link,$sql);
				for ($i=0; $i < 3; $i++) { 
					if($row = mysqli_fetch_assoc($result))
					{
						echo "<a href=product.php?&p_code=$row[P_Code]>$row[P_NAME]</a><br/>";
					}
				}
			?>
			<div class="clear"></div>
			<div class="user_leftbox">
				<p>會員年齡分析</p>
				<p>18以下<br>18~25<br>26~40<br>40以上</p>
			</div>
			
			<img src="pic/title2.png" class="imbuyer2">
			<div class="u_text1">我是賣家</div>

			<div class="user_line2"></div>
			<button class="publish1"><a href="#">我要刊登</a></button>
			<button class="publish2"><a href="#">我的賣場</a></button>
			
			<div class="buyerbox2"></div>
			<div class="u_text2">我的商品</div>
			<div class="u_text3"><a href="#">>>更多</a></div>
			<div class="buyerbox2"></div>
			<div class="u_text2">已完成的交易</div>
			<div class="u_text3"><a href="#">>>更多</a></div>
			<div class="contentbox2">
				<?php
					$sql = "SELECT P_NAME,P_Code FROM product WHERE Seller_ID='$UID'";

					$result = mysqli_query($Link,$sql);
					for ($i=0; $i < 3; $i++){ 
						if ($row = mysqli_fetch_assoc($result)) {
							echo "<a href=product.php?&p_code=$row[P_Code]>$row[P_NAME]</a><br/>";
						}
					}
				?>
			</div>
			<div class="contentbox2">
				<?php
					$sql = "SELECT A1.P_Code P_Code, A1.P_NAME P_NAME, A2.Purchase_Code Purchase_Code
						FROM product A1, purchase A2 
						WHERE A1.P_Code = A2.P_Code AND A1.Seller_ID = '$UID' AND A2.isReceive!=0
						GROUP BY A2.Purchase_Code
						ORDER BY A2.Post_Time DESC";
					$result = mysqli_query($Link,$sql);
					for ($i=0; $i < 3; $i++) { 
						if ($row = mysqli_fetch_assoc($result)) {
							echo "<a href=product.php?&p_code=$row[P_Code]>$row[P_NAME]</a><br/>";
						}
					}
				?>
			</div>

			<div class="buyerbox2"></div>
			<div class="u_text2">買家疑問</div>
			<div class="u_text3"><a href="#">>>更多</a></div>
			<div class="buyerbox2"></div>
			<div class="u_text2">訂單管理</div>
			<div class="u_text3"><a href="#">>>更多</a></div>
			<div class="contentbox2">
				<?php
					$sql = "SELECT P_NAME,P_Code FROM product WHERE Seller_ID='$UID' AND P_Code IN (SELECT P_Code FROM question)";

					$result = mysqli_query($Link,$sql);
					for ($i=0; $i < 3; $i++) { 
						if ($row = mysqli_fetch_assoc($result)) {
								echo "<a href=product.php?&p_code=$row[P_Code]>$row[P_NAME]</a><br/>";
						}	
					}
				?>
			</div>
			<div class="contentbox2">
				<?php
					$sql = "SELECT A1.P_Code P_Code, A1.P_NAME P_NAME, A2.Purchase_Code Purchase_Code
					FROM product A1, purchase A2 
					WHERE A1.P_Code = A2.P_Code AND A1.Seller_ID = '$UID' AND A2.isReceive=0
					GROUP BY A2.Purchase_Code
					ORDER BY A2.Post_Time DESC";

					$result = mysqli_query($Link,$sql);
					for ($i=0; $i < 3; $i++) { 
						if ($row = mysqli_fetch_assoc($result)) {
							echo "<a href=product.php?&p_code=$row[P_Code]>$row[P_NAME]</a><br/>";
						}
					}
				?>
			</div>

			<div class="buyerbox3"></div>
			<div class="u_text2">買家評價</div>
			<div class="u_text3"><a href="#">>>更多</a></div>
			<div class="contentbox3">
				<?php
					$sql = "SELECT A1.P_Code P_Code, A1.P_NAME P_NAME, A2.Purchase_Code Purchase_Code
						FROM product A1, purchase A2 
						WHERE A1.P_Code = A2.P_Code AND A1.Seller_ID = '$UID' AND A2.isReceive!=0 AND A2.RateToSeller IS NOT NULL
						GROUP BY A2.Purchase_Code
						ORDER BY A2.Post_Time DESC";

						$result = mysqli_query($Link,$sql);
						for ($i=0; $i < 3; $i++) { 
							if ($row = mysqli_fetch_assoc($result)) {
								echo "<a href=product.php?&p_code=$row[P_Code]>$row[P_NAME]</a><br/>";
							}
						}
				?>
			</div>
	
		</div>
		
		<div class="footer">
			<div class="clear"></div>
			<p>©copyright by 2017 9487DB&PHP</p>
		</div>		
	</div>
</body>
</html>