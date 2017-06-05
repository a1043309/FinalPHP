<?php
	header('Content-type: text/html; charset=utf-8');
	session_start();

	$q_code = $_GET["q_code"];

	if(isset($_SESSION["ID"]))
		$UID = $_SESSION["ID"];

	$Link = mysqli_connect('localhost','phpholyshit','tingting123','9487');
	if(!$Link)
		echo "連接失敗";
	mysqli_query($Link, "SET NAMES UTF8");