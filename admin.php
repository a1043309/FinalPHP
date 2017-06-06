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
			<div class="content-title" style="border-bottom: 3px solid lightblue; padding-bottom: 5px;">
				<img src="pic/title.png" class="imbuyer">
				<p style="position: absolute;float: left;left: 7%;color: white;">後台管理</p>
				<?php echo "<a href='admin.php?type=p_manage'><p style='float: left;padding-left: 20px;'>商品管理</p></a>";?>
				<?php echo "<a href='admin.php?type=u_manage'><p style='float: left;padding-left: 20px;'>會員管理</p></a>";?>
				<div class="clear"></div>
			</div>
			<div style="margin: 0 auto;">
				<form action="admin.php" method="get" style="margin-left: 40%;margin-top: 30px;">
				<select name="type">
  					<option value="u_manage">查詢會員</option>
 					<option value="p_manage">查詢商品</option>
				</select>
					<input type="text" name="search">
					<input type="submit" name="">
				</form>
			</div>

		<?php if (isset($_GET["type"])) {
				if($_GET["type"] == "p_manage"){
			?>
			<div class="content-list">
				<?php
					$sql = "SELECT * FROM product";
					if(isset($_GET['search']))
					{
						$s = "%".$_GET['search']."%";
						$sql = "SELECT * FROM product WHERE P_NAME LIKE '$s'";
					}
					$result = mysqli_query($Link,$sql);
					$data_nums = mysqli_num_rows($result);
					$per = 20;
					$pages = ceil($data_nums/$per);
					if (!isset($_GET["page"])) {
						$page = 1;
					}else{
						$page = intval($_GET["page"]);
					}
					$start = ($page-1)*$per;
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
						$sql = $sql.' LIMIT '.$start.', '.$per;
						$result = mysqli_query($Link, $sql);
						$p = 'type=p_manage';
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
		<?php }
		} ?>
		<?php if (isset($_GET["type"])) {
				if($_GET["type"] == "u_manage"){
			?>
			<div class="content-list">
				
				<?php					
					$sql = "SELECT * FROM user";
					if(isset($_GET['search']))
					{
						$s = "%".$_GET['search']."%";
						$sql = "SELECT * FROM user WHERE U_ID LIKE '$s'";
					}
						
					
					$result = mysqli_query($Link,$sql);
					$data_nums = mysqli_num_rows($result);
					$per = 20;
					$pages = ceil($data_nums/$per);
					if (!isset($_GET["page"])) {
						$page = 1;
					}else{
						$page = intval($_GET["page"]);
					}
					$start = ($page-1)*$per;
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
						$sql = $sql.' LIMIT '.$start.', '.$per;
						$result = mysqli_query($Link, $sql);
						$p = 'type=u_manage';
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
		<?php }
		} ?>
		</div>
		<div class="footer" style="margin: unset;font-weight: unset;padding-top: 180px;">
		<?php
    //分頁頁碼
   				echo '共 '.$data_nums.' 筆-在 '.$page.' 頁-共 '.$pages.' 頁';
    			echo "<br /><a href=admin.php?&".$p."&page=1>首頁</a> ";
    			echo "第 ";
    				for( $i=1 ; $i<=$pages ; $i++ ) {
        				if ( $page-3 < $i && $i < $page+3 ) {
           					 echo "<a href=admin.php?&".$p."&page=".$i.">".$i."</a> ";
        				}
    				} 
    			echo " 頁 <a href=admin.php?&".$p."&page=".$pages.">末頁</a><br /><br />";
			?>
		<p style="font-size:14px;">Copyright © 2017 9487DB&PHP</p>
	</div>
</body>
</html>