<?php
$sql = @mysqli_connect("127.0.0.1","admin","1234","test");
$account = $_POST["account"];
$username = $_POST["username"];
$password = $_POST["password"];
$result = mysqli_query($sql,"SELECT account FROM user WHERE account = '$account'");
$db_line = mysqli_num_rows($result);
if ($db_line >= 1) {
    $_SESSION['msg'] = "帳號已存在";
    header("Location:admin.php");
}else {
    mysqli_query($sql, "INSERT INTO `user`(username, password, account) VALUES ('$username','$password','$account')");
    $_SESSION['msg'] = "新增成功";
    header("Location:admin.php");
}