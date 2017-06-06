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
	$sql2 = "SELECT * FROM user WHERE U_ID = '$UID'";
	$result2 = mysqli_query($Link,$sql2);
	$row2 = mysqli_fetch_assoc($result2);
	if($row2['U_Right'] != 1)
	{
		//header("Location:index.php");
	}
		
	
}

echo "<a href = 'backstage.php?p_manage=0'>商品管理     </a>";
echo "<a href = 'backstage.php?u_manage=0'>會員管理</a><br/><br/><br/>";

if(isset($_GET["p_manage"]))
{
	echo "商品列表：<br/><br/>";
	$sql = "SELECT * FROM product";
	$result = mysqli_query($Link,$sql);
	while($row = mysqli_fetch_assoc($result))
	{
		$p_code = $row['P_Code'];
		echo "商品名稱：".$row['P_NAME']."<br/>";
		echo "賣家：".$row['Seller_ID']."<br/>";
		echo "<a href = 'editproduct.php?p_code=$p_code'>修改</a><br/><br/>";
	}
}
else if (isset($_GET["u_manage"]))
{
	echo "會員列表：<br/><br/>";
	$sql = "SELECT * FROM user";
	$result = mysqli_query($Link,$sql);
	while($row = mysqli_fetch_assoc($result))
	{
		echo "會員ID：".$row['U_ID']."<br/>";
		echo "會員姓名：".$row['U_NAME']."<br/><br/><br/>";
	}
}
?>