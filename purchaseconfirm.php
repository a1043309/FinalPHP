<?php
header('Content-type: text/html; charset=utf-8');
session_start();
if(!isset($_GET["p_code"]))
{
	header("Location:index.php");
}
else if (!isset($_SESSION["ID"]))
{
	header("Location:signin.php");
}
else
{	
	$p_code = $_GET["p_code"];
	$Link = mysqli_connect('localhost','phpholyshit','tingting123','9487');
	if(!$Link)
		echo "連接失敗";
	$sql = "SELECT * FROM product WHERE P_Code = '$p_code'";
	$result = mysqli_query($Link,$sql);
	$row = mysqli_fetch_assoc($result);
	$UID = $_SESSION["ID"];

	$P_Name = $row["P_NAME"];
	$P_Price = $row["P_Price"];
	$P_ImgPath = $row["P_ImgPath"];
	$P_SoldAmount = $row["P_SoldAmount"];
	$P_Inv = $row["P_Inv"];
	$Seller_ID = $row["Seller_ID"];

	$sql = "SELECT * FROM user WHERE U_ID = '$UID'";
	$result = mysqli_query($Link,$sql);
	$row = mysqli_fetch_assoc($result);
	$U_MONEY = $row["U_MONEY"];

	
	if(isset($_GET["confirm"]))
	{
		if($P_Inv <= 0)
			header("Location:index.php");
		$purchase_code=substr(md5(rand()),0,12);

		$imgPath;
		$sql = "SELECT * FROM purchase WHERE Purchase_Code = '$purchase_code'";
		$result = mysqli_query($Link,$sql);
		while($row = mysqli_fetch_assoc($result))
		{
			$purchase_code=substr(md5(rand()),0,12);
			$sql = "SELECT * FROM purchase WHERE Purchase_Code = '$purchase_code'";
			$result = mysqli_query($Link,$sql);
			echo "重複";
		}

		$amount = $_GET["amount"];
		$sql = "UPDATE user SET U_MONEY = $U_MONEY-($amount * $P_Price) WHERE U_ID = '$UID'";
		//echo $sql."<br/>";
		$result = mysqli_query($Link,$sql);
		$sql = "INSERT INTO purchase (Amount,Buyer_ID,Purchase_Code,P_Code) VALUES ($amount,'$UID','$purchase_code','$p_code')";
		$result = mysqli_query($Link,$sql);
		$sql = "UPDATE product SET P_Inv = ($P_Inv - $amount) WHERE P_Code = '$p_code'";
		$result = mysqli_query($Link,$sql);
		$sql = "UPDATE product SET P_SoldAmount = ($P_SoldAmount + $amount) WHERE P_Code = '$p_code'";
		$result = mysqli_query($Link,$sql);
		echo "<script>alert('購買成功！');location.href='product.php?&p_code=$p_code';</script>";
		//header("Location:user.php");
	}
	$sql = "SELECT * FROM product WHERE P_Code = '$p_code'";
	$result = mysqli_query($Link,$sql);
	$row = mysqli_fetch_assoc($result);

	$P_Name = $row["P_NAME"];
	$P_Price = $row["P_Price"];
	$P_ImgPath = $row["P_ImgPath"];
	$P_SoldAmount = $row["P_SoldAmount"];
	$P_Inv = $row["P_Inv"];
	$Seller_ID = $row["Seller_ID"];

	if($UID == $Seller_ID)
	{
		echo "您不可以購買自己的商品，兩秒後跳轉";
		header("Refresh:2;url=index.php");
	}
	else
	{
		if(isset($_GET["amount"]))
			$amount = $_GET["amount"];
		else
			$amount = 1;
		if ($amount<1) {
			echo "<script>alert('請輸入購買數量');location.href='product.php?&p_code=$p_code';</script>";	
		}elseif (($amount*$P_Price)>$U_MONEY) {
			echo "<script>alert('您的錢不夠 需要儲值！');location.href='product.php?&p_code=$p_code';</script>";
		}else{
			echo "<script> var r = confirm('確認購買嗎？');
			if (r == true) {
				location.href='purchaseconfirm.php?p_code=$p_code&confirm=yes&amount=$amount';
			}else{
				location.href='product.php?p_code=$p_code';
			}</script>";
		}	
	}
}