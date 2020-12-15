<?php
session_start();
$sql = @mysqli_connect("127.0.0.1","admin","1234","test");
if (!$sql) {
    echo "MYSQL 連線錯誤!";
}
$account = $_SESSION['editaccount'];
$username = $_POST["username"];
$password = $_POST["password"];
mysqli_query($sql, "UPDATE user SET username = '$username', password = '$password' WHERE account = '$account'");
$_SESSION['msg'] = "編輯成功";
header("Location:admin.php");