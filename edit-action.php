<?php
session_start();
$actionid = $_POST['id'];
$projectid = $_POST['proid'];
$actionnum = $_POST['actionnum'];
$actionname = $_POST['actionname'];
$actiondes = $_POST['actiondes'];
$opinion = implode(",",$_POST['opinion']);
if(sizeof($_POST['opinion']) <= 0){
$_SESSION['msg'] = "請選擇意見";
header("Location:creataction.php");
}
$sql = mysqli_connect("127.0.0.1","admin","1234","test");
mysqli_query($sql,"UPDATE `action_plan` SET `num`='$actionnum',`name`='$actionname',`des`='$actiondes',`opinion`='$opinion' WHERE actionid = $actionid");
$_SESSION['msg'] = "編輯成功";
header("Location:actionplan.php?id=$projectid");