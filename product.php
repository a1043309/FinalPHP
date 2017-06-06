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

<script type="text/javascript">
			function search(){
					var content = document.getElementById("search");
					var game = document.getElementById("selected");
					document.location.href="each-game-page.php?search="+ content.value + "&p_game=" + game.value;
			}
		</script>

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
				$result = mysqli_query($Link,"SELECT U_MONEY FROM user WHERE U_ID = '$UID'");
				$row = mysqli_fetch_assoc($result);

				echo "<a href='user.php' class='lid-member'>".$UID."</a>";
				echo "<a href='post.php' class='lid-member'>我要刊登</a>";
				echo "<a href='index.php?&logout=yes' class='lid-member'>登出</a>";
				echo "<a href='#' class='lid-member'>$".$row["U_MONEY"]."</a>";
			}
			else
			{
				echo "<a href='userpage.php' class='lid-member'>會員專區</a>";
				echo "<a href='signup.php' class='lid-member'>立即註冊</a>";
				echo "<a href='signin.php' class='lid-member'>會員登入</a>";
			}
			?>
			
	</div>
	<div class="wrap">
		<div class="header">
			<div class="logo">
				<a href="index.php"><img src="pic/logo.png" alt="9487寶物交易網" title="9487寶物交易網"></a>
			</div>
			<div class="search-selected">
				<select id="selected">
					<option value="">Play 蝦咪 game?</option>
					<option value="新楓之谷">新楓之谷</option>
					<option value="跑跑卡丁車">跑跑卡丁車</option>
					<option value="爆爆王">爆爆王</option>
				</select>
			</div>
			<div class="search">
				<input id="search" type="text" placeholder="關鍵字搜尋">		
			</div>
			<div class="search-icon">
				<button><i class="fa fa-search fa-2x" aria-hidden="true"></i></button>
			</div>
		</div>
		<div class="clear"></div>
		<div class="content">
			<div class="product-info">
				<div class="product-pic">
					<?php echo "<img src='$P_ImgPath'>"; ?>
				</div>
				<form action="purchaseconfirm.php" method="get" id="buy">
				<div class="product-data" style="margin-left: 400px;">
					<h3><?php echo $P_Name; ?></h3>
					<h2>價格：<span><?php echo "$".$P_Price; ?></span></h2>
					<p>伺服器：<?php echo $P_Server; ?></p>
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
						<p>賣家評價：
							<?php
								$sql4 = "SELECT * FROM purchase WHERE P_Code IN(SELECT P_Code FROM product WHERE Seller_ID = '$Seller_ID')";
								$result4 = mysqli_query($Link,$sql4);
								$count = mysqli_num_rows($result4);
								echo $count."則";?>
						</p>
						<p>正評率：<span>
							<?php
								$sql5 = "SELECT SUM(RateToSeller) AS RATESUM, COUNT(RateToSeller) AS RATECOUNT FROM PURCHASE WHERE P_Code IN (SELECT P_Code FROM product WHERE Seller_ID = '$Seller_ID')";
								$result5 = mysqli_query($Link,$sql5);
								$row5 = mysqli_fetch_assoc($result5);
								if($row5["RATECOUNT"] == 0){
									echo "0";
								}
								else{
									echo round($row5["RATESUM"]/$row5["RATECOUNT"],2)."/10";
								}?>
						</span></p>
						<div class="seller-info-more"><?php echo "<a href='pmarket.php?&seller=$Seller_ID'>看賣家全部商品</a>";?></div>
					</div>
				</div>
			</div>
			<div class="clear"></div>
			<div style="margin-bottom: 0px;" class="product-more">
				<?php echo "<div class='product-more-y'><a href='product.php?p_code=$P_Code'>商品資訊</a></div>"?>
				<?php echo "<div class='product-more-p'><a href='product.php?p_code=$P_Code&question=0'>問與答</a></div>"?>
			<div class="clear"></div>
			</div>
	<?php
		if(isset($_POST["reply"]))
		{
			if(isset($_SESSION["ID"]))
			{	
				$UID = $_SESSION["ID"];
				$reply = $_POST["reply"];
				$Q_Code = $_POST["q_code"];
				$p_code = $_POST["p_code"];

				$sql = "UPDATE question SET Reply_Content = '$reply' WHERE Q_Code = '$Q_Code'";
				$result = mysqli_query($Link,$sql);
				header("Location:product.php?&p_code=$p_code&question=0");
			}
			else
			{
				header("Location:signin.php");
			}
		}

		else if(isset($_POST["content"]))
		{
			$content = $_POST["content"];
			if(isset($_SESSION["ID"]))
			{	
				$UID = $_SESSION["ID"];

				$q_code=substr(md5(rand()),0,12);

				$sql = "SELECT * FROM question WHERE Q_Code = '$q_code'";
				$result = mysqli_query($Link,$sql);
				while($row = mysqli_fetch_assoc($result))
				{
					$q_code=substr(md5(rand()),0,12);
					$sql = "SELECT * FROM question WHERE Q_Code = '$q_code'";
					$result = mysqli_query($Link,$sql);
					echo "重複";
				}

				$sql = "INSERT INTO question(Asker_ID,Content,P_Code,Q_Code) VALUES('$UID','$content','$P_Code','$q_code')";
				$result = mysqli_query($Link,$sql);
			}
			else
			{
				header("Location:signin.php");
			}
		}


		if(isset($_GET["question"]))	//如果get到question顯示問與答，反之顯示商品資訊
		{
			$sql = "SELECT A1.U_ID U_ID, A2.Content Content, A2.Reply_Content Reply_Content, A2.Q_Code
			FROM user A1, question A2
			WHERE A1.U_ID = A2.Asker_ID AND A2.P_Code = '$P_Code' ORDER BY A2.Post_Time DESC";

			$result = mysqli_query($Link,$sql);
			$result2 = mysqli_query($Link,"SELECT Seller_ID FROM product WHERE P_Code = '$P_Code'");
			$row2 = mysqli_fetch_assoc($result2);
			while($row = mysqli_fetch_assoc($result))
				{
					?>
					<div class="show" style="margin-top: 30px;line-height: 30px;margin-left: 10%;border: solid 2px purple;padding: 5px 10px;margin-right: 10%;"> 
					<?php
					echo "<p>發問者：".$row['U_ID']."</p>";
					echo "<p>問題：".$row['Content']."</p>";
					echo "<p>回覆：".$row['Reply_Content']."</p>";
					if(isset($UID))
					{
						if($UID == $row2["Seller_ID"])
						{
							$q_code = $row["Q_Code"];
							$p_code = $P_Code;
							echo "<form action=product.php method='post'>";
							echo "<input type='hidden' name='q_code' value=$q_code>";
							echo "<input type='hidden' name='p_code' value=$p_code>";
							echo "<input style='margin-bottom:10px;width:150px;' type='text' name='reply'><input type='submit' value='回覆'></form>";
						}
					}
				}
				?>
				<div class="clear"></div>
				</div>
				<?php
			

				echo "<br/><br/><br/>";

				if(isset($UID))
				{
					if($UID != $row2["Seller_ID"])
					{

					  echo "<div class='qa' style='text-align: center;text-align: center;margin-top: 30px;border: solid 2px black;margin-right: 10%;margin-left: 10%;padding-bottom: 10px;padding-top: 10px;''>";
					  
						echo "<p>我要發問</p>";
						echo "<form action = product.php?p_code=$P_Code&question=0 method = 'post' id = 'askquest'><br/>";
						echo "<input style='margin-bottom:10px;width:200px;' type='text' name='content'><br/>";
						echo "<input id='post' type='submit' value='提交''><input type='reset' value='重新填寫''>";
						echo "</form>";?>
						<div class="clear"></div>
						</div>
						<?php
					 }
					
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
			echo "<img src='$P_ImgPath' style='border:3px solid lightblue; width:35%; margin-top:30px;'><br/><br/><br/>";

			echo $P_Present;
		} 
		?>

		</div>
		<div class="footer">
			<p style="font-size: 14px;">Copyright © 2017 9487DB&PHP</p>
		</div>
	</div>
</body>
</html>
