<?php
session_start();
if (isset($_SESSION['username'])) {
    if($_SESSION['type'] != "admin"){
        header("Location:user.php");
    }
}else{
    header("Location:login.php");
}
$sql = @mysqli_connect("127.0.0.1","admin","1234","test");
$id = $_GET['id'];
$groupsql = mysqli_query($sql, "SELECT * FROM `project` WHERE proid = $id");
$grouprow = mysqli_fetch_assoc($groupsql);
mysqli_query($sql, "DELETE FROM `project` WHERE proid = $id");
$groupid = $grouprow['groupid'];
mysqli_query($sql, "DELETE FROM `user_group` WHERE groupid = $groupid");
$_SESSION['msg'] = "刪除成功";
header("Location:project.php");