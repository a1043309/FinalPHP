<!DOCTYPE html>
<html lang="en">
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
		<a href="#" class="lid-member">會員專區</a>
		<a href="#" class="lid-member">立即註冊</a>
		<a href="#" class="lid-member">會員登入</a>
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
		<div class="nav-menu">
			<ul>
				<li>
					<a href="#">首頁</a>
					<a href="#">新楓之谷</a>
					<a href="#">跑跑卡丁車</a>
					<a href="#">爆爆王</a>
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
						<li><a href="#">代練</a></li>
						<li><a href="#">楓幣</a></li>
						<li><a href="#">送禮</a></li>
						<li><a href="#">裝備</a></li>
						<li><a href="#">序號</a></li>
					</ul>
				</div>
				<div class="list-more">
					<a href="#">>>>點我看全部</a>
				</div>
				<div class="clear"></div>
				<div class="list-line"></div>
			</div>
			<div class="main">
				<div class="main-pic">
					<img src="pic/14248488949068911.jpeg" title="新楓之谷" alt="新楓之谷">
				</div>
				<div class="main-data"></div>
				<div class="sold-charts">
					<div class="charts-title">
						<h3>94會賣榜</h3>
					</div>
					<div class="charts-data">
						<p>1.OEBOEBOEB</p>
					</div>
					<div class="charts-data">
						<p>2.oPTToYoYowen</p>
					</div>
					<div class="charts-data">
						<p>3.EuniceDai8787</p>
					</div>
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
						<li><a href="#">S R</a></li>
						<li><a href="#">Z 7</a></li>
						<li><a href="#">S T</a></li>
						<li><a href="#">9代車</a></li>
						<li><a href="#">帳號</a></li>
					</ul>
				</div>
				<div class="list-more">
					<a href="#">>>>點我看全部</a>
				</div>
				<div class="clear"></div>
				<div class="list-line"></div>
			</div>
			<div class="main">
				<div class="main-pic">
					<img src="pic/d2274503.jpeg" title="跑跑卡丁車" alt="跑跑卡丁車">
				</div>
				<div class="main-data"></div>
				<div class="sold-charts">
					<div class="charts-title">
						<h3>94會賣榜</h3>
					</div>
					<div class="charts-data">
						<p>1.OEBOEBOEB</p>
					</div>
					<div class="charts-data">
						<p>2.oPTToYoYowen</p>
					</div>
					<div class="charts-data">
						<p>3.EuniceDai8787</p>
					</div>
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
						<li><a href="#">道具</a></li>
						<li><a href="#">代練</a></li>
						<li><a href="#">帳號</a></li>
						<li><a href="#">序號</a></li>
						<li><a href="#">戰績</a></li>
					</ul>
				</div>
				<div class="list-more">
					<a href="#">>>>點我看全部</a>
				</div>
				<div class="clear"></div>
				<div class="list-line"></div>
			</div>
			<div class="main">
				<div class="main-pic">
					<img src="pic/23.jpeg" title="爆爆王" alt="爆爆王">
				</div>
				<div class="main-data"></div>
				<div class="sold-charts">
					<div class="charts-title">
						<h3>94會賣榜</h3>
					</div>
					<div class="charts-data">
						<p>1.OEBOEBOEB</p>
					</div>
					<div class="charts-data">
						<p>2.oPTToYoYowen</p>
					</div>
					<div class="charts-data">
						<p>3.EuniceDai8787</p>
					</div>
				</div>
				<div class="clear"></div>
			</div>
		</div>
		<div class="footer">
			<p>Copyright © 2017 9487DB&PHP</p>
		</div>
	</div>
</body>
</html>