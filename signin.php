<?php
header('Content-type: text/html; charset=utf-8');
session_start();
if(isset($_SESSION["ID"]))
{
		header("Location:index.php");
}
/*
if(!isset($_SESSION["ID"]))
{
	echo "<form action = 'singin.php' method = 'post'><br/>";
	echo "帳號：<input type = 'text' name ='id'<br/>";
	echo "密碼：<input type = 'password' name ='pw'<br/>";
	echo "<input type = 'submit' name = ''>";
}*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>登入</title>
	<link rel="stylesheet" type="text/css" href="css/sign.css">
</head>
<body>
	<div class="header">
		<a href="index.php">返回首頁</a>
		<div class="clear"></div>
	</div>
	<div class="content">
		<div class="logo">
			<img src="./pic/logo.png">
		</div>
		<div class="signin">
			<p id="title">會員登入</p>
			<form action = 'index.php' method = 'post' id = 'loginn'><br/>
			<p id="idd">帳號：<input type="text" name="id"></p>
			<p id="pwdd">密碼：<input type="password" name="pwd"></p>
			</form>
			<button class="upp" onclick="self.location.href='signup.php'">註冊</button>
			<button type="submit" form="loginn" id="login">登入</button>

		</div>
		<div class="clear"></div>
	</div>
</body>
</html>