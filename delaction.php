<?php
$actionid = $_GET['id'];
$sql = mysqli_connect("127.0.0.1","admin","1234","test");
$result = mysqli_query($sql,"SELECT * FROM `action_plan` WHERE actionid = $actionid");
$proidrow = mysqli_fetch_assoc($result);
$proid = $proidrow['proid'];
mysqli_query($sql,"DELETE FROM `action_plan` WHERE actionid = $actionid");
session_start();
$_SESSION['msg'] = "刪除成功";
echo "Location:actionplan.php?id=$proid";
header("Location:actionplan.php?id=$proid");