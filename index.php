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
<head>
	<meta charset="UTF-8">
	<title>9487寶物交易網</title>
	<link rel="stylesheet" type="text/css" href="css/final.css">
	<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
	<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
	<script type="text/javascript">
	// 當網頁載完後執行(因為要抓圖片的寬高)
	$(window).load(function(){
		// 先取得相關區塊及圖片的寬高
		// 並先計算出大圖片要垂直置中所需要的 top 值
		var $gallery = $('#slider'), 
			$frame = $gallery.find('ul'), 
			_frameHeight = $frame.height(), 
			_frameWidth = $frame.width(), 
			$li = $frame.find('li'), 
			$img = $li.find('img'), 
			_imgLength = $img.length, 
			_imgWidth = $img.width(),
			_imgHeight = $img.height(),
			_topDiff = (_frameHeight - _imgHeight) / 2, 
			_animateSpeed = 200;

		
		// 設定每張圖片縮放比例
		// _totalWidth 用來記錄寬度累加
		var resizeRatio = [ 0.6, 0.7, 0.8, 1, 0.8, 0.7, 0.6], 
			liCss = [], 
			_totalWidth = 0;
		
		// 預先算出每張圖片縮放後的總寬度
		var _m = 0;
		$img.each(function(i){ 
			_m += $(this).width() * resizeRatio[i];
		});
		// 平均分配要重疊的寬度
		var _leftDiff = Math.ceil((_m - _frameWidth) / (_imgLength - 1));
		
		// 設定每一個 li 的位置及圖片寬高
		$li.each(function(i){
			var $this = $(this), 
				_width = _imgWidth * resizeRatio[i],
				_height = _imgHeight * resizeRatio[i];

			liCss.push({
				height: _height, 
				width: _width, 
				left: _totalWidth  + (i == _imgLength - 1 ? 1 : 0), 
				top: _topDiff + (_imgHeight - _height) / 2, 
				zIndex: resizeRatio[i] * 10
			});

			$this.css(liCss[liCss.length-1]).css({
				position: 'absolute',
				border: '1px solid white'
			}).data('_index', i).find('img').css({
				width: '100%', 
				height: '100%'
			});
			
			_totalWidth += _width - _leftDiff;
		});
		
		// 當滑鼠點擊在 $gallery 中的 .controls 時
		$gallery.on('click', '.controls', function(){
			var $button = $(this);
			
			// 重新計算每一個 li 的位置及圖片寬高
			$li.each(function(){
				var $this = $(this), 
					_index = $this.data('_index');

				_index = ($button.hasClass('next') ? (_index - 1 + _imgLength) : (_index + 1)) % _imgLength;
				$this.data('_index', _index);

				$this.stop(false, true).animate(liCss[_index], _animateSpeed);
			});

			return false;
		});
	});
