<?php
session_start();
$id = $_POST['id'];
$proid = $_POST['proid'];
$sname = $_POST['scorename'];
$sql = mysqli_connect("127.0.0.1","admin","1234","test");
$result = mysqli_query($sql,"SELECT * FROM score_item WHERE name ='$sname'");
$db_line = mysqli_num_rows($result);
if ($db_line >= 1){
    $_SESSION['msg'] = "修改失敗，已有相同名稱之評分指標";
    header("Location:editscoreitem.php?id=$id");
}else{
    mysqli_query($sql,"UPDATE `score_item` SET `name`='$sname' WHERE siid = $id");
    $_SESSION['msg'] = "修改成功";
    header("Location:scoreitem.php?id=$proid");
}