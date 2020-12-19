<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location:login.php");
}
$id = $_GET['id'];
$sql = mysqli_connect("127.0.0.1", "admin", "1234", "test");
$result = mysqli_query($sql, "SELECT * FROM project WHERE proid = $id");
$row = mysqli_fetch_assoc($result);
$proname = $row['name'];
$fresult = mysqli_query($sql,"SELECT * FROM face WHERE proid = $id");
if (mysqli_num_rows($result) > 0){
    $code = "";
    while($frow = mysqli_fetch_assoc($fresult)){
        $code = $code . "<label>".$frow['name']."</label><select name='opinion[]' id='opinion'><option value='none'>不選擇</option>";
        $faceid = $frow['faceid'];
        $oresult = mysqli_query($sql,"SELECT * FROM opinion WHERE faceid = $faceid");
        if (mysqli_num_rows($result) > 0){
            while($orow = mysqli_fetch_assoc($oresult)){
                $opid = $orow['opid'];
                $avg = mysqli_query($sql,"SELECT AVG(score) FROM score WHERE opid = $opid");
                $avg2 = mysqli_fetch_assoc($avg);
                $code = $code ."<option value='".$opid."'>".$orow['name']."/".ceil($avg2['AVG(score)'])."</option>";
            }
        }else{
            $code = "";
        }
        $code = $code . "</select>";
    }
}else{
    $code = "";
}
?>
<!DOCTYPE html>
<html lang="zh_tw">
<head>
    <title>新增執行方案</title>
    <?php include("head.php");?>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="a">
<div class="box">
    <form action="creat-action.php" method="post">
        <h2>新增執行方案</h2>
        <div class="row">
            <div class="span3">
                <input type="hidden" name="id" value="<?php echo $id;?>">
                <label for="actionnum">編號:</label>
                <input type="text" name="actionnum" id="actionnum"><br>
                <label for="actionname">執行方案名稱:</label>
                <input type="text" name="actionname" id="actionname"><br>
                <label for="actiondes">執行方案說明:</label>
                <input type="text" name="actiondes" id="actiondes"><br>
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