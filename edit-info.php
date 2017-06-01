<?php
	session_start();
	if(!isset($_SESSION["ID"]))
	header("Location:signin.php");

	$UID = $_SESSION["ID"];
	$Link = mysqli_connect('localhost','phpholyshit','tingting123','9487');
	if(!$Link)
		echo "連接失敗";

	if(isset($_POST["id"]))
	{
		if(isset($_POST["job"]) && isset($_POST["name"]) && isset($_POST["phone"]) && isset($_POST["email"]) && isset($_POST["gender"]))	
		{
			$sql = "UPDATE user SET U_NAME = '$_POST[name]', U_GENDER = '$_POST[gender]', U_JOB = '$_POST[job]', U_PHONE = '$_POST[phone]',U_EMAIL = '$_POST[email]' WHERE U_ID = '$UID'";
			$result = mysqli_query($Link,$sql);
		}
		else
			echo "請填寫完整";
	}
	$sql = "SELECT * FROM user WHERE U_ID = '$UID'";
	$result = mysqli_query($Link,$sql);
	$row = mysqli_fetch_assoc($result);

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
				<a href="#"><img src="pic/logo.png" alt="9487寶物交易網" title="9487寶物交易網"></a>
			</div>
			<div class="member-set">
				<a href="#">回上一頁</a>
			</div>
		</div>
		<div class="clear"></div>
		<div class="content">
			<div class="label-post">
				<div class="label-post-title">
					<h2>修改會員資料</h2>
				</div>
				<div class="label-post-line"></div>
			</div>
			<form action = 'editinfo.php' method = 'post' id = 'editinfo'>
			<div class="main-post">
				<div class="edit-info-data">
				<?php echo "<input type='hidden' name='id'value='$row[U_ID]'>"?>
					<p><span>&nbsp;&nbsp;注意事項：*為必填欄位</span></p>
					<p>&nbsp;帳&nbsp;&nbsp;&nbsp;號：<?php echo $UID; ?></p>
					<p>&nbsp;生&nbsp;&nbsp;&nbsp;日：<?php echo $row["U_BIRTH"]; ?></p>
					<p><span>*</span>姓&nbsp;&nbsp;&nbsp;名：<?php echo "<input type='text' name='name' value='$row[U_NAME]'>"; ?></p>
					<p><span>*</span>性&nbsp;&nbsp;&nbsp;別：<input type="radio" value="male" name="sex" id="radio-wdt50">男<input type="radio" value="female" name="sex" id="radio-wdt50">女</p>
					<p><span>*</span>職&nbsp;&nbsp;&nbsp;業：<select name='job'>
						<option value=NULL>選擇</option>
						<option value="student">學生</option>
						<option value="work">上班族</option>
					</select></p>
					<p><span>*</span>手&nbsp;&nbsp;&nbsp;機：<?php echo "<input type='text' name='phone' value='$row[U_PHONE]' maxlength='10' minlength='10'>"; ?></p>
					<p><span>*</span>E-mail：<?php echo "<input type='text' name='email' value='$row[U_EMAIL]'>"; ?></p>
					<p>&nbsp;密&nbsp;&nbsp;&nbsp;碼：&nbsp;* * * * * * * * * * * &nbsp;&nbsp;&nbsp;<span><a href="">(修改密碼)</a></span></p>
				</div>
				<div class="post-data"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input id="post-btn" type="submit" value="儲存設定"> &nbsp;&nbsp;&nbsp;
					<input id="post-btn" type="reset" value="重新填寫">
				</div>
			</div>
			</form>
		</div>
		<div class="clear"></div>
		<div class="footer">
			<p>Copyright © 2017 9487DB&PHP</p>
		</div>
	</div>
</body>
</html>