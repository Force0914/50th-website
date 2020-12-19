<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location:login.php");
}
$actionid = $_GET['id'];
$sql = mysqli_connect("127.0.0.1","admin","1234","test");
$result = mysqli_query($sql,"SELECT * FROM `action_plan` WHERE actionid = $actionid");
$row = mysqli_fetch_assoc($result);
$proid = $row['proid'];
$actionnum = $row['num'];
$actionname = $row['name'];
$actiondes = $row['des'];
$actionopinion = $row['opinion'];
$opinionarray = explode(",",$actionopinion);
$fresult = mysqli_query($sql,"SELECT * FROM face WHERE proid = $proid");
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
                if(in_array($opid,$opinionarray)){
                    $code = $code ."<option value='".$opid."' selected>".$orow['name']."/".ceil($avg2['AVG(score)'])."</option>";
                }else{
                    $code = $code ."<option value='".$opid."'>".$orow['name']."/".ceil($avg2['AVG(score)'])."</option>";
                }
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
    <title>編輯執行方案</title>
    <?php include("head.php");?>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="a">
<div class="box">
    <form action="edit-action.php" method="post">
        <h2>編輯執行方案</h2>
        <div class="row">
            <div class="span3">
                <input type="hidden" name="id" value="<?=$actionid?>">
                <input type="hidden" name="proid" value="<?=$proid?>">
                <label for="actionnum">編號:</label>
                <input type="text" name="actionnum" id="actionnum" value="<?=$actionnum?>"><br>
                <label for="actionname">執行方案名稱:</label>
                <input type="text" name="actionname" id="actionname" value="<?=$actionname?>"><br>
                <label for="actiondes">執行方案說明:</label>
                <input type="text" name="actiondes" id="actiondes" value="<?=$actiondes ?>"><br>
            </div>
            <div class="span3">
                <label>選取兩個面向:</label>
                <div class="long">
                    <?php echo $code;?>
                </div>
            </div>
        </div>
        <br>
        <a class="btn betterbtn" href="actionplan.php?id=<?=$proid?>">取消</a>
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