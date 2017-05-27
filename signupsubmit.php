<?php
header('Content-type: text/html; charset=utf-8');
if (isset($_POST["id"]))
{
	$id = $_POST["id"];
	$pwd = $_POST["pwd"];
	$name = $_POST["name"];
	$gender = $_POST["gender"];
	$job = $_POST["job"];
	$birth = $_POST["birth"];
	$phone = $_POST["phone"];
	$email = $_POST["email"];

	$isUsed = false;

	$Link = mysqli_connect('localhost','phpholyshit','tingting123','9487');
	if(!$Link)
		echo "連接失敗";

	$result = mysqli_query($Link,"SELECT * FROM user");

	while($row = mysqli_fetch_assoc($result)){
		if($row["U_ID"] == $id)
		{
			echo "你選擇的ID已被使用";
			$isUsed = true;
		}
	}
	if(!$isUsed)
	{
		$result = mysqli_query($Link,"INSERT INTO USER(U_ID,U_PW,U_NAME,U_BIRTH,U_GENDER,U_PHONE,U_EMAIL) VALUES('$id','$pwd','$name','$birth','$gender','$phone','$email')");
	}

}