<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location:login.php");
}
$sql = mysqli_connect("127.0.0.1","admin","1234","test");
$result = mysqli_query($sql,"");
?>
<!DOCTYPE html>
<html lang="zh_tw">
<head>
    <title>新增執行方案</title>
    <?php include("head.php");?>
    <link rel="stylesheet" href="css/style.css">ㄑ
</head>
<body class="a">
<div class="box">
    <form action="creat-action.php" method="post">
        <h2>編輯執行方案</h2>
        <div class="row">
            <div class="span3">
                <input type="hidden" name="id" value="<?php echo $id;?>">
                <label for="actionnum">編號:</label>
                <input type="text" name="actionnum" id="actionnum" value="<?php echo $ ;?>"><br>
                <label for="actionname">執行方案名稱:</label>
                <input type="text" name="actionname" id="actionname" value="<?php echo $ ;?>"><br>
                <label for="actiondes">執行方案說明:</label>
                <input type="text" name="actiondes" id="actiondes" value="<?php echo $ ;?>"><br>
            </div>
            <div class="span3">
                <label>選取兩個面向:</label>
                <div class="long">
                    <?php echo $code;?>
                </div>
            </div>
        </div>
        <br>
        <a class="btn betterbtn" href="actionplan.php?id=<?php echo $id;?>">取消</a>
        <input class="btn" type="submit" value="送出">
    </form>
</div>
<?php
if (!empty($_SESSION['msg'])){
    ?><script>alert("<?php echo $_SESSION['msg'];?>");</script><?php
    $_SESSION['msg'] = "";
}else{
    $_SESSION['msg'] = "";
}
?>
</body>
</html>