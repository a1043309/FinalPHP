<?php
session_start();
header('Content-type: text/html; charset=utf-8');

if(isset($_GET["logout"]))
{
	unset($_SESSION["ID"]);
	header("Location:index.php");
}

$Link = mysqli_connect('localhost','phpholyshit','tingting123','9487');
	if(!$Link)
		echo "連接失敗";
	mysqli_query($Link, "SET NAMES UTF8");

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
				$result = mysqli_query($Link,"SELECT U_MONEY FROM user WHERE U_ID = '$UID'");
				$row = mysqli_fetch_assoc($result);

				echo "<a href='user.php' class='lid-member'>".$UID."</a>";
				echo "<a href='post.php' class='lid-member'>我要刊登</a>";
				echo "<a href='index.php?&logout=yes' class='lid-member'>登出</a>";
				if(isset($_SESSION["isAdmin"]))
					echo "<a href='admin.php' class='lid-member'>後臺管理</a>";
				echo "<a href='#' class='lid-member'>$".$row["U_MONEY"]."</a>";

	
			}
			else if (isset($_POST["id"]))
			{
				$id = $_POST["id"];
				$pwd = $_POST["pwd"];
	
				$result = mysqli_query($Link,"SELECT * FROM user");

				while($row = mysqli_fetch_assoc($result)){
					if($row["U_ID"] == $id)
					{
						if($row["U_PW"] == $pwd){
							$_SESSION["ID"] = $id;
							header("Location:index.php");
							break;
						}			
					}
				}
				if(!isset($_SESSION["ID"]))
					echo "登入失敗";
			}
			else
			{
				echo "<a href='user.php' class='lid-member'>會員專區</a>";
				echo "<a href='signup.php' class='lid-member'>立即註冊</a>";
				echo "<a href='signin.php' class='lid-member'>會員登入</a>";
			}
		?>

		<script type="text/javascript">
			function search(){
					var content = document.getElementById("search");
					var game = document.getElementById("selected");
					document.location.href="each-game-page.php?search="+ content.value + "&p_game=" + game.value;
			}
		</script>

			
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
				<button onclick="search();"><i class="fa fa-search fa-2x" aria-hidden="true"></i></button>
			</div>
		</div>
		<div class="clear"></div>
		<div class="nav-menu">
			<ul>
				<li>
					<a href="index.php">首頁</a>
					<?php echo"<a href=each-game-page.php?&p_game=新楓之谷>新楓之谷</a>";?>
					<?php echo"<a href=each-game-page.php?&p_game=跑跑卡丁車>跑跑卡丁車</a>";?>
					<?php echo"<a href=each-game-page.php?&p_game=爆爆王>爆爆王</a>";?>
				</li>
			</ul>
		</div>
		<div class="clear"></div>
		<div class="content">
			<div class="pic-area" style="width: 23%;float: left;">
				<div class="pic-title">
					<img src="pic/1.jpg" alt="">
				</div>
				<div class="pic-details">
					<img src="pic/2.jpg" alt="">
				</div>
				<div class="pic-details">
					<img src="pic/3.jpg" alt="">			
				</div>
				<div class="pic-details">
					<img src="pic/4.jpg" alt="">			
				</div>
				<div class="pic-details">
					<img src="pic/5.jpg" alt="">			
				</div>
				<div class="pic-details">
					<img src="pic/6.jpg" alt="">			
				</div>
				<div class="pic-details">
					<img src="pic/7.jpg" alt="">			
				</div>
			</div>
			<div class="product-area">
				<div class="product-title"><h2>全部商品</h2></div>
						<?php 
						if(isset($_GET["search"]))
						{
							$s = "%".$_GET["search"]."%";
							if(empty($_GET["p_game"]))
								$sql3 = "SELECT * FROM product WHERE P_NAME LIKE '$s'";
							else
							{
								$p_game = $_GET["p_game"];
								$sql3 = "SELECT * FROM product WHERE P_Game = '$p_game' AND P_NAME LIKE '$s'";
							}
						}
						else if (isset($_GET["p_game"]))
						{
							$p_game = $_GET["p_game"];
								$sql3 = "SELECT * FROM product WHERE P_Game = '$p_game'";
						}
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
						while ($row3 = mysqli_fetch_array($result3)) {?>
							<div class="product-details" style="border: 2px solid black;margin-left: 30px;">
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
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
		<div class="footer">
			<?php
    //分頁頁碼	
   				echo '共 '.$data_nums.' 筆-在 '.$page.' 頁-共 '.$pages.' 頁';
    			echo "<br /><a href=each-game-page.php?&p_game=$p_game&page=1>首頁</a> ";
    			echo "第 ";
    				for( $i=1 ; $i<=$pages ; $i++ ) {
        				if ( $page-3 < $i && $i < $page+3 ) {
           					 echo "<a href=each-game-page.php?&p_game=$p_game&page=".$i.">".$i."</a> ";
        				}
    				} 
    			echo " 頁 <a href=each-game-page.php?&p_game=$p_game&page=".$pages.">末頁</a><br /><br />";
			?>
			<p style="font-size: 14px;">Copyright © 2017 9487DB&PHP</p>
		</div>
	</div>
</body>
</html>

