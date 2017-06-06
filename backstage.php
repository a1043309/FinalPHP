<?php
echo ""


if(isset($_GET["p_manage"]))
{
	$Link = mysqli_connect('localhost','phpholyshit','tingting123','9487');
	if(!$Link)
		echo "連接失敗";

	echo "商品列表：";
	$sql = "SELECT * FROM product";
			$result = mysqli_query($Link,$sql);
			while($row = mysqli_fetch_assoc($result))
			{
				echo "商品名稱：".$row['P_NAME']."<br/>";
				echo "賣家：".$row['Seller_ID']."<br/><br/><br/>";
			}
}
else if (isset($_GET["u_manage"]))
{
	
}
?>