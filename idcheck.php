<?php
	$id = $_GET["id"];

	$Link = mysqli_connect('localhost','phpholyshit','tingting123','9487');

	$Link = mysqli_connect('localhost','phpholyshit','tingting123','9487');
	if(!$Link){
		echo "連接失敗";
	}

	$result = mysqli_query($Link,"SELECT * FROM user");

	$new = '';
	while($row = mysqli_fetch_assoc($result)){
		if($row["U_ID"] == $id){
			$new = "used";
			echo "<script>alert('這個ID已被使用');</script>";
			break;
		}
	}
	if ($new != "used") {
		echo "<script>alert('恭喜 這個ID可以使用');location.href='signup.php'</script>";

	}
	
?>
