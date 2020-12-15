<?php
    session_start();
    if (isset($_SESSION['type'])) {
        if($_SESSION['type'] != "admin"){
            $_SESSION['msg'] = "你沒有權限查看";
            header("Location:user.php");
        }else {
            if($_SESSION['type'] == "admin"){
                if (!$_GET['id']) {
                    $_SESSION['msg'] = "ID未指定";
                    header("Location:admin.php");
                }
            } else {
                $_SESSION['msg'] = "你沒有權限查看";
                header("Location:user.php");
            }
        }
    }else { 
        $_SESSION['msg'] = "請先登入";
        header("Location:login.php");
    }

$sql = @mysqli_connect("127.0.0.1","admin","1234","test");
if (!$sql) {
    echo "MYSQL 連線錯誤!";
}
$id = $_GET['id'];
mysqli_query($sql, "DELETE FROM `user` WHERE id = $id");
$_SESSION['msg'] = "刪除成功";
header("Location:admin.php");