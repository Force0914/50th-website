<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location:login.php");
}
$id = $_GET['id'];
$sql = mysqli_connect("127.0.0.1", "admin", "1234", "test");
$result = mysqli_query($sql,"SELECT * FROM `score_item` WHERE siid = $id");
$row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="zh_tw">
<head>
    <title>新增評分指標</title>
    <?php include("head.php");?>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="a">
<div class="box">
    <form action="edit_scoreitem.php" method="post">
        <h2>編輯評分指標</h2>
        <input type="hidden" name="id" value="<?php echo $id;?>">
        <input type="hidden" name="proid" value="<?php echo $row['proid'];?>">
        <label for="scorename">評分指標名稱</label>
        <input id="scorename" name="scorename" type="text" value="<?php echo $row['name'];?>"><br><br>
        <a class="btn betterbtn" href="scoreitem.php?id=<?php echo $row['proid'];?>">取消</a>
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