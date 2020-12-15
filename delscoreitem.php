<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location:login.php");
}
$id = $_GET['id'];
$sql = mysqli_connect("127.0.0.1", "admin", "1234", "test");
$result1 = mysqli_query($sql, "SELECT * FROM score_item WHERE siid = $id");
$row1 = mysqli_fetch_assoc($result1);
$proid = $row1['proid'];
$result2 = mysqli_query($sql, "SELECT * FROM project WHERE proid = $proid");
$row = mysqli_fetch_assoc($result2);
$proname = $row['name'];
$groupid = $row['groupid'];
$userid = $_SESSION['userid'];
$result3 = mysqli_query($sql,"SELECT * FROM user_group WHERE userid = $userid AND pre = 'admin' AND groupid = $groupid");
if(mysqli_num_rows($result3) >= 1){
    if($_SESSION['type'] != "admin"){
        $_SESSION['msg'] = "你沒有權限刪除此專案的評分指標";
        header("Location:scoreitem.php?id=$proid");
    }
}
mysqli_query($sql,"DELETE FROM `score_item` WHERE siid = $id");
$_SESSION['msg'] = "刪除成功";
header("Location:scoreitem.php?id=$proid");