</script>
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
					echo "<script>alert('登入失敗');location.href='signin.php'</script>";
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
				<input id="search" name = "ss" type="text" placeholder="關鍵字搜尋">		
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
			<div id="slider">
				<a href="#previous" class="controls previous" rel="previous"><img src="pic/prev.png" alt="Prev"></a>
				<a href="#next" class="controls next" rel="next"><img src="pic/next.png" alt="Next"></a>
			<ul>
				<li><a href="#" title="Slide 1"><img src="pic/1.jpg" /></a></li>
				<li><a href="#" title="Slide 2"><img src="pic/2.jpg" /></a></li>
				<li><a href="#" title="Slide 3"><img src="pic/3.jpg" /></a></li>
				<li><a href="#" title="Slide 4"><img src="pic/4.jpg" /></a></li>
				<li><a href="#" title="Slide 5"><img src="pic/5.jpg" /></a></li>
				<li><a href="#" title="Slide 6"><img src="pic/6.jpg" /></a></li>
				<li><a href="#" title="Slide 7"><img src="pic/7.jpg" /></a></li>
			</ul>
		</div>
			<div class="list-area">
				<div class="list-title">
					<p>
						<img src="pic/eyes.png">新楓之谷
					</p>
				</div>
				<div class="list-data">
					<ul>
						<li>遊戲幣</li>
						<li>道具</li>
						<li>帳號</li>
						<li>代練</li>
						<li>送禮</li>
					</ul>
				</div>
				<div class="list-more">
					<?php echo"<a href=each-game-page.php?&p_game=新楓之谷>>>>點我看全部</a>";?>
				</div>
				<div class="clear"></div>
				<div class="list-line"></div>
			</div>
			<div class="main">
				<div class="main-pic">
					<img src="pic/14248488949068911.jpeg" title="新楓之谷" alt="新楓之谷">
				</div>
				<div class="main-data">
					<?php $sql = "SELECT P_NAME,P_Code FROM product WHERE P_Game='新楓之谷' AND P_Inv > 0";
						$result = mysqli_query($Link,$sql);
						for ($i=0; $i < 7; $i++) { 
							if ($row = mysqli_fetch_assoc($result)) {
								echo "<a href='product.php?&p_code=$row[P_Code]'>".$row["P_NAME"]."</a><br/>";
							}
						}
						?>
				</div>
				<div class="sold-charts">
					<div class="charts-title">
						<h3>94會賣榜</h3>
					</div>
					<?php
						$sql2 = "SELECT Seller_ID, SUM(P_Price*P_SoldAmount) FROM product WHERE P_Game = '新楓之谷' GROUP BY Seller_ID ORDER BY SUM(P_Price*P_SoldAmount) DESC LIMIT 3";
						$result2 = mysqli_query($Link, $sql2);
					?>
					<?php
						$i = 1;
						while ($row2 = mysqli_fetch_assoc($result2)) {
								 ?>
							<div class="charts-data">
								<p><?php echo $i;?>.<?php echo $row2["Seller_ID"]; ?></p>
							</div>
							<?php $i++; ?>
					<?php } ?>
				</div>
				<div class="clear"></div>
			</div>
			<div class="list-area">
				<div class="list-title">
					<p>
						<img src="pic/eyes.png">跑跑卡丁車
					</p>
				</div>
				<div class="list-data">
					<ul>
						<li>遊戲幣</li>
						<li>道具</li>
						<li>帳號</li>
						<li>代練</li>
						<li>商城道具</li>
					</ul>
				</div>
				<div class="list-more">
					<?php echo"<a href=each-game-page.php?&p_game=跑跑卡丁車>>>>點我看全部</a>";?>
				</div>
				<div class="clear"></div>
				<div class="list-line"></div>
			</div>
			<div class="main">
				<div class="main-pic">
					<img src="pic/d2274503.jpeg" title="跑跑卡丁車" alt="跑跑卡丁車">
				</div>
				<div class="main-data">
					<?php
						$sql = "SELECT P_NAME,P_Code FROM product WHERE P_Game='跑跑卡丁車' AND P_Inv > 0";
						$result = mysqli_query($Link,$sql);
						for ($i=0; $i < 7; $i++) { 
							if($row = mysqli_fetch_assoc($result)) {
								echo "<a href='product.php?&p_code=$row[P_Code]'>".$row["P_NAME"]."</a><br/>";
							}
						}
						?>
				</div>
				<div class="sold-charts">
					<div class="charts-title">
						<h3>94會賣榜</h3>
					</div>
					<?php
						$sql2 = "SELECT Seller_ID, SUM(P_Price*P_SoldAmount) FROM product WHERE P_Game = '跑跑卡丁車' GROUP BY Seller_ID ORDER BY SUM(P_Price*P_SoldAmount) DESC LIMIT 3";
						$result2 = mysqli_query($Link, $sql2);
					?>
					<?php
						$i = 1;
						while ($row2 = mysqli_fetch_assoc($result2)) {
								 ?>
							<div class="charts-data">
								<p><?php echo $i;?>.<?php echo $row2["Seller_ID"]; ?></p>
							</div>
							<?php $i++; ?>
					<?php } ?>
				</div>
				<div class="clear"></div>
			</div>
			<div class="list-area">
				<div class="list-title">
					<p>
						<img src="pic/eyes.png">爆爆王
					</p>
				</div>
				<div class="list-data">
					<ul>
						<li>遊戲幣</li>
						<li>道具</li>
						<li>帳號</li>
						<li>代練</li>
						<li>商城道具</li>
					</ul>
				</div>
				<div class="list-more">
					<?php echo"<a href=each-game-page.php?&p_game=爆爆王>>>>點我看全部</a>";?>
				</div>
				<div class="clear"></div>
				<div class="list-line"></div>
			</div>
			<div class="main">
				<div class="main-pic">
					<img src="pic/23.jpeg" title="爆爆王" alt="爆爆王">
				</div>
				<div class="main-data">
				<?php
					$sql = "SELECT P_NAME,P_Code FROM product WHERE P_Game='爆爆王' AND P_Inv > 0";
					$result = mysqli_query($Link,$sql);
					for ($i=0; $i < 7; $i++) { 
				 	 if($row = mysqli_fetch_assoc($result)){
				 	 	echo "<a href='product.php?&p_code=$row[P_Code]'>".$row["P_NAME"]."</a><br/>";
				 	 } 	 	
					}					
				?>
				</div>
				<div class="sold-charts">
					<div class="charts-title">
						<h3>94會賣榜</h3>
					</div>
					<?php
						$sql2 = "SELECT Seller_ID, SUM(P_Price*P_SoldAmount) FROM product WHERE P_Game = '爆爆王' GROUP BY Seller_ID ORDER BY SUM(P_Price*P_SoldAmount) DESC LIMIT 3";
						$result2 = mysqli_query($Link, $sql2);
					?>
					<?php
						$i = 1;
						while ($row2 = mysqli_fetch_assoc($result2)) {
								 ?>
							<div class="charts-data">
								<p><?php echo $i;?>.<?php echo $row2["Seller_ID"]; ?></p>
							</div>
							<?php $i++; ?>
					<?php } ?>
				</div>
				<div class="clear"></div>
			</div>
		</div>
		<div class="footer">
			<p style="font-size: 14px;">Copyright © 2017 9487DB&PHP</p>
		</div>
	</div>
</body>
</html>
