<?php
session_start();
if (isset($_SESSION['username'])) {
    if($_SESSION['type'] != "admin"){
        header("Location:user.php");
    }
}else{
    header("Location:login.php");
}?>
<!DOCTYPE html>
<html lang="zh_tw">
<head>
    <title>新增使用者</title>
    <?php include("head.php");?>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="a">
    <div class="box">
        <h2>新增使用者</h2>
        <form action="creat-user.php" method="post">
        <input type="text" name="account" id="account" placeholder="Account" required="required"><br>
        <input type="text" name="username" id="username" placeholder="Username" required="required"><br>
        <input type="text" name="password" id="Password" placeholder="Password" required="required"><br>
        <a href="admin.php" class="btn betterbtn">取消</a>
        <input type="submit" class="btn" value="送出">
        </form>
    </div>
</body>
</html>