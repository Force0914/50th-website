<?php
session_start();
$account = $_POST['account'];
$password = $_POST['password'];
$sql = mysqli_connect("127.0.0.1","admin","1234","50");
$result = mysqli_query($sql,"SELECT * FROM user WHERE account = '$account' AND password = '$password' LIMIT 1");
if(mysqli_num_rows($result) == 1){
	$row = mysqli_fetch_assoc($result);
	$sqlaccount = $row['account'];
	$sqlpassword = $row['password'];
	$userpre = $row['pre'];
	if($sqlaccount != $account || $sqlpassword != $password){
		$_SESSION['msg'] = "帳號密碼錯誤";
		header("Location:index.php");
		exit();
	}else{
		if($userpre == "admin"){
			header("Location:admin.php");
			exit();
		}else{
			header("Location:user.php");
			exit();
		}
	}
}else{
	$_SESSION['msg'] = "帳號密碼錯誤";
		header("Location:index.php");
		exit();
}