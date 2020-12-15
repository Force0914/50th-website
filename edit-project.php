<?php
session_start();
$userid = $_SESSION['userid'];
$projectid = $_POST['projectid'];
$projectname = $_POST['projectname'];
$projectdes = $_POST['projectdes'];
$leaderid = $_POST['leader'];
$facename = $_POST['facename'];
$facedes = $_POST['facedes'];
$oldfacename = $_POST['oldfacename'];
$oldfacedes = $_POST['oldfacedes'];
$teamuser = $_POST['team'];
$del = false;
if (isset($_POST['del'])) {
    $delface = $_POST['del'];
    $del = true;
}
$sql = @mysqli_connect("127.0.0.1","admin","1234","test");
$groupsql = mysqli_query($sql, "SELECT * FROM `project` WHERE proid=$projectid");
$grouprow = mysqli_fetch_assoc($groupsql);
$groupid = $grouprow['groupid'];
mysqli_query($sql,"UPDATE `project` SET `name`='$projectname',`des`='$projectdes' WHERE proid = $projectid");
mysqli_query($sql,"DELETE FROM `user_group` WHERE groupid=$groupid");
mysqli_query($sql,"INSERT INTO `user_group`(`groupid`, `userid`, `pre`) VALUES ($groupid,$leaderid,'admin')");
foreach ($teamuser as $teamrow) {
    if ($teamrow != $leaderid) {
    mysqli_query($sql,"INSERT INTO `user_group`(`groupid`, `userid`, `pre`) VALUES ($groupid,$teamrow,'user')");
    }
}
if ($del) {
    foreach ($delface as $delfacerow) {
        mysqli_query($sql,"DELETE FROM `face` WHERE faceid = $delfacerow");
    }
}
foreach ($facename as $key => $facenamerow) {
    $facedesrow = $facedes[$key];
    mysqli_query($sql,"INSERT INTO `face`(`proid`, `name`, `des`, `state`) VALUES ($projectid,'$facenamerow','$facedesrow','true')");
}
foreach ($oldfacename as $key => $oldfacenamerow) {
    $oldfacedesrow = $oldfacedes[$key];
    mysqli_query($sql,"UPDATE `face` SET `name`='$oldfacenamerow',`des`='$oldfacedesrow' WHERE faceid = $key");
}
$_SESSION['msg'] = "成功修改專案:$projectname";
header("Location:project.php");