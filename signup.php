<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>註冊</title>
	<link rel="stylesheet" type="text/css" href="sign.css">
</head>
<body>
	<div class="header" style="margin-top: 30px;">
		<img id="hlogo" src="./pic/logo.png" style="width: 25%">
		<a href="#">返回首頁</a>
		<div class="clear"></div>
	</div>
	<div class="content">
		<div class="one">
			<p class="onee">1</p>
			<p id="write">填寫註冊資料</p>
			<div class="clear"></div>
		</div>
		<div class="info">
			<p>姓名：<input type="text" name="name"></p>
			<p>性別：<input id="gender" type="radio" name="gender" value="male"> 男生 <input id="gender" type="radio" name="gender" value="female"> 女生</p>
			<p>帳號：<input type="text" name="id"><button>檢查</button><a>*註冊後無法修改，長度限制20字元以內</a></p>
			<p>密碼：<input type="password" name="pwd"><a>*請區分大小寫，長度限制20以內</a></p>
			<p>職業：<select>
						<option value="null">選擇</option>
						<option value="student">學生</option>
						<option value="work">上班族</option>
					</select></p>
			<p>生日：<input type="date" name="birth"></p>
			<p>手機：<input type="text" name="mobile"></p>
			<p>E-mail: <input type="text" name="email"></p>
			<input id="su" type="submit" name="su" value="立即註冊">
		</div>
		<div class="clear"></div>
	</div>
	<div class="footer">
		<p>©copyright by 2017 9487DB&PHP</p>
	</div>
</body>
</html>