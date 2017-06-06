<?php
header('Content-type: text/html; charset=utf-8');
session_start();

$Link = mysqli_connect('localhost','phpholyshit','tingting123','9487');
	if(!$Link)
		echo "連接失敗";

if(!isset($_SESSION["ID"]))
{
	header("Location:signin.php");
}
else
{
	$UID = $_SESSION["ID"];
	$sql = "SELECT * FROM user WHERE U_ID = '$UID'";
	$result = mysqli_query($Link,$sql);
	$row = mysqli_fetch_assoc($result);
	
	if($row['U_Right'] != 1)
		header("Location:index.php");
	else
		$_SESSION["isAdmin"] = true;
}

$Link = mysqli_connect('localhost','phpholyshit','tingting123','9487');
	if(!$Link)
		echo "連接失敗";
mysqli_query($Link, "SET NAMES UTF8");

if(isset($_GET['user'])){
	$user = $_GET['user'];
}
else
{
	header("Location:index.php");
}
if(isset($_POST["oid"]))
	{
		if(isset($_POST["name"]) && isset($_POST["phone"]) && isset($_POST["email"]) && isset($_POST["id"]))	
		{
			$oid = $_POST["oid"];
			$sql = "UPDATE user SET U_NAME = '$_POST[name]', U_ID = '$_POST[id]', U_PHONE = '$_POST[phone]',U_EMAIL = '$_POST[email]' WHERE U_ID = '$oid'";
			$result = mysqli_query($Link,$sql);
			echo $sql;
			//echo "<script>alert('更改成功');location.href='admin.php'</script>";
		}
		else{
			echo "<script>alert('請填寫完整');</script>";
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>修改會員</title>
	<link rel="stylesheet" type="text/css" href="css/yoyo.css">
</head>
<body style="max-width: 1100px;margin: 0 auto;">
	<div class="user_header">
			<a href="index.php"><img src="pic/logo.png"></a>
			<div class="clear"></div>
	</div>
	<div class="content" style="position: relative;">
			<div class="content-title" style="border-bottom: 3px solid lightblue;padding-bottom: 5px;">
				<img src="pic/title.png" class="imbuyer">
				<p style="position: absolute;float: left;left: 7%;color: white;">修改會員</p>
				<div class="clear"></div>
			</div>
			<div style="margin: 0 auto;text-align: center;">
				<?php
					$sql = "SELECT * FROM user WHERE U_ID = '$user'";
					$result = mysqli_query($Link, $sql);
					$row = mysqli_fetch_assoc($result);
				?>
				<form action="editmember.php" method="post">
				<?php echo "<input type='hidden' name='oid' value='$user'>"?>
				<p>帳號：<?php echo "<input type='text' name='id' value='$row[U_ID]'>"; ?></p>
				<p>姓名：<?php echo "<input type='text' name='name' value='$row[U_NAME]'>"; ?></p>
				<p>手機：<?php echo "<input type='text' name='phone' value='$row[U_PHONE]'>"; ?></p>
				<p>E-mail：<?php echo "<input type='text' name='email' value='$row[U_EMAIL]'>"; ?></p>
				<input id="post-btn" type="submit" value="儲存設定"> &nbsp;&nbsp;&nbsp;
				<input id="post-btn" type="reset" value="重新填寫">
				</form>
			</div>
	</div>
	<div class="footer" style="margin: unset;font-weight: unset;padding-top: 180px;">
		<p style="font-size:14px;">Copyright © 2017 9487DB&PHP</p>
	</div>
</body>
</html>