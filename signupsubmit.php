<?php
header('Content-type: text/html; charset=utf-8');
if (isset($_GET["id"]))
{
	$id = $_GET["id"];
	$pwd = $_GET["pwd"];
	$name = $_GET["name"];
	$gender = $_GET["gender"];
	$job = $_GET["job"];
	$birth = $_GET["birth"];
	$phone = $_GET["phone"];
	$email = $_GET["email"];

	$isUsed = false;

	$Link = mysqli_connect('localhost','phpholyshit','tingting123','9487');
	if(!$Link)
		echo "連接失敗";

	mysqli_query($Link, "SET NAMES UTF8");

	$result = mysqli_query($Link,"SELECT * FROM user");	
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>註冊成功</title>
	<link rel="stylesheet" type="text/css" href="css/yoyo.css">
</head>
<body>
	<div class="success_wrap">
		<div class="success_header">
			<img src="pic/logo.png">
		</div>
		<div class="success_line"></div>
		<div class="success_content">
			<img src="pic/eyes.png">
			<?php 
			$result = mysqli_query($Link,"SELECT * FROM user");
			while($row = mysqli_fetch_assoc($result)){
				if($row["U_ID"] == $id)
				{
					echo "你選擇的ID已被使用";
					$isUsed = true;
				}
			}	
			if(!$isUsed)
			{
				$result = mysqli_query($Link,"INSERT INTO user(U_ID,U_PW,U_NAME,U_BIRTH,U_GENDER,U_PHONE,U_EMAIL,U_JOB) VALUES('$id','$pwd','$name','$birth','$gender','$phone','$email','$job')");
				
				echo "<p id='success'>&nbsp;&nbsp;&nbsp;恭喜您，註冊成功！！</p>";
				echo "<p id='success_describe'>3秒後，自動跳回首頁......</p>";
				header("Refresh:3;url=index.php");
			}
			?>
		</div>

		<div class="footer">
			<p>©copyright by 2017 9487DB&PHP</p>
		</div>
	</div>
</body>
</html>
