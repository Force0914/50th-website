<?php
$sql = mysqli_connect("127.0.0.1","admin","1234","test"); //SQL連接

function v($a){
   $a = trim($a);//移除空白字符
   $a = stripslashes($a);//消除多的反斜線
   $a = htmlspecialchars($a);//把所有文字轉換為HTML字符
   return $a;
}

function to($b){
    header("Location:$b"); //重導向到 $b 網頁
}

session_start(); //呼叫session
$username = v($_POST['username']); //把使用者輸入的帳號緩存
$pass = v($_POST['password']); //把使用者輸入的密碼緩存
$ckpass = mysqli_query($sql, "SELECT * FROM user WHERE account='$username' AND password='$pass'"); //查詢符合輸入資料的資料表

 if (mysqli_num_rows($ckpass) === 1) { //確認SQL裡存在這筆資料
    $row = mysqli_fetch_assoc($ckpass); //把SQL讀出來的資料存進$row陣列裡
    if ($row['account'] === $username && $row['password'] = $pass) { //再次確認帳碼密碼符合性
        $_SESSION['account'] = $row['account']; //帳號暫存
        $_SESSION['userid'] = $row['id']; //USER ID 暫存
        $_SESSION['username'] = $row['username']; //使用者名稱暫存
        $_SESSION['type'] = $row['pre']; // 權限分類暫存
        if ($_SESSION['type'] == "admin") { //判斷是否為管理員
            to("admin.php"); //是管理員，導向管理介面
        }else{
            to("user.php"); //不是管理員，導向使用者介面
        }
        exit();
    }else{
        $_SESSION['msg'] = "帳號密碼錯誤";
        to("index.php"); //帳號密碼錯誤，重導向登入介面
        exit();
    }
 }else{
        $_SESSION['msg'] = "帳號密碼錯誤";
        to("index.php"); //帳號不存在，一樣重導向至登入介面
        exit();
 }