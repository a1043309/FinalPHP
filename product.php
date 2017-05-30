<?php
header('Content-type: text/html; charset=utf-8');
session_start();
echo "<a href='index.php'>回首頁</a><br/><br/>";
$P_Code = $_GET["p_code"];

if(isset($_SESSION["ID"]))
	$UID = $_SESSION["ID"];

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
echo "<form action = 'purchaseconfirm.php' method = 'get' id = 'buy'><br/>";
echo "<input type = 'hidden' name = 'p_code' value = '$P_Code'>";
echo "輸入數量：：<input type='text' name='amount'></p>";
echo "</form>";
echo "<button type='submit' form='buy' id='purchase'>馬上購買</button><br/><br/><br/>";
echo "<img src='$P_ImgPath' width='300px' height='300px'><br/><br/><br/>";







echo "問與答<br/><br/><br/>";

$sql = "SELECT A1.U_ID U_ID, A2.Content Content, A2.Reply_Content Reply_Content
FROM user A1, question A2
WHERE A1.U_ID = A2.Asker_ID AND A2.P_Code = '$P_Code' ORDER BY A2.Post_Time DESC";

$result = mysqli_query($Link,$sql);
while($row = mysqli_fetch_assoc($result)){
	echo "發問者：".$row['U_ID']."<br/>";
	echo "問題：".$row['Content']."<br/>";
	echo "回覆：".$row['Reply_Content']."<br/>";
}

?>
