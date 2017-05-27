<?php
session_start();
header('Content-type: text/html; charset=utf-8');

if(isset($_GET["logout"]))
{
	unset($_SESSION["ID"]);
	header("Location:index.php");
}

$Link = mysqli_connect('localhost','phpholyshit','tingting123','9487');
	if(!$Link)
		echo "連接失敗";
if(isset($_SESSION["ID"]))
{
	$UID = $_SESSION["ID"];
	$result = mysqli_query($Link,"SELECT U_MONEY FROM user WHERE U_ID = '$UID'");
	$row = mysqli_fetch_assoc($result);
	echo "$".$row["U_MONEY"];
	echo "<a href='index.php?&logout=yes'>登出</a>";
	echo "<a href='userpage.php'>會員專區</a>";
	echo "<a href='post.php'>我要刊登</a><br/><br/><br/>";

	echo "跑跑卡丁車<br/><br/>";

	$sql = "SELECT P_NAME,P_Code FROM product WHERE P_Game='kart'";
	$result = mysqli_query($Link,$sql);
	while($row = mysqli_fetch_assoc($result))
	{
		echo "<a href='product.php?&p_code=$row[P_Code]'>".$row["P_NAME"]."</a><br/>";
	}
	echo "<br/><br/><br/><br/>";

	echo "爆爆王<br/><br/>";

	$sql = "SELECT P_NAME,P_Code FROM product WHERE P_Game='bnb'";
	$result = mysqli_query($Link,$sql);
	while($row = mysqli_fetch_assoc($result))
	{
		echo "<a href='product.php?&p_code=$row[P_Code]'>".$row["P_NAME"]."</a><br/>";
	}

	echo "<br/><br/><br/><br/>";

	echo "新楓之谷<br/><br/>";

	$sql = "SELECT P_NAME,P_Code FROM product WHERE P_Game='maplestory'";
	$result = mysqli_query($Link,$sql);
	while($row = mysqli_fetch_assoc($result))
	{
		echo "<a href='product.php?&p_code=$row[P_Code]'>".$row["P_NAME"]."</a><br/>";
	}
}
else if (isset($_POST["id"]))
{
	$id = $_POST["id"];
	$pwd = $_POST["pwd"];
	
	$result = mysqli_query($Link,"SELECT * FROM user");

	while($row = mysqli_fetch_assoc($result)){
		if($row["U_ID"] == $id)
		{
			if($row["U_PW"] == $pwd){
				$_SESSION["ID"] = $id;
				header("Location:index.php");
				break;
			}			
		}
	}
	if(!isset($_SESSION["ID"]))
		echo "登入失敗";
}
else
{
	echo "<a href='signin.php'>會員登入</a>";
	echo "<a href='signup.php'>立即註冊</a>";
	echo "<a href='userpage.php'>會員專區</a>";
}