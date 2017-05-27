<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<?php
header('Content-type: text/html; charset=utf-8');
echo "<a href='index.php'>回首頁</a><br/><br/>";
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
<form action = 'editinfo.php' method = 'post' id = 'editinfo'><br/>
			<?php echo "<input type='hidden' name='id'value='$row[U_ID]'>"?>
			<p>帳號：<?php echo $UID; ?></p>
			<p>生日：<?php echo $row["U_BIRTH"]; ?></p>
			<?php echo "<p>姓名：<input type='text' name='name' value='$row[U_NAME]'></p>";?>
			<p>性別：<input id="gender" type="radio" name="gender" value="male"> 男生 <input id="gender" type="radio" name="gender" value="female"> 女生</p>			
			<p>職業：<select name='job'>
						<option value=NULL>選擇</option>
						<option value="student">學生</option>
						<option value="work">上班族</option>
					</select></p>			
			<?php echo "<p>手機：<input type='text' name='phone' value='$row[U_PHONE]'></p>";?>
			<?php echo "<p>E-mail：<input type='text' name='email' value='$row[U_EMAIL]'></p>";?>
			<p>密碼：******** <a href="changepwd.php">(修改密碼)</a></p>
			<input id="ei" type="submit" name="su" value="儲存設定"><input type="reset" value="重新填寫">
</form>