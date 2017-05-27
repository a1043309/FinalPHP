<?php
header('Content-type: text/html; charset=utf-8');
session_start();
if(!isset($_SESSION["ID"]))
	header("Location:signin.php");

$UID = $_SESSION["ID"];

$Link = mysqli_connect('localhost','phpholyshit','tingting123','9487');
	if(!$Link)
		echo "連接失敗";

if(isset($_POST["oldpwd"]) && isset($_POST["newpwd1"]) && isset($_POST["newpwd2"]))
{
	$sql = "SELECT U_PW FROM user WHERE U_ID='$UID'";
	$result = mysqli_query($Link,$sql);
	$row = mysqli_fetch_assoc($result);
	if($_POST["oldpwd"] == $row["U_PW"])
	{
		if($_POST["newpwd1"] == $_POST["newpwd2"])
		{
			$sql = "UPDATE user SET U_PW= '$_POST[newpwd1]'";
			$result = mysqli_query($Link,$sql);
			echo "更改成功";
		}
		else
		{
			echo "兩次輸入的密碼不相同";
		}
				
	}
	else
	{
		echo "密碼錯誤";
	}		
}
?>

<form action = 'changepwd.php' method = 'post' id = 'changepwd'><br/>
			<p>舊密碼：<input type='password' name='oldpwd'></p>
			<p>新密碼：<input type='password' name='newpwd1'></p>
			<p>再次輸入新密碼：<input type='password' name='newpwd2'></p>
			<input id="cp" type="submit" name="su" value="儲存設定"><input type="reset" value="重新填寫">
</form>
