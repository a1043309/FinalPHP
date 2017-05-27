<?php
header('Content-type: text/html; charset=utf-8');
session_start();
echo "<a href='index.php'>回首頁</a><br/><br/>";
$P_Code = $_GET["p_code"];

$Link = mysqli_connect('localhost','phpholyshit','tingting123','9487');
	if(!$Link)
		echo "連接失敗";

$sql = "SELECT * FROM product WHERE P_Code = '$P_Code'";
$result = mysqli_query($Link,$sql);
$row = mysqli_fetch_assoc($result);

$P_Name = $row["P_NAME"];
$P_Price = $row["P_Price"];
$P_ImgPath = $row["P_ImgPath"];
$P_SoldAmount = $row["P_SoldAmount"];
$P_Inv = $row["P_Inv"];
$Seller_ID = $row["Seller_ID"];

echo $P_Name."<br/>";
echo "$".$P_Price."<br/>";
echo "已賣數量：".$P_SoldAmount."<br/>";
echo "(庫存：".$P_Inv.")<br/>";
echo "賣家：".$Seller_ID."<br/>";
echo "<img src='$P_ImgPath' width='300px' height='300px'>";
?>
