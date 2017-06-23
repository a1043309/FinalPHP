<?php
header('Content-type: text/html; charset=utf-8');
session_start();

$p_code = $_GET['p_code'];

$Link = mysqli_connect('localhost','phpholyshit','tingting123','9487');
	if(!$Link)
		echo "連接失敗";
mysqli_query($Link,"SET NAMES UTF8");
$sql = "SELECT * FROM product WHERE P_Code = '$p_code'";
$result = mysqli_query($Link,$sql);
$row = mysqli_fetch_assoc($result);

if(!isset($_SESSION["ID"]))
	header("Location:signin.php");
else if ($_SESSION["ID"] != $row["Seller_ID"])
{
	if(!isset($_SESSION["isAdmin"]))
		header("Location:index.php");
}

else if(isset($_POST["game"]) && isset($_POST["server"]) && isset($_POST["classify"]) && isset($_POST["p_name"]) && isset($_POST["p_price"]) && isset($_POST["p_inv"]) && isset($_POST["info"]))
	{

	$UID = $_SESSION["ID"];
	$Link = mysqli_connect('localhost','phpholyshit','tingting123','9487');
	if(!$Link)
		echo "連接失敗";

	mysqli_query($Link, "SET NAMES UTF8");

	
	$imgPath;
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
	
		$sql = "UPDATE product SET P_Server = '$_POST[server]',P_Classify = '$_POST[classify]',P_Present = '$_POST[info]',P_NAME = '$_POST[p_name]',P_Inv = '$_POST[p_inv]',P_Price = '$_POST[p_price]', P_Game = '$_POST[game]' WHERE P_Code = '$p_code'";
	echo $sql;
	$result = mysqli_query($Link,$sql);
	header("Location:product.php?&p_code=".$p_code);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>9487寶物交易網</title>
	<link rel="stylesheet" type="text/css" href="css/final.css">
	<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
	<meta http-equiv="Content-Type" CONTENT="text/html">
	<script type="text/javascript"></script>
</head>
<body>
	<script type="text/javascript">
		function node(name, kind){
			this.name=name;
			this.kind=kind;
		}
		function data(){
			var mapelstory = new Array();
			var i=0;
			mapelstory[i++] = new node("選擇伺服","");
			mapelstory[i++]=new node("雪吉拉",["全部","遊戲幣","道具","帳號","代練","送禮","其他"]);
			mapelstory[i++] = new node("星光精靈",["全部","遊戲幣","道具","帳號","代練","送禮","其他"]);
			mapelstory[i++] = new node("藍寶",["全部","遊戲幣","道具","帳號","代練","送禮","其他"]);
			mapelstory[i++] = new node("菇菇寶貝",["全部","遊戲幣","道具","帳號","代練","送禮","其他"]);
			mapelstory[i++] = new node("緞帶肥肥",["全部","遊戲幣","道具","帳號","代練","送禮","其他"]);
			mapelstory[i++] = new node("綠水靈",["全部","遊戲幣","道具","帳號","代練","送禮","其他"]);
			mapelstory[i++] = new node("九大",["全部","遊戲幣","道具","帳號","代練","送禮","其他"]);
			mapelstory[i++] = new node("三大",["全部","遊戲幣","道具","帳號","代練","送禮","其他"]);

			var kart = new Array();
			var i = 0;
			kart[i++] = new node("選擇伺服","");
			kart[i++] = new node("全部",["全部","遊戲幣","道具","帳號","代練","其他","商城道具"]);

			var bnb = new Array();
			var i = 0;
			bnb[i++] = new node("選擇分類","");
			bnb[i++] = new node("全部",["全部","遊戲幣","道具","帳號","代練","其他","商城道具"]);

			var output = new Array();
			var i = 0;
			output[i++] = new node("選擇遊戲","");
			output[i++] = new node("新楓之谷",mapelstory);
			output[i++] = new node("跑跑卡丁車",kart);
			output[i++] = new node("爆爆王",bnb);

			return(output);
		}
		datatree = data();
		function onChangeColumn3(){
			updatePath();
		}
		function onChangeColumn2(){
			form = document.theForm;
			index1 = form.game.selectedIndex;
			index2 = form.server.selectedIndex;
			index3 = form.classify.selectedIndex;
			for(i = 0; i<datatree[index1].kind[index2].kind.length; i++){
				form.classify.options[i] = new Option(datatree[index1].kind[index2].kind[i],datatree[index1].kind[index2].kind[i]);
			}
			form.classify.options.length = datatree[index1].kind[index2].kind.length;
			updatePath();
		}
		function onChangeColumn1(){
			form = document.theForm;
			index1 = form.game.selectedIndex;
			index2 = form.server.selectedIndex;
			index3 = form.classify.selectedIndex;

			for(i=0; i<datatree[index1].kind.length; i++){
				form.server.options[i] = new Option(datatree[index1].kind[i].name, datatree[index1].kind[i].name);
			}
			form.server.options.length = datatree[index1].kind.length;
			form.classify.options.length = 0;
			updatePath();
		}
		function updatePath(){
			form = document.theForm;
			index1 = form.game.selectedIndex;
			index2 = form.server.selectedIndex;
			index3 = form.classify.selectedIndex;
			if ((index1 >= 0) && (index2 >= 0) && (index3 >= 0)){
				text1 = form.game.options[index1].text;
				text2 = form.server.options[index2].text;
				text3 = form.classify.options[index3].text;
				form.path.value = text1+" ==> "+text2+" ==> "+text3;
			}else{
				form.path.value="";
			}
		}
	</script>
	<div class="wrap">
		<div class="header">
			<div class="logo">
				<a href="index.php"><img  style="width: 60%;" src="pic/logo.png" alt="9487寶物交易網" title="9487寶物交易網"></a>
			</div>
			<div class="member-set">
				<?php 
			if(isset($_SESSION["ID"]))
			{
				$Link = mysqli_connect('localhost','phpholyshit','tingting123','9487');
				$UID = $_SESSION["ID"];
				$result = mysqli_query($Link,"SELECT U_MONEY FROM user WHERE U_ID = '$UID'");
				$row = mysqli_fetch_assoc($result);

				echo "<a href='user.php' class='lid-member'>".$UID."</a>";
				echo "<a href='index.php?&logout=yes' class='lid-member'>登出</a>";
				if(isset($_SESSION["isAdmin"]))
					echo "<a href='admin.php' class='lid-member'>後臺管理</a>";
				echo "<a href='#' class='lid-member'>$".$row["U_MONEY"]."</a>";
			}
			?>
			</div>
		</div>
		<div class="clear"></div>
		<div class="content">
			<div class="label-post">
				<div class="label-post-title">
					<h2>修改商品</h2>
				</div>
				<div class="label-post-line"></div>
			</div>
			<?php $p_code = $_GET['p_code']; echo "<form name='theForm' action='editproduct.php?&p_code=$p_code' method = 'post' id = 'changepwd' enctype='multipart/form-data'>";?>
			<div class="main-post">
				<div class="post-data">選擇遊戲：
					<select id="selected-post" name="game" onChange="onChangeColumn1();">
						<script>
							for(i = 0; i<datatree.length; i++){
								$v = datatree[i].name;
								document.writeln("<option value =\""+datatree[i].name+"\">"+datatree[i].name);
							}
						</script>
					</select>
				</div>
				<div class="post-data">選擇伺服：
					<select id="selected-post" name="server" onChange="onChangeColumn2();">
					</select>
				</div>
				<div class="post-data">選擇分類：
					<select id="selected-post" name="classify" onChange="onChangeColumn3();">
					</select>
				</div>
				<?php
					$p_code = $_GET['p_code'];
					$ok = "SELECT * FROM product WHERE P_Code = '$p_code'";
					$okk = mysqli_query($Link,$ok);
					$roww = mysqli_fetch_assoc($okk);
				?>
				<div class="post-data">商品名稱：
					<?php echo "<input id='selected-post' type='text' maxlength='20' name='p_name' value='$roww[P_NAME]'>";?><span>*上限為20字</span>		
				</div>
				<div class="post-data" >價 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;格：
					<?php echo "<input id='selected-post' type='number' min='0' name='p_price' value='$roww[P_Price]'>";?>		
				</div>
				<div class="post-data" >數 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;量：
					<?php echo "<input id='selected-post' type='number' min='0' name='p_inv' value='$roww[P_Inv]'>";?>		
				</div>
				<div class="post-data" >商品照片：<?php
					"<input id='selected-post' type='file' name='img' value = '$roww[P_ImgPath]'>";?>無法更換		
				</div>
				<div class="post-data" >商品介紹：
					<?php echo "<textarea rows='4' cols='50' name='info'>$roww[P_Present]
					</textarea>";?>	
				</div>

				<div class="post-data"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input id="post-btn" type="submit" value="提交"> &nbsp;&nbsp;&nbsp;
					<input id="post-btn" type="reset" value="重新填寫">
				</div>
			</div>
			</form>
		</div>
		<div class="clear"></div>
		<div style="margin-top: 180px;" class="footer">
			<p>©copyright by 2017 9487DB&PHP</p>
		</div>
	</div>
</body>
</html>
