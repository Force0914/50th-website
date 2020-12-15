<?php
session_start();
$id = $_POST['id'];
$sname = $_POST['scorename'];
$sql = mysqli_connect("127.0.0.1","admin","1234","test");
$result = mysqli_query($sql,"SELECT * FROM score_item WHERE name ='$sname'");
$db_line = mysqli_num_rows($result);
if ($db_line >= 1){
    $_SESSION['msg'] = "新增失敗，已有相同名稱之評分指標";
    header("Location:creatscoreitem.php?id=$id");
}else{
    mysqli_query($sql,"INSERT INTO `score_item`(`proid`, `name`) VALUES ($id,'$sname')");
    $_SESSION['msg'] = "新增成功";
    header("Location:scoreitem.php?id=$id");
}