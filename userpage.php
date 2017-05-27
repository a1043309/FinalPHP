<?php
echo "<a href = 'index.php'>回到首頁</a><br/><br/><br/>";
header('Content-type: text/html; charset=utf-8');
session_start();
if(!isset($_SESSION["ID"]))
	header("Location:signin.php");

$UID = $_SESSION["ID"];
$Link = mysqli_connect('localhost','phpholyshit','tingting123','9487');
if(!$Link)
		echo "連接失敗";
echo "<a href='editinfo.php'>編輯資料</a><br/><br/>";
$sql = "SELECT SUM(RateToBuyer) AS RATESUM, COUNT(RateToBuyer) AS RATECOUNT FROM PURCHASE WHERE Buyer_ID='$UID'";

$result = mysqli_query($Link,$sql);
$row = mysqli_fetch_assoc($result);
if($row["RATECOUNT"] == 0)
{
	echo "您有".$row["RATECOUNT"]."筆購買評價,平均評價分數為：0<br/><br/>";
}
else
	echo "您有".$row["RATECOUNT"]."筆購買評價,平均評價分數為：".$row["RATESUM"]/$row["RATECOUNT"]."<br/><br/>";


$sql2 = "SELECT SUM(RateToSeller) AS RATESUM, COUNT(RateToSeller) AS RATECOUNT FROM purchase WHERE P_Code IN (SELECT P_Code FROM product WHERE Seller_ID = '$UID')";

$result2 = mysqli_query($Link,$sql2);
$row2 = mysqli_fetch_assoc($result2);
if($row2["RATECOUNT"] == 0)
	echo "您有".$row2["RATECOUNT"]."筆賣出評價,平均評價分數為：0<br/><br/>";
else
	echo "您有".$row2["RATECOUNT"]."筆賣出評價,平均評價分數為：".$row2["RATESUM"]/$row2["RATECOUNT"]."<br/><br/>";

$totalRateCount = ($row["RATECOUNT"]+$row2["RATECOUNT"]);

if($totalRateCount == 0)
{
	echo "您總共有".$totalRateCount."筆評價,總平均評價為：0<br/><br/><br/><br/><br/>";
}
else
	echo "您總共有".$totalRateCount."筆評價,總平均評價為".($row["RATESUM"] + $row2["RATESUM"])/$totalRateCount."<br/><br/><br/><br/><br/>";

echo "我是買家<br/><br/>";

echo "我的訂單：<br/>";

$sql = "SELECT P_NAME,P_Code FROM product WHERE P_Code IN (SELECT P_Code FROM purchase WHERE Buyer_ID='$UID' AND isReceive = '0')";
$result = mysqli_query($Link,$sql);
while($row = mysqli_fetch_assoc($result))
{
	echo "<a href=product.php?&p_code=$row[P_Code]>$row[P_NAME]</a><br/>";
}

echo "<br/><br/><br/>";
echo "已購買的商品：<br/>";

$sql = "SELECT P_NAME,P_Code FROM product WHERE P_Code IN (SELECT P_Code FROM purchase WHERE Buyer_ID='$UID' AND isReceive = '1')";
$result = mysqli_query($Link,$sql);
while($row = mysqli_fetch_assoc($result))
{
	echo "<a href=product.php?&p_code=$row[P_Code]>$row[P_NAME]</a><br/>";
}

echo "<br/><br/><br/>";
echo "賣家回答：<br/>";

$sql = "SELECT P_NAME,P_Code FROM product WHERE P_Code IN (SELECT P_Code FROM question WHERE Asker_ID = '$UID')";

$result = mysqli_query($Link,$sql);
while($row = mysqli_fetch_assoc($result))
{
	echo "<a href=product.php?&p_code=$row[P_Code]>$row[P_NAME]</a><br/>";
}

echo "<br/><br/><br/>";
echo "賣家評價：<br/>";

$sql = "SELECT P_NAME,P_Code FROM product WHERE P_Code IN (SELECT P_Code FROM purchase WHERE Buyer_ID = '$UID' AND RateToBuyer IS NOT NULL)";

$result = mysqli_query($Link,$sql);
while($row = mysqli_fetch_assoc($result))
{
	echo "<a href=product.php?&p_code=$row[P_Code]>$row[P_NAME]</a><br/>";
}

echo "<br/><br/><br/><br/><br/>";
echo "我是賣家<br/><br/>";

echo "<br/><br/><br/>";
echo "我的商品：<br/>";

$sql = "SELECT P_NAME,P_Code FROM product WHERE Seller_ID='$UID'";

$result = mysqli_query($Link,$sql);
while($row = mysqli_fetch_assoc($result))
{
	echo "<a href=product.php?&p_code=$row[P_Code]>$row[P_NAME]</a><br/>";
}

echo "<br/><br/><br/>";
echo "已完成的交易：<br/>";

$sql = "SELECT P_NAME,P_Code FROM product WHERE Seller_ID = '$UID' AND P_Code IN (SELECT P_Code FROM purchase WHERE isReceive='1')";

$result = mysqli_query($Link,$sql);
while($row = mysqli_fetch_assoc($result))
{
	echo "<a href=product.php?&p_code=$row[P_Code]>$row[P_NAME]</a><br/>";
}

echo "<br/><br/><br/>";
echo "買家疑問：<br/>";

$sql = "SELECT P_NAME,P_Code FROM product WHERE Seller_ID='$UID' AND P_Code IN (SELECT P_Code FROM question)";

$result = mysqli_query($Link,$sql);
while($row = mysqli_fetch_assoc($result))
{
	echo "<a href=product.php?&p_code=$row[P_Code]>$row[P_NAME]</a><br/>";
}

echo "<br/><br/><br/>";
echo "訂單管理：<br/>";

$sql = "SELECT P_NAME,P_Code FROM product WHERE Seller_ID='$UID' AND P_Code IN (SELECT P_Code FROM purchase WHERE isReceive = '0')";

$result = mysqli_query($Link,$sql);
while($row = mysqli_fetch_assoc($result))
{
	echo "<a href=product.php?&p_code=$row[P_Code]>$row[P_NAME]</a><br/>";
}

echo "<br/><br/><br/>";
echo "買家評價：<br/>";

$sql = "SELECT P_NAME,P_Code FROM product WHERE Seller_ID = '$UID' AND P_Code IN (SELECT P_Code FROM purchase WHERE RateToSeller IS NOT NULL)";

$result = mysqli_query($Link,$sql);
while($row = mysqli_fetch_assoc($result))
{
	echo "<a href=product.php?&p_code=$row[P_Code]>$row[P_NAME]</a><br/>";
}


