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
		function check(){
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.open("get","idcheck.php");
			xmlhttp.onload=function(){
				document.loginn.action="idcheck.php";
				document.loginn.submit();
				};
			xmlhttp.send();
		}
		function sign(){
			if(loginn.name.value == "") 
                {
                        alert("未輸入姓名");
                }
                <!-- 若<form>屬性name值為reg裡的文字方塊與下拉式選單值為空字串或是沒有選擇月或日，則顯示「未輸入完整生日日期」 -->
                else if(loginn.birth.value == "")
                {
                        alert("未輸入完整生日日期");
                }
                <!-- 若<form>屬性name值為reg裡的核取方塊沒有選擇，則顯示「未選擇性別」 -->
                else if(!loginn.gender[0].checked && !loginn.gender[1].checked)
                {
                         alert("未選擇性別");
                }
                else if(loginn.id.value == "")
                {
                         alert("未輸入帳號");
                }
                else if(loginn.phone.value == "")
                {
                         alert("未輸入手機");
                }
                else if(loginn.email.value == "")
                {
                         alert("未輸入email");
                }
                else {
                	var si = new XMLHttpRequest();
					si.open("get","signupsubmit.php");
					si.onload=function(){
					document.loginn.action="signupsubmit.php";
					document.loginn.submit();
					};
					si.send();
                }           	
		}
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
			<p>生日：<input type="date" name="birth"><a>YYYY-MM-DD</a></p>
			<p>手機：<input type="text" name="phone"></p>
			<p>E-mail: <input type="text" name="email"></p>
			<input id="su" type="button" onclick="sign();" name="su" value="立即註冊">
		</div>
		<div class="clear"></div>
	</div>
	<div class="footer">
		<p>©copyright by 2017 9487DB&PHP</p>
	</div>
</body>
</html>

