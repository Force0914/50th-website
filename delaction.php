<?php
$actionid = $_GET['id'];
echo $actionid;
$sql = mysqli_connect("127.0.0.1","admin","1234","test");
$result = mysqli_query("SELECT * FROM `action_plan` WHERE actionid = $actionid");
$proidrow = mysqli_fetch_assoc($result);
$proid = $proidrow['proid'];
echo $proid;
echo "DELETE FROM `action_plan` WHERE actionid = $actionid";
// mysqli_query($sql,"DELETE FROM `action_plan` WHERE actionid = $actionid");
session_start();
$_SESSION['msg'] = "刪除成功";
header("Location:actionplan.php?id=$proid");