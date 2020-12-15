<!DOCTYPE html>
<html lang="zh_tw">
<head>
    <title>專案討論-登入</title>
    <?php include('head.php');?>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="a">
    <div class="box">
        <form action="login.php" method="POST">
        <?php
          session_start();
          if (!empty($_SESSION['msg'])) {
            ?><script> alert("<?php echo $_SESSION['msg'];?> ")</script><?php
            $_SESSION['msg'] = "";
          }else{
            $_SESSION['msg'] = "";
          };?>
            <h2>專案討論-登入</h2><br>
            <input type="text"class="form-control" name="username" id="username" placeholder="Account"  required="required"><br>
            <input type="password"class="form-control" name="password" id="password" placeholder="Password"  required="required">
            <br><br>
            <input type="submit" class="btn" value="登入"> 
        </form>
    </div>
</body>
</html>