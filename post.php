<?php
header('Content-type: text/html; charset=utf-8');
echo "<a href='index.php'>回首頁</a><br/><br/>";
session_start();
if(!isset($_SESSION["ID"]))
	header("Location:signin.php");

else if(isset($_POST["game"]) && isset($_POST["server"]) && isset($_POST["classify"]) && isset($_POST["p_name"]) && isset($_POST["p_price"]) && isset($_POST["p_inv"]))
{
	$game = $_POST["game"];
	$server = $_POST["server"];
	$classify = $_POST["classify"];
	$p_name = $_POST["p_name"];
	$p_price = $_POST["p_price"];
	$p_inv = $_POST["p_inv"];

	$UID = $_SESSION["ID"];
	$Link = mysqli_connect('localhost','phpholyshit','tingting123','9487');
	if(!$Link)
		echo "連接失敗";
	$p_code=substr(md5(rand()),0,12);
	echo $p_code;

	$imgPath;
	$sql = "SELECT * FROM product WHERE P_Code = '$p_code'";
	$result = mysqli_query($Link,$sql);
	while($row = mysqli_fetch_assoc($result))
	{
		$p_code=substr(md5(rand()),0,12);
		$sql = "SELECT * FROM product WHERE P_Code = '$p_code'";
		$result = mysqli_query($Link,$sql);
		echo "重複";
	}
	if(isset($_FILES["img"]))
	{
		echo $_FILES["img"]["name"];
		$a = pathinfo($_FILES["img"]["name"]);
		$t = time();
     	if(move_uploaded_file($_FILES["img"]["tmp_name"],"product/img/".$p_code.$_FILES["img"]["name"])){
     		$imgPath = "product/img/".$p_code.$_FILES["img"]["name"];
     		echo "檔案上傳成功";
     	}
     	else
     		echo "失敗";
	}
	


	echo "刊登";
	
	$sql = "INSERT INTO product(P_Code,P_Game,P_Server,P_Classify,P_Inv,P_NAME,P_Price,P_SoldAmount,Seller_ID) VALUES('$p_code','$game','$server','$classify','$p_inv','$p_name','$p_price',0,'$UID')";
	echo $sql;
	$result = mysqli_query($Link,$sql);
	$result = mysqli_query($Link,"UPDATE product SET P_ImgPath = '$imgPath' WHERE P_Code = '$p_code'");
	echo $p_code;
	header("Location:product.php?&p_code=".$p_code);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<form action = 'post.php' method = 'post' id = 'changepwd' enctype="multipart/form-data"><br/>
<p>選擇遊戲：<select name='game'>
	<option value=NULL>選擇</option>
	<option value="kart">跑跑卡丁車</option>
	<option value="bnb">爆爆王</option>
	<option value="maplestory">新楓之谷</option>
</select></p>

伺服器：<input type="text" name="server"><br/>
選擇分類：<input type="text" name="classify"><br/>
商品名稱：<input type="text" name="p_name"><br/>
價格：<input type="text" name="p_price"><br/>
數量：<input type="text" name="p_inv"><br/>
商品圖片：<input type="file" name="img" accept="image/*"><br/>
<input id="post" type="submit" value="提交"><input type="reset" value="重新填寫">
</form>
</body>
</html>

