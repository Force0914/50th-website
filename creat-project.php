<?php
session_start();
$userid = $_SESSION['userid'];
$projectname = $_POST['projectname'];
$projectdes = $_POST['projectdes'];
$leaderid = $_POST['leader'];
$facename = $_POST['facename'];
$facedes = $_POST['facedes'];
$teamuser = $_POST['team'];
$sql = @mysqli_connect("127.0.0.1","admin","1234","test");
$groupsql = mysqli_query($sql, "SELECT * FROM `user_group` ORDER BY groupid DESC LIMIT 0 , 1;");
$grouprow = mysqli_fetch_assoc($groupsql);
$groupid = $grouprow['groupid']+1;
mysqli_query($sql,"INSERT INTO `project`(`groupid`, `name`, `des`) VALUES ($groupid,'$projectname','$projectdes');");
$proid = $sql->insert_id;
mysqli_query($sql,"INSERT INTO `user_group`(`groupid`,`userid`,`pre`) VALUES ($groupid,$leaderid,'admin');");
foreach ($teamuser as $teamrow) {
    if ($teamrow != $leaderid) {
        mysqli_query($sql,"INSERT INTO `user_group`(`groupid`,`userid`,`pre`) VALUES ($groupid,$teamrow,'user');");
    }
}
foreach ($facename as $key => $facenamerow) {
    $facedesrow = $facedes[$key];
    if($facenamerow != "" && $facedesrow != ""){
        mysqli_query($sql,"INSERT INTO `face`(`proid`,`name`,`des`,`state`) VALUES ($proid,'$facenamerow','$facedesrow','true');");
    }
}
$_SESSION['msg'] = "成功新增專案:$projectname";
header("Location:project.php");