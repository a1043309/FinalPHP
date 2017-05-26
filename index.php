<?php
session_start();
header('Content-type: text/html; charset=utf-8');
if(isset($_SESSION["ID"]))
{
	echo "尊貴的".$_SESSION["ID"]."歡迎來到9487交易網";
}
else if (isset($_POST["id"]))
{
	$id = $_POST["id"];
	$pwd = $_POST["pwd"];

	$Link = mysqli_connect('localhost','phpholyshit','tingting123','9487');
	if(!$Link)
		echo "連接失敗";
	$result = mysqli_query($Link,"SELECT * FROM USER");

	while($row = mysqli_fetch_assoc($result)){
		if($row["U_ID"] == $id)
		{
			if($row["U_PW"] == $pwd){
				$_SESSION["ID"] = $id;
				echo "登入成功";
				break;
			}			
		}
	}
	if(!isset($_SESSION["ID"]))
		echo "登入失敗";
}
else
{
	echo "請先登入才能夠使用喔";
}