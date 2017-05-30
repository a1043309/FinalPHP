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
				<a href="#"><img src="pic/logo.png" alt="9487寶物交易網" title="9487寶物交易網"></a>
			</div>
			<div class="member-set">
				<a href="#">登出</a>
				<p>｜</p>
				<a href="#">我的拍賣</a>
				<a href="#">$300</a>
			</div>
		</div>
		<div class="clear"></div>
		<div class="content">
			<div class="label-post">
				<div class="label-post-title">
					<h2>我要刊登</h2>
				</div>
				<div class="label-post-line"></div>
			</div>
			<div class="main-post">
				<div class="post-data">選擇遊戲：
					<select id="selected-post">
						<option value="null">---選擇遊戲---</option>
						<option value="mapelstory">新楓之谷</option>
						<option value="kartrider">跑跑卡丁車</option>
						<option value="bnb">爆爆王</option>
					</select>
				</div>
				<div class="post-data">選擇伺服：
					<select id="selected-post">
						<option value="all">全伺服器</option>
						<option value="1">雪吉拉</option>
						<option value="2">星光精靈</option>
						<option value="3">藍寶</option>
						<option value="3">菇菇寶貝</option>
						<option value="3">緞帶肥肥</option>
						<option value="3">綠水靈</option>
						<option value="3">九大</option>
						<option value="3">三大</option>
					</select>
				</div>
				<div class="post-data">選擇分類：
					<select id="selected-post">
						<option value="all">全部</option>
						<option value="1">遊戲幣</option>
						<option value="2">道具</option>
						<option value="3">帳號</option>
						<option value="4">代練</option>
						<option value="5">其他</option>
						<option value="6">商城道具</option>
					</select>
				</div>
				<div class="post-data">商品名稱：
					<input id="selected-post" type="text" maxlength="20"><span>*上限為20字</span>		
				</div>
				<div class="post-data">價 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;格：
					<input id="selected-post" type="number" min="0">		
				</div>
				<div class="post-data">數 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;量：
					<input id="selected-post" type="number" min="0">		
				</div>
				<div class="post-data">商品照片：
					<input id="selected-post" type="file">		
				</div>
				<div class="post-data"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input id="post-btn" type="submit" value="提交"> &nbsp;&nbsp;&nbsp;
					<input id="post-btn" type="reset" value="重新填寫">
				</div>
			</div>
		</div>
		<div class="clear"></div>
		<div class="footer">
			<p>Copyright © 2017 9487DB&PHP</p>
		</div>
	</div>
</body>
</html>