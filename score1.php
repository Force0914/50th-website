<?php
$sql = @mysqli_connect("127.0.0.1","admin","1234","test");
if (!$sql) {
    echo "MYSQL 連線錯誤!";
}
$id = $_POST['opid'];
$userid = $_POST['userid'];
$score = $_POST['score'];
mysqli_query($sql, "INSERT INTO score(opid, userid, score) VALUES ($id, $userid ,$score)");
$_SESSION['msg'] = "評分成功";
header("Location:score.php?id=$id");