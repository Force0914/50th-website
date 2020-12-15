<?php
session_start();
$projectid = $_POST['id'];
$actionnum = $_POST['actionnum'];
$actionname = $_POST['actionname'];
$actiondes = $_POST['actiondes'];
$array_opinion = $_POST['opinion'];
if(sizeof($array_opinion) != 2){
$_SESSION['msg'] = "請選擇兩個意見，不可多也不可少";
header("Location:creataction.php");
}
$sql = mysqli_connect("127.0.0.1","admin","1234","test");
//echo "INSERT INTO `action_plan`(`proid`,`num`,`name`,`des`) VALUES($projectid,'$actionnum','$actionname','$actiondes')<br>";
mysqli_query($sql,"INSERT INTO `action_plan`(`proid`,`num`,`name`,`des`) VALUES($projectid,'$actionnum','$actionname','$actiondes')");
$last_id = $sql->insert_id;
foreach ($array_opinion as $key => $opinion) {
//    echo "INSERT INTO `action_opinion`(`action_id`, `opinion_id`) VALUES ($last_id,$opinion)<br>";
    mysqli_query($sql,"INSERT INTO `action_opinion`(`action_id`, `opinion_id`) VALUES ($last_id,$opinion)");
}
$_SESSION['msg'] = "新增成功";
header("Location:actionplan.php?id=$projectid");