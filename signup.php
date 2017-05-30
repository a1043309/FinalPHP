<?php
if(isset($_SESSION["ID"]))
	header("Location:index.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>註冊</title>
	<link rel="stylesheet" type="text/css" href="css/sign.css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js" type="text/javascript"></script>
	<script type="text/javascript">
		<?php 
			function check(){
				$id = $_GET["id"];

				$Link = mysqli_connect('localhost','root','e1e2e3','9487');

				$Link = mysqli_connect('localhost','root','e1e2e3','9487');
				if(!$Link){
				echo "連接失敗";
				}

				$result = mysqli_query($Link,"SELECT * FROM user");

				$new = '';
				while($row = mysqli_fetch_assoc($result)){
					if($row["U_ID"] == $id){
						$new = "這個ID已被使用";
						return $new;
					}
				}
				if ($new != "used") {
					$new = "恭喜 這個ID可以使用"
					return $new;
				}
			}
		?>
		$("detect").onclick("")
	</script>
</head>
<body>
	<div class="header" style="margin-top: 30px;">
		<img id="hlogo" src="./pic/logo.png" style="width: 25%">
		<a href="index.php">返回首頁</a>
		<div class="clear"></div>
	</div>
	<div class="content">
		<div class="one">
			<p class="onee">1</p>
			<p id="write">填寫註冊資料</p>
			<div class="clear"></div>
		</div>
		<div class="info">
		<form action = "" method = "get" name="loginn"><br/>
			<p>姓名：<input type="text" name="name"></p>
			<p>性別：<input id="gender" type="radio" name="gender" value="male"> 男生 <input id="gender" type="radio" name="gender" value="female"> 女生</p>
			<p>帳號：<input type="text" name="id"><button id="detect" onclick="check();" type = "button">檢查</button><a>*註冊後無法修改，長度限制20字元以內</a></p>
			<p>密碼：<input type="password" name="pwd"><a>*請區分大小寫，長度限制20以內</a></p>
			<p>職業：<select name='job'>
						<option value="null">選擇</option>
						<option value="student">學生</option>
						<option value="work">上班族</option>
					</select></p>
			<p>生日：<input type="date" name="birth"></p>
			<p>手機：<input type="text" name="phone"></p>
			<p>E-mail: <input type="text" name="email"></p>
			<input id="su" type="button" name="su" value="立即註冊">
		</div>
		<div class="clear"></div>
	</div>
	<div class="footer">
		<p>©copyright by 2017 9487DB&PHP</p>
	</div>
</body>
</html>

