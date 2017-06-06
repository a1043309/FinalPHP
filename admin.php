<?php
	header('Content-type: text/html; charset=utf-8');
	session_start();
	if(!isset($_SESSION["ID"]))
		header("Location:signin.php");

	$UID = $_SESSION["ID"];
	$Link = mysqli_connect('localhost','phpholyshit','tingting123','9487');
	mysqli_query($Link, "SET NAMES UTF8");
	if(!$Link)
		echo "連接失敗";
	$sql2 = "SELECT * FROM user WHERE U_ID = '$UID'";
	$result2 = mysqli_query($Link,$sql2);
	$row2 = mysqli_fetch_assoc($result2);
	if ($row2['U_Right'] != 1) {
		header("Location:index.php");
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>後台管理</title>
	<link rel="stylesheet" type="text/css" href="css/yoyo.css">
</head>
<body style="max-width: 1100px;margin: 0 auto;">
	<div class="user_header">
			<a href="index.php"><img src="pic/logo.png"></a>
			<div class="user_header_profile">
			<?php
				$sql = "SELECT * FROM user WHERE U_ID = '$UID'";
				$result = mysqli_query($Link,$sql);
				$row = mysqli_fetch_assoc($result);
				
			?>
				<p>
				<?php if ($row["U_Right"] == true) {
					echo "<a href=''>後台管理</a>";
				}?> &nbsp;&nbsp;
				<a href="edit-info.php">修改資料</a>&nbsp;&nbsp;
				<?php echo "<a href='index.php?&logout=yes' class='lid-member'>登出</a>"; ?>&nbsp;&nbsp;
				<?php 
					$result = mysqli_query($Link,"SELECT U_MONEY FROM user WHERE U_ID = '$UID'");
					$row = mysqli_fetch_assoc($result);
					echo "<a href='#' class='lid-member'>$".$row["U_MONEY"]."</a>"; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</p>
			</div>
			<div class="clear"></div>
		</div>
		<div class="content" style="position: relative;">
			<div class="content-title" style="border-bottom: 3px solid lightblue;padding-bottom: 5px;">
				<img src="pic/title.png" class="imbuyer">
				<p style="position: absolute;float: left;left: 7%;color: white;">後台管理</p>
				<?php echo "<a href='admin.php?p_manage=0'><p style='float: left;padding-left: 20px;'>商品管理</p></a>";?>
				<?php echo "<a href='admin.php?u_manage=0'><p style='float: left;padding-left: 20px;'>會員管理</p></a>;"?>
				<div class="clear"></div>
			</div>
		<?php if (isset($_GET["p_manage"])) {?>
			<div class="content-list">
				<?php
					$sql = "SELECT * FROM product";
					$result = mysqli_query($Link,$sql);
				?>
				<table border="1" style="text-align: center;margin-top: 1em; margin-right: auto;margin-left: auto;">
					<tr>
						<td style="padding: 10px 180px;">商品名稱</td>
						<td style="padding: 10px 40px;">賣家</td>
						<td style="padding: 10px 40px;">遊戲</td>
						<td style="padding: 10px 30px;">種類</td>
						<td style="padding: 10px 30px">操作</td>
					</tr>
					<?php
						while ($row = mysqli_fetch_assoc($result)) {
							$code = $row['P_Code'];
							$name = $row['P_NAME'];
							$seller = $row['Seller_ID']?>
							<tr>
								<td><?php echo "<a href=product.php?&p_code=$code>$name</a>"; ?></td>
								<td><?php echo $seller; ?></td>
								<td><?php echo $row['P_Game']; ?></td>
								<td><?php echo $row['P_Classify']; ?></td>
								<td>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo "<a href=editproduct.php?&p_code=$code>修改商品</a>"; ?> &nbsp;&nbsp;&nbsp;<?php echo "<a href=delproduct_a.php?&p_code=$code>刪除商品</a>";?>&nbsp;&nbsp;&nbsp;&nbsp;</td>
							</tr>	
				<?php }
					?>
				</table>
			</div>
		<?php } ?>
		<?php if (isset($_GET["u_manage"])) {?>
			<div class="content-list">
				<?php
					$sql = "SELECT * FROM user";
					$result = mysqli_query($Link,$sql);
				?>
				<table border="1" style="text-align: center;margin-top: 1em; margin-right: auto;margin-left: auto;">
					<tr>
						<td style="padding: 10px 40px;">會員帳號</td>
						<td style="padding: 10px 40px;">會員姓名</td>
						<td style="padding: 10px 40px;">生日</td>
						<td style="padding: 10px 30px;">手機</td>
						<td style="padding: 10px 30px">操作</td>
					</tr>
					<?php
						while ($row = mysqli_fetch_assoc($result)) { 
							$user = $row['U_ID']; ?>
							<tr>
								<td><?php echo $row['U_ID']; ?></td>
								<td><?php echo $row['U_NAME']; ?></td>
								<td><?php echo $row['U_BIRTH']; ?></td>
								<td><?php echo $row['U_PHONE']; ?></td>
								<td>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo "<a href=editmember.php?&user=$user>修改會員</a>"; ?> &nbsp;&nbsp;&nbsp;<?php echo "<a href=delmember.php?&user=$user>刪除會員</a>";?>&nbsp;&nbsp;&nbsp;&nbsp;</td>
							</tr>	
				<?php }
					?>
				</table>
			</div>
		<?php } ?>
		</div>
		<div class="footer" style="margin: unset;font-weight: unset;padding-top: 180px;">
		<p style="font-size:14px;">Copyright © 2017 9487DB&PHP</p>
	</div>
</body>
</html>