<?php
header('Content-type: text/html; charset=utf-8');
session_start();
if(!isset($_SESSION["ID"]))
	header("Location:signin.php");

$UID = $_SESSION["ID"];

$Link = mysqli_connect('localhost','phpholyshit','tingting123','9487');
	if(!$Link)
		echo "連接失敗";
	mysqli_query($Link, "SET NAME UTF8");

if(isset($_POST["oldpwd"]) && isset($_POST["newpwd1"]) && isset($_POST["newpwd2"]))
{
	$sql = "SELECT U_PW FROM user WHERE U_ID='$UID'";
	$result = mysqli_query($Link,$sql);
	$row = mysqli_fetch_assoc($result);
	if($_POST["oldpwd"] == $row["U_PW"])
	{
		if($_POST["newpwd1"] == $_POST["newpwd2"])
		{
			$sql = "UPDATE user SET U_PW= '$_POST[newpwd1]' WHERE U_ID = '$UID'";
			$result = mysqli_query($Link,$sql);
			echo "<script>alert('更改成功');location.href='index.php'</script>";
		}
		else
		{
			echo "<script>alert('兩次輸入的密碼不相同');</script>";
		}
				
	}
	else
	{
		echo "<script>alert('密碼輸入錯誤');</script>";
	}		
}

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
				<a href="edit-info.php">回上一頁</a>
			</div>
		</div>
		<div class="clear"></div>
		<div class="content">
		<form action="change-pwd.php" method="post" id="changepwd">
			<div class="label-post">
				<div class="label-post-title">
					<h2>修改密碼</h2>
				</div>
				<div class="label-post-line"></div>
			</div>
			<div class="main-post">
				<div class="change-pwd-area">
					<div class="change-pwd-text" id="change-pwd-text-tl">
						<p style="font-size: 18px;text-align: center;padding-top: 30px;">舊密碼：</p>
					</div>
					<div class="change-pwd-data" id="change-pwd-data-tr">
						<p style="font-size: 18px;"><input type="password" name="oldpwd"></p>
					</div>
				</div>
				<div class="change-pwd-area">
					<div class="change-pwd-text" id="change-pwd-text-l">
						<p style="font-size: 18px;text-align: center;padding-top: 30px;">新密碼：</p>
					</div>
					<div class="change-pwd-data" id="change-pwd-data-r">
						<p style="font-size: 18px;">
							<input type="password" maxlength="20" name="newpwd1">
							<span>*請區分大小寫，字元上限為20個字元</span>
						</p>
					</div>
				</div>
				<div class="change-pwd-area">
					<div class="change-pwd-text" id="change-pwd-text-bl">
						<p style="font-size: 18px;text-align: center;padding-top: 30px;">再次輸入新密碼：</p>
					</div>
					<div class="change-pwd-data" id="change-pwd-data-br">
						<p style="font-size: 18px;"><input type="password" maxlength="20" name="newpwd2"></p>
					</div>
				</div>
				<div class="clear"></div>
				<div class="post-data"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input id="post-btn" type="submit" value="儲存設定"> &nbsp;&nbsp;&nbsp;
					<input id="post-btn" type="reset" value="重新填寫">
				</div>
			</div>
		</div>
		</form>
		<div class="clear"></div>
		<div class="footer">
			<p style="font-size: 14px;">Copyright © 2017 9487DB&PHP</p>
		</div>
	</div>
</body>
</html>