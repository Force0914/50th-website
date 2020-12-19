<?php
session_start();
$projectid = $_POST['id'];
$actionnum = $_POST['actionnum'];
$actionname = $_POST['actionname'];
$actiondes = $_POST['actiondes'];
$opinion = implode(",",$_POST['opinion']);
if(sizeof($_POST['opinion']) <= 0){
$_SESSION['msg'] = "請選擇意見";
header("Location:creataction.php");
}
$sql = mysqli_connect("127.0.0.1","admin","1234","test");
mysqli_query($sql,"INSERT INTO `action_plan`(`proid`,`num`,`name`,`des`,`opinion`) VALUES($projectid,'$actionnum','$actionname','$actiondes','$opinion')");
$_SESSION['msg'] = "新增成功";
header("Location:actionplan.php?id=$projectid");