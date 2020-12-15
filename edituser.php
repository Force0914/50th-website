<?php
session_start();
if (isset($_SESSION['username'])) {
    if($_SESSION['type'] != "admin"){
        header("Location:user.php");
    }
}else{
    header("Location:login.php");
}
    $id = $_GET['id'];
    $conn = @mysqli_connect("127.0.0.1","admin","1234","test");
    if (!$conn) {
    echo "MYSQL 連線錯誤!";
    }
    $sql = "SELECT * FROM user WHERE id =$id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $name = $row['account'];
    $_SESSION['editaccount'] = $name;
    $username = $row['username'];
    $password = $row['password'];
    $conn->close();
    ?>
<!DOCTYPE html>
<html lang="zh_tw">
<head>
    <title>編輯使用者</title>
    <?php include("head.php");?>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="a">
    <div class="box">
        <h2>編輯使用者</h2>
        <p>使用者帳號:<?php echo $name ?></p>
        <form action="edit-user.php" method="post">
        <label for="username">使用者名稱</label>
        <input type="text" name="username" id="username" value="<?php echo $username?>" required="required">
        <label for="password">密碼</label>
        <input type="text" name="password" id="password" value="<?php echo $password?>" required="required"><br>
        <a href="admin.php" class="btn betterbtn">取消</a>
        <input type="submit" class="btn" value="送出">
        </form>
    </div>
</body>
</html>