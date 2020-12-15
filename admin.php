<?php
session_start();
if (isset($_SESSION['username'])) {
    if($_SESSION['type'] != "admin"){
        header("Location:user.php");
    }
}else{
    header("Location:login.php");
}?>
<!DOCTYPE html>
<html lang="zh_tw">
<head>
    <title>使用者管理</title>
    <?php include("head.php");?>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="b">
    <?php include("navbar.php");?>
    <div class="container">
    <div class="txt-center">
        <h2>使用者管理</h2>
        <a href="creatuser.php" class="btn btn-primary">新增</a>
        <?php if(isset($_GET['desc'])){?>
        <a type="button" href="admin.php" class="btn">排序</a>
        <?php }else{?>
        <a type="button" href="admin.php?desc" class="btn">排序</a>
        <?php } ?>
    </div>
    <br>
    <div class="c">
               <table class="table">
                    <thead>
                         <tr>
                              <th>使用者名稱</th>
                              <th>使用者帳號</th>
                              <th>功能</th>
                         </tr>
                    </thead>
                    <?php
                    $conn = mysqli_connect("127.0.0.1", "admin", "1234", "test");
                    if(isset($_GET['desc'])){
                        $sql = "SELECT * FROM user ORDER BY account DESC ";
                    }else{
                        $sql = "SELECT * FROM user ORDER BY account ASC ";
                    }
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                         while ($row = $result->fetch_assoc()) {
                            if ($row['pre'] != "admin") {
                                echo "<tr><td>" . $row["username"] . "</td><td>" . $row["account"] . "</td><td>" . '<div class="btn-group"><a href=edituser.php?id=' . $row["id"] .' class="btn">編輯</a>' . '<a href=deleteuser.php?id=' . $row["id"] .' class="btn btn-danger">刪除</a></div>' . "</td></tr>";
                            }else {
                              echo "<tr><td>" . $row["username"] . "</td><td>" . $row["account"] . "</td><td></td></tr>";
                            }
                        }
                    } else {
                         return;
                    }
                    $conn->close();
                    ?>
               </table>
    </div>
    </div>
    <?php
          if (!empty($_SESSION['msg'])) {
            ?><script> alert("<?php echo $_SESSION['msg'];?> ")</script><?php
            $_SESSION['msg'] = "";
          }else{
            $_SESSION['msg'] = "";
          };
    ?>
</body>
</html>