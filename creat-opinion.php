<?php
session_start();
$faceid = $_POST['faceid'];
$userid = $_POST['userid'];
$num = str_pad($_POST['num'],3,"0",STR_PAD_LEFT);
$title = $_POST['title'];
$description = $_POST['description'];
$date = $_POST['date'];
$opinion = implode(",",$_POST['opinion']);
if (strpos($opinion,"none")) {
  $opinion = "";
}
if ($_FILES['file']['error'] === UPLOAD_ERR_OK){
    $filename = $_FILES['file']['name'];
    $filetype = mb_substr( $_FILES['file']['type'],0,5,"utf-8");
    if (file_exists('files/' . $_FILES['file']['name'])){
        $sql = @mysqli_connect("127.0.0.1","admin","1234","test");
        $ckopinion = $sql->query("SELECT * FROM opinion");
        $ckopinion2 = $ckopinion->fetch_assoc();
        mysqli_query($sql,"INSERT INTO `opinion`(faceid, userid, num, name, des, file, filetype, opinion) VALUES ($faceid,$userid,'$num','$title','$description','files/$filename','$filetype','$opinion')");
        $sql->close();
        $_SESSION['msg'] = "上傳成功";
        header("Location:face.php?id=$faceid");
    } else {
        $sql = @mysqli_connect("127.0.0.1","admin","1234","test");
        mysqli_query($sql,"INSERT INTO `opinion`(faceid, userid, num, name, des, file, filetype, opinion) VALUES ($faceid,$userid,'$num','$title','$description','files/$filename','$filetype','$opinion')");
        $sql->close();
      $file = $_FILES['file']['tmp_name'];
      $dest = 'files/' . $_FILES['file']['name'];
      move_uploaded_file($file, $dest);
      $_SESSION['msg'] = "上傳成功";
    header("Location:face.php?id=$faceid");
    }
  } else {
    if ($_FILES['file']['error'] == 4){
        $sql = @mysqli_connect("127.0.0.1","admin","1234","test");
        mysqli_query($sql,"INSERT INTO `opinion`(faceid, userid, num, name, des, opinion) VALUES ($faceid,$userid,'$num','$title','$description','$opinion')");
        $_SESSION['msg'] = "上傳成功";
        header("Location:face.php?id=$faceid");
    }else{
    $_SESSION['msg'] = '上傳檔案失敗,錯誤代碼：' . $_FILES['file']['error'];
     header("Location:creatopinion.php?id=$faceid");
    }
  }